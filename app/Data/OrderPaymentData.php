<?php

namespace App\Data;

class OrderPaymentData
{
    public function __construct(
        public float $totalNet = 0,
        public float $totalGross = 0,
        public float $payableToday = 0,
        public float $payableLater = 0,
    ) {}

    public function addNet(float $amount): void
    {
        $this->totalNet += $amount;
    }

    public function addGross(float $amount): void
    {
        $this->totalGross += $amount;
    }

    public function addPayableToday(float $amount): void
    {
        $this->payableToday += $amount;
    }

    public function addPayableLater(float $amount): void
    {
        $this->payableLater += $amount;
    }
}
