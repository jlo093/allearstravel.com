<?php

namespace App\Services\RateHawk\Responses\DTO;

use Spatie\LaravelData\Data;

class Rate extends Data
{
    public function __construct(
        public string $match_hash,
        public array $daily_prices,
        public string $meal,
        public string $room_name,
        public PaymentOption $payment_options,
        public ?float $final_price = null,
        public ?float $disney_price = null,
    ) {}

    public function getLowestPrice(): float
    {
        $lowestPrice = null;

        /** @var PaymentType $paymentType */
        foreach ($this->payment_options->payment_types as $paymentType) {
            if (null === $lowestPrice) {
                $lowestPrice = $paymentType->amount;
            } else {
                $lowestPrice = min($lowestPrice, $paymentType->amount);
            }
        }

        return $lowestPrice;
    }

    public function setDisneyPrice(float $price): void
    {
        $this->disney_price = $price;
    }

    public function setFinalPrice(float $price): void
    {
        $this->final_price = $price;
    }
}
