<?php
/**
 * This file will contain the basic functions needed to start the hogash plugin framework
 * Version: 1.0.0
 *
 * @package    Hogash Plugin Framework
 * @author     Hogash - Balasa Sorin Stefan
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt
 * @version    1.0.0
 */

// Exit if accessed directly
if ( ! defined ( 'ABSPATH' ) ) { exit; }

/**
 * This function will prepare the plugin fw data
 */
if ( ! function_exists ( 'znhg_plugin_loader' ) ) {
	function znhg_plugin_loader( $plugin_path ){
		global $znhg_plugin_fw_data;

		$default_headers = array (
			'Version'    => 'Version',
		);

		$framework_data = get_file_data ( trailingslashit ( $plugin_path ) . 'plugin_fw/functions-fw.php', $default_headers );
		$fw_main_file 	= trailingslashit ( $plugin_path ) . 'plugin_fw/znhg-plugin.php';

		// Make sure we alawys use the latest version of framework
		if ( ! empty( $znhg_plugin_fw_data ) ) {
			foreach ( $znhg_plugin_fw_data as $version => $path ) {
				if ( version_compare ( $version, $framework_data[ 'Version' ], '<' ) ) {
					$znhg_plugin_fw_data = array ( $framework_data[ 'Version' ] => $fw_main_file );
				}
			}
		} else {
			$znhg_plugin_fw_data = array ( $framework_data[ 'Version' ] => $fw_main_file );
		}
	}
}

/**
 * This function will load the main plugin framework
 */
if( ! function_exists( 'znhg_fw_load_framework' ) ){
	function znhg_fw_load_framework(){
		global $znhg_plugin_fw_data;
		if( ! empty( $znhg_plugin_fw_data ) ){
			$plugin_fw_file = array_shift( $znhg_plugin_fw_data );
			require_once( $plugin_fw_file );
		}
	}
}


