<?php
/**
 * The main template file
 * */
get_header();

$page_title_area = get_theme_mod('page_title_area');

if(get_bloginfo( 'description' ) != "") : ?>
        <div class="heading-description">
                <?php if($page_title_area != 2) : ?>
                    <div class="heading">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="title mobile_article">
                                        <b><?php echo esc_attr(get_theme_mod('bizzboss_blogpage_title',__('Our Blog','bizzboss'))); ?></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else : ?>
                        <div class="page-title-area"></div>
                        <?php endif; ?>
        </div>
        <?php else : ?>
            <?php if($page_title_area == 1) : ?>
                <div class="heading">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="title mobile_article">
                                    <b><?php echo esc_attr(get_theme_mod('bizzboss_blogpage_title',__('Our Blog','bizzboss'))); ?></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else : ?>
                    <div class="page-title-area"></div>
                <?php endif; ?>
            <?php endif; ?>
        <?php get_template_part('content'); ?>
        <?php get_footer(); ?>