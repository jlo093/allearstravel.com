<?php

namespace App\Domain\Offers;

use App\Models\Offer;
use App\Models\Order;
use App\Models\Rate;

/**
 * OfferDetermination
 *
 * Allows to retrieve applicable offers to either order or a rate.
 * (Order = the whole basket, i.e. hotel and tickets)
 * (Rate = a single item, i.e. hotel)
 *
 * Will apply and evaluate rules to identify offers applicable.
 */
class OfferDetermination
{
    public function __construct(
        private readonly OfferRepository $offerRepository
    ) {}

    /**
     * @param Rate $rate
     * @return array<Offer>
     */
    public function getOffersApplicableToRate(Rate $rate): array
    {
        $applicableOffers = [];

        foreach ($this->offerRepository->getActiveOffersForRates() as $offer) {
            $isFulfilled = true;

            foreach ($offer->rules as $rule) {
                if (! $rule->isApplicable($rate)) {
                    $isFulfilled = false;

                    break;
                }
            }

            if ($isFulfilled) {
                $applicableOffers[] = $offer;
            }
        }

        return $applicableOffers;
    }

    /**
     * @param Order $order
     * @return array<Offer>
     */
    public function getOffersApplicableToOrder(Order $order): array
    {
        $applicableOffers = [];

        foreach ($this->offerRepository->getActiveOffersForOrders() as $offer) {
            $isFulfilled = true;

            foreach ($offer->rules as $rule) {
                if (! $rule->isApplicable($order)) {
                    $isFulfilled = false;

                    break;
                }
            }

            if ($isFulfilled) {
                $applicableOffers[] = $offer;
            }
        }

        return $applicableOffers;
    }
}
