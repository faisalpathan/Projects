<?php
/*
Template name: My Account Sidebar
This templates add My account to the sidebar. 
*/


get_header();

woocommerce_get_template('myaccount/header.php');

global $flatsome_opt;

?>

<?php if( has_excerpt() ) { ?>
<div class="page-header">
	<?php the_excerpt(); ?>
</div>
<?php } ?>

<div  class="page-wrapper my-account">
<div class="row">
<div id="content" class="large-12 columns" role="main">

<?php if(is_user_logged_in()){?> 

<div class="row collapse vertical-tabs">
<div class="large-3 columns">
	<?php if(is_user_logged_in()){?>
		<div class="account-user">
		<?php 
			 	$current_user = wp_get_current_user();
			 	$user_id = $current_user->ID;
				echo get_avatar( $user_id, 60 );
	    ?>

	    <span class="user-name"><?php echo $current_user->display_name?> <em><?php echo '#'.$user_id;?></em></span>
	   	<span class="logout-link"><a href="<?php echo wp_logout_url(); ?>"><?php _e('Logout','woocommerce'); ?></a></span>		 

	    <br>
	</div>
	<?php } ?>
	<div class="account-nav woocommerce-MyAccount-navigation">
		<ul class="tabs-nav">
			<?php if ( has_nav_menu( 'my_account' ) ) { ?>
				<?php  
					wp_nav_menu(array(
						'theme_location' => 'my_account',
						'menu_class'      => 'tabs-nav',
						'depth' => 0,
						'container' => false
					));
				?>
			<?php } else if(!function_exists('wc_get_account_menu_items')) { ?>
             <li>Define your My Account dropdown menu in <b>Appearance > Menus</b></li>
            <?php } ?>
            
		    <?php if(function_exists('wc_get_account_menu_items') && $flatsome_opt['wc_account_links']){ ?>
			    <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
					<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
						<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
					</li>
				<?php endforeach; ?>
			<?php } ?>
	    </ul>
	</div><!-- .account-nav -->
</div><!-- .large-3 -->

<div class="large-9 columns">
	<div class="tabs-inner active">		
	

			<?php while ( have_posts() ) : the_post(); ?>
				<h1><?php the_title(); ?></h1>

				<?php the_content(); ?>
			
			<?php endwhile; // end of the loop. ?>		


	</div><!-- .tabs-inner -->
	</div><!-- .large-9 -->
</div><!-- .row .vertical-tabs -->

<?php } else { ?>  
	
		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>
		
		<?php endwhile; // end of the loop. ?>		

<?php } ?>


</div><!-- end #content large-12 -->
</div><!-- end row -->
</div><!-- end page-right-sidebar container -->


<?php get_footer(); ?>

