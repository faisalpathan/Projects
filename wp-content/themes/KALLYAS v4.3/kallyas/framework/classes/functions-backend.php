<?php if(! defined('ABSPATH')){ return; }



/*
 * Load custom fonts
 */
if( !function_exists('zn_custom_fonts') ) {
	function zn_custom_fonts( $css ) {

		$custom_fonts = zget_option('zn_custom_fonts', 'google_font_options');

		// Don't do anything if we don't need to
		if( empty( $custom_fonts ) ) { return $css; }

		if( is_array( $custom_fonts ) ){
			foreach ( $custom_fonts as $font ) {
				if( $font_name = $font['cf_name'] ){

					$cf_fontweight = $font['cf_fontweight'];
					$font_weight = $cf_fontweight ? "font-weight: ".$cf_fontweight." ;" : "";

					$font_src = "";
					// .eot
					if( $cf_eot = $font['cf_eot'] ){
						$cf_eot = zn_fix_insecure_content($cf_eot);
						$font_src .= "src: url('{$cf_eot}');";
					}

					// Rest of font files
					if( !empty( $font['cf_woff'] ) || ! empty( $font['cf_ttf'] ) || ! empty( $font['cf_svg'] ) ){
						$font_src .= "src: ";

						if( $cf_eot = $font['cf_eot'] ){
							$cf_eot = zn_fix_insecure_content($cf_eot);
							$font_src .= "url('{$cf_eot}?#iefix') format('eot'),";
						}

						if( $cf_woff = $font['cf_woff'] ){
							$cf_woff = zn_fix_insecure_content($cf_woff);
							$font_src .= "url('{$cf_woff}') format('woff'),";
						}

						if( $cf_ttf = $font['cf_ttf'] ){
							$cf_ttf = zn_fix_insecure_content($cf_ttf);
							$font_src .= "url('{$cf_ttf}') format('truetype'),";
						}

						if( $cf_svg = $font['cf_svg'] ){
							$cf_svg = zn_fix_insecure_content($cf_svg);
							$font_src .= "url('{$cf_svg}') format('svg'),";
						}

						$font_src = rtrim($font_src, ",");

						$font_src .= ";";
					}


					$css .= "
						@font-face {
							font-family: '{$font_name}';
							{$font_weight}
							{$font_src}
						}
					";


				}

			}
		}

		return $css;

	}
}
add_filter( 'zn_dynamic_css', 'zn_custom_fonts' );

function zn_fix_insecure_content($url){
	return preg_replace('#^https?://#', '//', $url);
}

?>
