<?php
do_action("thenext_before_loop");

while (have_posts()): the_post();
    ?>
    <div class="archive-item">
        <?php get_template_part("content", get_post_format()); ?>
        <div class="clear"></div>
    </div>
<?php endwhile; ?>

<?php
global $wp_query;
if ($wp_query->max_num_pages > 1) :
    ?>
    <div class="clear"></div>
    <div id="nav-below" class="navigation post box arc">
        <?php get_template_part('pagination'); ?>
    </div>
<?php endif; ?>
<?php do_action("thenext_after_loop"); ?>
