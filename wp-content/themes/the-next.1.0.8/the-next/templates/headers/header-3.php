<?php get_template_part('templates/head') ?>
<!-- Nav Header Template: Header 3 -->

<body <?php body_class('w3eden'); ?>>

    <?php
    /**
     * Add anything immediately after body tag
     */
    do_action(THENEXT_THEME_PREFIX . "body_content_before");
    ?>


    <div id="mainframe" class="<?php echo sanitize_text_field( WPEdenThemeEngine::Layout('wide') ); ?>" <?php do_action('thenext_mainframe_div_attrs'); ?> >
        <div id="header-style-3">
            <header id="header-1" class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 social-link-wrapper">
                            <ul class="social-links pull-left">
                                <?php if (WPEdenThemeEngine::NextGetOption('facebook_profile_url') != '') { ?>
                                <li><a href="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('facebook_profile_url') ); ?>"><i class="fa fa-facebook"></i></a></li>
                                <?php } ?>
                                <?php if (WPEdenThemeEngine::NextGetOption('googleplus_profile_url') != '') { ?>
                                <li><a href="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('googleplus_profile_url') ); ?>"><i class="fa fa-google-plus"></i></a></li>
                                <?php } ?>
                                <?php if (WPEdenThemeEngine::NextGetOption('twitter_profile_url') != '') { ?>
                                <li><a href="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('twitter_profile_url') ); ?>"><i class="fa fa-twitter"></i></a></li>
                                <?php } ?>
                                <?php if (WPEdenThemeEngine::NextGetOption('pinterest_profile_url') != '') { ?>
                                <li><a href="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('pinterest_profile_url') ); ?>"><i class="fa fa-pinterest"></i></a></li>
                                <?php } ?>
                                <?php if (WPEdenThemeEngine::NextGetOption('linkedin_profile_url') != '') { ?>
                                <li><a href="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('linkedin_profile_url') ); ?>"><i class="fa fa-linkedin"></i></a></li>
                                <?php } ?>
                            </ul>

                        </div>

                        <div class="col-xs-12 col-sm-8 social-link-wrapper">
                            <ul class="social-links">
                                <li class="pull-left">
                                    <form>
                                        <div class="input-group search-input"><input type="text" name="s" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button class="btn btn-xs"><i class="tn-search"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </header>
            
            <header id="header-2" class="header">
                <div class="container logo-and-cinfo">
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>"><?php echo WPEdenThemeEngine::SiteLogo(); ?></a>

                            <?php get_template_part('templates/menus/mobile'); ?>

                        </div>
                        <div class="col-md-8 hidden-xs">
                            <div class="page-header-contact-info">
                                <div class="col-md-4 col-sm-4">
                                    <div class="media" style="margin-top: 26px">
                                        <div class="pull-left">
                                            <i class="hico tn-email text-primary"></i>
                                        </div>
                                        <div class="media-body">
                                            <b>Contact Us</b>
                                            <?php echo sanitize_text_field( WPEdenThemeEngine::NextGetOption('contact_email', 'contact@site.com') ); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="media" style="margin-top: 26px">
                                        <div class="pull-left">
                                            <i class="hico tn-mobile text-info"></i>
                                        </div>
                                        <div class="media-body">
                                            <b>Phone</b>
                                            <?php echo sanitize_text_field( WPEdenThemeEngine::NextGetOption('contact_phone', '(123) 456-7890') ); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <div class="media" style="margin-top: 26px">
                                        <div class="pull-left">
                                            <i class="hico tn-home text-success"></i>
                                        </div>
                                        <div class="media-body">
                                            <b>Address</b>
                                            <?php echo sanitize_text_field( WPEdenThemeEngine::NextGetOption('contact_address', '(123) 456-7890') ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <nav class="navbar navbar-default hidden-xs" role="navigation">
                    <div class="container relative">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <a class="site-logo animated zoomIn" href="<?php echo esc_url(home_url('/')); ?>"><?php echo WPEdenThemeEngine::SiteLogo(); ?></a>

                            <button type="button" class="navbar-toggle toggle-menu menu-left push-body"
                                    data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-ex1-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left">
                            <?php
                            $args = array(
                                'theme_location' => 'primary',
                                'depth' => 9,
                                'container' => false,
                                'menu_class' => 'nav navbar-nav',
                                'menu_id' => 'mainmenu',
                                'fallback_cb' => false,
                                'walker' => new TheNextNavMenu()
                            );


                            wp_nav_menu($args);
                            ?>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container -->
                </nav>
                <!-- /.navbar -->
            </header>
        </div>

<?php WPEdenThemeEngine::PageHeader(); ?>




