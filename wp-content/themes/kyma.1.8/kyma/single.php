<?php get_header(); ?>
    <!-- Page Title -->
<?php get_template_part('breadcrumbs'); ?>
    <!-- End Page Title -->
    <!-- Our Blog Grids -->
    <section class="content_section">
    <div class="content">
    <div class="internal_post_con clearfix"><?php
    $kyma_theme_options = kyma_theme_options();
	$img_class = array('class' => 'img-responsive');
    $post_layout = $kyma_theme_options['post_layout'];
    $imageSize = $post_layout == "fullwidth" ? 'kyma_single_post_full' : 'kyma_single_post_image';
    if ($post_layout == "postleft") {
        get_sidebar();
        $float = "f_right";
    } elseif ($post_layout == "postfull") {
        $float = "";
    } elseif ($post_layout == "postright") {
        $float = "f_left";
        $imageSize = 'kyma_single_post_image';
    } else {
        $float = "f_left";
    }
    if (get_post_gallery()):
		$icon = 'fa fa-photo';
	elseif (has_post_thumbnail()):
		$icon = 'fa fa-image';
	endif; ?>
    <!-- All Content --><?php
    if ($post_layout == "postleft" || $post_layout == "postright"){
    ?>
    <div class="content_block col-md-9 <?php echo esc_attr($float); ?> "><?php
    } ?>
    <div class="hm_blog_full_list hm_blog_list clearfix">
    <!-- Post Container --><?php
    if (have_posts()):
        while (have_posts()): the_post(); ?>
        <div id="<?php echo get_the_id(); ?>" <?php post_class('clearfix'); ?> >
            <div class="post_title_con">
                <h6 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
							<span class="meta">
								<span class="meta_part">
									<a href="#">
                                        <i class="fa fa-clock-o"></i>
                                        <span><?php echo esc_attr(get_the_date(get_option('date_format'), get_the_ID())); ?></span>
                                    </a>
								</span>
								<span class="meta_part">
									<a href="#">
                                        <i class="fa fa-comment-o"></i>
                                        <?php esc_url(comments_popup_link(__('No Comments', 'kyma'), __('1 Comment', 'kyma'), __('% Comments', 'kyma'))); ?> <?php esc_url(edit_post_link(__('Edit', 'kyma'), ' &#124; ', '')); ?>
                                    </a>
								</span>
                                <?php if (get_the_category_list() != '') { ?>
                                    <span class="meta_part">
										<i class="fa fa-folder-open-o"></i>
										<span><?php echo get_the_category_list(',', '', ''); ?></span>
									</span>
                                <?php } ?>
                                <span class="meta_part">
									<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                        <i class="fa fa-user"></i>
                                        <span><?php esc_attr(the_author()); ?></span>
                                    </a>
								</span>
							</span>
            </div>
			<?php if (isset($icon)) { ?>
			<div class="post_format_con">
				<span>
					<a href="#">
						<i class="<?php echo esc_attr($icon); ?>"></i>
					</a>
				</span>
			</div>
			<?php } ?>
            <div class="feature_inner">
                <div class="feature_inner_corners">
                    <?php $thumb = 0;
                    $url = '';
                    global $imageSize;
                    if (get_post_gallery()) {
                        $gallery = get_post_gallery(get_the_ID(), false);?>
                        <div class="porto_galla">
                            <?php foreach ($gallery['src'] as $src) { ?>
                                <a title="<?php the_title_attribute(); ?>" href="<?php echo esc_url($src); ?>"
                                   class="feature_inner_ling">
                                    <img class="img-responsive" src="<?php echo esc_url($src); ?>" alt="<?php esc_attr(the_title_attribute()); ?>">
                                </a>
                            <?php
                            }
                            if (has_post_thumbnail()) {
                                $thumb = 1;
                                $url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>
                                <a href="<?php echo esc_url($url); ?>" class="feature_inner_ling">
                                    <?php the_post_thumbnail($imageSize, $img_class); ?>
                                </a>
                            <?php } ?>
                        </div>
                    <?php
                    } elseif (has_post_thumbnail() && $thumb != 1) {
                        $url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>
                        <a href="<?php echo esc_url($url); ?>" title="<?php esc_attr(the_title_attribute()); ?>"
                           class="feature_inner_ling" data-rel="magnific-popup">
                            <?php the_post_thumbnail($imageSize, $img_class); ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="blog_grid_con">
                <?php the_content(); ?>
            </div>

            <!-- Next / Prev and Social Share-->
            <div class="post_next_prev_con clearfix">
                <!-- Next and Prev Post-->
                <div class="post_next_prev clearfix">
                    <?php next_post_link('%link', '<i class="fa fa-long-arrow-left"></i><span class="t">' . __('Previous Post', 'kyma') . '</span>'); ?>
                    <?php previous_post_link('%link', '<span class="t">' . __('Next', 'kyma') . '</span><i class="fa fa-long-arrow-right"></i>'); ?>
                </div>
                <!-- End Next and Prev Post-->

                <!-- Social Share-->
                <div class="single_pro_row">
                    <div id="share_on_socials">
                        <!-- <h6>Share:</h6> -->
                        <a class="facebook"
                           href="http://www.facebook.com/sharer.php?s=100&amp;p[url]=<?php echo home_url(); ?>&amp;p[title]=<?php echo get_the_title(); ?>q&amp;p[images[0]=<?PHP echo esc_url($url); ?>"
                           target="_blank"><i class="fa fa-facebook"></i></a>
                        <a class="twitter"
                           href="http://twitter.com/home?status=<?php echo get_the_title(); ?>+<?php echo home_url(); ?>"
                           target="_blank"><i class="fa fa-twitter"></i></a>
                        <a class="googleplus" href="https://plus.google.com/share?url=<?php echo home_url(); ?>"
                           target="_blank"><i class="fa fa-google-plus"></i></a>
                        <a class="pinterest"
                           href="http://pinterest.com/pin/create/bookmarklet/?media=<?PHP echo esc_url($url); ?>&amp;url=<?php echo home_url(); ?>&amp;is_video=false&amp;description=<?php echo get_the_title(); ?>"
                           target="_blank"><i class="fa fa-pinterest"></i></a>
                        <a class="linkedin"
                           href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?PHP echo esc_url($url); ?>&amp;title=<?php echo get_the_title(); ?>&amp;source=<?php echo home_url(); ?>"
                           target="_blank"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
                <!-- End Social Share-->
            </div>
            <!-- End Next / Prev and Social Share-->

            <!-- Tags -->
            <?php if (get_the_tag_list() != '') { ?>
                <div class="small_title">
							<span class="small_title_con">
								<span class="s_icon"><i class="fa fa-tags"></i></span>
								<span class="s_text"><?php _e('Tags', 'kyma'); ?></span>
							</span>
                </div>
                <div class="tags_con">
                    <?php esc_attr(the_tags('', '', '')); ?>
                </div>
            <?php } ?>
            <!-- End Tags -->

            <!-- About the author -->
            <div class="about_auther">
                <div class="small_title">
								<span class="small_title_con">
									<span class="s_icon"><i class="fa fa-user"></i></span>
									<span
                                        class="s_text"><?php echo esc_attr($kyma_theme_options['about_author_text']); ?></span>
								</span>
                </div>

                <div class="about_auther_con clearfix">
								<span class="avatar_img">
									<a href="<?php the_permalink(); ?>"><?php echo get_avatar(get_the_author_meta('ID'), 126); ?></a>
								</span>

                    <div class="about_auther_details">
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                           class="auther_link"><?php esc_attr(the_author()); ?></a>
									<span class="desc"><?php esc_attr(the_author_meta('description')); ?>
									</span>

                        <div class="social_media clearfix">
                            <a href="<?php esc_url(the_author_meta('twitter_profile')); ?>" target="_blank"
                               class="twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="<?php esc_url(the_author_meta('facebook_profile')); ?>" target="_blank"
                               class="facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="<?php esc_url(the_author_meta('google_profile')); ?>" target="_blank"
                               class="googleplus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                            <a href="<?php esc_url(the_author_meta('linkedin_profile')); ?>" target="_blank"
                               class="linkedin">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End About the author -->
            </div><?php
        endwhile;
    endif;?>
    <!-- End Post Container -->
    <!-- Related Posts --><?php
    $tags = wp_get_post_tags(get_the_ID());
    $num = sizeOf($tags);
    $tagarr = array();
    for ($i = 0; $i < $num; $i++) {
        $tagarr[$i] = $tags[$i]->term_id;
    }
    if ($tags) {
        $args = array(
            'tag__in' => $tagarr,
            'post__not_in' => array(get_the_ID()),
            'caller_get_posts' => 1
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            ?>
            <div class="related_posts">
            <div class="small_title">
							<span class="small_title_con">
								<span class="s_icon"><i class="ico-laptop4"></i></span>
								<span
                                    class="s_text"><?php echo esc_attr($kyma_theme_options['related_post_text']); ?></span>
							</span>
            </div>

            <div class="related_posts_con"><?php
                while ($query->have_posts()) {
                    $query->the_post();
                    if (get_post_gallery() || has_post_thumbnail()) {
                        $icon = "fa fa-image";
                    }?>
                    <div class="related_posts_slide">
                    <div class="related_img_con">
                        <a href="<?php the_permalink(); ?>" class="related_img">
                            <?php the_post_thumbnail('kyma_related_post_thumb', $img_class); ?>
                            <?php if (isset($icon)) { ?><span><i class="<?php echo esc_attr($icon); ?>"></i></span><?php } ?>
                        </a>
                    </div>
                    <a class="related_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <span
                            class="post_date"><?php echo esc_attr(get_the_date(get_option('date_format'), get_the_ID())); ?></span>
                    </div><?php
                } ?>
            </div>
            </div><?php
        }
    } ?>
    <!-- End Related Posts -->
    <!-- Comments Container -->
    <?php comments_template('', true); ?>
    <!-- End Comments Container -->
    </div>
    <?php if ($post_layout == "postleft" || $post_layout == "postright"){ ?>
    </div>
    <?php } ?>
    <!-- End blog List -->
    <?php if ($post_layout == "postright") {
        get_sidebar();
    } ?>
    </div>
    </div>
    </section>
    <!-- End All Content -->
<?php get_footer(); ?>