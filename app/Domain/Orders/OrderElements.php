<?php

namespace App\Domain\Orders;

use App\Helpers\PNR;
use App\Http\Requests\SearchHotelsRequest;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

enum OrderElements: string
{
    case FLIGHT = 'flight';
    case HOTEL = 'hotel';
    case TICKET = 'ticket';
}
