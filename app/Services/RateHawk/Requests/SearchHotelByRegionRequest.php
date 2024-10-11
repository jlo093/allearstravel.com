<?php

namespace App\Services\RateHawk\Requests;

use App\Enums\RegionEnum;
use App\Enums\RequestMethodEnum;
use App\Services\RateHawk\Responses\Response;
use App\Services\RateHawk\Responses\SearchHotelByRegionResponse;
use Carbon\Carbon;

class SearchHotelByRegionRequest implements Request
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
            'region_id' => $this->region->value,
            'checkin' => $this->checkinDate->format('Y-m-d'),
            'checkout' => $this->checkoutDate->format('Y-m-d'),
            'guests' => [
                [
                    'adults' => $this->adults,
                    'children' => []
                ]
            ]
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
