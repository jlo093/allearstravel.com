<?php

namespace Tests\Unit;

use App\Data\DisneyHotelPrice;
use App\Data\DisneyHotelResultSet;
use App\Data\ProviderHotelPrice;
use App\Data\ProviderHotelResultSet;
use App\Services\Internal\PricingService;
use PHPUnit\Framework\TestCase;

class PricingServiceTest extends TestCase
{
    public function test_pricing_model(): void
    {
        $this->assertEquals(1480, $this->setupPricingAndGetResult(1500, 1460));
        $this->assertEquals(1450, $this->setupPricingAndGetResult(1500, 1400));
        $this->assertEquals(1520, $this->setupPricingAndGetResult(1500, 1510));
        $this->assertEquals(2350, $this->setupPricingAndGetResult(2400, 2100));
    }

    private function setupPricingAndGetResult($disney, $provider): float
    {
        $pricingService = new PricingService();

        $disneyPrice = new DisneyHotelPrice($disney, 'fort-wilderness');
        $disneyPriceSet = new DisneyHotelResultSet([$disneyPrice]);

        $hotelPrice = new ProviderHotelPrice($provider, 'fort-wilderness');
        $hotelPriceSet = new ProviderHotelResultSet([$hotelPrice]);

        return $pricingService->getPricesForProvider($disneyPriceSet, $hotelPriceSet)->prices[0]->price;
    }
}
