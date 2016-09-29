<?php
// [title]
function title_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    'text' => '',
    'style' => '',
    'link' => '',
    'link_text' => '',
    'target' => ''
  ), $atts ) );

$link_output = '';
$style_output ='';
if($style) $style_output = 'title_'.$style;
if($link) $link_output = '<a href="'.$link.'" target="'.$target.'">'.$link_text.'</a>';
$after_title = '';
$align = '';

if($style == 'divided'){ 
  $after_title = '<div class="tx-div medium"></div>'; 
  $align = 'text-center';
}

return '<h3 class="section-title clearfix '.$style_output.' '.$align.'"><span>'.$text.'</span> '.$link_output.' '.$after_title.'</h3><!-- end section_title -->';

}
add_shortcode('title', 'title_shortcode');


// [divider]
function divider_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    'width' => 'small',
    'height' => '',
    'align' => 'left', 
  ), $atts ) );

if($height) $height = 'style="height:'.$height.'"';

$align_end ='';
$align_start = '';
if($align == 'center'){
  $align_start ='<div class="text-center">';
  $align_end = '</div>';
}

return $align_start.'<div class="tx-div '.$width.' clearfix" '.$height.'></div>'.$align_end.'<!-- end divider -->';

}
add_shortcode('divider', 'divider_shortcode');

// [gap]
function ux_gap_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    'height' => '30px',
  ), $atts ) );

return '<div style="display:block;height:'.$height.'" class="clearfix"></div>';

}
add_shortcode('gap', 'ux_gap_shortcode');