<?php
/**
 * @package prestro
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header page-header">

        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php if(the_title( '', '', false ) !='') the_title(); else _e('Untitled','prestro');?></a></h1>

        <?php if ('post' == get_post_type()) : ?>
            <div class="entry-meta">
                <?php prestro_posted_on(); ?><?php if (!post_password_required() && ( comments_open() || '0' != get_comments_number() )) : ?>
                    <span class="comments-link"><i class="fa fa-comment-o"></i><?php comments_popup_link(esc_html__('Leave a comment', 'prestro'), esc_html__('1 Comment', 'prestro'), __('% Comments', 'prestro')); ?></span>
                <?php endif; ?>

                <?php if ('post' == get_post_type()) : // Hide category and tag text for pages on Search ?>
                    <?php
                    /* translators: used between list items, there is a space after the comma */
                    $categories_list = get_the_category_list(__(', ', 'prestro'));
                    if ($categories_list && prestro_categorized_blog()) :
                        ?>
                        <span class="cat-links"><i class="fa fa-briefcase"></i>
                            <?php printf(__(' %1$s', 'prestro'), $categories_list); ?>
                        </span>
                    <?php endif; // End if categories ?>
                <?php endif; // End if 'post' == get_post_type() ?>

                <?php edit_post_link(esc_html__('Edit', 'prestro'), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>'); ?>

            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php if (is_search()) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
            <p><a class="btn btn-default read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Continue reading', 'prestro'); ?> <i class="fa fa-chevron-right"></i></a></p>
        </div><!-- .entry-summary -->
    <?php else : ?>
        <div class="entry-content">
            <?php if ( has_post_thumbnail()) : ?>
            <div class="prestro_blog_image col-sm-6 col-md-6 col-xs-12">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		 	<?php the_post_thumbnail( 'prestro-featured', array( 'class' => 'thumbnail' )); ?>
		</a>
            </div>
            <div class="col-sm-6 col-md-6 col-xs-12">
                <?php the_excerpt(); ?>
            </div>
            <?php else : ?>
                <?php the_excerpt(); ?>
            <?php endif; ?>
            <p><a class="btn btn-default read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Continue reading', 'prestro'); ?> <i class="fa fa-chevron-right"></i></a></p>

            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"></a>


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
    <?php endif; ?>

    <hr class="section-divider">
</article><!-- #post-## -->
