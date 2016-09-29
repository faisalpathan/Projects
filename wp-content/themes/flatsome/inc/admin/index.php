<?php

/*
Title		: SMOF
Description	: Slightly Modified Options Framework
Version		: 1.5.2
Author		: Syamil MJ
Author URI	: http://aquagraphite.com
License		: GPLv3 - http://www.gnu.org/copyleft/gpl.html

Credits		: Thematic Options Panel - http://wptheming.com/2010/11/thematic-options-panel-v2/
		 	  Woo Themes - http://woothemes.com/
		 	  Option Tree - http://wordpress.org/extend/plugins/option-tree/

Contributors: Syamil MJ - http://aquagraphite.com
			  Andrei Surdu - http://smartik.ws/
			  Jonah Dahlquist - http://nucleussystems.com/
			  partnuz - https://github.com/partnuz
			  Alex Poslavsky - https://github.com/plovs
			  Dovy Paukstys - http://simplerain.com
*/

define( 'SMOF_VERSION', '1.5.2' );

/**
 * Definitions
 *
 * @since 1.4.0
 */
$theme_version = '';
$smof_output = '';
	    
if( function_exists( 'wp_get_theme' ) ) {
	if( is_child_theme() ) {
		$temp_obj = wp_get_theme();
		$theme_obj = wp_get_theme( $temp_obj->get('Template') );
	} else {
		$theme_obj = wp_get_theme();    
	}

	$theme_version = $theme_obj->get('Version');
	$theme_name = $theme_obj->get('Name');
	$theme_uri = $theme_obj->get('ThemeURI');
	$author_uri = $theme_obj->get('AuthorURI');
} else {
	$theme_data = wp_get_theme( get_template_directory().'/style.css' );
	$theme_version = $theme_data['Version'];
	$theme_name = $theme_data['Name'];
	$theme_uri = $theme_data['ThemeURI'];
	$author_uri = $theme_data['AuthorURI'];
}


if( !defined('ADMIN_PATH') )
	define( 'ADMIN_PATH', get_template_directory() . '/inc/admin/' );
if( !defined('ADMIN_DIR') )
	define( 'ADMIN_DIR', get_template_directory_uri() . '/inc/admin/' );

define( 'ADMIN_IMAGES', ADMIN_DIR . 'assets/images/' );

define( 'LAYOUT_PATH', ADMIN_PATH . 'layouts/' );
define( 'THEMENAME', $theme_name );
/* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
define( 'THEMEVERSION', $theme_version );
define( 'THEMEURI', $theme_uri );
define( 'THEMEAUTHORURI', $author_uri );

define( 'BACKUPS','backups' );

/**
 * Required action filters
 *
 * @uses add_action()
 *
 * @since 1.0.0
 */
//if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) add_action('admin_head','of_option_setup');
add_action('admin_head', 'optionsframework_admin_message');
add_action('admin_init','optionsframework_admin_init');
add_action('admin_menu', 'optionsframework_add_admin');

/**
 * Required Files
 *
 * @since 1.0.0
 */ 
require_once ( ADMIN_PATH . 'functions/functions.load.php' );
require_once ( ADMIN_PATH . 'classes/class.options_machine.php' );

/**
 * AJAX Saving Options
 *
 * @since 1.0.0
 */
add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');


/* Theme Option Menu */

function flatsome_theme_option_dropdown() {
 global $wp_admin_bar;

 // Add a new top level menu link
if (current_user_can( 'manage_options' ) ){
 
  $optionUrl = get_admin_url().'themes.php?page=optionsframework';

  // top menu
  $wp_admin_bar->add_menu( array(
	 'parent' => false,
	 'id' => 'theme_options',
	 'title' => 'Theme Options',
	 'href' => $optionUrl,

 ));


  $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_globalsettings',
   'title' => 'Global settings',
   'href' => $optionUrl.'&tab=of-option-globalsettings',
 ));


  $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_htmlblocks_custom_css',
   'title' => 'Custom CSS',
   'href' => $optionUrl.'&tab=of-option-customcss',
 ));


  // Logo and Icons
  $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_logo_icons',
   'title' => 'Logo and Icons',
   'href' => $optionUrl.'&tab=of-option-logoandicons',
 ));

    // Logo and Icons
  $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_layout',
   'title' => 'Layout',
   'href' => $optionUrl.'&tab=of-option-layout',
 ));


  $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_header',
   'title' => 'Header',
   'href' => $optionUrl.'&tab=of-option-header',
 ));

  $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_footer',
   'title' => 'Footer',
   'href' => $optionUrl.'&tab=of-option-footer',
 ));

  $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_fonts',
   'title' => __('Fonts', 'ux-admin'),
   'href' => $optionUrl.'&tab=of-option-fonts',
 ));

  $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_styleandcolor',
   'title' => 'Style and Colors',
   'href' => $optionUrl.'&tab=of-option-styleandcolors',
 ));

if(ux_is_woocommerce_active()) { 
      $wp_admin_bar->add_menu( array(
     'parent' => 'theme_options',
     'id' => 'theme_options_productpage',
     'title' => 'Product Page',
     'href' => $optionUrl.'&tab=of-option-productpage',
   ));


      $wp_admin_bar->add_menu( array(
     'parent' => 'theme_options',
     'id' => 'theme_options_categorypage',
     'title' => 'Category Page',
     'href' => $optionUrl.'&tab=of-option-categorypage',
   ));

    $wp_admin_bar->add_menu( array(
     'parent' => 'theme_options',
     'id' => 'theme_options_accountandsocial',
     'title' => 'Cart and Checkout',
     'href' => $optionUrl.'&tab=of-option-cartandcheckout',
   ));

      $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_catalogmode',
   'title' => 'Catalog Mode',
   'href' => $optionUrl.'&tab=of-option-catalogmode',
 )); 

  }

  $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_blog',
   'title' => 'Blog',
   'href' => $optionUrl.'&tab=of-option-blog',
 ));

 $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_featureditems',
   'title' => 'Featured Items',
   'href' => $optionUrl.'&tab=of-option-featureditems',
 ));


  $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_socialandsharing',
   'title' => 'Social and Sharing',
   'href' => $optionUrl.'&tab=of-option-socialandsharing',
 ));


 $wp_admin_bar->add_menu( array(
   'parent' => 'theme_options',
   'id' => 'theme_options_backupandimport',
   'title' => 'Backup and Import',
   'href' => $optionUrl.'&tab=of-option-backupandimport',
 ));

}
}
add_action( 'wp_before_admin_bar_render', 'flatsome_theme_option_dropdown' , 1 );