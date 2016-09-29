<?php
/**
 * Default theme options.
 *
 * @package Onefold
 */

if ( ! function_exists( 'onefold_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function onefold_get_default_theme_options() {

		$defaults = array();

		// Header.
		$defaults['show_title']   = true;
		$defaults['show_tagline'] = false;

		// Layout.
		$defaults['global_layout']           = 'right-sidebar';
		$defaults['archive_layout']          = 'excerpt';
		$defaults['archive_image']           = 'large';
		$defaults['archive_image_alignment'] = 'center';
		$defaults['single_image']            = 'large';

		// Home Page.
		$defaults['home_content_status'] = true;

		// Pagination.
		$defaults['pagination_type'] = 'numeric';

		// Footer.
		$defaults['copyright_text']        = esc_html__( 'Copyright &copy; All rights reserved.', 'onefold' );
		$defaults['show_social_in_footer'] = false;
		$defaults['go_to_top']             = true;

		// Footer widgets.
		$defaults['enable_footer_widgets_background_image'] = false;
		$defaults['footer_widgets_background_image']        = '';

		// Blog.
		$defaults['excerpt_length']     = 40;
		$defaults['read_more_text']     = esc_html__( 'Read more', 'onefold' );
		$defaults['exclude_categories'] = '';

		// Breadcrumb.
		$defaults['breadcrumb_type'] = 'simple';

		// Advanced.
		$defaults['custom_css'] = '';

		// Homepage Sections.
		$defaults['homepage_sections'] = 'services,portfolio,latest-news';

		// Homepage Services.
		$defaults['services_title']  = esc_html__( 'Services', 'onefold' );
		$defaults['services_number'] = 6;
		$defaults['services_column'] = 3;

		// Homepage Portfolio.
		$defaults['portfolio_title']            = esc_html__( 'Recent Works', 'onefold' );
		$defaults['portfolio_category']         = 0;
		$defaults['portfolio_number']           = 6;
		$defaults['portfolio_column']           = 3;
		$defaults['portfolio_background_image'] = '';

		// Homepage Latest News.
		$defaults['latest_news_title']    = esc_html__( 'Latest News', 'onefold' );
		$defaults['latest_news_category'] = 0;
		$defaults['latest_news_number']   = 4;
		$defaults['latest_news_column']   = 4;

		// Slider Options.
		$defaults['featured_slider_status']              = 'disabled';
		$defaults['featured_slider_transition_effect']   = 'fadeout';
		$defaults['featured_slider_transition_delay']    = 3;
		$defaults['featured_slider_transition_duration'] = 1;
		$defaults['featured_slider_enable_caption']      = true;
		$defaults['featured_slider_enable_arrow']        = true;
		$defaults['featured_slider_enable_pager']        = true;
		$defaults['featured_slider_enable_autoplay']     = true;
		$defaults['featured_slider_type']                = 'featured-page';
		$defaults['featured_slider_number']              = 3;
		$defaults['featured_slider_read_more_text']      = esc_html__( 'Read More', 'onefold' );

		// Pass through filter.
		$defaults = apply_filters( 'onefold_filter_default_theme_options', $defaults );
		return $defaults;
	}

endif;
