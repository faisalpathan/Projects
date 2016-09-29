<?php
/*
Template name: Vertical Sub-nav
*/
get_header(); ?>

<div class="row">
<div class="large-12 columns" >

<div class="row collapse vertical-tabs">
<div class="large-3 columns">
	<h3 class="uppercase"><?php echo get_the_title($post->post_parent); ?></h3>
	 <?php 
    if ( is_page() && $post->post_parent )
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
	else
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
	if ( $childpages ) {
		$string = '<ul class="tabs-nav">' . $childpages . '</ul>';
	}

	echo $string;

	?>
</div><!-- .large-3 -->

<div class="large-9 columns">
	<div class="tabs-inner active">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->	

			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>
				
				<?php endwhile; // end of the loop. ?>
						
			</div>

	</div><!-- .tabs-inner -->
	</div><!-- .large-9 -->
</div><!-- .row .vertical-tabs -->
</div>
</div>
<?php get_footer(); ?>

