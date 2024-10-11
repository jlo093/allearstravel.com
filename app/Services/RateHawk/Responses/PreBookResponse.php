<?php

namespace App\Services\RateHawk\Responses;

use App\Services\RateHawk\Responses\DTO\HotelInformation;

class PreBookResponse implements Response
{
    public array $data = [];

    public function populate(array $response): void
    {
        $this->data = $response['data'];
    }
}
