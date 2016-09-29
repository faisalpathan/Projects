<?php
class WDWT_slider_page_class{
	public $options;	

	function __construct(){
		$this->options = array(
			'hide_slider' => array( 
				'name' => 'hide_slider', 
				'title' => __( 'Specify where slider should be shown.', "business-elite" ), 
				'type' => 'select', 
				'valid_options' => array(
					"Only on Homepage" => __("Only on homepage", "business-elite"),
					"Only on Front Page" => __("Only on front page", "business-elite" ),
					"On all the pages and posts" => __("On all the pages and posts", "business-elite"),
					"Hide Slider" => __("Hide Slider", "business-elite"),
				), 
				'description' => __('Tip: set "Only on front page" if front page displays "a static page".', "business-elite"), 
				'section' => 'slider_main', 
				'tab' => 'slider', 
				'default' => array('Only on Homepage'),
				'customizer' => array()
			),
			'disable_slider_on_mobile' => array( 
				'name' => 'disable_slider_on_mobile', 
				'title' => __( 'Disable slider on mobile.', "business-elite" ), 
				'type' => 'checkbox', 
				'description' => __('Disable slider on mobile.', "business-elite"), 
				'section' => 'slider_main', 
				'tab' => 'slider', 
				'default' => false,
				'customizer' => array()
			),
			"image_height" => array(
				"name" => "image_height",
				"title" => __("Slider Height", "business-elite"),
				'type' => 'number',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Slider with the width of 1024px will have this height. When resized, image dimensions ratio is preserved.", "business-elite"),
				'section' => 'slider_main',
				'min' => '240',
				'max' => '1200',
				'unit_symbol' => 'px',
				'tab' => 'slider',
				'default' => '780',
				'customizer' => array()
			),
			"animation_speed" => array(
				"name" => "animation_speed",
				"title" => __("Animation Speed", "business-elite"),
				'type' => 'number',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("When using an animation for the slider, you can control its speed. You can use the provided box to fill in the optimal speed.", "business-elite"),
				'section' => 'slider_main',
				'tab' => 'slider',
				'unit_symbol' => 'msec',
				'min' => '200',
				'max' => '10000',
				'step' => '50',
				'default' => '800',
				'customizer' => array()
			),
			"slideshow_interval" => array(
				"name" => "slideshow_interval",
				"title" => __("Pause Time", "business-elite"),
				'type' => 'number',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("The timing for the slider animation can be customized. You can adjust it providing timing in the corresponding box.", "business-elite"),
				'section' => 'slider_main',
				'unit_symbol' => 'msec',
				'tab' => 'slider',
				'min' => '1000',
				'max' => '100000',
				'step' => '50',
				'default' => '5000',
				'customizer' => array()
			),
			"stop_on_hover" => array(
				"name" => "stop_on_hover",
				"title" => __("Stop animation while hovering", "business-elite" ),
				'type' => 'checkbox',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("By default slider animation is constant. However you can choose it to stop while hovering, checking the box for this option.", "business-elite"),
				'section' => 'slider_main',
				'tab' => 'slider',
				'default' => false,
				'customizer' => array()      
			)
		);	
		
		
			$this->options["effect"] = array(
				"name" => "effect",
				"title" => __("Effect", "business-elite" ),
				'type' => 'select',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("The animation of the slider can be customized with the help of various effects. You can choose the slider animation effect from the list included below.", "business-elite"),
				"valid_options" => array(
					"none" => "None",
					"cubeH"  =>  "Cube Horizontal",
					"cubeV"  =>  "Cube Vertical",
					"fade"  =>  "Fade",
					"sliceH"  =>  "Slice Horizontal",
					"sliceV"  =>  "Slice Vertical",
					"slideH"  =>  "Slide Horizontal",
					"slideV"  =>  "Slide Vertical",
					"scaleOut"  =>  "Scale Out",
					"scaleIn"  =>  "Scale In",
					"blockScale"  =>  "Block Scale",
					"kaleidoscope"  =>  "Kaleidoscope",
					"fan"  =>  "Fan",
					"blindH"  =>  "Blind Horizontal",
					"blindV"  =>  "Blind Vertical",
					"random"  =>  "Random",
				),
				'disabled'=> array("cubeH", "cubeV", "sliceH", "sliceV","slideH", "slideV", "scaleOut", "scaleIn", "blockScale", "kaleidoscope", "fan", "blindH", "blindV",  "random" ),
				'section' => 'slider_main',
				'tab' => 'slider',
				'default' => array('fade'),
				'customizer' => array() 
			);
		
		$this->options["title_position"] = array(
			"name" => "title_position",
			"title" => __("Title Position", "business-elite" ),
			'type' => 'select',
			"sanitize_type" => "sanitize_text_field",
			"description" => "",
			"valid_options" => array(
			  "left-top" 	  => "left-top",
			  "left-middle"   => "left-middle",
			  "left-bottom"   => "left-bottom",
			  "center-top"    => "center-top",
			  "center-middle" => "center-middle",
			  "center-bottom" => "center-bottom",
			  "right-top"     => "right-top",
			  "right-middle"  => "right-middle",
			  "right-bottom"  => "right-bottom"   
			),
			'section' => 'slider_main',
			'tab' => 'slider',
			'default' => array('center-top'),
			'customizer' => array() 
		);
		$this->options["description_position"] = array(
			"name" => "description_position",
			"title" => __("Description Position", "business-elite" ),
			'type' => 'select',
			"sanitize_type" => "sanitize_text_field",
			"description" => "",
			"valid_options" => array(
			  "left-top" 	  => "left-top",
			  "left-middle"   => "left-middle",
			  "left-bottom"   => "left-bottom",
			  "center-top"    => "center-top",
			  "center-middle" => "center-middle",
			  "center-bottom" => "center-bottom",
			  "right-top"  	  => "right-top",
			  "right-middle"  => "right-middle",
			  "right-bottom"  => "right-bottom"  
			),
			'section' => 'slider_main',
			'tab' => 'slider',
			'default' => array('center-middle'),
			'customizer' => array() 
		);
		$this->options["slider_head"] = array(
			"name" => "slider_head",
			"title" => "",
			'type' => 'upload_multiple',
			"sanitize_type" => "esc_url_raw",
			"option" => array(
				"imgs_href" => "slider_head_href",
				"imgs_title" =>  "slider_head_title",
				"imgs_description" => "slider_head_desc"
			),
			"description" => "",
			'section' => 'slider_imgs',
			'tab' => 'slider',
			'default' =>  WDWT_IMG."slide_1.jpg" . $this->get_delimiter(). WDWT_IMG."slide_2.jpg",
 			'customizer' => array()
		);
		$this->options["slider_head_href"] = array(
			"name" => "slider_head_href",
			"title" => "",
			'type' => 'text_slider',
			"sanitize_type" => "esc_url_raw",
			"description" => "",
			'section' => 'slider_imgs',
			'tab' => 'slider',
			'default' => $this->get_delimiter(),
			'customizer' => array()     
		);
		$this->options["slider_head_title"] = array(
			"name" => "slider_head_title",
			"title" => "",
			'type' => 'text_slider',
			"sanitize_type" => "sanitize_text_field",
			"description" => "",
			'section' => 'slider_imgs',
			'tab' => 'slider',
			'default' => $this->get_delimiter(),
			'customizer' => array()    
		);
		$this->options["slider_head_desc"] = array(
			"name" => "slider_head_desc",
			"title" => "",
			'type' => 'textarea_slider',
			"sanitize_type" => "sanitize_html_field",
			"description" => "",
			'section' => 'slider_imgs',
			'tab' => 'slider',
			'default' =>"<h1>Start Your Business Elite</h1><p>Responsive, stylish, user-friendly and SEO-friendly theme. Simple, clean flat design. Wide list of customizable features.</p> <span class='business_elite btn_trans'><a href='#'>Join Now</a></span>".
									$this->get_delimiter().
									"<h1>Start Your Business Elite</h1><p>Responsive, stylish, user-friendly and SEO-friendly theme. Simple, clean flat design. Wide list of customizable features.</p><span class='business_elite btn_trans'><a href='#'>Join Now</a></span>",
			'customizer' => array()   
		);
	}

	private function get_delimiter(){
		return "||wd||";
	}
}
