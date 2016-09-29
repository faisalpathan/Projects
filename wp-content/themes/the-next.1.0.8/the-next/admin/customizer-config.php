<?php
/**
 * Created by PhpStorm.
 * User: shahriar
 * Date: 11/9/15
 * Time: 1:01 AM
 */

$thenext_config = array(
    'capability' => 'edit_theme_options',
    'option_type' => 'option',
    'option_name' => 'thenext_options'
);

$thenext_panels = array(
    'thenext_theme_options' => array(
        'title' => __('General Settings', 'the-next'),
        'description' => '',
        'priority' => 1,
    ),
    'thenext_homepage_options' => array(
        'title' => __('Homepage', 'the-next'),
        'description' => '',
        'priority' => 4,
    ),
    'thenext_layouts' => array(
        'title' => __('Layouts', 'the-next'),
        'description' => '',
        'priority' => 5,
    ),
    'thenext_typhography' => array(
        'title' => __('Typhography', 'the-next'),
        'description' => '',
        'priority' => 6,
    )
);

$thenext_sections = array(
    'thenext_header_options' => array(
        'title' => __('Header Style', 'the-next'),
        'description' => '',
        'panel' => '',
        'priority' => 2,
    ),
    'thenext_page_header_options' => array(
        'title' => __('Page Heading Style', 'the-next'),
        'description' => '',
        'panel' => '',
        'priority' => 3,
    ),
    'thenext_custom_css' => array(
        'title' => __('Custom CSS', 'the-next'),
        'description' => '',
        'panel' => '',
        'priority' => 7,
    ),

    'thenext_logo_options' => array(
        'title' => __('Logo', 'the-next'),
        'description' => '',
        'panel' => 'thenext_theme_options',
        'priority' => 120,
    ),
    'thenext_layout_options' => array(
        'title' => __('Site Layout', 'the-next'),
        'description' => '',
        'panel' => 'thenext_theme_options',
        'priority' => 120,
    ),
    'thenext_color_options' => array(
        'title' => __('Colors', 'the-next'),
        'description' => '',
        'panel' => 'thenext_theme_options',
        'priority' => 120,
    ),

    'thenext_social' => array(
        'title' => __('Social Networks', 'the-next'),
        'description' => '',
        'panel' => 'thenext_theme_options',
        'priority' => 120,
    ),
    'thenext_contact' => array(
        'title' => __('Contact Info', 'the-next'),
        'description' => '',
        'panel' => 'thenext_theme_options',
        'priority' => 120,
    ),
    'thenext_home_slider' => array(
        'title' => __('Homepage Slider', 'the-next'),
        'description' => '',
        'panel' => 'thenext_homepage_options',
        'priority' => 120,
    ),
    'thenext_featured_pages' => array(
        'title' => __('Top Featured Pages', 'the-next'),
        'description' => '',
        'panel' => 'thenext_homepage_options',
        'priority' => 120,
    ),
    'thenext_home_cta' => array(
        'title' => __('Call to Action', 'the-next'),
        'description' => '',
        'panel' => 'thenext_homepage_options',
        'priority' => 120,
    ),
    'thenext_features_section' => array(
        'title' => __('Features Section', 'the-next'),
        'description' => '',
        'panel' => 'thenext_homepage_options',
        'priority' => 120,
    ),
    'thenext_home_tab_section' => array(
        'title' => __('Tabbed Section', 'the-next'),
        'description' => '',
        'panel' => 'thenext_homepage_options',
        'priority' => 120,
    ),
    'thenext_front_page_layout' => array(
        'title' => __('Front / Blog Page Layout', 'the-next'),
        'description' => '',
        'panel' => 'thenext_layouts',
        'priority' => 120,
    ),
    'thenext_default_post_layout' => array(
        'title' => __('Default Post Layout', 'the-next'),
        'description' => '',
        'panel' => 'thenext_layouts',
        'priority' => 120,
    ),
    'thenext_default_page_layout' => array(
        'title' => __('Default Page Layout', 'the-next'),
        'description' => '',
        'panel' => 'thenext_layouts',
        'priority' => 120,
    ),
    'thenext_archive_page_layout' => array(
        'title' => __('Archive Page Layout', 'the-next'),
        'description' => '',
        'panel' => 'thenext_layouts',
        'priority' => 120,
    ),
    'thenext_generic_fonts' => array(
        'title' => __('Generic Fonts', 'the-next'),
        'description' => '',
        'panel' => 'thenext_typhography',
        'priority' => 120,
    ),
    'thenext_post_fonts' => array(
        'title' => __('Post Fonts', 'the-next'),
        'description' => '',
        'panel' => 'thenext_typhography',
        'priority' => 120,
    ),
    'thenext_widget_fonts' => array(
        'title' => __('Widget Fonts', 'the-next'),
        'description' => '',
        'panel' => 'thenext_typhography',
        'priority' => 120,
    ),
    'thenext_menu_fonts' => array(
        'title' => __('Menu Fonts', 'the-next'),
        'description' => '',
        'panel' => 'thenext_typhography',
        'priority' => 120,
    ),

);

