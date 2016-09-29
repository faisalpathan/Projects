<?php
/* General Options */
function spina_theme_options()
{
    $spina_theme_options = array(
		'social_linkedin_link' => 'https://www.linkedin.com/',
		'social_pinterest_link' => 'https://www.pinterest.com/',
		'callout_btn_one_text' => __('View Detail', 'spina'),
        'callout_btn_one_icon' => 'fa fa-arrows-alt',
        'callout_btn_one_link' => 'http://www.example.com'
    );
    return wp_parse_args(get_option('spina_theme_options', array()), $spina_theme_options);
}
?>