<?php

namespace App\Services\RateHawk\Requests;

use App\Enums\RegionEnum;
use App\Enums\RequestMethodEnum;
use App\Services\RateHawk\Responses\HotelInformationResponse;
use App\Services\RateHawk\Responses\Response;
use App\Services\RateHawk\Responses\SearchHotelByRegionResponse;
use Carbon\Carbon;

class GetHotelInformationByIdRequest implements Request
{
    public function __construct(
        private readonly string $id,
        private readonly string $language = "en"
    ) {}

    public function getPayload(): array
    {
        return [
            'id' => $this->id,
            'language' => $this->language,
        ];
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getEndpoint(): string
    {
        return '/hotel/info/';
    }

    public function getMethod(): RequestMethodEnum
    {
        return RequestMethodEnum::POST;
    }

    public function getResponseClass(): Response
    {
        return new HotelInformationResponse();
    }
}
