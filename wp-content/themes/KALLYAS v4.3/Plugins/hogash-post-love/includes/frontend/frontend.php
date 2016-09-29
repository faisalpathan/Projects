<?php

class PostLoveHgFrontend{

	private static $_instance;

	function __construct(){
		// Keep a refference of the class
		self::$_instance = $this;

		add_filter( 'the_content', array( &$this, 'display_love_button' ), 100 );
		add_action( 'wp_enqueue_scripts', array( &$this, 'load_script' ) );
		add_action( 'wp_ajax_plhg_process_post_love', array( &$this, 'process_post_love' ) );
		add_action( 'wp_ajax_nopriv_plhg_process_post_love', array( &$this, 'process_post_love' ) );
	}

	public static function get_instance() {
		return self::$_instance;
	}

	public function load_script(){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'plhg-main-script', plhg()->base_uri . 'assets/frontend/js/script.js', array( 'jquery' ), plhg()->version );
		wp_enqueue_style( 'plhg-main-css', plhg()->base_uri . 'assets/frontend/css/plhg-styles.css', false, plhg()->version );
		wp_localize_script( 'plhg-main-script', 'plhg_script_vars',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'nonce' 		=> wp_create_nonce('plhg-nonce'),
				'error_message' => __('Sorry, there was a problem processing your request.', 'postlove_hogash')
			)
		);
	}


	public function process_post_love(){

		if( ! wp_verify_nonce( $_POST['plhg_nonce'], 'plhg-nonce') ){
			die('nonce error');
		}

		$post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : false;
		$user_id = isset( $_POST['user_id'] ) ? $_POST['user_id'] : false;

		// Check if the post id was provided and the current user can love
		if( ! empty( $post_id ) && $this->can_love( $user_id, $post_id ) ){
			if( $this->update_love_count( $post_id, $user_id ) ) {
				wp_send_json_success();
			}
			else{
				wp_send_json_error();
			}
		}

		wp_send_json_error();

	}

	// Shows the post love button
	public function display_love_button( $content ) {

		// We need to add an option for this instead of relying on a filter ?
		$saved_options    = get_option( 'znhg_post_love_options', array() );
		$saved_post_types = isset( $saved_options['post_types'] ) ? $saved_options['post_types'] : array( 'post' );

		if( is_singular( $saved_post_types ) ) {
			$content .= $this->get_love_button();
		}
		return $content;
	}

	/**
	 * Will return the love count for a specific post
	 * @return int the number of loves for that post
	 */
	public function get_love_count( $post_id ){
		$love_count = get_post_meta( $post_id, '_plhg_love_count', true );
		if($love_count)
			return $love_count;
		return 0;
	}

	/**
	 * Will update the love count for a specific post
	 * @return int the number of loves for that post
	 */
	public function update_love_count( $post_id, $user_id ){
		$love_count = get_post_meta( $post_id, '_plhg_love_count', true );
		$love_count = ! empty( $love_count ) ? $love_count + 1 : 1;

		// Save the new love count
		$updated = update_post_meta( $post_id, '_plhg_love_count', $love_count );
		if( $updated ){
			// Update the user data to disable loving again
			$this->update_user_loves( $user_id, $post_id );
			return true;
		}
		return false;
	}

	/**
	 * Updates the user meta after a post was liked if the options allows this
	 * @param  [type] $user_id [description]
	 * @param  [type] $post_id [description]
	 * @return [type]          [description]
	 */
	public function update_user_loves( $user_id, $post_id ){

		if( $user_id ){

			$loved = get_user_option('znhg_user_loves', $user_id);
			if(is_array($loved)) {
				$loved[] = $post_id;
			} else {
				$loved = array($post_id);
			}

			update_user_option($user_id, 'znhg_user_loves', $loved);

		}

		// Set a cookie
		setcookie('_zn_liked_'. $post_id, $post_id, time()+( 86400 * 30 ), '/');

	}

	/**
	 * Checks to see if the curren user / visitor can love a post
	 * @param  int $user_id The user id we should check
	 * @return [type]          [description]
	 */
	public function can_love( $user_id, $post_id ){

		// Check to see if the visitors are allowed to vote
		$saved_options        = get_option( 'znhg_post_love_options', array() );
		$saved_allowed_voters = isset( $saved_options['allowed_voters'] ) ? $saved_options['allowed_voters'] : 'anyone';

		// If user id is false, it means we have a visitor
		if( $user_id ){
			// Check the plugin options for allowed user types
			// Check if the user already voted
			$loved = get_user_option('znhg_user_loves', $user_id);
			if( is_array( $loved ) && in_array( $post_id, $loved ) ) {
				return false;
			}
		}
		elseif( $saved_allowed_voters === 'registered' ){
			return false;
		}
		elseif( $saved_allowed_voters === 'anyone' ){
			// If the visitor has already voted
			if ( isset( $_COOKIE[ '_zn_liked_' . $post_id ] ) ) {
				return false;
			}
		}

		return true;
	}


	/**
	 * Checks to see if we are allowed to show the love button for specific post type
	 * @return bool
	 */
	public function allowed_post_type( $post_id ){
		$saved_options    = get_option( 'znhg_post_love_options', array('post_types' => array('post')) );
		$saved_post_types = isset( $saved_options['post_types'] ) ? $saved_options['post_types'] : array();
		$post_type        = get_post_type( $post_id );

		return in_array($post_type, $saved_post_types);
	}

	/**
	 * Returns the HTML markup for the love button
	 * @return string the html markup for the love button
	 */
	public function get_love_button(){

		global $post, $user_ID;

		// Check to see if we are allowed to show the love button
		if( ! $this->allowed_post_type( $post->ID ) ){
			return false;
		}

		// Check if the user can love
		$can_love = $this->can_love( $user_ID, $post->ID );
		$is_loved_class = ! $can_love ? 'plhg-is-loved' : '';
		$love_button = '<div class="plhg-love-wrapper '.$is_loved_class.'">';

			if( $can_love ) {
				$love_button .= '<a href="#" class="plhg-love-action" data-post-id="' . esc_attr( $post->ID ) . '" data-user-id="' .  esc_attr( $user_ID ) . '">';
			}

			$love_button .= '<svg version="1.1" class="plhg-love-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 14 13" width="14" height="13">
					<path d="M14.219, 4.378c0, 1.229-0.636, 2.17-0.636, 2.17c-0.35, 0.516-0.979, 1.308-1.399, 1.759l-4.201, 4.511 c-0.42, 0.451-1.107, 0.451-1.527, 0L2.253, 8.307c-0.42-0.451-1.049-1.243-1.398-1.759c0, 0-0.636-0.94-0.636-2.17 c0-2.332, 1.76-4.222, 3.932-4.222c1.117, 0, 2.125, 0.5, 2.841, 1.303c0.079, 0.09, 0.079, 0.09, 0.079, 0.09c0.081, 0.104, 0.214, 0.104, 0.294, 0 c0, 0, 0, 0, 0.08-0.09c0.716-0.803, 1.725-1.303, 2.842-1.303C12.459, 0.156, 14.219, 2.046, 14.219, 4.378z"></path>
					</svg>';

			$love_button .= '<span class="plhg-love-count">';
				$love_button .= $this->get_love_count( $post->ID );
			$love_button .= '</span>';

			if( $can_love ) {
				$love_button .= '</a>';
			}


		$love_button .= '</div>';
		return $love_button;
	}

}