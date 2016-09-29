<?php
/*define theme global constants*/
/*framework prefix is wdwt*/ 
define("WDWT_TITLE", "Business Elite");
define("WDWT_SLUG", "business-elite");
define("WDWT_VAR", "business_elite");
/*translation text domain*/

define("WDWT_META", "_".WDWT_SLUG."_meta");
define("WDWT_OPT", WDWT_VAR."_options");
define("WDWT_VERSION", wp_get_theme()->get( 'Version' ) );
define("WDWT_LOGO_SHOW", true);
define("WDWT_HOMEPAGE", "https://web-dorado.com");
/*directories*/
define("WDWT_DIR", get_template_directory());
/*URLs*/
define("WDWT_URL", get_template_directory_uri());
define("WDWT_IMG", WDWT_URL.'/images/');
define("WDWT_IMG_INC", WDWT_URL.'/inc/images/');

load_theme_textdomain("business-elite", WDWT_DIR.'/languages' );
/*include admin, options and frontend classes*/
require_once('inc/index.php');



if(!is_admin()){
  add_action('init','wdwt_front_init');  
}
/* head*/
add_action('wp_head','wdwt_include_head');
/*  Frontend scripts and styles	*/
add_action('wp_enqueue_scripts','wdwt_scripts_front');	


/* sidebars*/
add_action('widgets_init', 'wdwt_widgets_init');
/* change body class*/
add_filter('body_class', 'wdwt_multisite_body_classes');
/* add_theme_support , textdomain etc */
add_action('after_setup_theme', 'wdwt_setup_elements');
/* excerpt more */
add_filter('excerpt_more', array(WDWT_VAR.'_frontend_functions', 'excerpt_more'));
/*   remove more in posts and pages   */
add_filter('the_content_more_link', array(WDWT_VAR.'_frontend_functions', 'remove_more_jump_link'));

