<?php
/**
 * @package WordPress
 * @subpackage prestro
 */

/**
 * header menu (Main menu)
 */
function prestro_header_menu() {
  // display the WordPress Custom Menu if available
  wp_nav_menu(array(
    'menu'              => 'primary',
    'theme_location'    => 'primary',
    'depth'             => 2,
    'container'         => 'div',
    'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse main-nav',
    'menu_class'        => 'nav prestro-nav',
    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
    'walker'            => new wp_bootstrap_navwalker()
  ));
} 
/* Main menu end*/


/**
 * footer menu navigation
 */
function prestro_footer_links() {
  // display the WordPress Custom Menu if available
  wp_nav_menu(array(
    'container'       => '',                              // remove nav container
    'container_class' => 'footer-links clearfix',   // class of container
    'menu'            => __( 'Footer Links', 'prestro' ),   // nav name
    'menu_class'      => 'nav footer-nav clearfix',      // adding custom nav class
    'theme_location'  => 'footer-links',             // where it's located in the theme
    'before'          => '',                                 // before the menu
    'after'           => '',                                  // after the menu
    'link_before'     => '',                            // before each link
    'link_after'      => '',                             // after each link
    'depth'           => 0,                                   // limit the depth of the nav
    'fallback_cb'     => 'prestro_footer_links_fallback'  // fallback function
  ));
}
/* prestro footer link end  */

// Get post widget

function prestro_postview($post_id) {
    $key = 'post_views_count';
    $count = get_post_meta($post_id, $key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($post_id, $key);
        add_post_meta($post_id, $key, '0');
    }else{
        $count++;
        update_post_meta($post_id, $key, $count);
    }
}