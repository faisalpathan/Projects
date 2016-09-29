jQuery(document).ready(function() {
  if (!jQuery("div").hasClass('metaslider')) {  
    jQuery('nav').addClass('fixed-header');
  }
  else
  {
    jQuery('div').removeClass('page-title-area-full'); 
  }
});

jQuery(window).scroll(function() {
    if (jQuery("div").hasClass('metaslider'))  {  
      if (jQuery(window).scrollTop() > 100)  {
        jQuery('nav').addClass('fixed-header');       
      }
      else {
        jQuery('nav').removeClass('fixed-header');
      }
    }
});

jQuery(document).ready(function () {
  // preloader
 jQuery(window).load(function(){
    jQuery('.preloader').delay(400).fadeOut(500);
  })
})

jQuery(document).ready(function() 
{
  
  jQuery("#owl-demo-latest-posts").owlCarousel({
    autoPlay: 3000, //Set AutoPlay to 3 seconds
      navigation : true, // Show next and prev buttons
      navigationText: [
  "<i class='fa fa-chevron-left'></i>",
  "<i class='fa fa-chevron-right'></i>"
  ],
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true
  });
});

jQuery(document).ready(function() {
  jQuery("#owl-demo").owlCarousel({
	  pagination: true,
	  autoPlay: 3000, //Set AutoPlay to 3 seconds
      navigation : false, // Show next and prev buttons
      singleItem:true
  });
});

jQuery(document).ready(function(){
	//Check to see if the window is top if not then display button
	jQuery(window).scroll(function(){
		if (jQuery(this).scrollTop() > 100) {
			jQuery('.back-to-top a').fadeIn();
		} else {
			jQuery('.back-to-top a').fadeOut();
		}
	});
	//Click event to scroll to top
	jQuery('.back-to-top a').click(function(){
		jQuery('html, body').animate({scrollTop : 0},800);
		return false;
	});
});