<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $id
 * @property integer $hotel_id
 * @property string $name
 * @property string $external_id
 * @property integer $sleeper_capacity
 */
class Room extends Model
{
    use HasFactory;

    public function hotel(): HasOne
    {
        return $this->hasOne(Hotel::class, 'id', 'hotel_id');
    }

    public function thumbnail()
    {
        /** @var Media $thumb */
        $thumb = Media::where('model', self::class)
            ->where('model_id', $this->id)
            ->first();

        return str_replace(['{size}'], ['1024x768'], $thumb->filename);
    }
}
