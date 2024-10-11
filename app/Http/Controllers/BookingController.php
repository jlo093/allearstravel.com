<?php

namespace App\Http\Controllers;

use App\Data\OrderPaymentData;
use App\Domain\Offers\OfferDetermination;
use App\Domain\Orders\OrderState;
use App\Enums\BookingTypeEnum;
use App\Enums\OrderStateEnum;
use App\Enums\PaymentModeEnum;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\ManageBookingRequest;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\ProvisionalBooking;
use App\Services\Internal\FinancingService;
use App\Services\RateHawk\Responses\DTO\Hotel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class BookingController extends Controller
{
    public function __construct(
        private readonly OrderState $orderState,
        private readonly FinancingService $financingService,
        private readonly OfferDetermination $offerDetermination,
    ) {}

    public function room(string $id, string $hash)
    {
        $room =  null;

        /** @var Hotel $hotel */
        foreach ($this->orderState->getStoredRates() as $hotel) {
            foreach ($hotel->rates as $rate) {
                if ($rate->match_hash === $hash) {
                    $room = $rate;

                    break;
                }
            }

            if (!empty($room)) {
                break;
            }
        }

        $data = $this->orderState->getRequestData();

        // TODO if hotel and/or rate undefined = order expired
        // TODO send user back to search with error, sentry
        $checkin = Carbon::createFromFormat('d/m/Y', $data['checkin']);
        $checkout = Carbon::createFromFormat('d/m/Y', $data['checkout']);

        $conditions = $room->payment_options->payment_types[0];

        if (isset($conditions->cancellation_penalties['free_cancellation_before']) &&
            !empty($conditions->cancellation_penalties['free_cancellation_before'])) {
            $deadline = Carbon::createFromFormat('Y-m-d', substr($conditions->cancellation_penalties['free_cancellation_before'], 0, 10));
            $deadline->subDays(7);

            if ($deadline < Carbon::now()) {
                $deadline = Carbon::now();
            }
        } else {
            $deadline = Carbon::now();
        }

        ProvisionalBooking::create([
            'order_id' => Order::where('reference', $this->orderState->getCustomerOrderPNR())->first()->id,
            'type' => BookingTypeEnum::HOTEL,
            'supplier_price' => $rate->getLowestPrice(),
            'reference_price' => $rate->disney_price ?? 0,
            'price_net' => $rate->final_price,
            'price_gross' => $rate->final_price,
            'supplier_reference' => $hash,
            'detail' => $rate->room_name,
            'start_date' => $checkin->format('Y-m-d'),
            'end_date' => $checkout->format('Y-m-d'),
            'has_free_cancellation' => isset($conditions->cancellation_penalties['free_cancellation_before']),
            'free_cancellation_deadline' => $conditions->cancellation_penalties['free_cancellation_before'] ?? null,
            'payment_deadline' => $deadline->format('Y-m-d'),
            'hotel_id' => $hotel->hotel->id,
            'adults' => $data['adults'],
            'children' => $data['children'],
        ]);

        return redirect(
            route('booking.checkout')
        );
    }

    public function checkout(Request $request): View
    {
        $pnr = $request->get('order', $this->orderState->getCustomerOrderPNR());

        $bookings = ProvisionalBooking::where('order_id', Order::where('reference', $pnr)->first()->id)
            ->get();

        return view('booking.checkout', [
            'bookings' => $bookings,
            'pricing' => $this->financingService->getPayableBreakdown($bookings),
            'finance' => $this->financingService,
            'offerDetermination' => $this->offerDetermination,
            'pnr' => $pnr,
        ]);
    }

    /**
     * @throws Exception
     */
    public function payment(CheckoutRequest $request)
    {
        $data = $request->all();

        /** @var Order $order */
        $order = Order::where('reference', $data['pnr'])->first();
        if (!$order) {
            throw new Exception('Order has expired.');
        }

        $order->state = OrderStateEnum::PAYMENT_PENDING;
        $order->email = $data['email'];

        $bookings = ProvisionalBooking::where('order_id', $order->id)
            ->get();

        $pricing = $this->financingService->getPayableBreakdown($bookings);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $applicablePaymentAmount = $pricing->payableToday;
        if ($data['payment_mode'] === PaymentModeEnum::FULL_BALANCE->value) {
            $applicablePaymentAmount -= $pricing->totalGross;
        }

        $checkout_session = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'gbp',
                    'product' => 'prod_R08nEOTj14kWQG',
                    'tax_behavior' => 'inclusive',
                    'unit_amount' => $applicablePaymentAmount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => env('APP_URL') . '/success/' . $data['pnr'],
            'cancel_url' => env('APP_URL') . '/checkout',
        ]);

        $order->payment_session_id = $checkout_session->id;
        $order->save();

        return redirect($checkout_session->url);
    }

    public function manage(ManageBookingRequest $request)
    {
        $data = $request->validated();

        /** @var Order $order */
        $order = Order::where('reference', $data['pnr'])->first();

        if (!$order) {
            return back()->with([
                'message' => _('Order not found. Please check that the order reference and surname are correct.')
            ]);
        }

        if ($order->state === OrderStateEnum::OPEN->value) {
            return back()->with([
                'message' => _('Your order is pending, please try again later.')
            ]);
        }

        if ($order->state === OrderStateEnum::CANCELLED->value) {
            return back()->with([
                'message' => _('Your order has been cancelled. Please contact customer support with any further enquiries.')
            ]);
        }

        if ($order->email !== $data['surname']) {
            return back()->with([
                'message' => _('Order not found. Please check that the order reference and surname are correct.')
            ]);
        }

        return view('booking.manage', [
            'order' => $order,
            'pending_bookings' => $order->provisionalBookings,
            'confirmed_bookings' => $order->bookings,
            'payments' => $order->payments,
            'financials' => [
                'money_paid' => $this->financingService->getTotalPaymentsMade($order),
                'money_owed' => $this->financingService->getOrderTotal($order),
            ]
        ]);
    }

    public function success(string $pnr): View
    {
        /** @var Order $order */
        $order = Order::where('reference', $pnr)->first();

        return view('booking.success', [
            'order' => $order,
        ]);
    }
}
