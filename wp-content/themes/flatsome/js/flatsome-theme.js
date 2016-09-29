/* add browser info to HTML tag */
var doc = document.documentElement; doc.setAttribute('data-useragent', navigator.userAgent);

;(function ($) {
"use strict";

/******** SLIDERS ***********/

/* When changing Slides */
$('.ux-slider, .product-gallery-slider').on( 'cellSelect', function() {

  // Auto play video on desktop
  if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
      $(this).find('.ux_banner:not(.is-selected) .ux-banner-video').trigger('pause');
      $(this).find('.ux_banner.is-selected .ux-banner-video').trigger('play');
  }

  // Set slider heights
  var height = $(this).find('.is-selected').outerHeight();
  if(height) {$(this).find('.flickity-viewport').css('height',height);}
});

// Add Drag Start and End
$('.ux-slider').on( 'dragStart', function( ) {
  $(this).addClass('is-dragging');
});

$('.ux-slider').on( 'dragEnd', function(  ) {
  $(this).removeClass('is-dragging');
});

/* When Slider is finised loading */
$('.ux-slider').on( 'settle', function() {
   setTimeout(function(){
      $('.ux-slider-wrapper .ux-loading').remove();
    }, 1000);
});

/******** DROPDOWNS ***********/

/* Main Dropdown */
$('.nav-top-link').parent().hoverIntent(
  function () {
       var max_width = '1080';
       if(max_width > $(window).width()) {max_width = $(window).width();}
       $(this).find('.nav-dropdown').css('max-width',max_width);
       $(this).find('.nav-dropdown').fadeIn(20);
       $(this).addClass('active');
       /* fix dropdown if it has too many columns */
       var dropdown_width = $(this).find('.nav-dropdown').outerWidth();
       var col_width =  $(this).find('.nav-dropdown > ul > li.menu-parent-item').width();
       var cols = ($(this).find('.nav-dropdown > ul > li.menu-parent-item').length) + ($(this).find('.nav-dropdown').find('.image-column').length);
       var col_must_width = cols*col_width;
       if($('.wide-nav').hasClass('nav-center')){
        $(this).find('.nav-dropdown').css('margin-left','-70px');
      }

       if(col_must_width > dropdown_width){
          $(this).find('.nav-dropdown').width(col_must_width);
          $(this).find('.nav-dropdown').addClass('no-arrow');
          $(this).find('.nav-dropdown').css('left','auto');
          $(this).find('.nav-dropdown').css('right',0);
          $(this).find('ul:after').remove();
       }
  },
  function () {
        $(this).find('.nav-dropdown').fadeOut(20);
        $(this).removeClass('active');
  }
);

/* Search dropdown */
$('.search-dropdown').hoverIntent(
  function () {
       if($('.wide-nav').hasClass('nav-center')){
          $(this).find('.nav-dropdown').css('margin-left','-85px');
        }
       $(this).find('.nav-dropdown').fadeIn(50);
       $(this).addClass('active');
       $(this).find('input').focus();

  },
  function () {
       $(this).find('.nav-dropdown').fadeOut(50);
       $(this).removeClass('active');
       $(this).find('input').blur();
  }
);


/* Other Dropdowns */
$('.prod-dropdown').hoverIntent(
  function () {
       $(this).find('.nav-dropdown').fadeIn(50);
       $(this).addClass('active');

  },
  function () {
       $(this).find('.nav-dropdown').fadeOut(50);
       $(this).removeClass('active');
  }
);

/* Cart Dropdown */
$('.cart-link').parent().parent().hoverIntent(
  function () {
       $(this).find('.nav-dropdown').fadeIn(50);
       $(this).addClass('active');

  },
  function () {
       $(this).find('.nav-dropdown').fadeOut(50);
       $(this).removeClass('active');
  }
);

/* WPML dropdown */
$('.menu-item-language-current').hoverIntent(
  function () {
       $(this).find('.sub-menu').fadeIn(50);

  },
  function () {
       $(this).find('.sub-menu').fadeOut(50);
  }
);



/******** GLOBAL LIGHTBOX SCRIPTS ***********/

  /* Image Lightbox */
  $("*[id^='attachment'] a, a.image-lightbox, .entry-content a[href$='.jpg'], .entry-content a[href$='.jpeg']").not('.gallery a[href$=".jpg"], .gallery a[href$=".jpeg"]').magnificPopup({
    type: 'image',
    tLoading: '<div class="ux-loading dark"></div>',
    closeOnContentClick: true,
    removalDelay: 300,
    image: {
      verticalFit: false
    }
  }); // image lightbox



  /* Gallery Lightbox */
  $(".column-inner a[href$='.jpg'], .column-inner a[href$='.jpeg'], .gallery a[href$='.jpg'],.gallery a[href$='.jpeg'],.featured-item a[href$='.jpeg'],.featured-item a[href$='.gif'],.featured-item a[href$='.jpg'], .page-featured-item .slider a[href$='.jpg'], .page-featured-item a[href$='.jpg'],.page-featured-item .slider a[href$='.jpeg'], .page-featured-item a[href$='.jpeg'], .gallery a[href$='.png'], .gallery a[href$='.jpeg'], .gallery a[href$='.gif']").parent().magnificPopup({
    delegate: 'a',
    type: 'image',
    tLoading: '<div class="ux-loading dark"></div>',
    removalDelay: 300,
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
      verticalFit: false
    },
      callbacks: {
     
      open: function () {

            var magnificPopup = $.magnificPopup.instance;

            // Slide to Close popup
            var slidePan = $('.mfp-wrap')[0];
            var mc = new Hammer(slidePan);

            mc.on("panleft", function(ev) {
              if(ev.isFinal){ magnificPopup.prev(); }
            });

            mc.on("panright", function(ev) {
              if(ev.isFinal){ magnificPopup.next(); }
            });
      },
    
    }
  });

  // Data open
  $('[data-lightbox]').click(function(e){
      var id = $(this).data('lightbox');
      $.magnificPopup.open({
            midClick: true,
            removalDelay: 300,
            items: {
              src: id,
              type: 'inline'
            }
      });
      e.preventDefault();
  });

  // Mobile sidebar open
  $('a.off-canvas-overlay').magnificPopup({
  removalDelay: 300, 
  closeBtnInside: true,
    callbacks: {
      beforeOpen: function() {
         this.st.mainClass = 'off-canvas '+this.st.el.attr('data-pos')+' '+this.st.el.attr('data-color');
      },
      open: function () {
         $('html').addClass('has-off-canvas push-' +this.st.el.attr('data-pos'));

            // Slide to Close popup
            var mainMenu = $('.mfp-wrap')[0];
            var mc = new Hammer(mainMenu);

            mc.on("panleft", function(ev) {
                  if($(ev.target).parents('.widget_price_filter').length) {return false;}
                 
                  if(ev.distance > 120 && ev.isFinal && ev.type === 'panleft'){
                     $.magnificPopup.close();
                  } 
            });
      },
      beforeClose: function() {
         $('html').removeClass('has-off-canvas push-' +this.st.el.attr('data-pos'));
      }
    }
  });

  // Mobile sidebar menu toggle
  $('.mobile-sidebar li.menu-item-has-children > ul, .mobile-sidebar li.menu-item-has-children > a[href="#"]').click(function(){
      $(this).parent().toggleClass('open');
  });

  /* Youtube and Vimeo links*/
  $("a.button[href*='vimeo'],a.button[href*='youtube']").magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'my-mfp-video',
    tLoading: '<div class="ux-loading dark"></div>',
    removalDelay: 300,
    preloader: false,
  }); 


