@include('layout/header')

<main>
    <section class="promo section">
        <div class="container">
            <div class="container d-xl-flex align-items-center justify-content-between">
                <div class="promo_info">
                    <h2 class="info_header aos-init aos-animate" data-aos="fade-up">{{ __('Howdy!') }}</h2>
                    <p class="info_text aos-init aos-animate" data-aos="fade-up" data-aos-delay="50">
                        {{ __("Dreaming of that Disney holiday? Whether it's your first or one of many visits, at allearstravel.co.uk we pride ourselves in unparalleled expert knowledge of the Disney parks and hotels!") }}
                    </p>
                    <p class="info_text aos-init">
                        {{ __('We provide self-service options through our modern online portal or you can pick one of our consultants to help you build an unforgettable itinerary.') }}
                    </p>
                    <p class="info_text aos-init" style="max-width: 75%">
                        {{ __("Going for the first time? We can help you figuring out character meets, rides, parades and shows - and we also help with dining reservations and dietary questions and requirements.") }}
                    </p>
                    <p class="info_text aos-init" style="max-width: 75%">
                        {{ __("Ready to start planning your holiday? Click the button below to get started!") }}
                    </p>
                    <p>
                        <a class="theme-element theme-element--accent btn" href="/start">{{ __("Let's go!") }}</a>
                    </p>
                </div>
                <div class="promo_media aos-init">
                    <picture>
                        <source data-srcset="{{ asset('/img/welcome.jpg') }}" srcset="{{ asset('/img/welcome.jpg') }}">
                        <img class="lazy entered loaded" data-src="{{ asset('/img/welcome.jpg') }}" src="{{ asset('/img/welcome.jpg') }}" alt="media" data-ll-status="loaded">
                    </picture>
                    <div class="media_card media_card--top aos-init aos-animate" data-aos="fade-left">
                        <h4 class="media_card-text">{{ __('Flexible Payments') }}</h4>
                        <div class="media_card-footer d-flex align-items-center">
                            {{ __('Just pay a small deposit and then pay the rest at your own pace through our self-service portal.') }}
                        </div>
                    </div>
                    <div class="media_card media_card--bottom aos-init aos-animate" data-aos="fade-right">
                        <h4 class="media_card-text">{{ __('No Deposit') }}</h4>
                        <div class="media_card-footer d-flex align-items-center">
                            {{ __('We offer a number of hotel options without required deposit.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="latest section section--blockbg">
        <div class="container">
            <div class="latest_header d-sm-flex justify-content-between align-items-center">
                <h2 class="latest_header-title aos-init aos-animate" data-aos="fade-right">{{ __('Where are you going next?') }}</h2>
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
</main>

@include('layout/footer')