$thenext_options = array(
    'site_logo' => array(
        'label' => __('Site Logo', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'image',
        'section' => 'thenext_logo_options',
        'default' => '',
    ),
    'site_logo_footer' => array(
        'label' => __('Logo for Footer', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'image',
        'section' => 'thenext_logo_options',
        'default' => '',
    ),
    'layout_type' => array(
        'label' => __('Layout Type', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'select',
        'section' => 'thenext_layout_options',
        'default' => 'wide',
        'choices' => array(
            'wide' => 'Wide',
            'boxed' => 'Boxed',
            'framed' => 'Framed',
        ),
    ),

    'nav_header' => array(
        'label' => __('Navigation Style', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'image-picker',
        'section' => 'thenext_header_options',
        'default' => 'header-1',
        'choices' => array(
            0 => array(
                'value' => 'header-1',
                'title' => 'Nav Style 1',
                'src' => get_template_directory_uri() . '/images/headers/header1.jpg',
            ),
            1 => array(
                'value' => 'header-2',
                'title' => 'Nav Style 2',
                'src' => get_template_directory_uri() . '/images/headers/header2.jpg',
            ),
            2 => array(
                'value' => 'header-3',
                'title' => 'Nav Style 3',
                'src' => get_template_directory_uri() . '/images/headers/header3.jpg',
            ),
            3 => array(
                'value' => 'header-4',
                'title' => 'Left Nav',
                'src' => get_template_directory_uri() . '/images/headers/header4.jpg',
            ),
            4 => array(
                'value' => 'header-5',
                'title' => 'Nav Style 5',
                'src' => get_template_directory_uri() . '/images/headers/header5.jpg',
            ),
        ),
    ),

    'page_header_style' => array(
        'label' => __('Page Header Style', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'image-picker',
        'section' => 'thenext_page_header_options',
        'default' => 'style2',
        'choices' => array(
            0 => array(
                'value' => 'style1',
                'title' => 'Narrow',
                'src' => get_template_directory_uri() . '/images/page-headers/phn.png',
            ),
            1 => array(
                'value' => 'style2',
                'title' => 'Large Centered',
                'src' => get_template_directory_uri() . '/images/page-headers/phlc.png',
            ),
            2 => array(
                'value' => 'style3',
                'title' => 'Large Left',
                'src' => get_template_directory_uri() . '/images/page-headers/phll.png',
            ),
            3 => array(
                'value' => 'style4',
                'title' => 'Large Right',
                'src' => get_template_directory_uri() . '/images/page-headers/phlr.png',
            ),
            4 => array(
                'value' => 'style5',
                'title' => 'Narrow Extended',
                'src' => get_template_directory_uri() . '/images/page-headers/phne.png',
            ),
            5 => array(
                'value' => 'style6',
                'title' => 'Simple Bordered',
                'src' => get_template_directory_uri() . '/images/page-headers/phsb.png',
            ),
        ),
    ),


    'color_scheme' => array(
        'label' => __('Color Scheme', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'color',
        'section' => 'thenext_color_options',
        'default' => '',
    ),
    'main_nav_bg' => array(
        'label' => __('Main Nav Background', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'color',
        'section' => 'thenext_color_options',
        'default' => '',
    ),
    'main_nav_color' => array(
        'label' => __('Main Nav Color', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'color',
        'section' => 'thenext_color_options',
        'default' => '',
    ),
    'a_color' => array(
        'label' => __('Link Color', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'color',
        'section' => 'thenext_color_options',
        'default' => '',
    ),
    'ah_color' => array(
        'label' => __('Link Hover Color', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'color',
        'section' => 'thenext_color_options',
        'default' => '',
    ),
    'menuh_color' => array(
        'label' => __('Menu Hover Color', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'color',
        'section' => 'thenext_color_options',
        'default' => '',
    ),

    'home_slider_category' => array(
        'label' => __('Slider Category', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-taxonomy',
        'section' => 'thenext_home_slider',
        'default' => '1',
        'taxonomy' => 'category',
    ),
    'home_slide_count' => array(
        'label' => __('Number of Posts', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'number',
        'section' => 'thenext_home_slider',
        'default' => 5,
        'min' => 1,
    ),
    'home_featured_page_1' => array(
        'label' => __('Featured Page 1', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-pages',
        'section' => 'thenext_featured_pages',
        'default' => 0,
    ),
    'home_featured_page_2' => array(
        'label' => __('Featured Page 2', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-pages',
        'section' => 'thenext_featured_pages',
        'default' => 0,
    ),
    'home_featured_page_3' => array(
        'label' => __('Featured Page 3', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-pages',
        'section' => 'thenext_featured_pages',
        'default' => 0,
    ),
    'home_featured_page_4' => array(
        'label' => __('Featured Page 4', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-pages',
        'section' => 'thenext_featured_pages',
        'default' => 0,
    ),
    'home_featured_title' => array(
        'label' => __('Headline', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'text',
        'section' => 'thenext_home_cta',
        'default' => '',
    ),
    'home_featured_desc' => array(
        'label' => __('Description', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'textarea',
        'section' => 'thenext_home_cta',
        'default' => '',
    ),
    'home_featured_btntxt' => array(
        'label' => __('Button Text', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'text',
        'section' => 'thenext_home_cta',
        'default' => '',
    ),
    'home_featured_btnurl' => array(
        'label' => __('Button URL', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'url',
        'section' => 'thenext_home_cta',
        'default' => '',
    ),
    'home_featured_btntxt1' => array(
        'label' => __('Second Button Text', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'text',
        'section' => 'thenext_home_cta',
        'default' => '',
    ),
    'home_featured_btnurl1' => array(
        'label' => __('Second Button URL', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'url',
        'section' => 'thenext_home_cta',
        'default' => '',
    ),
    'home_feature_title' => array(
        'label' => __('Headline', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'text',
        'section' => 'thenext_features_section',
        'default' => '',
    ),
    'home_feature_image' => array(
        'label' => __('Featured Image', 'the-next'),
        'description' => 'Ideal size 940px X 782px',
        'transport' => 'postMessage',
        'type' => 'image',
        'section' => 'thenext_features_section',
        'default' => '',
    ),
    'home_feature_page_1' => array(
        'label' => __('Feature Page 1', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-pages',
        'section' => 'thenext_features_section',
        'default' => 0,
    ),
    'home_feature_page_2' => array(
        'label' => __('Feature Page 2', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-pages',
        'section' => 'thenext_features_section',
        'default' => 0,
    ),
    'home_feature_page_3' => array(
        'label' => __('Feature Page 3', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-pages',
        'section' => 'thenext_features_section',
        'default' => 0,
    ),
    'home_feature_page_4' => array(
        'label' => __('Feature Page 4', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-pages',
        'section' => 'thenext_features_section',
        'default' => 0,
    ),
    'home_feature_page_5' => array(
        'label' => __('Feature Page 5', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-pages',
        'section' => 'thenext_features_section',
        'default' => 0,
    ),
    'home_feature_page_6' => array(
        'label' => __('Feature Page 6', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-pages',
        'section' => 'thenext_features_section',
        'default' => 0,
    ),
    'home_feature_page_7' => array(
        'label' => __('Feature Page 7', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-pages',
        'section' => 'thenext_features_section',
        'default' => 0,
    ),
    'home_feature_page_8' => array(
        'label' => __('Feature Page 8', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-pages',
        'section' => 'thenext_features_section',
        'default' => 0,
    ),
    'tabbed_section_title' => array(
        'label' => __('Headline', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'text',
        'section' => 'thenext_home_tab_section',
        'default' => '',
    ),
    'tabbed_section_desc' => array(
        'label' => __('Description', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'textarea',
        'section' => 'thenext_home_tab_section',
        'default' => '',
    ),
    'wpdm_category_1' => array(
        'label' => __('Post Category for First Tab', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-taxonomy',
        'section' => 'thenext_home_tab_section',
        'default' => '1',
        'taxonomy' => 'category',
    ),
    'wpdm_category_2' => array(
        'label' => __('Post Category for First Tab', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-taxonomy',
        'section' => 'thenext_home_tab_section',
        'default' => '1',
        'taxonomy' => 'category',
    ),
    'wpdm_category_3' => array(
        'label' => __('Post Category for Third Tab', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-taxonomy',
        'section' => 'thenext_home_tab_section',
        'default' => '1',
        'taxonomy' => 'category',
    ),
    'layout_front_page' => array(
        'label' => __('Sidebar Layout', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'layout',
        'section' => 'thenext_front_page_layout',
        'default' => '',
    ),
    'front_page_ls' => array(
        'label' => __('Left Sidebar', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-sidebar',
        'section' => 'thenext_front_page_layout',
        'default' => '',
    ),
    'front_page_ls_width' => array(
        'label' => __('Left Sidebar Width', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'select',
        'section' => 'thenext_front_page_layout',
        'default' => '3',
        'choices' => array(
            '2' => '16.66%',
            '3' => '25%',
            '4' => '33.33%',
        ),
    ),
    'front_page_rs' => array(
        'label' => __('Right Sidebar', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-sidebar',
        'section' => 'thenext_front_page_layout',
        'default' => '',
    ),
    'front_page_rs_width' => array(
        'label' => __('Right Sidebar Width', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'select',
        'section' => 'thenext_front_page_layout',
        'default' => '3',
        'choices' => array(
            '2' => '16.66%',
            '3' => '25%',
            '4' => '33.33%',
        ),
    ),
    'layout_default_post' => array(
        'label' => __('Sidebar Layout', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'layout',
        'section' => 'thenext_default_post_layout',
        'default' => '',
    ),
    'default_post_ls' => array(
        'label' => __('Left Sidebar', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-sidebar',
        'section' => 'thenext_default_post_layout',
        'default' => '',
    ),
    'default_post_ls_width' => array(
        'label' => __('Left Sidebar Width', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'select',
        'section' => 'thenext_default_post_layout',
        'default' => '3',
        'choices' => array(
            '2' => '16.66%',
            '3' => '25%',
            '4' => '33.33%',
        ),
    ),
    'default_post_rs' => array(
        'label' => __('Right Sidebar', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-sidebar',
        'section' => 'thenext_default_post_layout',
        'default' => '',
    ),
    'default_post_rs_width' => array(
        'label' => __('Right Sidebar Width', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'select',
        'section' => 'thenext_default_post_layout',
        'default' => '3',
        'choices' => array(
            '2' => '16.66%',
            '3' => '25%',
            '4' => '33.33%',
        ),
    ),
    'layout_default_page' => array(
        'label' => __('Sidebar Layout', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'layout',
        'section' => 'thenext_default_page_layout',
        'default' => '',
    ),
    'default_page_ls' => array(
        'label' => __('Left Sidebar', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-sidebar',
        'section' => 'thenext_default_page_layout',
        'default' => '',
    ),
    'default_page_ls_width' => array(
        'label' => __('Left Sidebar Width', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'select',
        'section' => 'thenext_default_page_layout',
        'default' => '3',
        'choices' => array(
            '2' => '16.66%',
            '3' => '25%',
            '4' => '33.33%',
        ),
    ),
    'default_page_rs' => array(
        'label' => __('Right Sidebar', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-sidebar',
        'section' => 'thenext_default_page_layout',
        'default' => '',
    ),
    'default_page_rs_width' => array(
        'label' => __('Right Sidebar Width', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'select',
        'section' => 'thenext_default_page_layout',
        'default' => '3',
        'choices' => array(
            '2' => '16.66%',
            '3' => '25%',
            '4' => '33.33%',
        ),
    ),
    'layout_archive_page' => array(
        'label' => __('Sidebar Layout', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'layout',
        'section' => 'thenext_archive_page_layout',
        'default' => '',
    ),
    'archive_page_ls' => array(
        'label' => __('Left Sidebar', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-sidebar',
        'section' => 'thenext_archive_page_layout',
        'default' => '',
    ),
    'archive_page_ls_width' => array(
        'label' => __('Left Sidebar Width', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'select',
        'section' => 'thenext_archive_page_layout',
        'default' => '3',
        'choices' => array(
            '2' => '16.66%',
            '3' => '25%',
            '4' => '33.33%',
        ),
    ),
    'archive_page_rs' => array(
        'label' => __('Right Sidebar', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'dropdown-sidebar',
        'section' => 'thenext_archive_page_layout',
        'default' => '',
    ),
    'archive_page_rs_width' => array(
        'label' => __('Right Sidebar Width', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'select',
        'section' => 'thenext_archive_page_layout',
        'default' => '3',
        'choices' => array(
            '2' => '16.66%',
            '3' => '25%',
            '4' => '33.33%',
        ),
    ),

    'heading_font' => array(
        'label' => __('Header Font', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'typhography',
        'section' => 'thenext_generic_fonts',
        'default' => '',
    ),
    'heading_font_size' => array(
        'label' => __('Header Font Size', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'range',
        'section' => 'thenext_generic_fonts',
        'default' => '25',
        'input_attrs' => array(
            'min'   => 20,
            'max'   => 72,
            'step'  => 1,
        )
    ),
    'heading_font_weight' => array(
        'label' => __('Header Font Weight', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'range',
        'section' => 'thenext_generic_fonts',
        'default' => '700',
        'input_attrs' => array(
            'min'   => 100,
            'max'   => 900,
            'step'  => 100,
        )
    ),
    'header_color' => array(
        'label' => __('Header Text Color', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'color',
        'section' => 'thenext_generic_fonts',
        'default' => '#333333',
    ),


    'body_font' => array(
        'label' => __('Body Font', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'typhography',
        'section' => 'thenext_generic_fonts',
        'default' => '',
    ),

    'body_font_size' => array(
        'label' => __('Body Font Size', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'range',
        'section' => 'thenext_generic_fonts',
        'default' => '20',
        'input_attrs' => array(
            'min'   => 9,
            'max'   => 35,
            'step'  => 1,
        )
    ),
    'body_font_weight' => array(
        'label' => __('Body Font Weight', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'range',
        'section' => 'thenext_generic_fonts',
        'default' => '400',
        'input_attrs' => array(
            'min'   => 100,
            'max'   => 900,
            'step'  => 100,
        )
    ),
    'body_color' => array(
        'label' => __('Regular Text Color', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'color',
        'section' => 'thenext_generic_fonts',
        'default' => '#333333',
    ),


    'widget_title_font' => array(
        'label' => __('Widget Title Font', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'typhography',
        'section' => 'thenext_widget_fonts',
        'default' => '',
    ),
    'widget_title_font_size' => array(
        'label' => __('Widget Title Font Size', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'range',
        'section' => 'thenext_widget_fonts',
        'default' => '',
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 32,
            'step'  => 1,
        )
    ),
    'widget_title_font_weight' => array(
        'label' => __('Widget Title Font Weight', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'range',
        'section' => 'thenext_widget_fonts',
        'default' => '300',
        'input_attrs' => array(
            'min'   => 100,
            'max'   => 900,
            'step'  => 100,
        )
    ),

    'widget_content_font' => array(
        'label' => __('Widget Content Font', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'typhography',
        'section' => 'thenext_widget_fonts',
        'default' => '',
    ),
    'widget_content_font_size' => array(
        'label' => __('Widget Content Font Size', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'range',
        'section' => 'thenext_widget_fonts',
        'default' => '',
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 32,
            'step'  => 1,
        )
    ),
    'widget_content_font_weight' => array(
        'label' => __('Widget Content Font Weight', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'range',
        'section' => 'thenext_widget_fonts',
        'default' => '300',
        'input_attrs' => array(
            'min'   => 100,
            'max'   => 900,
            'step'  => 100,
        )
    ),


    'menu_top_font' => array(
        'label' => __('Menu Top Level Font', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'typhography',
        'section' => 'thenext_menu_fonts',
        'default' => '',
    ),
    'menu_top_font_size' => array(
        'label' => __('Menu Top Font Size', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'range',
        'section' => 'thenext_menu_fonts',
        'default' => '',
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 52,
            'step'  => 1,
        )
    ),
    'menu_top_font_weight' => array(
        'label' => __('Menu Top Font Weight', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'range',
        'section' => 'thenext_menu_fonts',
        'default' => '700',
        'input_attrs' => array(
            'min'   => 100,
            'max'   => 900,
            'step'  => 100,
        )
    ),


    'menu_dropdown_font' => array(
        'label' => __('Menu Dropdown Font', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'typhography',
        'section' => 'thenext_menu_fonts',
        'default' => '',
    ),
    'menu_dropdown_font_size' => array(
        'label' => __('Menu Dropdown Font Size', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'range',
        'section' => 'thenext_menu_fonts',
        'default' => '',
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 52,
            'step'  => 1,
        )
    ),
    'menu_dropdown_font_weight' => array(
        'label' => __('Menu Dropdown Font Weight', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'range',
        'section' => 'thenext_menu_fonts',
        'default' => '600',
        'input_attrs' => array(
            'min'   => 100,
            'max'   => 900,
            'step'  => 100,
        )
    ),

    'custom_css' => array(
        'label' => __('Custom CSS', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'textarea',
        'section' => 'thenext_custom_css',
        'default' => '',
    ),

    'facebook_profile_url' => array(
        'label' => __('Facebook Profile / Page URL', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'url',
        'section' => 'thenext_social',
        'default' => '',
    ),
    'twitter_profile_url' => array(
        'label' => __('Twitter Profile URL', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'url',
        'section' => 'thenext_social',
        'default' => '',
    ),
    'googleplus_profile_url' => array(
        'label' => __('Google+ Profile / Page URL', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'url',
        'section' => 'thenext_social',
        'default' => '',
    ),
    'pinterest_profile_url' => array(
        'label' => __('Pinterest Profile URL', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'url',
        'section' => 'thenext_social',
        'default' => '',
    ),
    'linkedin_profile_url' => array(
        'label' => __('Linked In Profile URL', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'url',
        'section' => 'thenext_social',
        'default' => '',
    ),
    'map_address' => array(
        'label' => __('Google Map Address', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'text',
        'section' => 'thenext_contact',
        'default' => '',
    ),
    'contact_address' => array(
        'label' => __('Contact Address', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'textarea',
        'section' => 'thenext_contact',
        'default' => '',
    ),
    'contact_phone' => array(
        'label' => __('Phone', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'text',
        'section' => 'thenext_contact',
        'default' => '',
    ),
    'contact_email' => array(
        'label' => __('Email', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'email',
        'section' => 'thenext_contact',
        'default' => '',
    ),
    'contact_thanks_msg' => array(
        'label' => __('Thank you message', 'the-next'),
        'transport' => 'postMessage',
        'type' => 'textarea',
        'section' => 'thenext_contact',
        'default' => '',
    ),

);