/********* SCROLL ANIMATIONS **********/


/* Default Scroll Animations */
setTimeout(function() {
  $('.animated:not(#top-link)').waypoint(function() {
      $(this).addClass('start-anim');
  },{offset: '97%'});
}, 100);


/* Back to top links */
$('.absolute-footer').waypoint(function() {
  $('#top-link').toggleClass('start-anim');
},{offset:'100%'});


/* Add Sticky Header */

var sticky_offset_height = -$(window).height()/4;

$('.sticky_header #masthead').waypoint('sticky', {
  offset: sticky_offset_height
});

$('.sticky_header .wide-nav').waypoint('sticky', {
  offset: sticky_offset_height
});

/* make sticky header move down while scrolling */
$('#main-content').waypoint(function() {
   $('body.has-dark-header:not(.org-dark-header)').toggleClass('dark-header');
   $('.header-wrapper').toggleClass('before-sticky');
   $('.sticky_header #masthead, .wide-nav').toggleClass('move_down');
},{offset: sticky_offset_height});



/********* SCROLL TO LINKS **********/

/* top link */
$('#top-link').click(function(e) {
    $.scrollTo(0,300);
    e.preventDefault();
}); // top link



/****** ACCORDIAN / TABS *******/

/* Accordion */
$('.accordion').each(function(){
  var acc = $(this).attr("rel") * 2;
  $(this).find('.accordion-inner:nth-child(' + acc + ')').show();
  $(this).find('.accordion-inner:nth-child(' + acc + ')').prev().addClass("active");
});
  
