<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $hotel_id
 * @property string $description
 * @property string $category
 */
class Amenity extends Model
{
    use HasFactory;
}
