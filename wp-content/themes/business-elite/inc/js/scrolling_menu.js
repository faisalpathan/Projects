jQuery(document).ready(function(){

	if(jQuery('#header').parent().find('.custom-header-a').length && !jQuery('#slideshow').length){ // if custom header and no slider
		var business_elite_sticky_threshold = jQuery('#header').parent().find('.custom-header-a').offset().top;
	}
	else{
		var business_elite_sticky_threshold = 0;
	}

	if(jQuery(window).scrollTop()>business_elite_sticky_threshold + 100 && !jQuery('#top-nav').hasClass('open')) {
		jQuery( "#header .container, #header" ).addClass('sticky_menu');

		sticky_menu();
	}
	else {
		jQuery('.container.sticky_menu #menu-button-block').css('top', 0);
		/*not calling .phone, since it is not added yet*/
		if(jQuery(window).width()<768){
			jQuery('#header').css('top', 0);
		}
		jQuery( "#header .container, #header" ).removeClass('sticky_menu');
		jQuery('#header').css('top', 0);	// reset onto slider or back to top
		wdwt_reset_submenus();
	}
	jQuery( window ).scroll(function() {

		if(jQuery(window).scrollTop()>business_elite_sticky_threshold + 10 && !jQuery('#top-nav').hasClass('open')){
			jQuery( "#header .container, #header" ).addClass('sticky_menu');
			sticky_menu();
		}
		else{
			jQuery('.container.sticky_menu #menu-button-block').css('top', 0);
			if(jQuery(window).width()<768){
				jQuery('#header').css('top', 0);
			}
			jQuery( "#header .container, #header" ).removeClass('sticky_menu');
			jQuery('#header').css('top', 0);	// reset onto slider or back to top
			wdwt_reset_submenus();
		}
	});

	if(full_width_business_elite==1)
		screenSize=jQuery("body").width();
	else
		screenSize=jQuery(".container").width();

	function phone(full) {
		jQuery('#header').css('margin-bottom',5 + "px");
		jQuery('body').css('margin-top', 0);
	}


});



function sticky_menu(){
	wdwt_reset_submenus();
	if(jQuery('#wpadminbar').length==1){

		jQuery('#header.sticky_menu').css('top', jQuery('#wpadminbar').height());

		if(jQuery('#wpadminbar').eq(0).css('position') == 'fixed'){
			jQuery('.container.sticky_menu #menu-button-block').css('top', jQuery('#wpadminbar').height());
		}
	}


}
