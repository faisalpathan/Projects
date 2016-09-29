<?php

/* Fixes for WordPress Multilangual plugins */

/* Copy polylang content to new languages */
if (function_exists('pll_get_post')){ // is Polylang activated?
  add_filter('default_content','ux_copy_post_translation', 100, 2);
  add_filter('default_title','ux_copy_post_translation', 100, 2);
  function ux_copy_post_translation($content, $post){
          $from_post = isset($_GET['from_post'])? (int)$_GET['from_post'] : false;
          if($content == ''){
                  $from_post = get_post($from_post);
                  if($from_post)
                  switch(current_filter()){
                          case 'default_content':
                                  $content = $from_post->post_content;
                                  break;
                          case 'default_title':
                                  $content = $from_post->post_title;
                                  break;
                          default:
                                  break;
                  }
          }
          return $content;
  }
}

/* WooCommerce fixes */
if(ux_is_woocommerce_active()){

        if (function_exists('pll_get_post')){ // is Polylang activated?
        add_filter('woocommerce_get_cart_page_id', 'pll_woocommerce_get_cart_page_id_ux');
        add_filter('woocommerce_get_checkout_page_id', 'pll_woocommerce_get_checkout_page_id_ux');
        function pll_woocommerce_get_cart_page_id_ux($id) {
            return pll_get_post($id); // translate the page to current language
        }
        function pll_woocommerce_get_checkout_page_id_ux($id) {
            return pll_get_post($id); // translate the page to current language
        }
      }

      if (function_exists('pll_get_post') || function_exists('icl_object_id')){
        add_action('wp_enqueue_scripts', 'ux_cartcache_enqueue_scripts', 100);
        
        function ux_cartcache_enqueue_scripts()
          {
            wp_deregister_script('wc-cart-fragments');
            wp_enqueue_script( 'wc-cart-fragments', get_template_directory_uri()  . '/js/fixes/cart-fragments-wpml.js', array( 'jquery', 'jquery-cookie' ), '1.0', true );
          }
    }
}

function wp_page_menu_filter2($items) {
  $items = str_replace('menu-item-language-current', 'menu-item-language-current has-dropdown  menu-item-has-children', $items);
  $items = str_replace('submenu-languages', 'submenu-languages nav-dropdown', $items);
  return $items;
}
add_filter('wp_nav_menu_items', 'wp_page_menu_filter2', 10, 3);