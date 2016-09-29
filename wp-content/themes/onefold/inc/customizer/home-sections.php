<?php
/**
 * Home Sections Options.
 *
 * @package Onefold
 */

$default = onefold_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'theme_home_sections_panel',
	array(
		'title'      => __( 'Homepage Sections', 'onefold' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		)
);

// Home Section Manager.
$wp_customize->add_section( 'section_home_sections_manager',
	array(
		'title'      => __( 'Manage Sections', 'onefold' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
		)
);

// Setting homepage_sections.
$wp_customize->add_setting( 'theme_options[homepage_sections]',
	array(
		'default'           => $default['homepage_sections'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
);

$wp_customize->add_control(
	new Onefold_Section_Manager_Control(
		$wp_customize,
		'theme_options[homepage_sections]',
		array(
			'label'    => esc_html__( 'Toggle sections', 'onefold' ),
			'section'  => 'section_home_sections_manager',
			'settings' => 'theme_options[homepage_sections]',
			'priority' => 1,
			'args'     => array(
				'sections' => onefold_get_home_sections_options(),
				),
			)
	)
);

// Home Section Services.
$wp_customize->add_section( 'section_home_services',
	array(
		'title'      => __( 'Services', 'onefold' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
		)
);

// Setting services_title.
$wp_customize->add_setting( 'theme_options[services_title]',
	array(
		'default'           => $default['services_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
);
$wp_customize->add_control( 'theme_options[services_title]',
	array(
		'label'    => __( 'Title', 'onefold' ),
		'section'  => 'section_home_services',
		'type'     => 'text',
		'priority' => 100,
		)
);

// Setting services_column.
$wp_customize->add_setting( 'theme_options[services_column]',
	array(
		'default'           => $default['services_column'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'onefold_sanitize_select',
		)
);
$wp_customize->add_control( 'theme_options[services_column]',
	array(
		'label'    => __( 'Columns', 'onefold' ),
		'section'  => 'section_home_services',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => onefold_get_numbers_dropdown_options( 3, 4 ),
		)
);

// Setting services_number.
$wp_customize->add_setting( 'theme_options[services_number]',
	array(
		'default'           => $default['services_number'],
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'onefold_sanitize_number_range',
		)
);
$wp_customize->add_control( 'theme_options[services_number]',
	array(
		'label'           => __( 'No of Blocks', 'onefold' ),
		'description'     => __( 'Enter number between 1 and 10. Save and refresh the page if No of Blocks is changed.', 'onefold' ),
		'section'         => 'section_home_services',
		'type'            => 'number',
		'priority'        => 100,
		'input_attrs'     => array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 55px;' ),
		)
);

$services_number = absint( onefold_get_option( 'services_number' ) );

if ( $services_number > 0 ) {
	for ( $i = 1; $i <= $services_number; $i++ ) {
		$wp_customize->add_setting( "theme_options[services_page_$i]",
			array(
				'default'           => isset( $default[ 'services_page_' . $i ] ) ? $default[ 'services_page_' . $i ] : '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'onefold_sanitize_dropdown_pages',
				)
		);
		$wp_customize->add_control( "theme_options[services_page_$i]",
			array(
				'label'           => __( 'Page', 'onefold' ) . ' #' . $i,
				'section'         => 'section_home_services',
				'type'            => 'dropdown-pages',
				'priority'        => 100,
				)
		);
	}
}

// Home Section Portfolio.
$wp_customize->add_section( 'section_home_portfolio',
	array(
		'title'      => __( 'Portfolio', 'onefold' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
		)
);

// Setting portfolio_title.
$wp_customize->add_setting( 'theme_options[portfolio_title]',
	array(
		'default'           => $default['portfolio_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
);
$wp_customize->add_control( 'theme_options[portfolio_title]',
	array(
		'label'    => __( 'Title', 'onefold' ),
		'section'  => 'section_home_portfolio',
		'type'     => 'text',
		'priority' => 100,
		)
);

// Setting portfolio_column.
$wp_customize->add_setting( 'theme_options[portfolio_column]',
	array(
		'default'           => $default['portfolio_column'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'onefold_sanitize_select',
		)
);
$wp_customize->add_control( 'theme_options[portfolio_column]',
	array(
		'label'    => __( 'Columns', 'onefold' ),
		'section'  => 'section_home_portfolio',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => onefold_get_numbers_dropdown_options( 3, 4 ),
		)
);

// Setting portfolio_number.
$wp_customize->add_setting( 'theme_options[portfolio_number]',
	array(
		'default'           => $default['portfolio_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'onefold_sanitize_number_range',
		)
);
$wp_customize->add_control( 'theme_options[portfolio_number]',
	array(
		'label'       => __( 'No of Blocks', 'onefold' ),
		'section'     => 'section_home_portfolio',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 20, 'step' => 1, 'style' => 'width: 55px;' ),
		)
);

// Setting portfolio_category.
$wp_customize->add_setting( 'theme_options[portfolio_category]',
	array(
		'default'           => $default['portfolio_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Onefold_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[portfolio_category]',
		array(
			'label'    => __( 'Select Category', 'onefold' ),
			'section'  => 'section_home_portfolio',
			'settings' => 'theme_options[portfolio_category]',
			'priority' => 100,
		)
	)
);

// Setting portfolio_background_image.
$wp_customize->add_setting( 'theme_options[portfolio_background_image]',
	array(
		'default'           => $default['portfolio_background_image'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'onefold_sanitize_image',
		)
	);
$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize, 'theme_options[portfolio_background_image]',
		array(
			'label'       => __( 'Background Image', 'onefold' ),
			'description' => sprintf( __( 'Recommended Size: %1$dpx x %2$dpx', 'onefold' ), 1940, 200 ),
			'section'     => 'section_home_portfolio',
			'priority'    => 100,
			'settings'    => 'theme_options[portfolio_background_image]',
			)
		)
	);

// Home Section Latest News.
$wp_customize->add_section( 'section_home_latest_news',
	array(
		'title'      => __( 'Latest News', 'onefold' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
		)
);

// Setting latest_news_title.
$wp_customize->add_setting( 'theme_options[latest_news_title]',
	array(
		'default'           => $default['latest_news_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
);
$wp_customize->add_control( 'theme_options[latest_news_title]',
	array(
		'label'    => __( 'Title', 'onefold' ),
		'section'  => 'section_home_latest_news',
		'type'     => 'text',
		'priority' => 100,
		)
);

// Setting latest_news_column.
$wp_customize->add_setting( 'theme_options[latest_news_column]',
	array(
		'default'           => $default['latest_news_column'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'onefold_sanitize_select',
		)
);
$wp_customize->add_control( 'theme_options[latest_news_column]',
	array(
		'label'    => __( 'Columns', 'onefold' ),
		'section'  => 'section_home_latest_news',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => onefold_get_numbers_dropdown_options( 3, 4 ),
		)
);

// Setting latest_news_number.
$wp_customize->add_setting( 'theme_options[latest_news_number]',
	array(
		'default'           => $default['latest_news_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'onefold_sanitize_number_range',
		)
);
$wp_customize->add_control( 'theme_options[latest_news_number]',
	array(
		'label'       => __( 'No of Blocks', 'onefold' ),
		'section'     => 'section_home_latest_news',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 20, 'step' => 1, 'style' => 'width: 55px;' ),
		)
);

// Setting latest_news_category.
$wp_customize->add_setting( 'theme_options[latest_news_category]',
	array(
		'default'           => $default['latest_news_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Onefold_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[latest_news_category]',
		array(
			'label'    => __( 'Select Category', 'onefold' ),
			'section'  => 'section_home_latest_news',
			'settings' => 'theme_options[latest_news_category]',
			'priority' => 100,
		)
	)
);
