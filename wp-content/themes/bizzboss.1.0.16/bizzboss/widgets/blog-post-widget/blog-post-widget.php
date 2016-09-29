<?php
/*
Widget Name: Blog post widget
Description: This is widget to show latest post which combines with Bizzboss Pro.
Author: IndigoThemes
Author URI: https://indigothemes.com/
*/

class Blog_post_Widget extends SiteOrigin_Widget {
	function __construct() {
		$keyFeatureIconHoverColor = ''.(get_theme_mod('theme_color')=='') ? '#2c3e55': get_theme_mod('theme_color');

		parent::__construct(
			'blog-post-widget',
			__('Blog Post Widget', 'bizzboss'),
			array(
				'description' => __('A widget which shows latest post', 'bizzboss'),
			),
			array(

			),
			$form_options = array(
			    'blogPost' => array(
			        'type' => 'posts',
			        'label' => __('Select posts query', 'bizzboss'),
			    ),
				'blogPostSelect' => array(
			        'type' => 'select',
			        'label' => __( 'Post Display Type', 'bizzboss'),
			        'options' => array(
			            'normal' => __( 'Normal', 'bizzboss' ),
			            'slider' => __( 'Slider', 'bizzboss' ),
			        ),
				),
			),
			plugin_dir_path(__FILE__)
		);
	}

	function get_template_name($instance) {
		return 'blog-post-widget-template';
	}

	function get_style_name($instance) {
		return 'blog-post-widget-style';
	}

}

siteorigin_widget_register('blog-post-widget', __FILE__, 'Blog_post_Widget');