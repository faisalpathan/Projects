<?php
/**
 * Integration logic for WooCommerce extensions
 *
 * @package flatsome
 */


function flatsome_woocommerce_integrations_scripts() {

	if ( is_extension_activated( 'woocommerce_booking' ) ) {
	  wp_enqueue_style( 'flatsome-woocommerce-bookings-style', get_template_directory_uri() . '/inc/woocommerce/integrations/bookings.css', 'flatsome-woocommerce-style' );
	}

	if ( is_extension_activated( 'TM_Extra_Product_Options' ) ) {
      wp_enqueue_style( 'flatsome-woocommerce-extra-product-options', get_template_directory_uri() . '/inc/woocommerce/integrations/extra-product-options.css', 'flatsome-woocommerce-style' );
    }

	if ( is_extension_activated( 'Fancy_Product_Designer' ) ) {
	  wp_enqueue_style( 'flatsome-fancy-product-designer', get_template_directory_uri() . '/inc/woocommerce/integrations/product-designer.css', 'flatsome-woocommerce-style' );
	}

	if ( is_extension_activated( 'Woocommerce_Advanced_Product_Labels' ) ) {
	  wp_enqueue_style( 'flatsome-woocommerce-advanced-labels', get_template_directory_uri() . '/inc/woocommerce/integrations/advanced-product-labels.css', 'flatsome-woocommerce-style' );
	}

	if(function_exists('yith_wcwl_get_template')){
		wp_deregister_style('yith-wcwl-font-awesome');
		wp_deregister_style('yith-wcwl-font-awesome-ie7');
		wp_deregister_style('yith-wcwl-main');
		wp_deregister_style('yith_wcas_frontend');
		wp_enqueue_style( 'flatsome-woocommerce-wishlist', get_template_directory_uri() . '/inc/woocommerce/integrations/wishlist.css', 'flatsome-woocommerce-style' );
	}
}

add_action( 'wp_enqueue_scripts', 'flatsome_woocommerce_integrations_scripts' );

function flatsome_woocommerce_extenstions_after_setup(){
	if ( defined( 'YITH_INFS_VERSION' ) ) {
		$options = get_option('yit_infs_options');

		if(!empty($options) && $options['yith-infs-navselector'] == '.pagination-centered'){
			return;
		}
		
		if(empty($options) ) $options = array();
		
		$new_options = array(
			'yith-infs-navselector' => '.pagination-centered',
			'yith-infs-nextselector' => '.pagination-centered li a.next',
			'yith-infs-itemselector' => 'ul.products li',
			'yith-infs-contentselector' => '#wrapper'
		);

		$options = array_merge($options,$new_options);

		update_option('yit_infs_options',$options);
	}	
}
add_action('init', 'flatsome_woocommerce_extenstions_after_setup', 15);

/* WooCommerce Ajax Navigation */
add_filter('_ajax_layered_nav_containers', 'ux_add_custom_container');
	function ux_add_custom_container($containers){
	$containers[] = '.woocommerce-pagination';
	$containers[] = '.woocommerce-result-count';
	return $containers;
}

/* Yith Ajax Navigation */
add_filter('sod_ajax_layered_nav_product_container', 'aln_product_container');
	function aln_product_container($product_container){
	//Enter either the class or id of the container that holds your products
	return '.products';
}

