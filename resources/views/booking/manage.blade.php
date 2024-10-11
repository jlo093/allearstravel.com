@include('layout/header')

<header class="page">
    <div class="container">
        <h1 class="page_title">{{ __('Manage Booking - Order') }} {{ $order->reference }}</h1>
    </div>
</header>
<main class="rooms section">
    <div class="container">
        <h3 class="mb-3">{{ __('Summary') }}</h3>
        <p class="mb-2">{{ __(
            'Thank you for booking with us!'
            ) }} {{ sprintf(__('Your order is %s.'), \App\Enums\OrderStateEnum::getDescription($order->state)) }}</p>
        @if ($financials['money_owed'] > 0)
            <p class="mb-2">
                <strong>
                {{ sprintf(__('There is an open balance of %d GBP.'), $financials['money_owed'] - $financials['money_paid'], $financials['money_owed']) }}
                </strong>
            </p>
        @endif
        <h3 class="mb-3 mt-5">{{ __('Bookings') }}</h3>
        <p>{{ __('Your order currently consists of the following bookings:') }}</p>
        @foreach ($pending_bookings as $booking)
        <div class="order-booking mb-5 mt-5">
            <span class="badge-pending">{{ strtoupper(__('Status: Pending')) }}</span>

            @if ($booking->type == 'hotel')
                <p class="mt-2">
                    <b>{{ $booking->hotel->name }}</b><br>
                    {{ $booking->detail }}
                </p>
                <p class="mt-3">
                    <strong>{{ __('Occupancy') }}</strong>: {{ $booking->adults }} {{ __('adults') }}, {{ $booking->children }} {{ __('children') }}
                </p>
                <p class="mt-3">
                    <strong>{{ __('Check-in') }}</strong>: {{ $booking->start_date->format('d/m/Y') }}<br>
                    <strong>{{ __('Check-out') }}</strong>: {{ $booking->end_date->format('d/m/Y') }}
                </p>
                @if ($booking->free_cancellation_deadline->isToday() || $booking->free_cancellation_deadline->isFuture())
                    <p class="mt-3">You can cancel this booking for free until <strong>{{ $booking->free_cancellation_deadline->format('d/m/Y') }}</strong>. Please <a href="">contact us</a> to action this.</p>
                @endif

                <p class="mt-3">{{ __('We will provide you with a confirmation number once the booking has been confirmed (i.e. to use within Disney app).') }}</p>

                @if ($booking->start_date->isFuture() && $booking->free_cancellation_deadline->isPast())
                    <p class="mt-3">{{ __('You can cancel this booking, but since the deadline for free cancellation has passed, cancellation fees will apply. Please contact us for more information.') }}</p>
                @endif
                <p class="mt-3"><strong>{{ __('Price incl. VAT') }}</strong>: {{ $booking->price_gross }} GBP</p>
            @elseif ($booking->type == 'ticket')

            @endif
        </div>
        @endforeach

        @foreach ($confirmed_bookings as $booking)
            <div class="order-booking mb-5 mt-5">
                <span class="badge-confirmed">{{ strtoupper(__('Status: Confirmed')) }}</span>

                @if ($booking->type == 'hotel')
                    <p class="mt-2">
                        <b>{{ $booking->hotel->name }}</b><br>
                        {{ $booking->detail }}
                    </p>
                    <p class="mt-3">
                        <strong>{{ __('Occupancy') }}</strong>: {{ $booking->adults }} {{ __('adults') }}, {{ $booking->children }} {{ __('children') }}
                    </p>
                    <p class="mt-3">
                        <strong>{{ __('Check-in') }}</strong>: {{ $booking->start_date->format('d/m/Y') }}<br>
                        <strong>{{ __('Check-out') }}</strong>: {{ $booking->end_date->format('d/m/Y') }}
                    </p>
                    @if ($booking->free_cancellation_deadline->isToday() || $booking->free_cancellation_deadline->isFuture())
                        <p class="mt-3">You can cancel this booking for free until <strong>{{ $booking->free_cancellation_deadline->format('d/m/Y') }}</strong>. Please <a href="">contact us</a> to action this.</p>
                    @endif

                    <p class="mt-3">{{ __('We will provide you with a confirmation number once the booking has been confirmed (i.e. to use within Disney app).') }}</p>

                    @if ($booking->start_date->isFuture() && $booking->free_cancellation_deadline->isPast())
                        <p class="mt-3">{{ __('You can cancel this booking, but since the deadline for free cancellation has passed, cancellation fees will apply. Please contact us for more information.') }}</p>
                    @endif
                    <p class="mt-3"><strong>{{ __('Price incl. VAT') }}</strong>: {{ $booking->price_gross }} GBP</p>
                @elseif ($booking->type == 'ticket')

                @endif
            </div>
        @endforeach
    </div>
</main>

@include('layout/footer')
