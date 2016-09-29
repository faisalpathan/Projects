<?php
/**
 * The Template for previwing blocks
 *
 * @package flatsome
 */

global $woo_options;
global $woocommerce;
global $flatsome_opt;
show_admin_bar(false);
if ( !current_user_can( 'manage_options' ) ) die;
?>
<!DOCTYPE html>
<!--[if lte IE 9 ]><html class="ie lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> style="margin-top:0!important"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>

<?php if(isset($_GET['edit_block'])) { ?>
<body class="antialiased">
	<div id="wrapper">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php echo fixShortcode(get_the_content()); ?>
	<?php endwhile; // end of the loop. ?>
	</div>
</body>
<?php } else { ?> 
<body class="antialiased">
	<div id="wrapper" class="content-area" style="height:1px;">
		<div class="ux_block">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php echo fixShortcode(get_the_content()); ?>
			 <?php if (current_user_can('edit_posts')) {
			 $edit_link = get_edit_post_link( $post->ID ); 
			 echo '<a class="edit-link" target="_blank" href="'.$edit_link.'">Edit Block</a>';
			 } ?>
		<?php endwhile; // end of the loop. ?>
		</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php } ?>
<?php wp_footer(); ?>
<style>.demo_store{display: none!important} html{margin-top: 0px!important}</style>
</body>
</html>