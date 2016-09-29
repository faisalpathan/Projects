<?php
/**
 * Core functions.
 *
 * @package Onefold
 */

if ( ! function_exists( 'onefold_get_option' ) ) :

	/**
	 * Get theme option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function onefold_get_option( $key = '' ) {

		global $onefold_default_options;
		if ( empty( $key ) ) {
			return;
		}

		$default = ( isset( $onefold_default_options[ $key ] ) ) ? $onefold_default_options[ $key ] : '';
		$theme_options = (array)get_theme_mod( 'theme_options', $onefold_default_options );
		$theme_options = array_merge( $onefold_default_options, $theme_options );
		$value = '';
		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}
		return $value;

	}

endif;

if ( ! function_exists( 'onefold_get_options' ) ) :

	/**
	 * Get all theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Theme options.
	 */
  function onefold_get_options() {

    $value = array();
    $value = get_theme_mod( 'theme_options' );
    return $value;

  }

endif;

if( ! function_exists( 'onefold_exclude_category_in_blog_page' ) ) :

  /**
   * Exclude category in blog page.
   *
   * @since 1.0
   */
  function onefold_exclude_category_in_blog_page( $query ) {

    if( $query->is_home && $query->is_main_query()   ) {
      $exclude_categories = onefold_get_option( 'exclude_categories' );
      if ( ! empty( $exclude_categories ) ) {
        $cats = explode( ',', $exclude_categories );
        $cats = array_filter( $cats, 'is_numeric' );
        $string_exclude = '';
        if ( ! empty( $cats ) ) {
          $string_exclude = '-' . implode( ',-', $cats);
          $query->set( 'cat', $string_exclude );
        }
      }
    }
    return $query;
  }

endif;

add_filter( 'pre_get_posts', 'onefold_exclude_category_in_blog_page' );
