<?php get_header(); ?>

<div class="container">
    <div class="row">
        <?php TheNextFramework::DynamicSidebars('left'); ?>
        <div class="<?php TheNextFramework::ContentAreaWidth(); ?>">
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php

                while (have_posts()): the_post(); ?>

                    <div  <?php post_class('post'); ?>>


                        <?php if (get_post_format() == 'video') { ?>
                            <div class="thumbnail">

                                <?php
                                $meta = maybe_unserialize(get_post_meta(get_the_ID(), 'wpeden_post_meta', true));
                                echo wp_oembed_get($meta['videourl']);
                                ?>

                            </div>
                        <?php } else if (get_post_format() == 'gallery') { ?>

                            <?php //wpeden_post_gallery(900, 0); ?>

                        <?php } else {
                            wpeden_post_thumb(array(1100, 0), true, array('class' => 'single-post-thumbnail'));
                        } ?>
                        <div class="entry-content">
                            <?php if (get_post_format() == 'audio') echo do_shortcode('[audio]'); ?>
                            <?php the_content(); ?>
                        </div>
                        <?php wp_link_pages(); ?>
                        <div class="post-meta">
                            <ul class="meta-list">
                                <li>
                                    <span><?php _e('Posted on', 'the-next'); ?></span>
                                    <span class="black"><?php the_date(); ?></span>
                                </li>
                                <li>
                                    <span><?php _e('By', 'the-next'); ?></span>
                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
                                </li>
                                <li>
                                    <span><?php _e('In', 'the-next'); ?></span>
                                    <?php the_category('<span>,</span>'); ?>

                                </li>
                                <li class="post-navs">
                                    <span
                                        class="text-primary"><?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i> ' . __('Previous', 'the-next')); ?></span>
                                    <i class="fa fa-dot-circle-o"></i>
                                    <span><?php next_post_link('%link', __('Next', 'the-next') . ' <i class="fa fa-long-arrow-right"></i>'); ?></span>
                                </li>
                            </ul>

                        </div>
                        <div class="clear"></div>
                        <br/>

                        <div class="clear"></div>

                        <h3 class="widget-heading"><?php _e('Post Tags', 'the-next'); ?></h3>

                        <div class="post-author-info post-tags">
                            <?php the_tags('', ''); ?>
                            <div class="clear"></div>
                        </div>
                        <br/>

                        <h3 class="widget-heading"><?php _e('About The Author', 'the-next'); ?></h3>

                        <div class="post-author-info">

                            <div class="media">
                                <div class="pull-left">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 90); ?>
                                </div>
                                <div class="media-body">
                                    <span class="author-name"><?php echo get_the_author_meta('display_name'); ?></span>
                                    <div class="clear"></div>
                                    <?php echo get_the_author_meta('description'); ?>
                                </div>
                            </div>
                        </div>

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



<?php get_footer();
