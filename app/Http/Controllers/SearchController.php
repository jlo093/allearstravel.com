<?php

namespace App\Http\Controllers;

use App\Domain\Offers\OfferDetermination;
use App\Domain\Orders\OrderState;
use App\Enums\RegionEnum;
use App\Http\Requests\SearchHotelsRequest;
use App\Models\Hotel;
use App\Models\Order;
use App\Services\Disney\DisneyWebscraper;
use App\Services\Internal\DynamicPricingService;
use App\Services\Internal\StaticPricingService;
use App\Services\RateHawk\API as RateHawkAPI;
use App\Services\RateHawk\Requests\SearchHotelByRegionRequest;
use App\Services\RateHawk\Responses\SearchHotelByRegionResponse;
use Carbon\Carbon;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __construct(
        private readonly RateHawkAPI           $rateHawkAPI,
        private readonly DynamicPricingService $pricingService,
        private readonly StaticPricingService  $staticPricingService,
        private readonly DisneyWebscraper      $disneyAPI,
        private readonly OrderState            $orderState,
        private readonly OfferDetermination    $offerDetermination,
    ) {}

    public function splash(): View
    {
        return view('search.splash', []);
    }

    public function hotels(SearchHotelsRequest $request): View
    {
        $data = $request->validated();

        $region = RegionEnum::getRegionEnumById($data['region_id'] ?? RegionEnum::DISNEYLAND_PARIS);

        $checkin = Carbon::createFromFormat('d/m/Y', $data['checkin']);
        $checkout = Carbon::createFromFormat('d/m/Y', $data['checkout']);

        if ($this->orderState->requestRelatesToCurrentOrder($request)) {
            $order = Order::where('reference', $this->orderState->getCustomerOrderPNR())->first();
        } else {
            $order = $this->orderState->createOrder($request);

            $apiRequest = new SearchHotelByRegionRequest(
                $region,
                $checkin,
                $checkout,
                $data['adults'],
                $data['children']
            );

            /** @var SearchHotelByRegionResponse $providerResponse */
            $providerResponse = $this->rateHawkAPI->send($apiRequest);

            if (RegionEnum::doesRegionSupportDynamicPricing($region)) {
                $providerResponse = $this->applyDynamicPricing($providerResponse, $region, $data);
            } else {
                $providerResponse = $this->staticPricingService->applyStaticPricing($providerResponse);
            }

            // TODO: Load as a whole when building DTO, not one by one
            foreach ($providerResponse->hotels as $hotel) {
                $hotel->hotel = Hotel::where('ratehawk_id', $hotel->id)->first();
            }

            usort($providerResponse->hotels, function (
                \App\Services\RateHawk\Responses\DTO\Hotel $a,
                \App\Services\RateHawk\Responses\DTO\Hotel $b) {
                return $a->getBestRate()->final_price > $b->getBestRate()->final_price;
            });

            $this->orderState->storeRates($providerResponse->hotels);
            $this->orderState->storeRequestData($data);
        }

        return view('search.result', [
            'hotels' => $this->orderState->getStoredRates(),
            'nights' => $checkout->diffInDays($checkin),
            'checkin' => $checkin,
            'checkout' => $checkout,
            'adults' => $data['adults'],
            'children' => $data['children'],
            'order' => $order,
            'offers' => $this->offerDetermination
        ]);
    }

    public function rates(string $id, string $hotel): View
    {
        $selectedHotel = null;

        $orderRates = $this->orderState->getStoredRates();
        /** @var $orderRate \App\Services\RateHawk\Responses\DTO\Hotel */
        foreach ($orderRates as $orderRate) {
            if ($orderRate->id === $hotel) {
                $selectedHotel = $orderRate;
            }
        }

        return view('search.rates', [
            'hotel' => $selectedHotel,
            'pnr' => $this->orderState->getCustomerOrderPNR()
        ]);
    }

    private function applyDynamicPricing(
        SearchHotelByRegionResponse $response,
        RegionEnum $region,
        array $data
    ): SearchHotelByRegionResponse {
        $disneyResponse = $this->disneyAPI->getPricesForDates(
            Carbon::createFromFormat('d/m/Y', $data['checkin']),
            Carbon::createFromFormat('d/m/Y', $data['checkout']),
            $data['adults'] ?? 2,
            $data['children'] ?? 0,
            $region
        );

        return $this->pricingService->getPricesForProvider($disneyResponse, $response);
    }
}
