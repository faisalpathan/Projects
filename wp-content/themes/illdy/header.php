<?php
/**
 *    The template for displaying the header.
 *
 * @package    WordPress
 * @subpackage illdy
 */
?>
<?php
$logo                    = get_custom_logo();
$text_logo               = get_theme_mod( 'illdy_text_logo', get_bloginfo( 'name' ) );
$jumbotron_general_image = get_theme_mod( 'illdy_jumbotron_general_image', esc_url( get_template_directory_uri() . '/layout/images/front-page/front-page-header.png' ) );
$preloader_enable        = get_theme_mod( 'illdy_preloader_enable', 1 );

$style = '';

if ( get_option( 'show_on_front' ) == 'page' && is_front_page() ) {
	if ( $jumbotron_general_image ) {
		$style = 'background-image: url(' . esc_url( $jumbotron_general_image ) . ')';
	}
} else {
	$style = 'background-image: url(' . get_header_image() . ')';
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( $preloader_enable == 1 ): ?>
	<div class="pace-overlay"></div>
<?php endif; ?>
<header id="header" class="<?php if ( get_option( 'show_on_front' ) == 'page' && is_front_page() ): echo 'header-front-page';
else: echo 'header-blog'; endif; ?>" style="<?php echo $style ?>">
	<div class="top-header">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<?php if ( $logo ): ?>
						<?php echo $logo ?>
					<?php else: ?>
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="header-logo"><?php echo illdy_sanitize_html( $text_logo ); ?></a>
					<?php endif; ?>
				</div><!--/.col-sm-2-->
				<div class="col-sm-10">
					<nav class="header-navigation">
						<ul class="clearfix">
							<?php
							wp_nav_menu( array(
								'theme_location'  => 'primary-menu',
								'menu'            => '',
								'container'       => '',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => '',
								'menu_id'         => '',
								'items_wrap'      => '%3$s',
								'walker'          => new Illdy_Extended_Menu_Walker(),
								'fallback_cb'     => 'Illdy_Extended_Menu_Walker::fallback',
							) );
							?>
						</ul><!--/.clearfix-->
					</nav><!--/.header-navigation-->
					<button class="open-responsive-menu"><i class="fa fa-bars"></i></button>
				</div><!--/.col-sm-10-->
			</div><!--/.row-->
		</div><!--/.container-->
	</div><!--/.top-header-->
	<nav class="responsive-menu">
		<ul>
			<?php
			wp_nav_menu( array(
				'theme_location'  => 'primary-menu',
				'menu'            => '',
				'container'       => '',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => '',
				'menu_id'         => '',
				'items_wrap'      => '%3$s',
				'walker'          => new Illdy_Extended_Menu_Walker(),
				'fallback_cb'     => 'Illdy_Extended_Menu_Walker::fallback',
			) );
			?>
		</ul>
	</nav><!--/.responsive-menu-->
	<?php
	if ( get_option( 'show_on_front' ) == 'page' && is_front_page() ):
		get_template_part( 'sections/front-page', 'bottom-header' );
	else:
		get_template_part( 'sections/blog', 'bottom-header' );
	endif;
	?>
</header><!--/#header-->