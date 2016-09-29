<?php 
// [accordion]
function ux_accordion($atts, $content=null, $code) {
	extract(shortcode_atts(array(
		'open' => '0',
		'title' => ''
	), $atts));
  if($title) $title = '<h3 class="accordion_title">'.$title.'</h3>';
  return $title.'<div class="accordion" rel="'.$open.'">'.fixShortcode($content).'</div>';		
}
add_shortcode('accordion', 'ux_accordion');


// [accordion-item]
function ux_accordion_item($atts, $content=null, $code) {
    extract(shortcode_atts(array(
		'title' => '',
	), $atts));
	return '<div class="accordion-title"><a href="#">' . $title . '</a></div><div class="accordion-inner">'.fixShortcode($content).'</div>';
}
add_shortcode('accordion-item', 'ux_accordion_item');