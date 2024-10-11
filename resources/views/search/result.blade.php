@include('layout/header')

<header class="page">
    <div class="container">
        <ul class="breadcrumbs d-flex flex-wrap align-content-center">
            <li class="list-item">
                <a class="link" href="/">Home</a>
            </li>

            <li class="list-item">
                <a class="link" href="#">Hotels</a>
            </li>
        </ul>
        <h1 class="page_title">Hotels</h1>
    </div>
</header>
<main class="rooms section">
    <div class="container">
        <ul class="rooms_list">
            @foreach ($hotels as $hotel)
                @if (empty($hotel->rates[0]->final_price))
                    @continue
                @endif
            <li class="rooms_list-item mb-5" data-order="1" data-aos="fade-up">
                <div class="item-wrapper d-md-flex">
                    <div class="media" style="padding-top:20px;padding-left:20px;">
                        <picture>
                            <source data-srcset="{{ $hotel->hotel?->thumbnail() }}" srcset="{{ $hotel->hotel?->thumbnail() }}" />
                            <img class="lazy" style="border-radius:4px" data-src="{{ $hotel->hotel?->thumbnail() }}" src="{{ $hotel->hotel?->thumbnail() }}" alt="media" />
                        </picture>
                    </div>
                    <div class="main d-md-flex justify-content-between">
                        <div class="main_info d-md-flex flex-column justify-content-between">
                            <a class="main_title h4" href="{{ route('search.rates', ['id' => $order->reference, 'hotel' => $hotel->id]) }}">{{ $hotel->hotel?->name }}</a>
                            <span class="star-rating" style="margin-top:-15px">
                                @for ($x = 0; $x < $hotel->hotel?->stars; $x++)
                                    ⭐
                                @endfor
                            </span>
                            <p class="main_description">{{ $hotel->hotel?->description }}</p>
                            <div class="main_amenities">
                                @if (!empty($hotel->rates[0]->payment_options->payment_types[0]->cancellation_penalties['free_cancellation_before']))
                                <span class="main_amenities-item d-inline-flex align-items-center">
                                            <i class="icon-clock icon"></i>
                                            @php $date =$hotel->rates[0]->payment_options->payment_types[0]->cancellation_penalties['free_cancellation_before']; @endphp
                                            Free cancellation before {{ \Carbon\Carbon::createFromFormat('Y-m-d', substr($date, 0, 10))->format('d/m/Y') }}
                                        </span>
                                @endif
                            </div>
                            @foreach ($offers->getOffersApplicableToRate($hotel->rates[0]) as $offer)
                                <div class="main_amenities">
                                <span class="main_amenities-item d-inline-flex align-items-center">
                                            <i class="icon-star icon"></i>
                                            {{ $offer->description }}
                                        </span>
                                </div>
                            @endforeach
                        </div>
                        <div class="main_pricing d-flex flex-column align-items-md-end justify-content-md-between">
                            <div class="wrapper d-flex flex-column">
                                        <span class="main_pricing-item">
                                            from <span class="h2">&pound;{{ round($hotel->rates[0]->final_price) }}</span>
                                        </span>
                                @if ($hotel->rates[0]->disney_price > $hotel->rates[0]->final_price)
                                    <span class="mb-3" style="font-weight: bold; color: #00bb00;">
                                        &pound;{{ number_format($hotel->rates[0]->disney_price - $hotel->rates[0]->final_price, 2) }} saving vs. booking direct
                                    </span>
                                @endif
                                <span class="main_pricing-item">
                                            <span class="h4"></span>
                                            @php $region = \App\Enums\RegionEnum::getRegionEnumById($hotel->hotel?->region_id ?? \App\Enums\RegionEnum::DISNEY_WORLD->value); @endphp
                                            that is <strong>£{{ round($hotel->rates[0]->final_price / $nights) }}</strong> per night<br>
                                            @if (\App\Enums\RegionEnum::doesRegionRequireCityTaxCalculation($region))
                                                excl. city tax
                                            @else
                                                taxes included
                                            @endif
                                        </span>
                                <a class="theme-element theme-element--accent btn" href="{{ route('search.rates', ['id' => $order->reference, 'hotel' => $hotel->id]) }}" style="width:100%">See Rates</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</main>

@include('layout/footer')
