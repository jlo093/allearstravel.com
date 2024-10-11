<?php

namespace App\Console\Commands;

use App\Domain\Orders\OrderState;
use App\Enums\BookingTypeEnum;
use App\Enums\OrderStateEnum;
use App\Models\Booking;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ProvisionalBooking;
use App\Services\Internal\FinancingService;
use App\Services\RateHawk\API;
use App\Services\RateHawk\Requests\MakPreBookingRequest;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class SyncPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $unpaidOrders = Order::where('state', OrderStateEnum::PAYMENT_PENDING)->get();
        /** @var Order $order */
        foreach ($unpaidOrders as $order) {
            $session = Session::retrieve($order->payment_session_id, [
                'expand' => ['line_items'],
            ]);

            $provisionalBookings = ProvisionalBooking::where('order_id', $order->id)
                ->get();

            $pricing = (new FinancingService())->getPayableBreakdown($provisionalBookings);

            if ($session->payment_status != 'unpaid') {
                $amountPaid = $session->amount_total / 100;
                $paymentIdentifier = $session->payment_intent;

                $payment = new Payment();
                $payment->order_id = $order->id;
                $payment->payment_identifier = $paymentIdentifier;
                $payment->psp = 'stripe';
                $payment->amount = $amountPaid;
                $payment->currency = 'GBP';
                $payment->save();

                if ($amountPaid >= $pricing->totalGross) {
                    $order->state = OrderStateEnum::PAID;
                } else {
                    $order->state = OrderStateEnum::PARTIALLY_PAID;
                }

                $order->save();

                // TODO Make reservation with RateHawk (within, sent email to customer)
                /** @var ProvisionalBooking $booking */
                foreach ($provisionalBookings as $booking) {
                    if ($booking->type === BookingTypeEnum::HOTEL->value) {
                        $response = (new API(new Client()))->send(new MakPreBookingRequest($order->id, $booking->supplier_reference));
                        dump($response->data);
                    }
                }
            }
        }
    }
}
