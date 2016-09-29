<?php 
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 */

get_header();

?>

<div class="container">
    <div class="row">

        <?php TheNextFramework::DynamicSidebars('left'); ?>

        <div class="<?php TheNextFramework::ContentAreaWidth(); ?>">
            <div id="single-page-<?php the_ID(); ?>" class="single-page">

                <?php while (have_posts()): the_post(); ?>

                    <div <?php post_class('post'); ?>>
                        <div class="clear"></div>
                        <?php do_action("thenext_before_content"); ?>
                        <div class="entry-content">
                            <?php wpeden_post_thumb(array(1100, 0), true, array('class' => 'single-page-thumbnail')); ?>
                            <?php the_content(); ?>
                        </div>
                        <?php wp_link_pages(); ?>
                        <?php do_action("thenext_after_content"); ?>
                    </div>
                    <div class="mx_comments">
                        <?php comments_template(); ?>
                    </div>

                <?php endwhile; ?>

            </div>
        </div>

        <?php TheNextFramework::DynamicSidebars('right'); ?>

    </div>
</div>


<?php
get_footer();
