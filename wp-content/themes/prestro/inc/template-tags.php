<?php
/**
 * Custom template tags for this theme.
 *
 * @package prestro
 */
if (!function_exists('prestro_paging_nav')) :

    function prestro_paging_nav() {
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        ?>
        <nav class="navigation paging-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php esc_html_e('Posts navigation', 'prestro'); ?></h1>
            <div class="nav-links">

                <?php if (get_next_posts_link()) : ?>
                    <div class="nav-previous"> <?php next_posts_link(__('<i class="fa fa-chevron-left"></i> Older posts', 'prestro')); ?></div>
                <?php endif; ?>

                <?php if (get_previous_posts_link()) : ?>
                    <div class="nav-next"><?php previous_posts_link(__('Newer posts <i class="fa fa-chevron-right"></i>', 'prestro')); ?> </div>
                <?php endif; ?>

            </div>
        </nav><!-- navigation -->
        <?php
    }

endif;

if (!function_exists('prestro_post_nav')) :

    /**
     * Display navigation to next/previous post when applicable.
     *
     * @return void
     */
    function prestro_post_nav() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
        $next = get_adjacent_post(false, '', false);

        if (!$next && !$previous) {
            return;
        }
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php esc_html_e('Post navigation', 'prestro'); ?></h1>
            <div class="nav-links">
                <?php
                previous_post_link('<div class="nav-previous">%link</div>', _x('<i class="fa fa-chevron-left"></i> %title', 'Previous post link', 'prestro'));
                next_post_link('<div class="nav-next">%link</div>', _x('%title <i class="fa fa-chevron-right"></i>', 'Next post link', 'prestro'));
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
        <?php
    }

endif;

if (!function_exists('prestro_comment')) :

    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function prestro_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;

        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) :
            ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                <div class="comment-body">
            <?php esc_html_e('Pingback:', 'prestro'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('Edit', 'prestro'), '<span class="edit-link">', '</span>'); ?>
                </div>

                        <?php else : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent' ); ?>>
                <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                    <footer class="comment-meta">
                        <div class="comment-author vcard">
            <?php if (0 != $args['avatar_size']) {
                echo get_avatar($comment, $args['avatar_size']);
            } ?>
            <?php printf(esc_html__('%s <span class="says">says:</span>', 'prestro'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?>
                        </div><!-- .comment-author -->

                        <div class="comment-metadata">
                            <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                <time datetime="<?php comment_time('c'); ?>">
                        <?php printf(esc_html_x('%1$s at %2$s', '1: date, 2: time', 'prestro'), get_comment_date(), get_comment_time()); ?>
                                </time>
                            </a>
            <?php edit_comment_link(__('Edit', 'prestro'), '<span class="edit-link">', '</span>'); ?>
                        </div><!-- .comment-metadata -->

            <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'prestro'); ?></p>
                    <?php endif; ?>
                    </footer><!-- .comment-meta -->

                    <div class="comment-content">
                    <?php comment_text(); ?>
                    </div><!-- .comment-content -->

                    <?php
                    comment_reply_link(array_merge($args, array(
                        'add_below' => 'div-comment',
                        'depth' => $depth,
                        'max_depth' => $args['max_depth'],
                        'before' => '<div class="reply">',
                        'after' => '</div>',
                    )));
                    ?>
                </article><!-- .comment-body -->

            <?php
            endif;
        }

    endif; // ends check for prestro_comment()

    if (!function_exists('prestro_posted_on')) :

        /**
         * Prints HTML with meta information for the current post-date/time and author.
         */
        function prestro_posted_on() {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
            if (get_the_time('U') !== get_the_modified_time('U')) {
                $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
            }

            $time_string = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date())
            );

            printf('<span class="posted-on"><i class="fa fa-calendar"></i> %1$s</span><span class="byline"> <i class="fa fa-user"></i> %2$s</span>', sprintf('<a href="%1$s" rel="bookmark">%2$s</a>', esc_url(get_permalink()), $time_string
                    ), sprintf('<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_html(get_the_author())
                    )
            );
        }

    endif;

    /**
     * Returns true if a blog has more than 1 category.
     */
    function prestro_categorized_blog() {
        if (false === ( $all_the_cool_cats = get_transient('all_the_cool_cats') )) {
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories(array(
                'hide_empty' => 1,
                    ));

            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count($all_the_cool_cats);

            set_transient('all_the_cool_cats', $all_the_cool_cats);
        }

        if ('1' != $all_the_cool_cats) {
            // This blog has more than 1 category so prestro_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so prestro_categorized_blog should return false.
            return false;
        }
    }

    /**
     * Flush out the transients used in prestro_categorized_blog.
     */
    function prestro_category_transient_flusher() {
        // Like, beat it. Dig?
        delete_transient('all_the_cool_cats');
    }

    add_action('edit_category', 'prestro_category_transient_flusher');
    add_action('save_post', 'prestro_category_transient_flusher');
    