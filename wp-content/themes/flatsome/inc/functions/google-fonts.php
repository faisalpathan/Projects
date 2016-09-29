<?php

/* Insert custom font */
if($flatsome_opt['custom_font']){
	function ux_add_custom_font(){
		global $flatsome_opt;
		echo '<style>@font-face{ font-family: customFont; src: url('.$flatsome_opt['custom_font'].'); }</style>';
	}
	add_action('wp_head','ux_add_custom_font');
}

/* Load google fonts */
if(isset($flatsome_opt['type_headings']) && !$flatsome_opt['disable_fonts']){
$customfont = '';
$default = array(
		'arial',
		'verdana',
		'trebuchet',
		'georgia',
		'times',
		'tahoma',
		'helvetica'
	);

$googlefonts = array(
	$flatsome_opt['type_headings'],
	$flatsome_opt['type_texts'],
	$flatsome_opt['type_nav'],
	$flatsome_opt['type_alt']
);



$customfontset = '';

if(isset($flatsome_opt['type_subset'])){
	$subsets= array('latin');
	if(isset($flatsome_opt['type_subset']['latin-ext']) && $flatsome_opt['type_subset']['latin-ext']){array_push($subsets, 'latin-ext');}
	if(isset($flatsome_opt['type_subset']['cyrillic-ext']) && $flatsome_opt['type_subset']['cyrillic-ext']){array_push($subsets, 'cyrillic-ext');}
	if(isset($flatsome_opt['type_subset']['greek-ext']) && $flatsome_opt['type_subset']['greek-ext']){array_push($subsets, 'greek-ext');}
	if(isset($flatsome_opt['type_subset']['greek']) && $flatsome_opt['type_subset']['greek']){array_push($subsets, 'greek');}
	if(isset($flatsome_opt['type_subset']['vietnamese']) && $flatsome_opt['type_subset']['vietnamese']){array_push($subsets, 'vietnamese');}
	if(isset($flatsome_opt['type_subset']['cyrillic']) && $flatsome_opt['type_subset']['cyrillic']){array_push($subsets, 'cyrillic');}
	foreach($subsets as $fontset) {
		$customfontset = $fontset.','. $customfontset;
	}	
	$customfontset = '&subset='.substr_replace($customfontset ,"",-1);
}

			
foreach($googlefonts as $googlefont) {
	if(!in_array($googlefont, $default)) {
			$customfont = str_replace(' ', '+', $googlefont). ':300,400,700,900|' . $customfont;
	}
}	


if ($customfont != "") {	
	function google_fonts() {	
		global $customfont, $customfontset;		
		wp_enqueue_style( 'flatsome-googlefonts', "//fonts.googleapis.com/css?family=". substr_replace($customfont ,"",-1) . $customfontset);
	}
	add_action( 'wp_enqueue_scripts', 'google_fonts' );
}

}

?>
