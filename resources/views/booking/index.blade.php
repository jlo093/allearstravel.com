@include('layout/header')

<section class="hero section">
    <div class="container container--hero d-lg-flex align-items-center justify-content-between">
        <div class="hero_main">
            <h1 class="hero_main-title" data-aos="fade-up">{{ __('Manage Booking') }}</h1>
            <div class="hero_main-content d-flex">
                <span class="line" data-aos="fade-up" data-aos-delay="50"></span>
                <p class="text" data-aos="fade-up" data-aos-delay="100">
                    {{ __('You can use our self-service portal to make payments and request amendments to your booking. Please enter your order reference and surname to proceed.') }}
                </p>
            </div>
            @if (!empty(session()->get('message')))
                <p style="width: 100%;padding: 5px 0 5px 15px;border-left: 3px solid red;margin-bottom:25px;">{{ session()->get('message') }}</p>
            @endif
            <form class="booking" action="{{ route('booking.manage') }}" method="post" autocomplete="off" data-aos="fade-up" id="booking-form">
                @csrf

                <div class="item-wrapper d-sm-flex flex-wrap flex-lg-nowrap align-items-lg-center">
                    <div class="booking_group d-flex flex-column">
                        <label class="booking_group-label h5" for="pnr">{{ __('Order Reference') }}:</label>
                        <div class="booking_group-wrapper">
                            <input
                                class="booking_group-field field required"
                                type="text"
                                id="pnr"
                                name="pnr"
                                value=""
                                style="padding-left:0;"
                            />
                        </div>
                    </div>
                    <div class="booking_group d-flex flex-column">
                        <label class="booking_group-label h5" for="surname">{{ __('E-Mail') }}:</label>
                        <div class="booking_group-wrapper">
                            <input
                                class="booking_group-field field required"
                                type="text"
                                id="surname"
                                name="surname"
                                value=""
                                style="padding-left:0;"
                            />
                        </div>
                    </div>
                    <div class="booking_group d-flex flex-column">
                    </div>
                    <button class="booking_btn btn theme-element theme-element--accent" type="submit" onclick="this.form.submit()">Manage</button>
                </div>
            </form>
        </div>
        <div class="hero_media" data-aos="zoom-in">
            <picture>
                <source data-srcset="/img/welcome.jpg" srcset="/img/welcome.jpg" />
                <img class="lazy" data-src="/img/welcome.jpg" src="/img/welcome.jpg" alt="media" />
            </picture>
        </div>
    </div>
</section>

@include('layout/footer')
