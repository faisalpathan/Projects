<?php
//Widget Popular Posts

class prestro_popular_posts_widget extends WP_Widget {

    function prestro_popular_posts_widget() {
        /* Widget setting. */
        $widget_ops = array('classname' => 'prestro_tabbed_widget', 'description' => __('Displays list of popular posts and recent posts', 'prestro'));

        /* Widget control settings. */
        $control_ops = array('width' => 250, 'height' => 350, 'id_base' => 'prestro_tabbed_widget');

        /* Create the widget. */
        parent::__construct('prestro_tabbed_widget', __('prestro Popular Posts Widget', 'prestro'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);

        /* Our variables from the widget settings. */
        $number = $instance['number'];
        ?>

        <div class="widget tabbed">
            <div class="tabs-wrapper">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#popular-posts" data-toggle="tab"><?php esc_attr_e('Popular', 'prestro'); ?></a></li>
                    <li><a href="#recent" data-toggle="tab"><?php esc_attr_e('Recent', 'prestro'); ?></a></li>
                </ul>

                <div class="tab-content">
                    <ul id="popular-posts" class="tab-pane active">

                        <?php
                        $recent_posts = new WP_Query(array('showposts' => $number, 'ignore_sticky_posts' => 1, 'post_status' => 'publish', 'order' => 'DESC', 'showposts' => $number, 'meta_key' => 'post_views_count', 'orderby' => 'meta_value'));
                        ?>

                        <?php while ($recent_posts->have_posts()): $recent_posts->the_post(); ?>
                            <li>
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php echo esc_url(get_permalink());?>" class="tab-thumb thumbnail" rel="bookmark" title="<?php the_title_attribute();?>">
                                        <?php the_post_thumbnail('tab-small'); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="content">
                                    <a class="tab-entry" href="<?php echo esc_url(get_permalink());?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    <i>
                                        <?php the_time(get_option( 'date_format' ))  ?>
                                    </i>
                                </div>
                            </li>
                        <?php endwhile; ?>

                    </ul>
                    <?php wp_reset_postdata(); ?>

                    <ul id="recent" class="tab-pane">

                        <?php
                        $recent_posts = new WP_Query(array('showposts' => $number, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
                        ?>

                        <?php while ($recent_posts->have_posts()): $recent_posts->the_post(); ?>
                            <li>
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php echo esc_url(get_permalink());?>" class="tab-thumb thumbnail" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail('tab-small'); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="content">
                                    <a class="tab-entry" href="<?php echo esc_url(get_permalink());?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    <i>
                                        <?php the_time(get_option( 'date_format' )) ?>
                                    </i>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>

        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['number'] = strip_tags($new_instance['number']);

        return $instance;
    }

    function form($instance) {

        /* Set up some default widget settings. */
        $defaults = array('number' => 3);
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e('Number of posts to show', 'prestro'); ?>:</label>
            <input id="<?php echo esc_html($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" value="<?php echo sanitize_text_field($instance['number']); ?>" size="3" />
        </p>

        <?php
    }

}
?>