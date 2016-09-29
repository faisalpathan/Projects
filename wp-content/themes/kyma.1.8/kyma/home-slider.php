<?php
$kyma_theme_options = kyma_theme_options();
if ($kyma_theme_options['home_slider_enabled'] == 1){ ?>
	<div id="kyma_owl_slider" class="owl-carousel">
	<?php if(isset($kyma_theme_options['home_slider_posts']) && $kyma_theme_options['home_slider_posts'] != "") {
		$i = 1;
        foreach ($kyma_theme_options['home_slider_posts'] as $post_id) {
            $slider = get_post($post_id); ?>
            <div class="item">
            <?php echo get_the_post_thumbnail($slider->ID, 'kyma_slider_post', array('class' => 'img-responsive')); ?>
            <div class="owl_slider_con">
			<span class="owl_text_a">
			    <span>
					<span id="slide-title-<?php echo $i; ?>"><?php echo esc_attr($slider->post_title); ?></span>
			    </span>
			</span>
				<span class="owl_text_c"><span id="slide-subtitle-<?php echo $i; ?>"><?php echo esc_attr(wp_trim_words($slider->post_content, 8, '...')); ?></span></span>
				<span class="owl_text_d">
					<a id="slide-description-<?php echo $i; ?>" href="<?php echo esc_url(get_post_permalink($slider->ID)); ?>" target="_self" class="btn_a">
						<span><i class="in_left fa fa-link"></i><span><?php _e('Read More', 'kyma'); ?></span><i class="in_right fa fa-link"></i></span>
					</a>
				</span>
            </div>
            </div><?php
            $i++;
        } ?>
	<?php } else {
		for($i=1 ; $i<=3 ; $i++){ ?>
			<div class="item">
				<img src="<?php echo get_template_directory_uri(); ?>/images/slide1.jpg" alt="Slide Title">
				<div class="owl_slider_con">
					<span class="owl_text_a">
						<span>
							<span><?php _e('Kyma Theme IS The Best', 'kyma'); ?></span>
						<a href="#"><span><i class="fa fa-angle-right"></i></span></a>
						</span>
					</span>
					<span class="owl_text_c"><span><?php _e('Lorem Ipsum is simply dummy text of the printing and industry...', 'kyma'); ?></span></span>
					<span class="owl_text_d">
						<a href="#" target="_self" class="btn_a">
							<span><i class="in_left fa fa-link"></i><span><?php _e('Read More', 'kyma'); ?></span><i class="in_right fa fa-shopping-cart"></i></span>
						</a>
					</span>
				</div>
			</div>
			<?php } } ?>
	</div>	
<?php } ?>