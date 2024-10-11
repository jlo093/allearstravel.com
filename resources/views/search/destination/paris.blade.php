@include('layout/header')

<section class="hero section">
    <div class="container container--hero d-lg-flex align-items-center justify-content-between">
        <div class="hero_main">
            <h1 class="hero_main-title" data-aos="fade-up">Disneyland Paris</h1>
            <div class="hero_main-content d-flex">
                <span class="line" data-aos="fade-up" data-aos-delay="50"></span>
                <p class="text" data-aos="fade-up" data-aos-delay="100">
                    Our current offering is limited to hotels and tickets. We are working hard on adding flights and ground transport, so that you can book your whole holiday in a single transaction.
                </p>
            </div>
            <form class="booking" action="{{ route('search.index') }}" method="post" autocomplete="off" data-aos="fade-up" id="booking-form">
                @csrf

                <input type="hidden" value="{{ \App\Enums\RegionEnum::DISNEYLAND_PARIS->value }}" name="region_id" />

                <div class="item-wrapper d-sm-flex flex-wrap flex-lg-nowrap align-items-lg-center">
                    <div class="booking_group d-flex flex-column">
                        <label class="booking_group-label h5" for="checkIn">Check-in</label>
                        <div class="booking_group-wrapper">
                            <i class="icon-calendar icon"></i>
                            <input
                                class="booking_group-field field required"
                                data-type="date"
                                data-start="true"
                                type="text"
                                id="checkIn"
                                name="checkin"
                                value="Add date"
                                readonly
                            />
                            <i class="icon-chevron_down icon"></i>
                        </div>
                    </div>
                    <div class="booking_group d-flex flex-column">
                        <label class="booking_group-label h5" for="checkOut">Check-out</label>
                        <div class="booking_group-wrapper">
                            <i class="icon-calendar icon"></i>
                            <input
                                class="booking_group-field field required"
                                data-type="date"
                                data-end="true"
                                type="text"
                                id="checkOut"
                                name="checkout"
                                value="Add date"
                                readonly
                            />
                            <i class="icon-chevron_down icon"></i>
                        </div>
                    </div>
                    <div class="booking_group d-flex flex-column">
                        <span class="booking_group-label h5">Guests</span>
                        <div class="booking_group-wrapper booking_group-wrapper--guests">
                            <i class="icon-user icon"></i>
                            <div
                                class="booking_group-field dropdown-toggle"
                                role="presentation"
                                id="guests"
                                data-bs-toggle="collapse"
                                data-bs-target="#bookingDropdown"
                            ></div>
                            <div class="booking_group-dropdown collapse" id="bookingDropdown">
                                <div class="content">
                                    <div
                                        class="booking_group-dropdown_wrapper d-flex align-items-center justify-content-between"
                                    >
                                        <label class="label h5" for="adults">Adults</label>
                                        <div class="main d-flex align-items-center justify-content-between">
                                            <a
                                                class="qty_minus qty-changer d-flex align-items-center justify-content-center"
                                                href="#"
                                                data-disabled="true"
                                            ></a>
                                            <input class="field required" id="adults" name="adults" type="text" value="1" />
                                            <a
                                                class="qty_plus qty-changer d-flex align-items-center justify-content-center"
                                                href="#"
                                                data-disabled=""
                                            >+</a
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="booking_group-dropdown_wrapper d-flex align-items-center justify-content-between"
                                    >
                                        <label class="label h5" for="children">Children</label>
                                        <div class="main d-flex align-items-center justify-content-between">
                                            <a
                                                class="qty_minus qty-changer d-flex align-items-center justify-content-center"
                                                href="#"
                                                data-disabled=""
                                            ></a>
                                            <input class="field required" id="children" name="children" type="text" value="0" />
                                            <a
                                                class="qty_plus qty-changer d-flex align-items-center justify-content-center"
                                                href="#"
                                                data-disabled=""
                                            >+</a
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="booking_btn btn theme-element theme-element--accent" type="submit" onclick="this.form.submit()">Search</button>
                </div>
            </form>
        </div>
        <div class="hero_media" data-aos="zoom-in">
            <picture>
                <source data-srcset="/img/search-bg.jpg" srcset="/img/search-bg.jpg" />
                <img class="lazy" data-src="/img/search-bg.jpg" src="/img/search-bg.jpg" alt="media" />
            </picture>
        </div>
    </div>
</section>

@include('layout/footer')
