<?php
/**
 * _s Theme Customizer
 *
 * @package prestro
 */

/**
 * Add  support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function prestro_customize_register($wp_customize) {

    //Add a class for titles
    if( class_exists( 'WP_Customize_Control' ) ):    
    class pRestro_Info extends WP_Customize_Control {

        public $type = 'info';
        public $label = '';

        public function render_content() {
            ?>
            <h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html($this->label); ?></h3>
            <?php
        }

    }
    endif;
    

    if (class_exists('WP_Customize_Control')) {
    class Prestro_Customizer_Number_Control extends WP_Customize_Control {

            public $type = 'number';

        public function render_content() {

        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

                <input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
            </label>
        <?php
        }
    }
}

    if (class_exists('WP_Customize_Control')) {
    class Prestro_Customize_Category_Control extends WP_Customize_Control {
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;','prestro'),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}

    if (class_exists('WP_Customize_Panel')):
        // Slider options starts
       
        $wp_customize->add_section('prestro_logo_options', array(
            'title' => __('Logo settings ', 'prestro'),
            'description' => __('Upload your logo image here.','prestro'),
            'priority' => 1
        ));

      
        $wp_customize->add_setting('logo-img', array(
            'default' => get_template_directory_uri() . '/images/logo.jpg',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(
                new WP_Customize_Image_Control(
                $wp_customize, 'logo-img', array(
            'label' => __('Logo Image', 'prestro'),
            'section' => 'prestro_logo_options',
            'settings' => 'logo-img'
                )
                )
        );     

        $wp_customize->add_section('slider_options', array(
            'title' => __('Home slider settings ', 'prestro'),
            'description' => __('Add slider images here,content and links here.','prestro'),
            'priority' => 1
        ));

        $wp_customize->add_setting('hide_captions', array(
            'sanitize_callback' => 'prestro_sanitize_checkbox'
        ));

        $wp_customize->add_control('hide_captions', array(
            'label' => __('Check this to hide slide captions', 'prestro'),
            'setting' => 'hide_captions',
            'section' => 'slider_options',
            'type' => 'checkbox'
        ));

        $wp_customize->add_setting("welcome_setting", array(
            'sanitize_callback' => 'prestro_sanitize_integer'
        ));

         $wp_customize->add_setting(
            'slider_loop',
            array(
                'default' => '3',
                'sanitize_callback' => 'sanitize_key',
            )
        );
        
        $wp_customize->add_control(new prestro_Customizer_Number_Control( $wp_customize,'slider_loop',
            array(
                'label' => __( 'No. of posts to display', 'prestro' ),
                'section' => 'slider_options',
                'setting' => 'slider_loop',
                'type' => 'number',
            )
        ));

        // end slider

        /*---- Welcome Setting -----*/

        $wp_customize->add_panel('general_panel', array(
            'priority' => 2,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __('General options', 'prestro')
        ));

        $wp_customize->add_section('prestro_about_options', array(
            'title' => __('Welcome section', 'prestro'),
            'priority' => 1,
            'panel' => 'general_panel'
        ));

        $wp_customize->add_setting("welcome_setting", array(
            'sanitize_callback' => 'prestro_sanitize_integer'
        ));

        $wp_customize->add_control("welcome_setting", array(
            'type' => 'dropdown-pages',
            'label' => __('Choose a page to display in this section:','prestro'),
            "section" => "prestro_about_options",
            "settings" => "welcome_setting",
        ));

      
        

        /* Copy right text */
        $wp_customize->add_setting('prestro_copyright', array('sanitize_callback' => 'prestro_sanitize_text', 'default' => __('Copyright &copy; 2016 ThemesWare - All rights reserved.', 'prestro')));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'prestro_copyright', array(
            'label' => __('Copyright', 'prestro'),
            'section' => 'prestro_general_options',
            'settings' => 'prestro_copyright',
            'priority' => 2,
        )));

        $wp_customize->add_section('prestro_social_section', array(
            'title' => __('Social Link', 'prestro'),
            'priority' => 3,
            'panel' => 'general_panel'
        ));

        /* fb */
        $wp_customize->add_setting('prestro_social_fb', array('sanitize_callback' => 'esc_url_raw', 'default' => '#'));
        $wp_customize->add_control('prestro_social_fb', array(
            'label' => __('Facebook link', 'prestro'),
            'section' => 'prestro_social_section',
            'settings' => 'prestro_social_fb',
            'priority' => 1,
        ));

        /* twitter */
        $wp_customize->add_setting('prestro_social_twitter', array('sanitize_callback' => 'esc_url_raw', 'default' => '#'));
        $wp_customize->add_control('prestro_social_twitter', array(
            'label' => __('Twitter link', 'prestro'),
            'section' => 'prestro_social_section',
            'settings' => 'prestro_social_twitter',
            'priority' => 2,
        ));
        /* linkedin */
        $wp_customize->add_setting('prestro_social_linkedin', array('sanitize_callback' => 'esc_url_raw', 'default' => 'linkedin.com'));
        $wp_customize->add_control('prestro_social_linkedin', array(
            'label' => __('Linkedin link', 'prestro'),
            'section' => 'prestro_social_section',
            'settings' => 'prestro_social_linkedin',
            'priority' => 3,
        ));
        /* Google Plus */
        $wp_customize->add_setting('prestro_social_gp', array('sanitize_callback' => 'esc_url_raw', 'default' => '#'));
        $wp_customize->add_control('prestro_social_gp', array(
            'label' => __('Google Plus link', 'prestro'),
            'section' => 'prestro_social_section',
            'settings' => 'prestro_social_gp',
            'priority' => 4,
        ));
        /* Skype id */
        $wp_customize->add_setting('prestro_social_skype', array('sanitize_callback' => 'esc_url_raw', 'default' => 'themesware'));
        $wp_customize->add_control('prestro_social_skype', array(
            'label' => __('Skype id', 'prestro'),
            'section' => 'prestro_social_section',
            'settings' => 'prestro_social_skype',
            'priority' => 5,
        ));

        $wp_customize->add_section('prestro_footer_section', array(
            'title' => __('Footer', 'prestro'),
            'priority' => 4,
            'panel' => 'general_panel'
        ));

        /* Business Name */

        $wp_customize->add_setting('prestroc_fti', array('sanitize_callback' => 'prestro_sanitize_text', 'default' => __('Stay Connected', 'prestro')));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'prestroc_fti', array(
            'label' => __('Section title', 'prestro'),
            'section' => 'prestro_footer_section',
            'settings' => 'prestroc_fti',
            'priority' => 1
        )));
        
        /* Business Name */

        $wp_customize->add_setting('prestroc_name', array('sanitize_callback' => 'prestro_sanitize_text', 'default' => __('ThemesWare', 'prestro')));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'prestroc_name', array(
            'label' => __('Business Name', 'prestro'),
            'section' => 'prestro_footer_section',
            'settings' => 'prestroc_name',
            'priority' => 2
        )));

        /* address */

        $wp_customize->add_setting('prestro_address', array('sanitize_callback' => 'prestro_sanitize_text', 'default' => __('Gujarat(India)', 'prestro')));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'prestro_address', array(
            'label' => __('Address', 'prestro'),
            'section' => 'prestro_footer_section',
            'settings' => 'prestro_address',
            'priority' => 3
        )));


        /* email */
        $wp_customize->add_setting('prestro_email', array('sanitize_callback' => 'prestro_sanitize_text', 'default' => 'contact@site.com'));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'prestro_email', array(
            'label' => __('Email', 'prestro'),
            'section' => 'prestro_footer_section',
            'settings' => 'prestro_email',
            'priority' => 4
        )));

        /* phone number */

        $wp_customize->add_setting('prestro_phone', array('sanitize_callback' => 'prestro_sanitize_number', 'default' => '0 188 33121 22'));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'prestro_phone', array(
            'label' => __('Phone number', 'prestro'),
            'section' => 'prestro_footer_section',
            'settings' => 'prestro_phone',
            'priority' => 5
        )));
        $wp_customize->add_section("services", array(
            "title" => __("Our Services", "prestro"),
            "priority" => 3,
        ));

        $wp_customize->add_setting("service_sec_title", array(
            "default" => "Our Menu",
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize, "service_sec_title", array(
            "label" => __("Section title", "prestro"),
            "section" => "services",
            "settings" => "service_sec_title",
            "type" => "text",
                )
        ));
        // Service 1
       
       
        $wp_customize->add_setting('service_setting', array(
           'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( new Prestro_Customize_Category_Control(
        $wp_customize,
        'service_setting',
        array('label' => __('Choose category', 'prestro'),
            'section' => 'services',
            'settings' => 'service_setting'
            )
        ));
     

      

        
        //meet our chef section starts

        $wp_customize->add_section("meet_chef", array(
            "title" => __("Meet Our Chef", "prestro"),
            "priority" => 4,
        ));

        $wp_customize->add_setting("chef_sec_title", array(
            "default" => "Meet Our Chef",
            'sanitize_callback' => 'sanitize_text_field'
        ));

        $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize, "chef_sec_title", array(
            "label" => __("Section title", "prestro"),
            "section" => "meet_chef",
            "settings" => "chef_sec_title",
            "type" => "text",
                )
        ));
       
        $wp_customize->add_setting('chef_setting',array(
           'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( new Prestro_Customize_Category_Control(
        $wp_customize,
        'chef_setting',
        array('label' => __('Select Post Category:', 'prestro'),
            'section' => 'meet_chef',
            'settings' => 'chef_setting'
            )
        ));
     
      
   
        //Contact us section starts

        $wp_customize->add_section("contact_sec", array(
            "title" => __("Contact us Page", "prestro"),
            'description'   => sanitize_text_field(__('Set title and define contact form here by entering shortcode','prestro')),
            "priority" => 6,
        ));

        $wp_customize->add_setting("contact_sec", array(
            "default" => "Contact us",
            'sanitize_callback' => 'sanitize_text_field'
        ));

        
        $wp_customize->add_setting("contact_sec_title", array(
            "default" => "Let's Get In Touch",
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize, "contact_sec_title", array(
            "label" => __("Section title", "prestro"),
            "section" => "contact_sec",
            "settings" => "contact_sec_title",
            "type" => "text",
                )
        ));
        
        $wp_customize->add_setting('contact-form', array(
            'default' => '',
            'sanitize_callback' => 'prestro_area_format',
        ));

        $wp_customize->add_control('contact-form', array(
            'label' => __('Contact form shortcode. Ex.[ninja_forms id=5]', 'prestro'),
            'section' => 'contact_sec',
            'setting' => 'contact-form',
            'type' => 'textarea'
        ));

        $wp_customize->add_section(
                'theme_doc_sec', array(
            'title' => __('Documentation &amp; Support', 'prestro'),
            'priority' => null,
            'description' => __('For documentation and support follow this link :', 'prestro') . '<a href="' . esc_url(theme_doc) . '" target="_blank">pRestro Documentation</a>',
                )
        );
        $wp_customize->add_setting('doc_section', array(
            'sanitize_callback' => 'sanitize_text_field',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
                )
        );
        $wp_customize->add_control(new pRestro_Info($wp_customize, 'doc_section', array(
            'section' => 'theme_doc_sec',
            'settings' => 'doc_section'
                ))
        );


    else:
        /* Old versions WP */

        $wp_customize->add_section('prestro_general_section', array(
            'title' => __('General options', 'prestro'),
            'priority' => 1,
            'description' => __('pRestro theme general options', 'prestro'),
        ));
        
        /* Copy right text */
        $wp_customize->add_setting('prestro_copyright', array('sanitize_callback' => 'prestro_sanitize_text', 'default' => __('Copyright &copy; 2016 ThemesWare - All rights reserved.', 'prestro')));
        $wp_customize->add_control('prestro_copyright', array(
            'label' => __('Copyright', 'prestro'),
            'section' => 'prestro_general_section',
            'settings' => 'prestro_copyright',
            'priority' => 2,
        ));

        /* fb */
        $wp_customize->add_setting('prestro_social_fb', array('sanitize_callback' => 'esc_url_raw', 'default' => '#'));
        $wp_customize->add_control('prestro_social_fb', array(
            'label' => __('Facebook link', 'prestro'),
            'section' => 'prestro_general_section',
            'settings' => 'prestro_social_fb',
            'priority' => 3,
        ));
        /* twitter */
        $wp_customize->add_setting('prestro_social_twitter', array('sanitize_callback' => 'esc_url_raw', 'default' => '#'));
        $wp_customize->add_control('prestro_social_twitter', array(
            'label' => __('Twitter link', 'prestro'),
            'section' => 'prestro_general_section',
            'settings' => 'prestro_social_twitter',
            'priority' => 4,
        ));
        /* linkedin */
        $wp_customize->add_setting('prestro_social_linkedin', array('sanitize_callback' => 'esc_url_raw', 'default' => '#'));
        $wp_customize->add_control('prestro_social_linkedin', array(
            'label' => __('Linkedin link', 'prestro'),
            'section' => 'prestro_general_section',
            'settings' => 'prestro_social_linkedin',
            'priority' => 5,
        ));
        /* Google Plus */
        $wp_customize->add_setting('prestro_social_gp', array('sanitize_callback' => 'esc_url_raw', 'default' => '#'));
        $wp_customize->add_control('prestro_social_gp', array(
            'label' => __('Google Plus link', 'prestro'),
            'section' => 'prestro_general_section',
            'settings' => 'prestro_social_gp',
            'priority' => 6,
        ));
        /* Skype id */
        $wp_customize->add_setting('prestro_social_skype', array('sanitize_callback' => 'esc_url_raw', 'default' => '#'));
        $wp_customize->add_control('prestro_social_skype', array(
            'label' => __('Skype id', 'prestro'),
            'section' => 'prestro_general_section',
            'settings' => 'prestro_social_skype',
            'priority' => 7,
        ));
       
        
        /* Business Name */

        $wp_customize->add_setting('prestroc_fti', array('sanitize_callback' => 'prestro_sanitize_text', 'default' => __('Stay Connected', 'prestro')));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'prestroc_fti', array(
            'label' => __('Section title', 'prestro'),
            'section' => 'prestro_footer_section',
            'settings' => 'prestroc_fti',
            'priority' => 8
        )));
        /* Business Name */

        $wp_customize->add_setting('prestroc_name', array('sanitize_callback' => 'prestro_sanitize_text', 'default' => __('ThemesWare', 'prestro')));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'prestroc_name', array(
            'label' => __('Business Name', 'prestro'),
            'section' => 'prestro_general_section',
            'settings' => 'prestroc_name',
            'priority' => 9
        )));

        /* address */

        $wp_customize->add_setting('prestro_address', array('sanitize_callback' => 'prestro_sanitize_text', 'default' => __('Company address', 'prestro')));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'prestro_address', array(
            'label' => __('Address', 'prestro'),
            'section' => 'prestro_general_section',
            'settings' => 'prestro_address',
            'priority' => 10
        )));


        /* email */
        $wp_customize->add_setting('prestro_email', array('sanitize_callback' => 'prestro_sanitize_text', 'default' => 'contact@site.com'));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'prestro_email', array(
            'label' => __('Email', 'prestro'),
            'section' => 'prestro_general_section',
            'settings' => 'prestro_email',
            'priority' => 11
        )));

        /* phone number */

        $wp_customize->add_setting('prestro_phone', array('sanitize_callback' => 'prestro_sanitize_number', 'default' => '0 188 33121 22'));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'prestro_phone', array(
            'label' => __('Phone number', 'prestro'),
            'section' => 'prestro_general_section',
            'settings' => 'prestro_phone',
            'priority' => 12
        )));
