<?php

$data = '';

/*************************/
/* SLIDER STYLES CLASSES */
/*************************/

$data .= '<style type="text/css">';

	for($p = 1; $p < 20; $p++) {
		$tmpwidth = (int) $slider['properties']['width'] * (1  - $p / 10);
		$data .= '@media screen and (max-width: '.$tmpwidth.'px) {';
			$data .= '#cuteslider_'.($id+1).'_wrapper .br-caption-content {';
				$data .= 'font-size: '.(100-10*$p).'%;';
 			$data .= '}';
 		$data .= '}';
	}


$data .= '#cuteslider_'.($id+1).'_wrapper { ';

	if(isset($slider['properties']['responsive'])) {
	$data .= 'width: 100%;';
	} else {
	$data .= 'width: '.cuteslider_check_unit($slider['properties']['width']).';';
	}

	$data .= 'margin: 0px auto;';

	if(!empty($slider['properties']['minwidth'])) :
	$data .= 'min-width:' . cuteslider_check_unit($slider['properties']['minwidth']) . ';';
	endif;

	if(!empty($slider['properties']['maxwidth'])) :
	$data .= 'max-width:' . cuteslider_check_unit($slider['properties']['maxwidth']) . ';';
	endif;
$data .= '}';

$data .= '#cuteslider_'.($id+1).' { ';
	$data .= $slider['properties']['sliderstyle'];
$data .= '}';

if(!empty($slider['layers'])) :
foreach($slider['layers'] as $layerkey => $layer) :

	if(!empty($layer['sublayers'])) :
	foreach($layer['sublayers'] as $subkey => $sublayer) :

		$data .= '.caption_slider'.($id+1).'_layer' . ($layerkey+1) . '_sublayer' . ($subkey+1) . ' { ';

			// Dimensions
			$data .= 'width: ' . cuteslider_check_unit($sublayer['width']) . ';';
			$data .= 'height: ' . cuteslider_check_unit($sublayer['height']) . ';';

			// Positions
			$data .= 'position: absolute;';
			$data .= 'top: ' . cuteslider_check_unit($sublayer['top']) . ';';
			$data .= 'left: ' . cuteslider_check_unit($sublayer['left']) . ';';

			// Paddings
			$data .= 'padding-top: ' . cuteslider_check_unit($sublayer['padding_top']) . ';';
			$data .= 'padding-right: ' . cuteslider_check_unit($sublayer['padding_right']) . ';';
			$data .= 'padding-bottom: ' . cuteslider_check_unit($sublayer['padding_bottom']) . ';';
			$data .= 'padding-left: ' . cuteslider_check_unit($sublayer['padding_left']) . ';';

			// Borders
			$data .= 'border-top: ' . $sublayer['border_top'] . ';';
			$data .= 'border-right: ' . $sublayer['border_right'] . ';';
			$data .= 'border-bottom: ' . $sublayer['border_bottom'] . ';';
			$data .= 'border-left: ' . $sublayer['border_left'] . ';';

			// Font
			$data .= 'font-family: ' . $sublayer['font_family'] . ';';
			$data .= 'font-size: ' . cuteslider_check_unit($sublayer['font_size']) . ';';
			$data .= 'line-height: ' . cuteslider_check_unit($sublayer['line_height']) . ';';
			$data .= 'color: ' . $sublayer['color'] . ';';

			// Misc
			$data .= 'background-color: ' . $sublayer['background'] . ';';
			$data .= $sublayer['style'];

		$data .= ' } ';

		$data .= '.caption_layer' . ($layerkey+1) . '_sublayer' . ($subkey+1) . ' a.linked { ';
			$data .= 'text-decoration: none;';
			$data .= 'color: ' . $sublayer['color'] . ';';
		$data .= ' } ';

	endforeach;
	endif;

endforeach;
endif;
$data .= '</style>';

/*****************/
/* SLIDER PARAMS */
/*****************/
$trans_3d = array();
$trans_2d = array();

for($c = 1; $c < 65; $c++) {
	$trans_3d[] = 'tr'.$c;
}

for($c = 1; $c < 41; $c++) {
	$trans_2d[] = 'tr'.$c;
}

$trans_3d = implode(',', $trans_3d);
$trans_2d = implode(',', $trans_2d);

$skin = get_option('cuteslider-skin', 'template2');

/**********************/
/* SLIDER HTML MARKUP */
/**********************/

// SLIDER PROPERTIES
$width = 'data-width="'.$slider['properties']['width'].'"';
$height ='data-height="'.$slider['properties']['height'].'"';
$pause = isset($slider['properties']['pauseonhover']) ? 'data-overpause="true"' : 'data-overpause="false"';
$force2d = isset($slider['properties']['force_2d']) ? 'data-force="2d"' : '';
$randomslideshow = isset($slider['properties']['randomslideshow']) ? 'data-shuffle="true"' : 'data-shuffle="false"';