add_action('wp_ajax_wdwt_front_top_posts', 'wdwt_front_pages');
add_action('wp_ajax_nopriv_wdwt_front_top_posts', 'wdwt_front_pages');
add_action('wp_ajax_wdwt_front_portfolio_home', 'wdwt_front_pages');
add_action('wp_ajax_nopriv_wdwt_front_portfolio_home', 'wdwt_front_pages');
add_action('wp_ajax_wdwt_front_wd_tabs_dynamic', 'wdwt_front_pages');
add_action('wp_ajax_nopriv_wdwt_front_wd_tabs_dynamic', 'wdwt_front_pages');
add_action('wp_ajax_wdwt_front_content_posts', 'wdwt_front_pages');
add_action('wp_ajax_nopriv_wdwt_front_content_posts', 'wdwt_front_pages');

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', array(WDWT_VAR.'_frontend_functions', 'wdwt_wrapper_start'), 10);
add_action('woocommerce_after_main_content', array(WDWT_VAR.'_frontend_functions', 'wdwt_wrapper_end'), 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/*lightbox*/
add_action('wp_ajax_wdwt_lightbox', 'wdwt_lightbox');
add_action('wp_ajax_nopriv_wdwt_lightbox', 'wdwt_lightbox');


/*functions are below*/
function wdwt_front_init(){
   global $wdwt_options,
    $wdwt_front;
  
	global $wp_customize;
	if ( !isset( $wp_customize ) ) {
		$wdwt_front =  new Business_elite_front($wdwt_options);  
	}
}

function wdwt_include_head(){
	global $wdwt_front;

	$wdwt_front->layout();
	$wdwt_front->menu_size();
	$wdwt_front->typography();
	$wdwt_front->color_control();
	$wdwt_front->custom_css();
}

function wdwt_scripts_front(){
	global $wdwt_front;
	
	/*---- SLIDER ----*/
	$animation_speed = $wdwt_front->get_param('animation_speed');
	$effect = $wdwt_front->get_param('effect');
	
	$image_height = $wdwt_front->get_param('image_height');
	$stop_on_hover = trim($wdwt_front->get_param('stop_on_hover'));
	$stop_on_hover = ($stop_on_hover == 'false' || $stop_on_hover == '' ) ? '0' : '1';
	$slideshow_interval = $wdwt_front->get_param('slideshow_interval');
	$hide_slider = $wdwt_front->get_param('hide_slider');
	$imgs_url = $wdwt_front->get_param('slider_head');
	$imgs_url = explode('||wd||',$imgs_url); 

	$business_elite_slider_options = array(
	  "animation_speed" => $animation_speed,
	  "effect" => $effect[0],
	  "image_height" => $image_height,
	  "slideshow_interval" => $slideshow_interval,
	  "stop_on_hover" => $stop_on_hover,
	);

	if(is_home() && is_front_page()){
    $wdwt_front->frontpage_content_posts();
  }
	
	if(($hide_slider[0]!="Hide Slider" && ((is_home() && $hide_slider[0]=="Only on Homepage") || (is_front_page() && $hide_slider[0]=="Only on Front Page") || $hide_slider[0]=="On all the pages and posts")) && count($imgs_url) && is_array($imgs_url)){
		wp_enqueue_script('business_elite_slider_js',get_template_directory_uri().'/inc/js/slider.js',array('jquery'), WDWT_VERSION);
		wp_localize_script('business_elite_slider_js', 'business_elite_slider_options', $business_elite_slider_options);
	}
		
	/*-----EFFECT FOR HOME PAGE------*/
	 
	$effects_array=array(
	  "top_post_effect" => 'none',
	  "feautured_effect" => 'none',
	  "portfolio_effect" => 'none',
	  "contact_effect" => 'none',
	);

	wp_enqueue_script( 'wdwt_custom_js', WDWT_URL.'/inc/js/javascript.js',array('jquery'), WDWT_VERSION);
	
	wp_localize_script( 'wdwt_custom_js', 'business_elite_admin_ajax', admin_url('admin-ajax.php') );
	wp_localize_script( 'wdwt_custom_js', 'business_elite_effects', $effects_array );
	wp_localize_script( 'wdwt_custom_js', 'business_elite_site_url', trailingslashit(home_url()) );
	wp_localize_script( 'wdwt_custom_js', 'business_elite_is_front', (is_front_page() && is_home()) ? '1' : '0' );

	
	wp_enqueue_script('jquery-scrollto', WDWT_URL.'/inc/js/jquery.scrollTo-min.js',array('jquery'), WDWT_VERSION);
	wp_enqueue_script('jquery-effects-core');	
	wp_enqueue_script('jquery-effects-explode');	
	wp_enqueue_script('jquery-effects-slide');	
	wp_enqueue_script('jquery-effects-transfer');
	
	wp_enqueue_script('jquery-animate-number',WDWT_URL.'/inc/js/jquery.animateNumber.min.js', array('jquery'), WDWT_VERSION);
	wp_enqueue_script('wdwt_response', WDWT_URL.'/inc/js/responsive.js', array('jquery', 'wdwt_custom_js'), WDWT_VERSION);
	/*------FIX_MENU-------*/
	$fixed_menu = $wdwt_front->get_param('fixed_menu');
	if($fixed_menu=="on")
		wp_enqueue_script('wdwt_scrolling_menu',WDWT_URL.'/inc/js/scrolling_menu.js', array('wdwt_response'), WDWT_VERSION);
 
 	wp_localize_script( 'wdwt_response', 'wdwt_sticky_menu', $fixed_menu == "on" ? '1' : '0' );
	

	wp_enqueue_style( WDWT_SLUG.'-style', get_stylesheet_uri(), array(), WDWT_VERSION );
	wp_enqueue_style( 'wdwt_slider-style' ,get_template_directory_uri().'/styles/slider.css', array(), WDWT_VERSION );
	wp_enqueue_style( 'wdwt_effect-style', get_template_directory_uri().'/styles/effects.css', array(), WDWT_VERSION );
	
	wp_enqueue_script('wdwt_hover_effect',WDWT_URL.'/inc/js/jquery-hover-effect.js', array('jquery'), WDWT_VERSION);
 	wp_enqueue_script( 'comment-reply' );

	// Styles/Scripts for popup.
	wp_enqueue_style('font-awesome', WDWT_URL . '/inc/css/font-awesome/font-awesome.css', array(), WDWT_VERSION);
	wp_enqueue_script('jquery-mobile', WDWT_URL . '/inc/js/jquery.mobile.min.js', array('jquery'), WDWT_VERSION);
	wp_enqueue_script('jquery-mCustomScrollbar', WDWT_URL . '/inc/js/jquery.mCustomScrollbar.concat.min.js', array('jquery'), WDWT_VERSION);
	wp_enqueue_style('mCustomScrollbar', WDWT_URL . '/inc/css/jquery.mCustomScrollbar.css', array(), WDWT_VERSION);
	wp_enqueue_script('jquery-fullscreen', WDWT_URL . '/inc/js/jquery.fullscreen-0.4.1.js', array('jquery'), WDWT_VERSION);
   
	wp_enqueue_script('wdwt_lightbox_loader', WDWT_URL.'/inc/js/lightbox.js', array('jquery'), WDWT_VERSION);
	wp_localize_script( 'wdwt_lightbox_loader', 'admin_ajax_url', admin_url('admin-ajax.php') );
	
}

/*---------------*/
function wdwt_widgets_init(){
	/* Area 1, located at the top of the sidebar. */
	register_sidebar(array(
	  'name' => __('Primary Widget Area', "business-elite"),
	  'id' => 'sidebar-1',
	  'description' => __('The primary widget area', "business-elite"),
	  'before_widget' => '<div id="%1$s" class="widget-sidebar sidebar-1 %2$s">',
	  'after_widget' => '</div> ',
	  'before_title' => '<h3>',
	  'after_title' => '</h3>',
	));
	/* Area 2, located below the Primary Widget Area in the sidebar. Empty by default. */
	register_sidebar(array(
	  'name' => __('Secondary Widget Area', "business-elite"),
	  'id' => 'sidebar-2',
	  'description' => __('The secondary widget area', "business-elite"),
	  'before_widget' => '<div id="%1$s" class="widget-sidebar sidebar-2 %2$s">',
	  'after_widget' => '</div>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
	));
	/* First footer widget area */
	register_sidebar(array(
	  'name' => __('First Footer Widget Area', "business-elite"),
	  'id' => 'primary-footer-widget-area',
	  'description' => __('Footer widget area', "business-elite"),
	  'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	  'after_widget' => '</div>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
    ));
	/* Second footer widget area */
	register_sidebar(array(
	  'name' => __('Second Footer Widget Area', "business-elite"),
	  'id' => 'secondary-footer-widget-area',
	  'description' => __('Footer widget area', "business-elite"),
	  'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	  'after_widget' => '</div>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>',
    ));
}


/*---------------*/
function wdwt_multisite_body_classes($classes){
	foreach($classes as $key=>$class) {
		if($class=='blog')
			$classes[$key]='blog_body';
	}
	return $classes;
}

/*------ CALL FUNCTIONS AFTER THEME SETUP --------*/
function wdwt_setup_elements(){
	/* add custom header in admin menu */
	add_theme_support( 'custom-header', array(
	  'default-text-color'=> '220e10',
	  'default-image'     => '',
	  'header-text'       => false,
	  'height'            => 240,
      'width'             => 1024,	
	) );
	/* add custom background in admin menu */
	$theme_defaults = array(
	  'default-color'          => 'fffff',
	  'default-image'          => '',
	);
	add_theme_support('custom-background', $theme_defaults );
  add_theme_support('title-tag');
	if(!get_theme_mod('background_color',false))
		set_theme_mod('background_color','ffffff')	;
  
	/* For Post thumbnail */
	add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 150);
	add_image_size( 'business-elite-width', 370,310, true );	
	/* requerid  features */
	add_theme_support('automatic-feed-links');
	/* include language */
	//load_theme_textdomain("business-elite", WDWT_DIR.'/languages' );
	/* register menu, */
    register_nav_menu('primary-menu', 'Primary Menu');
	/* for editor styles */
	add_editor_style();

	if ( ! isset( $content_width ) ) {
		$content_width = 1024;
	}

	/*WooCommerce support*/
  add_theme_support( 'woocommerce' );


}




