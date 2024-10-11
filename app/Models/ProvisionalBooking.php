<?php

namespace App\Models;

use App\Services\RateHawk\Responses\DTO\PaymentOption;
use App\Services\RateHawk\Responses\DTO\PaymentType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $order_id
 * @property int $hotel_id
 * @property int $adults
 * @property int $children
 * @property float $price_net
 * @property float $price_gross
 * @property float $supplier_price
 * @property float $reference_price
 * @property string $type
 * @property string $supplier_reference
 * @property string $external_reference
 * @property string $detail
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property Carbon $free_cancellation_deadline
 * @property Carbon $payment_deadline
 * @property bool $has_free_cancellation
 */
class ProvisionalBooking extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'payment_deadline' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'free_cancellation_deadline' => 'date',
    ];

    public function rate(): \App\Services\RateHawk\Responses\DTO\Rate
    {
        return new \App\Services\RateHawk\Responses\DTO\Rate(
            $this->supplier_reference,
            [],
            'nomeal',
            $this->detail,
            new PaymentOption([
                new PaymentType(
                    $this->supplier_price,
                    'GBP',
                    [],
                    [],
                )
            ]),
            $this->price_gross,
            $this->supplier_price,
        );
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
}
