<?php
require_once( get_template_directory() . "/admin/ThemeEngine.class.php" );

require_once( get_template_directory() . "/libs/Framework.class.php" );
require_once( get_template_directory() . "/libs/TheNext.class.php" );
require_once( get_template_directory() . "/libs/NavMenu.class.php" );
require_once( get_template_directory() . "/libs/menu-item-icon.php" );
require_once( get_template_directory() . "/libs/MetaBoxes.class.php" );
require_once( get_template_directory() . "/libs/StructuredData.class.php" );
require_once( get_template_directory() . "/libs/post-functions.php" );
require_once( get_template_directory() . "/libs/util-functions.php" );

require_once( get_template_directory() . "/modules/colorbox/colorbox.php" );
require_once( get_template_directory() . "/modules/preloader/preloader.php" );

require_once( get_template_directory() . '/admin/customizer.php' );

new TheNext();

class TheNextBase{

    function __construct(){
        $this->Actions();
        $this->Filters();
    }

    function Actions(){
        //delete_option( 'thenext_options' );
        add_action('thenext_page_header_bottom_left_content', array($this, 'PageHeaderBottomLeft'));
    }

    function Filters(){
        add_filter('page_header_bottom_left_content', array($this, 'SearchPageHeaderBottomLeft'));
        add_filter('thenext_sidebar_styles', array($this, 'SidebarStyles'));
    }

    function SidebarStyles($styles){
        $styles['boxed-panel'] = array(
            'style_name' => 'Boxed Panel',
            'before_widget' => '<div class="widget-boxed-panel">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-boxed-panel-heading widget-title">',
            'after_title' => '</h3>'
        );
        return $styles;
    }

    function PageHeaderBottomLeft(){
        $header_bottom_left_cont = "";
        if (function_exists('yoast_breadcrumb'))
            $header_bottom_left_cont =  yoast_breadcrumb('<a>', '</a>', false);
        echo apply_filters('page_header_bottom_left_content',$header_bottom_left_cont);
    }

    function SearchPageHeaderBottomLeft($header_bottom_left_cont = null){

        if(!is_search()) return $header_bottom_left_cont;

        ob_start();
        $all_post_types = get_post_types('','objects');
        $current_post_type = isset($_GET['post_type']) && post_type_exists($_GET['post_type']) ? $_GET['post_type'] : 'post';
        $cont = ob_get_clean();
        return $cont;
    }
}

new TheNextBase();

