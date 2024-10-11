<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class PNR
{
    public static function create(): string
    {
        $pnr = strtoupper(Str::random(8));

        // TODO Check collision

        return $pnr;
    }
}
