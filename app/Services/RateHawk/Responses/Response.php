<?php

namespace App\Services\RateHawk\Responses;

interface Response
{
    public function populate(array $response): void;
}
