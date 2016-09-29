<?php
// Set Panel ID
$panel_id = 'illdy_panel_jumbotron';

// Set prefix
$prefix = 'illdy';

/***********************************************/
/***************** JUMBOTRON  ******************/
/***********************************************/
/*
$wp_customize->add_panel( $panel_id,
    array(
        'priority'          => 100,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => __( 'Jumbotron', 'illdy' ),
        'description'       => __( 'Control various options for header image from front page.', 'illdy' ),
    )
);
*/

/***********************************************/
/******************* General *******************/
/***********************************************/
$wp_customize->add_section( $prefix.'_jumbotron_general' ,
    array(
        'title'     => __( 'Jumbotron Section', 'illdy' ),
        'priority'  => 100
        // 'title'     => __( 'General', 'illdy' ),
        // 'panel'     => $panel_id
    )
);

// Image
$wp_customize->add_setting(
    $prefix . '_jumbotron_general_image',
    array(
        'sanitize_callback' => 'esc_url_raw',
        'default'           => esc_url_raw( get_template_directory_uri() . '/layout/images/front-page/front-page-header.png' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize, $prefix . '_jumbotron_general_image',
        array(
            'label'     => __( 'Image', 'illdy' ),
            'section'   => $prefix .'_jumbotron_general',
            'settings'  => $prefix . '_jumbotron_general_image',
            'priority'  => 1
        )
    )
);

// First word from title
$wp_customize->add_setting( $prefix .'_jumbotron_general_first_row_from_title',
    array(
        'sanitize_callback' => 'illdy_sanitize_html',
        'default'           => __( 'Clean', 'illdy' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_jumbotron_general_first_row_from_title',
    array(
        'label'         => __( 'First word from title', 'illdy' ),
        'description'   => __( 'Add first word in the title.', 'illdy'),
        'section'       => $prefix . '_jumbotron_general',
        'priority'      => 2
    )
);

// Second word from title
$wp_customize->add_setting( $prefix .'_jumbotron_general_second_row_from_title',
    array(
        'sanitize_callback' => 'illdy_sanitize_html',
        'default'           => __( 'Slick', 'illdy' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_jumbotron_general_second_row_from_title',
    array(
        'label'         => __( 'Second word from title', 'illdy' ),
        'description'   => __( 'Add second word in the title.', 'illdy'),
        'section'       => $prefix . '_jumbotron_general',
        'priority'      => 3
    )
);

// Thirs word from title
$wp_customize->add_setting( $prefix .'_jumbotron_general_third_row_from_title',
    array(
        'sanitize_callback' => 'illdy_sanitize_html',
        'default'           => __( 'Pixel Perfect', 'illdy' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_jumbotron_general_third_row_from_title',
    array(
        'label'         => __( 'Third word from title', 'illdy' ),
        'description'   => __( 'Add third word in the title.', 'illdy'),
        'section'       => $prefix . '_jumbotron_general',
        'priority'      => 4
    )
);

// Entry
if ( get_theme_mod( $prefix .'_jumbotron_general_entry' ) ) {
    
    $wp_customize->add_setting( $prefix .'_jumbotron_general_entry',
        array(
            'sanitize_callback' => 'illdy_sanitize_html',
            'default'           => __( 'lldy is a great one-page theme, perfect for developers and designers but also for someone who just wants a new website for his business. Try it now!', 'illdy' ),
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        $prefix .'_jumbotron_general_entry',
        array(
            'label'         => __( 'Entry', 'illdy' ),
            'description'   => __( 'The content added in this field will show below title.', 'illdy'),
            'section'       => $prefix . '_jumbotron_general',
            'priority'      => 5,
            'type'          => 'textarea'
        )
    );
    
}


// First button text
$wp_customize->add_setting( $prefix .'_jumbotron_general_first_button_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Learn more', 'illdy' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_jumbotron_general_first_button_title',
    array(
        'label'         => __( 'First button title', 'illdy' ),
        'description'   => __( 'Add the text for first button.', 'illdy'),
        'section'       => $prefix . '_jumbotron_general',
        'priority'      => 6
    )
);

// First button URL
$wp_customize->add_setting( 'illdy_jumbotron_general_first_button_url',
    array(
        'sanitize_callback'  => 'esc_url_raw',
        'default'            => esc_url( '#' ),
        'transport'          => 'postMessage'
    )
);
$wp_customize->add_control( 'illdy_jumbotron_general_first_button_url',
    array(
        'label'          => __( 'First button URL', 'illdy' ),
        'description'    => __( 'Add the URL for first button.', 'illdy' ),
        'section'        => $prefix . '_jumbotron_general',
        'settings'       => 'illdy_jumbotron_general_first_button_url',
        'priority'       => 7
    )
);

// Second button text
$wp_customize->add_setting( $prefix .'_jumbotron_general_second_button_title',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => __( 'Download', 'illdy' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_jumbotron_general_second_button_title',
    array(
        'label'         => __( 'Second button title', 'illdy' ),
        'description'   => __( 'Add the text for second button.', 'illdy'),
        'section'       => $prefix . '_jumbotron_general',
        'priority'      => 8
    )
);

// Second button URL
$wp_customize->add_setting( 'illdy_jumbotron_general_second_button_url',
    array(
        'sanitize_callback'  => 'esc_url_raw',
        'default'            => esc_url( '#' ),
        'transport'          => 'postMessage'
    )
);
$wp_customize->add_control( 'illdy_jumbotron_general_second_button_url',
    array(
        'label'          => __( 'Second button URL', 'illdy' ),
        'description'    => __( 'Add the URL for second button.', 'illdy' ),
        'section'        => $prefix . '_jumbotron_general',
        'settings'       => 'illdy_jumbotron_general_second_button_url',
        'priority'       => 9
    )
);