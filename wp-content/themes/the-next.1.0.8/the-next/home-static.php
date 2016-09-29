<?php
/*
Template Name: Homepage
*/

if (!defined('ABSPATH')) exit;

define('THENEXT_HIDE_PAGE_HEADER',1);

get_header();

?>

<div class="container-fluid">
    <div class="row">
        
        <!-- Home Post Slider Section -->
        <div class="col-md-12">
            <section class="features-menu" id="extensions">
                <?php get_template_part('homepage','top'); ?>
            </section>

        </div>

        <!-- Home Featured Pages Section -->
        <div class="col-md-12 home-f-p">

            <div class="container">
                <div class="row">
                    <?php
                    for($i=1; $i<=4; $i++):

                        $page_id = intval(WPEdenThemeEngine::NextGetOption("home_featured_page_".$i));
                        $page  = get_post($page_id);
                        $meta = get_post_meta($page_id, 'wpeden_post_meta', true);
                        $url = get_permalink($page_id);
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                               <div class="media text-center wow fadeInUp" data-wow-duration="0.7s" data-wow-delay="<?php echo ($i-1)/3; ?>s">

                                        <a href="<?php echo esc_url($url); ?>" class="text-center" style="margin-bottom: 45px;display: block;margin-left: -5px">
                                            <span class="fa-stack fa-2x img-rounded fet-icon">
                                              <i class="<?php echo (isset($meta['icon']) && $meta['icon']!='') ? esc_attr($meta['icon']) : 'tn-download'; ?> fa-inner"></i>
                                            </span>

                                        </a>
                                    <div class="media-body">

                                    <h2 style="margin-top:0px;" class="monts"><a href="<?php echo esc_url($url); ?>"><?php echo esc_attr($page->post_title); ?></a></h2>
                                    <div class="clear"></div>
                                    <p class="open_sans small"><?php wpeden_get_excerpt($page_id, 60, true, '.'); ?></p><br/>

                                    </div>
                                </div>


                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <!-- Home Call TO Action Section -->
        <div class="col-md-12 home-cta">

            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-xs-offset-0 text-center ">
                        <h2 class="section-head wow zoomIn" data-wow-duration="1s" data-wow-delay="0.5s"><?php echo esc_attr( WPEdenThemeEngine::NextGetOption('home_featured_title','Demo Content Title!') ); ?></h2>

                        <p class="lead wow lightSpeedIn" data-wow-duration="1s" data-wow-delay="1s"><?php echo esc_attr( WPEdenThemeEngine::NextGetOption('home_featured_desc','Cras vitae justo nec quam lacinia metus. Cras vitae justo nec quam lacinia metus. Cras vitae justo nec quam lacinia metus.') ); ?></p>
                        <a class="btn btn-flat flat-danger btn-lg wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1.3s" type="button" href="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('home_featured_btnurl','#') ); ?>"><?php echo esc_attr( WPEdenThemeEngine::NextGetOption('home_featured_btntxt','Button Text') ); ?></a>
                        <a class="btn btn-flat flat-inverse btn-lg wow fadeInRight" data-wow-duration="1s" data-wow-delay="1.3s" type="button" href="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('home_featured_btnurl1','#') ); ?>"><?php echo esc_attr( WPEdenThemeEngine::NextGetOption('home_featured_btntxt1','Button Text') ); ?></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Home Features Section -->
        <div class="col-md-12 home-features">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="mod-content clearfix">
                            <div class="mod-inner clearfix">


                                <div class="customtitle3">
                                    <div class="row ">
                                        <div class="col-md-3 col-sm-4 t-sect left-c">
                                            <?php 
                                            for($i=1; $i<=3; $i++){
                                                $page = get_post( intval( WPEdenThemeEngine::NextGetOption('home_feature_page_'.$i) ) );
                                                $meta = get_post_meta($page->ID, 'wpeden_post_meta', true);
                                                ?>
                                                <div class="media text-right wow fadeInLeft" data-wow-duration="1s" data-wow-delay="<?php echo $i/3; ?>s">
                                                    <h4 class="monts"><a href="<?php echo esc_url(get_permalink($page->ID)); ?>"><i class="<?php echo (isset($meta['icon']) && $meta['icon']!='') ? esc_attr($meta['icon']) : 'tn-settings'; ?> theme-color pull-right"></i> <?php echo sanitize_text_field($page->post_title); ?></a></h4>
                                                    <p class="open_sans"><?php wpeden_get_excerpt($page->ID, 110); ?></p>
                                                </div>
                                            <?php } ?>

                                        </div>
                                        <div class="col-md-6 col-sm-4 text-center">
                                            <h2 class="section-head text-center center-dash wow fadeInTop" data-wow-duration="1s"><?php echo esc_attr( WPEdenThemeEngine::NextGetOption('home_feature_title','Amazing Features') ); ?></h2>
                                                 <?php if( esc_url( WPEdenThemeEngine::NextGetOption('home_feature_image', '') ) != '' ) { ?>
                                                <img alt="<?php echo esc_attr( WPEdenThemeEngine::NextGetOption('home_feature_title','Amazing Features') ); ?>" src="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('home_feature_image', '') ); ?>"><?php } ?>
                                        </div>
                                        <div class="col-md-3 col-sm-4 t-sect right-c">
                                            <?php for($i=4; $i<=6; $i++){ $page = get_post( intval( WPEdenThemeEngine::NextGetOption('home_feature_page_'.$i) ) ); 
                                            
                                            $meta = get_post_meta($page->ID, 'wpeden_post_meta', true); ?>
                                            
                                                <div class="media  wow fadeInRight" data-wow-duration="1s" data-wow-delay="<?php echo ($i-3)/3; ?>s"><h4 class="monts"><a href="<?php echo esc_url(get_permalink($page->ID)); ?>"><i class="<?php echo isset($meta['icon']) && $meta['icon']!='' ? esc_attr($meta['icon']) : 'tn-settings'; ?> theme-color pull-left" ></i> <?php echo sanitize_text_field($page->post_title); ?></a></h4><p class="open_sans"><?php wpeden_get_excerpt($page->ID, 110); ?></p></div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Home Tabbed Section -->
        
        <div class="container home-tab-intro">
            <div class="row features">
                <div class="col-md-8 col-md-offset-2 col-xs-offset-0 text-center">
                    <h2 class="section-head wow zoomIn" data-wow-duration="0.5s">
                        <?php echo esc_attr( WPEdenThemeEngine::NextGetOption('tabbed_section_title', 'From Blog') ); ?>
                    </h2>
                    <p class="lead animated wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                        <?php echo esc_attr( WPEdenThemeEngine::NextGetOption('tabbed_section_desc', 'Select three top post categories from Theme Option to show in tabbed section...') ); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-pills nav-justified dmenu">
                        <?php for ($i = 1; $i <= 3; $i++) {
                            $wpmpcat = get_term( intval( WPEdenThemeEngine::NextGetOption('wpdm_category_' . $i, 1) ), 'category'); ?>
                            <li <?php echo $i == 1 ? 'class="active"' : ''; ?> >
                                <a href="#<?php echo esc_attr($wpmpcat->slug); ?>" data-toggle="tab"><?php echo esc_attr( $wpmpcat->name ); ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <div class="container tab-content home-tab-content">
            <?php for ($i = 1; $i <= 3; $i++) {
                $wpmpcat = get_term( intval( WPEdenThemeEngine::NextGetOption('wpdm_category_' . $i, 1) ), 'category');
                if (!is_wp_error($wpmpcat)) { ?>
                    <div id="<?php echo esc_attr($wpmpcat->slug); ?>" <?php echo $i == 1 ? 'class="tab-pane active fade in"' : 'class="tab-pane"'; ?>>
                        <div class="row">
                            <?php
                            $q = new WP_Query(array(
                                'post_type' => 'post',
                                'showposts' => 3,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'category',
                                        'terms' => esc_attr($wpmpcat->term_id),
                                        'field' => 'term_id',
                                        'include_children' => false
                                    )
                                ),
                                'orderby' => 'publish_date',
                                'order' => 'DESC')
                            );
                            $z = 0;
                            while ($q->have_posts()) {
                                $q->the_post();
                                ?>
                                
                                <div class="col-md-3 col-sm-4  col-xs-6">
                                    <div class="thumbnail package-block home-ext wow zoomIn" data-wow-duration="1s" data-wow-delay=".3s" id="p-<?php echo get_the_ID(); ?>">
                                        <div class="relative">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php
                                                if(has_post_thumbnail())
                                                    wpeden_post_thumb(array(300, 300)); 
                                                else {
                                                   echo '<img src="'.get_template_directory_uri().'/images/thumbnail-ph.jpg">'; 
                                                }
                                                ?>
                                            </a>
                                            <div class="mask" style="cursor: pointer" onclick="location.href='<?php the_permalink(); ?>';">
                                                <div class="maskin">
                                                    <h3><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h3>
                                                    <ul>
                                                        <li><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            <div class="col-md-3 col-sm-4  col-xs-6">
                                <div class="thumbnail package-block home-ext wow zoomIn" data-wow-duration="1s" data-wow-delay=".3s" id="p-<?php echo get_the_ID(); ?>">
                                    <div class="relative">
                                        <a title="View All" class="ttip1" href='<?php echo esc_url(get_term_link($wpmpcat)); ?>'><img src="<?php echo get_template_directory_uri(); ?>/images/viewall.png"/></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
            </div>
    </div>

</div>

<?php get_footer(); 
