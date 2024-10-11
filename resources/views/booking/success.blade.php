@include('layout/header')

<header class="page">
    <div class="container">
        <h1 class="page_title">{{ __("Let's go to Disney!") }}</h1>
    </div>
</header>
<main class="rooms section">

    <div class="container">
        <h3 class="mb-3">{{ __('Your reservation is confirmed.') }}</h3>
        <p class="mb-3">Sit back and relax - we've got this. Your payment was received and your reservation was created in our system. You can now manage your booking using the <b>Manage Booking</b> button at the top of the page using order reference <b>{{ $order->reference }}</b>.</p>
        <p class="mb-3"><b>What happens next?</b><br>Within the next 24 hours we will send an email to <b>{{ $order->email }}</b> to confirm the reservation.</p>
        <p class="mb-3">Paid a deposit only? Please make sure to pay the remaining balance by the date stated in your reservation (no worries, we will send you the details via email) using the <b>Manage Booking</b> option on our website.</p>

    </div>
</main>

@include('layout/footer')
