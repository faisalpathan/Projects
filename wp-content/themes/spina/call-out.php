<?php $kyma_theme_options = kyma_theme_options();
$spina_theme_options = spina_theme_options();
if (!$kyma_theme_options['callout_home']) return; ?>
<section id='callout' class="content_section white_section bg_color3">
    <div class="welcome_banner full_colored" style="">
		<div id='callout-two' class="content clearfix">
			<?php if ($kyma_theme_options['callout_title'] != "") { ?>
				<h3 id='callout-title'><?php echo esc_attr($kyma_theme_options['callout_title']); ?></h3>
			<?php }
			if ($kyma_theme_options['callout_description'] != "") { ?>
				<span class="intro_text"><?php echo esc_attr($kyma_theme_options['callout_description']); ?></span>
			<?php } ?>	
			<a href="<?php echo esc_url($kyma_theme_options['callout_btn_link']); ?>" target="_self"
			   class="btn_a">
				<span><i class="in_left <?php echo esc_attr($kyma_theme_options['callout_btn_icon']); ?>"></i><span><?php echo esc_attr($kyma_theme_options['callout_btn_text']); ?></span><i class="in_right <?php echo esc_attr($kyma_theme_options['callout_btn_icon']); ?>"></i></span>
			</a>
			<a href="<?php echo esc_url($spina_theme_options['callout_btn_one_link']); ?>" target="_self"
			   class="btn_a">
				<span><i class="in_left <?php echo esc_attr($spina_theme_options['callout_btn_one_icon']); ?>"></i><span><?php echo esc_attr($spina_theme_options['callout_btn_one_text']); ?></span><i class="in_right <?php echo esc_attr($spina_theme_options['callout_btn_one_icon']); ?>"></i></span>
			</a>
		</div>
	</div>
</section>