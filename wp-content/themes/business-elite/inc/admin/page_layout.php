<?php
class WDWT_layout_page_class {
	public $options;

	function __construct(){
		$this->options = array(
			'default_layout' => array(
				"name" => "default_layout",
				"title" => __( "Choose Default Layout", "business-elite"),
				'type' => 'layout_open',
				"description" => __("Select the default layout for pages and posts on the website.", "business-elite"),
				'valid_options' => array(
					array('index' => '1', 'title'=>'No Sidebar', 'description'=>''),
					array('index' => '2', 'title'=>'Right Sidebar', 'description'=>''),
					array('index' => '3', 'title'=>'Left Sidebar', 'description'=>''),
					array('index' => '4', 'title'=>'Two Right Sidebars', 'description'=>''),
					array('index' => '5', 'title'=>'Two Left Sidebars', 'description'=>''),
					array('index' => '6', 'title'=>'One Right One Left Sidebars', 'description'=>''),
				),
				'show' => array(
					'2'=>'main_column',
					'3'=>'main_column',
					'4'=>array('main_column', 'pwa_width'),
					'5'=>array('main_column', 'pwa_width'),
					'6'=>array('main_column', 'pwa_width'),
				),
				'hide' => array(),
				'img_src' => 'sprite-layouts.png',
				'img_height' => 289,
				'img_width' => 50,
				'section' => 'layout_editor',
				'tab' => 'layout_editor',
				'default' => '1',
				'customizer' => array()
			),
			'full_width' => array(
				"name" => "full_width",
				"title" => __( "Full Width", "business-elite"),
				'type' => 'checkbox_open',
				"description" => __("You can choose full width for pages and posts on the website.", "business-elite"),
				'section' => 'layout_editor',
				'tab' => 'layout_editor',
				'show' => array(),
				'hide' => array('content_area_percent', 'content_area_percent_large'),
				'default' => false,
				'customizer' => array()
			),
			'content_area_percent' => array(
				"name" => "content_area_percent",
				"title" => __( "Content Area Width", "business-elite"),
				'type' => 'number',
				"description" =>  __("Specify the width of the Content Area", "business-elite"),
				'unit_symbol' => '%',
				'input_size' => '2',
				'min' => '75',
				'max' => '99',
				"sanitize_type" => "sanitize_text_field",
				'section' => 'layout_editor',
				'tab' => 'layout_editor',
				'default' => 75,
				'customizer' => array()
			),
			'content_area_percent_large' => array(
				"name" => "content_area_percent_large",
				"title" => __( "Content Area Width on Large Desktop Screens", "business-elite"),
				'type' => 'number',
				"description" =>  __("Specify the width of the Content Area", "business-elite"),
				'unit_symbol' => '%',
				'input_size' => '2',
				'min' => '50',
				'max' => '99',
				"sanitize_type" => "sanitize_text_field",
				'section' => 'layout_editor',
				'tab' => 'layout_editor',
				'default' => 65,
				'customizer' => array()
			),
			'main_column' => array(
				"name" => "main_column",
				"title" => __( "Main Column Width", "business-elite"),
				'type' => 'number',
				"description" =>  __("Specify the width of the Main Column", "business-elite"),
				'unit_symbol' => '%',
				'input_size' => '2',
				'min' => '30',
				'max' => '100',
				"sanitize_type" => "sanitize_text_field",
				'section' => 'layout_editor',
				'tab' => 'layout_editor',
				'default' => 64,
				'customizer' => array()
			),
			'pwa_width' => array(
				"name" => "pwa_width",
				"title" => __( "Primary Widget Area width", "business-elite"),
				'type' => 'number',
				"description" => __("Specify the width of the Primary Widget Area", "business-elite"),
				'unit_symbol' => '%',
				'input_size' => '2',
				'min' => '0',
				'max' => '60',
				"sanitize_type" => "sanitize_text_field",
				'section' => 'layout_editor',
				'tab' => 'layout_editor',
				'default' => 18,
				'customizer' => array()
			),
		);
	}
}