$('.accordion .accordion-title').click(function() {
  if($(this).next().is(':hidden')) {
    $(this).parent().find('.accordion-title').removeClass('active').next().slideUp(200);
    $(this).toggleClass('active').next().slideDown(200);   
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
        $.scrollTo($(this),300,{offset:-100});
    }
  } else {
    $(this).parent().find('.accordion-title').removeClass('active').next().slideUp(200);
  }
  return false;
});

/* Tabs */
$('.shortcode_tabgroup ul.tabs li a').click(function(e){
  e.preventDefault();
  $(this).parent().parent().parent().find('ul li').removeClass('active');
  $(this).parent().addClass('active');
  var currentTab = $(this).attr('href');
  $(this).parent().parent().parent().find('div.panel').removeClass('active');
  $(currentTab).addClass('active');
  $(currentTab).find('p script').unwrap();

  $(this).parent().parent().parent().find('.js-flickity').flickity('resize');

  return false;
});

$('.product-details .tabbed-content .tabs a').click(function(){
  $('.panel').removeClass('active');
  var panel = $(this).attr('href');
  $(panel).addClass('active');
});

/* tabs vertical */
$('.shortcode_tabgroup_vertical ul.tabs-nav li a').click(function(e){
  e.preventDefault();
  $(this).parent().parent().parent().find('ul li').removeClass('current-menu-item');
  $(this).parent().addClass('current-menu-item');
  var currentTab = $(this).attr('href');
  $(this).parent().parent().parent().parent().find('div.tabs-inner').removeClass('active');
  $(currentTab).addClass('active');
  $(this).parent().parent().parent().parent().find('.js-flickity').flickity('resize');
  return false;
});

/****** TOOLTIPS *******/

if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
  $('.yith-wcwl-wishlistexistsbrowse.show').each(function(){
      var tip_message = $(this).find('a').text();
      $(this).find('a').attr('title',tip_message).addClass('tip-top');
  });

  $('.yith-wcwl-add-button.show').each(function(){
      var tip_message = $(this).find('> a.add_to_wishlist').text();
      $(this).find('a.add_to_wishlist').attr('title',tip_message).addClass('tip-top');
  });

  $('.chosen a').tooltipster({delay: 50, contentAsHTML: true,touchDevices: false});
  $('.tip-left').tooltipster({position: 'left', delay: 50, contentAsHTML: true,touchDevices: false});
  $('.tip, .tip-top,.tip-bottom').tooltipster({delay: 50, contentAsHTML: true,touchDevices: false});
}


/****** UX BANNER *******/
$( window ).resize(function() {
  $('.ux_banner.full-height').height($( window ).height());
});


/****** FIXES *******/
// Mega menu
$('#megaMenu').wrap('<li/>');


/****** FASTCLICK *******/
// Disable fast click for touch devices on some elements
if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
  $('.select2-container, #megaMenu, .top-bar-nav .nav-top-link, .header-nav .nav-top-link, .menu-item-language-current, .search-dropdown, input.booking_calender').addClass('needsclick');
}

// Run fastclick script
FastClick.attach(document.body);

$(window).resize();

}(jQuery));