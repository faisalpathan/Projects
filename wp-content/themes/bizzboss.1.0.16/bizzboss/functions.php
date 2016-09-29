<?php
/*
 * Set up the content width value based on the theme's design.
 */

if (!function_exists('bizzboss_setup')) :
    function bizzboss_setup() {
        global $content_width;
        if (!isset($content_width)) { $content_width = 870; }
        // Make bizzboss theme available for translation.
        load_theme_textdomain('bizzboss', get_template_directory() . '/languages');

        // Add RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');
        add_theme_support( 'custom-logo', array(
          'height'      => 240,
          'width'       => 240,
          'flex-height' => true,
        ) );
        // register menu 
        register_nav_menus(array(
            'primary' => __('Top Header Menu', 'bizzboss'),
            'secondary' => __('Top Secondary Menu', 'bizzboss'),
        ));
        
        // Featured image support
        add_theme_support('post-thumbnails');
        add_image_size('bizzboss-thumbnail-image', 410, 215, true);
        
        // Switch default core markup for search form, comment form, and commen, to output valid HTML5.
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));

        add_theme_support('custom-background', array('default-color' => 'f5f5f5'));
        add_theme_support('custom-header', array('default-color' => '019779'));

        /* slug setup */
        add_theme_support('title-tag');

        //Avctivate all widgets
        function bizzboss_filter_active_widgets($active){
        
        //Custom Widgets
        $active['blog-post-widget'] = true;
        $active['key-feature-widget'] = true;

        //Bundled Widgets
        $active['video'] = true;
        $active['testimonial'] = true;
        $active['taxonomy'] = true;
        $active['social-media-buttons'] = true;
        $active['simple-masonry'] = true;
        $active['slider'] = true;
        $active['cta'] = true;
        $active['contact'] = true;
        $active['features'] = true;
        $active['headline'] = true;
        $active['hero'] = true;
        $active['icon'] = true;
        $active['image-grid'] = true;
        $active['price-table'] = true;
        $active['layout-slider'] = true;
        
        return $active;
        }
        add_filter('siteorigin_widgets_active_widgets', 'bizzboss_filter_active_widgets');
    }
endif; // bizzboss_setup
add_action('after_setup_theme', 'bizzboss_setup');

/*
* Sanitize call-back fnction
*/ 
function bizzboss_sanitize_text($input)
{
    return wp_kses_post( force_balance_tags( $input ) );
}

function bizzboss_sanitize_radio($input)
{
    return sanitize_text_field( $input );
}

/*
* Change excerpt legth
*/
add_filter( 'excerpt_length', 'bizzboss_excerpt_length', 999 );

function bizzboss_excerpt_length( $length ) {
    return 15;
}

add_action( 'tgmpa_register', 'bizzboss_action_tgmpa_register_blogim_register_required_plugins' );
function bizzboss_action_tgmpa_register_blogim_register_required_plugins() 
{
    if(class_exists('TGM_Plugin_Activation')) { 
         $plugins = array(
     
         
          array(
             'name'      => __('Page Builder by SiteOrigin', 'bizzboss'),
             'slug'      => 'siteorigin-panels',
             'required'  => false,
          ),    
             
          array(
             'name'      => __('SiteOrigin Widgets Bundle','bizzboss'),
             'slug'      => 'so-widgets-bundle',
             'required'  => false,
            ),
         );
     
         $config = array(
           'default_path' => '',                      
           'menu'         => 'bizzboss-install-plugins', 
           'has_notices'  => true,                    
           'dismissable'  => true,                    
           'dismiss_msg'  => '',                      
           'is_automatic' => false,                   
           'message'      => '',                      
           'strings'      => array(
               'page_title'                      => __( 'Install Required Plugins', 'bizzboss' ),
               'menu_title'                      => __( 'Install Plugins', 'bizzboss' ),
               'installing'                      => __( 'Installing Plugin: %s', 'bizzboss' ), 
               'oops'                            => __( 'Something went wrong with the plugin API.', 'bizzboss' ),
               'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','bizzboss' ), 
               'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.','bizzboss' ), 
               'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','bizzboss' ), 
               'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.','bizzboss' ), 
               'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','bizzboss' ), 
               'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','bizzboss' ), 
               'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.','bizzboss' ), 
               'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','bizzboss' ), 
               'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins','bizzboss' ),
               'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins','bizzboss' ),
               'return'                          => __( 'Return to Required Plugins Installer', 'bizzboss' ),
               'plugin_activated'                => __( 'Plugin activated successfully.', 'bizzboss' ),
               'complete'                        => __( 'All plugins installed and activated successfully. %s', 'bizzboss' ), 
               'nag_type'                        => 'updated'
           )
         );     
         bizzboss( $plugins, $config );
    }

}

/* * * Load TGM Library classes ** */
require_once (dirname(__FILE__) . '/functions/class-tgm-activation.php');

/* * * Theme Default Setup ** */
require get_template_directory() . '/functions/theme-default-setup.php';

/* * * Enqueue css and js files ** */
require get_template_directory() . '/functions/enqueue-files.php';

/* * * Theme Customization ** */
require get_template_directory() . '/functions/theme-customization.php';



// Changing the_excerpt() default functionality
function bizzboss_allowedtags() {
  // Add custom tags to this string
  return '<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>'; 
}

//theme page builder widgets path set
function bizzboss_add_widget_folders( $folders ){
    $folders[] = get_template_directory() . '/widgets/';
    return $folders;
}
add_action('siteorigin_widgets_widget_folders', 'bizzboss_add_widget_folders');
function bizzboss_widget_banner_img_src( $banner_url, $widget_meta ) {
  $widgetArray[] = array('','','','','','');
  if( $widget_meta['ID'] == 'blog-post-widget') {
    $banner_url =  get_template_directory_uri() . '/widgets/blog-post-widget/assets/banner.svg';
  }
  if( $widget_meta['ID'] == 'key-feature-widget') {
    $banner_url =  get_template_directory_uri() . '/widgets/key-feature-widget/assets/banner.svg';
  }
  return $banner_url;
}
  add_filter( 'siteorigin_widgets_widget_banner', 'bizzboss_widget_banner_img_src', 10, 2);

//Pro Feature Menu
function bizzboss_pro_menu_settings() {
    $bizzboss_menu = array(
        'page_title' => __('Bizzboss Pro Features', 'bizzboss'),
        'menu_title' => __('Bizzboss Pro Features', 'bizzboss'),
        'capability' => 'edit_theme_options',
        'menu_slug' => 'bizzboss',
        'callback' => 'bizzboss_pro_page'
    );
    return apply_filters('bizzboss_pro_menu', $bizzboss_menu);
}

add_action('admin_menu', 'bizzboss_options_add_page');

function bizzboss_options_add_page() {
    $bizzboss_menu = bizzboss_pro_menu_settings();
    add_theme_page($bizzboss_menu['page_title'], $bizzboss_menu['menu_title'], $bizzboss_menu['capability'], $bizzboss_menu['menu_slug'], $bizzboss_menu['callback']);
}

function bizzboss_pro_page(){?>
<div class="bizzboss_proversion">
  <a href="<?php echo esc_url('https://indigothemes.com/products/bizzboss-pro-wordpress-theme/'); ?>" target="_blank">
    <img src ="<?php echo get_template_directory_uri();?>/images/BB1.jpg"/>
    <img src ="<?php echo get_template_directory_uri();?>/images/BB2.jpg" />
    <img src ="<?php echo get_template_directory_uri();?>/images/BB3.png" />
  </a>
</div>

<?php
}