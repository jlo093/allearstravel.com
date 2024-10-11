<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $id
 * @property string $state
 * @property string $payment_session_id
 * @property string $email
 * @property string $reference
 * @property OrderAddress $address
 */
class Order extends Model
{
    use HasFactory;

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class, 'order_id');
    }

    public function provisionalBookings(): HasMany
    {
        return $this->hasMany(ProvisionalBooking::class, 'order_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'order_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'order_id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(OrderAddress::class, 'order_id');
    }
}
