<?php

namespace App\Services\Disney;

use App\Data\DisneyHotelPrice;
use App\Data\DisneyHotelResultSet;
use App\Enums\DisneyHotelEnum;
use App\Enums\RegionEnum;
use Carbon\Carbon;
use DOMElement;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Symfony\Component\DomCrawler\Crawler;

class DisneyWebscraper
{
    const PRICING_ENDPOINT = 'https://www.disneyholidays.co.uk/walt-disney-world/book/handshake/';

    public function __construct(
        private readonly Client $client,
        private readonly DisneyHotelEnum $disneyHotelEnum
    ) {}

    public function getPricesForDates(
        Carbon $startDate,
        Carbon $endDate,
        int $adults,
        int $children,
        RegionEnum $region,
    ): DisneyHotelResultSet {
        $priceResults = [];

        $groupCrawler = new Crawler(
            $this->getDisneyPricingHTML($startDate, $endDate, $adults, $children),
            self::PRICING_ENDPOINT
        );

        $groupCrawler = $groupCrawler->filter('div.accommodation');
        /** @var DOMElement $group */
        foreach ($groupCrawler->getIterator() as $group) {
            $itemCrawler = new Crawler($group, self::PRICING_ENDPOINT);

            $hotelName = $itemCrawler->filter('h2')->getNode(0)->textContent;
            $hotelPriceInfo = str_replace(
                ['£', ',', 'GBP'],
                ['', '', ''],
                $itemCrawler->filter('h3')->getNode(0)->textContent
            );

            $priceResults[] = new DisneyHotelPrice(
                $hotelPriceInfo,
                $this->disneyHotelEnum->identifyByName($hotelName)
            );
        }

        return new DisneyHotelResultSet($priceResults);
    }

    private function getDisneyPricingHTML(Carbon $startDate, Carbon $endDate, int $adults, int $children): string
    {
        $query = [
            'arrivalDate' => $startDate->format('Y-m-d'),
            'departureDate' => $endDate->format('Y-m-d'),
            'planType' => 'RO',
            'adults' => $adults,
            'children' => $children,
            'shopFor' => 'hotelOnly',
            'cssClass' => 'tier-header',
            'pageLocation' => '',
            'offer' => '',
        ];

        $request = new Request('GET', self::PRICING_ENDPOINT . '?' . http_build_query($query));
        $res = $this->client->send($request, [
            RequestOptions::COOKIES => new CookieJar(),
        ]);
        return $res->getBody();
    }
}
