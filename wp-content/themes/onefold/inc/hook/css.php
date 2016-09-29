<?php
/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package Onefold
 */

if ( ! function_exists( 'onefold_trigger_custom_css_action' ) ) :

	/**
	 * Do action theme custom CSS.
	 *
	 * @since 1.0.0
	 */
	function onefold_trigger_custom_css_action() {

		/**
		 * Hook - onefold_action_theme_custom_css.
		 *
		 * @hooked onefold_add_option_custom_css - 99
		 */
		do_action( 'onefold_action_theme_custom_css' );

	}

endif;

add_action( 'wp_head', 'onefold_trigger_custom_css_action', 99 );

if ( ! function_exists( 'onefold_add_option_custom_css' ) ) :

	/**
	 * Add custom CSS.
	 *
	 * @since 1.0.0
	 */
	function onefold_add_option_custom_css() {

		$custom_css = onefold_get_option( 'custom_css' );
		$output = '';
		if ( ! empty( $custom_css ) ) {
			$output = "\n" . '<style type="text/css">' . "\n";
			$output .= wp_strip_all_tags( $custom_css );
			$output .= "\n" . '</style>' . "\n" ;
		}
		echo $output;

	}

endif;

add_action( 'onefold_action_theme_custom_css', 'onefold_add_option_custom_css', 99 );
