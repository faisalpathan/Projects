<?php
/*
 * bizzboss Enqueue css and js files
 */

function bizzboss_enqueue_new() {
	
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap'.$suffix.'.css', array());

	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome'.$suffix.'.css', array());
	
	wp_enqueue_style('bizzboss-font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800', array());
	wp_enqueue_style('bizzboss-default', get_template_directory_uri() . '/css/default.css', array());
	
	wp_enqueue_style('bizzboss-style', get_stylesheet_uri(), array());
	
	wp_enqueue_script( 'bizzboss-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'bizzboss-html5', 'conditional', 'lt IE 9' );

	if (is_singular()) {
    	wp_enqueue_script("comment-reply");
    }
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap'.$suffix.'.js', array('jquery'));
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel'.$suffix.'.js', array('jquery'));
	wp_enqueue_script('bizzboss-script', get_template_directory_uri() . '/js/script.js', array('jquery'));
	wp_enqueue_script('bizzboss-menu-script', get_template_directory_uri() . '/js/menuscript.js', array('jquery'));
}
add_action( 'wp_enqueue_scripts', 'bizzboss_enqueue_new' );

//admin style sheet
add_action( 'admin_enqueue_scripts', 'bizzboss_register_admin_style' );
function bizzboss_register_admin_style() {
	wp_register_style('bizzboss_custom_admin',get_template_directory_uri().'/css/custom_admin.css');
	wp_enqueue_style('bizzboss_custom_admin');
}
?>