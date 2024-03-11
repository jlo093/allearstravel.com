<?php

namespace App\Traits;

trait HasSerialisedData
{
    abstract public function loadSerialisedData(array $data): void;
    abstract public function toSerialisedData(): array;
}
