<?php
function flatsome_custom_css() {
global $flatsome_opt;
ob_start();
?>

<!-- Custom CSS Codes -->
<style type="text/css">

	/* Set FONTS */
	<?php if(!isset($flatsome_opt['disable_fonts']) || !$flatsome_opt['disable_fonts']) {?> 
		.top-bar-nav a.nav-top-link,body,p,#top-bar,.cart-inner .nav-dropdown,.nav-dropdown{font-family: <?php echo $flatsome_opt['type_texts'] ?>,helvetica,arial,sans-serif}
		.header-nav a.nav-top-link, a.cart-link, .mobile-sidebar a{font-family: <?php echo $flatsome_opt['type_nav'] ?>,helvetica,arial,sans-serif}
		h1,h2,h3,h4,h5,h6{font-family: <?php echo $flatsome_opt['type_headings'] ?>,helvetica,arial,sans-serif}
		.alt-font{font-family: <?php echo $flatsome_opt['type_alt'] ?>,Georgia,serif!important;}
	<?php }?>

	/* CUSTOM LAYOUT */
	<?php if($flatsome_opt['body_layout'] == 'boxed' || $flatsome_opt['body_layout'] == 'framed-layout'){?> 
		  body.boxed,body.framed-layout,body{background-color:<?php echo $flatsome_opt['body_bg'] ?>; background-image:url("<?php echo $flatsome_opt['body_bg_image'] ?>"); }
	<?php }?>

	<?php if($flatsome_opt['header_height']){ ?> 
			#masthead{ height:<?php echo $flatsome_opt['header_height']; ?>px;}
			<?php if($flatsome_opt['header_height'] > '70'){ ?>
				#logo a img{ max-height:<?php $height = $flatsome_opt['header_height'];  $height = str_replace("px","", $height);  $height = ($height)-30; $height = $height.'px'; echo $height;?>}
			<?php } else { ?>
				#logo a img{ max-height:<?php $height = $flatsome_opt['header_height'];  $height = str_replace("px","", $height);  $height = ($height)-10; $height = $height.'px'; echo $height;?>}
				#masthead #logo a{margin-top: 0;padding: 5px 0;} #masthead .left-links > ul, #masthead .right-links > ul {padding-top: 0} 
			<?php } ?>
	<?php } ?>

	<?php if($flatsome_opt['logo_width']){ ?> 
			<?php if($flatsome_opt['logo_position'] == "center") {?>
				.logo-center #masthead #logo{width: <?php echo $flatsome_opt['logo_width']*100/1080;?>%}
				.logo-center #masthead .left-links, .logo-center #masthead .right-links{width: <?php echo (100-($flatsome_opt['logo_width']*100/1080))/2; ?>%}
				#masthead #logo a{max-width: <?php echo $flatsome_opt['logo_width']; ?>px}
			<?php } else { ?>
				#masthead #logo{width: <?php echo $flatsome_opt['logo_width'] ?>px;}
				#masthead #logo a{max-width: <?php echo $flatsome_opt['logo_width']; ?>px}
			<?php } ?>
	<?php } ?>

	<?php if($flatsome_opt['header_height_sticky']){ ?> 
			#masthead.stuck.move_down{height:<?php  echo $flatsome_opt['header_height_sticky']; ?>px;}
			.wide-nav.move_down{top:<?php  echo $flatsome_opt['header_height_sticky']; ?>px;}
			<?php if($flatsome_opt['header_height_sticky'] > '70'){ ?>
				#masthead.stuck.move_down #logo a img{ max-height:<?php $height = $flatsome_opt['header_height_sticky'];  $height = str_replace("px","", $height);  $height = ($height)-30; $height = $height.'px'; echo $height;?> }
			<?php } else { ?>
				#masthead.stuck.move_down #logo a img{ max-height:<?php $height = $flatsome_opt['header_height_sticky'];  $height = str_replace("px","", $height);  $height = ($height)-10; $height = $height.'px'; echo $height;?> }
			<?php } ?>
	<?php } ?>

	/* header size */
	<?php if(isset($flatsome_opt['nav_size'])){ ?> 
		ul.header-nav li a {font-size: <?php echo $flatsome_opt['nav_size']; ?>}
	<?php } ?>

	/* CUSTOM COLORS */
	<?php if($flatsome_opt['body_bg']){ ?>
			body{background-color:<?php echo $flatsome_opt['body_bg'] ?>; background-image:url("<?php echo $flatsome_opt['body_bg_image'] ?>"); }
	<?php } ?>

	<?php if($flatsome_opt['header_bg'] || $flatsome_opt['header_bg_img']){?> 
			#masthead{background-color: <?php echo $flatsome_opt['header_bg']; ?>; <?php if($flatsome_opt['header_bg_img']) { ?>background-image: url('<?php echo $flatsome_opt['header_bg_img'] ?>'); background-repeat:<?php echo $flatsome_opt['header_bg_img_pos'] ?> <?php } ?>;}
	<?php } ?>

	<?php if($flatsome_opt['content_bg']){?> 
			.slider-nav-reveal .flickity-prev-next-button, #main-content{background-color: <?php echo $flatsome_opt['content_bg']; ?>!important}
	<?php } ?>

	<?php if($flatsome_opt['nav_position_bg']){?> 
			.wide-nav {background-color:<?php echo $flatsome_opt['nav_position_bg']; ?>}
	<?php } ?>

	<?php if($flatsome_opt['topbar_bg']){ ?> 
			#top-bar{background-color:<?php echo $flatsome_opt['topbar_bg'] ?> }
	<?php } else { ?> 
			#top-bar{background-color:<?php echo $flatsome_opt['color_primary'] ?> }
	<?php } ?>

	<?php if($flatsome_opt['topbar_bg']){ ?>
			.header-nav li.mini-cart.active .cart-icon strong{background-color: <?php echo $flatsome_opt['color_primary'] ?> }
	<?php } ?>



	<?php if($flatsome_opt['color_primary']){?> 
		/* PRIMARY COLOR */
		/* -- color -- */
		.ux-timer-text.primary span .alt-button.primary,.callout.style3 .inner .inner-text,.add-to-cart-grid .cart-icon strong,.tagcloud a,.navigation-paging a, .navigation-image a ,ul.page-numbers a, ul.page-numbers li > span,#masthead .mobile-menu a,.alt-button, #logo a, li.mini-cart .cart-icon strong,.widget_product_tag_cloud a, .widget_tag_cloud a,.post-date,#masthead .mobile-menu a.mobile-menu a,.checkout-group h3,.order-review h3 {color: <?php echo $flatsome_opt['color_primary'] ?>;}
		/* -- background -- */
		#submit.disabled:hover, #submit.disabled:focus, #submit[disabled]:hover, #submit[disabled]:focus, button.disabled:hover, button.disabled:focus, button[disabled]:hover, button[disabled]:focus, .button.disabled:hover, .button.disabled:focus, .button[disabled]:hover, .button[disabled]:focus, input[type="submit"].disabled:hover, input[type="submit"].disabled:focus, input[type="submit"][disabled]:hover, input[type="submit"][disabled]:focus,#submit.disabled, #submit[disabled], button.disabled, button[disabled], .button.disabled, .button[disabled], input[type="submit"].disabled, input[type="submit"][disabled],
		button[disabled], .button[disabled],button[disabled]:hover, .button[disabled]:hover, .ux-timer.primary span, .slider-nav-circle .flickity-prev-next-button:hover svg, .slider-nav-circle .flickity-prev-next-button:hover .arrow, .ux-box.ux-text-badge:hover .ux-box-text, .ux-box.ux-text-overlay .ux-box-image,.ux-header-element a:hover,.featured-table.ux_price_table .title,.scroll-to-bullets a strong,.scroll-to-bullets a.active,.scroll-to-bullets a:hover,.tabbed-content.pos_pills ul.tabs li.active a,.ux_hotspot,ul.page-numbers li > span,.label-new.menu-item a:after,.add-to-cart-grid .cart-icon strong:hover,.text-box-primary, .navigation-paging a:hover, .navigation-image a:hover ,.next-prev-nav .prod-dropdown > a:hover,ul.page-numbers a:hover,.widget_product_tag_cloud a:hover,.widget_tag_cloud a:hover,.custom-cart-count,.iosSlider .sliderNav a:hover span, li.mini-cart.active .cart-icon strong,.product-image .quick-view, .product-image .product-bg, #submit, button, #submit, button, .button, input[type="submit"],li.mini-cart.active .cart-icon strong,.post-item:hover .post-date,.blog_shortcode_item:hover .post-date,.column-slider .sliderNav a:hover,.ux_banner {background-color: <?php echo $flatsome_opt['color_primary'] ?>}
		/* -- borders -- */
		button[disabled], .button[disabled],.slider-nav-circle .flickity-prev-next-button:hover svg, .slider-nav-circle .flickity-prev-next-button:hover .arrow, .ux-header-element a:hover,.featured-table.ux_price_table,.text-bordered-primary,.callout.style3 .inner,ul.page-numbers li > span,.add-to-cart-grid .cart-icon strong, .add-to-cart-grid .cart-icon-handle,.add-to-cart-grid.loading .cart-icon strong,.navigation-paging a, .navigation-image a ,ul.page-numbers a ,ul.page-numbers a:hover,.post.sticky,.widget_product_tag_cloud a, .widget_tag_cloud a,.next-prev-nav .prod-dropdown > a:hover,.iosSlider .sliderNav a:hover span,.column-slider .sliderNav a:hover,.woocommerce .order-review, .woocommerce-checkout form.login,.button, button, li.mini-cart .cart-icon strong,li.mini-cart .cart-icon .cart-icon-handle,.post-date{border-color: <?php echo $flatsome_opt['color_primary'] ?>;}
		.blockUI:before,.processing:before,.ux-loading{border-left-color: <?php echo $flatsome_opt['color_primary'] ?>;}
		/* -- alt buttons-- */
		.primary.alt-button:hover,.button.alt-button:hover{background-color:<?php echo $flatsome_opt['color_primary'] ?>!important}
		/* -- icons -- */
		.flickity-prev-next-button:hover svg, .flickity-prev-next-button:hover .arrow, .featured-box:hover svg, .featured-img svg:hover{fill:<?php echo $flatsome_opt['color_primary']; ?>!important;}
		.slider-nav-circle .flickity-prev-next-button:hover svg, .slider-nav-circle .flickity-prev-next-button:hover .arrow, .featured-box:hover .featured-img-circle svg{fill:#FFF!important;}		
		.featured-box:hover .featured-img-circle{background-color: <?php echo $flatsome_opt['color_primary'] ?>!important; border-color: <?php echo $flatsome_opt['color_primary'] ?>!important;}
		/* -- transparent -- */		
	<?php }?>

	<?php if($flatsome_opt['color_secondary']){?> 
		/* SECONDARY COLOR */
		/* -- color -- */
		.star-rating:before, .woocommerce-page .star-rating:before, .star-rating span:before{color: <?php echo $flatsome_opt['color_secondary'] ?>}
		.secondary.alt-button,li.menu-sale a{color: <?php echo $flatsome_opt['color_secondary'] ?>!important}
		/* -- background -- */
		.secondary-bg.button.alt-button.success:hover,.label-sale.menu-item a:after,.mini-cart:hover .custom-cart-count,.callout .inner,.button.secondary,.button.checkout,#submit.secondary, button.secondary, .button.secondary, input[type="submit"].secondary{background-color: <?php echo $flatsome_opt['color_secondary'] ?>}
		/* -- borders -- */
		.button.secondary,.button.secondary{border-color:<?php echo $flatsome_opt['color_secondary'] ?>;}
		/* -- alt buttons-- */
		.secondary.alt-button:hover{color:#FFF!important;background-color:<?php echo $flatsome_opt['color_secondary'] ?>!important}
		ul.page-numbers li > span{color: #FFF;}
	<?php }?>

	<?php if($flatsome_opt['color_success']){?> 
		/* Success COLOR */
		/* -- color -- */
		.callout.style3 .inner.success-bg .inner-text,.woocommerce-message{color: <?php echo $flatsome_opt['color_success'] ?>!important}
		.success-bg,.woocommerce-message:before,.woocommerce-message:after{color: #FFF!important; background-color:<?php echo $flatsome_opt['color_success'] ?>}
		.label-popular.menu-item a:after,.add-to-cart-grid.loading .cart-icon strong,.add-to-cart-grid.added .cart-icon strong{background-color: <?php echo $flatsome_opt['color_success'] ?>;border-color: <?php echo $flatsome_opt['color_success'] ?>;}
		.add-to-cart-grid.loading .cart-icon .cart-icon-handle,.add-to-cart-grid.added .cart-icon .cart-icon-handle{border-color: <?php echo $flatsome_opt['color_success'] ?>}
	<?php }?>

	<?php if($flatsome_opt['color_checkout']){?> 
		/* Checkout button colors */
		form.cart .button,.cart-inner .button.checkout,.checkout-button,input#place_order{background-color: <?php echo $flatsome_opt['color_checkout'] ?>!important}
	<?php }?>

	<?php if($flatsome_opt['color_sale']){?> 
		/* Sale bubble color */
		.callout .inner{background-color: <?php echo $flatsome_opt['color_sale'] ?>!important}
		.callout.style3 .inner{background:transparent!important;border-color:<?php echo $flatsome_opt['color_sale'] ?>!important }
		.callout.style3 .inner .inner-text{color: <?php echo $flatsome_opt['color_sale'] ?>!important;}
	<?php }?>

	<?php if($flatsome_opt['color_review']){?> 
		/* review star colors */
		.star-rating span:before,.star-rating:before, .woocommerce-page .star-rating:before {color: <?php echo $flatsome_opt['color_review'] ?>!important}
	<?php }?>


	<?php if($flatsome_opt['color_links']){?> 
		/* LINK COLOR */
		a,.icons-row a.icon{color: <?php echo $flatsome_opt['color_links'] ?>}
		.cart_list_product_title{color: <?php echo $flatsome_opt['color_links'] ?>!important}
		.icons-row a.icon{border-color: <?php echo $flatsome_opt['color_links'] ?>;}
		.icons-row a.icon:hover{background-color:<?php echo $flatsome_opt['color_links'] ?>;border-color:<?php echo $flatsome_opt['color_links'] ?>;}
   <?php }?>


	<?php if($flatsome_opt['button_radius'] != "0px") {?>
			input[type="submit"], .button{-webkit-border-radius:<?php echo $flatsome_opt['button_radius']; ?>!important; -moz-border-radius: <?php echo $flatsome_opt['button_radius']; ?>!important; border-radius: <?php echo $flatsome_opt['button_radius']; ?>!important;}
			.search-wrapper .button {border-top-left-radius: 0!important; -moz-border-radius-topleft: 0!important;; -webkit-border-top-left-radius: 0!important; -webkit-border-bottom-left-radius: 0!important; -moz-border-radius-bottomleft: 0!important; border-bottom-left-radius: 0!important;}
	<?php } ?>

	<?php if($flatsome_opt['disable_quick_view']) {?>
		.product-image:hover .add-to-cart-grid{bottom:10px;}
	<?php } ?>

	<?php if($flatsome_opt['dropdown_border']) { ?>
			.nav-dropdown{border-color:<?php echo $flatsome_opt['dropdown_border'] ?>;}
			.nav-dropdown > ul:after, .nav-dropdown > .row:after, .nav-dropdown-inner:after, .menu-item-language .sub-menu:after{border-bottom-color:<?php echo $flatsome_opt['dropdown_border'] ?>;}
	<?php } ?>

	<?php if($flatsome_opt['dropdown_bg']) { ?>
			.nav-dropdown{background-color:<?php echo $flatsome_opt['dropdown_bg']; ?>;}
	<?php } ?>

	<?php if($flatsome_opt['dropdown_text'] == "dark") { ?>
			.mini-cart-item,.cart_list_product_title,.minicart_total_checkout,ul.top-bar-nav .nav-dropdown ul li,ul.top-bar-nav .nav-dropdown li a,ul.header-nav li .nav-dropdown li a {color:#eee!important;border-color:rgba(255,255,255,0.1)!important;border-left:0;}
			.nav-dropdown p.empty,ul.top-bar-nav .nav-dropdown li a:hover,ul.header-nav li .nav-dropdown li a:hover{color:#fff!important;}
			.remove .icon-close:hover,ul.header-nav li .nav-dropdown > ul > li.menu-parent-item > a{color:#EEE;border-color:rgba(255,255,255,0.3)!important;}
	<?php } ?>


	<?php if($flatsome_opt['footer_1_bg_image']) { ?>
			.footer.footer-1{background-image: url('<?php echo $flatsome_opt['footer_1_bg_image']; ?>');}
	<?php } ?>

	<?php if($flatsome_opt['footer_2_bg_image']) { ?>
			.footer.footer-2{background-image: url('<?php echo $flatsome_opt['footer_2_bg_image']; ?>');}
	<?php } ?>



	<?php if($flatsome_opt['wishlist_icon'] != 'heart') {
		echo '.product-image .yith-wcwl-wishlistexistsbrowse > a, .product-image .yith-wcwl-add-button > a.add_to_wishlist, .product-image .yith-wcwl-wishlistaddedbrowse > a{padding:8px;} .yith-wcwl-wishlistexistsbrowse > a, .yith-wcwl-add-button > a.add_to_wishlist, .yith-wcwl-wishlistaddedbrowse > a{padding:3px;}';
		echo '.yith-wcwl-wishlistexistsbrowse > a:before, .yith-wcwl-add-button > a.add_to_wishlist:before, .yith-wcwl-wishlistaddedbrowse > a:before{';
		if($flatsome_opt['wishlist_icon'] == 'plus'){
			echo 'content:"\e00c";';
		} else if($flatsome_opt['wishlist_icon'] == 'star'){			
			echo 'content:"\e005";';
		} else if($flatsome_opt['wishlist_icon'] == 'pen'){
			echo 'content:"\e017";';
		} else if($flatsome_opt['wishlist_icon'] == 'list'){
			echo 'content:"\e00b";';
		}
		echo '}';
	 } ?>


	/* MENU LABELS */
	.label-new.menu-item > a:after{content:"<?php _e('New','flatsome'); ?>";}
	.label-hot.menu-item > a:after{content:"<?php _e('Hot','flatsome'); ?>";}
	.label-sale.menu-item > a:after{content:"<?php _e('Sale','flatsome'); ?>";}
	.label-popular.menu-item > a:after{content:"<?php _e('Popular','flatsome'); ?>";}

	/* featured items */
	.featured_item_image{max-height: <?php echo $flatsome_opt['featured_items_related_height'];?>}

	/* BUBBLE COLORS */
	.callout .inner.callout-new-bg{background-color:<?php echo $flatsome_opt['color_new_bubble'];?>!important;}
	.callout.style3 .inner.callout-new-bg{background-color: none!important;border-color: <?php echo $flatsome_opt['color_new_bubble'];?>!important}


	 <?php 	if (function_exists('icl_object_id') ) { ?>
	 	/* WPML fix */
		#lang_sel{z-index: 10;width: 100%}
		#lang_sel li{width: 100%;}
		.menu-item-language .sub-menu{ padding: 10px; left:auto;right:0;width: 180px;}
		.menu-item-language .sub-menu li{margin:0;padding: 0;width: 100%}
		.sub-menu.submenu-languages a{color: #777!important;font-size: 95%; display:block;text-transform: uppercase;padding: 10px 0;border-bottom: 1px solid #EEE;}
		.sub-menu.submenu-languages a:hover{color: #000!important;border-bottom: 1px solid #EEE;}
		.sub-menu.submenu-languages li:last-child a{border:0}
		.sub-menu.submenu-languages .iclflag{margin-right: 5px;}
	 <?php } ?>

	<?php if(defined( 'YITH_WCAS_PREMIUM' )) { ?>
	   /* AJAX search plugin fix */
		.autocomplete-suggestion .yith_wcas_result_image{max-width: 70px; float:left; padding-right: 15px;}
		.autocomplete-suggestion .yith_wcas_result_content{line-height: 140%; font-size: 85%;}
		.autocomplete-suggestion .yith_wcas_result_content .badges{position: absolute; top:15px; font-size: 10px; left:0; max-width:70px; background-color: <?php echo $flatsome_opt['color_primary']; ?>; color:#FFF; display: inline-block; padding: 2px 5px}
		.autocomplete-suggestion .yith_wcas_result_content span{font-weight: bolder;}
	<?php } ?>

	/* CUSTOM CSS */
	<?php echo $flatsome_opt['html_custom_css']; ?>

	<?php if($flatsome_opt['html_custom_css_mobile']) {
	// /MOBILE CUSTOM CSS
	echo '@media only screen and (max-width: 48em) {';
	echo $flatsome_opt['html_custom_css_mobile'];
	echo '}';
	} 
	?>



	<?php if(is_admin_bar_showing()){ ?> 
    	/* Fixes if admin bar is showing */
    	.mfp-wrap > .mfp-close{top: 32px;}
    	.wide-nav.move_down{margin-top: 32px;}
    	.tooltipster-base{margin-top: -32px;}
	  	 #masthead.move_down{margin-top: 32px;}

		 #wpadminbar #wp-admin-bar-admin_bar_helper>.ab-item:before {content: "\f107"; top: 2px;}

		 @media only screen and (max-width: 48em) {
		 	#masthead.move_down{margin-top: 0;}
		 	#wpadminbar{display: none!important}
		 	html{margin-top: 0!important}
		 }
	<?php } ?>
	
</style>

<?php

$buffer = ob_get_clean();

// Minify CSS
$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
$buffer = str_replace(': ', ':', $buffer);
$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

echo $buffer;

}
add_action( 'wp_head', 'flatsome_custom_css', 100 );
?>