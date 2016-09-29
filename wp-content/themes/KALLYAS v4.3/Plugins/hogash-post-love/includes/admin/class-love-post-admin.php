<?php

class PostLoveHgAdmin{
	function __construct(){
		$this->register_menu();
		add_action( 'admin_enqueue_scripts', array( &$this, 'scripts' ) );
		add_action( 'wp_ajax_znhg_post_love_save', array( &$this, 'save_options' ) );
	}

	function scripts( $hook ){

		if ( 'hogash-plugins_page_post-love-options' != $hook ) {
			return;
		}

		wp_enqueue_style( 'plhg_main_style', plhg()->base_uri . '/assets/admin/css/plhg-style.css', array(), plhg()->version );
		wp_enqueue_script( 'plhg_main_js', plhg()->base_uri . '/assets/admin/js/admin.js', array('jquery-form'), plhg()->version, true );
	}

	function options_page(){
		include( dirname( __FILE__ ). '/options.php' );
	}

	function save_options(){

		$post_types = isset( $_POST['plhg_post_types'] ) ? $_POST['plhg_post_types'] : array();
		$allowed_voters = isset( $_POST['plhg_allowed_voters'] ) ? $_POST['plhg_allowed_voters'] : '';

		$options_to_save = array(
			'post_types' => $post_types,
			'allowed_voters' => $allowed_voters,
		);

		update_option( 'znhg_post_love_options', $options_to_save );

		wp_die();
	}

	function register_menu(){
		ZNHG_PFW()->admin->add_admin_menu(
			'postlove_hogash',
			array(
				'page_title' => __( 'Post Love', 'postlove_hogash' ),
				'menu_title' => __( 'Post Love', 'postlove_hogash' ),
				'capability' => 'manage_options',
				'menu_slug' => 'post-love-options',
				'callback' => array( $this, 'options_page' )
			)

		);
	}
}
new PostLoveHgAdmin();