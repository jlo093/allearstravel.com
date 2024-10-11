<?php

namespace App\Services\RateHawk\Requests;

use App\Enums\RegionEnum;
use App\Enums\RequestMethodEnum;
use App\Services\RateHawk\Responses\PreBookResponse;
use App\Services\RateHawk\Responses\Response;
use App\Services\RateHawk\Responses\SearchHotelByRegionResponse;
use Carbon\Carbon;

class MakPreBookingRequest implements Request
{
    public function __construct(
        private readonly int $partnerOrderId,
        private readonly string $bookingHash
    ) {}

    public function getPayload(): array
    {
        return [
            'partner_order_id' => $this->partnerOrderId,
            'book_hash' => $this->bookingHash,
            'language' => 'en',
            'user_ip' => '77.97.224.37'
        ];
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getEndpoint(): string
    {
        return '/hotel/order/booking/form/';
    }

    public function getMethod(): RequestMethodEnum
    {
        return RequestMethodEnum::POST;
    }

    public function getResponseClass(): Response
    {
        return new PreBookResponse();
    }
}
