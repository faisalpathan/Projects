<?php
/*
Plugin Name: PostLove - Content like plugin by Hogash
Plugin URI: http://kallyas.net
Description: A simple plugin that wil add your visitors the ability to love a post
Version: 1.0.0
Author: Hogash
Author URI: http://hogash.com
License: GPL2
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Prepare the current plugin data
define( 'ZNHG_PLH_PATH',		plugin_dir_path( __FILE__ ) );
define( 'ZNHG_PLH_URL',			plugin_dir_url( __FILE__ ) );
define( 'ZNHG_PLH_VERSION',  	'1.0.0' );

// Prepare the framework
if( ! function_exists( 'znhg_plugin_loader' ) && file_exists( ZNHG_PLH_PATH . 'plugin_fw/functions-fw.php' ) ) {
    require_once( ZNHG_PLH_PATH . 'plugin_fw/functions-fw.php' );
}
znhg_plugin_loader( ZNHG_PLH_PATH );

// Main init function for plugin
function znhg_plh_init(){
	znhg_fw_load_framework();
	require_once( ZNHG_PLH_PATH . 'includes/class.znhg-plh.php' );
}
add_action( 'plugins_loaded', 'znhg_plh_init', 11 );