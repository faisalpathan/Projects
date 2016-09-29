<?php $kyma_theme_options = kyma_theme_options(); ?>
<section class="content_section bg_gray">
    <div class="content row_spacer no_padding">
        <div class="main_title centered upper"><?php if ($kyma_theme_options['home_blog_title'] != "") { ?>
                <h2 id='blog-heading'><span class="line"><i
                        class="fa fa-edit"></i></span><?php echo esc_attr($kyma_theme_options['home_blog_title']); ?>
                </h2><?php
            }?>
        </div>
        <div class="rows_container clearfix">
            <div class="hm_blog_grid">
                <!-- Filter Content -->
                <div class="hm_filter_wrapper masonry_grid_posts three_blocks">
                    <ul class="hm_filter_wrapper_con masonry1"><?php
                        $count_posts = wp_count_posts();
                        $published_posts = $count_posts->publish;
                        if(isset($kyma_theme_options['home_post_cat'])){
						$cat = $kyma_theme_options['home_post_cat'];
						}
                        $args = array('post_type' => 'post', 'posts_per_page' => -1,'post__not_in' => get_option( 'sticky_posts' ), 'category__in'=>$cat);
                        query_posts($args);
                        if (query_posts($args)) {
                            $i = 1;
                            $j = 1;
                            while (have_posts()):the_post();
                                global $more;
                                $more = 0;
                                if (get_post_gallery()):
                                    $icon = 'fa fa-photo';
                                elseif (has_post_thumbnail()):
                                    $icon = 'fa fa-image';
                                endif;?>
                            <li class="filter_item_block animated" data-animation-delay="<?php echo 300 * $i; ?>"
                                id="row-<?php echo $j; ?>" data-animation="rotateInUpLeft">
                                <div class="blog_grid_block">
                                    <div class="feature_inner">
                                        <div class="feature_inner_corners">
                                            <?php
                                            if (get_post_gallery()) {
                                                $gallery = get_post_gallery(get_the_ID(), false);?>
                                                <div class="feature_inner_btns">
                                                    <a href="#" class="expand_image"><i class="fa fa-eye"></i></a>
                                                    <a href="<?php echo esc_url(get_the_permalink()); ?>"
                                                       class="icon_link"><i class="fa fa-link"></i></a>
                                                </div>
                                                <div class="porto_galla"><?php
                                                foreach ($gallery['src'] as $src) {
                                                    ?>
                                                <a title="<?php the_title_attribute(); ?>"
                                                   href="<?php echo esc_url($src); ?>" class="feature_inner_ling">
                                                    <img src="<?php echo esc_url($src); ?>"
                                                         alt="<?php the_title_attribute(); ?>">
                                                    </a><?php
                                                }
                                                if (has_post_thumbnail()) {
                                                    $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>
                                                <a href="<?php echo esc_url($url); ?>" class="feature_inner_ling"
                                                   data-rel="magnific-popup">
                                                    <?php the_post_thumbnail('kyma_home_post_image'); ?>
                                                    </a><?php } ?>
                                                </div><?php
                                            } elseif (has_post_thumbnail()) {
                                                $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                                                ?>
                                                <div class="feature_inner_btns">
                                                    <a href="<?php echo esc_url($url); ?>" class="expand_image"><i
                                                            class="fa fa-eye"></i></a>
                                                    <a href="<?php echo esc_url(get_the_permalink()); ?>"
                                                       class="icon_link"><i class="fa fa-link"></i></a>
                                                </div>
                                            <a href="<?php echo esc_url($url); ?>" class="feature_inner_ling"
                                               data-rel="magnific-popup">
                                                <?php the_post_thumbnail('kyma_home_post_image'); ?>
                                                </a><?php
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="blog_grid_con">
										<?php if (isset($icon) && $icon!='') { ?>
                                        <a href="123#" class="blog_grid_format"><i class="<?php echo esc_attr($icon); ?>"></i></a>
										<?php } ?>
                                        <h6 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
									<span class="meta">
										<span
                                            class="meta_part"><?php echo esc_attr(get_the_date(get_option('date_format'), get_the_ID())); ?></span>
										<span class="meta_slash">/</span>
										<span
                                            class="meta_part"><?php esc_url(comments_popup_link(__('No Comments', 'kyma'), __('1 Comment', 'kyma'), __('% Comments', 'kyma'))); ?> <?php esc_url(edit_post_link(__('Edit', 'kyma'), ' &#124; ', '')); ?></span>
										<span class="meta_slash">/</span>
										<span class="meta_part"><?php echo get_the_category_list(','); ?></span>
									</span>
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                                </li><?php $i != 3 ? $i++ : $i = 1;
                                if ($j % 3 == 0) {
                                    echo "<div class='clearfix'></div>";
                                }
                                $j++;
                            endwhile;
                        } ?>
                    </ul>
                </div>
                <!-- End Filter Content -->
                <div class="centered post-btn1">
                    <a class="btn_c append-button">
                        <span class="btn_c_ic_a"><i class="fa fa-repeat"></i></span>
                        <span class="btn_c_t"><?php _e('See More Posts', 'kyma'); ?></span>
                        <span class="btn_c_ic_b"><i class="fa fa-repeat"></i></span>
                    </a>
                </div>
            </div>
            <!-- End blog grid -->
        </div>
    </div>
</section>