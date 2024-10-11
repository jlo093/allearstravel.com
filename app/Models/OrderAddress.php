<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $order_id
 * @property string $first_name
 * @property string $surname
 * @property string $mobile
 * @property string $line_1
 * @property string $line_2
 * @property string $town
 * @property string $postcode
 */
class OrderAddress extends Model
{
    use HasFactory;

    protected $guarded = [];
}