$thumbs = ($slider['properties']['thumbnav'] == 'hover') ? 'true' : 'false';
$thumbs_align = $slider['properties']['thumbnav_hover_align'];

$data .= '<div id="cuteslider_'.($id+1).'_wrapper" class="cs-'.$slider['properties']['skin'].'">';
	$data .= '<div id="cuteslider_'.($id+1).'" class="cute-slider" '.$width.' '.$height.' '.$pause.' '.$force2d.' '.$randomslideshow.'>';

		// SLIDES
		$data .= '<ul data-type="slides">';
			foreach($slider['layers'] as $layerkey => $layer) :

				// HIDDEN?
				if(isset($layer['properties']['skip'])) {
					continue;
				}

				// PROPERITES
				if(!empty($layer['properties']['thumbnail'])) {
					$thumb = ' data-thumb="'.$layer['properties']['thumbnail'].'"';
				} else {
					$thumb = ' data-thumb="'.$layer['properties']['image'].'"';
				}

				// Transitions
				if(empty($layer['properties']['3d_transitions'])) {
					$layer['properties']['3d_transitions'] = $trans_3d;
				}

				if(empty($layer['properties']['2d_transitions'])) {
					$layer['properties']['2d_transitions'] = $trans_2d;
				}

				// Images
				if($layerkey == 0) {
					$src = ' src="'.$layer['properties']['image'].'"';
					$datasrc = '';
				} else {
					$src = ' src="'.$GLOBALS['csPluginPath'].'/img/blank.png"';
					$datasrc = ' data-src="'.$layer['properties']['image'].'"';
				}

				$data .= '<li data-delay="'.$layer['properties']['slidedelay'].'" data-src="'.$layer['properties']['slidedelay'].'" data-trans3d="'.$layer['properties']['3d_transitions'].'" data-trans2d="'.$layer['properties']['2d_transitions'].'">';

					// IMAGE
					$data .= '<img '.$src.''.$datasrc.''.$thumb.'>';

					// INFO BOX
					if(
						!empty($layer['properties']['infobox_title']) ||
						!empty($layer['properties']['infobox_text']) ||
						!empty($layer['properties']['infobox_link'])
					) {

						$data .= '<div data-type="info" class="info1" data-align="'.$layer['properties']['infobox_aligment'].'">';
							$data .= '<div>';
								if(!empty($layer['properties']['infobox_title'])) :
								$data .= '<h1 class="title">'.do_shortcode(__(stripslashes($layer['properties']['infobox_title']))).'</h1>';
								endif;

								if(!empty($layer['properties']['infobox_text']) || !empty($layer['properties']['infobox_link'])) :
								$data .= '<p class="text">';

									if(!empty($layer['properties']['infobox_link'])) :
									$data .= '<a class="more-btn" href="'.$layer['properties']['infobox_link'].'" target="'.$layer['properties']['infobox_target'].'">'.do_shortcode(__(stripslashes($layer['properties']['infobox_button']))).'</a>';
									endif;

									if(!empty($layer['properties']['infobox_text'])) :
									$data .= do_shortcode(__(stripslashes($layer['properties']['infobox_text'])));
									endif;

									$data .= '<br class="clear">';

								$data .= '</p>';
								endif;
							$data .= '</div>';
						$data .= '</div>';
					}

					// VIDEO
					if(!empty($layer['properties']['video'])) :
					$data .= '<a data-type="video" href="'.$layer['properties']['video'].'"></a>';
					endif;

					// Link
					if(!empty($layer['properties']['link'])) :
					$data .= '<a data-type="link" href="'.$layer['properties']['link'].'" target="'.$layer['properties']['link_target'].'"></a>';
					endif;

					// CAPTIONS
					if(!empty($layer['sublayers'])) :
					$data .= '<ul data-type="captions">';

						foreach($layer['sublayers'] as $subkey => $caption) :

						// HIDDEN?
						if(isset($caption['skip'])) {
							continue;
						}

						// OPTIONS
						$effect = 'data-effect="'.$caption['effect'].'"';
						$delay = 'data-delay="'.$caption['delay'].'"';

						// CAPTION
						$data .= '<li class="caption_slider'.($id+1).'_layer' . ($layerkey+1) . '_sublayer' . ($subkey+1).'" '.$effect.' '.$delay.'>';

							if(!empty($caption['url'])) :
							$data .= '<a href="'.$caption['url'].'" target="'.$caption['target'].'" class="linked">';
							endif;

								$data .= __(stripslashes($caption['html']));

							if(!empty($caption['url'])) :
							$data .= '</a>';
							endif;
						$data .= '</li>';

						endforeach;

					$data .= '</ul>';
					endif;

				$data .= '</li>';
			endforeach;
		$data .= '</ul>';

		// CONTROLS
		$data .= '<ul data-type="controls">';
			$data .= '<li data-type="captions"></li>';
			$data .= '<li data-type="link"></li>';
			$data .= '<li data-type="video"></li>';
			$data .= '<li data-type="slideinfo"></li>';

			if(isset($slider['properties']['navcircletimer'])) {
				$data .= '<li data-type="circletimer"></li>';
			}

			if(isset($slider['properties']['navprevnext'])) {
				$data .= '<li data-type="next"> </li>';
				$data .= '<li data-type="previous"></li>';
			}

			if($slider['properties']['thumbnav'] == 'always') {
				$data .= '<li data-type="thumblist" data-dir="horizontal" data-autohide="true"></li>';

			} elseif(isset($slider['properties']['navbuttons'])) {
				$data .= '<li data-type="slidecontrol" data-thumb="'.$thumbs.'" data-thumbalign="'.$thumbs_align.'"></li>';
			}

			if(isset($slider['properties']['navbartimer'])) {
				$data .= '<li data-type="bartimer"></li>';
			}

		$data .= '</ul>';

	$data .= '</div>';

	if(isset($slider['properties']['shadow'])) :
	$data .= '<div class="cute-shadow">';
		$data .= '<img src="'.$GLOBALS['csPluginPath'].'/skins/'.$slider['properties']['skin'].'/cute-theme/shadow.png" alt="shadow">';
	$data .= '</div>';
	endif;

