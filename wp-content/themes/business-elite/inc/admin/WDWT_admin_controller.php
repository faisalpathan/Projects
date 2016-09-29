<?php 
global $wdwt_options; 


/* include Layout page class */
require_once( 'page_layout.php' );
/* include General Settings page class */
require_once( 'page_general_settings.php' );
/* include Home page class */
require_once( 'page_homepage.php' );
/* include Typography page class */
require_once( 'page_typography.php' );
/* include Slider page class */
require_once( 'page_slider.php' );
/* include Lightbox page class */
require_once( 'page_lightbox.php' );

/* include licensing page & color control free version */
require_once( 'licensing.php' );

/// include Theme support page class
require_once( 'WDWT_support_information.php' );

$wdwt_layout_page = new WDWT_layout_page_class();
$wdwt_general_settings_page = new WDWT_general_settings_page_class();
$wdwt_homepage_page = new WDWT_homepage_page_class();
$wdwt_typography_page = new WDWT_typography_page_class();
$wdwt_slider_page = new WDWT_slider_page_class();
$wdwt_lightbox_page = new WDWT_lightbox_page_class();
$wdwt_themes_support_page = new WDWT_themes_support_class();

$wdwt_licensing_page = new WDWT_licensing_page_class();


/* ------- option parameter example -------
  'seo_home_title' => array( 
        'name' => 'seo_home_title', 
        'title' => __( 'Custom Title', "business-elite" ), 
        'type' => 'checkbox_open', 
        'section' => 'seo_home', 
        'tab' => 'seo', 
        'default' => ''
        'description' => __( 'Check the box to use a custom title for the website. By default it takes the combination of the website name and its description.', "business-elite" ),  
        'valid_options' => array("key" => "value"), 
        'sanitize_type' => '',
        'show' => array("key" => "value"),    // for select_open and radio btn group, and array("value","value") for checkbox
        'hide' => array("key" => "value"),    // for select_open and radio btn group, and array("value","value") for checkbox
        'input_size' = > 'char number' ,
        'width' => "",
        'height' => '',             // for textarea
        'id' => ''                // only for buttons, and text_preview  and other elements without name!
        'modified_by' => array("name" => "css_attr") 'selects' modifying  text_preview 
    )

  see options for colors in color_control.php

*/

add_filter('option_'.WDWT_OPT, 'wdwt_options_mix_defaults');
/* ajax for install sample data */
add_action('wp_ajax_wdwt_install_sample_data',  array(&$wdwt_sample_data,'install_ajax'));
/* ajax for remove sample data */
add_action('wp_ajax_wdwt_remove_sample_data',  array(&$wdwt_sample_data,'remove_ajax'));

add_action( 'after_setup_theme', 'wdwt_options_init', 10, 2 );


/*-------------------------------*/
function wdwt_options_init() {
  global $wdwt_options;

  $option_defaults = wdwt_get_option_defaults();
  $new_version = $option_defaults['theme_version'];
  $options = get_option( WDWT_OPT, array() );
  /*$old_options = array(); */

  if(isset($options['theme_version'])){
    $old_version = $options['theme_version'];
  }
  else {
    $old_version = '0.0.0';
  }

  if($new_version !== $old_version){
    require_once('updater.php');
    $theme_update = new Business_elite_updater($new_version, $old_version);
    $options = $theme_update->get_old_params();  /* old params in new format */
  }
  /*overwrite defaults with new options*/
  $wdwt_options = apply_filters('wdwt_options_init', $options);
}

/*-------------------------------*/
function wdwt_options_mix_defaults($options){
  $option_defaults = wdwt_get_option_defaults();
  /*theme version is saved separately*/
  /*for the updater*/
  if(isset($option_defaults['theme_version'])){
    unset($option_defaults['theme_version']);
  }
  $options = wp_parse_args( $options, $option_defaults);
    return $options;
}

/*-------------------------------*/
function wdwt_get_options() {
  global $wdwt_options;
  wdwt_options_init(); /*refrest options*/

  return apply_filters('wdwt_get_options', $wdwt_options);
}

/*-------------------------------*/
function wdwt_get_option_defaults() {
  $option_parameters = wdwt_get_option_parameters();
  $option_defaults = array();
  
  $current_theme = wp_get_theme();
  $option_defaults['theme_version'] = $current_theme->get( 'Version' );
  
  foreach ( $option_parameters as $option_parameter ) {
    $name =  (isset($option_parameter['name']) && $option_parameter['name'] !='' ) ? $option_parameter['name'] : false;
    if($name && isset($option_parameter['default']))
      $option_defaults[$name] = $option_parameter['default'];
  }
  return apply_filters( 'wdwt_get_option_defaults', $option_defaults );
}

/*-------------------------------*/
function wdwt_get_option_parameters() {
  global  
    $wdwt_layout_page,       
    $wdwt_general_settings_page , 
    $wdwt_homepage_page,
    $wdwt_typography_page,
    $wdwt_slider_page,
    $wdwt_lightbox_page;

    global $wdwt_licensing_page;

  $options=array();
  
  foreach($wdwt_layout_page->options as $kay => $x)
    $options[$kay] = $x;
    
  foreach($wdwt_general_settings_page->options as $kay =>  $x) 
    $options[$kay] = $x;
  

  foreach($wdwt_homepage_page->options as $kay =>  $x)  
    $options[$kay] = $x;

  foreach($wdwt_typography_page->options  as $kay => $x)  
    $options[$kay] = $x;

  foreach($wdwt_slider_page->options  as $kay => $x)  
    $options[$kay] = $x;
    
  foreach($wdwt_lightbox_page->options  as $kay => $x)  
    $options[$kay] = $x;
  
  return apply_filters( 'wdwt_get_option_parameters', $options );
}

