<?php

namespace App\Services\RateHawk\Responses;

use App\Services\RateHawk\Responses\DTO\HotelInformation;

class HotelInformationResponse implements Response
{
    public ?HotelInformation $hotelInformation = null;

    public function populate(array $response): void
    {
        $this->hotelInformation = HotelInformation::from($response['data']);
    }
}
