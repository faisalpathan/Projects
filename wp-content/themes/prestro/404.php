<?php
/**
 * The template that displaying 404 pages (Not Found).
 *
 * @package prestro
 */
get_header();
?>
<div id="content" class="site-content container">
    <div id="primary" class="content-area col-sm-12 col-md-8">
        <main id="main" class="site-main" role="main">

            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'prestro'); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'prestro'); ?></p>

                    <?php get_search_form(); ?>

                    <?php the_widget('WP_Widget_Recent_Posts'); ?>

                    <?php if (prestro_categorized_blog()) : ?>
                        <div class="widget widget_categories">
                            <h2 class="widgettitle"><?php esc_html_e('Most Used Categories', 'prestro'); ?></h2>
                            <ul>
                                <?php
                                wp_list_categories(array(
                                    'orderby' => 'count',
                                    'order' => 'DESC',
                                    'show_count' => 1,
                                    'title_li' => '',
                                    'number' => 10,
                                ));
                                ?>
                            </ul>
                        </div><!-- .widget -->
                    <?php endif; ?>

                    <?php
                    /* translators: %1$s: smiley */
                    $archive_content = '<p>' . sprintf(sanitize_text_field(__('Try looking in the monthly archives. %1$s', 'prestro')), convert_smilies(':)')) . '</p>';
                    the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content");
                    ?>

                    <?php the_widget('WP_Widget_Tag_Cloud'); ?>

                </div>
            </section>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php get_footer(); ?>