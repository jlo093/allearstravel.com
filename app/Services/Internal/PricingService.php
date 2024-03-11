<?php

namespace App\Services\Internal;

use App\Data\DisneyHotelPrice;
use App\Data\DisneyHotelResultSet;
use App\Data\ProviderHotelPrice;
use App\Data\ProviderHotelResultSet;

class PricingService
{
    private const MIN_SURCHARGE = 10;

    public function getPricesForProvider(
        DisneyHotelResultSet $disneyHotelResultSet,
        ProviderHotelResultSet $providerHotelResultSet
    ): ProviderHotelResultSet {
        $updatedPrices = [];

        /** @var ProviderHotelPrice $providerPrice */
        foreach ($providerHotelResultSet->prices as $providerPrice) {
            $disneyPrice = self::getMatchingDisneyPrice($disneyHotelResultSet, $providerPrice->id)->price;

            if ($disneyPrice <= $providerPrice->price) {
                $providerPrice->price += self::MIN_SURCHARGE;
            } else {
                $priceDifference = $disneyPrice - $providerPrice->price;

                if ($priceDifference <= self::MIN_SURCHARGE) {
                    $providerPrice->price += self::MIN_SURCHARGE;
                } else if ($priceDifference <= 50) {
                    $providerPrice->price += max(self::MIN_SURCHARGE, $priceDifference / 2);
                } else {
                    $providerPrice->price = $disneyPrice - 50;
                }
            }

            $updatedPrices[] = $providerPrice;
        }

        return new ProviderHotelResultSet($updatedPrices);
    }

    private function getMatchingDisneyPrice(DisneyHotelResultSet $disneyHotelResultSet, string $id): ?DisneyHotelPrice
    {
        /** @var DisneyHotelPrice $disneyPrice */
        foreach ($disneyHotelResultSet->prices as $disneyPrice) {
            if ($disneyPrice->id === $id) {
                return $disneyPrice;
            }
        }
        return null;
    }
}
