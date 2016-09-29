<?php
/**
 * Template Name: Full width Page Template
 *
 * @package WordPress
 * @subpackage prestro
 *
 */
get_header();
?>
<div class="container">
    <div class="row">
        <div id="primary" class="site-content col-xs-12 col-sm-12 col-md-12">
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
    </div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>