

<div  <?php post_class('media'); ?>>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>&nbsp;</h2>

        <div class="video-player">
            <?php
            $meta = maybe_unserialize(get_post_meta(get_the_ID(),'wpeden_post_meta', true));
            echo wp_oembed_get(esc_url($meta['videourl'])); ?>
        </div>

        <?php the_excerpt(); ?>

    <div class="breadcrumb"><?php _e('Posted on', 'the-next'); ?> <?php echo get_the_date(); ?> / <?php _e('Posted by', 'the-next'); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> / <a href="<?php the_permalink();?>"><?php _e('read more', 'the-next'); ?> &#187;</a></div>
</div>