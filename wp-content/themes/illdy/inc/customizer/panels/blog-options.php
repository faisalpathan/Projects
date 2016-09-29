<?php

	// Set Panel ID
    $panel_id = 'illdy_panel_blog_options';

    // Set prefix
    $prefix = 'illdy';

    $wp_customize->add_panel( $panel_id,
        array(
            'priority' => 2,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __( 'Blog Options', 'illdy' ),
            'description' => __('You can change blog options ', 'illdy'),
        )
    );

    //
    $wp_customize->get_section( 'header_image' )->panel = $panel_id;