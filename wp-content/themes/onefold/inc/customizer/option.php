<?php
/**
 * Theme Options.
 *
 * @package Onefold
 */

$default = onefold_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
	'title'      => __( 'Theme Options', 'onefold' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

// Header Section.
$wp_customize->add_section( 'section_header',
	array(
	'title'      => __( 'Header Options', 'onefold' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting show_title.
$wp_customize->add_setting( 'theme_options[show_title]',
	array(
	'default'           => $default['show_title'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'onefold_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_title]',
	array(
	'label'    => __( 'Show Site Title', 'onefold' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);
// Setting show_tagline.
$wp_customize->add_setting( 'theme_options[show_tagline]',
	array(
	'default'           => $default['show_tagline'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'onefold_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_tagline]',
	array(
	'label'    => __( 'Show Tagline', 'onefold' ),
	'section'  => 'section_header',
	'type'     => 'checkbox',
	'priority' => 100,
	)
);

// Layout Section.
$wp_customize->add_section( 'section_layout',
	array(
	'title'      => __( 'Layout Options', 'onefold' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting global_layout.
$wp_customize->add_setting( 'theme_options[global_layout]',
	array(
	'default'           => $default['global_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'onefold_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[global_layout]',
	array(
	'label'    => __( 'Global Layout', 'onefold' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => onefold_get_global_layout_options(),
	'priority' => 100,
	)
);
// Setting archive_layout.
$wp_customize->add_setting( 'theme_options[archive_layout]',
	array(
	'default'           => $default['archive_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'onefold_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[archive_layout]',
	array(
	'label'    => __( 'Archive Layout', 'onefold' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => onefold_get_archive_layout_options(),
	'priority' => 100,
	)
);
// Setting archive_image.
$wp_customize->add_setting( 'theme_options[archive_image]',
	array(
	'default'           => $default['archive_image'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'onefold_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[archive_image]',
	array(
	'label'    => __( 'Image in Archive', 'onefold' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => onefold_get_image_sizes_options( true, array( 'disable', 'thumbnail', 'large' ), false ),
	'priority' => 100,
	)
);
// Setting archive_image_alignment.
$wp_customize->add_setting( 'theme_options[archive_image_alignment]',
	array(
	'default'           => $default['archive_image_alignment'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'onefold_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[archive_image_alignment]',
	array(
	'label'           => __( 'Image Alignment in Archive', 'onefold' ),
	'section'         => 'section_layout',
	'type'            => 'select',
	'choices'         => onefold_get_image_alignment_options(),
	'priority'        => 100,
	'active_callback' => 'onefold_is_image_in_archive_active',
	)
);
// Setting single_image.
$wp_customize->add_setting( 'theme_options[single_image]',
	array(
	'default'           => $default['single_image'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'onefold_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[single_image]',
	array(
	'label'    => __( 'Image in Single Post/Page', 'onefold' ),
	'section'  => 'section_layout',
	'type'     => 'select',
	'choices'  => onefold_get_image_sizes_options( true, array( 'disable', 'large' ), false ),
	'priority' => 100,
	)
);

// Home Page Section.
$wp_customize->add_section( 'section_home_page',
	array(
	'title'      => __( 'Home Page Options', 'onefold' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);
// Setting home_content_status.
$wp_customize->add_setting( 'theme_options[home_content_status]',
	array(
	'default'           => $default['home_content_status'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'onefold_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[home_content_status]',
	array(
	'label'       => __( 'Show Home Content', 'onefold' ),
	'description' => __( 'Check this to show page content in Home page.', 'onefold' ),
	'section'     => 'section_home_page',
	'type'        => 'checkbox',
	'priority'    => 100,
	)
);

// Pagination Section.
$wp_customize->add_section( 'section_pagination',
	array(
	'title'      => __( 'Pagination Options', 'onefold' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting pagination_type.
$wp_customize->add_setting( 'theme_options[pagination_type]',
	array(
	'default'           => $default['pagination_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'onefold_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[pagination_type]',
	array(
	'label'       => __( 'Pagination Type', 'onefold' ),
	'section'     => 'section_pagination',
	'type'        => 'select',
	'choices'     => onefold_get_pagination_type_options(),
	'priority'    => 100,
	)
);

// Footer Section.
$wp_customize->add_section( 'section_footer',
	array(
	'title'      => __( 'Footer Options', 'onefold' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'theme_options[copyright_text]',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'theme_options[copyright_text]',
	array(
	'label'    => __( 'Copyright Text', 'onefold' ),
	'section'  => 'section_footer',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting show_social_in_footer.
$wp_customize->add_setting( 'theme_options[show_social_in_footer]',
	array(
		'default'           => $default['show_social_in_footer'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'onefold_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[show_social_in_footer]',
	array(
		'label'    => __( 'Show Social Icons', 'onefold' ),
		'section'  => 'section_footer',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting go_to_top.
$wp_customize->add_setting( 'theme_options[go_to_top]',
	array(
		'default'           => $default['go_to_top'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'onefold_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[go_to_top]',
	array(
		'label'    => __( 'Show Go To Top', 'onefold' ),
		'section'  => 'section_footer',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Footer Widgets Section.
$wp_customize->add_section( 'section_footer_widgets',
	array(
	'title'      => __( 'Footer Widgets Options', 'onefold' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting enable_footer_widgets_background_image.
$wp_customize->add_setting( 'theme_options[enable_footer_widgets_background_image]',
	array(
	'default'           => $default['enable_footer_widgets_background_image'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'onefold_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[enable_footer_widgets_background_image]',
	array(
		'label'    => __( 'Enable Background Image', 'onefold' ),
		'section'  => 'section_footer_widgets',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting footer_widgets_background_image.
$wp_customize->add_setting( 'theme_options[footer_widgets_background_image]',
	array(
		'default'           => $default['footer_widgets_background_image'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'onefold_sanitize_image',
		)
	);
$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize, 'theme_options[footer_widgets_background_image]',
		array(
			'label'           => __( 'Background Image', 'onefold' ),
			'description'     => sprintf( __( 'Recommended Size: %1$dpx x %2$dpx', 'onefold' ), 1940, 200 ),
			'section'         => 'section_footer_widgets',
			'priority'        => 100,
			'settings'        => 'theme_options[footer_widgets_background_image]',
			'active_callback' => 'onefold_is_footer_widgets_background_image_active',
			)
		)
	);

// Blog Section.
$wp_customize->add_section( 'section_blog',
	array(
	'title'      => __( 'Blog Options', 'onefold' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting excerpt_length.
$wp_customize->add_setting( 'theme_options[excerpt_length]',
	array(
	'default'           => $default['excerpt_length'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'onefold_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'theme_options[excerpt_length]',
	array(
	'label'       => __( 'Excerpt Length', 'onefold' ),
	'description' => __( 'in words', 'onefold' ),
	'section'     => 'section_blog',
	'type'        => 'number',
	'priority'    => 100,
	'input_attrs' => array( 'min' => 1, 'max' => 200, 'style' => 'width: 55px;' ),
	)
);

// Setting read_more_text.
$wp_customize->add_setting( 'theme_options[read_more_text]',
	array(
	'default'           => $default['read_more_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[read_more_text]',
	array(
	'label'    => __( 'Read More Text', 'onefold' ),
	'section'  => 'section_blog',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting exclude_categories.
$wp_customize->add_setting( 'theme_options[exclude_categories]',
	array(
	'default'           => $default['exclude_categories'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[exclude_categories]',
	array(
	'label'       => __( 'Exclude Categories in Blog', 'onefold' ),
	'description' => __( 'Enter category ID to exclude in Blog Page. Separate with comma if more than one', 'onefold' ),
	'section'     => 'section_blog',
	'type'        => 'text',
	'priority'    => 100,
	)
);

// Breadcrumb Section.
$wp_customize->add_section( 'section_breadcrumb',
	array(
	'title'      => __( 'Breadcrumb Options', 'onefold' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting( 'theme_options[breadcrumb_type]',
	array(
	'default'           => $default['breadcrumb_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'onefold_sanitize_select',
	)
);
$wp_customize->add_control( 'theme_options[breadcrumb_type]',
	array(
	'label'       => __( 'Breadcrumb Type', 'onefold' ),
	'section'     => 'section_breadcrumb',
	'type'        => 'select',
	'choices'     => onefold_get_breadcrumb_type_options(),
	'priority'    => 100,
	)
);

// Advanced Section.
$wp_customize->add_section( 'section_advanced',
	array(
	'title'      => __( 'Advanced Options', 'onefold' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting custom_css.
$wp_customize->add_setting( 'theme_options[custom_css]',
	array(
	'default'              => $default['custom_css'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'wp_strip_all_tags',
	)
);
$wp_customize->add_control( 'theme_options[custom_css]',
	array(
	'label'    => __( 'Custom CSS', 'onefold' ),
	'section'  => 'section_advanced',
	'type'     => 'textarea',
	'priority' => 100,
	)
);
