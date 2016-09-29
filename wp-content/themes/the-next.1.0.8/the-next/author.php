<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-8">
            <div class="row">
            <?php
            global $wp_query;
            $curauth = $wp_query->get_queried_object();
            $q = new WP_Query('post_type=post&posts_per_page=-1&author='.$curauth->ID);
            while($q->have_posts()): $q->the_post();
            ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="post-block">          
                        <a href="<?php the_permalink();?>"><?php wpeden_post_thumb(array(300,300)); ?></a>
                        <div class="post-info">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
            ?>
            </div>
        </div>
        <div class="col-md-3 col-sm-4">
            <div class="author-avatar">
                <?php echo get_avatar( $curauth->user_email, 300 ); ?>
                <div class="panel panel-theme panel-author">
                    <div class="panel-heading">
                        <?php echo $curauth->first_name." ".$curauth->last_name; ?>
                    </div>
                </div>
            </div>
            <?php dynamic_sidebar('author_page'); ?>
            <?php if ( get_user_meta($curauth->ID,  'description' , true) ) : ?>
            <div class="panel panel-theme panel-author">
                <div class="panel-heading"><?php _e('About','the-next');?></div>
                <div class="panel-body">
                    <?php echo get_user_meta($curauth->ID,  'description' , true); ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="panel panel-theme panel-author">
                <div class="panel-heading"><?php _e('Contact Author','the-next');?></div>
                <div class="panel-body">
                    <form method="post">
                        <input type="hidden" name="task" value="contact_author" />
                        <input type="hidden" name="uid" value="<?php echo $curauth->ID;?>" />

                        <label><?php _e('Your Name:', 'the-next'); ?></label>
                        <input type="text"  name="name" class="form-control" />
                        <label><?php _e('Your Email:', 'the-next'); ?></label>
                        <input type="text"  name="email" class="form-control"/>                           
                        <label><?php _e('Subject:', 'the-next'); ?></label>
                        <input type="text"  name="subject" class="form-control"/>                           
                        <label><?php _e('Message:', 'the-next'); ?></label>
                        <textarea class="form-control" name="message"></textarea>                            
                        <button class="btn btn-info"><?php _e('Submit', 'the-next'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer();
