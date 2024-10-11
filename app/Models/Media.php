<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $model_id
 * @property string $model
 * @property string $filename
 */
class Media extends Model
{
    use HasFactory;
}
