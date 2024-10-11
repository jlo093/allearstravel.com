<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>{{ env('APP_NAME') }}</title>

    <link rel="stylesheet preload" as="style" href="{{ asset('/css/preload.min.css') }}" />
    <link rel="stylesheet preload" as="style" href="{{ asset('/css/icomoon.css') }}" />
    <link rel="stylesheet preload" as="style" href="{{ asset('/css/libs.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('/css/room.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/rooms.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}" />

    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/jquery.steps.min.js"></script>
</head>
<body>
<header class="header d-flex align-items-center" data-page="home">
    <div class="container position-relative d-flex justify-content-between align-items-center">
        <a class="brand d-flex align-items-center" href="/">
            <img src="/img/aet-logo.png" />
        </a>
        <div class="header_offcanvas offcanvas offcanvas-end" id="menuOffcanvas">
            <div class="header_offcanvas-header d-flex justify-content-between align-content-center">
                <a class="brand d-flex align-items-center" href="/">
                    <img src="/img/aet-logo.png" />
                </a>
                <button class="close" type="button" data-bs-dismiss="offcanvas">
                    <i class="icon-close--entypo"></i>
                </button>
            </div>
            <nav class="header_nav">
                <ul class="header_nav-list">
                    <li class="header_nav-list_item">
                        <a class="nav-item @if (request()->route()->getName() === "page.index") current @endif" href="/">Home</a>
                    </li>
                    <li class="header_nav-list_item">
                        <a class="nav-item" href="about.html">About</a>
                    </li>
                    <li class="header_nav-list_item dropdown">
                        <a class="nav-item @if (str_contains(request()->getRequestUri(), 'destination') || str_contains(request()->getRequestUri(), 'start')) current @endif" href="{{ route('booking.start') }}">Parks &amp; Resorts</a>
                    </li>
                    <li class="header_nav-list_item" style="margin-right: 5px">
                        <a class="nav-link nav-link--contacts d-inline-flex align-items-center" href="about.html">Help</a>
                    </li>
                    <li class="header_nav-list_item dropdown">
                        <a class="nav-link nav-link--contacts d-inline-flex align-items-center" href="/manage-booking">{{ __('Manage Booking') }}</a>
                    </li>
                </ul>
            </nav>
            <ul class="socials d-flex align-items-center">
                <li class="list-item">
                    <a class="link" href="">
                        <i class="icon-facebook"></i>
                    </a>
                </li>
                <li class="list-item">
                    <a class="link" href="">
                        <i class="icon-instagram"></i>
                    </a>
                </li>
                <li class="list-item">
                    <a class="link" href="">
                        <i class="icon-twitter"></i>
                    </a>
                </li>
                <li class="list-item">
                    <a class="link" href="">
                        <i class="icon-whatsapp"></i>
                    </a>
                </li>
            </ul>
        </div>
        <button class="header_trigger d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuOffcanvas">
            <i class="icon-stream"></i>
        </button>
    </div>
</header>

