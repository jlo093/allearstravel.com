<?php

namespace App\Domain\Offers\Rules;

use App\Services\RateHawk\Responses\DTO\Rate;
use App\Traits\HasSerialisedData;

class RateHasMaximumMargin implements RateRule
{
    use HasSerialisedData;

    private ?float $maxMargin = null;

    public function isApplicable(Rate $rate): bool
    {
        return ($rate->final_price - $rate->getLowestPrice()) < $this->maxMargin;
    }

    public function loadSerialisedData(array $data): void
    {
        $this->maxMargin = $data['maxMargin'];
    }

    public function toSerialisedData(): array
    {
        return [
            'maxMargin' => $this->maxMargin
        ];
    }
}
