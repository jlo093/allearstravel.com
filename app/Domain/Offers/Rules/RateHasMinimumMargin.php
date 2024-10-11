<?php

namespace App\Domain\Offers\Rules;

use App\Services\RateHawk\Responses\DTO\Rate;
use App\Traits\HasSerialisedData;

class RateHasMinimumMargin implements RateRule
{
    use HasSerialisedData;

    private ?float $minMargin = null;

    public function isApplicable(Rate $rate): bool
    {
        return ($rate->final_price - $rate->getLowestPrice()) > $this->minMargin;
    }

    public function loadSerialisedData(array $data): void
    {
        $this->minMargin = $data['minMargin'];
    }

    public function toSerialisedData(): array
    {
        return [
            'minMargin' => $this->minMargin
        ];
    }
}
