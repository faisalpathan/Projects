<?php
/*
Template Name: Home Page
*/
get_header();
?>

<div class="welcome">
    <div class="container">
     <?php if(get_theme_mod('welcome_setting') != '') { ?>
       <?php $page_query = new WP_Query('page_id='.esc_attr(get_theme_mod('welcome_setting'))); ?>
           <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
            <h3 class="iwt-title res-title"><?php the_title(); ?></h2></h3>
            <div class="line-center res-line"></div>
     
        <div class="col-md-6 col-xs-6 wow fadeInLeft" data-wow-offset="5" data-wow-duration="2.5s" data-wow-delay="1s">
          <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
          $url = $thumb['0'];?>

            <img src="<?php if(has_post_thumbnail()) { echo $url; } else { echo esc_url(get_template_directory_uri().'/images/welcome.jpg'); } ?>" alt="" />

        </div>
        <div class="col-md-6 col-xs-6 wow fadeInUp" data-wow-offset="5" data-wow-duration="1.5s" data-wow-delay="1s">
                <h3 class="iwt-title desk-title"><?php the_title(); ?></h3>
                <div class="line-center desk-line"></div>
          <p><?php echo wp_trim_words(get_the_content(),'75');?></p>
        </div>
        <?php endwhile;?>
          <?php } ?>
         </div>
</div>


<?php if(get_theme_mod("service_setting")) { ?>
<div class="services">
    <div class="container">
        <?php if(get_theme_mod("service_sec_title")) { ?>
            <h3 class="iwt-title"><?php if(get_theme_mod("service_sec_title")) echo sanitize_text_field(get_theme_mod("service_sec_title")); ?></h3>
            <div class="line-center"></div>
        <?php }
        // Get category ID from Theme Customizer
         $catID = get_theme_mod('service_setting');
        // Only get Posts that are assigned to the given category ID
        $service_query = new WP_Query(array(
            'post_type' => 'post',
            'cat' => $catID,
            'posts_per_page' => 4,    
        ));
        while( $service_query->have_posts() ) : $service_query->the_post(); ?>
        <div class="col-md-3 col-sm-3 col-xs-12 service_block">
        <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
          $url = $thumb['0'];?>
            <img class="fi animateblock" src="<?php if(has_post_thumbnail()) { echo $url; } else { echo esc_url(get_template_directory_uri().'/images/service-1.jpg'); } ?>" alt="Featured Image"/>
            <h4><?php the_title();?></h4>
            <p class="home-content"><?php echo wp_trim_words(get_the_content(),'12');?></p>
            <p class="service-more"><a class="view-more" href="<?php echo esc_url(get_permalink()); ?>"><?php _e( 'Learn more', 'prestro' ); ?> <i class="fa fa-angle-right"></i></a></p>
            </div>
         <?php endwhile;?>
         
    </div>
</div>
<div class="hrl container" style="border-bottom: 3px dashed #333"></div>
<?php } ?>


<?php if(get_theme_mod("chef_setting")) { ?>
<div class="gallery-slide">
    <div class="container">
        <?php if(get_theme_mod("chef_sec_title")) { ?>
            <h4 class="iwt-title"><?php if(get_theme_mod("chef_sec_title")) echo sanitize_text_field(get_theme_mod("chef_sec_title")); ?></h4>
            <div class="line-center"></div>
        <?php }
       // Get category ID from Theme Customizer

         $catID = get_theme_mod('chef_setting');
        // Only get Posts that are assigned to the given category ID
        $chef_query = new WP_Query(array(
            'post_type' => 'post',
            'cat' => $catID,
            'posts_per_page' => 4,    
        ));
        while( $chef_query->have_posts() ) : $chef_query->the_post(); ?>
           <div class="col-md-3 col-sm-4 col-xs-6 wow fadeInDown" data-wow-delay="0.5s" data-wow-duration="2s">
                <div class="sv_wrap">
                 <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
                    $url = $thumb['0'];?>
                    <img alt="Chef" src="<?php if(has_post_thumbnail()) { echo $url; } else { echo esc_url(get_template_directory_uri().'/images/chef-1.jpg'); } ?>" />
                    <div class="svbox">
                        <svg height="100%" width="100%" xmlns="http://www.w3.org/2000/svg">
                        <line y2="0" x2="900" y1="0" x1="0" class="top"/>
                        <line y2="-920" x2="0" y1="100%" x1="0" class="left"/>
                        <line y2="100%" x2="-600" y1="100%" x1="100%" class="bottom"/>
                        <line y2="1800" x2="100%" y1="0" x1="100%" class="right"/>
                        </svg>
                        <h3><?php the_title();?></h3>
                    </div>
                </div>
            </div>
            <?php endwhile;?>
</div>
</div>

<?php  $category_link = get_category_link( $catID );?>  
    <p class="gallery-more"><a class="view-more" href="<?php echo esc_url( $category_link ); ?>"><?php _e( 'Learn more', 'prestro' ); ?> <i class="fa fa-angle-right"></i></a></p>
<?php } ?>


<?php
$args = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3, 'order_by' => 'date', 'order' => 'DESC'));
$loop = new WP_Query($args);
if($loop->have_posts()){ ?>
<div class="blog_sec">
    <div class="container">
        <h4 class="iwt-title"><?php _e( 'From Our Blog', 'prestro' ); ?></h4>
        <div class="line-center"></div>
        <div class="blog_wrap">
            <?php
            while ($loop->have_posts()) : $loop->the_post();
                ?>                
                <div class="col-md-4 col-xs-6 wow fadeInLeft" data-wow-delay="1.5s" data-wow-duration="2s">
                    <div class="post_content_col">
                        <div class="over_img">
                            <?php
                            if (has_post_thumbnail())
                                the_post_thumbnail();
                            else
                                echo '<img alt="' . get_the_title() . '" src="' . get_template_directory_uri() . '/images/slider-3.jpg" />';
                            ?>
                            <div class="img-overlay">
                                <ul class="list-inline dishes_icon">
                                    <?php
                                    $url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                                    if (!$url) {
                                        $url = get_template_directory_uri() . '/images/slider-3.png';
                                    }
                                    ?>
                                    <li><a href="<?php echo $url; ?>"  class="fancybox" rel="blog_post"><i class="fa fa-search"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="post_content">
                            <a class="post_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php
                            $trimmed = get_the_excerpt();
                            echo '<p>' . $trimmed . '</p>';
                            ?>
                        </div>
                        <div class="continue">
                            <a href="<?php the_permalink(); ?>"><?php _e( 'Continue Reading', 'prestro' ); ?><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>                                                                                                                               
                </div>
<?php endwhile; ?>
        </div>
    </div>
</div>
<?php } ?>

</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>