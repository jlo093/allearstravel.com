/**
 * Hosteller
 * Hosteller Template created for hostels, students hotels, guest houses, small hotel, resort, room reservation, travel and more
 * Exclusively on https://1.envato.market/hosteller-html
 *
 * @encoding        UTF-8
 * @version         1.0.3
 * @copyright       (C) 2018 - 2022 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Lamber Lilit (winter.rituel@gmail.com)
 * @support         help@merkulov.design
 **/
"use strict";

let isShown = false;

import {initSwiperSlider} from "./modules/slider";
import initModal from "./modules/modal";
import timer from "./modules/timer";

const commonOptions = {
    slidesPerView: 1,
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
    loop: true,
    autoplay: true,
    speed: 1500,
}

document.addEventListener('DOMContentLoaded', () => {
    initSwiperSlider('.reviews_slider--media', {
        ...commonOptions,
        watchSlidesProgress: true
    })
    initSwiperSlider('.reviews_slider--main', {
        ...commonOptions,
        thumbs: document.querySelector('.reviews_slider--media').swiper,
    })
})
