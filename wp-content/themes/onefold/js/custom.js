( function( $ ) {

  $(document).ready(function($){

  	// Popup for Portfolio widget.
  	$('.home-section-portfolio a.popup-link').magnificPopup({
  		type: 'image',
  		removalDelay: 300,
  		gallery: {
  			enabled: true
  		}
  	});

  	// Team hover.
  	$('.thumb-summary-wrap').hover( function(){
  		$(this).children('.our-team-summary').stop().slideDown(300);
  	}, function(){
  		$(this).children('.our-team-summary').stop().slideUp(300);
  	});

  	// Search in Header.
  	if( $('.search-icon').length > 0 ) {
  		$('.search-icon').click(function(e){
  			e.preventDefault();
  			$('.search-box-wrap').slideToggle();
  		});
  	}

    // Trigger mobile menu.
    $('#mobile-trigger').sidr({
		timing: 'ease-in-out',
		speed: 500,
		source: '#mob-menu',
		name: 'sidr-main'
    });


	  // Fixed header.
	  $(window).scroll(function () {
	  	if( $(window).scrollTop() > $('.site-header').offset().top && !($('.site-header').hasClass('fixed'))){
	  		$('.site-header').addClass('fixed');
	  	}

	  	else if ( 0 === $(window).scrollTop() ){
	  		$('.site-header').removeClass('fixed');
	  	}
	  });

    // Implement go to top.
    if ( 1 === parseInt( Onefold_Custom_Options.go_to_top_status, 10 ) ) {
    	var $scroll_obj = $( '#btn-scrollup' );
    	$( window ).scroll(function(){
    		if ( $( this ).scrollTop() > 100 ) {
    			$scroll_obj.fadeIn();
    		} else {
    			$scroll_obj.fadeOut();
    		}
    	});

    	$scroll_obj.click(function(){
    		$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
    		return false;
    	});
    } // End if go to top.

  });

} )( jQuery );
