<?php
/*
Widget Name: Key Feature widget
Description: Key Feature widget allows you to create fully customized key feature box for Bizzboss Pro theme.
Author: IndigoThemes
Author URI: https://indigothemes.com/
*/

class key_features_widget extends SiteOrigin_Widget {
	function __construct() {
		$keyFeatureIconColor   = '#'.sanitize_text_field(get_header_textcolor());
		$keyFeatureIconHoverBackgroundColor   = '#'.sanitize_text_field(get_header_textcolor());
		$keyFeatureIconHoverColor   = '#ffffff';
		parent::__construct(
			'key-features-widget',
			__('Key Feature widget', 'bizzboss'),
			array(
				'description' => __('Fully Customized Key Feature Box', 'bizzboss'),
			),
			array(

			),
			$form_options = array(
    			'keyFeatureTitle' => array(
	        		'type' => 'text',
	        		'label' => __('Title', 'bizzboss'),
	        		'sanitize' => 'sanitize_text_field'
	        		
			    ),
			    'keyFeatureDescription' => array(
	        		'type' => 'textarea',
	        		'label' => __('Description', 'bizzboss'),
	        		'sanitize' => 'sanitize_text_field'
			    ),
			    'keyFeatureLinktext' => array(
	        		'type' => 'text',
	        		'label' => __('Button Text', 'bizzboss'),
	        		'help' => __('Leave blank to hide button','bizzboss'),
	        		'sanitize' => 'sanitize_text_field'
			    ),
			    'keyFeatureLink' => array(
	        		'type' => 'text',
	        		'label' => __('Button Link', 'bizzboss'),
	        		'help' => __('Leave blank to hide button','bizzboss'),
	        		'sanitize' => 'sanitize_text_field'
			    ),
			    'keyFeatureTextAlignment' => array(
			        'type' => 'select',
			        'label' => __( 'Text Align', 'bizzboss'),
			        'default' => 'Select',
			        'options' => array(
			            'center' => __( 'Center Align', 'bizzboss' ),
			            'left' => __( 'Left Align', 'bizzboss' ),
			            'right' => __( 'Right Align', 'bizzboss' ),
			        ),
			        'sanitize' => 'sanitize_text_field'

			    ),
			    'keyFeatureTitleSection' => array(
			        'type' => 'section',
			        'label' => __( 'Title' , 'bizzboss' ),
			        'hide' => true,
			        'fields' => array(
			            'keyFeatureTitleColor' => array(
			                'type' => 'color',
			                'label' => __( 'Choose a Title Color', 'bizzboss' ),
			                'description' => __("*If you'll change the values here customizer will not work for this particular section!","bizzboss"),
			                'sanitize' => 'sanitize_text_field'
			            ),
						'keyFeatureTitleFontSize' => array(
							'type' => 'measurement',
							'label' => __( 'Size', 'bizzboss' ),
							'description' => __("*If you'll change the values here customizer will not work for this particular section!","bizzboss"),
							'sanitize' => 'sanitize_text_field'
						),
			            
			        )
			    ),
			    'keyFeatureDescriptionSection' => array(
			        'type' => 'section',
			        'label' => __( 'Descriptions' , 'bizzboss' ),
			        'hide' => true,
			        'fields' => array(
			            'keyFeatureDescriptionColor' => array(
			                'type' => 'color',
			                'label' => __( 'Choose a Text Color', 'bizzboss' ),
			                'description' => __("*If you'll change the values here customizer will not work for this particular section!","bizzboss"),
			                'sanitize' => 'sanitize_text_field'
			            ),
						'keyFeatureDescriptionFontSize' => array(
							'type' => 'measurement',
							'label' => __( 'Size', 'bizzboss' ),
							'description' => __("*If you'll change the values here customizer will not work for this particular section!","bizzboss"),
							'sanitize' => 'sanitize_text_field'
						),
			            
			        )
			    ),
			    'keyFeatureBoxSection' => array(
			        'type' => 'section',
			        'label' => __( 'Box Styling' , 'bizzboss' ),
			        'hide' => true,
			        'fields' => array(
			            'keyFeatureBoxBorderColor' => array(
			                'type' => 'color',
			                'label' => __( 'Choose a Border Color', 'bizzboss' ),
			                'sanitize' => 'sanitize_text_field'
			            ),
						'keyFeatureBoxBorderWidth' => array(
							'type' => 'measurement',
							'label' => __( 'Enter a Border Width', 'bizzboss' ),
							'sanitize' => 'sanitize_text_field'
						)
			        )
			    ),
			    'keyFeatureIconSection' => array(
			        'type' => 'section',
			        'label' => __( 'Icon' , 'bizzboss' ),
			        'hide' => true,
			        'fields' => array(
			        	'keyFeatureIcon' => array(
					        'type' => 'icon',
					        'label' => __('Select an icon', 'bizzboss'),
					        'sanitize' => 'sanitize_text_field'
					    ),
			            'keyFeatureIconColor' => array(
			                'type' => 'color',
			                'label' => __( 'Choose a Icon Color', 'bizzboss' ),
			                'default' => $keyFeatureIconColor,
			                'sanitize' => 'sanitize_text_field'
			            ),
			            'keyFeatureIconHoverBackgroundColor' => array(
			                'type' => 'color',
			                'label' => __( 'Choose a Icon Box Hover Background Color', 'bizzboss' ),
			                'default' => $keyFeatureIconHoverBackgroundColor,
			                'sanitize' => 'sanitize_text_field'
			            ),
			            'keyFeatureIconHoverColor' => array(
			                'type' => 'color',
			                'label' => __( 'Choose a Icon Hover Color', 'bizzboss' ),
			                'default' => $keyFeatureIconHoverColor,
			                'sanitize' => 'sanitize_text_field'
			            ),
						'keyFeatureIconSize' => array(
							'type' => 'measurement',
							'label' => __( 'Icon Size', 'bizzboss' ),
							'sanitize' => 'sanitize_text_field'
						),
						'keyFeatureIconBoxBorderColor' => array(
			                'type' => 'color',
			                'label' => __( 'Choose a Border Color', 'bizzboss' ),
			                'sanitize' => 'sanitize_text_field'
			            ),
						'keyFeatureIconBoxBorderWidth' => array(
							'type' => 'measurement',
							'label' => __( 'Enter a Border Width', 'bizzboss' ),
							'sanitize' => 'sanitize_text_field'
						),
						'keyFeatureIconBoxStyle' => array(
					        'type' => 'select',
					        'label' => __( 'Icon Box Shape', 'bizzboss' ),
					        'default' => 'Select',
					        'options' => array(
					            'square' => __( 'Sqaure Rounded', 'bizzboss' ),
					            'round' => __( 'Rounded', 'bizzboss' ),
					        ),
					        'sanitize' => 'sanitize_text_field'
					    ),
			        )
			    )
			),
			plugin_dir_path(__FILE__)
		);
	}

