<?php

class TheNextFramework{

    /**
     * @usage Prints Page Heading in Single Page/Post
     */
    public static function PageHeadingMain(){

        $PgaeHeadingMain = '';

        if ( is_day() ) :
            $PgaeHeadingMain = get_the_date();

        elseif ( is_month() ) :
            $PgaeHeadingMain = "Monthly Archives: ". get_the_date( 'F Y' );

        elseif ( is_404() ) :
            $PgaeHeadingMain = "404";

        elseif ( is_year() ) :
            $PgaeHeadingMain = get_the_date( 'Y' );

        elseif(is_category()) :
            $PgaeHeadingMain = single_cat_title( '', false );

        elseif(is_tag()) :
            $PgaeHeadingMain = single_tag_title();

        elseif(is_page()) :
            $PgaeHeadingMain = get_the_title();

        elseif(is_single()) :
            $PgaeHeadingMain = get_the_title();

        elseif(is_singular('wpdmpro')) :
            $PgaeHeadingMain = get_the_title();

        elseif(is_search()):
            $PgaeHeadingMain = "Search Result For:  ".esc_attr(get_query_var('s'));

        elseif(is_tax()):
            $PgaeHeadingMain = single_term_title('', false);

        elseif(is_home()):
            $pageid = get_query_var('page_id');
            $page = get_post($pageid);
            $PgaeHeadingMain = esc_attr($page->post_title);
        endif;
        rewind_posts();

        echo apply_filters("thenext_page_heading_main", $PgaeHeadingMain);

    }


    public static function PageIcon($id = null){
        $id = $id == null ? get_the_ID():$id;
        $meta = get_post_meta($id, 'wpeden_post_meta', true);
        $icon = isset($meta['icon']) && $meta['icon'] != '' ? $meta['icon'] : 'tn-mouse';
        $icon = apply_filters("thenext_page_icon", $icon);

        echo "<i class='".sanitize_text_field($icon)."'></i>";
    }


