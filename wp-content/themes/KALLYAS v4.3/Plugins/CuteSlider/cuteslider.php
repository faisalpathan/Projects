<?php

/**
 * @package Cute Slider WP
 * @version 1.1.18
 */
/*

Plugin Name: Cute Slider WP
Plugin URI: http://codecanyon.net/item/cute-slider-3d-2d-html5-image-slider/3046001
Description: 3D & 2D HTML5 Image Slider
Version: 1.1.18
Author: Averta and Kreatura Media
Author URI: http://codecanyon.net/user/kreatura/portfolio
*/

/********************************************************/
/*                        Actions                       */
/********************************************************/

	$GLOBALS['csPluginVersion'] = '1.1.18';
	$GLOBALS['csPluginPath'] = plugins_url('', __FILE__);

	// Activation hook for creating the initial DB table
	register_activation_hook(__FILE__, 'cuteslider_activation_scripts');

	// Run activation scripts when adding new sites to a multisite installation
	add_action('wpmu_new_blog', 'cuteslider_new_site');

	// Register custom settings menu
	add_action('admin_menu', 'cuteslider_settings_menu');

	// Link content resources
	add_action('wp_enqueue_scripts', 'cuteslider_enqueue_content_res');

	// Link admin resources
	add_action('admin_enqueue_scripts', 'cuteslider_enqueue_admin_res');

	// Help menu
	add_filter('contextual_help', 'cuteslider_help', 10, 3);

	// Preview
	add_action('init', 'cuteslider_load_preview');

	// Add shortcode
	add_shortcode("cuteslider","cuteslider_init");

	// Widget action
	add_action( 'widgets_init', create_function( '', 'register_widget("CuteSlider_Widget");' ) );

	// Load plugin locale
	add_action('plugins_loaded', 'cuteslider_load_lang');

	// Remove slider
	if(isset($_GET['page']) && $_GET['page'] == 'cuteslider' && isset($_GET['action']) && $_GET['action'] == 'remove') {
		add_action('admin_init', 'cuteslider_removeslider');
	}

	// Duplicate slider
	if(isset($_GET['page']) && $_GET['page'] == 'cuteslider' && isset($_GET['action']) && $_GET['action'] == 'duplicate') {
		add_action('admin_init', 'cuteslider_duplicateslider');
	}


/********************************************************/
/*                   CuteSlider locale                  */
/********************************************************/
function cuteslider_load_lang() {
	load_plugin_textdomain('CuteSlider', false, basename(dirname(__FILE__)) . '/languages/' );
}

/********************************************************/
/*             CuteSlider activation scripts            */
/********************************************************/

function cuteslider_activation_scripts() {

	// Multi-site
	if(is_multisite()) {

		// Get WPDB Object
		global $wpdb;

		// Get current site
		$old_site = $wpdb->blogid;

		// Get all sites
		$sites = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM $wpdb->blogs"));

		// Iterate over the sites
		foreach($sites as $site) {
			switch_to_blog($site);
			cuteslider_create_db_table();
		}

		// Switch back the old site
		switch_to_blog($old_site);

	// Single-site
	} else {
		cuteslider_create_db_table();
	}
}


/********************************************************/
/*            CuteSlider new site activation            */
/********************************************************/

function cuteslider_new_site($blog_id) {

    // Get WPDB Object
    global $wpdb;

    // Get current site
	$old_site = $wpdb->blogid;

	// Switch to new site
	switch_to_blog($blog_id);

	// Run activation scripts
	cuteslider_create_db_table();

	// Switch back the old site
	switch_to_blog($old_site);

}

/********************************************************/
/*            CuteSlider database table create          */
/********************************************************/

function cuteslider_create_db_table() {

	// Get WPDB Object
	global $wpdb;

	// Table name
	$table_name = $wpdb->prefix . "cuteslider";

	// Break when the table is already exists
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
		return;
	}

	// Building the query
	$sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
			  `id` int(10) NOT NULL AUTO_INCREMENT,
			  `name` varchar(100) NOT NULL,
			  `data` text NOT NULL,
			  `date_c` int(10) NOT NULL,
			  `date_m` int(11) NOT NULL,
			  `flag_hidden` tinyint(1) NOT NULL DEFAULT '0',
			  `flag_deleted` tinyint(1) NOT NULL DEFAULT '0',
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

	// Executing the query
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	// Execute the query
	dbDelta($sql);
}


