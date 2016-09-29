<div id="comments">
    <?php if (post_password_required()) : ?>
        <p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.','the-next'); ?></p>
</div>
    <?php
    return;
    endif;
    ?>
<br/>
<?php if (have_comments()) : ?>
    <h3 class="widget-heading"> <?php _e('Discussion','the-next');?></h3>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
        <nav id="comment-nav-above">
            <h1 class="assistive-text"><?php echo 'Comment navigation'; ?></h1>
            <div class="nav-previous"><?php previous_comments_link('&larr; Previous Comments'); ?></div>
            <div class="nav-next"><?php next_comments_link('Next Comments &rarr;'); ?></div>
        </nav>
    <?php endif; ?>

    <ul class="commentlist">
        <?php
        /* Loop through and list the comments. Tell wp_list_comments()
         * to use wpeden_comment() to format the comments.
         * If you want to overload this in a child theme then you can
         * define wpeden_comment() and that will be used instead.
         * See wpeden_comment() in edenfresh/functions.php for more.
         */
        wp_list_comments(array('callback' => 'TheNext::Comment', 'avatar_size' => 64, 'reply_text' => 'Reply'));
        ?>
    </ul>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
        <nav id="comment-nav-below">
            <h1 class="assistive-text"><?php echo 'Comment navigation'; ?></h1>
            <div class="nav-previous"><?php previous_comments_link('&larr; Older Comments'); ?></div>
            <div class="nav-next"><?php next_comments_link('Newer Comments &rarr;'); ?></div>
        </nav>
    <?php endif; ?>

    <?php
    elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) :
    ?>
    <p class="nocomments"><?php _e('Comments are closed.','the-next'); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>

</div><!-- #comments -->
