<?php
/**
 * The Primary Sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Onefold
 */

?>
<?php
$default_sidebar = apply_filters( 'onefold_filter_default_sidebar_id', 'sidebar-1', 'primary' );
?>
<div id="sidebar-primary" class="widget-area sidebar" role="complementary">
	<?php if ( is_active_sidebar( $default_sidebar ) ) :  ?>
		<?php dynamic_sidebar( $default_sidebar ); ?>
	<?php else : ?>
		<?php
			/**
			 * Hook - onefold_action_default_sidebar.
			 */
			do_action( 'onefold_action_default_sidebar', $default_sidebar, 'primary' );
		?>
	<?php endif ?>
</div><!-- #sidebar-primary -->
