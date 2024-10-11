<?php

namespace App\Services\RateHawk\Requests;

use App\Enums\RegionEnum;
use App\Enums\RequestMethodEnum;
use App\Services\RateHawk\Responses\Response;
use App\Services\RateHawk\Responses\SearchHotelByRegionResponse;
use Carbon\Carbon;

class MakeBookingRequest implements Request
{
    public function __construct(
        private readonly RegionEnum $region,
        private readonly Carbon $checkinDate,
        private readonly Carbon $checkoutDate,
        private readonly int $adults,
        private readonly int $children
    ) {}

    public function getPayload(): array
    {
        return [
            'language' => 'en',
            'partner' => [
                'partner_order_id' => 0,
                'amount_sell_b2c' => 0,
            ],
            'payment_type' => [
                'type' => 'deposit',
                'amount' => 0,
                'currency_code' => 'GBP'
            ],

        ];
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getEndpoint(): string
    {
        return '/search/serp/region/';
    }

    public function getMethod(): RequestMethodEnum
    {
        return RequestMethodEnum::POST;
    }

    public function getResponseClass(): Response
    {
        return new SearchHotelByRegionResponse();
    }
}
