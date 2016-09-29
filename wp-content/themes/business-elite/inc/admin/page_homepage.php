<?php
class WDWT_homepage_page_class{
	public $options;
	function __construct(){
		$first_post_wordpress=array();
		$post_in_array=get_posts( array('posts_per_page' => 1));
		if($post_in_array)
			$first_post_wordpress=array($post_in_array[0]->ID);
		else
			$first_post_wordpress=array();
		unset($post_in_array);	

		$this->options = array(
			/*------ TOP POSTS ------*/
			'top_posts_enable' => array(
				"name" => "top_posts_enable", 
				"title" => __("Top Posts", "business-elite"), 
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display the top posts on the homepage", "business-elite"), 
				'show' => array(
					'top_posts_title', 
					'top_posts_description', 
					'top_posts_categories', 
					'top_post_effect'
				),
				'hide' => array(),
				'section' => 'homepage_top_posts',
				'tab' => 'homepage', 
				'default' => true,
				'customizer'=>array()
			),
			'top_posts_title' => array( 
				"name" => "top_posts_title", 
				"title" => __("Top Posts Title", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "sanitize_text_field", 
				"description" => __("Write Title for Top Posts", "business-elite"),
				'section' => 'homepage_top_posts', 
				'tab' => 'homepage', 
				'default' => '',
				'customizer'=>array()
			),
			'top_posts_description' => array( 
				"name" => "top_posts_description", 
				"title" => __("Top Posts Description", "business-elite"), 
				'type' => 'textarea', 
				"sanitize_type" => "sanitize_footer_html_field", 
				"description" => __("Write Description for Top Posts", "business-elite"),
				'section' => 'homepage_top_posts', 
				'tab' => 'homepage', 
				'default' => '',
				'customizer'=>array()
			),
			"top_posts_categories" => array(
				"name" => "top_posts_categories",
				"title" => "",
				'type' => 'select',
				'multiple' => "true",
				"sanitize_type" => "sanitize_text_field",
				"valid_options" => $this->get_categories(),
				"description" => __("Filter posts only from these categories.", "business-elite"),
				'section' => 'homepage_top_posts',
				'tab' => 'homepage',
				'default' => array(''),
				'customizer'=>array()
			),
			"top_post_effect" => array(
				"name" => "top_post_effect",
				"title" => __("Select Effect", "business-elite"),
				'type' => 'select',
				"valid_options" => $this->select_for_effects(),
				'disabled' =>  $this->disabled_effects(),
				"description" => __("Select the effect. All effects are available in pro version.", "business-elite"),
				'section' => 'homepage_top_posts',
				'tab' => 'homepage',
				'default' => array('none'),
				'customizer'=>array()
			),
			/*------ CATEGORY TABS ------*/
			'category_tabs_enable' => array(
				"name" => "category_tabs_enable", 
				"title" => __("Category Tabs", "business-elite"),
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display the category tabs from the homepage.", "business-elite"),
				'show' => array('category_tabs_categories'),
				'hide' => array(),
				'section' => 'homepage_tabs',
				'tab' => 'homepage', 
				'default' => true,
				'customizer'=>array()
			),
			"category_tabs_categories" => array(
				"name" => "category_tabs_categories",
				"title" => "",
				'type' => 'select',
				'multiple' => "true",
				"sanitize_type" => "sanitize_text_field",
				"valid_options" => $this->get_categories(),
				"description" => __("Show posts from these categories.", "business-elite"),
				'section' => 'homepage_tabs',
				'tab' => 'homepage',
				'default' => $this->get_categories_ids(), // not filter, but show only these
				'customizer'=>array()
			),			
			/*------ FEATURED POST ------*/
			'featured_post_enable' => array(
				"name" => "featured_post_enable", 
				"title" => __("Featured Post", "business-elite"), 
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display the featured post from the homepage.", "business-elite"),
				'show' => array(
					'featured_bg_img', 
					'featured_posts', 
					'feautured_effect'
				),
				'hide' => array(),
				'section' => 'homepage_featured_post', 
				'tab' => 'homepage', 
				'default' => true,
				'customizer' => array()
			),
			'featured_bg_img' => array(
				'name' => 'featured_bg_img', 
				'title' => __("Featured Background Image", "business-elite"),
				'type' => 'upload_single', 
				"sanitize_type" => "esc_url_raw",
				'valid_options' => '',
				'description' => __("You can upload a custom image to be used as a background for the featured post.", "business-elite"),
				'section' => 'homepage_featured_post', 
				'tab' => 'homepage', 
				'default' => WDWT_IMG.'Featured_post.jpg',
				'customizer' => array()				
			),
			"featured_posts" => array(
				"name" => "featured_posts",
				"title" => __("Featured Post", "business-elite"), 
				'type' => 'select',
				"valid_options" => $this->get_posts(),
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Select the single post", "business-elite"),
				'section' => 'homepage_featured_post', 
				'tab' => 'homepage', 
				'default' => $first_post_wordpress,
				'customizer' => array()
			),
			"feautured_effect" => array(
				"name" => "feautured_effect",
				"title" => __("Select Effect", "business-elite"),
				'type' => 'select',
				"valid_options" => $this->select_for_effects(),
				'disabled' =>  $this->disabled_effects(),
				"description" => __("Select the effect. All effects are available in pro version.", "business-elite"),
				'section' => 'homepage_featured_post',
				'tab' => 'homepage',
				'default' => array('none'),
				'customizer'=>array()
			),				
			/*------ BLOG_CONTENT POSTS ------*/
			'content_posts_enable' => array(
				"name" => "content_posts_enable", 
				"title" => __("Content Posts", "business-elite"),
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display the content posts on the homepage", "business-elite"),
				'show' => array(
					'content_posts_title', 
					'content_posts_description', 
					'content_posts_categories',
					'content_posts_margin',
				),
				'hide' => array(),
				'section' => 'homepage_content_posts',
				'tab' => 'homepage', 
				'default' => true,
				'customizer'=>array()
			),
			'content_posts_title' => array( 
				"name" => "content_posts_title", 
				"title" => __("Content Posts Title", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "sanitize_footer_html_field",
				"description" => __("Write Title for Top Posts", "business-elite"),
				'section' => 'homepage_content_posts', 
				'tab' => 'homepage', 
				'default' => 'BLOG',
				'customizer'=>array()
			),
			'content_posts_description' => array( 
				"name" => "content_posts_description", 
				"title" => __("Content Posts Description", "business-elite"), 
				'type' => 'textarea', 
				"sanitize_type" => "sanitize_footer_html_field", 
				"description" => __("Write Description for Top Posts", "business-elite"),
				'section' => 'homepage_content_posts', 
				'tab' => 'homepage', 
				'default' => 'Lorem Ipsum is sample text',
				'customizer'=>array()
			),
			"content_posts_categories" => array(
				"name" => "content_posts_categories",
				"title" => "",
				'type' => 'select',
				'multiple' => "true",
				"sanitize_type" => "sanitize_text_field",
				"valid_options" => $this->get_categories(),
				"description" => __("Filter posts only from these categories.", "business-elite"),
				'section' => 'homepage_content_posts',
				'tab' => 'homepage',
				'default' => array(''),
				'customizer'=>array()
			),
			'content_posts_margin' => array(
				"name" => "content_posts_margin",
				"title" => __("Content Posts Margin", "business-elite"),
				'type' => 'number',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Margin of content posts blocks", "business-elite"),
				'section' => 'homepage_content_posts',
				'tab' => 'homepage',
				'default' => '0',
				'min' => '0',
				'max' => '120',
				'unit_symbol' => 'px',
				'input_size' => '2',
				'customizer' => array()
			),
			/*------ PORTFOLIO ------*/
			'portfolio_posts_enable' => array(
				"name" => "portfolio_posts_enable", 
				"title" => __("Portfolio", "business-elite"),
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display the portfolio on the homepage", "business-elite"), 
				'show' => array(
					'portfolio_posts_lightbox',
					'portfolio_title', 
					'portfolio_description', 
					'portfolio_categories', 
					'portfolio_effect'
				),
				'hide' => array(),
				'section' => 'homepage_portfolio',
				'tab' => 'homepage', 
				'default' => true,
				'customizer'=>array()
			),
			'portfolio_posts_lightbox' => array(
				"name" => "portfolio_posts_lightbox", 
				"title" => __("Lightbox", "business-elite"),
				'type' => 'radio', 
				'valid_options' => array(
					'lightbox' => __('Lightbox', "business-elite"),
					'link' => __('Link', "business-elite"),
				),
				"description" => __("Show lightbox or link to post", "business-elite"),
				'section' => 'homepage_portfolio',
				'tab' => 'homepage', 
				'default' => 'lightbox',
				'customizer'=>array()
			),
			'portfolio_title' => array( 
				"name" => "portfolio_title", 
				"title" => __("Portfolio Title", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "sanitize_footer_html_field", 
				"description" => __("Write Title for Top Posts", "business-elite"),
				'section' => 'homepage_portfolio', 
				'tab' => 'homepage', 
				'default' => 'PORTFOLIO',
				'customizer'=>array()
			),
			'portfolio_description' => array( 
				"name" => "portfolio_description", 
				"title" => __("Portfolio Description", "business-elite"), 
				'type' => 'textarea', 
				"sanitize_type" => "sanitize_footer_html_field", 
				"description" => __("Write Description for Top Posts", "business-elite"),
				'section' => 'homepage_portfolio', 
				'tab' => 'homepage', 
				'default' => 'Lorem Ipsum is sample text',
				'customizer'=>array()
			),
			"portfolio_categories" => array(
				"name" => "portfolio_categories",
				"title" => "",
				'type' => 'select',
				'multiple' => "true",
				"sanitize_type" => "sanitize_text_field",
				"valid_options" => $this->get_categories(),
				"description" => __("Filter posts only from these categories.", "business-elite"),
				'section' => 'homepage_portfolio',
				'tab' => 'homepage',
				'default' => array(''),
				'customizer'=>array()
			),
			"portfolio_effect" => array(
				"name" => "portfolio_effect",
				"title" => __("Select Effect", "business-elite"),
				'type' => 'select',
				"valid_options" => $this->select_for_effects(),
				'disabled' =>  $this->disabled_effects(),
				"description" => __("Select the effect. All effects are available in pro version.", "business-elite"),
				'section' => 'homepage_portfolio',
				'tab' => 'homepage',
				'default' => array('none'),
				'customizer'=>array()
			),
			/*------ CONTACT US ------*/
			'contact_us_enable' => array(
				"name" => "contact_us_enable", 
				"title" => __("Contact Us", "business-elite"), 
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display contact information and social links.", "business-elite"),
				'show' => array(
					'contact_us_bg',
					'contact_us_title',
					'contact_us_description',
					'contact_us_name',
					'contact_us_address',
					'contact_us_mail',
					'contact_effect'
				),
				'hide' => array(),
				'section' => 'homepage_contact', 
				'tab' => 'homepage', 
				'default' => true,
				'customizer' => array()
			),
			'contact_us_bg' => array(
				'name' => 'contact_us_bg', 
				'title' => __("Contact Background Image", "business-elite"),
				'type' => 'upload_single', 
				"sanitize_type" => "esc_url_raw",
				'valid_options' => '',
				'description' => __("You can upload a custom image to be used as a background for the contact us.", "business-elite"),
				'section' => 'homepage_contact', 
				'tab' => 'homepage', 
				'default' => WDWT_IMG.'Contact_us.jpg',
				'customizer' => array()				
			),
			'contact_us_title' => array( 
				"name" => "contact_us_title", 
				"title" => __("Contact Title", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "sanitize_footer_html_field", 
				"description" => __("Write Title for Contact", "business-elite"),
				'section' => 'homepage_contact', 
				'tab' => 'homepage', 
				'default' => 'CONTACT US',
				'customizer'=>array()
			),
			'contact_us_description' => array( 
				"name" => "contact_us_description", 
				"title" => __("Contact Us Description", "business-elite"), 
				'type' => 'textarea', 
				"sanitize_type" => "sanitize_footer_html_field", 
				"description" => __("Write Description for Contact", "business-elite"),
				'section' => 'homepage_contact', 
				'tab' => 'homepage', 
				'default' => 'Lorem Ipsum is sample text',
				'customizer'=>array()
			),
			'contact_us_name' => array( 
				"name" => "contact_us_name", 
				"title" => __("Contact us Name", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "sanitize_text_field", 
				"description" => __("Here you can write your Full Name", "business-elite"),
				'section' => 'homepage_contact', 
				'tab' => 'homepage', 
				'default' => 'Rick Ross',
				'customizer'=>array()
			),
			'contact_us_address' => array( 
				"name" => "contact_us_address", 
				"title" => __("Contact us Address", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "sanitize_text_field", 
				"description" => __("Here you can write your Address", "business-elite"),
				'section' => 'homepage_contact', 
				'tab' => 'homepage', 
				'default' => 'New York City',
				'customizer'=>array()
			),
			'contact_us_mail' => array( 
				"name" => "contact_us_mail", 
				"title" => __("Contact us email", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Here you can write your E-mail. Contact form is enabled only in PRO version.", "business-elite"),
				'section' => 'homepage_contact', 
				'tab' => 'homepage', 
				'default' => 'rock@info.com',
				'customizer'=>array()
			),
			"contact_effect" => array(
				"name" => "contact_effect",
				"title" =>  __("Select Effect", "business-elite"),
				'type' => 'select',
				"valid_options" => $this->select_for_effects(),
				'disabled' =>  $this->disabled_effects(),
				"description" => __("Select the effect. All effects are available in pro version.", "business-elite"),
				'section' => 'homepage_contact',
				'tab' => 'homepage',
				'default' => array('none'),
				'customizer'=>array()
			),		
			
			/*----- SHOW ICONS -----*/
			'twitter_enable' => array(
				"name" => "twitter_enable", 
				"title" => __("Twitter Icon", "business-elite"), 
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display Twitter icon.", "business-elite"),
				'show' => array('twitter_url'),
				'hide' => array(),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => false,
				'customizer' => array()
			),
			'twitter_url' => array( 
				"name" => "twitter_url", 
				"title" => __("Twitter URL", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "esc_url_raw", 
				"description" => __("Enter your Twitter Profile URL below.", "business-elite"),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => '',
				'customizer'=>array()
			),
			'facebook_enable' => array(
				"name" => "facebook_enable", 
				"title" => __("Facebook Icon", "business-elite"), 
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display Facebook icon.", "business-elite"),
				'show' => array('facebook_url'),
				'hide' => array(),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => false,
				'customizer' => array()
			),
			'facebook_url' => array( 
				"name" => "facebook_url", 
				"title" => __("Facebook URL", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "esc_url_raw",
				"description" => __("Enter your Facebook Profile URL below.", "business-elite"),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => '',
				'customizer'=>array()
			),
			'rss_enable' => array(
				"name" => "rss_enable", 
				"title" => __("RSS Icon", "business-elite"), 
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display RSS icon.", "business-elite"),
				'show' => array('rss_url'),
				'hide' => array(),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => false,
				'customizer' => array()
			),
			'rss_url' => array( 
				"name" => "rss_url", 
				"title" => __("RSS URL", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "esc_url_raw",
				"description" => __("Enter your RSS Profile URL below.", "business-elite"),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => '',
				'customizer'=>array()
			),
			'youtube_enable' => array(
				"name" => "youtube_enable", 
				"title" => __("Youtube Icon", "business-elite"), 
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display Youtube icon.", "business-elite"),
				'show' => array('youtube_url'),
				'hide' => array(),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => false,
				'customizer' => array()
			),
			'youtube_url' => array( 
				"name" => "youtube_url", 
				"title" => __("Youtube URL", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "esc_url_raw", 
				"description" => __("Enter your Youtube Profile URL below.", "business-elite"),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => '',
				'customizer'=>array()
			),
			'googlep_enable' => array(
				"name" => "googlep_enable", 
				"title" => __("Google+ Icon", "business-elite"), 
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display Google+ icon.", "business-elite"),
				'show' => array('googlep_url'),
				'hide' => array(),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => false,
				'customizer' => array()
			),
			'googlep_url' => array( 
				"name" => "googlep_url", 
				"title" => __("Google+ URL", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "esc_url_raw",
				"description" => __("Enter your Google+ Profile URL below.", "business-elite"),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => '',
				'customizer'=>array()
			),
			'instagram_enable' => array(
				"name" => "instagram_enable", 
				"title" => __("Instagram Icon", "business-elite"), 
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display Instagram icon.", "business-elite"),
				'show' => array('instagram_url'),
				'hide' => array(),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => false,
				'customizer' => array()
			),
			'instagram_url' => array( 
				"name" => "instagram_url", 
				"title" => __("Instagram URL", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "esc_url_raw", 
				"description" => __("Enter your Instagram Profile URL below.", "business-elite"),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => '',
				'customizer'=>array()
			),
			'linkedin_enable' => array(
				"name" => "linkedin_enable", 
				"title" => __("Linkedin Icon", "business-elite"), 
				'type' => 'checkbox_open', 
				"description" => __("Check the box to display Linkedin icon.", "business-elite"),
				'show' => array('linkedin_url'),
				'hide' => array(),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => false,
				'customizer' => array()
			),
			'linkedin_url' => array( 
				"name" => "linkedin_url", 
				"title" => __("Linkedin URL", "business-elite"),
				'type' => 'text', 
				"sanitize_type" => "esc_url_raw", 
				"description" => __("Enter your Linkedin Profile URL below.", "business-elite"),
				'section' => 'homepage_links', 
				'tab' => 'homepage', 
				'default' => '',
				'customizer'=>array()
			)
		);
	}
	private function get_posts(){
		$args= array(
				'posts_per_page'   => 3000,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				 );

		$posts_array_custom=array();
		$posts_array = get_posts( $args );

		foreach($posts_array as $post){
			$key = $post->ID;
		  $posts_array_custom[$key] = $post->post_title;
		}
    if(empty($posts_array_custom)){
      $posts_array_custom = array('');
    }
		return $posts_array_custom;
	}

	private function get_categories(){
		$args= array(
				'hide_empty' => 0,
				'orderby' => 'name',
				'order' => 'ASC',
			);
		
		$categories_array_custom=array();
		$categories_array = get_categories( $args );
		
		foreach($categories_array as $category){
		  $categories_array_custom[$category->term_id] = $category->name;
		}
    if(empty($categories_array_custom)){
      $categories_array_custom = array('');
    }
		return $categories_array_custom;
	}

	private function get_categories_ids(){
		$args= array(
				'hide_empty' => 0,
				'orderby' => 'name',
				'order' => 'ASC',
			);
		
		$categories_array_custom=array();
		$categories_array = get_categories( $args );
		foreach($categories_array as $category){
		  array_push($categories_array_custom,$category->term_id);
		}
		return $categories_array_custom;
	}

	private function select_for_effects(){
		$block_effects_in = array(
			'none' => 'None',
			'bounce' => 'Bounce',
			'flash' => 'Flash',
			'pulse' => 'Pulse',
			'rubberBand' => 'RubberBand',
			'shake' => 'Shake',
			'swing' => 'Swing',
			'tada' => 'Tada',
			'wobble' => 'Wobble',
			'hinge' => 'Hinge',
			'lightSpeedIn' => 'LightSpeedIn',
			'rollIn' => 'RollIn',
			'bounceIn' => 'BounceIn',
			'bounceInDown' => 'BounceInDown',
			'bounceInLeft' => 'BounceInLeft',
			'bounceInRight' => 'BounceInRight',
			'bounceInUp' => 'BounceInUp',
			'fadeIn' => 'FadeIn',
			'fadeInDown' => 'FadeInDown',
			'fadeInDownBig' => 'FadeInDownBig',
			'fadeInLeft' => 'FadeInLeft',
			'fadeInLeftBig' => 'FadeInLeftBig',
			'fadeInRight' => 'FadeInRight',
			'fadeInRightBig' => 'FadeInRightBig',
			'fadeInUp' => 'FadeInUp',
			'fadeInUpBig' => 'FadeInUpBig',
			'flip' => 'Flip',
			'flipInX' => 'FlipInX',
			'flipInY' => 'FlipInY',
			'rotateIn' => 'RotateIn',
			'rotateInDownLeft' => 'RotateInDownLeft',
			'rotateInDownRight' => 'RotateInDownRight',
			'rotateInUpLeft' => 'RotateInUpLeft',
			'rotateInUpRight' => 'RotateInUpRight',
			'zoomIn' => 'ZoomIn',
			'zoomInDown' => 'ZoomInDown',
			'zoomInLeft' => 'ZoomInLeft',
			'zoomInRight' => 'ZoomInRight',
			'zoomInUp' => 'ZoomInUp',       
		); 
		return $block_effects_in;
	}


	private function disabled_effects(){
		$top_effects = $this->select_for_effects();

		$disabled = array();
		foreach ($top_effects as $key => $value) {
			if($key != 'none'){
				array_push($disabled, $key);
			}
		}

		return $disabled;

	}
}