<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package prestro
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="user-scalable=no"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<script type="text/javascript">
    jQuery(window).load(function() {
        jQuery('#slider').nivoSlider();
    });
    </script>
          <?php wp_head(); ?>
    </head>   
    <body <?php body_class(); ?>>
    <div id="preloader">
        <div class="loading-circle fa-spin"></div>
    </div>
    <div id="page" class="hfeed site">
<div class="site-header">
        <nav id="prestro-top-nav" class="navbar prestro-navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <div id="logo">
                        <div class="site-logo"><?php if( get_theme_mod('logo-img') ){ ?><a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_attr(get_theme_mod('logo-img',''));?>"/></a>
                                                
                        <?php } else {?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                                <span style="color:#<?php header_textcolor();?>"><?php bloginfo('name'); ?></span>
                            </a>

                        <?php }?>
                       
                        </div>
                </div>
                </div>
                <?php prestro_header_menu(); ?>
            </div>
        </nav>
    </div>
        <div id="primary" class="fp-content-area">
            <main id="main" class="site-main slider-wrapper" role="main">
                <?php if (is_front_page() && ! is_home()) : ?>
                    <div class="home_slider">
                    <div id="home-slider" class="nivoSlider">
                        <?php  
                        $args = array(
                        'cat' => $catID,
                        'posts_per_page' => esc_attr(get_theme_mod('slider_loop'))
                        );
                  
                        $slider_query = new WP_Query($args); ?>
                        <?php if ($slider_query->have_posts()) :
                        while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
                        <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                         $url = $thumb['0'];?>
                        <img title="#slidecaption<?php the_ID(); ?>" src="<?php if(has_post_thumbnail()) { echo $url; } else { echo esc_url(get_template_directory_uri().'/images/slider-1.jpg'); } ?>" alt="" />
                          <?php endwhile;endif;?> 
                   </div>

                   <?php  if ($slider_query->have_posts()) : while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
                    <div id="slidecaption<?php the_ID(); ?>" class="nivo-html-caption"> 
                        <div class="slide-info">
                                        <h2><?php the_title();?></h2>
                                        <p><?php echo wp_trim_words(get_the_content(),'15'); ?></p>
                        </div>                           
                         <p class="slide_link"><a href="<?php echo esc_url( get_permalink() );?>"><?php _e('Read More', 'prestro'); ?></a></p> 
                    </div>
                     <?php endwhile;endif;?>    
                 </div>
                <?php endif; ?>