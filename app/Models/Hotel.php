<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use function Symfony\Component\String\s;

/**
 * @property integer $id
 * @property string $ratehawk_id
 * @property string $name
 * @property string $category
 * @property string $address
 * @property string $description
 * @property string $meta_policy
 * @property string $longitude
 * @property string $latitude
 * @property string $checkin_time
 * @property string $checkout_time
 * @property string $area_description
 * @property integer $stars
 * @property bool $has_bus
 * @property bool $has_skyliner
 * @property bool $has_boat
 */
class Hotel extends Model
{
    use HasFactory;

    public function thumbnail()
    {
        /** @var Media $thumb */
        $thumb = Media::where('model', self::class)
            ->where('model_id', $this->id)
            //->where('is_default', true)
            ->first();

        return str_replace(['{size}'], ['1024x768'], $thumb?->filename ?? '');
    }

    public function image(int $index, bool $default = false)
    {
        /** @var Media $thumb */
        $thumb = Media::where('model', self::class)
            ->where('model_id', $this->id)
            ->where('is_default', $default)
            ->get();

        return str_replace(['{size}'], ['1024x768'], $thumb[$index]?->filename ?? '');
    }

    public function highlights(): HasMany
    {
        return $this->hasMany(HotelHighlight::class);
    }

    public function amenities(): HasMany
    {
        return $this->hasMany(Amenity::class);
    }

    public function getFormattedAmenities(): array
    {
        $amenities = [];

        foreach ($this->amenities as $amenity) {
            if (!isset($amenities[$amenity->category])) {
                $amenities[$amenity->category] = [];
            }
            $amenities[$amenity->category][] = $amenity->description;
        }

        return $amenities;
    }
}
