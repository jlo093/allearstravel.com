<?php

namespace App\Services\RateHawk\Responses\DTO;

use Spatie\LaravelData\Data;

class PaymentType extends Data
{
    public function __construct(
        public float $amount,
        public string $currency_code,
        public array $tax_data,
        public array $cancellation_penalties
    ) {}
}