/********************************************************/
/*               Enqueue Content Scripts                */
/********************************************************/

	function cuteslider_enqueue_content_res() {

	}


/********************************************************/
/*                Enqueue Admin Scripts                 */
/********************************************************/

	function cuteslider_enqueue_admin_res() {

		// CuteSlider
		if(strstr($_SERVER['REQUEST_URI'], 'cuteslider')) {

			// New in 3.5
			if(function_exists( 'wp_enqueue_media' )){
    			wp_enqueue_media();
    		}


			//wp_enqueue_script('media-upload');

			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');

			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-draggable');

			wp_enqueue_script('farbtastic');
			wp_enqueue_style('farbtastic');

			wp_enqueue_script('wp-pointer');
			wp_enqueue_style('wp-pointer');

			wp_enqueue_script('cuteslider_admin_js', $GLOBALS['csPluginPath'].'/js/admin.js', array('jquery'), '1.1.0' );
			wp_enqueue_style('cuteslider_admin_css', $GLOBALS['csPluginPath'].'/css/admin.css', array(), '1.1.0' );

			wp_enqueue_script('cuteslider_traionsition_gallery_3d', $GLOBALS['csPluginPath'].'/js/transition-dic.js', array('jquery'), '1.1.0' );
		}
	}


/********************************************************/
/*                 Loads settings menu                  */
/********************************************************/
function cuteslider_settings_menu() {

	// Menu hook
	global $cuteslider_hook;

	// Create new top-level menu
	$cuteslider_hook = add_menu_page('Cute Slider WP', 'Cute Slider WP', 'manage_options', 'cuteslider', 'cuteslider_router', $GLOBALS['csPluginPath'].'/img/icon_16x16.png');

	// Add sub-menus
	add_submenu_page('cuteslider', 'Cute Slider WP', __('All Sliders', 'CuteSlider'), 'manage_options', 'cuteslider', 'cuteslider_router');
	add_submenu_page('cuteslider', 'Add New Cute Slider', __('Add New', 'CuteSlider'), 'manage_options', 'cuteslider_add_new', 'cuteslider_add_new');
	add_submenu_page('cuteslider', 'Cute Slider WP Skin Editor', __('Skin Editor', 'CuteSlider'), 'manage_options', 'cuteslider_skin_editor', 'cuteslider_skin_editor');


	// Call register settings function
	add_action( 'admin_init', 'cuteslider_register_settings' );
}

/********************************************************/
/*                    Settings page                     */
/********************************************************/
function cuteslider_router() {

	// Add new
	if(isset($_GET['action']) && $_GET['action'] == 'add') {
		include(dirname(__FILE__).'/add.php');

	// Edit
	} elseif(isset($_GET['action']) && $_GET['action'] == 'edit') {
		include(dirname(__FILE__).'/edit.php');

	// List
	} else {
		include(dirname(__FILE__).'/list.php');
	}
}

function cuteslider_add_new() {
	include(dirname(__FILE__).'/add.php');
}

function cuteslider_skin_editor() {
	include(dirname(__FILE__).'/editor.php');
}

/********************************************************/
/*                        PREVIEW                       */
/********************************************************/

function cuteslider_load_preview() {

	// Product page
	if(isset($_GET['page']) && $_GET['page'] == 'cuteslider_preview') {

		if(file_exists( dirname( __FILE__ ) . '/preview.php')) {
			include( dirname( __FILE__ ) . '/preview.php') ;
			exit;
		}
	}
}

