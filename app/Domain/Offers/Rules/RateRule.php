<?php

namespace App\Domain\Offers\Rules;

use App\Models\Rate;

interface RateRule
{
    public function isApplicable(Rate $rate): bool;
}
