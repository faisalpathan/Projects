<div class="container">
    <div class="row">

        <?php
        query_posts(array('post_type' => 'page', 's' => esc_attr($_GET['s'])));
        if (have_posts())
            get_template_part('loop', 'post');
        else {
            ?>

            <div class="col-md-12">
                <h2><?php _e('Nothing Found!', 'the-next'); ?></h2>
                <p><?php _e('Try Different Search Term', 'the-next'); ?></p>
            </div>

        <?php } ?>


    </div>
</div>