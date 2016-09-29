<?php
/* General Options */
function kyma_theme_options()
{
    $kyma_theme_options = array(
        '_frontpage' => 1,
        'site_layout' => '',
        'upload_image_logo' => '',
        'logo_height' => 75,
        'logo_width' => 150,
        'logo_text_width' => 35,
        'logo_layout' => 'left',
        'logo_spacing' => 0,
        'topbarcolor' => '',
        'headercolorscheme' => 'light_header',
        'headersticky' => 1,
        'text_title' => 'off',
        'custom_css' => '',
        'home_service_heading' => __('Our Services', 'kyma'),
        'home_service_column' => 4,
        'service_title_1' => __("Responsive", 'kyma'),
        'service_icon_1' => "fa fa-mobile",
        'service_text_1' => __("Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum lorem sit amet.", 'kyma'),
        'service_link_1' => "#",

        'service_title_2' => __("Retina Ready", 'kyma'),
        'service_icon_2' => "fa fa-eye",
        'service_text_2' => __("Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum lorem sit amet.", 'kyma'),
        'service_link_2' => "#",

        'service_title_3' => __("Multi Layout", 'kyma'),
        'service_icon_3' => "fa fa-clone",
        'service_text_3' => __("Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum lorem sit amet", 'kyma'),
        'service_link_3' => "#",

        'service_title_4' => __('Easy To Customize', 'kyma'),
        'service_text_4' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum lorem sit amet', 'kyma'),
        'service_icon_4' => "fa fa-wrench",
        'service_link_4' => "#",
		
		//Slider Settings:
        'home_slider_enabled' => 1,
		//Extra Settings:
		'home_extra_title' => __('Extra Content', 'kyma'),
		'extra_content_home' => '',
        //Portfolio Settings:
        'port_heading' => __('Recent Works', 'kyma'),
        'portfolio_three_column' => 1,
        'portfolio_shortcode' => '',
        'footer_copyright' => __('Kyma Theme', 'kyma'),
        'developed_by_text' => __('Developed By', 'kyma'),
        'developed_by_link_text' => __('Webhunt Infotech', 'kyma'),
        'developed_by_link' => 'http://www.webhuntinfotech.com/',
        'footer_layout' => 4,
        'blog_title' => __('Bolg', 'kyma'),
		'home_post_cat' => '',
        /* footer callout */
        'callout_title' => __('Best Wordpress Resposnive Theme Ever!', 'kyma'),
        'callout_description' => __('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour of this randomised words which don\'t look even slightly believable If you are going to use a passage of Lorem Ipsum.', 'kyma'),
        'callout_btn_text' => __('Purchase Now', 'kyma'),
        'callout_btn_icon' => 'fa fa-shopping-cart',
        'callout_btn_link' => 'http://www.webhuntinfotech.com',
        /* Social media icons */
        'contact_info_header' => 1,
        'social_media_header' => 1,
        'contact_phone' => '+0744-9999',
        'contact_email' => 'example@gmail.com',
        'social_facebook_link' => '#',
        'social_twitter_link' => '#',
        'social_instagram_link' => '#',
        'social_linkedin_link' => '#',
        'social_youtube_link' => '#',
        'social_vimeo_link' => '#',
        'social_google_plus_link' => '#',
        'social_skype_link' => '#',
        /* blog option */
        'blog_layout' => 'blogright',
        'post_layout' => 'postright',
        'blog_post_count' => 3,
        'home_blog_title' => __('Latest Posts', 'kyma'),
        'related_post_text' => __('Posts You might like', 'kyma'),
        'about_author_text' => __('About The Author', 'kyma'),
		'home_sections' => array('service', 'portfolio', 'blog', 'callout', 'content'),
    );
    //delete_option('kyma_theme_options');
    return wp_parse_args(get_option('kyma_theme_options', array()), $kyma_theme_options);
}

?>