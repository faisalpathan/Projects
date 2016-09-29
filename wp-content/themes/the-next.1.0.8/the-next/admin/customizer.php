<?php
/**
 * The Next Customizer.
 * 
 * @package WordPress
 * @subpackage The Next
 * @since The Next 1.0.3
 */

/**
 * Classes to create a custom controls
 */
if (class_exists('WP_Customize_Control')) {

    class Layout_Picker_Custom_Control extends WP_Customize_Control {
        
        public $type = 'layout';
        
        public function render_content() {
            $imageDir = '/images/layouts/';            
            $imguri = get_template_directory_uri() . $imageDir;
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <div class="thenext-sb-layout">
                    <label>
                        <input type="radio" <?php $this->link(); ?> name="<?php echo $this->id; ?>" value="no-sidebar" />
                        <img src="<?php echo $imguri; ?>no-sidebar.png" alt="Full Width" title="Full Width"/>
                    </label>
                    <label>
                        <input type="radio" <?php $this->link(); ?> name="<?php echo $this->id; ?>" value="left-sidebar-1" />
                        <img src="<?php echo $imguri; ?>left-sidebar.png" alt="Left Sidebar" title="Left Sidebar"/>
                    </label>
                    <label>
                        <input type="radio" <?php $this->link(); ?> name="<?php echo $this->id; ?>" value="right-sidebar-1" />
                        <img src="<?php echo $imguri; ?>right-sidebar.png" alt="Right Sidebar" title="Right Sidebar" />
                    </label>
                    <label>
                        <input type="radio" <?php $this->link(); ?> name="<?php echo $this->id; ?>" value="sidebar-2" />
                        <img src="<?php echo $imguri; ?>sidebar-2.png" alt="Sidebar | Content | Sidebar" title="Sidebar | Content | Sidebar"/>
                    </label>
                    <label>
                        <input type="radio" <?php $this->link(); ?> name="<?php echo $this->id; ?>" value="left-sidebar-2" />
                        <img src="<?php echo $imguri; ?>left-sidebar-2.png" alt="Two Left Sidebar" title="Two Left Sidebar"/>
                    </label>
                    <label>
                        <input type="radio" <?php $this->link(); ?> name="<?php echo $this->id; ?>" value="right-sidebar-2" />
                        <img src="<?php echo $imguri; ?>right-sidebar-2.png" alt="Two Right Sidebar" title="Two Right Sidebar"/>
                    </label>
            </div>
            <?php
        }
    }

    class Image_Picker_Custom_Control extends WP_Customize_Control {

        public $type = 'image-picker';

        public function render_content() {
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <div class="thenext-image-picker">
                <?php foreach($this->choices as $choice): ?>

                    <label>
                        <input type="radio" <?php $this->link(); ?> name="<?php echo $this->id; ?>" value="<?php echo $choice['value']; ?>" />
                        <img src="<?php echo $choice['src']; ?>" alt="<?php echo $choice['title']; ?>" title="<?php echo $choice['title']; ?>"/>
                    </label>

                <?php endforeach; ?>
            </div>
            <?php
        }
    }
    
}

