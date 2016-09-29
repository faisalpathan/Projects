<?php
/** Theme Name: Spina
 *  Theme Core Functions and Codes
 **/
define('child_template_directory', dirname( get_bloginfo('stylesheet_url')) );
add_action('wp_footer', 'spina_enqueue_in_footer_child');
function spina_enqueue_in_footer_child()
{
	wp_enqueue_style('spina_color_scheme', child_template_directory . '/css/colors/orange.css');
}
include(dirname(__FILE__) . '/default_options_child.php');
include(dirname(__FILE__) . '/customizer_child.php');
function spina_theme_setup()
{
	Kirki::add_field('kyma_theme', array(
		'settings'          => 'header_topbar_bg_color;',
		'label'             => __('Header Top Bar Background Color', 'spina'),
		'description'       => __('Change Top bar Background Color', 'spina'),
		'section'           => 'colors',
		'type'              => 'color',
		'priority'          => 9,
		'default'           => '#F86923',
		'sanitize_callback' => 'kyma_sanitize_color',
		'output'            => array(
			array(
				'element'  => '.light_header .topbar1',
				'property' => 'background',
			),
			array(
				'element'  => '.light_header .topbar1',
				'property' => 'border-bottom',
			),
		),
	));
}
add_action('after_setup_theme', 'spina_theme_setup');
?>