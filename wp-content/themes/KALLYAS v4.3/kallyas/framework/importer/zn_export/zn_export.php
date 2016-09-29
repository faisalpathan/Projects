<?php if(! defined('ABSPATH')){ return; }
/*
Plugin Name: Zn Export
Plugin URI: http://themefuzz.com/
Description: Custom export functions from Themefuzz
Version: 1.0
Author: Balasa Sorin Stefan
Author URI: http://themefuzz.com/
*/

//#! important
set_time_limit(0);



define( 'EXPORTER_URL', FW_URL.'/importer/zn_export' );
// define( EXPORTER_PATH, '' );

if(!defined('ABSPATH')) {
	die("Don't call this file directly.");
}

// require the base class
require('inc/ZN_ExportBase.php');
require('inc/ZN_ExportDemo.php');
require('inc/ZN_ImageManager.php');
require('inc/ZN_ImageManagerPost.php');



if ( ! class_exists( 'ZnExporter' ) ) {
	class ZnExporter
	{
		/**
		 * User's required capability to view or interact with this plugin
		 */
		const USER_CAP = 'edit_files';

		// Plugin's page
		private $plugin_page;

		public function __construct()
		{
			// Setup ajax action
			add_action('wp_ajax_ajax_demo_export', array($this, 'ajax_demo_export'));
			add_action('wp_ajax_ajax_update_posts', array($this, 'ajax_update_posts'));

			// Setup the download action - this will be trigger only if certain conditions are met
			// @see: $this->demo_export_download
			add_action('admin_init', array($this, 'demo_export_download'));

			// ADD our pages
			add_action( 'admin_menu', array( $this, 'zn_add_pages' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
		}

		/**
		 * This function will do the theme export and should only be triggered by ajax requests.
		 */
		function ajax_demo_export()
		{
			if( ! defined('DOING_AJAX')){
				wp_send_json_error(__('DOING_AJAX not defined', 'zn_framework'));
			}
			if( ! DOING_AJAX){
				wp_send_json_error(__('Not doing ajax', 'zn_framework'));
			}

			if( 'POST' != strtoupper($_SERVER['REQUEST_METHOD'])){
				wp_send_json_error(__('Invalid request method.', 'zn_framework'));
			}

			if( ! current_user_can(self::USER_CAP)){
				wp_send_json_error(__('You are not allowed to do this.', 'zn_framework'));
			}

			if(! wp_verify_nonce($_POST['security'], 'ZN_EXPORT_DEMO_CONTENT')){
				wp_send_json_error(__('Nonce is not valid', 'zn_framework'));
			}

			$demoDirName = '';
			if(isset($_POST['demo_dir_name'])){
				$demoDirName = trim(wp_strip_all_tags($_POST['demo_dir_name']));
			}

			$exporter = new ZN_ExportDemo( $demoDirName );

			$exporter->exportDemoData();

			if($exporter->hasErrors()){
				wp_send_json_error(
					array(
						'message' => __('Errors detected: '.var_export($exporter->getErrorMessages(),1),'zn_framework'),
						'file_name' => base64_encode( $exporter->getArchiveSavePath() )
					)
				);
			}
			elseif($exporter->hasMessages()){
				wp_send_json_error(
					array(
						'message' => 'The process completed but there were some warnings: '.var_export($exporter->getAllMessages(),1),
						'file_name' => base64_encode( $exporter->getArchiveSavePath() )
					)
				);
			}
			wp_send_json_success(base64_encode( $exporter->getArchiveSavePath() ));
		}

		function demo_export_download()
		{
			if (!isset($_GET['zn_nonce']) || !wp_verify_nonce($_GET['zn_nonce'], 'DOING_DOWNLOAD')) {
				return;
			}
			else {
				// process download
				if(! isset($_GET['f']) || empty($_GET['f'])){
					return;
				}
				$fp = base64_decode(trim($_GET['f']));
				if(is_file($fp))
				{
					$archive_file_name = basename($fp);
					header("Content-type: application/zip");
					header("Content-Disposition: attachment; filename=$archive_file_name");
					header("Pragma: no-cache");
					header("Expires: 0");
					readfile("$fp");
					@unlink($fp);
					exit;
				}
			}
		}

		function ajax_update_posts()
		{
			if( ! defined('DOING_AJAX')){
				wp_send_json_error(__('DOING_AJAX not defined', 'zn_framework'));
			}
			if( ! DOING_AJAX){
				wp_send_json_error(__('Not doing ajax', 'zn_framework'));
			}

			if( 'POST' != strtoupper($_SERVER['REQUEST_METHOD'])){
				wp_send_json_error(__('Invalid request method.', 'zn_framework'));
			}

			if( ! current_user_can(self::USER_CAP)){
				wp_send_json_error(__('You are not allowed to do this.', 'zn_framework'));
			}

			if(! wp_verify_nonce($_POST['security'], 'ZN_EXPORT_DEMO_CONTENT')){
				wp_send_json_error(__('Nonce is not valid', 'zn_framework'));
			}

			// Get info to update the references
			$oldURL = $newURL = '';
			if(! isset($_POST['old_url'])){
				wp_send_json_error(__('Old URL not sent.', 'zn_framework'));
			}
			else {
				$oldURL = trim(wp_strip_all_tags($_POST['old_url']));
			}
			if(! isset($_POST['new_url'])){
				wp_send_json_error(__('New URL not sent.', 'zn_framework'));
			}
			else {
				$newURL = trim(wp_strip_all_tags($_POST['new_url']));
			}

			if(empty($newURL)){
				wp_send_json_error(__('New URL cannot be empty.', 'zn_framework'));
			}

			$imageManager = ZN_ImageManager::getInstance();

			$posts = $imageManager->getPosts();
			if(empty($posts)){
				wp_send_json_error('No posts found');
			}

			global $wpdb;

			// Get the old image ID
			$oldImageID = $wpdb->get_var(
				$wpdb->prepare("SELECT ID FROM ".$wpdb->posts." WHERE guid = '%s'", $oldURL)
			);
			if(empty($oldImageID)){
				wp_send_json_error('Could not retrieve the old image ID');
			}
			// Get the new image ID
			$newImageID = $wpdb->get_var(
				$wpdb->prepare("SELECT ID FROM ".$wpdb->posts." WHERE guid = '%s'", $newURL)
			);
			if(empty($newImageID)){
				wp_send_json_error('Could not retrieve the new image ID');
			}

			$result = $imageManager->updatePosts( $oldImageID, $newImageID, $oldURL, $newURL );

			//
			wp_send_json_success(var_export($result,1));
		}

//<editor-fold desc=">>> INTERNALS">

		public function zn_add_pages()
		{
			// ADD the main plugin page
			$this->plugin_page = add_menu_page(
				'ZN Theme Demo', 'ZN Theme Demo', self::USER_CAP, 'zn-image-manager', array( $this, 'render_page_image_manager' )
			);
			$this->plugin_page = add_submenu_page(
				'zn-image-manager', 'Image Manager', 'Image Manager', self::USER_CAP, 'zn-image-manager', array( $this, 'render_page_image_manager' )
			);
			$this->plugin_page = add_submenu_page(
				'zn-image-manager', 'Demo Export', 'Demo Export', self::USER_CAP, 'zn-exporter', array( $this, 'render_page_export' )
			);
		}

		function render_page_image_manager()
		{
			if ( ! current_user_can( self::USER_CAP ) ){
				exit( "You don't have permissions to access this page." );
			}
			require( dirname(__FILE__).'/pages/images.php' );
		}

		// Render the export page
		public function render_page_export()
		{
			if ( ! current_user_can( self::USER_CAP ) ){
				exit( "You don't have permissions to access this page." );
			}
			?>

			<div class="wrap znexp-wrapper">
				<h2>Export Demo data</h2>

				<form method="post">

					<div class="zn-export-section">
						<label>Input demo name: </label>
						<input type="text" id="input_demo_name"/>
					</div>

					<div id="zn-export-ajax-info" class="zn-export-section"></div>

					<div class="zn-export-section">
						<input type="button" id="zn-export-button" value="Export and Download" class="button-primary"/>
					</div>
				</form>

			</div><!--//END: .znexp-wrapper -->

			<?php
		}


		public function load_scripts( $hook )
		{
			if ( ! isset($_REQUEST['page']) ||
				 ! in_array($_REQUEST['page'], array('zn-exporter', 'zn-image-manager')))
			{
				return;
			}

			   /* Register our stylesheet. */
			wp_enqueue_style( 'zn_export_styles', EXPORTER_URL.'/assets/css/style.css' );

			wp_enqueue_media();

			/* LOAD JAVASCRIPT */
			wp_enqueue_script('jquery-ui-accordion');
			wp_register_script( 'demo_export_js', EXPORTER_URL.'/assets/js/zn_script.js' );
			wp_localize_script('demo_export_js', 'ZN_EXPORT_LOCALE', array(
				'nonce' => wp_create_nonce('ZN_EXPORT_DEMO_CONTENT'),
				'nonce_url' => wp_nonce_url(
					admin_url('admin.php?page='.$_REQUEST['page']), 'DOING_DOWNLOAD','zn_nonce')
			));
			wp_enqueue_script( 'demo_export_js' );

		}
//</editor-fold desc=">>> INTERNALS">
	}
}
new ZnExporter;
