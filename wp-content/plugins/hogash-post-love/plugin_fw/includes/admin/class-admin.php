<?php

class ZnHgPluginFrameworkAdmin{

	private $admin_menu = array();

	function __construct(){
		add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
	}

	function add_admin_menu( $id, $args ){
		$this->admin_menu[$id] = $args;
	}

	function admin_menu(){

		if( ! empty( $this->admin_menu ) ){
			$parent_slug = add_menu_page( 'Hogash Plugins', 'Hogash Plugins', 'manage_options', 'znhg_plugin_menu', NULL, '', '65' );

			foreach ( $this->admin_menu as $key => $value) {
				add_submenu_page(
					'znhg_plugin_menu',
					$value['page_title'],
					$value['menu_title'],
					$value['capability'],
					$value['menu_slug'],
					$value['callback']
				);
			}

			$this->remove_duplicate_submenu_page();
		}

	}

	function remove_duplicate_submenu_page(){
		remove_submenu_page( 'znhg_plugin_menu', 'znhg_plugin_menu' );
	}
}