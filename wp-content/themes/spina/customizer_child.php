<?php
/* Add Customizer Panel */
add_action( 'customize_register', 'spina_customizer' );
function spina_customizer( $wp_customize ) {
	$spina_theme_options = spina_theme_options();
	/* Genral section */
	$wp_customize->add_panel( 'spina_option_panel', array(
    'title' => __( 'Kyma Options','spina' ),
    'priority' => 2, // Mixed with top-level-section hierarchy.
	) );

	$wp_customize->add_section('social_sec',
	array(
		'title' => __('Social Options','spina'),
		'panel' => 'spina_option_panel',
		'capability' => 'edit_theme_options',
		'priority' => 35, // Mixed with top-level-section hierarchy.
		)
	);
	$wp_customize->add_setting(
		'spina_theme_options[social_linkedin_link]',
		array(
			'type'    => 'option',
			'default'=>$spina_theme_options['social_linkedin_link'],
			'sanitize_callback'=>'esc_url_raw',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control('social_linkedin_link',array(
		'label' => __('Linkedin Link','spina'),
		'section' => 'social_sec',
		'settings' => 'spina_theme_options[social_linkedin_link]',
		'type' => 'text',
		'priority'          => 150,		
		)
	);
	$wp_customize->add_setting(
		'spina_theme_options[social_pinterest_link]',
		array(
			'type'    => 'option',
			'default'=>$spina_theme_options['social_pinterest_link'],
			'sanitize_callback'=>'esc_url_raw',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control('social_pinterest_link',array(
		'label' => __('Pinterest Link','spina'),
		'section' => 'social_sec',
		'settings' => 'spina_theme_options[social_pinterest_link]',
		'type' => 'text',
		'priority' => 150,
		)
	);
	$wp_customize->add_section('callout_sec',
	array(
		'title' => __('CallOut Options','spina'),
		'panel' => 'spina_option_panel',
		'capability' => 'edit_theme_options',
		'priority' => 35, // Mixed with top-level-section hierarchy.
		)
	);
	$wp_customize->add_setting(
		'spina_theme_options[callout_btn_one_icon]',
		array(
			'type'    => 'option',
			'default'=>$spina_theme_options['callout_btn_one_icon'],
			'sanitize_callback'=>'spina_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control('callout_btn_one_icon',array(
		'label' => __('Callout Button Two Icon','spina'),
		'section' => 'callout_sec',
		'settings' => 'spina_theme_options[callout_btn_one_icon]',
		'type' => 'text',
		'priority' => 150,
		)
	);
	
	$wp_customize->add_setting(
		'spina_theme_options[callout_btn_one_text]',
		array(
			'type'    => 'option',
			'default'=>$spina_theme_options['callout_btn_one_text'],
			'sanitize_callback'=>'spina_sanitize_text',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control('callout_btn_one_text',array(
		'label' => __('Callout Button Two Text','spina'),
		'section' => 'callout_sec',
		'settings' => 'spina_theme_options[callout_btn_one_text]',
		'type' => 'text',
		'priority' => 150,
		)
	);
	
	$wp_customize->add_setting(
		'spina_theme_options[callout_btn_one_link]',
		array(
			'type'    => 'option',
			'default'=>$spina_theme_options['callout_btn_one_link'],
			'sanitize_callback'=>'esc_url_raw',
			'capability'        => 'edit_theme_options',
		)
	);
	$wp_customize->add_control('callout_btn_one_link',array(
		'label' => __('Callout Button Two URL','spina'),
		'section' => 'callout_sec',
		'settings' => 'spina_theme_options[callout_btn_one_link]',
		'type' => 'text',
		'priority' => 150,
		)
	);
} 

/* Custom Sanitization Function  */
function spina_sanitize_text($input)
{
    return wp_kses_post(force_balance_tags($input));
}
?>