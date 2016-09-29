<?php
/**
 * Theme Customizer.
 *
 * @package Onefold
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function onefold_customize_register( $wp_customize ) {

	// Load custom controls.
	include get_template_directory() . '/inc/customizer/control.php';

	// Load customize helpers.
	include get_template_directory() . '/inc/helper/options.php';

	// Load customize sanitize.
	include get_template_directory() . '/inc/customizer/sanitize.php';

	// Load customize callback.
	include get_template_directory() . '/inc/customizer/callback.php';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Load customize option.
	include get_template_directory() . '/inc/customizer/option.php';

	// Load home sections option.
	include get_template_directory() . '/inc/customizer/home-sections.php';

	// Load slider customize option.
	require get_template_directory() . '/inc/customizer/slider.php';

	// Modify default customizer options.
	$wp_customize->get_control( 'background_color' )->description = __( 'Note: Background Color is applicable only if no image is set as Background Image.', 'onefold' );

	// Register custom section types.
	$wp_customize->register_section_type( 'Onefold_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Onefold_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Onefold Pro', 'onefold' ),
				'pro_text' => esc_html__( 'Buy Pro', 'onefold' ),
				'pro_url'  => 'http://themepalace.com/downloads/onefold-pro/',
				'priority'  => 1,
			)
		)
	);



}
add_action( 'customize_register', 'onefold_customize_register' );

/**
 * Load styles for Customizer.
 *
 * @since 1.0.0
 */
function onefold_load_customizer_styles() {

	global $pagenow;

	if ( 'customize.php' === $pagenow ) {
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'onefold-customizer-style', get_template_directory_uri() . '/css/customizer' . $min . '.css', false, '1.0.0' );
	}

}

add_action( 'admin_enqueue_scripts', 'onefold_load_customizer_styles' );

/**
 * Customizer partials.
 *
 * @since 1.0.0
 */
function onefold_customizer_partials( WP_Customize_Manager $wp_customize ) {

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->get_setting( 'blogname' )->transport                              = 'refresh';
		$wp_customize->get_setting( 'blogdescription' )->transport                       = 'refresh';

		$wp_customize->get_setting( 'theme_options[copyright_text]' )->transport = 'refresh';
		return;

	}

	// Load customizer partials callback.
	include get_template_directory() . '/inc/customizer/partials.php';

	// Partial blogname.
	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector'            => '.site-title a',
			'container_inclusive' => false,
			'render_callback'     => 'onefold_customize_partial_blogname',
		)
	);

	// Partial blogdescription.
	$wp_customize->selective_refresh->add_partial(
		'blogdescription', array(
			'selector'            => '.site-description',
			'container_inclusive' => false,
			'render_callback'     => 'onefold_customize_partial_blogdescription',
		)
	);

	// Partial copyright_text.
	$wp_customize->selective_refresh->add_partial(
		'copyright_text', array(
			'selector'            => '#colophon .copyright',
			'container_inclusive' => false,
			'settings'            => array( 'theme_options[copyright_text]' ),
			'render_callback'     => 'onefold_render_partial_copyright_text',
		)
	);

}

add_action( 'customize_register', 'onefold_customizer_partials', 99 );
