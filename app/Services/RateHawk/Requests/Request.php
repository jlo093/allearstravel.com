<?php

namespace App\Services\RateHawk\Requests;

use App\Enums\RequestMethodEnum;
use App\Services\RateHawk\Responses\Response;

interface Request
{
    public function getPayload(): array;
    public function getHeaders(): array;
    public function getEndpoint(): string;
    public function getMethod(): RequestMethodEnum;
    public function getResponseClass(): Response;
}
