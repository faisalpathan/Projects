<?php

/* Global Theme Options variable */
global $flatsome_opt, $smof_data;

// Get Default options
$flatsome_defaults = array (
  'minified_flatsome' => 0,
  'flatsome_builder' => 1,
  'maintenance_mode' => 0,
  'maintenance_mode_text' => 'Please check back soon..',
  'html_scripts_header' => '',
  'html_scripts_footer' => '',
  'product_offcanvas_sidebar' => 0,
  'account_login_style' => 'link',
  'flatsome_docs' => 1,
  'wc_account_links' => 1,
  'html_custom_css' => 'div {}',
  'html_custom_css_mobile' => '',
  'site_logo' => '',
  '' => 'Favicon upload has moved to: <br/> <a href=\'http://localhost:8888/content/wp-admin/customize.php?&autofocus%5Bpanel%5Dof-option-logoandicons\'>Appearance > Customize > Site Identity</a>',
  'custom_cart_icon' => '',
  'site_logo_dark' => '',
  'site_logo_sticky' => '',
  'body_layout' => 'full-width',
  'box_shadow' => 0,
  'body_bg' => '',
  'body_bg_image' => '',
  'body_bg_type' => '',
  'content_color' => 'light',
  'content_bg' => '#FFF',
  'header_height' => '120',
  'logo_width' => '210',
  'logo_position' => 'left',
  'search_pos' => 'left',
  'nav_position' => 'top',
  'nav_size' => '80%',
  'myaccount_dropdown' => 1,
  'show_cart' => 1,
  'header_sticky' => 1,
  'header_height_sticky' => '70',
  'header_color' => 'light',
  'header_bg' => '#fff',
  'header_bg_img' => '',
  'header_bg_img_pos' => 'repeat-x',
  'topbar_show' => 1,
  'topbar_bg' => '',
  'topbar_left' => 'Add anything here here or just remove it..',
  'topbar_right' => '',
  'nav_position_bg' => '#eee',
  'nav_position_color' => 'light',
  'nav_position_text' => 'Add shortcode or text here',
  'nav_position_text_top' => 'Add shortcode or text here',
  'html_after_header' => '',
  'html_intro' => '',
  'footer_left_text' => 'Copyright [ux_current_year] &copy; <strong>UX Themes</strong>. Powered by <strong>WooCommerce</strong>',
  'footer_right_text' => '',
  'footer_1_color' => 'light',
  'footer_1_bg_color' => '#fff',
  'footer_1_bg_image' => '',
  'footer_1_columns' => 'large-3',
  'footer_2_color' => 'dark',
  'footer_2_bg_color' => '#777',
  'footer_2_bg_image' => '',
  'footer_2_columns' => 'large-3',
  'footer_bottom_style' => 'dark',
  'footer_bottom_color' => '#333',
  'html_before_footer' => '',
  'html_after_footer' => '',
  'disable_fonts' => 0,
  'type_headings' => 'Lato',
  'type_texts' => 'Lato',
  'type_nav' => 'Lato',
  'type_alt' => 'Dancing Script',
  'type_subset' => 
  array (
    0 => 'latin',
  ),
  'custom_font' => '',
  'color_primary' => '#627f9a',
  'color_secondary' => '#d26e4b',
  'color_success' => '#7a9c59',
  'color_links' => '',
  'color_checkout' => '',
  'color_sale' => '',
  'color_new_bubble' => '#7a9c59',
  'color_review' => '',
  'button_radius' => '0px',
  'dropdown_border' => '',
  'dropdown_bg' => '',
  'dropdown_text' => 'light',
  'product_sidebar' => 'no_sidebar',
  'product_display' => 'tabs',
  'cart_dropdown_show' => 1,
  'shop_aside_title' => 'complete the look',
  'product_zoom' => 0,
  'related_products' => 'slider',
  'related_products_pr_row' => '4',
  'max_related_products' => '12',
  'tab_title' => '',
  'tab_content' => '',
  'disable_product_scrollbar' => 0,
  'html_before_add_to_cart' => ' ',
  'html_after_add_to_cart' => '',
  'html_shop_page' => '',
  'category_sidebar' => 'left-sidebar',
  'grid_style' => 'grid1',
  'grid_frame' => 'normal',
  'masonry_grid' => 0,
  'add_to_cart_icon' => 'disable',
  'short_description_in_grid' => 0,
  'cat_style' => 'text-badge',
  'breadcrumb_size' => 'breadcrumb-normal',
  'breadcrumb_home' => 1,
  'category_row_count' => '3',
  'category_row_count_mobile' => '2',
  'products_pr_page' => '12',
  'search_result' => 0,
  'product_hover' => 'fade_in_back',
  'bubble_style' => 'style1',
  'sale_bubble_percentage' => 0,
  'disable_quick_view' => 0,
  'wishlist_icon' => 'heart',
  'coupon_checkout' => 0,
  'continue_shopping' => 1,
  'html_cart_footer' => '',
  'html_checkout_sidebar' => '',
  'html_thank_you' => '',
  'catalog_mode' => 0,
  'catalog_mode_prices' => 0,
  'catalog_mode_header' => '',
  'catalog_mode_product' => '',
  'catalog_mode_lightbox' => '',
  'blog_layout' => 'right-sidebar',
  'blog_style' => 'blog-normal',
  'blog_archive_title' => 1,
  'blog_header' => ' ',
  'blog_after_post' => ' ',
  'blog_post_layout' => 'right-sidebar',
  'blog_post_style' => 'default',
  'blog_author_box' => 1,
  'blog_share' => 0,
  'blog_parallax' => 0,
  'featured_items_page' => 0,
  'featured_items_pr_page' => '12',
  'featured_items_related' => '2',
  'featured_items_related_height' => '250px',
  'facebook_login' => 0,
  'facebook_login_bg' => '',
  'facebook_login_text' => '',
  'facebook_login_checkout' => 0,
  'disable_reviews' => 0,
  'social_icons' => 
  array (
    0 => 'facebook',
    1 => 'twitter',
    2 => 'email',
    3 => 'pinterest',
    4 => 'googleplus',
    5 => 'whatsapp',
    6 => 'tumblr',
  ),
  'custom_share_icons' => '',
  'of_backup' => '',
  'of_transfer' => '',
);

if(empty($smof_data)) {$smof_data = array();}

$flatsome_opt = array_merge($flatsome_defaults, $smof_data);

/* Check if WooCommerce is active */
function ux_is_woocommerce_active(){
	return class_exists( 'woocommerce' ) ? true : false;
}

/* Check if WooCommerce is Active */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}


/* Check if Extensions Exists */
if ( ! function_exists( 'is_extension_activated' ) ) {
	function is_extension_activated( $extension ) {
		return class_exists( $extension ) ? true : false;
	}
}

if(!function_exists('is_woocommerce_active')){
    function is_woocommerce_active(){
       return class_exists( 'woocommerce' ) ? true : false;
    }
}

/* Check WooCommerce Version */
function ux_woocommerce_version_check( $version = '2.1' ) {
  if ( function_exists( 'is_woocommerce_active' ) && is_woocommerce_active() ) {
    global $woocommerce;
    if( version_compare( $woocommerce->version, $version, ">=" ) ) {
      return true;
    }
  }
  return false;
}