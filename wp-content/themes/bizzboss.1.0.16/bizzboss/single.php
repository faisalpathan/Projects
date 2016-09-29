<?php
/*
* Single Post template file
*/
get_header();

$page_title_area = get_theme_mod('page_title_area');

if($page_title_area != 2): ?>
<div class="heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="title">
                    <b><?php the_title(); ?></b>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
<div class="page-title-area"></div>
<?php endif; ?>
<div class="page-content">
     <div class="container">
        <div class="row my_blog">
            <?php get_sidebar(); ?>
            <div class="col-md-9 col-sm-8 col-xs-12 main-post">
            	<?php while ( have_posts() ) : the_post(); ?>
                <div class="leather <?php if (is_sticky()){echo 'sticky';} ?> ">
                	<?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'bizzboss-blog-thumbnail-image', array( 'alt' => esc_attr(get_the_title()), 'class' => 'img-responsive') ); ?>
                	<?php endif; ?>
                    <h5><?php the_title(); ?></h5>
                    <?php bizzboss_entry_meta(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text">
							 <?php the_content(); ?>    
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <div class="comments-article">
                    <div class="clearfix"></div> 
                    <?php comments_template('', true); ?>
                </div>
        </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>