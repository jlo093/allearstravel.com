<?php

namespace App\Data;

class ProviderHotelPrice
{
    public function __construct(
        public float $price,
        public string $id
    ) {}
}
