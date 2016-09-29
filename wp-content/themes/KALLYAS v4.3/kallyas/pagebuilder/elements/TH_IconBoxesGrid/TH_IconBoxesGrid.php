<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Grid Icon Boxes
 Description: Create and display an Grid Image Boxes element.
 Class: TH_IconBoxesGrid
 Category: content
 Level: 3
*/
/**
 * Class TH_IconBoxesGrid
 *
 * Create and display an Grid Image Boxes element containing an icon, title description with different settings and hover effects
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_IconBoxesGrid extends ZnElements
{
	public static function getName(){
		return __( "Grid Icon Boxes", 'zn_framework' );
	}


	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];

		// Title Styles
		$title_styles = '';
		$title_typo = $this->opt('title_typo');
		if( is_array($title_typo) && !empty($title_typo) ){
			foreach ($title_typo as $key => $value) {
				if(!empty($value)){
					if( $key == 'font-family' ){
						$title_styles .= $key .':'. zn_convert_font($value).';';
					} else {
						$title_styles .= $key .':'. $value.';';
					}
				}
			}
			$css .= '.'.$uid.' .grid-ibx__title {'.$title_styles.'} ';
		}
		// Description styles
		$desc_styles = '';
		$desc_typo = $this->opt('desc_typo');
		if( is_array($desc_typo) && !empty($desc_typo) ){
			foreach ($desc_typo as $key => $value) {
				if(!empty($value)){
					if( $key == 'font-family' ){
						$desc_styles .= $key .':'. zn_convert_font($value).';';
					} else {
						$desc_styles .= $key .':'. $value.';';
					}
				}
			}
			$css .= '.'.$uid.' .grid-ibx__desc {'.$desc_styles.'} ';
		}
		// Icon color default and on hover
		$ibg_icon_color = $this->opt( 'ibg_icon_color', '' );
		$ibg_icon_color_hover = $this->opt('ibg_icon_color_hover', '' );
		if(!empty($ibg_icon_color)){
			$css .= '.'.$uid.' .grid-ibx__icon {color:'.$ibg_icon_color.'} ';
		}
		if(!empty($ibg_icon_color_hover)){
			$css .= '.'.$uid.' .grid-ibx__item:hover .grid-ibx__icon {color:'.$ibg_icon_color_hover.'} ';
		}

		// Force text color
		$ibg_text_color_hover = $this->opt('ibg_text_color_hover', '' );
		if(!empty($ibg_text_color_hover)){
			$css .= '.'.$uid.' .grid-ibx__item:hover .grid-ibx__title, .'.$uid.' .grid-ibx__item:hover .grid-ibx__desc {color:'.$ibg_text_color_hover.'}';
		}


		// Gradient lined style, use same hover color as icon
		if(!empty($ibg_icon_color_hover)){
			if($this->opt('ibg_style','lined-full') == 'lined-gradient') {
				$css .= '.'.$uid.'.grid-ibx--style-lined-gradient .grid-ibx__item:hover .grid-ibx__ghelper {border-color:'.$ibg_icon_color_hover.'} ';
				$css .= '.'.$uid.'.grid-ibx--style-lined-gradient .grid-ibx__item:hover:before, .'.$uid.'.grid-ibx--style-lined-gradient .grid-ibx__item:hover:after { background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$ibg_icon_color_hover.'), color-stop(100%,transparent)); background: -webkit-linear-gradient(top,  '.$ibg_icon_color_hover.' 0%,transparent 100%); background: -webkit-linear-gradient(top, '.$ibg_icon_color_hover.' 0%, transparent 100%); background: linear-gradient(to bottom,  '.$ibg_icon_color_hover.' 0%,transparent 100%); }';
			}
		}

		// Icon height
		$height = $this->opt('ibg_height','200');
		if( $height != '200' ){
			$css .= '.'.$uid.' .grid-ibx__item {height:'.$height.'px} ';
		}

		// Custom background color
		$bg_color = $this->opt('ibg_bg_color');
		if( !empty( $bg_color ) ){
			$css .= '.'.$uid.' .grid-ibx__item {background-color: '.$bg_color.';} ';
		}

		$bg_color_hover = $this->opt('ibg_bg_color_hover');
		if( !empty( $bg_color_hover ) ){
			$css .= '.'.$uid.' .grid-ibx__item:hover {background-color: '.$bg_color_hover.';} ';
		}

		// Icon sizes
		$icon_size = $this->opt('ibg_size','60');
		if( $icon_size != '60' ){
			$css .= ".{$uid} span.grid-ibx__icon { font-size: {$icon_size}px }";
		}

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$uid = $this->data['uid'];
		$options = $this->data['options'];

		$ibg_ib = $this->opt('ibg_ib');
		$titlefirst = $this->opt('ibg_titleorder', '1') == 1;
		$perrow = $this->opt('ibg_perrow','3');

		// States and modificators
		$mods = array();
		$mods[] = 'grid-ibx--cols-'.$perrow;
		if( $this->opt('ibg_style') != '' ){
			$mods[] = 'grid-ibx--style-'.$this->opt('ibg_style','lined-full');
		}
		$mods[] = $this->opt('ibg_hover','grid-ibx--hover-shadow');

		$mods[] = $this->data['uid'];
		$mods[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$mods[] = 'grid-ibx--theme-'.$color_scheme;
		$mods[] = 'element-scheme--'.$color_scheme;

?>

<div class="grid-ibx <?php echo implode(' ', $mods); ?>" <?php echo $attributes; ?>>
	<div class="grid-ibx__inner">
		<div class="grid-ibx__row clearfix">
	<?php
		$countib = count($ibg_ib);

		if( is_array($ibg_ib) && !empty( $ibg_ib ) ){
			$i = 0;
			foreach( $ibg_ib as $ib ){

				$icon_type = $ib['ibg_type'];
				$theicon = $ib['ibg_icon'];
				$icon_img = $ib['ibg_image'];

				// Do the link
				$ibg_link = zn_extract_link( $ib['ibg_link'], 'grid-ibx__link' );

				// Title
				$titlehtml = '';
				if( !empty($ib['ibg_title']) ){
					$title = $ib['ibg_title'];
					$titlehtml = '
					<div class="grid-ibx__title-wrp">
						<h4 class="grid-ibx__title element-scheme__hdg1">'.$title.'</h4>
					</div>
					';
				}

				if($i%$perrow==0){
					if($i != 0){
						echo '</div><!-- /.grid-ibx__row -->';
						echo '<div class="grid-ibx__row clearfix">';
					}
				}
			?>
				<div class="grid-ibx__item grid-ibx__item--type-<?php echo $icon_type; ?>">
					<?php
						// Add a hack for the lined gradient box
						if($this->opt('ibg_style','lined-full') == 'lined-gradient'){
							echo '<i class="grid-ibx__ghelper"></i>';
						}
					 ?>
					<div class="grid-ibx__item-inner">
						<?php

						echo $ibg_link['start'];

						// Display title
						if($titlefirst) echo $titlehtml;
						?>

						<?php if( !empty($theicon['unicode']) || !empty($icon_img) ){ ?>
						<div class="grid-ibx__icon-wrp">
						<?php
							// Icon Font
							if( $icon_type == 'icon'){
								if( !empty($theicon['unicode']) ){
									echo '<span class="grid-ibx__icon" '. zn_generate_icon( $theicon ) .'></span>';
								}
							}
							// Icon Image
							elseif ($icon_type == 'img'){
								if( !empty($icon_img) ){
									echo '<img class="grid-ibx__icon" src="' . $icon_img . '" '.ZngetImageSizesFromUrl($icon_img, true).' alt="'. ZngetImageAltFromUrl( $icon_img ) .'" title="'.ZngetImageTitleFromUrl( $icon_img ).'" />';
								}
							}
						?>
						</div>
						<?php } ?>

						<?php
						// Display title
						if(!$titlefirst) echo $titlehtml;
						?>

						<?php if($desc = $ib['ibg_desc']){ ?>
						<div class="grid-ibx__desc-wrp">
							<p class="grid-ibx__desc"><?php echo $desc; ?></p>
						</div>
						<?php } ?>

						<?php echo $ibg_link['end'];; ?>

					</div>
				</div><!-- /.grid-ibx__item -->
			<?php
			$i++;
			} // end foreach
		}
	?>

	</div><!-- /.grid-ibx__row -->
	</div>
</div><!-- /.grid-ibx -->

<?php

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{

		$uid = $this->data['uid'];

		$ibox = array(
			"name"           => __( "Icon Box", 'zn_framework' ),
			"description"    => __( "Add Icon Box.", 'zn_framework' ),
			"id"             => "ibg_ib",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Icon Box", 'zn_framework' ),
			"remove_text"    => __( "Icon Box", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "ibg_title",
			"subelements"    => array (

					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Title text.", 'zn_framework' ),
						"id"          => "ibg_title",
						"std"         => "",
						"type"        => "text"
					),

					array (
						"name"        => __( "Description", 'zn_framework' ),
						"description" => __( "Description text.", 'zn_framework' ),
						"id"          => "ibg_desc",
						"std"         => "",
						"type"        => "textarea"
					),

					array (
						"name"        => __( "Add link", 'zn_framework' ),
						"description" => __( "Add a link here. Will wrap the whole block.", 'zn_framework' ),
						"id"          => "ibg_link",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
					),

					array (
						"name"        => __( "Icon Type", 'zn_framework' ),
						"description" => __( "Type of the icon.", 'zn_framework' ),
						"id"          => "ibg_type",
						"std"         => "icon",
						"type"        => "select",
						"options"     => array (
							'icon' => __( 'Font Icon', 'zn_framework' ),
							'img' => __( 'Image (PNG, JPG, SVG or even GIF)', 'zn_framework' )
						),
					),

					array (
						"name"        => __( "Image Icon", 'zn_framework' ),
						"description" => __( "Upload an Icon Image.", 'zn_framework' ),
						"id"          => "ibg_image",
						"std"         => "",
						"type"        => "media",
						"dependency"  => array( 'element' => 'ibg_type' , 'value'=> array('img') ),
					),

					array (
						"name"        => __( "Select Icon", 'zn_framework' ),
						"description" => __( "Select an icon to display.", 'zn_framework' ),
						"id"          => "ibg_icon",
						"std"         => "",
						"type"        => "icon_list",
						'class'       => 'zn_full',
						"dependency"  => array( 'element' => 'ibg_type' , 'value'=> array('icon') ),
					),


				)
			);


		return array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Boxes Height", 'zn_framework' ),
						"description" => __( "Fixed height of the boxes, in px.", 'zn_framework' ),
						"id"          => "ibg_height",
						"std"         => "200",
						'type'        => 'slider',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '10',
							'max' => '800',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid .' .grid-ibx__item',
							'css_rule'  => 'height',
							'unit'      => 'px'
						),
					),
					array (
						"name"        => __( "Icon Size", 'zn_framework' ),
						"description" => __( "Select the size of the icon.", 'zn_framework' ),
						"id"          => "ibg_size",
						"std"         => "60",
						'type'        => 'slider',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '10',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid .' span.grid-ibx__icon',
							'css_rule'  => 'font-size',
							'unit'      => 'px'
						),
					),
					array (
						"name"        => __( "Icon Boxes per ROW", 'zn_framework' ),
						"description" => __( "Select how many icon boxes to appear per row.", 'zn_framework' ),
						"id"          => "ibg_perrow",
						"std"         => "3",
						"type"        => "select",
						"options"     => array (
							'1' => __( '1 icon box per row', 'zn_framework' ),
							'2' => __( '2 icon box per row', 'zn_framework' ),
							'3' => __( '3 icon box per row', 'zn_framework' ),
							'4' => __( '4 icon box per row', 'zn_framework' ),
							'5' => __( '5 icon box per row', 'zn_framework' ),
						),
					),
					array (
						"name"        => __( "Grid Style", 'zn_framework' ),
						"description" => __( "Select a style for the grid.", 'zn_framework' ),
						"id"          => "ibg_style",
						"std"         => "lined-full",
						"type"        => "select",
						"options"     => array (
							'' => __( 'Simple, no borders', 'zn_framework' ),
							'lined-full' => __( 'Fully Bordered', 'zn_framework' ),
							'lined-center' => __( 'Borders inside only', 'zn_framework' ),
							'lined-gradient' => __( 'Gradient Borders (Only with scale hover effect)', 'zn_framework' ),
						),
					),
					array (
						"name"        => __( "Hover Style", 'zn_framework' ),
						"description" => __( "Select the style should be applied on hover.", 'zn_framework' ),
						"id"          => "ibg_hover",
						"std"         => "shadow",
						"type"        => "select",
						"options"     => array (
							'grid-ibx--hover-shadow' => __( 'Shadow under the box', 'zn_framework' ),
							'grid-ibx--hover-scale' => __( 'Scale the box', 'zn_framework' ),
							'grid-ibx--hover-shadowscale' => __( 'Scale & Shadow', 'zn_framework' ),
						),
						'live'        => array(
							'type'      => 'class',
							'css_class' => '.'.$uid
						)
					),

					array (
						"name"        => __( "Title first?", 'zn_framework' ),
						"description" => __( "Display the title first?", 'zn_framework' ),
						"id"          => "ibg_titleorder",
						"std"         => "",
						"value"       => "1",
						"type"        => "toggle2",
					),
				),
			),
			'icons' => array(
				'title' => 'Icon boxes',
				'options' => array(
					$ibox,
				),
			),
			'colors' => array(
				'title' => 'Color options',
				'options' => array(
					array(
						'id'          => 'element_scheme',
						'name'        => 'Element Color Scheme',
						'description' => 'Select the color scheme of this element',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
							'light' => 'Light (default)',
							'dark' => 'Dark'
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'grid-ibx--theme-',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),
					array (
						"name"        => __( "Background Color", 'zn_framework' ),
						"description" => __( "Add a background color to the box.", 'zn_framework' ),
						"id"          => "ibg_bg_color",
						"std"         => "",
						"type"        => "colorpicker",
						'live'        => array(
							'type'      => 'css',
							'css_class' => '.'.$uid .' .grid-ibx__item',
							'css_rule'  => 'background-color',
							'unit'      => ''
						)
					),

					array (
						"name"        => __( "Background Hover Color", 'zn_framework' ),
						"description" => __( "Hover Color of the background.", 'zn_framework' ),
						"id"          => "ibg_bg_color_hover",
						"std"         => "",
						"type"        => "colorpicker",
					),

					array (
						"name"        => __( "Icon Color (Only for Icon Font)", 'zn_framework' ),
						"description" => __( "Color of the icon.", 'zn_framework' ),
						"id"          => "ibg_icon_color",
						"std"         => "",
						"type"        => "colorpicker",
						'live'        => array(
							'type'      => 'css',
							'css_class' => '.'.$uid .' .grid-ibx__icon',
							'css_rule'  => 'color',
							'unit'      => ''
						)
					),

					array (
						"name"        => __( "Icon Hover Color", 'zn_framework' ),
						"description" => __( "Hover Color of the icon.", 'zn_framework' ),
						"id"          => "ibg_icon_color_hover",
						"std"         => "",
						"type"        => "colorpicker",
					),

					array (
						"name"        => __( "Text Hover Color", 'zn_framework' ),
						"description" => __( "Force the hover color of the texts to change.", 'zn_framework' ),
						"id"          => "ibg_text_color_hover",
						"std"         => "",
						"type"        => "colorpicker",
					),
				),
			),
			'font' => array(
				'title' => 'Font options',
				'options' => array(
					array (
						"name"        => __( "Title settings", 'zn_framework' ),
						"description" => __( "Specify the typography properties for the title.", 'zn_framework' ),
						"id"          => "title_typo",
						"std"         => array (
							'font-size'   => '20px',
							'font-family'   => 'Open Sans',
							'line-height' => '30px',
							'font-style' => 'normal',
							'font-weight' => '400',
						),
						'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight' ),
						"type"        => "font",
						'live'        => array(
							'type'      => 'font',
							'css_class' => '.'.$uid.' .grid-ibx__title',
						),
					),
					array (
						"name"        => __( "Description text settings", 'zn_framework' ),
						"description" => __( "Specify the typography properties for the description text.", 'zn_framework' ),
						"id"          => "desc_typo",
						"std"         => array (
							'font-size'   => '13px',
							'font-family'   => 'Open Sans',
							'line-height' => '24px',
							'font-style' => 'normal',
							'font-weight' => '400',
						),
						'supports'   => array( 'size', 'font', 'style', 'line', 'weight', 'color' ),
						"type"        => "font",
						'live'        => array(
							'type'      => 'font',
							'css_class' => '.'.$uid.' .grid-ibx__desc',
						),
					),
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#MiAcyl85h3o',
				'docs'    => 'http://support.hogash.com/documentation/grid-image-boxes/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
	}
}
