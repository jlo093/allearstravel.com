<?php

namespace App\Services\Internal;

use App\Services\RateHawk\Responses\SearchHotelByRegionResponse;

class StaticPricingService
{
    public function applyStaticPricing(SearchHotelByRegionResponse $providerResponse): SearchHotelByRegionResponse
    {
        foreach ($providerResponse->hotels as $hotel) {
            $hotel->rates[0]->final_price = $hotel->rates[0]->payment_options->payment_types[0]->amount;
        }
        return $providerResponse;
    }
}