	function get_less_variables($instance){
		if( empty( $instance ) ) return array();
		return array(
			'keyFeatureTextAlignment' => isset( $instance['keyFeatureTextAlignment'] ) ? $instance['keyFeatureTextAlignment'] : '',
			'keyFeatureTitleColor' => isset( $instance['keyFeatureTitleSection']['keyFeatureTitleColor'] ) ? $instance['keyFeatureTitleSection']['keyFeatureTitleColor'] : '',
			'keyFeatureTitleFont' => isset( $instance['keyFeatureTitleSection']['keyFeatureTitleFont'] ) ? $instance['keyFeatureTitleSection']['keyFeatureTitleFont'] : '',
			'keyFeatureTitleFontSize' => isset( $instance['keyFeatureTitleSection']['keyFeatureTitleFontSize'] ) ? $instance['keyFeatureTitleSection']['keyFeatureTitleFontSize'] : '',
			'keyFeatureDescriptionColor' => isset( $instance['keyFeatureDescriptionSection']['keyFeatureDescriptionColor'] ) ? $instance['keyFeatureDescriptionSection']['keyFeatureDescriptionColor'] : '',
			'keyFeatureDescriptionFont' => isset( $instance['keyFeatureDescriptionSection']['keyFeatureDescriptionFont'] ) ? $instance['keyFeatureDescriptionSection']['keyFeatureDescriptionFont'] : '',
			'keyFeatureDescriptionFontSize' => isset( $instance['keyFeatureDescriptionSection']['keyFeatureDescriptionFontSize'] ) ? $instance['keyFeatureDescriptionSection']['keyFeatureDescriptionFontSize'] : '',
			'keyFeatureBoxBorderColor' => isset( $instance['keyFeatureBoxSection']['keyFeatureBoxBorderColor'] ) ? $instance['keyFeatureBoxSection']['keyFeatureBoxBorderColor'] : '',
			'keyFeatureBoxBorderWidth' => isset( $instance['keyFeatureBoxSection']['keyFeatureBoxBorderWidth'] ) ? $instance['keyFeatureBoxSection']['keyFeatureBoxBorderWidth'] : '',
			'keyFeatureIcon' => isset( $icons['keyFeatureIconSection']['keyFeatureIcon'] ) ? $icons['keyFeatureIconSection']['keyFeatureIcon'] : '',
			'keyFeatureIconColor' => isset( $instance['keyFeatureIconSection']['keyFeatureIconColor'] ) ? $instance['keyFeatureIconSection']['keyFeatureIconColor'] : '',
			'keyFeatureIconHoverBackgroundColor' => isset( $instance['keyFeatureIconSection']['keyFeatureIconHoverBackgroundColor'] ) ? $instance['keyFeatureIconSection']['keyFeatureIconHoverBackgroundColor'] : '',
			'keyFeatureIconHoverColor' => isset( $instance['keyFeatureIconSection']['keyFeatureIconHoverColor'] ) ? $instance['keyFeatureIconSection']['keyFeatureIconHoverColor'] : '',
			'keyFeatureIconSize' => isset( $instance['keyFeatureIconSection']['keyFeatureIconSize'] ) ? $instance['keyFeatureIconSection']['keyFeatureIconSize'] : '',
			'keyFeatureIconBoxBorderColor' => isset( $instance['keyFeatureIconSection']['keyFeatureIconBoxBorderColor'] ) ? $instance['keyFeatureIconSection']['keyFeatureIconBoxBorderColor'] : '',
			'keyFeatureIconBoxBorderWidth' => isset( $instance['keyFeatureIconSection']['keyFeatureIconBoxBorderWidth'] ) ? $instance['keyFeatureIconSection']['keyFeatureIconBoxBorderWidth'] : '',
		);
	}	
	function get_template_name($instance) {
		return 'key-feature-widget-template';
	}

	function get_style_name($instance) {
		return 'key-feature-widget-style';
	}


}

siteorigin_widget_register('key-features-widget', __FILE__, 'key_features_widget');