/********************************************************/
/*                  Register settings                   */
/********************************************************/
function cuteslider_register_settings() {

	// Add slider
	if(isset($_POST['posted_add']) && strstr($_SERVER['REQUEST_URI'], 'cuteslider')) {

		// Get WPDB Object
		global $wpdb;

		// Table name
		$table_name = $wpdb->prefix . "cuteslider";

		// Create new record
		if($_POST['layerkey'] == 0) {

			// Execute query
			$wpdb->query(
				$wpdb->prepare("INSERT INTO $table_name
									(name, data, date_c, date_m)
								VALUES (%s, %s, %d, %d)",
								'',
								'',
								time(),
								time()
								)
			);

			// Empty slider
			$slider = array();

			// ID
			$id = mysql_insert_id();
		} else {

			// Get slider
			$slider = $wpdb->get_row("SELECT * FROM $table_name ORDER BY id DESC LIMIT 1" , ARRAY_A);

			// ID
			$id = $slider['id'];

			$slider = json_decode($slider['data'], true);
		}

		// Add modifications
		if(isset($_POST['cuteslider-slides']['properties']['relativeurls'])) {
			$slider['properties'] = $_POST['cuteslider-slides']['properties'];
			$slider['layers'][ $_POST['layerkey'] ] = cuteslider_convert_urls($_POST['cuteslider-slides']['layers'][$_POST['layerkey']]);
		} else {
			$slider['properties'] = $_POST['cuteslider-slides']['properties'];
			$slider['layers'][ $_POST['layerkey'] ] = $_POST['cuteslider-slides']['layers'][$_POST['layerkey']];
		}

		// DB data
		$name = $wpdb->escape($slider['properties']['title']);
		$data = $wpdb->escape(json_encode($slider));

		// Update
		$wpdb->query("UPDATE $table_name SET
					name = '$name',
					data = '$data',
					date_m = '".time()."'
				  ORDER BY id DESC LIMIT 1");

		// Echo last ID for redirect
		echo $id;

		// Redirect back
		//header('Location: '.$_SERVER['REQUEST_URI'].'');
		die();
	}

	// Edit slider
	if(isset($_POST['posted_edit']) && strstr($_SERVER['REQUEST_URI'], 'cuteslider')) {

		// Get WPDB Object
		global $wpdb;

		// Table name
		$table_name = $wpdb->prefix . "cuteslider";

		// Get the IF of the slider
		$id = (int) $_GET['id'];

		// Get slider
		$slider = $wpdb->get_row("SELECT * FROM $table_name WHERE id = ".(int)$id." ORDER BY date_c DESC LIMIT 1" , ARRAY_A);
		$slider = json_decode($slider['data'], true);

		// Empty the slider
		if($_POST['layerkey'] == 0) {
			$slider = array();
		}

		// Add modifications
		if(isset($_POST['cuteslider-slides']['properties']['relativeurls'])) {
			$slider['properties'] = $_POST['cuteslider-slides']['properties'];
			$slider['layers'][ $_POST['layerkey'] ] = cuteslider_convert_urls($_POST['cuteslider-slides']['layers'][$_POST['layerkey']]);
		} else {
			$slider['properties'] = $_POST['cuteslider-slides']['properties'];
			$slider['layers'][ $_POST['layerkey'] ] = $_POST['cuteslider-slides']['layers'][$_POST['layerkey']];
		}

		// DB data
		$name = $wpdb->escape($slider['properties']['title']);
		$data = $wpdb->escape(json_encode($slider));

		// Update
		$wpdb->query("UPDATE $table_name SET
					name = '$name',
					data = '$data',
					date_m = '".time()."'
				  WHERE id = '$id' LIMIT 1");

		// Redirect back
		//header('Location: '.$_SERVER['REQUEST_URI'].'');
		die();
	}

	// Import settings
	if(isset($_POST['import']) && strstr($_SERVER['REQUEST_URI'], 'cuteslider')) {

		// Try to get slider data with JSON
		$import = json_decode(base64_decode($_POST['import']), true);

		// Invalid export code
		if(!is_array($import)) {

			// Try to get slider data with PHP unserialize
			$import = unserialize(base64_decode($_POST['import']));

			// Failed to extract the slider data, exit
			if(!is_array($import)) {
				header('Location: '.$_SERVER['REQUEST_URI'].'');
				die();
			}
		}

		// Get WPDB Object
		global $wpdb;

		// Table name
		$table_name = $wpdb->prefix . "cuteslider";

		// Iterate over imported sliders
		foreach($import as $item) {

			// Execute query
			$wpdb->query(
				$wpdb->prepare("INSERT INTO $table_name
									(name, data, date_c, date_m)
								VALUES (%s, %s, %d, %d)",
								$item['properties']['title'],
								json_encode($item),
								time(),
								time()
								)
			);
		}

		// Redirect back
		header('Location: '.$_SERVER['REQUEST_URI'].'');
		die();
	}


	// Skin Editor
	if(isset($_POST['posted_skin_editor']) && strstr($_SERVER['REQUEST_URI'], 'cuteslider')) {

		// GET SKIN
		if(isset($_GET['skin']) && !empty($_GET['skin'])) {
			$skin = $_GET['skin'];
		} else {

			// Open folder
			$files = scandir(dirname(__FILE__) . '/skins');

			// Iterate over the contents
			foreach($files as $entry) {
				if($entry == '.' || $entry == '..' || $entry == 'preview') {
					continue;
				} else {
					$skin = $entry;
					break;
				}
			}
		}

		// Get file path
		$file = dirname(__FILE__) . '/skins/' . $skin . '/style/slider-style.css';

		// Get content
		$content = stripslashes($_POST['contents']);

		// Write to file
		$status = @file_put_contents($file, $content);

		if(!$status) {
			wp_die(__("It looks like your files isn't writable, so PHP couldn't make any changes (CHMOD).", "CuteSlider"), __('Cannot write to file', 'CuteSlider'), array('back_link' => true) );
		} else {
			header('Location: admin.php?page=cuteslider_skin_editor&skin='.$skin.'&edited=1');
		}
	}

}

/********************************************************/
/*                   Cute Slider Help                   */
/********************************************************/
function cuteslider_help($contextual_help, $screen_id, $screen) {


	if(strstr($_SERVER['REQUEST_URI'], 'cuteslider')) {

		if(function_exists('file_get_contents')) {

			// List view
			if(!isset($_GET['action']) && $_GET['page'] != 'cuteslider_add_new') {

				// Overview
				$screen->add_help_tab(array(
				   'id' => 'home_overview',
				   'title' => 'Overview',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/home_overview.html')
				));

				// Managing sliders
				$screen->add_help_tab(array(
				   'id' => 'home_screen',
				   'title' => 'Managing sliders',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/managing_sliders.html')
				));

				// Insert Cute Slider to your page
				$screen->add_help_tab(array(
				   'id' => 'inserting_slider',
				   'title' => 'Insert Cute Slider to your page',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/inserting_slider.html')
				));

				// Export / Import
				$screen->add_help_tab(array(
				   'id' => 'exportimport',
				   'title' => 'Export / Import',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/exportimport.html')
				));

			// Editor view
			} else {

				// Overview
				$screen->add_help_tab(array(
				   'id' => 'overview',
				   'title' => 'Overview',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/edit_overview.html')
				));

				// Insert Cute Slider to your page
				$screen->add_help_tab(array(
				   'id' => 'inserting_slider',
				   'title' => 'Insert Cute Slider to your page',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/inserting_slider.html')
				));

				// Slide options
				$screen->add_help_tab(array(
				   'id' => 'slide_options',
				   'title' => 'Slide options',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/slide_options.html')
				));

				// Caption options
				$screen->add_help_tab(array(
				   'id' => 'caption_options',
				   'title' => 'Caption options',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/caption_options.html')
				));

				// WYSIWYG Editor
				$screen->add_help_tab(array(
				   'id' => 'wysiwyg_editor',
				   'title' => 'WYSIWYG Editor',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/wysiwyg_editor.html')
				));

				// Responsiveness
				$screen->add_help_tab(array(
				   'id' => 'responsiveness',
				   'title' => 'Responsiveness',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/responsiveness.html')
				));

				// Language support
				$screen->add_help_tab(array(
				   'id' => 'language_support',
				   'title' => 'Language support',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/language_support.html')
				));

				// Event callbacks
				$screen->add_help_tab(array(
				   'id' => 'event_callbacks',
				   'title' => 'Event callbacks',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/event_callbacks.html')
				));

				// Cute Slider API
				$screen->add_help_tab(array(
				   'id' => 'cuteslider_api',
				   'title' => 'Cute Slider API',
				   'content' => file_get_contents(dirname(__FILE__).'/docs/api.html')
				));
			}
		} else {

			// Error
			$screen->add_help_tab(array(
				'id' => 'error',
				'title' => 'Error',
				'content' => 'This help section couldn\'t show you the documentation because your server don\'t support the "file_get_contents" function'
			));
		}
	}
}

/********************************************************/
/*                   showCuteSlider                     */
/********************************************************/
function cuteslider($id = 0, $page = '') {

	// Check id
	if(!isset($id) || empty($id)) {
		echo '[Cute Slider WP] You need to specify the "id" parameter for the cuteslider() function call';
		return;
	}

	// Page filter
	if(isset($page) && !empty($page)) {

		// Get page name
		global $pagename;

		// Get page ID
		$pageid = (string) get_the_ID();

		// Get pages
		$pages = explode(',', $page);

		// Iterate over the pages
		foreach($pages as $page) {

			if($page == 'homepage' && is_front_page()) {
				echo cuteslider_init(array('id' => $id));

			} else if($pageid == $page) {
				echo cuteslider_init(array('id' => $id));
			} else if($pagename == $page) {
				echo cuteslider_init(array('id' => $id));
			}
		}


	// All pages
	} else {
		echo cuteslider_init(array('id' => $id));
	}
}

/********************************************************/
/*                  CuteSlider init                     */
/********************************************************/

function cuteslider_init($atts) {

	// ID check
	if(!isset($atts['id']) || empty($atts['id'])) {
		return '[Cute Slider WP] Invalid shortcode';
	}

	// Get slider ID
	$id = $atts['id'];

	// Get WPDB Object
	global $wpdb;

	// Table name
	$table_name = $wpdb->prefix . "cuteslider";

	// Get slider
	$slider = $wpdb->get_row("SELECT * FROM $table_name
								WHERE id = ".(int)$id." AND flag_hidden = '0'
								AND flag_deleted = '0'
								ORDER BY date_c DESC LIMIT 1" , ARRAY_A);

	// Result check
	if($slider == null) {
		return '[Cute Slider WP] Slider not found';
	}

	// Decode data
	$slider = json_decode($slider['data'], true);

	if(!defined('NL')) {
		define("NL", "\r\n");
	}

	if(!defined('TAB')) {
		define("TAB", "\t");
	}

	// Include slider file
	include(dirname(__FILE__).'/slider.php');

	wp_enqueue_script('modernizr_csl', $GLOBALS['csPluginPath'].'/js/modernizer.js', array(), '1.1.18' );
	// wp_enqueue_script('yepnope', $GLOBALS['csPluginPath'].'/js/yepnope-2.0.0.min.js', array(), '1.1.18' );
	wp_enqueue_script('cuteslider', $GLOBALS['csPluginPath'].'/js/cute.slider.js', array(), '1.1.18' );
	wp_enqueue_script('cuteslider_transitions', $GLOBALS['csPluginPath'].'/js/cute.transitions.all.js', array(), '1.1.18' );
	wp_enqueue_script('cuteslider_run', $GLOBALS['csPluginPath'].'/js/cute.run.js', array('cuteslider'), '1.1.18' );

	wp_enqueue_style('cuteslider', $GLOBALS['csPluginPath'].'/css/cuteslider.css', array(), '1.1.18' );
	wp_localize_script( 'cuteslider', 'CSSettings', array( 'pluginPath' => $GLOBALS['csPluginPath'] ) );

	// Return data
	return $data;
}

/********************************************************/
/*               Action to duplicate slider             */
/********************************************************/
function cuteslider_duplicateslider() {

	// Check ID
	if(!isset($_GET['id'])) {
		return;
	}

	// Get the ID of the slider
	$id = (int) $_GET['id'];

	// Get WPDB Object
	global $wpdb;

	// Table name
	$table_name = $wpdb->prefix . "cuteslider";

	// Get slider
	$slider = $wpdb->get_row("SELECT * FROM $table_name WHERE id = ".(int)$id." ORDER BY date_c DESC LIMIT 1" , ARRAY_A);
	$slider = json_decode($slider['data'], true);

	// Name check
	if(empty($slider['properties']['title'])) {
		$slider['properties']['title'] = 'Unnamed';
	}

	// Rename
	$slider['properties']['title'] .= ' copy';

	// Insert the duplicate
	$wpdb->query(
		$wpdb->prepare("INSERT INTO $table_name
							(name, data, date_c, date_m)
						VALUES (%s, %s, %d, %d)",
						$slider['properties']['title'],
						json_encode($slider),
						time(),
						time()
		)
	);

	// Success
	header('Location: admin.php?page=cuteslider');
	die();
}


/********************************************************/
/*                Action to remove slider               */
/********************************************************/
function cuteslider_removeslider() {

	// Check ID
	if(!isset($_GET['id'])) {
		return;
	}

	// Get the ID of the slider
	$id = (int) $_GET['id'];

	// Get WPDB Object
	global $wpdb;

	// Table name
	$table_name = $wpdb->prefix . "cuteslider";

	// Remove the slider
	$wpdb->query("UPDATE $table_name SET flag_deleted = '1' WHERE id = '$id' LIMIT 1");

	// Success
	header('Location: admin.php?page=cuteslider');
	die();
}

/********************************************************/
/*                        MISC                          */
/********************************************************/

function cuteslider_check_unit($str) {

	if( is_numeric($str) ) {
		return $str.'px';
	} else {
		return $str;
	}
}

function cuteslider_convert_urls($arr) {

	// Layer BG
	if(strpos($arr['properties']['image'], 'http://') !== false) {
		$arr['properties']['image'] = parse_url($arr['properties']['image'], PHP_URL_PATH);
	}

	// Layer Thumb
	if(strpos($arr['properties']['thumbnail'], 'http://') !== false) {
		$arr['properties']['thumbnail'] = parse_url($arr['properties']['thumbnail'], PHP_URL_PATH);
	}

	return $arr;
}


/********************************************************/
/*                   Widget settings                    */
/********************************************************/

class CuteSlider_Widget extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'cuteslider_widget', 'description' => __('Insert a slider with Cute Slider WP Widget', 'CuteSlider') );
		$control_ops = array( 'id_base' => 'cuteslider_widget' );
		parent::__construct( 'cuteslider_widget', __('Cute Slider WP Widget', 'CuteSlider'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );


		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		// Call cuteslider_init to show the slider
		echo do_shortcode('[cuteslider id="'.$instance['id'].'"]');

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['id'] = strip_tags( $new_instance['id'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {

		// Defaults
		$defaults = array( 'title' => __('Cute Slider', 'CuteSlider'));
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Get WPDB Object
		global $wpdb;

		// Table name
		$table_name = $wpdb->prefix . "cuteslider";

		// Get sliders
		$sliders = $wpdb->get_results( "SELECT * FROM $table_name
											WHERE flag_hidden = '0' AND flag_deleted = '0'
											ORDER BY date_c ASC LIMIT 100" );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e('Choose a slider:', 'CuteSlider') ?></label><br>
			<?php if($sliders != null && !empty($sliders)) { ?>
			<select id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>">
				<?php foreach($sliders as $item) : ?>
				<?php $name = empty($item->name) ? 'Unnamed' : $item->name; ?>
				<?php if(($item->id) == $instance['id']) { ?>
				<option value="<?php echo $item->id?>" selected="selected"><?php echo $name ?> | #<?php echo $item->id?></option>
				<?php } else { ?>
				<option value="<?php echo $item->id?>"><?php echo $name ?> | #<?php echo $item->id?></option>
				<?php } ?>
				<?php endforeach; ?>
			</select>
			<?php } else { ?>
			<?php _e("You didn't create any slider yet.", "CuteSlider") ?>
			<?php } ?>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'CuteSlider'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
	<?php
	}
}