/*------- LIGTHBOX --------*/
function wdwt_lightbox (){
  $action = $_POST['action'];
  if($action == "wdwt_lightbox"){
    require_once('inc/front/WDWT_lightbox.php');
    $lightbox = new WDWT_Lightbox();
    $lightbox->view();
  }
  die();
}


function wdwt_front_pages(){

	global $wdwt_options;
	global $wdwt_front;
  require_once('inc/front/front_params_output.php');
  $wdwt_front = new Business_elite_front($wdwt_options);

	$action = $_REQUEST['action'];
	$paged = isset($_REQUEST['paged']) ? intval($_REQUEST['paged']) : 0;

	if($action == "wdwt_front_top_posts"){
		require_once('inc/front/front_functions.php');
		Business_elite_frontend_functions::top_posts($paged);
	}
	if($action == "wdwt_front_portfolio_home"){
		require_once('inc/front/front_functions.php');
		Business_elite_frontend_functions::portfolio_home($paged);
	}
	if($action == "wdwt_front_wd_tabs_dynamic"){
		$cat_id = isset($_REQUEST['cat']) ? intval($_REQUEST['cat']) : 0;
		$key = isset($_REQUEST['key']) ? intval($_REQUEST['key']) : 0;
		$lang = isset($_REQUEST['lang']) ? (string) ($_REQUEST['lang']) : false;
		require_once('inc/front/front_functions.php');
		Business_elite_frontend_functions::category_tab_ajax($paged, $cat_id, $key, $lang);
	}
	if($action == "wdwt_front_content_posts"){
    require_once('inc/front/front_functions.php');
    Business_elite_frontend_functions::content_posts($paged);
  }



	die();

}





?>