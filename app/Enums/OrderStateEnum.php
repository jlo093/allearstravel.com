<?php

namespace App\Enums;

enum OrderStateEnum: string
{
    case OPEN = 'open';
    case PAYMENT_PENDING = 'payment_pending';
    case PAID = 'paid';
    case CANCELLED = 'cancelled';
}
