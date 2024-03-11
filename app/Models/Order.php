<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $state
 */
class Order extends Model
{
    use HasFactory;

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class, 'order_id');
    }
}
