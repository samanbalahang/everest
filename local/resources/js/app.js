
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('slick-carousel/slick/slick');
require('./jquery.fancybox');

$(".showMenuMobile").click(function() {
    $(".menu").slideToggle();
});

$(".sliders").slick({
    rtl: true,
    autoplay: true,
    autoplaySpeed: 3500
});

$(".customerSilder").slick({
    rtl: true,
    slidesToShow: 5,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 3
            }
        },
    ]
});