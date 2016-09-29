<?php
$hide_metadata = get_theme_mod('hide_metadata');
$post_selector_pseudo_query = $instance['blogPost'];
$postTypeSelected = $instance['blogPostSelect'];
// Process the post selector pseudo query.
$processed_query = siteorigin_widget_post_selector_process_query( $post_selector_pseudo_query );

// Use the processed post selector query to find posts.
$query_result = new WP_Query( $processed_query ); ?>
<?php if ($postTypeSelected == 'slider') : ?>
<div class="blog">
    <div id="owl-demo-latest-posts" class="owl-carousel owl-theme latest-posts">
        <?php
			if($query_result->have_posts()) :
			while($query_result->have_posts()) : $query_result->the_post();
			if ( has_post_thumbnail() ) : ?>
                <div class="col-md-12 col-sm-12 posts-image item">
                    <?php the_post_thumbnail( 'bizzboss-blog-slider-image', array( 'alt' => get_the_title(), 'class' => 'img-responsive') ); ?>
                        <div class="col-md-12 col-sm-12 slide-blog">
                            <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                            <p>
                                <?php echo get_the_excerpt(); ?>
                            </p>
                            <?php bizzboss_entry_meta(); ?>
                        </div>
                </div>
            <?php else : ?>
                <div class="col-md-12 col-sm-12 blog-thumb">
                    <h5><?php the_title(); ?></h5>
                    <p> <?php the_excerpt(); ?> </p>
                    <?php bizzboss_entry_meta(); ?>
                </div>
            <?php endif; ?>
            <?php wp_reset_postdata();
		endwhile; ?>
        <?php endif; ?>
    </div>
</div>
<?php else : ?>

<div class="col-md-12 col-sm-12">
<?php if($query_result->have_posts()) :
    while($query_result->have_posts()) : $query_result->the_post(); ?>
    <div class="blog-post">
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="col-md-3 col-sm-3 col-xs-12 blog_col_img">
                <a href="<?php esc_url(the_permalink()); ?>">
                    <?php the_post_thumbnail( 'bizzboss-blog-slider-image', array( 'alt' => get_the_title(), 'class' => 'img-responsive') ); ?>
                </a>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12 blog_col">
                <div class="blog-head">
                    <a href="<?php the_permalink(); ?>">
                        <h5><?php the_title(); ?></h5>
                    </a>
                </div>
                <?php bizzboss_entry_meta(); ?>
                <a class="<?php echo $hide_metadata; ?>" href="<?php the_permalink(); ?>"><?php _e('Read Article','bizzboss') ?></a>
            </div>
        <?php } ?>
    </div>
    <?php wp_reset_postdata(); endwhile; endif; ?>
</div>
<?php endif; ?>