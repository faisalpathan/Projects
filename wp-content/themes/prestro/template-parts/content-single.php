<?php
/**
 * @package prestro
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header page-header">

        <?php the_post_thumbnail('prestro-featured', array('class' => 'thumbnail')); ?>

        <h1 class="entry-title "><?php if(the_title( '', '', false ) !='') the_title(); else _e('Untitled','prestro');?></h1>

        <div class="entry-meta">
            <?php prestro_posted_on(); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'prestro'),
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'pagelink' => '%',
            'echo' => 1
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <?php
        /* translators: used between list items, there is a space after the comma */
        $category_list = get_the_category_list(esc_html__(', ', 'prestro'));

        /* translators: used between list items, there is a space after the comma */
        $tag_list = get_the_tag_list('', esc_html__(', ', 'prestro'));

        if (!prestro_categorized_blog()) {
            // This blog only has 1 category
            if ('' != $tag_list) {
                $meta_text = '<i class="fa fa-briefcase"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
            } else {
                $meta_text = '<i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
            }
        } else {
            // But this blog has loads of categories so we should probably display them
            if ('' != $tag_list) {
                $meta_text = '<i class="fa fa-briefcase"></i> %1$s <i class="fa fa-tags"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
            } else {
                $meta_text = '<i class="fa fa-briefcase"></i> %1$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
            }
        }

        printf(
                $meta_text, $category_list, $tag_list, get_permalink()
        );
        ?>

        <?php edit_post_link(esc_html__('Edit', 'prestro'), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>'); ?>
        <?php prestro_postview(get_the_ID()); ?>
        <hr class="section-divider">
    </footer><!-- .entry-meta -->
</article><!-- #post-## -->
