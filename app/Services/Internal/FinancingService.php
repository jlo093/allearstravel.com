<?php

namespace App\Services\Internal;

use App\Data\OrderPaymentData;
use App\Enums\BookingTypeEnum;
use App\Models\Order;
use App\Models\ProvisionalBooking;
use Carbon\Carbon;

class FinancingService
{
    const HOTEL_DEPOSIT = 50;

    public function getOrderTotal(Order $order): float
    {
        $orderTotal = 0;

        foreach ($order->provisionalBookings as $provisionalBooking) {
            $orderTotal += $provisionalBooking->price_gross;
        }

        foreach ($order->bookings as $booking) {
            $orderTotal += $booking->price_gross;
        }

        return $orderTotal;
    }

    public function getTotalPaymentsMade(Order $order): float
    {
        $totalReceived = 0;

        foreach ($order->payments as $payment) {
            $totalReceived += $payment->amount;
        }

        return $totalReceived;
    }

    public function getPayableBreakdown($bookings, ?OrderPaymentData $pricing = null): OrderPaymentData
    {
        if ($pricing === null) {
            $pricing = new OrderPaymentData();
        }

        /** @var ProvisionalBooking $booking */
        foreach ($bookings as $booking) {
            $pricing->addNet($booking->price_net);
            $pricing->addGross($booking->price_gross);

            if ($booking->payment_deadline->isToday() || $booking->payment_deadline->isPast()) {
                $pricing->addPayableToday($booking->price_gross);
            } else {
                if ($booking->type == BookingTypeEnum::HOTEL->value) {
                    $applicableDeposit = $this->getApplicableDeposit($booking);

                    $pricing->addPayableToday($applicableDeposit);
                    $pricing->addPayableLater($booking->price_gross - $applicableDeposit);
                } else {
                    $pricing->addPayableLater($booking->price_gross);
                }
            }
        }

        return $pricing;
    }

    public function getApplicableDeposit(ProvisionalBooking $booking): float
    {
        if ($booking->type == BookingTypeEnum::HOTEL->value) {
            return min(self::HOTEL_DEPOSIT, $booking->price_gross);
        }

        return 0;
    }

    public function getPaymentSchedule(Carbon $deadline, float $amount)
    {
        $today = Carbon::now();


    }
}
