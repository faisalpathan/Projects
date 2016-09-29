<div class="container">
    <div class="row my_blog">
        <?php get_sidebar(); ?>
        <div class="col-md-9 col-sm-8 col-xs-12">
            <?php while ( have_posts() ) : the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class( 'row blog-container' ); ?>>            	
                <?php if ( has_post_thumbnail() ) { ?>
                <div class="col-md-6 col-sm-12 col-xs-12 blog-img">
                    <?php the_post_thumbnail( 'bizzboss-thumbnail-image', array( 'alt' => esc_attr(get_the_title()), 'class' => 'img-responsive') ); ?>
                </div>
                
                <div class="col-md-6 col-sm-12 col-xs-12 blog-title">
                    <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
                    <div class="blog-info">
                        <?php bizzboss_entry_meta(); ?>
                    </div>
                    <div class="blog-subtitle"><?php the_excerpt(); ?></div>
                    

                    <?php wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bizzboss' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'bizzboss' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    ) ); ?>
                </div>
                <?php } else { ?>
                    <div class="col-md-12 col-sm-12 col-xs-12 blog-title">
                    <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
                    <div class="blog-info">
                        <?php bizzboss_entry_meta(); ?>
                    </div>
                    <div class="blog-subtitle"><?php the_excerpt(); ?></div>

                    <?php wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bizzboss' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'bizzboss' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    ) ); ?>
                </div>
                <?php } ?>
            </div>

            <?php endwhile;
            // Previous/next page navigation.
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'bizzboss' ),
                'next_text'          => __( 'Next page', 'bizzboss' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'bizzboss' ) . ' </span>',
            ) ); ?> 
        </div>
    </div>
</div>