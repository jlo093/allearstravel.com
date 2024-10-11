<?php

namespace App\Services\RateHawk\Responses\DTO;

use Spatie\LaravelData\Data;

/**
 * @property Rate[] $rates
 */
class HotelInformation extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $address,
        public string $check_in_time,
        public string $check_out_time,
        public array $images,
        public string $metapolicy_extra_info,
        public string $latitude,
        public string $longitude,
        public array $amenity_groups,
        public array $facts,
        public array $room_groups
    ) {}
}
