<?php if(! defined('ABSPATH')){ return; }

/**
 * This is the template layout for search results page.
 *
 * @package  Kallyas
 * @author   Team Hogash
 */

wp_enqueue_style( 'search-css', THEME_BASE_URI . '/css/pages/search.css', array('kallyas-styles'), ZN_FW_VERSION );

get_header();
/*** USE THE NEW HEADER FUNCTION **/
global $wp_query;
if ( !empty( $wp_query->found_posts ) ) {
    $title = $wp_query->found_posts . " " . __( 'search results for:', 'zn_framework' ) . " " .
             esc_attr( get_search_query() );
}
else {
    if ( !empty( $_GET['s'] ) ) {
        $title = __( 'Search results for:', 'zn_framework' ) . " " . esc_attr( get_search_query() );
    }
    else {
        $title = __( 'To search the site please enter a valid term', 'zn_framework' );
    }
}
WpkPageHelper::zn_get_subheader( array( 'title' => $title ) );
// Check to see if the page has a sidebar or not
$main_class = zn_get_sidebar_class( 'blog_sidebar' );
if ( strpos( $main_class, 'right_sidebar' ) !== false || strpos( $main_class, 'left_sidebar' ) !== false ) {
    $zn_config['sidebar'] = true;
}
else {
    $zn_config['sidebar'] = false;
}
$zn_config['size'] = $zn_config['sidebar'] ? 'col-sm-9' : 'col-sm-12';
?>
    <section id="content" class="site-content">

        <div class="container kl-searchpage">
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form-wrapper u-mb-30">
                        <div class="search gensearch__wrapper kl-gensearch--<?php echo zget_option( 'zn_main_style', 'color_options', false, 'light' ); ?>">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <!--// CONTENT -->
                <div class="<?php echo $main_class; ?>">
                    <?php $postCount = 0; ?>
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>

                            <div class="post kl-searchpage-post" id="post-<?php the_ID(); ?>">
                                <h1 class="title kl-searchpage-title">
                                    <a href="<?php the_permalink() ?>" rel="bookmark"
                                       title="<?php _e( 'Permanent Link to', 'zn_framework' ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                </h1>

                                <p class="meta kl-searchpage-meta">
                                    <small class="kl-searchpage-meta-inner">
									   <span class="kl-searchpage-meta-icon" data-zniconfam='glyphicons_halflingsregular' data-zn_icon="&#xe109;" aria-hidden="true"></span>
                                        <?php _e( 'Posted on', 'zn_framework' ); ?>
                                        <?php the_time( 'F jS, Y' ) ?>
                                        <?php _e( 'by', 'zn_framework' ); ?>
                                        <?php the_author() ?>
                                        <?php edit_post_link( 'Edit', ' | ', '' ); ?>
                                    </small>
                                </p>
                                <div class="entry kl-searchpage-entry">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="info kl-searchpage-info clearfix">
                                    <p class="links kl-searchpage-links"><?php comments_popup_link( 'No Comments', '1 Comment', '% Comments' ); ?></p>
                                    <?php if ( has_tag() ) { ?>
                                    <p class="tags kl-searchpage-tags"><?php the_tags( __( 'Tagged under: ', 'zn_framework' ), ', ', ' ' ); ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php $postCount++; ?>
                        <?php endwhile; ?>

                        <!-- Pagination -->
                        <div class="pagination--<?php echo zget_option( 'zn_main_style', 'color_options', false, 'light' ); ?>">
                            <?php zn_pagination(); ?>
                        </div>

                    <?php else : ?>
                        <h2 class="center kl-searchpage-nores"><?php _e( 'Nothing Found', 'zn_framework' ); ?></h2>
                        <p class="center kl-searchpage-nores-text"><?php _e( 'Sorry, nothing matched your search criteria.', 'zn_framework' ); ?></p>
                    <?php endif; ?>
                </div>
                <?php get_sidebar(); ?>
            </div>

            <?php if ( $postCount > 8 ) { ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="search-form-wrapper u-mb-30">
                            <div class="search gensearch__wrapper kl-gensearch--<?php echo zget_option( 'zn_main_style', 'color_options', false, 'light' ); ?>">
                                <?php get_search_form(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </section>
<?php get_footer();
