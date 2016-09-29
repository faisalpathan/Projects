<?php
    // Set Panel ID
    $panel_id = 'illdy_panel_blog_options';

    // Set prefix
    $prefix = 'illdy';

    /***********************************************/
    /************** Global Blog Settings  ***************/
    /***********************************************/

    $wp_customize->add_section( $prefix.'_blog_global_section' ,
        array(
            'title'       => __( 'Single Post Options', 'illdy' ),
            'description' => __( 'This section allows you to control how certain elements are displayed on the blog single page.', 'illdy' ),
            'panel' 	  => $panel_id
        )
    );

    /* Posted on on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_post_posted_on_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default'           => 1,
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_post_posted_on_blog_posts',
        array(
            'type'	         => 'checkbox',
            'label'         => __('Posted on meta on single blog post', 'illdy'),
            'description'   => __('This will disable the posted on zone as well as the author name', 'illdy'),
            'section'       => $prefix.'_blog_global_section',
        )
    );

    /* Post Category on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_post_category_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default'           => 1,
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_post_category_blog_posts',
        array(
            'type'          => 'checkbox',
            'label'         => __('Category meta on single blog post', 'illdy'),
            'description'   => __('This will disable the posted in zone.', 'illdy'),
            // 'section'       => $prefix.'_blog_global_section',
        )
    );



    /* Post Tags on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_post_tags_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default'           => 1,
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_post_tags_blog_posts',
        array(
            'type'          => 'checkbox',
            'label'         => __('Tags meta on single blog post', 'illdy'),
            'description'   => __('This will disable the tagged with zone.', 'illdy'),
            'section'       => $prefix.'_blog_global_section',
        )
    );

    /* Post Comments on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_post_comments_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default'           => 1,
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->add_control(
        $prefix.'_enable_post_comments_blog_posts',
        array(
            'type'          => 'checkbox',
            'label'         => __('Coments meta on single blog post', 'illdy'),
            'description'   => __('This will disable the comments header zone.', 'illdy'),
            'section'       => $prefix.'_blog_global_section',
        )
    );

    /* Social Sharing on single blog posts */
    $wp_customize->add_setting(
        $prefix . '_enable_social_sharing_blog_posts',
        array(
            'sanitize_callback' => $prefix . '_sanitize_checkbox',
            'default'           => 1,
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->add_control(
        $prefix . '_enable_social_sharing_blog_posts',
        array(
            'type'              => 'checkbox',
            'label'             => __( 'Social sharing?', 'illdy' ),
            'description'       => __('Displayed right under the post title', 'illdy'),
            'section'           => $prefix . '_blog_global_section',
        )
    );

    /* Author Info Box on single blog posts */
    $wp_customize->add_setting( $prefix.'_enable_author_box_blog_posts',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default'           => 1,
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        $prefix.'_enable_author_box_blog_posts',
        array(
            'type'          => 'checkbox',
            'label'         => __('Author info box on single blog post', 'illdy'),
            'description'   => __('Displayed right at the end of the post', 'illdy'),
            'section'       => $prefix.'_blog_global_section',
        )
    );