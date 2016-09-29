<?php
/**
 * Template Name: Left Sidebar Page Template
 *
 * @package WordPress
 * @subpackage prestro
 *
 */
get_header();
?>
<div class="container">
    <div class="row">

        <div id="primary" class="site-content col-md-9 col-sm-8 col-xs-12 col-sm-push-4 col-md-push-3 ">
            <div id="content" role="main">
                <?php if (have_posts()) : ?>

                    <?php /* Start the Loop */ ?>
                    <?php while (have_posts()) : the_post(); ?>

                        <?php
                        /* Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('template-parts/content', get_post_format());
                        ?>

                    <?php endwhile; ?>

                    <?php prestro_paging_nav(); ?>

                <?php else : ?>

                    <?php get_template_part('template-parts/content', 'none'); ?>

                <?php endif; ?>
            </div><!-- #content -->
        </div><!-- #primary -->
        <?php
        if (is_active_sidebar('sidebar-1')) :
            ?>
            <div id="secondary" class="widget-area col-md-3 col-sm-4 col-xs-12 col-sm-pull-8 col-md-pull-9" role="complementary">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </div><!-- #secondary -->
            <?php
        endif;
        ?>
    </div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>