<?php $kyma_theme_options = kyma_theme_options();
if ($kyma_theme_options['home_service_enabled'] == 1){ ?>
<section class="content_section bg_gray">
    <div class="container icons_spacer">
        <div class="main_title centered upper"><?php if ($kyma_theme_options['home_service_heading'] != ""){ ?>
            <h2 id="service_heading"><span class="line"><span
                        class="dot"></span></span><?php echo esc_attr($kyma_theme_options['home_service_heading']);
                } ?></h2>
        </div>
        <div class="icon_boxes_con style1 clearfix"><?php
            $col = 12 / (int)$kyma_theme_options['home_service_column'];
            $color = array('color1', 'color2', 'color3', 'color4');
            for ($i = 1; $i <= 4; $i++) {
                if ($kyma_theme_options['service_icon_' . $i] != "" || $kyma_theme_options['service_title_' . $i] != "" || $kyma_theme_options['service_text_' . $i] != "" ) { ?>
            <div class="service col-md-<?php echo esc_attr($col); ?>">
				<div class="service_box">
					<?php if ($kyma_theme_options['service_icon_' . $i] != "") { ?>
                    <span class="icon">
						<a id="service-link2-<?php echo $i; ?>" href="<?php echo esc_url($kyma_theme_options['service_link_' . $i]); ?>">
							<i id="service-icon-<?php echo $i; ?>" class="<?php echo esc_attr($kyma_theme_options['service_icon_' . $i] . ' ' . $color[$i-1]); ?>"></i>
						</a>	
					</span>
					<?php } ?>
                    <div class="service_box_con centered">
                        <?php if ($kyma_theme_options['service_title_' . $i] != "") { ?>
						<a id="service-link1-<?php echo $i; ?>" href="<?php echo esc_url($kyma_theme_options['service_link_' . $i]); ?>">
                            <h3 id="service-title-<?php echo $i; ?>"><?php echo esc_attr($kyma_theme_options['service_title_' . $i]); ?></h3>
						</a>
						<?php }
                        if ($kyma_theme_options['service_text_' . $i] != "") {
                            ?>
                            <span id="service-desc-<?php echo $i; ?>"
                                  class="desc"><?php echo esc_attr($kyma_theme_options['service_text_' . $i]); ?></span><?php
                        }
                        if ($kyma_theme_options['service_link_' . $i] != "") {
                            ?>
                        <a id="service-link-<?php echo $i; ?>"
                           href="<?php echo esc_url($kyma_theme_options['service_link_' . $i]); ?>"
                           class="ser-box-link"><span></span><?php _e('Read More', 'spina'); ?></a><?php
                        } ?>
                    </div>
                </div>
                </div><?php }
            }
            ?>
        </div>
    </div>
</section>
<?php } ?>