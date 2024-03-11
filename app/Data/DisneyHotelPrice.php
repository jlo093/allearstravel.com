<?php

namespace App\Data;

class DisneyHotelPrice
{
    public function __construct(
        public float $price,
        public string $id
    ) {}
}
