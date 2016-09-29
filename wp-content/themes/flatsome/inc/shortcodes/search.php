<?php

// [search]
function search_shortcode($atts) {
	extract(shortcode_atts(array(
		'size' => 'normal',
	), $atts));

	if($size == 'small') $size = 'style="font-size:80%"';
	if($size == 'large') $size = 'style="font-size:150%"';
	if($size == 'xlarge') $size = 'style="font-size:200%"';

    ob_start();

    if(function_exists('get_product_search_form')){
    	    echo '<div class="ux-search-box" '.$size.'>';
 				get_product_search_form();
 			echo '</div>';
    }

 	
 	$content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode("search", "search_shortcode");