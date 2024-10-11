<?php

namespace App\Services\RateHawk\Responses\DTO;

use Spatie\LaravelData\Data;

/**
 * @property PaymentType[] $payment_types
 */
class PaymentOption extends Data
{
    public function __construct(
        public array $payment_types
    ) {}
}
