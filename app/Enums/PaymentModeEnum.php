<?php

namespace App\Enums;

enum PaymentModeEnum: string
{
    case DEPOSIT_ONLY = 'deposit_only';
    case FULL_BALANCE = 'full_balance';
}
