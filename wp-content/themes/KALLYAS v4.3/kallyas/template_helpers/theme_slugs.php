<?php if(! defined('ABSPATH')){ return; }

//<editor-fold desc="::: PERMALINK SETTINGS FOR PORTFOLIO AND DOCUMENTATION">
add_action( 'admin_init', 'zn_permalink_settings_init' );
function zn_permalink_settings_init()
{
	// Add a section to the permalinks page
	add_settings_section( 'zn-portfolio-permalink', 'Portfolio Slugs', '', 'permalink' );
	add_settings_section( 'zn-doc-permalink', 'Documentation Slugs', '', 'permalink' );

	// Add our settings
	add_settings_field(
		'zn_portfolio_item_slug_input', // id
		'Portfolio item slug',    // setting title
		'zn_portfolio_item_slug',  // display callback
		'permalink',               // settings page
		'zn-portfolio-permalink'   // settings section
	);

	// Add our settings
	add_settings_field(
		'zn_portfolio_taxonomy_slug_input', // id
		'Portfolio taxonomy slug',    // setting title
		'zn_portfolio_taxonomy_slug',  // display callback
		'permalink',                   // settings page
		'zn-portfolio-permalink'       // settings section
	);

	// Add our settings
	add_settings_field(
		'zn_doc_item_slug_input',        // id
		'Documentation taxonomy slug',    // setting title
		'zn_doc_item_slug',  // display callback
		'permalink',         // settings page
		'zn-doc-permalink'   // settings section
	);

	// Add our settings
	add_settings_field(
		'zn_doc_taxonomy_slug_input',   // id
		'Documentation taxonomy slug',  // setting title
		'zn_doc_taxonomy_slug',  // display callback
		'permalink',             // settings page
		'zn-doc-permalink'       // settings section
	);
}


/*--------------------------------------------------------------------------------------------------
	Permalinks actual options
--------------------------------------------------------------------------------------------------*/
function zn_portfolio_item_slug()
{
	$permalinks = get_option( 'zn_permalinks' );
	?>
	<input name="zn_portfolio_item_slug_input" type="text" class="regular-text code"
		   value="<?php if ( isset( $permalinks['port_item'] ) ) {
			   echo esc_attr( $permalinks['port_item'] );
		   } ?>" placeholder="portfolio"/>
<?php
}

function zn_portfolio_taxonomy_slug()
{
	$permalinks = get_option( 'zn_permalinks' );
	?>
	<input name="zn_portfolio_taxonomy_slug_input" type="text" class="regular-text code"
		   value="<?php if ( isset( $permalinks['port_tax'] ) ) {
			   echo esc_attr( $permalinks['port_tax'] );
		   } ?>" placeholder="project_category"/>
<?php
}

function zn_doc_item_slug()
{
	$permalinks = get_option( 'zn_permalinks' );
	?>
	<input name="zn_doc_item_slug_input" type="text" class="regular-text code"
		   value="<?php if ( isset( $permalinks['doc_item'] ) ) {
			   echo esc_attr( $permalinks['doc_item'] );
		   } ?>" placeholder="documentation"/>
<?php
}

function zn_doc_taxonomy_slug()
{
	$permalinks = get_option( 'zn_permalinks' );
	?>
	<input name="zn_doc_taxonomy_slug_input" type="text" class="regular-text code"
		   value="<?php if ( isset( $permalinks['doc_tax'] ) ) {
			   echo esc_attr( $permalinks['doc_tax'] );
		   } ?>" placeholder="documentation_category"/>
<?php
}


/*--------------------------------------------------------------------------------------------------
	Save the permalinks options
--------------------------------------------------------------------------------------------------*/
add_action( 'admin_init', 'zn_permalink_settings_save' );
function zn_permalink_settings_save()
{
	if ( ! is_admin() ) {
		return;
	}

	// We need to save the options ourselves; settings api does not trigger save for the permalinks page
	if ( isset( $_POST['permalink_structure'] ) || isset( $_POST['zn_portfolio_item_slug_input'] ) ) {
		// Portfolio items slug
		$zn_portfolio_item_slug_input     = sanitize_text_field( $_POST['zn_portfolio_item_slug_input'] );
		$zn_portfolio_taxonomy_slug_input = sanitize_text_field( $_POST['zn_portfolio_taxonomy_slug_input'] );

		// Documentation items slug
		$zn_doc_item_slug_input     = sanitize_text_field( $_POST['zn_doc_item_slug_input'] );
		$zn_doc_taxonomy_slug_input = sanitize_text_field( $_POST['zn_doc_taxonomy_slug_input'] );


		$permalinks = get_option( 'zn_permalinks' );
		if ( ! $permalinks ) {
			$permalinks = array();
		}

		$permalinks['port_item'] = untrailingslashit( $zn_portfolio_item_slug_input );
		$permalinks['port_tax']  = untrailingslashit( $zn_portfolio_taxonomy_slug_input );
		$permalinks['doc_item']  = untrailingslashit( $zn_doc_item_slug_input );
		$permalinks['doc_tax']   = untrailingslashit( $zn_doc_taxonomy_slug_input );

		update_option( 'zn_permalinks', $permalinks );
	}
}
//</editor-fold desc="::: PERMALINK SETTINGS FOR PORTFOLIO AND DOCUMENTATION">
