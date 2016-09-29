<?php
/**
 * This file contains the core of the Plugin Framework
 *
 * @package    Hogash Plugin Framework
 * @author     Hogash - Balasa Sorin Stefan
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt
 * @version    1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

final class ZnHgPluginFramework{
	/**
	 * @var ZnHgPluginFramework The single instance of the class
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	public $version = '1.0.0';
	public $fw_path;
	public $fw_url;

	/**
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @return Main instance of class
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

		$this->fw_url  = untrailingslashit( plugins_url( '/', __FILE__ ) );
		$this->fw_path = dirname(__FILE__);

		$this->includes();



	}

	/**
	 * Includes all necesarry files for framework
	 */
	function includes(){
		if( $this->is_request( 'admin' ) ){
			require( $this->fw_path .'/includes/admin/class-admin.php' );
			$this->admin = new ZnHgPluginFrameworkAdmin();
		}
	}

	/**
	 * What type of request is this?
	 * string $type ajax, frontend or admin
	 * @return bool
	 */
	public function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'ajax' :
				return defined( 'DOING_AJAX' );
			case 'cron' :
				return defined( 'DOING_CRON' );
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

}

function ZNHG_PFW(){
	return ZnHgPluginFramework::instance();
}

ZNHG_PFW();