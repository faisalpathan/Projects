<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Onefold
 */

?><?php
	/**
	 * Hook - onefold_action_doctype.
	 *
	 * @hooked onefold_doctype -  10
	 */
	do_action( 'onefold_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - onefold_action_head.
	 *
	 * @hooked onefold_head -  10
	 */
	do_action( 'onefold_action_head' );
	?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	/**
	 * Hook - onefold_action_before.
	 *
	 * @hooked onefold_page_start - 10
	 * @hooked onefold_skip_to_content - 15
	 */
	do_action( 'onefold_action_before' );
	?>

    <?php
	  /**
	   * Hook - onefold_action_before_header.
	   *
	   * @hooked onefold_header_start - 10
	   */
	  do_action( 'onefold_action_before_header' );
	?>
		<?php
		/**
		 * Hook - onefold_action_header.
		 *
		 * @hooked onefold_site_branding - 10
		 */
		do_action( 'onefold_action_header' );
		?>
    <?php
	  /**
	   * Hook - onefold_action_after_header.
	   *
	   * @hooked onefold_header_end - 10
	   */
	  do_action( 'onefold_action_after_header' );
	?>

	<?php
	/**
	 * Hook - onefold_action_before_content.
	 *
	 * @hooked onefold_content_start - 10
	 */
	do_action( 'onefold_action_before_content' );
	?>
    <?php
	  /**
	   * Hook - onefold_action_content.
	   */
	  do_action( 'onefold_action_content' );
	?>
