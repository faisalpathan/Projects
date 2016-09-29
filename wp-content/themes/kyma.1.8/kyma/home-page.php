<?php
/* Template Name: Home */
get_header();
get_template_part('home', 'slider');
$kyma_theme_options = kyma_theme_options();
foreach($kyma_theme_options['home_sections'] as $section){
	get_template_part('home',$section);
}
get_footer();
?>