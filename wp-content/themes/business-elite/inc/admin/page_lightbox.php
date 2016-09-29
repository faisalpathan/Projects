<?php
class WDWT_lightbox_page_class{
  public $options;
 
  function __construct(){
    $this->options = array(
      'lbox_disable' => array( 
        "name" => "lbox_disable", 
        "title" => __("Disable lightbox", "business-elite"), 
        'type' => 'checkbox',
        "description" => __("Disable lightbox", "business-elite"), 
        'section' => 'lightbox', 
        'tab' => 'lightbox',
        'default' => false ,
        'customizer' => array()     
      ),
			'lbox_slideshow_interval' => array(
				"name" => "lbox_slideshow_interval",
				"title" => __("Slideshow interval.", "business-elite"),
				'type' => 'number',
				'input_size' => '3',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Interval of slideshow in seconds.", "business-elite"),
				'min' => '1',
				'step' => '0.1',
				'section' => 'lightbox',
				'tab' => 'lightbox',
				'default' => 5,
				'customizer' => array()
			),
			'lbox_image_width' => array(
				"name" => "lbox_image_width",
				"title" => __("Lightbox width.", "business-elite"),
				'type' => 'number',
				'input_size' => '4',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Lightbox width.", "business-elite"),
				'section' => 'lightbox',
				'tab' => 'lightbox',
				'min' => '320',
				'max' => '1200',
				'default' => 600,
				'customizer' => array()
			),
			'lbox_image_height' => array(
				"name" => "lbox_image_height",
				"title" => __("Lightbox height.", "business-elite"),
				'type' => 'number',
				'input_size' => '4',
				"sanitize_type" => "sanitize_text_field",
				"description" => __("Lightbox height.", "business-elite"),
				'section' => 'lightbox',
				'tab' => 'lightbox',
				'min' => '240',
				'max' => '1200',
				'default' => 400,
				'customizer' => array()
			));
    
      $this->options["lbox_image_effect"] = array(
        "name" => "lbox_image_effect",
        "title" => __("Lightbox transition effect", "business-elite"), 
        'type' => 'select',
        "valid_options" => array(
			'none'=>'None',
			'cubeH'=> 'Cube Horizontal',
			'cubeV' => 'Cube Vertical',
			'fade' => 'Fade',
			'sliceH' => 'Slice Horizontal',
			'sliceV' => 'Slice Vertical',
			'slideH' => 'Slide Horizontal',
			'slideV' => 'Slide Vertical',
			'scaleOut' => 'Scale Out',
			'scaleIn' => 'Scale In',
			'blockScale' => 'Block Scale',
			'kaleidoscope' => 'Kaleidoscope',
			'fan' => 'Fan',
			'blindH' => 'Blind Horizontal',
			'blindV' => 'Blind Vertical',
			'random' => 'Random',
          ),
        'disabled'=> array('cubeH','cubeV', 'sliceH', 'sliceV', 'slideH', 'slideV', 'scaleOut', 'scaleIn', 'blockScale', 'kaleidoscope' , 'fan', 'blindH', 'blindV', 'random'),
        "sanitize_type" => "sanitize_text_field",
        "description" => __("Lightbox transition effect", "business-elite" ),
        'section' => 'lightbox', 
        'tab' => 'lightbox', 
        'default' => array('fade'),
        'customizer' => array()
      );
  $this->options['lbox_enable_image_fullscreen'] = array(
		'name' => 'lbox_enable_image_fullscreen', 
		'title' =>  __( 'Enable fullscreen buttons', "business-elite" ), 
		'type' => 'checkbox', 
		'description' => '', 
		'section' => 'lightbox',  
		'tab' => 'lightbox', 
		'default' => true,
		'customizer' => array()          
	); 
	$this->options['lbox_open_with_fullscreen'] = array(
		'name' => 'lbox_open_with_fullscreen', 
		'title' =>  __( 'Open lightbox with fullscreen.', "business-elite" ), 
		'type' => 'checkbox', 
		'description' => '', 
		'section' => 'lightbox',  
		'tab' => 'lightbox', 
		'default' => false,
		'customizer' => array()
	);
	$this->options['lbox_enable_image_ctrl_btn'] = array(
		'name' => 'lbox_enable_image_ctrl_btn', 
		'title' =>  __( 'Enable play and pause buttons.', "business-elite" ), 
		'type' => 'checkbox', 
		'description' => '', 
		'section' => 'lightbox',  
		'tab' => 'lightbox', 
		'default' => true,
		'customizer' => array()
	);
	$this->options['lbox_open_with_autoplay'] = array(
		'name' => 'lbox_open_with_autoplay', 
		'title' =>  __( 'Open with autoplay.', "business-elite" ), 
		'type' => 'checkbox', 
		'description' => '', 
		'section' => 'lightbox',  
		'tab' => 'lightbox', 
		'default' => false,
		'customizer' => array()
	);
	$this->options['lbox_popup_enable_info'] = array(
		'name' => 'lbox_popup_enable_info', 
		'title' =>  __( 'Enable info in lightbox.', "business-elite" ), 
		'type' => 'checkbox_open', 
		'description' => __( 'Add post title and excerpt as image info in lightbox.', "business-elite" ), 
		'section' => 'lightbox',
		'show'=>array('lbox_popup_info_always_show', 'lbox_popup_info_full_width', 'lbox_info_position'),  
		'hide'=>array(),
		'tab' => 'lightbox', 
		'default' => true,
		'customizer' => array()
	);
    $this->options['lbox_popup_info_always_show'] = array(
        'name' => 'lbox_popup_info_always_show', 
        'title' =>  __( 'Always show info in lightbox.', "business-elite" ), 
        'type' => 'checkbox', 
        'description' => '', 
        'section' => 'lightbox',  
        'tab' => 'lightbox', 
        'default' => false,
        'customizer' => array()
    );
    $this->options['lbox_popup_info_full_width'] = array(
        'name' => 'lbox_popup_info_full_width', 
        'title' =>  __( 'Full-width info in lightbox.', "business-elite" ), 
        'type' => 'checkbox', 
        'description' => '', 
        'section' => 'lightbox',  
        'tab' => 'lightbox', 
        'default' => false,
        'customizer' => array()
    );
    $this->options["lbox_info_position"] = array(
        "name" => "lbox_info_position",
        "title" => __("Image info position", "business-elite" ),
        'type' => 'select',
        "description" => "",
        "valid_options" => array(
          "left-top" => "left-top",
          "left-middle"  =>  "left-middle",
          "left-bottom"  =>  "left-bottom",
          "center-top"  =>  "center-top",
          "center-middle"  =>  "center-middle",
          "center-bottom"  =>  "center-bottom",
          "right-top"  =>  "right-top",
          "right-middle"  =>  "right-middle",
          "right-bottom"  =>  "right-bottom"   
        ),
        'section' => 'lightbox',
        'tab' => 'lightbox',
        'default' => array('right-top'),
        'customizer' => array() 
    );
  }
}
/*
not needed params
params
    $slideshow_interval = (isset($_GET['slideshow_interval']) ? (int) $_GET['slideshow_interval'] : 5);
  
    $image_width = (isset($_GET['image_width']) ? esc_html($_GET['image_width']) : 800);
    $image_height = (isset($_GET['image_height']) ? esc_html($_GET['image_height']) : 500);
    $image_effect = ((isset($_GET['image_effect']) && esc_html($_GET['image_effect'])) ? esc_html($_GET['image_effect']) : 'fade');

    $enable_image_fullscreen = (isset($_GET['enable_image_fullscreen']) ? esc_html($_GET['enable_image_fullscreen']) : 0);
    $open_with_fullscreen = (isset($_GET['open_with_fullscreen']) ? esc_html($_GET['open_with_fullscreen']) : 0);

    $enable_image_ctrl_btn = (isset($_GET['enable_image_ctrl_btn']) ? esc_html($_GET['enable_image_ctrl_btn']) : 0);
    $open_with_autoplay = (isset($_GET['open_with_autoplay']) ? esc_html($_GET['open_with_autoplay']) : 0);
	
    $current_image_id = (isset($_GET['image_id']) ? esc_html($_GET['image_id']) : 0);
    $theme_id = (isset($_GET['theme_id']) ? esc_html($_GET['theme_id']) : 1);

	$theme_row = $this->model->get_theme_row_data($theme_id);

    $option_row = $this->model->get_option_row_data();
    $image_rows = $this->model->get_image_rows_data_tag($tag_id, $sort_by, $order_by);
    $image_id = (isset($_POST['image_id']) ? (int) $_POST['image_id'] : $current_image_id);

    $params_array = array(
      'action' => 'GalleryBox',
      'image_id' => $current_image_id,
      'gallery_id' => $gallery_id,
      'theme_id' => $theme_id,
      'thumb_width' => $thumb_width,
      'thumb_height' => $thumb_height,
      'open_with_fullscreen' => $open_with_fullscreen,
      'image_width' => $image_width,
      'image_height' => $image_height,
      'image_effect' => $image_effect,
      'wd_sor' => $sort_by,
      'wd_ord' => $order_by,
      'enable_image_filmstrip' => $enable_image_filmstrip,
      'image_filmstrip_height' => $image_filmstrip_height,
      'enable_image_ctrl_btn' => $enable_image_ctrl_btn,
      'enable_image_fullscreen' => $enable_image_fullscreen,
      'popup_enable_info' => $popup_enable_info,
      'popup_info_always_show' => $popup_info_always_show,
	  'popup_info_full_width' => $popup_info_full_width,
      'popup_hit_counter' => $popup_hit_counter,
      'popup_enable_rate' => $popup_enable_rate,
      'slideshow_interval' => $slideshow_interval,
      'enable_comment_social' => $enable_comment_social,
      'enable_image_facebook' => $enable_image_facebook,
      'enable_image_twitter' => $enable_image_twitter,
      'enable_image_google' => $enable_image_google,
      'enable_image_pinterest' => $enable_image_pinterest,
      'enable_image_tumblr' => $enable_image_tumblr,
      'watermark_type' => $watermark_type,
      'current_url' => $current_url
    );
    
    $filmstrip_thumb_margin_hor = $filmstrip_thumb_margin_right + $filmstrip_thumb_margin_left;
    $rgb_wdwt_image_info_bg_color = WDWLibrary::spider_hex2rgb($theme_row->lightbox_info_bg_color);

    $rgb_lightbox_ctrl_cont_bg_color = WDWLibrary::spider_hex2rgb($theme_row->lightbox_ctrl_cont_bg_color);
*/