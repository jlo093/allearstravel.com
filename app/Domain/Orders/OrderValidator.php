<?php

namespace App\Domain\Orders;

use App\Helpers\PNR;
use App\Http\Requests\SearchHotelsRequest;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderValidator
{
    public function isValid(Order $order): bool
    {
        return true;
    }
}