$data .= '</div>';

/********************/
/* SLIDER INIT CODE */
/********************/

$data .= '<script type="text/javascript">';

	$data .= '
	var cs_vars = {};
	cs_vars.id = '.($id+1).';
	cs_vars.path = "'.$GLOBALS['csPluginPath'].'";
	cs_vars.prop_skin = "'.(isset($slider['properties']['skin']) ? $slider['properties']['skin'] : '' ).'";
	cs_vars.prop_auto = "'.(isset($slider['properties']['autostart']) ? $slider['properties']['autostart'] : 'off').'";
	cs_vars.prop_api_change_start = '.stripslashes($slider['properties']['api_change_start']).';
	cs_vars.prop_api_change_end = '.stripslashes($slider['properties']['api_change_end']).';
	cs_vars.prop_api_wating = '.stripslashes($slider['properties']['api_wating']).';
	cs_vars.prop_api_change_next = '.stripslashes($slider['properties']['api_change_next']).';
	cs_vars.prop_api_waiting_next = '.stripslashes($slider['properties']['api_waiting_next']).';
	';
	// $data .= 'window.onload = function() {';
	// 	$data .= 'var cuteslider'.($id+1).' = new Cute.Slider();';
	// 	$data .= 'cuteslider'.($id+1).'.setup("cuteslider_'.($id+1).'" , "cuteslider_'.($id+1).'_wrapper", "'.$GLOBALS['csPluginPath'].'/skins/'.$slider['properties']['skin'].'/style/slider-style.css");';

	// 	if(!isset($slider['properties']['autostart'])) :
	// 	$data .= 'cuteslider'.($id+1).'.pause();';
	// 	endif;

	// /*************/
	// /* CALLBACKS */
	// /*************/


	// 	// Cute.SliderEvent.CHANGE_START
	// 	$data .= 'cuteslider'.($id+1).'.api.addEventListener(Cute.SliderEvent.CHANGE_START, '.stripslashes($slider['properties']['api_change_start']).'';
	// 	$data .= ');';

	// 	// Cute.SliderEvent.CHANGE_END
	// 	$data .= 'cuteslider'.($id+1).'.api.addEventListener(Cute.SliderEvent.CHANGE_END, '.stripslashes($slider['properties']['api_change_end']).'';
	// 	$data .= ');';

	// 	// Cute.SliderEvent.WATING
	// 	$data .= 'cuteslider'.($id+1).'.api.addEventListener(Cute.SliderEvent.WATING, '.stripslashes($slider['properties']['api_wating']).'';
	// 	$data .= ');';

	// 	// Cute.SliderEvent.CHANGE_NEXT_SLIDE
	// 	$data .= 'cuteslider'.($id+1).'.api.addEventListener(Cute.SliderEvent.CHANGE_NEXT_SLIDE, '.stripslashes($slider['properties']['api_change_next']).'';
	// 	$data .= ');';

	// 	// Cute.SliderEvent.WATING_FOR_NEXT
	// 	$data .= 'cuteslider'.($id+1).'.api.addEventListener(Cute.SliderEvent.WATING_FOR_NEXT, '.stripslashes($slider['properties']['api_waiting_next']).'';
	// 	$data .= ');';
	// $data .= '}';

$data .= '</script>';