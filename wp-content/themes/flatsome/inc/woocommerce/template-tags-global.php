<?php

global $flatsome_opt;


/* Clean up WooCommerce default templates */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_show_messages', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );



/* Hook Results and Catalog ordering */
add_action( 'flatsome_shop_category_nav_right', 'woocommerce_result_count', 20 );
add_action( 'flatsome_shop_category_nav_right', 'woocommerce_catalog_ordering', 30 );

/* Add Breadcrumbs */
add_action( 'flatsome_shop_category_nav_left', 'woocommerce_breadcrumb', 20,0);
add_action( 'flatsome_product_before_title', 'woocommerce_breadcrumb', 20,0);

/* Breadcrumb Options */
function flatsome_shop_breadcrumbs( $defaults ) {

    global $flatsome_opt;

    if(!$flatsome_opt['breadcrumb_home']){
        $defaults['home'] = false;
    } else{
        $defaults['home'] = __('Home', 'flatsome');
    }

    $defaults['delimiter'] = '<span>/</span>';
    
    $defaults['wrap_before'] = '<h3 class="category-title-breadcrumb breadcrumb" itemscope="breadcrumb">';
    $defaults['wrap_after'] = '</h3>';

    if(is_product()){
        $defaults['wrap_before'] = '<h4 class="product-breadcrumb breadcrumb" itemscope="breadcrumb">';
        $defaults['wrap_after'] = '</h4>';
    }
    return $defaults;
}

add_filter( 'woocommerce_breadcrumb_defaults', 'flatsome_shop_breadcrumbs' );


/* WooCommerce Quick View */
add_action('wp_ajax_ux_quickview', 'ux_quickview');
add_action('wp_ajax_nopriv_ux_quickview', 'ux_quickview');

/** The Quickview Ajax Output **/
function ux_quickview() {
    global $post, $product, $woocommerce;
    $prod_id =  $_POST["product"];
    $post = get_post($prod_id);
    $product = get_product($prod_id);
    ob_start();
?>

<?php woocommerce_get_template( 'content-single-product-lightbox.php'); ?>

<?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
    die();
}

/* Add WooCommerce templates to Quick View template */
add_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_add_to_cart', 30 );


/* Add .active class to Account navs (WC 2.6+) */
function flatsome_woocommerce_account_menu_item_classes($classes){
    if(in_array("is-active", $classes)) $classes[] = 'current';
    return $classes;
}
add_filter('woocommerce_account_menu_item_classes','flatsome_woocommerce_account_menu_item_classes', 10);


/*  Add to Cart Dropdown (Gets inserted via Ajax) */
add_filter('add_to_cart_fragments', 'flatsome_add_to_cart_dropdown'); 
function flatsome_add_to_cart_dropdown( $fragments ) {
	global $woocommerce;
    global $flatsome_opt;
	ob_start();
	?>
	<div class="cart-inner">
	<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="cart-link">
                    <strong class="cart-name hide-for-small"><?php _e('Cart', 'woocommerce'); ?></strong> 
					<span class="cart-price hide-for-small">/ <?php echo $woocommerce->cart->get_cart_subtotal(); ?></span> 
                        
					<!-- cart icon -->
					<div class="cart-icon">
                        <?php if ($flatsome_opt['custom_cart_icon']){ ?> 
                        <div class="custom-cart-inner">
                        <div class="custom-cart-count"><?php echo $woocommerce->cart->cart_contents_count; ?></div>
                        <img class="custom-cart-icon" alt="<?php _e('Cart', 'woocommerce'); ?>" src="<?php echo $flatsome_opt['custom_cart_icon']?>"/> 
                        </div><!-- .custom-cart-inner -->
                        <?php } else { ?> 

                         <strong><?php echo $woocommerce->cart->cart_contents_count; ?></strong>
                         <span class="cart-icon-handle"></span>
                        <?php } ?>
					</div><!-- end cart icon -->

					</a>
							<div  class="nav-dropdown">
                                <div id="mini-cart-content" class="nav-dropdown-inner widget_shopping_cart widget_shopping_cart_content">
                                <?php                                    
                                    if (sizeof($woocommerce->cart->cart_contents)>0) {
                                        echo woocommerce_mini_cart();
                                    } else {
                                        echo '<p class="empty">'.__('No products in the cart.','woocommerce').'</p>';
                                    }                     
                                ?>                                                                        
                            </div><!-- .nav-dropdown-inner -->
						</div><!-- .nav-dropdown -->
	</div><!-- .cart-inner -->

	<?php
	$fragments['.cart-inner'] = ob_get_clean();
	return $fragments;
}

// Catalogue Mode Option
if(isset($_GET["catalog-mode"]) || $flatsome_opt['catalog_mode']){
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
    remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
    remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
    remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
    remove_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_add_to_cart', 30 );

        if(isset($_GET["catalog-mode"]) || $flatsome_opt['catalog_mode_prices']){
                remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
                remove_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_price', 10 );
        }

        function catalog_mode_product(){
            global $flatsome_opt;
            echo '<div class="catalog-product-text">';
            echo do_shortcode($flatsome_opt['catalog_mode_product']);
            echo '</div>';
        }
        add_action('woocommerce_single_product_summary', 'catalog_mode_product', 30);

        function catalog_mode_lightbox(){
            global $flatsome_opt;
            echo '<div class="catalog-product-text">';
            echo do_shortcode($flatsome_opt['catalog_mode_lightbox']);
            echo '</div>';
        }
        add_action( 'woocommerce_single_product_lightbox_summary', 'catalog_mode_lightbox', 30 );

}

// Login Footer
if(!is_user_logged_in() && $flatsome_opt['account_login_style'] == 'lightbox'){
 function flatsome_login_lightbox(){ ?>
        <div id="login-lightbox" class="mfp-hide mfp-content-inner lightbox-white" 
        style="max-width:850px;padding:0;"> 
        <div class="lightbox-login-header">
        <?php 
            // Get My Account Header
            woocommerce_get_template('myaccount/header.php');
        ?>
        </div>
        <div class="lightbox-login-content" style="padding:15px 20px 0;">
            <?php  echo do_shortcode('[woocommerce_my_account]'); ?>
        </div>
        </div><!-- Login Lightbox -->
        <?php
     }
    add_action('wp_footer','flatsome_login_lightbox',10);
} 

// Disable reviews
if($flatsome_opt['disable_reviews']){
    remove_filter( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

    add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );

    function wcs_woo_remove_reviews_tab($tabs) {
     unset($tabs['reviews']);
     return $tabs;
    }
}