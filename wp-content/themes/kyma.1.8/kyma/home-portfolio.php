<?php $kyma_theme_options = kyma_theme_options();
global $post;
preg_match('/\[PVGM[^\]]*](.*)/uis', $post->post_content, $matches);
if(isset($matches[0]) || $kyma_theme_options['portfolio_shortcode'] != "") {
    ?>
    <section id="portfolio" class="content_section">
        <div class="row_spacer clearfix">
            <div class="content">
                <div class="main_title centered upper"><?php if ($kyma_theme_options['port_heading'] != "") { ?>
                        <h2 id="port_head"><span class="line"><i
                                class="fa fa-folder-open-o"></i></span><?php echo esc_attr($kyma_theme_options['port_heading']); ?>
                        </h2><?php
                    } ?>
                </div>
            </div>
            <!-- Filter Content -->
            <div class="hm_filter_wrapper three_blocks project_text_nav boxed_portos has_sapce_portos nav_with_nums upper_title upper_title">
                <div class="hm_filter_wrapper_con"><?php
                    if (isset($matches[0])) {
                        echo do_shortcode($matches[0]);
                    } elseif ($kyma_theme_options['portfolio_shortcode'] != "") {
                        echo do_shortcode($kyma_theme_options['portfolio_shortcode']);
                    }            ?>
                </div>
            </div><?php
            ?>
            <!-- End Filter Content -->
        </div>
    </section>
	<?php } else { ?>
	<!-- Isotope Filter 1 Three columns with padding -->
    <section class="content_section bg_white">
        <div class="row_spacer clearfix">
        
            <div class="content">
                <div class="main_title centered upper">
                    <h2><span class="line"><i class="fa fa-folder-open-o"></i></span><?php _e('Our Portfolio', 'kyma'); ?></h2>
                </div>
            </div>
            
                <!-- Filter Content -->
                <div class="hm_filter_wrapper three_blocks project_text_nav boxed_portos has_sapce_portos nav_with_nums upper_title upper_title">     
                               
                    <div class="hm_filter_wrapper_con">
						<?php for($i=1 ; $i<=3 ; $i++){ ?>
                        <div class="filter_item_block video">
							<div class="porto_block">
								<div class="porto_type">
									<a data-rel="magnific-popup" href="<?php echo get_template_directory_uri(); ?>/images/item4.jpg">
										<img src="<?php echo get_template_directory_uri(); ?>/images/item4.jpg" alt="Portfolio Name">
									</a>
									<div class="porto_nav">
										<a href="#" class="expand_img"><?php _e('View Larger', 'kyma'); ?></a>
										<a href="#" class="detail_link"><?php _e('More Details', 'kyma'); ?></a>
									</div>
								</div>
								<div class="porto_desc">
									<h6 class="name"><?php _e('Flat Logo Design', 'kyma'); ?></h6>
									<div class="porto_meta clearfix">
									<span class="porto_date"><span class="number"><?php _e('20141213', 'kyma'); ?></span><?php _e('December 13, 2014', 'kyma'); ?></span>
									</div>
								</div>
							</div>
                        </div><!-- Item -->
						<?php } ?>
                    </div>
                </div>
                <!-- End Filter Content -->
        </div>    
    </section>
<?php } ?>