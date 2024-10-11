@include('layout/header')

<style>
    #slider {
        position: relative;
        overflow: hidden;
        margin: 20px auto 0 auto;
        border-radius: 4px;
    }

    #slider ul {
        position: relative;
        margin: 0;
        padding: 0;
        height: 200px;
        list-style: none;
    }

    #slider ul li {
        position: relative;
        display: block;
        float: left;
        margin: 0;
        padding: 0;
        width: 1200px;
        height: 600px;
        background: #ccc;
        text-align: center;
        line-height: 300px;
    }

    a.control_prev, a.control_next {
        position: absolute;
        top: 40%;
        z-index: 999;
        display: block;
        padding: 4% 3%;
        width: auto;
        height: auto;
        background: #2a2a2a;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-size: 18px;
        opacity: 0.8;
        cursor: pointer;
    }

    a.control_prev:hover, a.control_next:hover {
        opacity: 1;
        -webkit-transition: all 0.2s ease;
    }

    a.control_prev {
        border-radius: 0 2px 2px 0;
    }

    a.control_next {
        right: 0;
        border-radius: 2px 0 0 2px;
    }
</style>

@php
    /** @var \App\Models\Hotel $dbHotel */
    $dbHotel = \App\Models\Hotel::where('ratehawk_id', $hotel->id)->first();
@endphp

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
        <h1 class="page_title">{{ $dbHotel->name }}</h1>
    </div>
</header>

<main>
    <div class="room section" style="padding-top: 30px !important;">
        <div class="container">
            <div class="room_main d-lg-flex flex-wrap align-items-start">
                <div class="room_main-slider col-12 d-lg-flex">
                    <div id="slider">
                        <a href="#" class="control_next">></a>
                        <a href="#" class="control_prev"><</a>
                        <ul>
                            <li style="background-image: url('{{ $dbHotel->image(0) }}');background-size:cover;background-position:center;"></li>
                            <li style="background-image: url('{{ $dbHotel->image(1) }}');background-size:cover;background-position:center;"></li>
                            <li style="background-image: url('{{ $dbHotel->image(2) }}');background-size:cover;background-position:center;"></li>
                            <li style="background-image: url('{{ $dbHotel->image(3) }}');background-size:cover;background-position:center;"></li>
                            <li style="background-image: url('{{ $dbHotel->image(4) }}');background-size:cover;background-position:center;"></li>
                        </ul>
                    </div>
                </div>
                <div class="room_main-info col-lg-8">
                    <div class="amenities d-flex flex-wrap align-items-center">
                                <span class="amenities_item d-inline-flex align-items-center">
                                    <i class="icon-location icon"></i>
                                    {{ $dbHotel->address }}
                                </span>
                    </div>
                    <div class="description">
                        <p class="description_text">
                            {{ $dbHotel->description }}
                        </p>
                    </div>
                    @foreach ($dbHotel->getFormattedAmenities() as $category => $list)
                        <section class="facilities">
                            <h4 class="facilities_header">{{ $category }}</h4>
                            <div class="facilities_list d-sm-flex flex-wrap">
                                @foreach ($list as $item)
                                <div class="facilities_list-block">
                                        <span class="facilities_list-block_item d-flex align-items-center">
                                            <i class="icon-check icon"></i>
                                            {{ $item }}
                                        </span>
                                </div>
                                @endforeach
                            </div>
                        </section>
                    @endforeach
                    <section class="rules">
                        <h4 class="rules_header">Conditions</h4>
                        <div class="rules_list d-md-flex flex-lg-wrap">
                            <div>
                                <p class="rules_list-block_item d-flex align-items-baseline">
                                    <i class="icon-check icon"></i>
                                    Check-in from {{ $dbHotel->checkin_time }}
                                </p>
                                <p class="rules_list-block_item d-flex align-items-baseline">
                                    <i class="icon-check icon"></i>
                                    Check-out till {{ $dbHotel->checkout_time }}
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="room_main-cards col-lg-4">
                    <div class="room_main-cards_card accent">
                        <h3 class="title">What we love:</h3>
                        @foreach ($dbHotel->highlights as $highlight)
                            <p class="mb-3">
                                {{ $highlight->description }}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="rooms section--blockbg section">
        <div class="block"></div>
        <div class="container">
            <div class="rooms_header d-sm-flex justify-content-between align-items-center">
                <h2 class="rooms_header-title aos-init" data-aos="fade-right">{{ __('Available Rooms') }}</h2>
                <div class="wrapper aos-init" data-aos="fade-left">
                </div>
            </div>
            <ul class="rooms_list d-md-flex flex-wrap">
                @foreach($hotel->rates as $rate)
                <li class="rooms_list-item col-md-12 col-xl-12 mb-5 aos-init" data-order="1" data-aos="fade-up">
                    <div class="item-wrapper d-md-flex flex-wrap">
                        <div class="main d-md-flex flex-column justify-content-between flex-grow-1 col-8">
                            <a class="main_title h4" href="" style="max-width: none">{{ $rate->room_name }}</a>
                            &pound;{{ $rate->final_price }}
                        </div>
                        <div class="media col-4" style="height: 80px; text-align: center">
                            <a class="theme-element theme-element--accent btn" href="{{ route('booking.room', ['id' => $pnr, 'hash' => $rate->match_hash]) }}" style="max-width: 300px">
                                Make Reservation
                                <i class="icon-arrow_right icon"></i>
                            </a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>

</main>
<script>
    jQuery(document).ready(function ($) {

        var slideCount = $('#slider ul li').length;
        var slideWidth = $('#slider ul li').width();
        var slideHeight = $('#slider ul li').height();
        var sliderUlWidth = slideCount * slideWidth;

        $('#slider').css({ width: slideWidth, height: slideHeight });

        $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });

        $('#slider ul li:last-child').prependTo('#slider ul');

        function moveLeft() {
            $('#slider ul').animate({
                left: + slideWidth
            }, 200, function () {
                $('#slider ul li:last-child').prependTo('#slider ul');
                $('#slider ul').css('left', '');
            });
        };

        function moveRight() {
            $('#slider ul').animate({
                left: - slideWidth
            }, 200, function () {
                $('#slider ul li:first-child').appendTo('#slider ul');
                $('#slider ul').css('left', '');
            });
        };

        $('a.control_prev').click(function () {
            moveLeft();
        });

        $('a.control_next').click(function () {
            moveRight();
        });

    });
</script>
<script src="/js/room.min.js"></script>

@include('layout/footer')
