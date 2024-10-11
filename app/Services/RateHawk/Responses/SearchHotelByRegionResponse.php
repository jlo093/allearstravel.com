<?php

namespace App\Services\RateHawk\Responses;

use App\Services\RateHawk\Responses\DTO\Hotel;

class SearchHotelByRegionResponse implements Response
{
    public array $hotels = [];

    public array $raw = [];

    public function populate(array $response): void
    {
        if (!isset($response['data']) || !isset($response['data']['hotels'])) {
            return;
        }

        $this->raw = $response;

        foreach ($response['data']['hotels'] as $data) {
            $this->hotels[] = Hotel::from($data);
        }
    }
}
