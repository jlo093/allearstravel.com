<?php

namespace App\Domain\Orders;

use App\Helpers\PNR;
use App\Http\Requests\SearchHotelsRequest;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderState
{
    const SESSION_ORDER_MAPPING_KEY = 'currentOrderPNR';
    const SESSION_ORDER_HASH_KEY = 'currentOrderHash';
    const SESSION_ORDER_RATES_KEY = 'currentOrderRates.%s';
    const SESSION_REQUEST_DATA_KEY = 'currentRequestData.%s';

    public function requestRelatesToCurrentOrder(SearchHotelsRequest $request): bool
    {
        if ($request->getHash() === $this->getCustomerOrderHash()) {
            return !empty($this->getStoredRates());
        }
        return false;
    }

    public function customerHasOrder(): bool
    {
        return session()->has(self::SESSION_ORDER_MAPPING_KEY);
    }

    public function getCustomerOrderHash(): string
    {
        return session()->get(self::SESSION_ORDER_HASH_KEY) ?? '';
    }

    public function getCustomerOrderPNR(): string
    {
        return session()->get(self::SESSION_ORDER_MAPPING_KEY) ?? '';
    }

    public function createOrder(SearchHotelsRequest $request): Order
    {
        $pnr = PNR::create();

        $order = new Order();
        $order->state = 'open';
        $order->email = 'n/a';
        $order->reference = $pnr;
        $order->save();

        session()->put(self::SESSION_ORDER_MAPPING_KEY, $pnr);
        session()->put(self::SESSION_ORDER_HASH_KEY, $request->getHash());

        return $order;
    }

    public function storeRequestData(array $data): void
    {
        cache()->put(
            sprintf(self::SESSION_REQUEST_DATA_KEY, $this->getCustomerOrderPNR()),
            $data
        );
    }

    public function getRequestData(): array
    {
        return cache()->get(
            sprintf(self::SESSION_REQUEST_DATA_KEY, $this->getCustomerOrderPNR())
        ) ?? [];
    }

    public function storeRates(array $rates): void
    {
        cache()->put(
            sprintf(self::SESSION_ORDER_RATES_KEY, $this->getCustomerOrderPNR()),
            $rates
        );
    }

    public function getStoredRates(): array
    {
        return cache()->get(
            sprintf(self::SESSION_ORDER_RATES_KEY, $this->getCustomerOrderPNR())
        ) ?? [];
    }
}
