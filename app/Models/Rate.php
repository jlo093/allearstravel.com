<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property float $price_gross
 * @property float $cost_gross
 */
class Rate extends Model
{
    use HasFactory;
}
