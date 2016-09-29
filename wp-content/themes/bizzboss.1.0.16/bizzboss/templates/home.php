<?php
/**
 * Template Name: Home
 *
  */
get_header(); ?>
<div class="page-title-area-full"></div>

<div class="page-content">                                 
    <div class="container">
        <div class="row my_blog">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'bizzboss-blog-thumbnail-image', array( 'alt' => esc_attr(get_the_title()), 'class' => 'img-responsive') ); ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>