//  End general panel

        $wp_customize->add_section("services", array(
            "title" => __("Our Services", "prestro"),
            "priority" => 2,
        ));

        $wp_customize->add_setting("service_sec_title", array(
            "default" => "Our Menu",
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize, "service_sec_title", array(
            "label" => __("Section title", "prestro"),
            "section" => "services",
            "settings" => "service_sec_title",
            "type" => "text",
                )
        ));
       


       
        //meet our chef section starts
        $wp_customize->add_section("meet_chef", array(
            "title" => __("Meet Our Chef", "prestro"),
            "priority" => 4,
        ));

        $wp_customize->add_setting("chef_sec_title", array(
            "default" => "Meet Our Chef",
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize, "chef_sec_title", array(
            "label" => __("Section title", "prestro"),
            "section" => "meet_chef",
            "settings" => "chef_sec_title",
            "type" => "text",
                )
        ));

      
       
        //Contact us section starts

        $wp_customize->add_section("contact_sec", array(
            "title" => __("Contact us Page", "prestro"),
            'description'   => sanitize_text_field(__('Set title and define contact form here by entering shortcode','prestro')),
            "priority" => 6,
        ));

        $wp_customize->add_setting("contact_sec", array(
            "default" => "Contact us",
            'sanitize_callback' => 'sanitize_text_field'
        ));

        
        $wp_customize->add_setting("contact_sec_title", array(
            "default" => "Let's Get In Touch",
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control(new WP_Customize_Control(
                $wp_customize, "contact_sec_title", array(
            "label" => __("Section title", "prestro"),
            "section" => "contact_sec",
            "settings" => "contact_sec_title",
            "type" => "text",
                )
        ));
        
        $wp_customize->add_setting('contact-form', array(
            'default' => '',
            'sanitize_callback' => 'prestro_area_format',
        ));

        $wp_customize->add_control('contact-form', array(
            'label' => __('Contact form shortcode. Ex.[ninja_forms id=5]', 'prestro'),
            'section' => 'contact_sec',
            'setting' => 'contact-form',
            'type' => 'textarea'
        ));

        $wp_customize->add_section(
            'theme_doc_sec', array(
            'title' => __('Documentation &amp; Support', 'prestro'),
            'priority' => null,
            'description' => __('For documentation and support follow this link :', 'prestro') . '<a href="' . esc_url(theme_doc) . '" target="_blank">pRestro Documentation</a>',
                )
        );
        $wp_customize->add_setting('doc_section', array(
            'sanitize_callback' => 'sanitize_text_field',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
                )
        );
        $wp_customize->add_control(new pRestro_Info($wp_customize, 'doc_section', array(
            'section' => 'theme_doc_sec',
            'settings' => 'doc_section'
                ))
        );

    endif;
}

add_action('customize_register', 'prestro_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function prestro_customize_preview_js() {
    wp_enqueue_script('prestro_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array('customize-preview'), '20130508', true);
}

add_action('customize_preview_init', 'prestro_customize_preview_js');

function prestro_custom_customize_enqueue() {
    wp_enqueue_script('prestro-custom-customize', get_template_directory_uri() . '/inc/js/custom.customize.js', array('jquery', 'customize-controls'), false, true);
}

add_action('customize_controls_enqueue_scripts', 'prestro_custom_customize_enqueue');

function prestro_sanitize_number($input) {
    return wp_kses_post(force_balance_tags($input));
}

function prestro_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

function prestro_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function prestro_sanitize_integer( $input ) {



    if( is_numeric( $input ) ) {



        return intval( $input );



    }



}
function prestro_area_format($input) {
   if ( isset($input) && !empty($input)) {
     return esc_textarea($input);
   } else {
    return '';
   }
}

function prestro_css() {
    ?>
    <style>

        .nivo-caption{<?php if (get_theme_mod('hide_captions') == 1) { ?> display:none !important; <?php } ?>}
        
        .site-header{background:url(<?php echo get_theme_mod('header_image');?>);;background-position:center;}
        }
    </style>
    <?php
}

add_action('wp_head', 'prestro_css');
