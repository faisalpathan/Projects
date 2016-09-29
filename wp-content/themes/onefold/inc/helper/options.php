<?php
/**
 * Helper functions related to customizer and options.
 *
 * @package Onefold
 */

if ( ! function_exists( 'onefold_get_global_layout_options' ) ) :

	/**
	 * Returns global layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function onefold_get_global_layout_options() {

		$choices = array(
			'left-sidebar'  => esc_html__( 'Primary Sidebar - Content', 'onefold' ),
			'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'onefold' ),
			'three-columns' => esc_html__( 'Three Columns', 'onefold' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'onefold' ),
		);
		$output = apply_filters( 'onefold_filter_layout_options', $choices );
		return $output;

	}

endif;

if ( ! function_exists( 'onefold_get_pagination_type_options' ) ) :

	/**
	 * Returns pagination type options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function onefold_get_pagination_type_options() {

		$choices = array(
			'default' => esc_html__( 'Default (Older / Newer Post)', 'onefold' ),
			'numeric' => esc_html__( 'Numeric', 'onefold' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'onefold_get_breadcrumb_type_options' ) ) :

	/**
	 * Returns breadcrumb type options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function onefold_get_breadcrumb_type_options() {

		$choices = array(
			'disabled' => esc_html__( 'Disabled', 'onefold' ),
			'simple'   => esc_html__( 'Simple', 'onefold' ),
		);
		return $choices;

	}

endif;


if ( ! function_exists( 'onefold_get_archive_layout_options' ) ) :

	/**
	 * Returns archive layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function onefold_get_archive_layout_options() {

		$choices = array(
			'full'    => esc_html__( 'Full Post', 'onefold' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'onefold' ),
		);
		$output = apply_filters( 'onefold_filter_archive_layout_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'onefold_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $add_disable True for adding No Image option.
	 * @param array $allowed Allowed image size options.
	 * @return array Image size options.
	 */
	function onefold_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {

		global $_wp_additional_image_sizes;
		$get_intermediate_image_sizes = get_intermediate_image_sizes();
		$choices = array();
		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'onefold' );
		}
		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'onefold' );
		$choices['medium']    = esc_html__( 'Medium', 'onefold' );
		$choices['large']     = esc_html__( 'Large', 'onefold' );
		$choices['full']      = esc_html__( 'Full (original)', 'onefold' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ){
					$choices[ $key ] .= ' ('. $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;

	}

endif;


if ( ! function_exists( 'onefold_get_image_alignment_options' ) ) :

	/**
	 * Returns image options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function onefold_get_image_alignment_options() {

		$choices = array(
			'none'   => _x( 'None', 'Alignment', 'onefold' ),
			'left'   => _x( 'Left', 'Alignment', 'onefold' ),
			'center' => _x( 'Center', 'Alignment', 'onefold' ),
			'right'  => _x( 'Right', 'Alignment', 'onefold' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'onefold_get_featured_slider_transition_effects' ) ) :

	/**
	 * Returns the featured slider transition effects.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function onefold_get_featured_slider_transition_effects() {

		$choices = array(
			'fade'       => _x( 'fade', 'Transition Effect', 'onefold' ),
			'fadeout'    => _x( 'fadeout', 'Transition Effect', 'onefold' ),
			'none'       => _x( 'none', 'Transition Effect', 'onefold' ),
			'scrollHorz' => _x( 'scrollHorz', 'Transition Effect', 'onefold' ),
		);
		$output = apply_filters( 'onefold_filter_featured_slider_transition_effects', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'onefold_get_featured_slider_content_options' ) ) :

	/**
	 * Returns the featured slider content options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function onefold_get_featured_slider_content_options() {

		$choices = array(
			'home-page' => esc_html__( 'Static Front Page Only', 'onefold' ),
			'disabled'  => esc_html__( 'Disabled', 'onefold' ),
		);
		$output = apply_filters( 'onefold_filter_featured_slider_content_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'onefold_get_featured_slider_type' ) ) :

	/**
	 * Returns the featured slider type.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function onefold_get_featured_slider_type() {

		$choices = array(
			'featured-page' => __( 'Featured Pages', 'onefold' ),
		);
		$output = apply_filters( 'onefold_filter_featured_slider_type', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'onefold_get_numbers_dropdown_options' ) ) :

	/**
	 * Returns numbers dropdown options.
	 *
	 * @since 1.0.0
	 *
	 * @param int $min Min.
	 * @param int $max Max.
	 *
	 * @return array Options array.
	 */
	function onefold_get_numbers_dropdown_options( $min = 1, $max = 4 ) {

		$output = array();

		if ( $min <= $max ) {
			for ( $i = $min; $i <= $max; $i++ ) {
				$output[ $i ] = $i;
			}
		}

		return $output;

	}

endif;

if ( ! function_exists( 'onefold_get_home_sections_options' ) ) :

	/**
	 * Returns home sections options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function onefold_get_home_sections_options() {

		$choices = array(
			'services' => array(
				'label'    => __( 'Services', 'onefold' ),
				'template' => 'template-parts/home/services',
				),
			'portfolio' => array(
				'label'    => __( 'Portfolio', 'onefold' ),
				'template' => 'template-parts/home/portfolio',
				),
			'latest-news' => array(
				'label'    => __( 'Latest News', 'onefold' ),
				'template' => 'template-parts/home/latest-news',
				),
			);
		$output = apply_filters( 'onefold_filter_home_sections_options', $choices );
		return $output;

	}

endif;
