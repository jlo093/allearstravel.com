<?php

namespace App\Domain\Offers;

use App\Enums\ApplicableToEnum;
use App\Models\Offer;
use Illuminate\Support\Collection;

class OfferRepository
{
    /**
     * @return array<Offer>
     */
    public function getActiveOffersForOrders(): Collection
    {
        return Offer::where('is_active', true)
                ->where('applicable_to', ApplicableToEnum::ORDER->value)->get();
    }

    /**
     * @return array<Offer>
     */
    public function getActiveOffersForRates(): Collection
    {
        return Offer::where('is_active', true)
            ->where('applicable_to', ApplicableToEnum::RATE->value)->get();
    }
}
