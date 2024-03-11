<?php

namespace App\Domain\Offers\Rules;

use App\Models\Order;

interface OrderRule
{
    public function isApplicable(Order $order): bool;
}
