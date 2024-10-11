@include('layout/header')

<header class="page">
    <div class="container">
        <h1 class="page_title">{{ __('Checkout') }}</h1>
    </div>
</header>
<main class="rooms section">
    <form action="{{ route('booking.payment') }}" method="post">
        @csrf
    <div class="container">
        <h3 class="mb-3">{{ __('Order Summary') }}</h3>
        <p class="mb-2">You are booking:</p>

        @foreach($bookings as $booking)
            <div class="mb-4" style="background:#fff8f2;padding: 5px 0 20px 20px;border-radius: 5px;border: 1px solid #cb7928;">
            <h4 class="mt-3">{{ $booking->hotel->name }}</h4>
            <p class="mb-1">
                {{ $booking->start_date->format('l jS F Y') }} - {{ $booking->end_date->format('l jS F Y') }} ({{ $booking->end_date->diffInDays($booking->start_date) }} {{ __('nights') }})<br>
                {{ $booking->detail }}<br><br>

                @if ($booking->has_free_cancellation)
                {{ __('You can cancel for free until ') }} {{ $booking->free_cancellation_deadline->format('l jS F Y') }} {{ __('to receive a full refund of all payments made.') }}<br>
                @endif
            </p>
            @php $offers = $offerDetermination->getOffersApplicableToRate($booking->rate()); @endphp
            @if (!empty($offers))
            <h4 class="mt-3">{{ __('Special Offers') }}</h4>
            @endif
            @foreach ($offers as $offer)
                <p>
                    {{ $offer->description }}
                </p>
            @endforeach
            <h4 class="mt-3">&pound;{{ $booking->price_gross }} incl. VAT</h4>
            <p>Deposit of &pound;{{ $finance->getApplicableDeposit($booking) }} payable on confirmation.</p>
            </div>
        @endforeach

        <h3 class="mb-3">{{ __('Payment') }}</h3>
        <p>
            @if ($pricing->payableLater > 0)
                You need to pay &pound;{{ $pricing->payableToday }} today and &pound;{{ $pricing->payableLater }} at any time before {{ $booking->payment_deadline->format('l jS F Y') }}.
            @else
                You need to pay &pound;{{ $pricing->payableToday }} today.
            @endif
        </p>
        @if ($pricing->payableLater > 0)
        <p class="mt-3">What's your preferred payment option?</p>
        <ul style="margin-left: 30px">
            <li>
                <input type="radio" name="payment_mode" value="{{ \App\Enums\PaymentModeEnum::DEPOSIT_ONLY->value }}" required /> Pay deposit only and pay remaining balance before {{ $booking->payment_deadline->format('l jS F Y') }}.
            </li>
            <li>
                <input type="radio" name="payment_mode" value="{{ \App\Enums\PaymentModeEnum::FULL_BALANCE->value }}" required /> Pay the full balance today.
            </li>
        </ul>
        @endif
        <h3 class="mt-4">{{ __('Your Details') }}</h3>
        <input type="hidden" value="{{ $pnr }}" name="pnr" />

        <div class="field-wrapper m-3">
            <input class="field required" id="first_name" name="first_name" type="text" placeholder="Name">
            <input class="field required" id="surname" name="surname" type="text" placeholder="Surname">
        </div>
        <div class="field-wrapper m-3">
            <input class="field required" id="email" name="email" type="text" placeholder="E-Mail">
            <input class="field required" id="email_confirmation" name="email_confirmation" type="text" placeholder="Confirm E-Mail">
        </div>
        <div class="field-wrapper m-3">
            <input class="field required" id="mobile" name="mobile" type="text" placeholder="Mobile">
        </div>
        <h3>{{ __('Additional Details') }}</h3>
        @foreach ($bookings as $booking)
            @if ($booking->type === \App\Enums\BookingTypeEnum::HOTEL->value)
                <p>Please tell us who will be the lead guest staying at the {{ $booking->hotel->name }}:</p>
                <div class="field-wrapper m-3">
                    <input class="field required" id="lead_first_name_{{ $booking->id }}" name="lead_first_name_{{ $booking->id }}" type="text" placeholder="Lead Guest Name">
                    <input class="field required" id="lead_surname_{{ $booking->id }}" name="lead_surname_{{ $booking->id }}" type="text" placeholder="Lead Guest Surname">
                </div>
            @endif
        @endforeach

        <button class="theme-element theme-element--accent btn" type="submit" onclick="this.form.submit()">Continue to payment</button>
    </div>
    </form>
</main>

@include('layout/footer')
