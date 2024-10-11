<?php

namespace App\Services\RateHawk\Responses\DTO;

use Spatie\LaravelData\Data;
use stringEncode\Exception;

/**
 * @property Rate[] $rates
 */
class Hotel extends Data
{
    public function __construct(
        public string $id,
        public array $rates,
        public ?\App\Models\Hotel $hotel = null,
    ) {}

    public function getBestRate(): Rate
    {
        if (!isset($this->rates[0])) {
            throw new Exception('Hotel has no attached rates.');
        }
        return $this->rates[0];
    }
}
