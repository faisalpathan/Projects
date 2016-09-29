<?php
/** Theme Name: Kyma
 *  Theme Core Functions and Codes
 **/
define('HEADER_IMAGE_WIDTH', apply_filters('kyma_header_image_width', 1168));
define('HEADER_IMAGE_HEIGHT', apply_filters('kyma_header_image_height', 75));
require get_template_directory() . '/functions/menu/default_menu_walker.php';
require get_template_directory() . '/functions/menu/kyma_nav_walker.php';
require_once dirname(__FILE__) . '/default_options.php';
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require get_template_directory() . '/functions/customize/contact-widgets.php';
require get_template_directory() . '/functions/customize/recent-posts.php';
include get_template_directory() . '/inc/welcome-screen/welcome-screen.php';
if (!class_exists('Kirki')) {
    include_once dirname(__FILE__) . '/inc/kirki/kirki.php';
}
function kyma_customizer_config()
{
    $args = array(
        'url_path'     => get_template_directory_uri() . '/inc/kirki/',
        'capability'   => 'edit_theme_options',
        'option_type'  => 'option',
        'option_name'  => 'kyma_theme_options',
        'compiler'     => array(),
        'color_accent' => '#27bebe',
        'width'        => '23%',
        'description'  => __('Visit our site for more great Products.If you like this theme please rate us 5 star', 'kyma'),
    );
    return $args;
}

add_filter('kirki/config', 'kyma_customizer_config');
require get_template_directory() . '/customizer.php';
add_action('after_setup_theme', 'kyma_theme_setup');
global $kyma_theme_options;
function kyma_theme_setup()
{
    global $content_width;
    //content width
    if (!isset($content_width)) {
        $content_width = 835;
    }
    //px
    //supports featured image
    add_theme_support('post-thumbnails');
    load_theme_textdomain('kyma', get_template_directory() . '/lang');
    // image resize according to image layout
    add_image_size('kyma_home_post_image', 360, 231, true);
    add_image_size('kyma_related_post_thumb', 265, 170, true);
    add_image_size('kyma_home_post_thumb', 334, 215, true);
    add_image_size('kyma_home_post_full_thumb', 456, 293, true);
    add_image_size('kyma_single_post_image', 835, 428, true);
    add_image_size('kyma_single_post_full', 1140, 585, true);
    add_image_size('kyma_recent_widget_thumb', 90, 60, true);
    add_image_size('kyma_slider_post', 1349, 540, true);
    // This theme uses wp_nav_menu() in one location.
    register_nav_menu('primary', __('Primary Menu', 'kyma'));
    register_nav_menu('secondary', __('Secondary Menu', 'kyma'));
    // theme support
    add_editor_style(get_stylesheet_uri());
    $args = array('default-color' => '#ffffff');
    add_theme_support('custom-background', $args);
    add_theme_support('custom-header');
    add_theme_support('automatic-feed-links');
    add_theme_support('woocommerce');
    add_theme_support('title-tag');
	add_theme_support( 'custom-logo', array(
		'height'      => 75,
		'width'       => 150,
		'flex-height' => true,
	) );
}

add_action('wp_enqueue_scripts', 'kyma_enqueue_style');
function kyma_enqueue_style()
{
    wp_enqueue_style('Kyma', get_stylesheet_uri());
    wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.css');
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css');
    if (is_singular()) {
        wp_enqueue_script("comment-reply");
    }

    wp_enqueue_style('Oswald', '//fonts.googleapis.com/css?family=Oswald:400,700,300');
    wp_enqueue_style('lato', '//fonts.googleapis.com/css?family=Lato:300,300italic,400italic,600,600italic,700,700italic,800,800italic');
    wp_enqueue_style('open-sans', '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic');
    global $kyma_theme_options;
    if ($kyma_theme_options['portfolio_three_column']) {
        $custom_css = '@media (min-width: 992px) { .wl-gallery{ width:33.33% !important;} }';
        wp_add_inline_style('Kyma', $custom_css);
    }
	if ($kyma_theme_options['site_layout']=='site_boxed') {
        $custom_css = '#kyma_owl_slider .owl_slider_con { left: 57%; }';
        wp_add_inline_style('Kyma', $custom_css);
    }
}

