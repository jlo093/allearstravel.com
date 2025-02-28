<?php

namespace App\Domain\Offers\Rules;

use App\Services\RateHawk\Responses\DTO\Rate;

interface RateRule
{
    public function isApplicable(Rate $rate): bool;
}
