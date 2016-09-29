<?php
/*
 * Search Template File
 */
get_header();
$page_title_area = get_theme_mod('page_title_area');

if($page_title_area != 2) : ?>
<div class="heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="title mobile_article">
                    <b> <?php _e('Search results for : ', 'bizzboss'); echo get_search_query(); ?> </b>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
<div class="page-title-area"></div>
<?php endif; ?>

<?php if (have_posts()) : ?>
 	<?php get_template_part('content'); ?>
 <?php else : ?>
 	<div class="container">
        <div class="row my_blog">
			<div class="row">
            	<div class="col-md-12 col-sm-12 col-xs-12 admin">
					<p class="spage">
						<?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords', 'bizzboss'); ?>.</p> 
					    <?php get_search_form(); ?>
					</p>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php get_footer(); ?>