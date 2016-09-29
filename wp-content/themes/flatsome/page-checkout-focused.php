<?php
/*
Template name: Page Checkout - Focused
Use this for Cart, Checkout and thank you page.
*/

global $woo_options;
global $woocommerce;
global $flatsome_opt;
?>
<!DOCTYPE html>
<!--[if lte IE 9 ]><html class="ie lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>
<!-- loading -->


<body <?php body_class(); ?>>


<div id="main-content" class="site-main box-shadow <?php echo $flatsome_opt['content_color']; ?>" style="max-width:960px;margin:60px auto 60px auto;">

<!-- woocommerce message -->
<?php  if(function_exists('wc_print_notices')) {wc_print_notices();}?>


<div class="checkout-header" style="background-color:<?php echo $flatsome_opt['header_bg']; ?>">
<a id="logo"  href="<?php echo esc_url( home_url( '/' ) ); ?>" style="margin: 0 auto 0 auto;padding:30px 0px 15px;display:block;max-height:<?php echo $flatsome_opt['header_height'];?>px; max-width:<?php echo $flatsome_opt['logo_width'];?>px"  rel="home">
	<?php if($flatsome_opt['site_logo']){
		$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
		echo '<img src="'.$flatsome_opt['site_logo'].'" class="header_logo tip-top"  alt="'.$site_title.'"/>';
	} else {bloginfo( 'name' );}?>
</a>
</div>




<div  class="page-wrapper page-checkout" style="padding:15px 30px 15px;">
<div class="row">
<div id="content" class="large-12 columns" role="main">

<?php while ( have_posts() ) : the_post(); ?>
	<?php  if(function_exists('is_wc_endpoint_url')){ ?>
	<?php if (!is_wc_endpoint_url('order-received')){ ?>
	<div class="checkout-breadcrumb">
		<h1>
			<span class="title-cart"><?php _e('Shopping Cart', 'flatsome'); ?></span>   
			<span class="icon-angle-right divider"></span>    
			<span class="title-checkout"><?php _e('Checkout details', 'flatsome'); ?></span>  
			<span class="icon-angle-right divider"></span>  
			<span class="title-thankyou"><?php _e('Order Complete', 'flatsome'); ?></span>
		</h1>
	</div>
	<?php } ?>
	<?php } else { ?> 
	<div class="checkout-breadcrumb">
		<h1>
			<span class="title-cart"><?php _e('Shopping Cart', 'flatsome'); ?></span>   
			<span class="icon-angle-right divider"></span>    
			<span class="title-checkout"><?php _e('Checkout details', 'flatsome'); ?></span>  
			<span class="icon-angle-right divider"></span>  
			<span class="title-thankyou"><?php _e('Order Complete', 'flatsome'); ?></span>
		</h1>
	</div>
	<?php } ?>

<?php the_content(); ?>
			
<?php endwhile; // end of the loop. ?>	



</div><!-- end #content large-12 -->
</div><!-- end row -->
</div><!-- end page-right-sidebar container -->



<div class="absolute-footer <?php echo $flatsome_opt['footer_bottom_style']; ?>" style="background-color:<?php echo $flatsome_opt['footer_bottom_color']; ?>">
<div class="row">
	<div class="large-12 columns">
		<div class="left">
			 <?php if ( has_nav_menu( 'footer' ) ) : ?>
				<?php  
						wp_nav_menu(array(
							'theme_location' => 'footer',
							'menu_class' => 'footer-nav',
							'depth' => 1,
							'fallback_cb' => false,
						));
				?>						
			<?php endif; ?>
		<div class="copyright-footer"><?php if(isset($flatsome_opt['footer_left_text'])) {echo $flatsome_opt['footer_left_text'];} else{ echo 'Define left footer text / navigation in Theme Option Panel';} ?></div>
		</div><!-- .left -->
		<div class="right">
				<?php if(isset($flatsome_opt['footer_right_text'])){ echo do_shortcode($flatsome_opt['footer_right_text']);} else {echo 'Define right footer text in Theme Option Panel';} ?>
		</div>
	</div><!-- .large-12 -->
</div><!-- .row-->
</div><!-- .absolute-footer -->
</footer><!-- .footer-wrapper -->

</div><!-- #main-content -->

</div><!-- #wrapper -->

<!-- back to top -->
<a href="#top" id="top-link"><span class="icon-angle-up"></span></a>

<?php if(isset($flatsome_opt['html_scripts_footer'])){
	// Insert footer scripts
	echo $flatsome_opt['html_scripts_footer'];
} ?>

<div class="mob-helper"></div>
<?php wp_footer(); ?>

</body>
</html>