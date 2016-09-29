<?php

/*
 * bizzboss default footer file
 */
?>
    <footer>
        <div class="footer-box1">
            <div class="container">
                <div class="row">
                    <?php if (is_active_sidebar('footer-1')) { ?>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <?php dynamic_sidebar('footer-1'); ?>
                            </div>
                        <?php }
				        if (is_active_sidebar('footer-2')) { ?>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <?php dynamic_sidebar('footer-2'); ?>
                            </div>
                        <?php } 
				        if (is_active_sidebar('footer-3')) { ?>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <?php dynamic_sidebar('footer-3'); ?>
                            </div>
                        <?php } 
				        if (is_active_sidebar('footer-4')) { ?>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <?php dynamic_sidebar('footer-4'); ?>
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>

        <div class="under-footer">
            <div class="container">
                <div class="row">

                    <div class="back-to-top">
                        <a class="go-top" href="javascript:void(0);"><i class="fa fa-angle-up"></i></a>
                    </div>
                    <div class="footer-social-icon">
                        <ul>
                            <?php 
                                $bizzboss_facebook_url = esc_url(get_theme_mod('bizzboss_facebook_url'));
                                $bizzboss_facebook_icon = esc_attr(get_theme_mod('bizzboss_facebook_icon'));

                                if (isset($bizzboss_facebook_icon) && $bizzboss_facebook_icon != "" && isset($bizzboss_facebook_url) && $bizzboss_facebook_url != "" ) { ?>
                                <li>
                                    <a href="<?php echo $bizzboss_facebook_url; ?>" target="_blank">
                                        <i class="fa <?php echo $bizzboss_facebook_icon; ?>"></i>
                                    </a>
                                </li>
                            <?php } 
                                    $bizzboss_twitter_icon = esc_attr(get_theme_mod('bizzboss_twitter_icon'));
                                    $bizzboss_twitter_url =  esc_url(get_theme_mod('bizzboss_twitter_url'));

                                if (isset($bizzboss_twitter_url) && $bizzboss_twitter_url != "" && isset($bizzboss_twitter_icon) && $bizzboss_twitter_icon != "" ) { ?>
                                <li>
                                    <a href="<?php echo $bizzboss_twitter_url; ?>" target="_blank">
                                        <i class="fa <?php echo $bizzboss_twitter_icon; ?>"></i>
                                    </a>
                                </li>
                            <?php } 
                                    $bizzboss_gplus_icon = esc_attr(get_theme_mod('bizzboss_gplus_icon'));
                                    $bizzboss_gplus_url = esc_url(get_theme_mod('bizzboss_gplus_url'));

                                if (isset($bizzboss_gplus_icon) && $bizzboss_gplus_icon != "" && isset($bizzboss_gplus_url) && $bizzboss_gplus_url != "") { ?>
                                <li>
                                    <a href="<?php echo $bizzboss_gplus_url; ?>" target="_blank">
                                        <i class="fa <?php echo $bizzboss_gplus_icon; ?>"></i>
                                    </a>
                                </li>
                            <?php } 
                                    $bizzboss_pinter_url = esc_url(get_theme_mod('bizzboss_pinter_url'));
                                    $bizzboss_pinter_icon = esc_attr(get_theme_mod('bizzboss_pinter_icon'));
                                if( isset($bizzboss_pinter_icon) && $bizzboss_pinter_icon != "" && isset($bizzboss_pinter_url) && $bizzboss_pinter_url != "") { ?>
                                <li>
                                    <a href="<?php echo $bizzboss_pinter_url; ?>" target="_blank">
                                        <i class="fa <?php echo $bizzboss_pinter_icon; ?>"></i>
                                    </a>
                                </li>
                            <?php } 
                                $bizzboss_insta_url = esc_url(get_theme_mod('bizzboss_insta_url'));
                                $bizzboss_insta_icon = esc_attr(get_theme_mod('bizzboss_insta_icon'));

                                if( isset($bizzboss_insta_icon) && $bizzboss_insta_icon != "" && isset($bizzboss_insta_url) && $bizzboss_insta_url != "") { ?>
                                <li>
                                    <a href="<?php echo $bizzboss_insta_url; ?>" target="_blank">
                                        <i class="fa <?php echo $bizzboss_insta_icon; ?>"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="copyright-text">
                        <p>
                            <?php $auther_url = 'https://indigothemes.com/products/bizzboss-wordpress-theme/'; ?>
                            <?php _e('Powered by ','bizzboss'); ?>
                            <a target= "_blank" href="<?php echo esc_url($auther_url); ?>" >
                                <?php _e( 'Bizzboss WordPress Theme', 'bizzboss' ); ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>