<?php
// Set Panel ID
$panel_id = 'illdy_panel_projects';

// Set prefix
$prefix = 'illdy';

/***********************************************/
/****************** PROJECTS  ******************/
/***********************************************/
$wp_customize->add_panel( $panel_id,
    array(
        'priority'          => 103,
        'capability'        => 'edit_theme_options',
        'theme_supports'    => '',
        'title'             => __( 'Projects Section', 'illdy' ),
        'description'       => __( 'Control various options for projects section from front page.', 'illdy' ),
    )
);

/***********************************************/
/******************* General *******************/
/***********************************************/
$wp_customize->add_section( $prefix . '_projects_general' ,
    array(
        'title'     => __( 'General', 'illdy' ),
        'panel'     => $panel_id,
        'priority'  => 1
    )
);

// Show this section
$wp_customize->add_setting( $prefix . '_projects_general_show',
    array(
        'sanitize_callback' => $prefix . '_sanitize_checkbox',
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . '_projects_general_show',
    array(
        'type'      => 'checkbox',
        'label'     => __( 'Show this section?', 'illdy' ),
        'section'   => $prefix . '_projects_general',
        'priority'  => 1
    )
);

// Title
$wp_customize->add_setting( $prefix .'_projects_general_title',
    array(
        'sanitize_callback' => 'illdy_sanitize_html',
        'default'           => __( 'Projects', 'illdy' ),
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix .'_projects_general_title',
    array(
        'label'         => __( 'Title', 'illdy' ),
        'description'   => __( 'Add the title for this section.', 'illdy'),
        'section'       => $prefix . '_projects_general',
        'priority'      => 2
    )
);

// Entry
if ( get_theme_mod( $prefix .'_projects_general_entry' ) ) {
    
    $wp_customize->add_setting( $prefix .'_projects_general_entry',
        array(
            'sanitize_callback' => 'illdy_sanitize_html',
            'default'           => __( 'You\'ll love our work. Check it out!', 'illdy' ),
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        $prefix .'_projects_general_entry',
        array(
            'label'         => __( 'Entry', 'illdy' ),
            'description'   => __( 'Add the content for this section.', 'illdy'),
            'section'       => $prefix . '_projects_general',
            'priority'      => 3,
            'type'          => 'textarea'
        )
    );
    
}
