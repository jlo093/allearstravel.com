@include('layout/header')

<header class="page">
    <div class="container">
        <h1 class="page_title"></h1>
    </div>
</header>
<main>
    <div id="wizard">
        <h3 class="swiper-slide-invisible-blank"></h3>
        <section class="latest section section--blockbg">
            <div class="container">
                <div class="latest_header d-sm-flex justify-content-between align-items-center">
                    <h2 class="latest_header-title aos-init aos-animate" data-aos="fade-right">{{ __('Where are you going?') }}</h2>
                </div>
                <ul class="latest_list d-md-flex flex-wrap">
                    <li class="latest_list-item col-md-6 col-xl-4 aos-init aos-animate" data-order="1" data-aos="fade-up">
                        <div class="item-wrapper d-md-flex flex-column">
                            <div class="media">
                                <a href="/destination/paris">
                                    <picture>
                                        <source data-srcset="/img/search-bg.jpg" srcset="/img/search-bg.jpg">
                                        <img class="lazy entered loaded" data-src="/img/search-bg.jpg" src="/img/search-bg.jpg" alt="media" data-ll-status="loaded">
                                    </picture>
                                </a>
                                <span class="media_label media_label--left"> Disneyland Paris </span>
                            </div>
                        </div>
                    </li>
                    <li class="latest_list-item col-md-6 col-xl-4 aos-init aos-animate" data-order="2" data-aos="fade-up" data-aos-delay="50">
                        <div class="item-wrapper d-md-flex flex-column">
                            <div class="media">
                                <a href="/destination/orlando">
                                    <picture>
                                        <source data-srcset="/img/orlando.jpg" srcset="/img/orlando.jpg">
                                        <img class="lazy entered loaded" data-src="/img/orlando.jpg" src="/img/orlando.jpg" alt="media" data-ll-status="loaded">
                                    </picture>
                                </a>
                                <span class="media_label media_label--left"> Disney World (Orlando) </span>
                            </div>
                        </div>
                    </li>
                    <li class="latest_list-item col-md-6 col-xl-4 aos-init aos-animate" data-order="3" data-aos="fade-up" data-aos-delay="100">
                        <div class="item-wrapper d-md-flex flex-column">
                            <div class="media">
                                <a href="/destination/anaheim">
                                    <picture>
                                        <source data-srcset="/img/anaheim.jpg" srcset="/img/anaheim.jpg">
                                        <img class="lazy entered loaded" data-src="/img/anaheim.jpg" src="/img/anaheim.jpg" alt="media" data-ll-status="loaded">
                                    </picture>
                                </a>
                                <span class="media_label media_label--left"> Disneyland Resort (Anaheim) </span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <h3 class="swiper-slide-invisible-blank"></h3>
        <section class="latest section section--blockbg">
            <div class="container">
                <div class="latest_header d-sm-flex justify-content-between align-items-center">
                    <h2 class="latest_header-title aos-init aos-animate" data-aos="fade-right">{{ __('What would you like to book?') }}</h2>
                </div>
                <p>{{ __('Please select all that apply. You can still change your selection later on.') }}</p>
                <div class="mt-3 mb-3">
                    <div class="departure-airport-badge">
                        <input type="checkbox" value="hotel" name="elements" class="" id="elements_hotel" />
                        <label for="elements_hotel">Hotel</label>
                    </div>
                    <div class="departure-airport-badge">
                        <input type="checkbox" value="flights" name="elements" class="" id="elements_flights" />
                        <label for="elements_flights">Flights</label>
                    </div>
                    <div class="departure-airport-badge">
                        <input type="checkbox" value="tickets" name="elements" class="" id="elements_tickets" />
                        <label for="elements_tickets">Tickets</label>
                    </div>
                </div>
            </div>
        </section>

        <h3 class="swiper-slide-invisible-blank"></h3>
        <section class="latest section section--blockbg">
            <div class="container">
                <div class="latest_header d-sm-flex justify-content-between align-items-center">
                    <h2 class="latest_header-title aos-init aos-animate" data-aos="fade-right">{{ __('Where do you want to fly from?') }}</h2>
                </div>
                <h4>Scotland</h4>
                <div class="mt-3 mb-3">
                    <div class="departure-airport-badge">
                        <input type="radio" value="EDI" name="departureAirport" class="" id="ap_edinburgh" />
                        <label for="ap_edinburgh">Edinburgh</label>
                    </div>
                    <div class="departure-airport-badge">
                        <input type="radio" value="GLA" name="departureAirport" class="" id="ap_glasgow" />
                        <label for="ap_glasgow">Glasgow</label>
                    </div>
                    <div class="departure-airport-badge">
                        <input type="radio" value="INV" name="departureAirport" class="" id="ap_inverness" />
                        <label for="ap_inverness">Inverness</label>
                    </div>
                </div>

                <h4>England</h4>
                <div class="mt-3 mb-3">
                    <div class="departure-airport-badge">
                        <input type="radio" value="BHX" name="departureAirport" class="" id="ap_birmingham" />
                        <label for="ap_birmingham">Birmingham</label>
                    </div>
                    <div class="departure-airport-badge">
                        <input type="radio" value="BRS" name="departureAirport" class="" id="ap_bristol" />
                        <label for="ap_bristol">Bristol</label>
                    </div>
                    <div class="departure-airport-badge">
                        <input type="radio" value="EMA" name="departureAirport" class="" id="ap_midlands" />
                        <label for="ap_midlands">East Midlands</label>
                    </div>
                    <div class="departure-airport-badge">
                        <input type="radio" value="LBA" name="departureAirport" class="" id="ap_leeds" />
                        <label for="ap_leeds">Leeds</label>
                    </div>
                    <div class="departure-airport-badge">
                        <input type="radio" value="LPL" name="departureAirport" class="" id="ap_liverpool" />
                        <label for="ap_liverpool">Liverpool</label>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="departure-airport-badge">
                        <input type="radio" value="LON" name="departureAirport" class="" id="ap_london" />
                        <label for="ap_london">London</label>
                    </div>
                    <div class="departure-airport-badge">
                        <input type="radio" value="MAN" name="departureAirport" class="" id="ap_manchester" />
                        <label for="ap_manchester">Manchester</label>
                    </div>
                    <div class="departure-airport-badge">
                        <input type="radio" value="NCL" name="departureAirport" class="" id="ap_newcastle" />
                        <label for="ap_newcastle">Newcastle</label>
                    </div>
                </div>

                <h4>Northern Ireland</h4>
                <div class="mt-3 mb-3">
                    <div class="departure-airport-badge">
                        <input type="radio" value="BFS" name="departureAirport" class="" id="ap_belfast" />
                        <label for="ap_belfast">Belfast</label>
                    </div>
                </div>
            </div>
        </section>

        <h3 class="swiper-slide-invisible-blank"></h3>
        <section class="latest section section--blockbg">
            <div class="container">
                <div class="latest_header d-sm-flex justify-content-between align-items-center">
                    <h2 class="latest_header-title aos-init aos-animate" data-aos="fade-right">{{ __('Who is travelling?') }}</h2>
                </div>
            </div>
        </section>
    </div>
</main>
<!--
 -- Which park (little cards, selectable, highlighted)

    -- Which dates (start and end date, flexibility)
    -- Which participants (adults, children)
        -- Children ages
    -- Which planning option, self service or consultant?
!-->
<script>
    $(function ()
    {
        $("#wizard").steps({
            headerTag: "h3",
            bodyTag: "section",
            actionContainerTag: "div",
            transitionEffect: "slideLeft"
        });
    });
</script>

@include('layout/footer')