/**
 * 
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function thenext_customize_register($wp_customize) {
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    /* Load Panels, Sections, Settings, Controls array */
    require_once ( dirname(__FILE__) . '/customizer-config.php' );


    /* Adding support for Child Themes */
    $thenext_panels = apply_filters('thenext_customizer_panels', $thenext_panels);
    $thenext_sections = apply_filters('thenext_customizer_sections', $thenext_sections);
    $thenext_options = apply_filters('thenext_customizer_options', $thenext_options);

    /* Basic Config */
    $theme_option = $thenext_config['option_name'];
    $capability = $thenext_config['capability'];
    $option_type = $thenext_config['option_type'];


    /* Add Panels */
    foreach($thenext_panels as $id => $args){
        $wp_customize->add_panel($id, $args);
    }

    /* Add Sections */
    foreach($thenext_sections as $id => $args){
        $wp_customize->add_section($id, $args);
    }

    /* Add Settings and Controls */
    foreach($thenext_options as $id => $args){
        extract( $args );

        switch( $type ) {
            case 'text':
                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'sanitize_text_field',
                ));

                $wp_customize->add_control($id, array(
                    'label' => $label,
                    'section' => $section,
                    'settings' => $theme_option.'['.$id.']',
                ));
                break;

            case 'textarea':
                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'sanitize_text_field',
                ));

                $wp_customize->add_control($id, array(
                    'label' => $label,
                    'type' => 'textarea',
                    'section' => $section,
                    'settings' => $theme_option.'['.$id.']',
                ));
                break;

            case 'email':
                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'thenext_sanitize_email',
                ));

                $wp_customize->add_control($id, array(
                    'label' => $label,
                    'section' => $section,
                    'settings' => $theme_option.'['.$id.']',
                ));
                break;

            case 'url':
                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'esc_url_raw',
                ));

                $wp_customize->add_control($id, array(
                    'label' => $label,
                    'section' => $section,
                    'settings' => $theme_option.'['.$id.']',
                ));
                break;

            case 'number':
                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'thenext_sanitize_integer',
                ));

                $wp_customize->add_control($id, array(
                    'label' => $label,
                    'type' => 'number',
                    'section' => $section,
                    'settings' => $theme_option.'['.$id.']',
                    'input_attrs' => array(
                        'min' => $min,
                    )
                ));
                break;

            case 'image':
                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'esc_url_raw',
                ));

                $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $id, array(
                    'label' => $label,
                    'section' => $section,
                    'settings' => $theme_option.'['.$id.']',
                )));
                break;

            case 'select':
                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'sanitize_text_field',
                ));

                $wp_customize->add_control($id, array(
                    'label' => $label,
                    'type' => 'select',
                    'section' => $section,
                    'settings' => $theme_option.'['.$id.']',
                    'choices' => $choices,
                ));
                break;

            case 'color':
                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'sanitize_hex_color',
                ));

                $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $id, array(
                    'label' => $label,
                    'section' => $section,
                    'settings' => $theme_option.'['.$id.']',
                )));
                break;

            case 'layout':
                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'sanitize_text_field',
                ));
                $wp_customize->add_control(new Layout_Picker_Custom_Control($wp_customize, $id, array(
                    'label' => $label,
                    'description' => '',
                    'type' => 'layout',
                    'section' => $section,
                    'settings' => $theme_option.'['.$id.']',
                )));
                break;

            case 'image-picker':
                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'sanitize_text_field',
                ));
                $wp_customize->add_control(new Image_Picker_Custom_Control($wp_customize, $id, array(
                    'label' => $label,
                    'description' => '',
                    'type' => 'image-picker',
                    'section' => $section,
                    'settings' => $theme_option.'['.$id.']',
                    'choices' => $choices,
                )));
                break;

            case 'dropdown-pages':
                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'capability' => $capability,
                    'default' => $default,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'thenext_sanitize_integer',
                ));

                $wp_customize->add_control($id, array(
                    'label' => $label,
                    'section' => $section,
                    'type' => 'dropdown-pages',
                    'settings' => $theme_option.'['.$id.']',
                ));
                break;

            case 'dropdown-taxonomy':
                $choices = array();
                $taxonomies = get_terms($taxonomy, 'hide_empty=0');

                if(count($taxonomies)>0) {
                    foreach ($taxonomies as $taxo) {
                        $choices[$taxo->term_id] = $taxo->name;
                    }
                }

                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'sanitize_text_field',
                ));

                $wp_customize->add_control($id, array(
                    'label' => $label,
                    'type' => 'select',
                    'section' => $section,
                    'settings' => $theme_option.'['.$id.']',
                    'choices' => $choices,
                ));
                break;

            case 'typhography':
                $fontsdata = WPEdenOptionFields::GetFonts();

                $fonts = array();
                $fonts[''] = 'Default';
                foreach($fontsdata as $key => $font){
                    $fonts[$key] = $font['name'];
                }

                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'sanitize_text_field',
                ));
                $wp_customize->add_control($id, array(
                    'settings' => $theme_option.'['.$id.']',
                    'label' => $label,
                    'section' => $section,
                    'type' => 'select',
                    'choices' => $fonts,
                ));
                break;

            case 'range':
                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => $default,
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'thenext_sanitize_integer',
                ));
                $wp_customize->add_control($id, array(
                    'label' => $label,
                    'type' => 'range',
                    'section' => $section,
                    'settings' => $theme_option.'['.$id.']',
                    'input_attrs' => $input_attrs,
                ));
                break;

            case 'dropdown-sidebar':
                global $wp_registered_sidebars;
                $sidebars = array();
                $sidebars[''] = 'Do not apply';
                foreach ($wp_registered_sidebars as $sidebar) {
                    $sid = $sidebar['id'];
                    $sidebars[$sid] = $sidebar['name'];
                }

                $wp_customize->add_setting($theme_option.'['.$id.']', array(
                    'default' => '',
                    'capability' => $capability,
                    'type' => $option_type,
                    'transport' => $transport,
                    'sanitize_callback' => 'sanitize_text_field',
                ));

                $wp_customize->add_control($id, array(
                    'settings' => $theme_option.'['.$id.']',
                    'label' => $label,
                    'section' => $section,
                    'type' => 'select',
                    'choices' => $sidebars,
                ));
                break;

            default:
                break;
        }

    }
}

add_action( 'customize_register', 'thenext_customize_register' );


/**
 *
 * Sanitize Input Data
 */
function thenext_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function thenext_sanitize_email( $input ){
    if(is_email($input))
        return $input;
}

/**
 * 
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function thenext_customize_preview_js() {
    wp_enqueue_script( 'thenext_customizer', get_template_directory_uri() . '/admin/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'thenext_customize_preview_js' );

/**
 * 
 * Customizing Customizer Controls
 */
function thenext_customizer_style() {


    wp_enqueue_style( 'thenext-custommizer-controls-css', get_template_directory_uri() . '/admin/css/thenext-customizer-controls.css' );
    wp_enqueue_script( 'thenext-customizer-controls-js', get_template_directory_uri() . '/admin/js/thenext-customizer-controls.js', array( 'jquery', 'customize-controls' ), false, true );

    //wp_enqueue_style('chosen-ui', get_template_directory_uri().'/admin/css/chosen.css');
    //wp_enqueue_script('chosen-js', get_template_directory_uri() . '/admin/js//chosen.jquery.js',array('jquery', 'customize-controls'), false, true);
}
add_action( 'customize_controls_enqueue_scripts', 'thenext_customizer_style' );

