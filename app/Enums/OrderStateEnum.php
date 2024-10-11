<?php

namespace App\Enums;

enum OrderStateEnum: string
{
    case OPEN = 'open';
    case PAYMENT_PENDING = 'payment_pending';
    case PAID = 'paid';
    case PARTIALLY_PAID = 'partially_paid';
    case CANCELLED = 'cancelled';

    public static function getDescription(string $value): string
    {
        return match ($value) {
            self::OPEN->value, self::CANCELLED->value => '',
            self::PAYMENT_PENDING->value => _('confirmed, but there is a pending balance. Any tickets that form part of your booking will be released once the order has been paid in full'),
            self::PARTIALLY_PAID->value => _('confirmed, but there is a pending balance. Any tickets that form part of your booking will be released once the order has been paid in full'),
            self::PAID->value => _('confirmed and fully paid. If there is any pending bookings, these will be processed shortly. Please see status below'),
        };
    }
}
