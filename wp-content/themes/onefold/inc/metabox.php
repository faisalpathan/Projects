<?php
/**
 * Implement theme metabox.
 *
 * @package Onefold
 */

if ( ! function_exists( 'onefold_add_theme_meta_box' ) ) :

	/**
	 * Add the Meta Box
	 *
	 * @since 1.0.0
	 */
	function onefold_add_theme_meta_box() {

		$apply_metabox_post_types = array( 'post', 'page' );

		foreach ( $apply_metabox_post_types as $key => $type ) {
			add_meta_box(
				'theme-settings',
				esc_html__( 'Theme Settings', 'onefold' ),
				'onefold_render_theme_settings_metabox',
				$type
			);
		}

	}

endif;

add_action( 'add_meta_boxes', 'onefold_add_theme_meta_box' );

if ( ! function_exists( 'onefold_render_theme_settings_metabox' ) ) :

	/**
	 * Render theme settings meta box.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Post $post    The current post.
	 * @param array   $metabox Metabox arguments.
	 */
	function onefold_render_theme_settings_metabox( $post, $metabox ) {

		$post_id = $post->ID;

		// Meta box nonce for verification.
		wp_nonce_field( basename( __FILE__ ), 'onefold_theme_settings_meta_box_nonce' );

		// Fetch values of current post meta.
		$values = get_post_meta( $post_id, 'onefold_theme_settings', true );
		$onefold_theme_settings_post_layout = isset( $values['post_layout'] ) ? esc_attr( $values['post_layout'] ) : '';
		$onefold_theme_settings_disable_banner_area = isset( $values['disable_banner_area'] ) ? esc_attr( $values['disable_banner_area'] ) : '';
		$onefold_theme_settings_single_image = isset( $values['single_image'] ) ? esc_attr( $values['single_image'] ) : '';
	?>
	<div id="onefold-settings-metabox-container" class="onefold-settings-metabox-container">
	  <ul>
	    <li><a href="#onefold-settings-metabox-tab-layout"><?php echo __( 'Layout', 'onefold' ); ?></a></li>
	    <li><a href="#onefold-settings-metabox-tab-header"><?php echo __( 'Header', 'onefold' ); ?></a></li>
	    <li><a href="#onefold-settings-metabox-tab-image"><?php echo __( 'Image', 'onefold' ); ?></a></li>
	  </ul>
	  <div id="onefold-settings-metabox-tab-layout">
	    <h4><?php echo __( 'Layout Settings', 'onefold' ); ?></h4>
	    <div class="onefold-row-content">
	    	<label for="onefold_theme_settings_post_layout"><?php echo esc_html__( 'Single Layout', 'onefold' ); ?></label>
	    	<?php
	    	$dropdown_args = array(
				'id'          => 'onefold_theme_settings_post_layout',
				'name'        => 'onefold_theme_settings[post_layout]',
				'selected'    => $onefold_theme_settings_post_layout,
				'add_default' => true,
	    		);
	    	onefold_render_select_dropdown( $dropdown_args, 'onefold_get_global_layout_options' );
	    	?>

	    </div><!-- .onefold-row-content -->

	  </div><!-- #onefold-settings-metabox-tab-layout -->

	  <div id="onefold-settings-metabox-tab-header">
	    <h4><?php echo __( 'Header Settings', 'onefold' ); ?></h4>
	    <div class="onefold-row-content">
	    	<label for="onefold_theme_settings_disable_banner_area"><?php echo esc_html__( 'Header Banner', 'onefold' ); ?></label>
	    	<input type="checkbox" name="onefold_theme_settings[disable_banner_area]" id="onefold_theme_settings_disable_banner_area" value="1" <?php checked( $onefold_theme_settings_disable_banner_area, '1' ); ?> />&nbsp;<span class="field-description"><?php _e( 'Check to Disable Header Banner', 'onefold' )?></span>
	    </div><!-- .onefold-row-content -->

	  </div><!-- #onefold-settings-metabox-tab-header -->

	  <div id="onefold-settings-metabox-tab-image">
		    <h4><?php echo __( 'Image Settings', 'onefold' ); ?></h4>
		    <div class="onefold-row-content">
			    <label for="onefold_theme_settings_single_image"><?php echo esc_html__( 'Image in Single Post/Page', 'onefold' ); ?></label>
	        	<?php
	        	$dropdown_args = array(
	    			'id'          => 'onefold_theme_settings_single_image',
	    			'name'        => 'onefold_theme_settings[single_image]',
	    			'selected'    => $onefold_theme_settings_single_image,
	    			'add_default' => true,
	        		);
	        	onefold_render_select_dropdown( $dropdown_args, 'onefold_get_image_sizes_options', array( 'add_disable' => true, 'allowed' => array( 'disable', 'large' ), 'show_dimension' => false ) );
	        	?>
		    </div><!-- .onefold-row-content -->

	  </div><!-- #onefold-settings-metabox-tab-image -->

	</div><!-- #onefold-settings-metabox-container -->

    <?php
	}

endif;



if ( ! function_exists( 'onefold_save_theme_settings_meta' ) ) :

	/**
	 * Save theme settings meta box value.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post Post object.
	 */
	function onefold_save_theme_settings_meta( $post_id, $post ) {

		// Verify nonce.
		if ( ! isset( $_POST['onefold_theme_settings_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['onefold_theme_settings_meta_box_nonce'], basename( __FILE__ ) ) ) {
			return;
		}

		// Bail if auto save or revision.
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check permission.
		if ( 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! array_filter( $_POST['onefold_theme_settings'] ) ) {
			// No value.
			delete_post_meta( $post_id, 'onefold_theme_settings' );
		} else {
			$meta_fields = array(
				'post_layout' => array(
					'type' => 'select',
					),
				'disable_banner_area' => array(
					'type' => 'checkbox',
					),
				'single_image' => array(
					'type' => 'select',
					),
				);

			$sanitized_values = array();
			foreach ( $_POST['onefold_theme_settings'] as $mk => $mv ) {

				if ( isset( $meta_fields[ $mk ]['type'] ) ) {
					switch ( $meta_fields[ $mk ]['type'] ) {
						case 'select':
							$sanitized_values[ $mk ] = esc_attr( $mv );
							break;
						case 'checkbox':
							$sanitized_values[ $mk ] = absint( $mv ) > 0 ? 1 : 0;
							break;
						default:
							$sanitized_values[ $mk ] = esc_attr( $mv );
							break;
					}
				} // End if.

			}
			update_post_meta( $post_id, 'onefold_theme_settings', $sanitized_values );
		}

	}

endif;

add_action( 'save_post', 'onefold_save_theme_settings_meta', 10, 3 );
