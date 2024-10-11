<?php

namespace App\Services\Internal;

use App\Data\DisneyHotelPrice;
use App\Data\DisneyHotelResultSet;
use App\Services\RateHawk\Responses\SearchHotelByRegionResponse;

class DynamicPricingService
{
    private const MIN_SURCHARGE = 10;
    private const MAX_ABSOLUTE_DISCOUNT = 50;

    public function getPricesForProvider(
        DisneyHotelResultSet $disneyHotelResultSet,
        SearchHotelByRegionResponse $providerHotelResultSet
    ): SearchHotelByRegionResponse {

        foreach ($providerHotelResultSet->hotels as $providerHotel) {
            $disneyPrice = self::getMatchingDisneyPrice($disneyHotelResultSet, $providerHotel->id)?->price;

            if (!$disneyPrice) {
                continue;
            }

            foreach ($providerHotel->rates as $rate) {
                $rate->setDisneyPrice($disneyPrice);

                if ($disneyPrice <= $rate->getLowestPrice()) {
                    $rate->setFinalPrice(
                        $rate->getLowestPrice() + self::MIN_SURCHARGE
                    );
                } else {
                    $priceDifference = $disneyPrice - $rate->getLowestPrice();

                    if ($priceDifference <= self::MIN_SURCHARGE) {
                        $rate->setFinalPrice(
                            $rate->getLowestPrice() + self::MIN_SURCHARGE
                        );
                    } else if ($priceDifference <= 50) {
                        $rate->setFinalPrice(
                            $rate->getLowestPrice() + max(self::MIN_SURCHARGE, $priceDifference / 2)
                        );
                    } else {
                        $rate->setFinalPrice(
                            // $disneyPrice - self::MAX_ABSOLUTE_DISCOUNT
                            $rate->getLowestPrice() + self::MAX_ABSOLUTE_DISCOUNT
                        );
                    }
                }
            }
        }

        return $providerHotelResultSet;
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
