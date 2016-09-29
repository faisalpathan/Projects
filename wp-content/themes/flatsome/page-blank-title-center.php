<?php
/*
Template name: Default Template (Center title)
*/
get_header(); 

?>

<?php if( has_excerpt() ) { ?>
<div class="page-header">
	<?php the_excerpt(); ?>
</div>
<?php } ?>

<div  class="page-wrapper page-title-center">
<div class="row">

<div id="content" class="large-12 columns" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
					<header class="entry-header text-center">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="tx-div medium"></div>
					</header>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

		<?php endwhile; // end of the loop. ?>


</div><!-- #content -->

</div><!-- .row -->
</div><!-- .page-wrapper -->

<?php get_footer(); ?>