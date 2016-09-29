<?php
/* The template for displaying Comments. */
global $wdwt_front;
?>

<div>
	
	<?php if (post_password_required()) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view any comments.', "business-elite"); ?></p>
	<?php return; } ?>

	<?php if (have_comments()) : ?>
		<h5 id="comments">
			<?php printf( _n('One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), "business-elite"),
			number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>'); ?>
		</h5>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="previous"><?php previous_comments_link(__( '&#8249; Older comments', "business-elite" )); ?></div><!-- end of .previous -->
				<div class="next"><?php next_comments_link(__( 'Newer comments &#8250;', "business-elite", 0 )); ?></div><!-- end of .next -->
			</div><!-- end of.navigation -->
		<?php endif; ?>
		
		
		<ol class="commentlist">
			<?php 
			wp_list_comments( array(
				'short_ping' => true,
				'avatar_size'=> 60,
			)); 
			?>
			<div class="clear"></div>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="previous"><?php previous_comments_link(__( '&#8249; Older comments', "business-elite" )); ?></div><!-- end of .previous -->
				<div class="next"><?php next_comments_link(__( 'Newer comments &#8250;', "business-elite", 0 )); ?></div><!-- end of .next -->
			</div><!-- end of.navigation -->
		<?php endif; ?>

	<?php else : ?>

	<?php endif; ?>

	<?php
	/* let's separate pings/trackbacks from comments */
	if (!empty($comments_by_type['pings'])) : 
		$count = count($comments_by_type['pings']);
		($count !== 1) ? $txt = __('Pings&#47;Trackbacks', "business-elite") : $txt = __('Pings&#47;Trackbacks', "business-elite"); ?>
		
		<h6 id="pings"><?php printf( __( '%1$d %2$s for "%3$s"', "business-elite" ), $count, $txt, get_the_title() )?></h6>

		<ol class="commentlist">
			<?php wp_list_comments('type=pings&max_depth=<em>'); ?>
		</ol>
	<?php endif; ?>

	
	<?php 
	if (comments_open()) : 
		$fields = array(
			'author' => '<span class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" placeholder="' . __('Name', "business-elite") . '" /></span>',
			'email' => '<span class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" placeholder="' . __('E-mail', "business-elite") . '" /></span>',
			'url' => '<span class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" placeholder="' . __('Website', "business-elite") . '" /></span>',
		);
		$defaults = array(
			'fields' => apply_filters('comment_form_default_fields', $fields),		
			'comment_field' => '<p class="comment-form-comment"> <textarea  placeholder="' . __('Comment', "business-elite") . '" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'
		);
		comment_form($defaults);
    endif;
	?>
	
</div>