'use strict';
/* ----------------------------- 
 Pre Loader
 ----------------------------- */
jQuery(window).load(function () {
    jQuery('.loading-icon').delay(500).fadeOut();
    jQuery('#preloader').delay(800).fadeOut('slow');
});
jQuery(document).ready(function () {
    // script for site preloader
    new WOW().init();
    //For fancybox
    jQuery(".fancybox").fancybox();
    var width = jQuery(window).width();
    if (width > 767) {
        jQuery('.navbar.prestro-navbar').TMStickUp();
        jQuery('.main-nav ul li, .isStuck ul li').hover(
                function () {
                    jQuery(this).children('.sub-menu').stop(true, true).slideDown('slow');
                },
                function () {
                    jQuery(this).children('.sub-menu').stop(true, true).slideUp('fast');
                }
        );
    }
    jQuery(window).scroll(function () {
        jQuery(this).scrollTop() > 100 ? jQuery(".scroll-to-top").fadeIn() : jQuery(".scroll-to-top").fadeOut();
    });
    jQuery(".scroll-to-top").click(function () {
        return jQuery("html, body").animate({scrollTop: 0}, 800);
    });
    jQuery('#testimonial-slider').carouFredSel({
        responsive: true,
        auto: true,
        width: '100%',
        scroll: {
            items: 1,
            easing: "easeInOutQuint",
            duration: 1000,
            pauseOnHover: true
        },
        pagination: "#paginatecircle",
        items: {
            width: 1100,
            visible: {
                min: 1,
                max: 1
            }
        }
    });
    // Initalize mean menu
    jQuery('#prestro-top-nav .main-nav').meanmenu();
});
jQuery(window).load(function () {
    jQuery('#home-slider').nivoSlider({
        effect: 'random', // Specify sets like: 'fold,fade,sliceDown'
        pauseTime: 4000, // How long each slide will show
        directionNav: true, // Next & Prev navigation
        controlNav: false, // 1,2,3... navigation
        pauseOnHover: true, // Stop animation while hovering
        prevText: '<i class="fa fa-chevron-left"></i>', // Prev directionNav text
        nextText: '<i class="fa fa-chevron-right"></i>', // Next directionNav text
        randomStart: true             // Start on a random slide
    });
});
/*-------Scrolling Effects-------*/
jQuery(function ($) {
    var $elems = $('.animateblock');
    var winheight = $(window).height();
    var fullheight = $(document).height();
    $elems.each(function () {
        var $elm = $(this);
        var topcoords = $elm.offset().top;
        if (topcoords < winheight) {
            // animate when top of the window is 3/4 above the element
            $elm.addClass('animated');
        }
    });
    $(window).scroll(function () {
        animate_elems();
    });

    function animate_elems() {
        var wintop;
        wintop = $(window).scrollTop(); // calculate distance from top of window

        // loop through each item to check when it animates
        $elems.each(function () {
            var $elm = $(this);
            if ($elm.hasClass('animated')) {
                return true;
            } // if already animated skip to the next item
            var topcoords = $elm.offset().top; // element's distance from top of page in pixels
            if (wintop > (topcoords - (winheight * 0.9))) {
                // animate when top of the window is 3/4 above the element
                $elm.addClass('animated');
            }
        });
    }
});