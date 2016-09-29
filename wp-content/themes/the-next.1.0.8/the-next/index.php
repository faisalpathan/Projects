<?php
if(is_home() && get_option('show_on_front') == 'posts')
    define('THENEXT_HIDE_PAGE_HEADER',1);

get_header(); ?>

<div class="container">
    <div class="row">
        <?php TheNextFramework::DynamicSidebars('left'); ?>
        <div class="<?php TheNextFramework::ContentAreaWidth(); ?>">

            <?php get_template_part('loop', get_post_type()); ?>

        </div>
        <?php TheNextFramework::DynamicSidebars('right'); ?>
    </div>
</div>

<?php get_footer(); 