/*-------------------------------*/
function wdwt_get_tabs() {
  
  $tabs= array();

  
  $tabs['layout_editor'] = array(
    'name' => 'layout_editor',
    'title' => __( 'Layout Editor', "business-elite" ),
    'sections' => array(
      'layout_editor' => array(
        'name' => 'layout_editor',
        'title' => __( 'Layout Editor', "business-elite" ),
        'description' => ''
      )
    ),
    'description' => wdwt_section_descr('layout_editor')
  );
  $tabs['general'] = array(
    'name' => 'general',
    'title' => __( 'General', "business-elite" ),
    'sections' => array(
      'general_main' => array(
        'name' => 'general_main',
        'title' => __( 'General', "business-elite" ),
        'description' => ''
      ),
      'general_header' => array(
        'name' => 'general_header',
        'title' => __( 'Header', "business-elite" ),
        'description' => ''
      ),
    ),
    'description' => wdwt_section_descr('general')
  );
  $tabs['homepage'] = array(
    'name' => 'homepage',
    'title' => __( 'Homepage', "business-elite" ),
    'sections' => array(
      'homepage_top_posts' => array(
        'name' => 'homepage_top_posts',
        'title' => __( 'Top Posts', "business-elite" ),
        'description' => sprintf( __( 'Create custom link menu item with URL %s to scroll to top posts.', "business-elite" ), get_home_url().'?#top_posts' )
      ),
      'homepage_tabs' => array(
        'name' => 'homepage_tabs',
        'title' => __( 'Category Tabs', "business-elite" ),
        'description' => sprintf( __( 'Create custom link menu item with URL %s to scroll to category tabs.', "business-elite" ), get_home_url().'?#category_tabs' )
      ),
      'homepage_featured_post' => array(
        'name' => 'homepage_featured_post',
        'title' => __( 'Featured Post', "business-elite" ),
        'description' => sprintf( __( 'Create custom link menu item with URL %s to scroll to featured post.', "business-elite" ), get_home_url().'?#featurd_post' )
      ),
      'homepage_content_posts' => array(
        'name' => 'homepage_content_posts',
        'title' => __( 'Content Posts', "business-elite" ),
        'description' => sprintf( __( 'Create custom link menu item with URL %s to scroll to blog content posts.', "business-elite" ), get_home_url().'?#blog' )
      ),
      'homepage_portfolio' => array(
        'name' => 'homepage_portfolio',
        'title' => __( 'Portfolio', "business-elite" ),
        'description' => sprintf( __( 'Create custom link menu item with URL %s to scroll to portfolio posts.', "business-elite" ), get_home_url().'?#portfolio' )
      ),
      'homepage_contact' => array(
        'name' => 'homepage_contact',
        'title' => __( 'Contact', "business-elite" ),
        'description' => __( 'Frontpage Contact form is disabled in free version.', "business-elite" )
      ),
      'homepage_links' => array(
        'name' => 'homepage_links',
        'title' => __( 'Links', "business-elite" ),
        'description' => ''
      ),
    ),
    'description' => wdwt_section_descr('homepage'),
  );
  $tabs['typography'] = array(
    'name' => 'typography',
    'title' => __( 'Typography', "business-elite" ),
    'description' => wdwt_section_descr('typography'),
    'sections' => array(
      'text_headers' => array(
        'name' => 'text_headers',
        'title' => __( 'Headings', "business-elite" ),
        'description' => ''
      ),
      'primary_font' => array(
        'name' => 'primary_font',
        'title' => __( 'Primary text font', "business-elite" ),
        'description' => ''
      ),
      'inputs_textareas' => array(
        'name' => 'inputs_textareas',
        'title' => __( 'Inputs and text areas', "business-elite" ),
        'description' => ''
      )
    ),
  );
  $tabs['slider'] = array(
    'name' => 'slider',
    'title' => __( 'Slider', "business-elite" ),
    'description' => wdwt_section_descr('slider'),
    'sections' => array(
      'slider_main' => array(
        'name' => 'slider_main',
        'title' => __( 'Slider - General', "business-elite" ),
        'description' => ''
      ),
      'slider_imgs' => array(
        'name' => 'slider_imgs',
        'title' => __( 'Slider - Images' , "business-elite" ),
        'description' => ''
      ),
    ),
  );
  $tabs['lightbox'] = array(
    'name' => 'lightbox',
    'title' => __( 'Lightbox', "business-elite" ),
    'description' => wdwt_section_descr('lightbox'),
    'sections' => array(
      'lightbox' => array(
      'name' => 'lightbox',
      'title' => __( 'Lightbox', "business-elite" ),
      'description' => ''
      ),
    ),
  );

  
  /* NO if WDWT_IS_PRO*/
    $tabs['color_control'] = array(
    'name' => 'color_control',
    'title' => __( 'Color Control', "business-elite" ),
    'sections' => array(
      'color_control' => array(
        'name' => 'color_control',
        'title' => __( 'Color Control', "business-elite" ),
        'description' => ''
      )
    ),
    'description' => wdwt_section_descr('color_control')
    );
  
  
    $tabs['licensing'] = array(
      'name' => 'licensing',
      'title' => __( 'Upgrade to PRO', "business-elite" ),
      'sections' => array(
        'licensing' => array(
          'name' => 'licensing',
          'title' => __( 'Upgrade to PRO', "business-elite" ),
          'description' => ''
        )
      ),
      'description' => ''
    );

  $tabs['themes_support'] = array(
    'name' => 'themes_support',
    'title' => __( 'Theme support', "business-elite" ),
    'sections' => array(
      'themes_support' => array(
        'name' => 'themes_support',
        'title' => '',
        'description' => ''
      )
    ),
    'description' => ''
  );
  return apply_filters( 'wdwt_get_tabs', $tabs );
}