add_action('wp_footer', 'kyma_enqueue_in_footer');
function kyma_enqueue_in_footer()
{
    wp_enqueue_script('plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'));
    wp_enqueue_script('functions', get_template_directory_uri() . '/js/functions.js', array('jquery'));

    $kyma_theme_options = kyma_theme_options();
    $blog_post_count    = $kyma_theme_options['blog_post_count'];
    $count_posts=0;
    /* get home post category */
    $home_post_cat    = $kyma_theme_options['home_post_cat'];
    if(!empty($home_post_cat)){
        /* count all posts of selected categories */
        foreach ($home_post_cat as $cat) {
            $category = get_category($cat);
            $count_posts+= $category->category_count;
        }
    }else{
        $count_posts =  wp_count_posts()->publish;
    }
    wp_enqueue_script('load-posts', get_template_directory_uri() . '/js/load-posts.js');
    wp_localize_script('load-posts', 'load_more_posts_variable', array(
        'counts_posts'    => $count_posts,
        'blog_post_count' => $blog_post_count,
    )
    );
}
// Read more tag to formatting in blog page
function kyma_content_more($read_more)
{
    return '<div class=""><a class="main-button" href="' . get_permalink() . '">' . __('Read More', 'kyma') . '<i class="fa fa-angle-right"></i></a></div>';
}

add_filter('the_content_more_link', 'kyma_content_more');
// Replaces the excerpt "more" text by a link
function kyma_excerpt_more($more)
{
    return '<br><a class="btn_a" href="' . esc_url(get_permalink()) . '"><span><i class="in_left fa fa-angle-right"></i><span>' . __('Details', 'kyma') . '</span><i class="in_right fa fa-angle-right"></i></span></a>';
}

add_filter('excerpt_more', 'kyma_excerpt_more');
/*
 * Kyma widget area
 */
add_action('widgets_init', 'kyma_widget');
function kyma_widget()
{
    /*sidebar*/
    $kyma_theme_options = kyma_theme_options();
    $col                = 12 / (int) $kyma_theme_options['footer_layout'];
    register_sidebar(array(
        'name'          => __('Sidebar Widget Area', 'kyma'),
        'id'            => 'sidebar-widget',
        'description'   => __('Sidebar widget area', 'kyma'),
        'before_widget' => '<div class="widget_block">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="widget_title">',
        'after_title'   => '</h6>',
    ));
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'kyma'),
        'id'            => 'footer-widget',
        'description'   => __('Footer widget area', 'kyma'),
        'before_widget' => '<div class="footer-widget-col col-md-' . $col . '">
                                <div class="footer_row">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="footer_title">',
        'after_title'   => '</h6>',
    ));
}

/* Breadcrumbs  */
function kyma_breadcrumbs()
{
    $delimiter = '<span class="crumbs-spacer"><i class="fa fa-angle-right"></i></span>';
    $home      = __('Home', 'kyma'); // text for the 'Home' link
    $pre_text  = __('', 'kyma');
    $before    = ''; // tag before the current crumb
    $after     = '</li>'; // tag after the current crumb
    echo '<ul class="breadcrumbs">';
    global $post;
    $homeLink = home_url();
    echo '<li>' . $pre_text . '<a href="' . $homeLink . '">' . $home . '</a>' . $delimiter;
    if (is_category()) {
        global $wp_query;
        $cat_obj   = $wp_query->get_queried_object();
        $thisCat   = $cat_obj->term_id;
        $thisCat   = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0) {
            echo (get_category_parents($parentCat, true, ' ' . $delimiter . '</li> '));
        }
        echo $before .  single_cat_title('', false) . $after;
    } elseif (is_day()) {
        echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a>' . $delimiter . '</li>';
        echo '<li><a href="' . esc_url(get_month_link(get_the_time('Y')), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter;
        echo $before . get_the_time('d') . '</li>';
    } elseif (is_month()) {
        echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a>' . $delimiter;
        echo $before . get_the_time('F') . '</li>';
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . '</li>';
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug      = $post_type->rewrite;
            echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter;
            echo $before . get_the_title() . '</li>';
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            echo $before . get_the_title() . '</li>';
        }
    } elseif (!is_single() && !is_page() && get_post_type() && get_post_type() != 'post') {
        echo $before . $post_type->labels->singular_name . $after;
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat    = get_the_category($parent->ID);
        $cat    = $cat[0];
        echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
        echo '<li><a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a>' . $delimiter;
        echo $before . esc_attr(get_the_title()) . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . esc_attr(get_the_title()) . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id   = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page          = get_page($parent_id);
            $breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_attr(get_the_title($page->ID)) . '</a></li>';
            $parent_id     = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) {
            echo $crumb . ' ' . $delimiter . ' ';
        }

        echo $before . esc_attr(get_the_title()) . $after;
    } elseif (is_search()) {
        echo $before . _e("Search results for ", 'kyma') . esc_attr(get_search_query()) . '"' . $after;
    } elseif (is_tag()) {
        echo $before . _e('Tag ', 'kyma') . single_tag_title('', false) . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . _e("Articles posted by ", 'kyma') . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . _e("Error 404 ", 'kyma') . $after;
    }
    echo '</ul>';
}

