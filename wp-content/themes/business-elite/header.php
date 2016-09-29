<?php  global $wdwt_front; ?>

<!DOCTYPE html>

<html  <?php language_attributes(); ?>>
	<head>
		<?php  wp_reset_query(); /* reset query for comment and other */ ?>
		
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="height=device-height,width=device-width" />
		<meta name="viewport" content="initial-scale=1.0" />
		<meta name="HandheldFriendly" content="true"/>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); /* wordpress standard scripts, meta, etc.. */   ?>
	</head>
	
	<body <?php body_class(); ?>>
	<?php

	
	?>
		<header>
			<div>
				<?php 
				$header_image = get_header_image();
				if(! empty($header_image)) {  ?>
						<a class="custom-header-a" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url(header_image()); ?>" class="custom-header">	
						</a>
				<?php } ?>
				<div class="clear"></div>	
			</div>
			
			<?php 	
			$fixed_menu = $wdwt_front->get_param('fixed_menu');
			if($fixed_menu=="on")
				$style_menu = "position: relative; z-index: 3; top: 0;";
			else	
				$style_menu = "z-index: 3; top: 0;"; 
			?>	
			
	<div id="header" style="<?php echo $style_menu; ?>">
		<div class="container">
	
			<?php  $wdwt_front->logo(); ?>

			<?php 
				$logo_type = $wdwt_front->get_param('logo_type');
				
			?>

			<div class="phone-menu-block">
				<nav id="top-nav">
					<div class="" style="width:100% !important;">
						<?php 
						$business_elite_show_home = true; 
						if(has_nav_menu( 'primary-menu')){
							$business_elite_show_home = false;
						}
						$wdwt_menu = wp_nav_menu(	array(
							'show_home' => $business_elite_show_home,
							'theme_location'  => 'primary-menu',
							'container'       => false,
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'top-nav-list',
							'menu_id'         => '',
							'echo'            => false,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="top-nav-list" class=" %2$s">%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''
						));
						echo $wdwt_menu;
						?>	
					</div>	
				</nav>				
			</div>
      <div class="clear"></div>
		</div>

	</div>
	<?php $wdwt_front->slideshow(); ?>