<?php

if ( ! isset( $content_width ) ) $content_width = 1020; /* pixels */


if ( ! function_exists( 'flatsome_setup' ) ) :
function flatsome_setup() {


  /* add woocommerce support */
  add_theme_support( 'woocommerce' );

  /* add title tag support */
  add_theme_support( 'title-tag' );

  /* Add excerpt to pages */
  add_post_type_support( 'page', 'excerpt' );

  // wp-content/themes/flatsome-child-theme/languages/nb_NO.mo
  load_theme_textdomain( 'flatsome', get_stylesheet_directory() . '/languages' );

  /* load theme languages */
  load_theme_textdomain( 'flatsome', get_template_directory() . '/languages' );
  
  /* Add default posts and comments RSS feed links to head */
  add_theme_support( 'automatic-feed-links' );

  /* Add support for post thumbnails */
  add_theme_support( 'post-thumbnails' );

  /* Add support for HTML5 */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    //'gallery',
    'caption',
    'widgets',
  ) );

  /*  Registrer menus. */
  register_nav_menus( array(
    'primary' => __( 'Main Menu', 'flatsome' ),
    'primary_mobile' => __( 'Main Menu - Mobile', 'flatsome' ),
    'footer' => __( 'Footer Menu', 'flatsome' ),
    'top_bar_nav' => __( 'Top bar Menu', 'flatsome' ),
    'my_account' => __( 'My Account Menu', 'flatsome' ),
  ) );

  /*  Enable support for Post Formats */
  //add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // flatsome_setup
add_action( 'after_setup_theme', 'flatsome_setup' );





/**
 * Register widgetized area and update sidebar with default widgets
 */
function flatsome_widgets_init() {
  global $flatsome_opt;

  register_sidebar( array(
    'name'          => __( 'Sidebar', 'flatsome' ),
    'id'            => 'sidebar-main',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3><div class="tx-div small"></div>',
  ) );


  register_sidebar( array(
    'name'          => __( 'Shop Sidebar', 'flatsome' ),
    'id'            => 'shop-sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title shop-sidebar">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Product Sidebar', 'flatsome' ),
    'id'            => 'product-sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title shop-sidebar">',
    'after_title'   => '</h3>',
  ) );


  $footer_1 = 'large-3';
  $footer_2 = 'large-3';

  if(isset($flatsome_opt['footer_1_columns'])){
    $footer_1 = $flatsome_opt['footer_1_columns'];
    $footer_2 = $flatsome_opt['footer_2_columns'];
  }


   register_sidebar( array(
    'name'          => __( 'Footer 1', 'flatsome' ),
    'id'            => 'sidebar-footer-1',
    'before_widget' => '<div id="%1$s" class="'.$footer_1.' columns widget left %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3><div class="tx-div small"></div>',
  ) );


   register_sidebar( array(
    'name'          => __( 'Footer 2', 'flatsome' ),
    'id'            => 'sidebar-footer-2',
    'before_widget' => '<div id="%1$s" class="'.$footer_2.' columns widget left %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3><div class="tx-div small"></div>',
  ) );
}

add_action( 'widgets_init', 'flatsome_widgets_init' );



/* Setup Flatsome Scripts and CSS */
function flatsome_scripts() {
  
  global $flatsome_opt;

  $theme = wp_get_theme('flatsome');
  $version = $theme['Version'];

  /* Styles */
  if(!isset($flatsome_opt['minified_flatsome']) || !$flatsome_opt['minified_flatsome']){
     wp_enqueue_style( 'flatsome-icons', get_template_directory_uri() .'/css/fonts.css', array(), $version, 'all' );
     wp_enqueue_style( 'flatsome-animations', get_template_directory_uri() .'/css/animations.css', array(), $version, 'all' );
     wp_enqueue_style( 'flatsome-main-css', get_template_directory_uri() .'/css/foundation.css', array(), $version, 'all' );
     wp_register_style('flatsome-effect', get_template_directory_uri() .'/css/effects.css', array(), $version, 'all' );
  } else {
     wp_enqueue_style( 'flatsome-css-minified', get_template_directory_uri() .'/css/flatsome.min.css', array(), $version, 'all' );
  }

  /* Load Custom styles CSS */
  wp_enqueue_style( 'flatsome-style', get_stylesheet_uri(), array(), $version, 'all');

  /* JS libaries */
  if(!isset($flatsome_opt['minified_flatsome']) || !$flatsome_opt['minified_flatsome']){
    wp_enqueue_script( 'flatsome-modernizer', get_template_directory_uri() .'/js/modernizr.js', array( 'jquery' ), $version, true );
    wp_enqueue_script( 'flatsome-plugins-js', get_template_directory_uri() .'/js/flatsome-plugins.js', array( 'jquery' ), $version, true );
    wp_enqueue_script( 'flatsome-theme-js', get_template_directory_uri() .'/js/flatsome-theme.js', array( 'jquery' ), $version, true );
    if (ux_is_woocommerce_active()) {
        wp_enqueue_script( 'flatsome-woocommerce-js', get_template_directory_uri() .'/js/flatsome-woocommerce.js', array( 'jquery' ), $version, true );
    }
  } else {
    wp_enqueue_script( 'flatsome-theme-js-minified', get_template_directory_uri() .'/js/flatsome.min.js', array( 'jquery' ), $version, true );
  }

  /* add JS variables to scripts */
  wp_localize_script( 'flatsome-theme-js', 'ajaxURL',  array( 'ajaxurl'    => admin_url( 'admin-ajax.php' ) ) );
  wp_localize_script( 'flatsome-theme-js-minified', 'ajaxURL',  array( 'ajaxurl'    => admin_url( 'admin-ajax.php' ) ) );

  /* Remove plugin styles */
  wp_deregister_style('nextend_fb_connect_stylesheet');

  // Remove WooCommerce pretty photo
  wp_deregister_style( 'woocommerce_prettyPhoto_css' );
  wp_dequeue_script( 'prettyPhoto' );
  wp_dequeue_script( 'prettyPhoto-init' );
  
  if ( ! is_admin() ) {
    wp_deregister_style('woocommerce-layout');  
    wp_deregister_style('woocommerce-smallscreen'); 
    wp_deregister_style('woocommerce-general'); 
  }


  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

}
add_action( 'wp_enqueue_scripts', 'flatsome_scripts' );

function flatsome_image_dimensions() {
  global $pagenow;
 
  if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
    return;
  }

  $old_thumb = get_option( 'thumbnail_size_w' );
  $old_medium = get_option( 'medium_size_w' );
  $old_large = get_option( 'large_size_w' );

  // Image sizes
  if($old_thumb == '150'){
      update_option( 'thumbnail_size_h', '340' ); 
      update_option( 'thumbnail_size_w', '340' );
  }
  if($old_medium == '300'){
      update_option( 'medium_size_w', '800' );
      update_option( 'medium_size_h', '800' );
  }
  if($old_large == '1024'){
     update_option( 'large_size_w', '1600' );
     update_option( 'large_size_h', '1600' );
  }
}
add_action( 'after_switch_theme', 'flatsome_image_dimensions', 1 );