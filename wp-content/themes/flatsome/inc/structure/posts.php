<?php

/* BLOG - Add class to read more on blogs */
function flatsome_add_morelink_class( $link, $text )
{
    return str_replace(
         'more-link'
        ,'more-link button small'
        ,$link
    );
}
add_action( 'the_content_more_link', 'flatsome_add_morelink_class', 10, 2 );


/**
 * Display navigation to next/previous pages when applicable
 */
if ( ! function_exists( 'flatsome_content_nav' ) ) :

function flatsome_content_nav( $nav_id ) {
    global $wp_query, $post;

    // Don't print empty markup on single pages if there's nowhere to navigate.
    if ( is_single() ) {
        $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
        $next = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous )
            return;
    }

    // Don't print empty markup in archives if there's only one page.
    if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
        return;

    $nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

    ?>
    <nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
    <?php if ( is_single() ) : // navigation links for single posts ?>

        <?php previous_post_link( '<div class="nav-previous left">%link</div>', '<span class="icon-angle-left">' . _x( '', 'Previous post link', 'flatsome' ) . '</span> %title' ); ?>
        <?php next_post_link( '<div class="nav-next right">%link</div>', '%title <span class="icon-angle-right">' . _x( '', 'Next post link', 'flatsome' ) . '</span>' ); ?>

    <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

        <?php if ( get_next_posts_link() ) : ?>
        <div class="nav-previous"><?php next_posts_link( __( '<span class="icon-angle-left"></span> Older posts', 'flatsome' ) ); ?></div>
        <?php endif; ?>

        <?php if ( get_previous_posts_link() ) : ?>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="icon-angle-right"></span>', 'flatsome' ) ); ?></div>
        <?php endif; ?>

    <?php endif; ?>

    </nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
    <?php
}
endif; // flatsome_content_nav


if ( ! function_exists( 'flatsome_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function flatsome_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'flatsome' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'flatsome' ), '<span class="edit-link">', '<span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment-inner">

            <div class="row collapse">
                <div class="large-2 columns">
                    <div class="comment-author">
                    <?php echo get_avatar( $comment, 80 ); ?>
                </div>
                </div><!-- .large-3 -->

                <div class="large-10 columns">
                    <?php printf( __( '%s <span class="says">says:</span>', 'flatsome' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e( 'Your comment is awaiting moderation.', 'flatsome' ); ?></em>
                    <br />
                     <?php endif; ?>

                <div class="comment-content"><?php comment_text(); ?></div>


                 <div class="comment-meta commentmetadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
                    <?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'flatsome' ), get_comment_date(), get_comment_time() ); ?>
                    </time></a>
                    <?php edit_comment_link( __( 'Edit', 'flatsome' ), '<span class="edit-link">', '<span>' ); ?>
                    
                    <div class="reply right">
            <?php
                comment_reply_link( array_merge( $args,array(
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                ) ) );
            ?>
            </div><!-- .reply -->


                </div><!-- .comment-meta .commentmetadata -->

                </div><!-- .large-10 columns -->

            </div><!-- .row -->

		</article>
    <!-- #comment -->

	<?php
			break;
	endswitch;
}
endif; // ends check for flatsome_comment()

if ( ! function_exists( 'flatsome_posted_on' ) ) :

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function flatsome_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        esc_html_x( 'Posted on %s', 'post date', 'flatsome' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    $byline = sprintf(
        esc_html_x( 'by %s', 'post author', 'flatsome' ),
        '<span class="meta-author vcard author"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;



/* Filter in a link to a content ID attribute for the next/previous image links on image attachment pages */
function flatsome_enhanced_image_navigation( $url, $id ) {
  if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
    return $url;

  $image = get_post( $id );
  if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
    $url .= '#main';

  return $url;
}
add_filter( 'attachment_link', 'flatsome_enhanced_image_navigation', 10, 2 );
