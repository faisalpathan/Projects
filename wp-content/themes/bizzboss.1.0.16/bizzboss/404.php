<?php
/**
 * 404 page template file
 * */
get_header();

$page_title_area = get_theme_mod('page_title_area');

if($page_title_area != 2) : ?>
<div class="heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="title mobile_article">
                    <b><?php _e('404 - Article Not Found', 'bizzboss'); ?></b>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
<div class="page-title-area"></div>
<?php endif; ?>
<div class="container">
    <div class="row my_blog">
        <div class="col-md-12 col-sm-12 col-xs-12">
        	<div class="row blog-container">
                <div class="col-md-12 col-sm-12 col-xs-12 blog-title">
                    <div class="blog-subtitle">
                     	 <h5><?php _e('Epic 404 - Article Not Found', 'bizzboss'); ?></h5>
	                    <p>
	                    	<?php _e("This is embarassing. We can't find what you were looking for.", "bizzboss"); ?>
	                    </p>
                    	<p>
                    		<?php _e('Whatever you were looking for was not found, but maybe try looking again or search using the form below.', 'bizzboss'); ?>
                    	</p>
                    </div>
                    <?php get_search_form(); ?>	
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>