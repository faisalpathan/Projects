<?php
class WDWT_general_settings_page_class {
	public $options;
		function __construct(){
		$this->options = array( 
			
			/*--- CUSTOM CSS ---*/
			'custom_css_enable' => array( 
				'name' => 'custom_css_enable', 
				'title' => __( 'Custom CSS', "business-elite" ), 
				'type' => 'checkbox_open', 
				'description' => __('Custom CSS will change the visual style of the website. The CSS code provided here can be applied to any page or post.',"business-elite"), 
				'show' => array('custom_css_text'),
				'hide' => array(),
				'section' => 'general_main', 
				'tab' => 'general', 
				'default' => false,
				'customizer' => array()
			),
			'custom_css_text' => array( 
				'name' => 'custom_css_text', 
				'title' => '', 
				'type' => 'textarea', 
				'sanitize_type' => 'css', 
				'description' => __('Provide the custom CSS code below.', "business-elite"), 
				'section' => 'general_main',  
				'tab' => 'general', 
				'default' => '',
				'customizer' => array()      
			),			
			
					
			/*--- BLOG STYLE ---*/
			'blog_style' => array(
				'name' => 'blog_style', 
				'title' =>  __( 'Blog Style post format', "business-elite" ), 
				'type' => 'checkbox', 
				'description' => __('Check the box to have short previews for the homepage/index posts.', "business-elite"), 
				'section' => 'general_main', 
				'tab' => 'general', 
				'default' => true,
				'customizer' => array()           
			), 	
			/*--- GRAB IMAGE ---*/
			'grab_image' => array(
				'name' => 'grab_image',
				'title' =>  __( 'Grab the first post image', "business-elite" ),
				'type' => 'checkbox',
				'description' => __('Enable this option if you want to use the images that are already in your post to create a thumbnail without using custom fields. In this case thumbnail images will be generated automatically using the first image of the post. Note that the image needs to be hosted on your own server.', "business-elite"), 
				'section' => 'general_main',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()
			),  		
				
			/*--- DATE ---*/
			'date_enable' => array(
				"name" => "date_enable",
				"title" => __( 'Display post meta information', "business-elite" ),
				'type' => 'checkbox',
				"description" =>  __('Choose whether to display the post meta information such as date, author and etc.', "business-elite"),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()
			),	
			/*--- Headings ---*/
			'single_title_bg' => array(
				"name" => "single_title_bg",
				"title" => __( 'Heading background', "business-elite" ),
				'type' => 'checkbox',
				"description" =>  __('Enable colorful background of the main heading in page content', "business-elite"),
				'section' => 'general_main',
				'tab' => 'general',
				'default' => true,
				'customizer' => array()
			),			

			/*--- FOOTER ---*/
			'footer_text_enable' => array(
				"name" => "footer_text_enable", 
				"title" => __( 'Information in the Footer', "business-elite"),
				'type' => 'checkbox_open', 
				"description" => __('Check the box to display custom HTML for the footer.', "business-elite"),
				'section' => 'general_main',  
				'show' => array('footer_text'),
				'hide' => array(),
				'tab' => 'general', 
				'default' => true,
				'customizer' => array()  
			),
			'footer_text' => array( 
				"name" => "footer_text", 
				"title" => __( 'Information in the Footer', "business-elite"),
				'type' => 'textarea', 
				"sanitize_type" => "sanitize_footer_html_field", 
				'width' => '450',
				'height'=> '200',
				"description" => __('Here you can provide the HTML code to be inserted in the footer of your web site.', "business-elite"),
				'section' => 'general_main', 
				'tab' => 'general', 
				'default' => 'WordPress Themes by <a href="'.WDWT_HOMEPAGE.'" target="_blank" title="Web-Dorado">Web-Dorado</a>',
				'customizer' => array()  
			),
			/*--- FIX MENU ---*/
			'fixed_menu' => array(
				'name' => 'fixed_menu', 
				'title' =>  __( 'Fix menu', "business-elite" ), 
				'type' => 'checkbox', 
				'description' => __('Check the box to fix menu.', "business-elite"), 
				'section' => 'general_header', 
				'tab' => 'general', 
				'default' => true,
				'customizer' => array()
			),
			'menu_section_width' => array(
				"name" => "menu_section_width",
				"title" => __("Menu Width", "business-elite"),
				'type' => 'number',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Menu width as a percentage of total header container width. The rest is logo section width.", "business-elite"),
				'section' => 'general_header',
				'tab' => 'general',
				'min' => '30',
				'max' => '100',
				'default' => '80',
				'unit_symbol' => '%',
				'input_size' => '2',
				'customizer' => array()
			),
			/*--- LOGO ---*/	
			'logo_type' => array(
				"name" => "logo_type", 
				"title" => __("Logo type", "business-elite"), 
				'type' => 'radio_open', 
				"description" => "", 
				'valid_options' => array(
					'none' => 'None',
					'image' => 'Image',
					'text' => 'Text'
				),
				'show' => array('image'=>'logo_img', 'text' => 'logo_text'),
				'hide' => array(),
				'section' => 'general_header', 
				'tab' => 'general', 
				'default' => 'text',
				'customizer' => array()  
			),
			'logo_img' => array(
				'name' => 'logo_img', 
				'title' => __( 'Logo', "business-elite" ), 
				"sanitize_type" => "esc_url_raw",
				'type' => 'upload_single', 
				'description' => __('Upload custom logo image.',"business-elite"), 
				'section' => 'general_header',  
				'tab' => 'general', 
				'default' => '',
				'customizer' => array()           
			),
			'logo_text' => array( 
				"name" => "logo_text", 
				"title" => __("Logo Text", "business-elite"), 
				'type' => 'textarea', 
				"sanitize_type" => "sanitize_text_field", 
				"description" => __("Provide with a custom text", "business-elite"),
				'section' => 'general_header',  
				'tab' => 'general', 
				'default' => 'Business' ,
				'customizer' => array()  
			),
			
		);
	

	}
}