@include('layout/header')

<header class="page">
    <div class="container">
        <h1 class="page_title">Parks &amp; Resorts</h1>
    </div>
</header>
<main>
    <div id="wizard">
        <h3 class="swiper-slide-invisible-blank"></h3>
        <section class="latest section section--blockbg">
            <div class="container">

                <ul class="latest_list d-md-flex flex-wrap">
                    <li class="latest_list-item col-md-6 col-xl-4 aos-init aos-animate p-2" data-order="1" data-aos="fade-up">
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
                    <li class="latest_list-item col-md-6 col-xl-4 aos-init aos-animate p-2" data-order="2" data-aos="fade-up" data-aos-delay="50">
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
                    <li class="latest_list-item col-md-6 col-xl-4 aos-init aos-animate p-2" data-order="3" data-aos="fade-up" data-aos-delay="100">
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
                    <li class="latest_list-item col-md-6 col-xl-4 aos-init aos-animate p-2" data-order="3" data-aos="fade-up" data-aos-delay="100">
                        <div class="item-wrapper d-md-flex flex-column">
                            <div class="media">
                                <a href="/destination/tokyo">
                                    <picture>
                                        <source data-srcset="/img/tokyo.png" srcset="/img/tokyo.png">
                                        <img class="lazy entered loaded" data-src="/img/tokyo.png" src="/img/tokyo.png" alt="media" data-ll-status="loaded">
                                    </picture>
                                </a>
                                <span class="media_label media_label--left"> Disneyland Tokyo</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</main>

@include('layout/footer')