function kyma_comments($comments, $args, $depth)
{
    $GLOBALS['comment'] = $comments;
    extract($args, EXTR_SKIP);
    if ('div' == $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <li class="comments single_comment">
    <div class="comment-container comment-box">
        <div class="trees_number">1</div>
        <?php if ($args['avatar_size'] != 0) {
        echo get_avatar($comments, $args['avatar_size']);
    }
    ?>
        <div class="comment_content">
            <h4 class="author_name"><?php printf('%s', esc_attr(get_comment_author()));?></h4>
                <span class="comment_meta">
                    <a href="#">
                        <time
                            datetime="2015-10-01T19:56:36+00:00"><?php printf(__('%1$s at %2$s', 'kyma'), get_comment_date(), get_comment_time());?></time>
                    </a>
                </span><?php
if ($comments->comment_approved == '0') {
        ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'kyma');?></em><br/>
        </div><?php } else {
        ?>
        <div class="comment_said_text">
            <?php comment_text();?>
        </div>
        <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])));
    }
    ?>
    </div></div><?php
}

if (!function_exists('kyma_pagination')) {
    function kyma_pagination()
    {
        $prev_arrow = is_rtl() ? '<i class="<i class="fa fa-angle-right"></i>' : '<i class="fa fa-angle-left"></i>';
        $next_arrow = is_rtl() ? '<i class="fa fa-angle-left"></i>' : '<i class="fa fa-angle-right"></i>';
        global $wp_query;
        $total = $wp_query->max_num_pages;
        $big   = 999999999; // need an unlikely integer
        if ($total > 1) {
            if (!$current_page = get_query_var('paged')) {
                $current_page = 1;
            }

            if (get_option('permalink_structure')) {
                $format = 'page/%#%/';
            } else {
                $format = '&paged=%#%';
            }
            echo paginate_links(array(
                'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'    => $format,
                'current'   => max(1, get_query_var('paged')),
                'total'     => $total,
                'mid_size'  => 3,
                'type'      => 'list',
                'prev_text' => $prev_arrow,
                'next_text' => $next_arrow,
            ));
        }
    }

}
/* TGMPA register */
add_action('tgmpa_register', 'kkyma_register_required_plugins');
function kkyma_register_required_plugins()
{
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin bundled with a theme.
        array(
            'name'     => 'Photo Video Gallery Master', // The plugin name.
            'slug'     => 'photo-video-gallery-master', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        ),
		array(
            'name'     => 'Ultimate Gallery Master', // The plugin name.
            'slug'     => 'ultimate-gallery-master', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        ),
		array(
            'name'     => 'Social Media Gallery', // The plugin name.
            'slug'     => 'social-media-gallery', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        ),
    );
    $config = array(
        'id'           => 'kyma', // Unique ID for hashing notices for multiple instances of kyma.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu'         => 'kyma-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php', // Parent menu slug.
        'capability'   => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true, // Show admin notices or not.
        'dismissable'  => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message'      => '', // Message to output right before the plugins table.
    );
    kyma($plugins, $config);
}

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'kyma_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'kyma_theme_wrapper_end', 10);
function kyma_theme_wrapper_start()
{
    get_template_part('header_call_out');
    echo '<section class="content_section">
            <div class="content">
                <div class="internal_post_con clearfix">
                    <div class="hm_blog_full_list hm_blog_list clearfix">';
}

function kyma_theme_wrapper_end()
{
    ?>
    </div></div></div></section>
<?php }