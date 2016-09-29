<?php
/**
 * The template for displaying Comments.
 *
 */
if ( post_password_required() )
    return; ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 admin">
        <?php wp_list_comments(array('avatar_size' => 110,'status' => 'approve', 'style' => 'div', 'short_ping' => true,)); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12 comment">
        <h5> 
            <?php comments_popup_link( __('No comments yet','bizzboss'), __('1 Comment','bizzboss'),__('% Comments','bizzboss'),'', __('Comments are disabled','bizzboss')); ?>
        </h5>
    </div>
    <div class="col-md-12 col-sm-12 leave_form">
        <?php comment_form(); ?>
    </div>
    <?php the_comments_navigation(); ?>
</div>