    public static function PageHeaderBottom(){
        ?>

        <div class="page-header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 bcrumb">
                        <?php do_action('thenext_page_header_bottom_left_content') ?>
                    </div>
                    <div class="col-md-3">
                        <form action="<?php echo home_url('/'); ?>">
                            <div class="input-group search-inputs">
                                <input type="hidden" name="post_type" value="post" />
                                <input type="text" name="s" placeholder="<?php _e('Search...','the-next'); ?>" value="" class="form-control input-sm search">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm"><i class="tn-search"></i></button>
                            </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    /**
     * @usage Render Dynamic Sidebars
     */
    public static function DynamicSidebars($pos){
        global $post;

        $left_sidebar_style = "default";
        $right_sidebar_style = "default";

        if(is_home() || is_front_page()){
            $sidebar_layout = sanitize_text_field( WPEdenThemeEngine::NextGetOption('layout_front_page','right-sidebar-1') );
            $left_sidebar = sanitize_text_field( WPEdenThemeEngine::NextGetOption('front_page_ls','') );
            $right_sidebar = sanitize_text_field( WPEdenThemeEngine::NextGetOption('front_page_rs','') );
            $left_sidebar_width = intval( WPEdenThemeEngine::NextGetOption('front_page_ls_width','3') );
            $right_sidebar_width = intval( WPEdenThemeEngine::NextGetOption('front_page_rs_width','3') );
        }
        else if(is_single() || is_page()){
            $meta = maybe_unserialize(get_post_meta($post->ID, 'wpeden_post_meta', true));
            if(is_page()){
                $page_layout['sidebar_layout'] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('layout_default_page', 'right-sidebar-1') );
                $page_layout['left_sidebar'] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('default_page_ls', '') );
                $page_layout['right_sidebar'] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('default_page_rs', '') );
                $page_layout['left_sidebar_width'] = intval( WPEdenThemeEngine::NextGetOption('default_page_ls_width', '3') );
                $page_layout['right_sidebar_width'] = intval( WPEdenThemeEngine::NextGetOption('default_page_rs_width', '3') );
            }
            else{
                $page_layout['sidebar_layout'] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('layout_default_post', 'right-sidebar-1') );
                $page_layout['left_sidebar'] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('default_post_ls', '') );
                $page_layout['right_sidebar'] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('default_post_rs', '') );
                $page_layout['left_sidebar_width'] = intval( WPEdenThemeEngine::NextGetOption('default_post_ls_width', '3') );
                $page_layout['right_sidebar_width'] = intval( WPEdenThemeEngine::NextGetOption('default_post_rs_width', '3') );
            }
            
            $sidebar_layout = isset($meta['sidebar_layout']) && $meta['sidebar_layout'] != '' ? $meta['sidebar_layout'] : $page_layout['sidebar_layout'];
            $left_sidebar = isset($meta['left_sidebar']) && $meta['left_sidebar'] != '' ? $meta['left_sidebar'] : $page_layout['left_sidebar'];
            $left_sidebar_width = isset($meta['left_sidebar_width']) && $meta['left_sidebar_width'] != '' ? $meta['left_sidebar_width'] : $page_layout['left_sidebar_width'];
            $right_sidebar = isset($meta['right_sidebar']) && $meta['right_sidebar'] != '' ? $meta['right_sidebar'] : $page_layout['right_sidebar'];
            $right_sidebar_width = isset($meta['right_sidebar_width']) && $meta['right_sidebar_width'] != '' ? $meta['right_sidebar_width'] : $page_layout['right_sidebar_width'];
        }
        else if(is_archive()){
            $sidebar_layout = sanitize_text_field( WPEdenThemeEngine::NextGetOption('layout_archive_page','right-sidebar-1') );
            $left_sidebar = sanitize_text_field( WPEdenThemeEngine::NextGetOption('archive_page_ls','') );
            $right_sidebar = sanitize_text_field( WPEdenThemeEngine::NextGetOption('archive_page_rs','') );
            $left_sidebar_width = intval( WPEdenThemeEngine::NextGetOption('archive_page_ls_width','3') );
            $right_sidebar_width = intval( WPEdenThemeEngine::NextGetOption('archive_page_rs_width','3') );
        }
        
        if($pos == 'left') {
            if ($left_sidebar != '' && in_array($sidebar_layout, array('left-sidebar-1', 'left-sidebar-2', 'sidebar-2')))
                    self::Sidebar($left_sidebar, $left_sidebar_width, $left_sidebar_style, "left");

            if ($right_sidebar != '' && $sidebar_layout == 'left-sidebar-2')
                    self::Sidebar($right_sidebar, $right_sidebar_width, $right_sidebar_style, "right");
        }

        if($pos == 'right') {
            if ($left_sidebar != '' && $sidebar_layout == 'right-sidebar-2')
                self::Sidebar($left_sidebar, $left_sidebar_width, $left_sidebar_style, "left");

            if ($right_sidebar != '' && in_array($sidebar_layout, array('right-sidebar-1', 'right-sidebar-2', 'sidebar-2')))
                self::Sidebar($right_sidebar, $right_sidebar_width, $right_sidebar_style, "right");
        }

    }

    /**
     * @usage Render Sidebar
     * @param $id
     * @param $width
     * @param $style
     * @param $pos
     */
    public static function Sidebar($id, $width, $style, $pos){

        $style = sanitize_text_field($style);
        $pos = sanitize_text_field($pos);
    ?>
        <div class="col-md-<?php echo sanitize_text_field($width); ?>">
            <div class="sidebar <?php echo $style; ?>">
                <?php do_action("thenext_before_sidebar_{$style}"); ?>

                <?php do_action("thenext_before_{$pos}_sidebar"); ?>

                <?php dynamic_sidebar($id); ?>

                <?php do_action("thenext_after_{$pos}_sidebar"); ?>

                <?php do_action("thenext_after_sidebar_{$style}"); ?>
            </div>
        </div>
    <?php
    }


    /**
     * @usage Calculate Content Area Width
     */
    public static function ContentAreaWidth(){
        global $post;
        $sidebar_layout = "right-sidebar-1";
        $content_width = 12;
        $right_sidebar_width = 3;
        $defaults = array('sidebar_layout' => 'right-sidebar-1', 'left_sidebar_width' => 3, 'right_sidebar_width' => 3);

        if(is_home() || is_front_page()){
            $sidebar_layout = sanitize_text_field( WPEdenThemeEngine::NextGetOption('layout_front_page','right-sidebar-1') );
            $left_sidebar_width = intval( WPEdenThemeEngine::NextGetOption('front_page_ls_width','3') );
            $right_sidebar_width = intval( WPEdenThemeEngine::NextGetOption('front_page_rs_width','3') );            
        }
        else if(is_single() || is_page()){
            $meta = maybe_unserialize(get_post_meta($post->ID, 'wpeden_post_meta', true));
                        
            if(is_page()){
                $page_layout['sidebar_layout'] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('layout_default_page', 'right-sidebar-1') );
                $page_layout['left_sidebar_width'] = intval( WPEdenThemeEngine::NextGetOption('default_page_ls_width', '3') );
                $page_layout['right_sidebar_width'] = intval( WPEdenThemeEngine::NextGetOption('default_page_rs_width', '3') );
            }else{
                $page_layout['sidebar_layout'] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('layout_default_post', 'right-sidebar-1') );
                $page_layout['left_sidebar_width'] = intval( WPEdenThemeEngine::NextGetOption('default_post_ls_width', '3') );
                $page_layout['right_sidebar_width'] = intval( WPEdenThemeEngine::NextGetOption('default_post_rs_width', '3') );
            }
            
            $sidebar_layout = isset($meta['sidebar_layout']) && $meta['sidebar_layout'] != '' ? $meta['sidebar_layout'] : $page_layout['sidebar_layout'];
            $left_sidebar_width = isset($meta['left_sidebar_width']) && $meta['left_sidebar_width'] != '' ? $meta['left_sidebar_width'] : $page_layout['left_sidebar_width'];
            $right_sidebar_width = isset($meta['right_sidebar_width']) && $meta['right_sidebar_width'] != '' ? $meta['right_sidebar_width'] : $page_layout['right_sidebar_width'];
        }
        else if(is_archive()){
            $sidebar_layout = sanitize_text_field( WPEdenThemeEngine::NextGetOption('layout_archive_page','right-sidebar-1') );
            $left_sidebar_width = intval( WPEdenThemeEngine::NextGetOption('archive_page_ls_width','3') );
            $right_sidebar_width = intval( WPEdenThemeEngine::NextGetOption('archive_page_rs_width','3') );
        }

        if($sidebar_layout == "no-sidebar")  $content_width = 12;
        else if($sidebar_layout == "right-sidebar-1")  $content_width = 12 - $right_sidebar_width;
        else if($sidebar_layout == "left-sidebar-1")  $content_width = 12 - $left_sidebar_width;
        else  $content_width = 12 - $left_sidebar_width - $right_sidebar_width;

        echo apply_filters("thenext_content_area_width", "$sidebar_layout col-md-".$content_width);

    }


}