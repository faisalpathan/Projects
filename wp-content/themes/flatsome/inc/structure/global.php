<?php

// Add Layout Classes to Body

function flatsome_body_classes( $classes ) {
	global $flatsome_opt;
	// add antialias to all texts 
	$classes[] = 'antialiased';

	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
	  $classes[] = 'group-blog';
	}

	// adds dark header class
	if($flatsome_opt['header_color'] == 'dark'){
	  $classes[] = 'dark-header';
      $classes[] = 'org-dark-header';
   }
  
	// add stikcy header class
  	$disabled_sticky = false;
  	if(function_exists('is_checkout')){
		if(is_checkout() || is_cart()){
			$disabled_sticky = true;
		}
  	}

	if($flatsome_opt['header_sticky'] && !$disabled_sticky){
		$classes[] = 'sticky_header';
	}

	// add logo-center class
	if($flatsome_opt['logo_position'] == 'center'){
		$classes[] = 'logo-center';
	}


  if(ux_is_woocommerce_active()){
      if($flatsome_opt['breadcrumb_size']){
        $classes[] = $flatsome_opt['breadcrumb_size'];
      } 

      if(is_product() && $flatsome_opt['product_zoom']){
        $classes[] = 'product-zoom';
      }
 
      if($flatsome_opt['catalog_mode_prices']){
          $classes[] = 'no-prices';
      }
  } // End woocommerce active


	// add boxed layout class if selected
	if($flatsome_opt['body_layout']){
		$classes[] = $flatsome_opt['body_layout'];
	}

	if($flatsome_opt['body_layout'] == "framed-layout"){
		$classes[] = "boxed";
	}

	// add background settings
	if($flatsome_opt['body_bg_image']){
		$classes[] = $flatsome_opt['body_bg_type'];
	}

  if ( is_page_template( 'page-transparent-header-light.php' ) || is_page_template( 'page-transparent-header.php' ) || is_page_template( 'page-boxed-header.php' )) {
    $classes[] = 'transparent-header';
  }

  if ( is_page_template( 'page-transparent-header-light.php' )) {
    $classes[] = 'has-dark-header';
    $classes[] = 'dark-header';
  }

   if ( is_page_template( 'page-blank-header.php' )) {
    $classes[] = 'hide-header';
  }

    if ( is_page_template( 'page-boxed-header.php' )) {
    $classes[] = 'boxed-header';
  }

	return $classes;
}
add_filter( 'body_class', 'flatsome_body_classes' );