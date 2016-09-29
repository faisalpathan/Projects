<?php 
require_once ('WDWT_updater.php');

class Business_elite_updater extends WDWT_updater{
  /*first version with settings API*/
  protected $version_set_api = '1.0.50';  
  protected $old_meta_name = 'web_dorado_meta_date';
  
  protected $theme_mods_name = 'theme_mods_business-elite';

  /**
    * rules for converting old param to new
    *
    * keep order from old to new
    * 
    * start from $version_set_api
    * @param types: get_param_with_old_name, get_old_colors, checkbox_to_select, option_change, widget name change, slider
  */
  protected $rules = array(
  '1.0.50' => array(
    /*Layout*/
    array('old'=> "gs_default_layout", 'new'=>'default_layout' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "gs_full_width", 'new'=>'full_width' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "gs_content_area", 'new'=>'content_area' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "gs_main_column", 'new'=>'main_column' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "gs_pwa_width", 'new'=>'pwa_width' , 'type'=>'get_param_with_old_name' ),   
    /*SEO*/
    array('old'=> "seo_seo_home_title", 'new'=>'seo_home_title' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "seo_seo_home_description", 'new'=>'seo_home_description' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "seo_seo_home_keywords", 'new'=>'seo_home_keywords' , 'type'=>'get_param_with_old_name' ),    
    array('old'=> "seo_seo_home_titletext", 'new'=>'seo_home_titletext' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "seo_seo_home_descriptiontext", 'new'=>'seo_home_descriptiontext' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "seo_seo_home_keywordstext", 'new'=>'seo_home_keywordstext' , 'type'=>'get_param_with_old_name' ),    
    array('old'=> "seo_seo_home_type", 'new'=>'seo_home_type' , 'type'=>'select_to_select_array' ),
    array('old'=> "seo_seo_home_separate", 'new'=>'seo_home_separate' , 'type'=>'get_param_with_old_name' ),    
    array('old'=> "seo_seo_single_title", 'new'=>'seo_single_title' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "seo_seo_single_description", 'new'=>'seo_single_description' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "seo_seo_single_keywords", 'new'=>'seo_single_keywords' , 'type'=>'get_param_with_old_name' ),    
    array('old'=> "seo_seo_single_type", 'new'=>'seo_single_type' , 'type'=>'select_to_select_array' ), 
    array('old'=> "seo_seo_single_separate", 'new'=>'seo_single_separate' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "seo_seo_index_description", 'new'=>'seo_index_description' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "seo_seo_index_type", 'new'=>'seo_index_type' , 'type'=>'select_to_select_array' ),
    array('old'=> "seo_seo_index_separate", 'new'=>'seo_index_separate' , 'type'=>'get_param_with_old_name' ),
    /*General*/
    array('old'=> "_fixed_menu", 'new'=>'fixed_menu' , 'type'=>'get_param_with_old_name' ), 
    array('old'=> "_logo_img", 'new'=>'logo_img' , 'type'=>'get_param_with_old_name' ), 
    array('old'=> "_custom_css_enable", 'new'=>'custom_css_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_custom_css_text", 'new'=>'custom_css_text' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_hide_favicon", 'new'=>'favicon_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_favicon_img", 'new'=>'favicon_img' , 'type'=>'get_param_with_old_name' ),   
    array('old'=> "_blog_style", 'new'=>'blog_style' , 'type'=>'get_param_with_old_name' ),     
    array('old'=> "_grab_image", 'new'=>'grab_image' , 'type'=>'get_param_with_old_name' ),     
    array('old'=> "_date_enable", 'new'=>'date_enable' , 'type'=>'get_param_with_old_name' ),   
    array('old'=> "_footer_text_enable", 'new'=>'footer_text_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_footer_text", 'new'=>'footer_text' , 'type'=>'get_param_with_old_name' ),
    /*Integration*/
    array('old'=> "int_integrate_header_enable", 'new'=>'integrate_header_enable' , 'type'=>'get_param_with_old_name' ),    
    array('old'=> "int_integration_head", 'new'=>'integration_head' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "int_integrate_body_enable", 'new'=>'integrate_body_enable' , 'type'=>'get_param_with_old_name' ),    
    array('old'=> "int_integration_body", 'new'=>'integration_body' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "int_integrate_singletop_enable", 'new'=>'integrate_singletop_enable' , 'type'=>'get_param_with_old_name' ),    
    array('old'=> "int_integration_single_top", 'new'=>'integration_single_top' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "int_integrate_singlebottom_enable", 'new'=>'integrate_singlebottom_enable' , 'type'=>'get_param_with_old_name' ),    
    array('old'=> "int_integration_single_bottom", 'new'=>'integration_single_bottom' , 'type'=>'get_param_with_old_name' ),
    /*--
    array('old'=> "int_integration_head_adsense_hide", 'new'=>'int_integration_head_adsense_type' , 'type'=>'checkbox_add_to_radio', 'args' => array('value' => 'none','option_type'=>'mods') ),    
    array('old'=> "int_integration_head_adsense_type", 'new'=>'integration_head_adsense_type' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "int_integration_head_adsense", 'new'=>'integration_head_adsense' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "int_integration_head_advertisment_picture", 'new'=>'integration_head_advertisment_picture' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "int_integration_head_advertisment_url", 'new'=>'integration_head_advertisment_url' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "int_integration_head_advertisment_title", 'new'=>'integration_head_advertisment_title' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "int_integration_head_advertisment_alt", 'new'=>'integration_head_advertisment_alt' , 'type'=>'get_param_with_old_name' ),
    */
    array('old'=> "int_integration_bottom_adsense_hide", 'new'=>'int_integration_bottom_adsense_type' , 'type'=>'checkbox_add_to_radio', 'args' => array('value' => 'none','option_type'=>'mods') ),    
    array('old'=> "int_integration_bottom_adsense_type", 'new'=>'ads_type' , 'type'=>'get_param_with_old_name' ),   
    array('old'=> "int_integration_bottom_adsense", 'new'=>'integration_bottom_adsense' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "int_integration_bottom_advertisment_picture", 'new'=>'integration_bottom_advertisment_picture' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "int_integration_bottom_advertisment_url", 'new'=>'integration_bottom_advertisment_url' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "int_integration_bottom_advertisment_title", 'new'=>'integration_bottom_advertisment_title' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "int_integration_bottom_advertisment_alt", 'new'=>'integration_bottom_advertisment_alt' , 'type'=>'get_param_with_old_name' ),
    /*HomePage*/
    array('old'=> "_hide_top_posts", 'new'=>'top_posts_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_top_posts_title", 'new'=>'top_posts_title' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_top_posts_description", 'new'=>'top_posts_description' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_top_posts_categories", 'new'=>'top_posts_categories' , 'type'=>'get_old_posts_cats' ),
    
    array('old'=> "_top_post_effect", 'new'=>'top_post_effect' , 'type'=>'get_old_posts_cats' ),    
    array('old'=> "_hide_category_tabs_posts", 'new'=>'category_tabs_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_home_page_tabs_business_elite", 'new'=>'category_tabs_categories' , 'type'=>'get_old_posts_cats' ),   
    array('old'=> "_hide_video_post", 'new'=>'featured_post_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_video_post_img", 'new'=>'featured_bg_img' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_video_post", 'new'=>'featured_posts' , 'type'=>'select_to_select_array', 'args'=>array() ),
    array('old'=> "_feautured_effect", 'new'=>'feautured_effect' , 'type'=>'get_old_posts_cats' ),    
    array('old'=> "_hide_content_posts", 'new'=>'content_posts_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_content_posts_title", 'new'=>'content_posts_title' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_content_posts_description", 'new'=>'content_posts_description' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_content_posts_categories", 'new'=>'content_posts_categories' , 'type'=>'get_old_posts_cats' ),    
    array('old'=> "_hide_portfolio_posts", 'new'=>'portfolio_posts_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_portfolio_title", 'new'=>'portfolio_title' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_portfolio_description", 'new'=>'portfolio_description' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_portfolio_tab_categories", 'new'=>'portfolio_categories' , 'type'=>'get_old_posts_cats' ),
    array('old'=> "_portfolio_effect", 'new'=>'portfolio_effect' , 'type'=>'get_old_posts_cats' ),        
    array('old'=> "_hide_contact_us", 'new'=>'contact_us_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_contact_us_bg", 'new'=>'contact_us_bg' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_contact_us_description", 'new'=>'contact_us_description' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_contact_us_name", 'new'=>'contact_us_name' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_contact_us_address", 'new'=>'contact_us_address' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_contact_us_mail", 'new'=>'contact_us_mail' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_contact_us_mail", 'new'=>'contact_us_mail' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_contact_effect", 'new'=>'contact_effect' , 'type'=>'get_old_posts_cats' ),
    
    array('old'=> "_show_twitter_icon", 'new'=>'twitter_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_twitter_url", 'new'=>'twitter_url' , 'type'=>'get_param_with_old_name' ),
    
    array('old'=> "_show_facebook_icon", 'new'=>'facebook_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_facebook_url", 'new'=>'facebook_url' , 'type'=>'get_param_with_old_name' ),
    
    array('old'=> "_show_rss_icon", 'new'=>'rss_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_rss_url", 'new'=>'rss_url' , 'type'=>'get_param_with_old_name' ),
    
    array('old'=> "_show_youtube_icon", 'new'=>'youtube_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_youtube_url", 'new'=>'youtube_url' , 'type'=>'get_param_with_old_name' ),
    
    array('old'=> "_show_googlep_icon", 'new'=>'googlep_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_googlep_url", 'new'=>'googlep_url' , 'type'=>'get_param_with_old_name' ),
    
    array('old'=> "_show_instagram_icon", 'new'=>'instagram_enable' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_instagram_url", 'new'=>'instagram_url' , 'type'=>'get_param_with_old_name' ),
    /*Slider*/
    array('old'=> "_hide_slider", 'new'=>'hide_slider' , 'type'=>'select_to_select_array'),   
    array('old'=> "_image_height", 'new'=>'image_height' , 'type'=>'get_param_with_old_name' ),   
    array('old'=> "_animation_speed", 'new'=>'animation_speed' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_slideshow_interval", 'new'=>'slideshow_interval' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_stop_on_hover", 'new'=>'stop_on_hover' , 'type'=>'get_param_with_old_name' ),
    array('old'=> "_effect", 'new'=>'effect' , 'type'=>'select_to_select_array'),
    array('old'=> "_title_position", 'new'=>'title_position' , 'type'=>'select_to_select_array'),
    array('old'=> "_description_position", 'new'=>'description_position' , 'type'=>'select_to_select_array'),
    
    array('old'=> "_imgs_url", 'new'=>'slider_head' , 'type'=>'json_to_string'),
    array('old'=> "_imgs_href", 'new'=>'slider_head_href' , 'type'=>'json_to_string'),
    array('old'=> "_imgs_title", 'new'=>'slider_head_title' , 'type'=>'json_to_string'),
    array('old'=> "_imgs_description", 'new'=>'slider_head_desc' , 'type'=>'json_to_string'),
    /* Typography */
    array('old'=> "ty_type_headers_font", 'new'=>'text_headers_font' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_headers_kern", 'new'=>'text_headers_kern' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_headers_transform", 'new'=>'text_headers_transform' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_headers_variant", 'new'=>'text_headers_variant' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_headers_weight", 'new'=>'text_headers_weight' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_headers_style", 'new'=>'text_headers_style' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_primary_font", 'new'=>'text_primary_font' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_primary_kern", 'new'=>'text_primary_kern' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_primary_transform", 'new'=>'text_primary_transform' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_primary_variant", 'new'=>'text_primary_variant' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_primary_weight", 'new'=>'text_primary_weight' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_primary_style", 'new'=>'text_primary_style' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_secondary_kern", 'new'=>'text_secondary_kern' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_secondary_transform", 'new'=>'text_secondary_transform' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_secondary_variant", 'new'=>'text_secondary_variant' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_secondary_weight", 'new'=>'text_secondary_weight' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_secondary_style", 'new'=>'text_secondary_style' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_inputs_font", 'new'=>'text_inputs_font' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_inputs_kern", 'new'=>'text_inputs_kern' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_inputs_transform", 'new'=>'text_inputs_transform' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_inputs_variant", 'new'=>'text_inputs_variant' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_inputs_weight", 'new'=>'text_inputs_weight' , 'type'=>'select_to_select_array'),
    array('old'=> "ty_type_inputs_style", 'new'=>'text_inputs_style' , 'type'=>'select_to_select_array'),
    /*Color_control*/
    array('old'=> "cc_logo_text_color", 'new'=>'logo_text_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#0A7ED5")),
    array('old'=> "cc_header_back_color", 'new'=>'header_back_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#FFFFFF")),
    array('old'=> "cc_menu_elem_back_color", 'new'=>'menu_elem_back_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#FFFFFF")),
    array('old'=> "cc_menu_links_color", 'new'=>'menu_links_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#686565")),
    array('old'=> "cc_menu_links_hover_color", 'new'=>'menu_links_hover_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#0A7ED5")),  
    array('old'=> "cc_selected_menu_item", 'new'=>'selected_menu_item' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#FFFFFF")),
    array('old'=> "cc_top_posts_color", 'new'=>'top_posts_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#F8F8F8")),
    array('old'=> "cc_text_headers_color", 'new'=>'text_headers_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#0A7ED5")),
    array('old'=> "cc_primary_text_color", 'new'=>'primary_text_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#000000")),
    array('old'=> "cc_primary_links_color", 'new'=>'primary_links_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#000000")),
    array('old'=> "cc_primary_links_hover_color", 'new'=>'primary_links_hover_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#0A7ED5")),
    array('old'=> "cc_cat_tab_back_color", 'new'=>'cat_tab_back_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#0A7ED5")),
    array('old'=> "cc_featured_posts_color", 'new'=>'featured_posts_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#FFFFFF")),
    array('old'=> "cc_content_post_back", 'new'=>'content_post_back' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#FFFFFF")),
    array('old'=> "cc_sideb_background_color", 'new'=>'sideb_background_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#F3F3F4")),
    array('old'=> "cc_footer_title_color", 'new'=>'footer_title_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#000000")),
    array('old'=> "cc_footer_sideb_background_color", 'new'=>'footer_sideb_background_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#F3F3F4")),
    array('old'=> "cc_second_footer_sideb_background_color", 'new'=>'second_footer_sideb_background_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#FFFFFF")),
    array('old'=> "cc_footer_text_color", 'new'=>'footer_text_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#000000")),
    array('old'=> "cc_footer_back_color", 'new'=>'footer_back_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#FFFFFF")),
    array('old'=> "cc_date_color", 'new'=>'date_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#B2B0B0")),
    array('old'=> "cc_buttons_color", 'new'=>'buttons_color' , 'type'=>'get_old_colors', 'args'=>array('default'=>"#0A7ED5")),
    )
  );
  
  /**
    * meta content should not be changed
    * only name
  */
  protected $rules_meta = array(
    '1.0.50' => array(
       array('old'=> "layout", 'new'=>'default_layout' ),
       array('old'=> "content_width", 'new'=>'content_area' ),
       array('old'=> "main_col_width", 'new'=>'main_column' ),
       array('old'=> "pr_widget_area_width", 'new'=>'pwa_width' ),
       array('old'=> "fullwidthpage", 'new'=>'full_width' ),
       array('old'=> "blogstyle", 'new'=>'blog_style' ),
       array('old'=> "address", 'new'=>'addrval' ),
       array('old'=> "categories", 'new'=>'categories', 'type'=>'get_old_posts_cats_meta' ),
       array('old'=> "_single_post_soe_title", 'new'=>'seo_single_title', 'external' => true ),
       array('old'=> "_single_post_soe_description", 'new'=>'seo_single_description', 'external' => true ),
       array('old'=> "_single_post_soe_keywords", 'new'=>'seo_single_keywords', 'external' => true ),
       array('old'=>'_wp_page_template', 'new'=>'_wp_page_template', 'type'=>'_wp_page_template', 'external' => true, 'save_external' => true, 'args'=>array('page-news.php'=>'page-about.php', 'page-most_popular.php'=>'page-team.php','page-contact.php'=>'page-contact.php'))
    ),
  );

  /**
    * widget content should not be changed
    * only name
  */
  protected $rules_widget = array(
    '1.0.50' => array(
      array('old'=> "web_buis_adsens", 'new'=>'business_elite_adsens' ),
      array('old'=> "web_buis_adv", 'new'=>'business_elite_adv' ),
      array('old'=> "web_buis_percent", 'new'=>'business_elite_percent' ),
      array('old'=> "wedding_social", 'new'=>'business_elite_social' ),
      array('old'=> "spider_random_post", 'new'=>'business_elite_random_post' ),
    ),
  );

 /**
   * get colors created with theme mods
   * $args=array('default'=>'','title'=>'')
 */
  protected function get_old_colors( $val, $param_name, $args=array()){
    $this->options['color_scheme']['active']=0;
    $this->options['color_scheme']['themes']=array(
      array("name" => "theme_1", "title" => "Gray",),
      array("name" => "theme_2", "title" => "Orange",),
      array("name" => "theme_3", "title" => "Black Orange",),
      array("name" => "theme_4", "title" => "Red",),
      array("name" => "theme_5", "title" => "Green",),
      array("name" => "theme_6", "title" => "Blue",),
    );
    $this->options['color_scheme']['colors'][0][$param_name]=  array(
      'value' => $val,
      'default' => $args['default']
    );  
    /*-- 2_Orange --*/
    $this->options['color_scheme']['colors'][1]=array(
      "logo_text_color" => array('value' => "#000000",'default' =>"#FBC064"),
      "header_back_color" => array('value' => "#FAFAFA",'default' =>"#FAFAFA"),
      "menu_elem_back_color" => array('value' => "#FAFAFA",'default' =>"#FAFAFA"),      
      "menu_links_color" => array('value' => "#000000",'default' =>"#000000"),      
      "menu_links_hover_color" => array('value' => "#FBC064",'default' =>"#FFFFFF"),
      "selected_menu_item" => array('value' => "#FBC064",'default' =>"#FBC064"),        
      "top_posts_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "text_headers_color" => array('value' => "#FBC064",'default' =>"#FBC064"),      
      "primary_text_color" => array('value' => "#686565",'default' =>"#686565"),      
      "primary_links_color" => array('value' => "#000000",'default' =>"#000000"),     
      "primary_links_hover_color" => array('value' => "#FBCO64",'default' =>"#FBCO64"),
      "cat_tab_back_color" => array('value' => "#FBCO64",'default' =>"#FBCO64"),          
      "featured_posts_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "content_post_back" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),     
      "sideb_background_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),      
      "footer_title_color" => array('value' => "#000000",'default' =>"#000000"),      
      "footer_sideb_background_color" => array('value' => "#F3F3F4",'default' =>"#F3F3F4"),
      "second_footer_sideb_background_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),      
      "footer_text_color" => array('value' => "#000000",'default' =>"#000000"),
      "footer_back_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),     
      "date_color" => array('value' => "#B2B0B0",'default' =>"#B2B0B0"),      
      "buttons_color" => array('value' => "#FBC064",'default' =>"#FBC064"),
    );
    /*-- 3_Black-Orange --*/
    $this->options['color_scheme']['colors'][2]=array(
      "logo_text_color" => array('value' => "#ffffff",'default' =>"#ffffff"),
      "header_back_color" => array('value' => "#000000",'default' =>"#000000"),     
      "menu_elem_back_color" => array('value' => "#000000",'default' =>"#000000"),      
      "menu_links_color" => array('value' => "#ffffff",'default' =>"#FFFFFF"),      
      "menu_links_hover_color" => array('value' => "#ffffff",'default' =>"#FFFFFF"),
      "selected_menu_item" => array('value' => "#F4A15C",'default' =>"#F4A15C"),        
      "top_posts_color" => array('value' => "#F8F8F8",'default' =>"#F8F8F8"),
      "text_headers_color" => array('value' => "#F4A15C",'default' =>"#F4A15C"),      
      "primary_text_color" => array('value' => "#686565",'default' =>"#686565"),      
      "primary_links_color" => array('value' => "#000000",'default' =>"#000000"),     
      "primary_links_hover_color" => array('value' => "#F4A15C",'default' =>"#F4A15C"),
      "cat_tab_back_color" => array('value' => "#000000",'default' =>"#000000"),        
      "featured_posts_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "content_post_back" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),     
      "sideb_background_color" => array('value' => "#FAFAFA",'default' =>"#FAFAFA"),      
      "footer_title_color" => array('value' => "#F4A15C",'default' =>"#F4A15C"),      
      "footer_sideb_background_color" => array('value' => "#F3F3F4",'default' =>"#F3F3F4"),
      "second_footer_sideb_background_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),      
      "footer_text_color" => array('value' => "#000000",'default' =>"#000000"),
      "footer_back_color" => array('value' => "#414141",'default' =>"#414141"),     
      "date_color" => array('value' => "#B2B0B0",'default' =>"#B2B0B0"),      
      "buttons_color" => array('value' => "#F4A15C",'default' =>"#F4A15C"),
    );
    /*-- 4_Red --*/
    $this->options['color_scheme']['colors'][3]=array(
      "logo_text_color" => array('value' => "#F74254",'default' =>"#F74254"),
      "header_back_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"), 
      "menu_elem_back_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),      
      "menu_links_color" => array('value' => "#000000",'default' =>"#000000"),    
      "menu_links_hover_color" => array('value' => "#F74254",'default' =>"#F74254"),
      "selected_menu_item" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),      
      "top_posts_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "text_headers_color" => array('value' => "#F74254",'default' =>"#F74254"),      
      "primary_text_color" => array('value' => "#000000",'default' =>"#000000"),      
      "primary_links_color" => array('value' => "#000000",'default' =>"#000000"),     
      "primary_links_hover_color" => array('value' => "#F74254",'default' =>"#F74254"),
      "cat_tab_back_color" => array('value' => "#F74254",'default' =>"#F74254"),        
      "featured_posts_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "content_post_back" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),     
      "sideb_background_color" => array('value' => "#FAFAFA",'default' =>"#FAFAFA"),      
      "footer_title_color" => array('value' => "#F74254",'default' =>"#F74254"),      
      "footer_sideb_background_color" => array('value' => "#F3F3F4",'default' =>"#F3F3F4"),
      "second_footer_sideb_background_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),      
      "footer_text_color" => array('value' => "#000000",'default' =>"#000000"),
      "footer_back_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),     
      "date_color" => array('value' => "#B2B0B0",'default' =>"#B2B0B0"),      
      "buttons_color" => array('value' => "#F74254",'default' =>"#F74254"),  
    );
    /*--- 5_Green ---*/
    $this->options['color_scheme']['colors'][4]=array(/*ttt stophere*/
      "logo_text_color" => array('value' => "#8CC044",'default' =>"#8CC044"),
      "header_back_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "menu_elem_back_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),      
      "menu_links_color" => array('value' => "#000000",'default' =>"#000000"),
      "menu_links_hover_color" => array('value' => "#8CC044",'default' =>"#8CC044"),
      "selected_menu_item" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),      
      "top_posts_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "text_headers_color" => array('value' => "#8CC044",'default' =>"#8CC044"),
      "primary_text_color" => array('value' => "#686565",'default' =>"#686565"),      
      "primary_links_color" => array('value' => "#000000",'default' =>"#000000"),
      "primary_links_hover_color" => array('value' => "#8CC044",'default' =>"#8CC044"),
      "cat_tab_back_color" => array('value' => "#8CC044",'default' =>"#8CC044"),      
      "featured_posts_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "content_post_back" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "sideb_background_color" => array('value' => "#FAFAFA",'default' =>"#FAFAFA"),      
      "footer_title_color" => array('value' => "#8CC044",'default' =>"#8CC044"),
      "footer_sideb_background_color" => array('value' => "#F3F3F4",'default' =>"#F3F3F4"),
      "second_footer_sideb_background_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),      
      "footer_text_color" => array('value' => "#000000",'default' =>"#000000"),
      "footer_back_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "date_color" => array('value' => "#B2B0B0",'default' =>"#B2B0B0"),      
      "buttons_color" => array('value' => "#8CC044",'default' =>"#8CC044"),   
    );
    /*--- 6_Blue ---*/
    $this->options['color_scheme']['colors'][5]=array(
      "logo_text_color" => array('value' => "#0A7ED5",'default' =>"#0A7ED5"),
      "header_back_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "menu_elem_back_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "menu_links_color" => array('value' => "#686565",'default' =>"#686565"),
      "menu_links_hover_color" => array('value' => "#0A7ED5",'default' =>"#0A7ED5"),
      "selected_menu_item" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "top_posts_color" => array('value' => "#F8F8F8",'default' =>"#F8F8F8"),
      "text_headers_color" => array('value' => "#0A7ED5",'default' =>"#0A7ED5"),

      "primary_text_color" => array('value' => "#000000",'default' =>"#000000"),
      "primary_links_color" => array('value' => "#000000",'default' =>"#000000"),
      "primary_links_hover_color" => array('value' => "#0A7ED5",'default' =>"#0A7ED5"),
      "cat_tab_back_color" => array('value' => "#0A7ED5",'default' =>"#0A7ED5"),      
      "featured_posts_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "content_post_back" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "sideb_background_color" => array('value' => "#F3F3F4",'default' =>"#F3F3F4"),
      "footer_title_color" => array('value' => "#000000",'default' =>"#000000"),
      "footer_sideb_background_color" => array('value' => "#F3F3F4",'default' =>"#F3F3F4"),
      "second_footer_sideb_background_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "footer_text_color" => array('value' => "#000000",'default' =>"#000000"),
      "footer_back_color" => array('value' => "#FFFFFF",'default' =>"#FFFFFF"),
      "date_color" => array('value' => "#B2B0B0",'default' =>"#B2B0B0"),
      "buttons_color" => array('value' => "#0A7ED5",'default' =>"#0A7ED5"),  
    );
     
    $this->options['colors_active']['select_theme'] ='color_scheme';
    $this->options['colors_active']['active'] ='0';
    $this->options['colors_active']['colors'][$param_name] = array(
      'value' => $val,
      'default' => $args['default'],
    );  
  }
}