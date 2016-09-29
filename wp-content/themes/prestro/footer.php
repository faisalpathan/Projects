<?php
/**
 * The template for displaying the footer
 * @package prestro
 */
?>
</div><!-- #content -->

<div id="footer-area">
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xs-6 ft wow fadeInUp" data-wow-offset="5" data-wow-duration="2.5s" data-wow-delay="0.5s">
                        <?php if ( is_active_sidebar( 'footer-widget-1' ) ){
                            echo dynamic_sidebar('footer-widget-1');
                        } ?>
                    </div>
                    <div class="col-md-4 col-xs-6 ft wow fadeInUp" data-wow-offset="5" data-wow-duration="2.5s" data-wow-delay="0.5s">
                        <?php if ( is_active_sidebar( 'footer-widget-2' ) ){
                            echo dynamic_sidebar('footer-widget-2');
                        } ?>
                    </div>
                    <div class="col-md-4 col-xs-6 ft wow fadeInUp" data-wow-offset="5" data-wow-duration="2.5s" data-wow-delay="0.5s">
                        <div class="widget widget_text">
                            <?php if(get_theme_mod("prestroc_fti")) { ?>
                                <h3 class="widgettitle"><?php echo get_theme_mod("prestroc_fti", esc_html__('Stay Connected', 'prestro')); ?></h3>
                            <?php } ?>
                            <div class="stay-connect">
                                <?php if(get_theme_mod("prestroc_name")) { ?><p><i class="fa fa-home"></i><?php if(get_theme_mod("prestroc_name", esc_html__('ThemesWare', 'prestro'))) echo get_theme_mod("prestroc_name", esc_html__('ThemesWare', 'prestro')); ?></p><?php } ?>
                                <?php if(get_theme_mod("prestro_address")) { ?><p><i class="fa fa-map-marker"></i><?php if(get_theme_mod("prestro_address", esc_html__('Gujarat(India)', 'prestro'))) echo get_theme_mod("prestro_address", esc_html__('Gujarat(India)', 'prestro')); ?></p><?php } ?>
                                <?php if(get_theme_mod("prestro_email")) { ?><p><i class="fa fa-envelope"></i><a href="mailto:<?php if(get_theme_mod("prestro_email", esc_html__('info@themesware.com', 'prestro'))) echo get_theme_mod("prestro_email", esc_html__('info@themesware.com', 'prestro')); ?>"><?php if(get_theme_mod("prestro_email", __('info@themesware.com', 'prestro'))) echo get_theme_mod("prestro_email", __('info@themesware.com', 'prestro')); ?></a></p><?php } ?>
                                <?php if(get_theme_mod("prestro_phone")) { ?><p><i class="fa fa-phone" title="<?php esc_html__('Call-Us', 'prestro'); ?>"></i><?php if(get_theme_mod("prestro_phone", esc_html__('+ 12 123 459 88', 'prestro'))) echo get_theme_mod("prestro_phone", esc_html__('+ 12 123 459 88', 'prestro')); ?></p><?php } ?>
                                <ul class="social_icon">
                                    <?php if(get_theme_mod("prestro_social_fb")) : ?>
                                        <li class="fbs">
                                            <a href="<?php if(get_theme_mod("prestro_social_fb", esc_url(__('#', 'prestro')))) echo get_theme_mod("prestro_social_fb", esc_url(__('#', 'prestro'))); ?>"><i class="fa fa-facebook"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(get_theme_mod("prestro_social_twitter")) : ?>
                                        <li class="tws">
                                            <a href="<?php if(get_theme_mod("prestro_social_twitter", esc_url(__('#', 'prestro')))) echo get_theme_mod("prestro_social_twitter", esc_url(__('#', 'prestro'))); ?>"><i class="fa fa-twitter"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(get_theme_mod("prestro_social_gp")) : ?>    
                                        <li class="gps">
                                            <a href="<?php if(get_theme_mod("prestro_social_gp", esc_url(__('#', 'prestro')))) echo get_theme_mod("prestro_social_gp", esc_url(__('#', 'prestro'))); ?>"><i class="fa fa-google-plus"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(get_theme_mod("prestro_social_linkedin")) : ?>
                                        <li class="lis">
                                            <a href="<?php if(get_theme_mod("prestro_social_linkedin", esc_url(__('#', 'prestro')))) echo get_theme_mod("prestro_social_linkedin", esc_url(__('#', 'prestro'))); ?>"><i class="fa fa-linkedin"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(get_theme_mod("prestro_social_skype")) : ?>    
                                        <li class="sks">
                                            <a href="skype:skype?<?php if(get_theme_mod("prestro_social_skype", esc_url(__('#', 'prestro')))) echo get_theme_mod("prestro_social_skype", esc_url(__('#', 'prestro'))); ?>" title="" data-placement="bottom" data-toggle="tooltip" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                                        </li>
                                    <?php endif; ?>    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
    </footer><!-- #colophon -->
    <div class="site-info container">
        <div class="copyright">
            <?php echo get_theme_mod("prestro_copyright",'Copyright &copy; '. date_i18n( 'Y' ) .' . Designed by ThemesWare.','prestro'); ?>
        </div>
    </div><!-- .site-info -->
</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>