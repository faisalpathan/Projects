<div class="container">
    <div class="row">

        <?php
        if (have_posts())
            get_template_part('loop', get_post_type());
        else {
            ?>

            <div class="col-md-12">
                <h2><?php _e('Nothing Found!', 'the-next'); ?></h2>
                <p><?php _e('Try Different Search Term', 'the-next'); ?></p>
            </div>

            <?php
        }
        ?>

    </div>
</div>