<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

final class PostLoveHg{
	/**
	 * @var PostLoveHg The single instance of the class
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	public $version;
	public $base_uri;
	public $base_path;
	public $factory = array();

	/**
	 *
	 * Ensures only one instance of PostLoveHg is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see hglp()
	 * @return PostLoveHg - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'postlove_hogash' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'postlove_hogash' ), '1.0.0' );
	}

	/**
	 * Class constructor
	 *
	 * @access public
	 */
	public function __construct() {

		// Set plugin data
		$this->version   = ZNHG_PLH_VERSION;
		$this->base_uri  = ZNHG_PLH_URL;
		$this->base_path = ZNHG_PLH_PATH;

		// Load plugin text domain
		load_plugin_textdomain( 'postlove_hogash', FALSE, $this->base_path . '/languages/' );

		// Actions and filters
		// add_action( 'init', array( &$this, 'init' ) );
		$this->init();
		// add_action( 'admin_enqueue_scripts', array( &$this, 'scripts' ) );

	}

	function init(){

		include $this->base_path . 'includes/frontend/frontend.php';
		$this->frontend = new PostLoveHgFrontend();

		if( ZNHG_PFW()->is_request( 'admin' ) ){
			include $this->base_path . 'includes/admin/class-love-post-admin.php';
		}

		do_action( 'plhg:init' );

	}

}

function plhg(){
	return PostLoveHg::instance();
}
plhg();

/**
 * Helper function for showing the love button
 * @return string The HTML markup of the love button
 */
function plhg_get_love_button(){
	return plhg()->frontend->get_love_button();
}