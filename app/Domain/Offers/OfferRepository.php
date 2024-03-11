<?php

namespace App\Domain\Offers;

use App\Enums\ApplicableToEnum;
use App\Models\Offer;

class OfferRepository
{
    /**
     * @return array<Offer>
     */
    public function getActiveOffersForOrders(): array
    {
        return Offer::where('is_active', true)
                ->where('applicable_to', ApplicableToEnum::ORDER->value)->get();
    }

    /**
     * @return array<Offer>
     */
    public function getActiveOffersForRates(): array
    {
        return Offer::where('is_active', true)
            ->where('applicable_to', ApplicableToEnum::RATE->value)->get();
    }
}
