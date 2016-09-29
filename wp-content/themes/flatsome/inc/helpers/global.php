<?php

// Check if WooCommerce is active

// Flatsome Admin Bar helper

function flatsome_admin_bar_helper(){

    global $wp_admin_bar;

      $optionUrl = get_admin_url().'themes.php?page=optionsframework';
      $adminUrl = get_admin_url();


      if(is_category() || is_home()){
       $wp_admin_bar->add_menu( array(
               'parent' => false,
               'id' => 'admin_bar_helper',
               'title' => 'Blog Layout',
               'href' => $optionUrl.'&tab=of-option-blog',
        ));
      }


     if(ux_is_woocommerce_active()) { 

         if(is_checkout() || is_cart() ){
                 $wp_admin_bar->add_menu( array(
                     'parent' => false,
                     'id' => 'admin_bar_helper',
                     'title' => 'Checkout Settings',
                     'href' => $adminUrl.'admin.php?page=wc-settings&tab=checkout',
                 ));
          }


          if(is_product()){
                 $wp_admin_bar->add_menu( array(
                     'parent' => false,
                     'id' => 'admin_bar_helper',
                     'title' => 'Product Page',
                     'href' => $optionUrl.'&tab=of-option-productpage',
                 ));
          }


            if(is_account_page()){
                 $wp_admin_bar->add_menu( array(
                     'parent' => false,
                     'id' => 'admin_bar_helper',
                     'title' => 'My Account Page',
                     'href' => $adminUrl.'admin.php?page=wc-settings&tab=account',
                 ));
             }



              if(is_shop() || is_product_category()){
                 $wp_admin_bar->add_menu( array(
                     'parent' => false,
                     'id' => 'admin_bar_helper',
                     'title' => 'Shop Settings',
                 ));

                  $wp_admin_bar->add_menu( array(
                     'parent' => 'admin_bar_helper',
                     'id' => 'admin_bar_helper_flatsome',
                     'title' => 'Category Page Layout',
                     'href' => $optionUrl.'&tab=of-option-categorypage',
                 ));

                  $wp_admin_bar->add_menu( array(
                     'parent' => 'admin_bar_helper',
                     'id' => 'admin_bar_helper_woocommerce',
                     'title' => 'Shop Page Display',
                     'href' => $adminUrl.'admin.php?page=wc-settings&tab=products&section=display',
                 ));
          }

      }
 
}

add_action( 'wp_before_admin_bar_render', 'flatsome_admin_bar_helper' , 1 );


// Flatsome Maintenance Mode
if($flatsome_opt['maintenance_mode']){

function flatsome_maintenance_mode_on_activation()  {
  if ( ! current_user_can( 'activate_plugins' ) )
  return;
  $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
  check_admin_referer( "activate-plugin_{$plugin}" );
  
    // Clear Cachify Cache
    if ( has_action('cachify_flush_cache') ) {
    do_action('cachify_flush_cache');
    }
    
    // Clear Super Cache
    if ( function_exists( 'wp_cache_clear_cache' ) ) {
    ob_end_clean();
    wp_cache_clear_cache();
    }
    
    // Clear W3 Total Cache
    if ( function_exists( 'w3tc_pgcache_flush' ) ) {
    ob_end_clean();
    w3tc_pgcache_flush();
    }
}

function flatsome_maintenance_mode_on_deactivation() {
  if ( ! current_user_can( 'activate_plugins' ) )
  return;
  $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
  check_admin_referer( "deactivate-plugin_{$plugin}" );
  
    // Clear Cachify Cache
    if ( has_action('cachify_flush_cache') ) {
    do_action('cachify_flush_cache');
    }
    
    // Clear Super Cache
    if ( function_exists( 'wp_cache_clear_cache' ) ) {
    ob_end_clean();
    wp_cache_clear_cache();
    }
    
    // Clear W3 Total Cache
    if ( function_exists( 'w3tc_pgcache_flush' ) ) {
    ob_end_clean();
    w3tc_pgcache_flush();
  }
}

register_activation_hook(   __FILE__, 'flatsome_maintenance_mode_on_activation' );
register_deactivation_hook( __FILE__, 'flatsome_maintenance_mode_on_deactivation' );

/**
 * Alert message when active
*/
$smm_active_message = __('<strong>Maintenance mode</strong> is <strong>active</strong>!', 'flatsome-maintenance-mode' );
$smm_admin_notice = '<div id="message" class="error fade"><p>' . $smm_active_message . ' <a href="themes.php?page=optionsframework&tab=of-option-globalsettings">' . __( 'Deactivate it, when work is done.', 'flatsome-maintenance-mode' ) . '</a></p></div>';

if ( is_multisite() && is_plugin_active_for_network( plugin_basename( __FILE__ ) ) )
add_action( 'network_admin_notices', create_function( '', "echo '$smm_admin_notice';" ) ); 
add_action( 'admin_notices', create_function( '', "echo '$smm_admin_notice';" ) ); 
add_filter( 'login_message', create_function( '', "return '<div id=\"login_error\">$smm_active_message</div>';" ) );

/**
 * Maintenance message when active
*/ 
function flatsome_maintenance_mode()
{
  global $flatsome_opt;

  nocache_headers();
  if(!current_user_can('edit_themes') || !is_user_logged_in()) {
  wp_die( '<center><img src="'.$flatsome_opt['site_logo'].'"/ style="max-width:200px;"><h2>' . __( 'Maintenance', 'flatsome-maintenance-mode' ) . '</h2><p>' . $flatsome_opt['maintenance_mode_text'] . '</p></center>', __( 'Maintenance', 'flatsome-maintenance-mode' ), array('response' => '503'));
  }
}
add_action('get_header', 'flatsome_maintenance_mode');

}