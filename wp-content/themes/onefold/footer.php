<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Onefold
 */

	/**
	 * Hook - onefold_action_after_content.
	 *
	 * @hooked onefold_content_end - 10
	 */
	do_action( 'onefold_action_after_content' );
?>

	<?php
	/**
	 * Hook - onefold_action_before_footer.
	 *
	 * @hooked onefold_add_footer_bottom_widget_area - 5
	 * @hooked onefold_footer_start - 10
	 */
	do_action( 'onefold_action_before_footer' );
	?>
    <?php
	  /**
	   * Hook - onefold_action_footer.
	   *
	   * @hooked onefold_footer_copyright - 10
	   */
	  do_action( 'onefold_action_footer' );
	?>
	<?php
	/**
	 * Hook - onefold_action_after_footer.
	 *
	 * @hooked onefold_footer_end - 10
	 */
	do_action( 'onefold_action_after_footer' );
	?>

<?php
	/**
	 * Hook - onefold_action_after.
	 *
	 * @hooked onefold_page_end - 10
	 * @hooked onefold_footer_goto_top - 20
	 */
	do_action( 'onefold_action_after' );
?>

<?php wp_footer(); ?>
</body>
</html>
