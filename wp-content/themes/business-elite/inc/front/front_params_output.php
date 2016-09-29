<?php
/* include  fornt end framework class */
require_once('WDWT_front_params_output.php');

class Business_elite_front extends WDWT_frontend
{

  /*----Layout----*/
  public function layout()
  {
    global $post;
    if (isset($post) && is_singular()) {
      /*get all the meta of the current theme for the post*/
      $meta = get_post_meta($post->ID, WDWT_META, true);
    } else {
      $meta = array();
    }

    $default_layout = $this->get_param('default_layout', $meta);
    $full_width = $this->get_param('full_width', $meta);
    $content_area_percent = esc_html( $this->get_param('content_area_percent', $meta) );
    $content_area_percent = (intval($content_area_percent) < 100 && intval($content_area_percent) >= 75 ) ? intval($content_area_percent) : 75;
    $content_area_percent_large = esc_html( $this->get_param('content_area_percent_large', $meta) );
    $content_area_percent_large = (intval($content_area_percent_large) < 100 && intval($content_area_percent_large) >= 50 ) ? intval($content_area_percent_large) : 50;
    if($full_width){
      $content_area_percent  = 99;
      $content_area_percent_large = 99;
    }
    $main_column = $this->get_param('main_column', $meta);
    $pwa_width = $this->get_param('pwa_width', $meta);

    if ($full_width) { ?>
      <style type="text/css">
        #top-nav {
          width: 100% !important;
          margin: 0 auto;
        }
      </style>
      <script>
        var full_width_business_elite = 1;
      </script><?php echo "\r\n";
    } else { ?>
      <script>
        var full_width_business_elite = 0;
      </script><?php echo "\r\n";
    }

    switch ($default_layout) {
      case 1: ?>
        <style type="text/css">
          #sidebar1, #sidebar2 {
            display: none;
          }

          #blog, .blog {
            display: block;
            float: left;
          }

          .container {
            width: <?php echo $content_area_percent; ?>%;
            max-width: 100%;
          }
          @media only screen and (min-width: 1920px) {
            .container {
              width: <?php echo $content_area_percent_large; ?>%;
            }
          }

          #blog, .blog {
            width: 100%;
          }

        </style>
        <?php
        break;

      case 2: ?>
        <style type="text/css">
          #sidebar2 {
            display: none;
          }

          #sidebar1 {
            display: block;
            float: right;
          }

          .blog {
            display: block;
            float: left;
          }

          .container {
            width: <?php echo $content_area_percent; ?>%;
            max-width: 100%;
          }
          @media only screen and (min-width: 1920px) {
            .container {
              width: <?php echo $content_area_percent_large; ?>%;
            }
          }

          .blog {
            width: <?php echo $main_column; ?>%;
          }

          #sidebar1 {
            width: <?php echo (99  - $main_column); ?>%;
          }
        </style>
        <?php
        break;

      case 3: ?>
        <style type="text/css">
          #sidebar2 {
            display: none;
          }

          #sidebar1 {
            margin-right: 1%;
            display: block;
            float: left;
          }

          .blog {
            display: block;
            float: left;
          }

          .container {
            width: <?php echo $content_area_percent; ?>%;
            max-width: 100%;
          }
          @media only screen and (min-width: 1920px) {
            .container {
              width: <?php echo $content_area_percent_large; ?>%;
            }
          }

          .blog {
            width: <?php echo $main_column ; ?>%;
          }

          #sidebar1 {
            width: <?php echo (99 -  $main_column); ?>%;
          }

          #top-page .blog, #top-page #blog {
            left: <?php echo  (100 -  $main_column) ; ?>%;
          }
        </style>
        <?php
        break;

      case 4: ?>
        <style type="text/css">
          #sidebar1, #sidebar2 {
            display: block;
            float: right;
          }

          #blog, .blog {
            display: block;
            float: left;
          }

          .container {
            width: <?php echo $content_area_percent; ?>%;
            max-width: 100%;
          }
          @media only screen and (min-width: 1920px) {
            .container {
              width: <?php echo $content_area_percent_large; ?>%;
            }
          }

          .blog {
            width: <?php echo $main_column ; ?>%;
          }

          #sidebar1 {
            width: <?php echo ($pwa_width-1) ; ?>%;
            margin-left: 1%;
          }

          #sidebar2 {
            width: <?php echo (100  - $pwa_width - $main_column); ?>%;
          }
        </style>
        <?php
        break;

      case 5: ?>
        <style type="text/css">
          #sidebar1, #sidebar2 {
            display: block;
            float: left;
          }

          #blog, .blog {
            display: block;
            float: right;
          }

          .container {
            width: <?php echo $content_area_percent; ?>%;
            max-width: 100%;
          }
          @media only screen and (min-width: 1920px) {
            .container {
              width: <?php echo $content_area_percent_large; ?>%;
            }
          }

          .blog {
            width: <?php echo $main_column ; ?>%;
          }

          #sidebar1 {
            width: <?php echo ($pwa_width-1) ; ?>%;
            margin-right: 1%;
          }

          #sidebar2 {
            width: <?php echo (100 - $pwa_width - $main_column-1); ?>%;
            margin-right: 1%;
          }
        </style>
        <?php
        break;

      case 6: ?>
        <style type="text/css">
          #sidebar2 {
            display: block;
            float: right;
          }

          #sidebar1 {
            display: block;
            float: left;
          }

          .blog {
            display: block;
            float: left;
          }

          .container {
            width: <?php echo $content_area_percent; ?>%;
            max-width: 100%;
          }
          @media only screen and (min-width: 1920px) {
            .container {
              width: <?php echo $content_area_percent_large; ?>%;
            }
          }

          .blog {
            width: <?php echo $main_column ; ?>%;
          }

          #sidebar1 {
            width: <?php echo ($pwa_width-1) ; ?>%;
            margin-right: 1%;
          }

          #sidebar2 {
            width: <?php echo (100  - $pwa_width - $main_column); ?>%;
          }

          #top-page .blog, #top-page #blog {
            left: <?php echo $pwa_width ; ?>%;
          }
        </style>
        <?php
        break;
    }
  }

  /*------------ COLOR CONTROL -------------------*/
  public function color_control()
  {

    $background_color = get_theme_mod('background_color');
    $color_scheme = $this->get_param('[colors_active][active]', $meta_array = array(), $default = 0);
    $logo_text_color = $this->get_param('[colors_active][colors][logo_text_color][value]', $meta_array = array(), $default = '#ffffff');
    $header_back_color = $this->get_param('[colors_active][colors][header_back_color][value]', $meta_array = array(), $default = '#000000');
    $menu_elem_back_color = $this->get_param('[colors_active][colors][menu_elem_back_color][value]', $meta_array = array(), $default = '#000000');
    $menu_links_color = $this->get_param('[colors_active][colors][menu_links_color][value]', $meta_array = array(), $default = '#ffffff');

    $menu_links_hover_color = $this->get_param('[colors_active][colors][menu_links_hover_color][value]', $meta_array = array(), $default = '#0A7ED5');
    $slider_desc_color = $this->get_param('[colors_active][colors][slider_desc_color][value]', $meta_array = array(), $default = '#000000');
    $selected_menu_item = $this->get_param('[colors_active][colors][selected_menu_item][value]', $meta_array = array(), $default = '#000000');
    $top_posts_color = $this->get_param('[colors_active][colors][top_posts_color][value]', $meta_array = array(), $default = '#F8F8F8');
    $text_headers_color = $this->get_param('[colors_active][colors][text_headers_color][value]', $meta_array = array(), $default = '#5a5a5a');

    $primary_text_color = $this->get_param('[colors_active][colors][primary_text_color][value]', $meta_array = array(), $default = '#000000');
    $primary_links_color = $this->get_param('[colors_active][colors][primary_links_color][value]', $meta_array = array(), $default = '#000000');
    $primary_links_hover_color = $this->get_param('[colors_active][colors][primary_links_hover_color][value]', $meta_array = array(), $default = '#0A7ED5');
    $cat_tab_back_color = $this->get_param('[colors_active][colors][cat_tab_back_color][value]', $meta_array = array(), $default = '#545454');

    $featured_posts_color = $this->get_param('[colors_active][colors][featured_posts_color][value]', $meta_array = array(), $default = '#FFFFFF');
    $content_post_back = $this->get_param('[colors_active][colors][content_post_back][value]', $meta_array = array(), $default = '#FFFFFF');
    $sideb_background_color = $this->get_param('[colors_active][colors][sideb_background_color][value]', $meta_array = array(), $default = '#F3F3F4');
    $footer_title_color = $this->get_param('[colors_active][colors][footer_title_color][value]', $meta_array = array(), $default = '#000000');

    $footer_sideb_background_color = $this->get_param('[colors_active][colors][footer_sideb_background_color][value]', $meta_array = array(), $default = '#F3F3F4');
    $second_footer_sideb_background_color = $this->get_param('[colors_active][colors][second_footer_sideb_background_color][value]', $meta_array = array(), $default = '#FFFFFF');
    $footer_text_color = $this->get_param('[colors_active][colors][footer_text_color][value]', $meta_array = array(), $default = '#000000');
    $footer_back_color = $this->get_param('[colors_active][colors][footer_back_color][value]', $meta_array = array(), $default = '#FFFFFF');
    $date_color = $this->get_param('[colors_active][colors][date_color][value]', $meta_array = array(), $default = '#B2B0B0');
    $buttons_color = $this->get_param('[colors_active][colors][buttons_color][value]', $meta_array = array(), $default = '#B2B0B0');

    $lightbox_bg_color = $this->get_param('[colors_active][colors][lightbox_bg_color][value]', $meta_array = array(), $default = '#000000');
    $lightbox_ctrl_cont_bg_color = $this->get_param('[colors_active][colors][lightbox_ctrl_cont_bg_color][value]', $meta_array = array(), $default = '#000000');
    $lightbox_title_color = $this->get_param('[colors_active][colors][lightbox_title_color][value]', $meta_array = array(), $default = '#FFFFFF');
    $lightbox_ctrl_btn_color = $this->get_param('[colors_active][colors][lightbox_ctrl_btn_color][value]', $meta_array = array(), $default = '#FFFFFF');
    $lightbox_close_rl_btn_hover_color = $this->get_param('[colors_active][colors][lightbox_close_rl_btn_hover_color][value]', $meta_array = array(), $default = '#FFFFFF');
    ?>

    <style type="text/css">

      #slideshow .bwg_slideshow_description_text * {
        color: <?php echo $slider_desc_color;?>;
      }

      #sidebar1, #sidebar2 {
        border: 1px solid #<?php echo $background_color;?>;
      }

      /*--- HEADER TEXT ---*/
      h1, h2, h3, h1 > a, h2 > a, h3 > a, h1 > a:link, h2 > a:link, h3 > a:link, h1 > a:hover, h2 > a:hover, h3 > a:hover, h1 > a:visited, h2 > a:visited, h3 > a:visited, .sitemap.half-block h3, .half-block.sitemap ul li:before, #header, .inputboxx h4, #blog h3 a {
        color: <?php echo $text_headers_color; ?>;
      }
      body {
        color: <?php echo $primary_text_color; ?>;
      }
      /*--- PRIMARY TEXT ---*/
      h4, h5, h6, form, p, ul, ol, dl, h4 > a, h5 > a, h6 > a, h4 > a:link, h5 > a:link, h6 > a:link, h4 > a:hover, h5 > a:hover, h6 > a:hover, h4 > a:visited, h5 > a:visited, h6 > a:visited {
        color: <?php echo $primary_text_color; ?>;
      }

      .top_part p, .top_part h2 {
        color: <?php echo $text_headers_color;?>;
      }

      /*--- LOGO ---*/
      a:link.site-title-a, a:hover.site-title-a, a:visited.site-title-a, a.site-title-a, #logo h1 {
        color: <?php echo $logo_text_color;?> !important;
      }

      /*--- HEADER ---*/
      header {
        background: <?php echo $header_back_color; ?>;
      }

      #header {
        background: <?php echo $header_back_color; ?> !important;
      }

      .wdwt_loading_slider {
        background: # <?php echo $background_color; ?>;
        background-image: url(<?php echo WDWT_IMG; ?>loading_slider.gif);
      }

      #header.has_slider {
        background: <?php echo $this->hex_to_rgba($header_back_color, 0.20); ?> !important;
        -webkit-transition: background-color 1000ms linear;
        -moz-transition: background-color 1000ms linear;
        -o-transition: background-color 1000ms linear;
        -ms-transition: background-color 1000ms linear;
        transition: background-color 1000ms linear;
      }

      #header.has_slider #top-nav {
        -webkit-transition: background-color 10ms linear;
        -moz-transition: background-color 10ms linear;
        -o-transition: background-color 10ms linear;
        -ms-transition: background-color 10ms linear;
        transition: background-color 10ms linear;
      }

      #header.has_slider.sticky_menu #top-nav {
        -webkit-transition: background-color 5000ms linear;
        -moz-transition: background-color 5000ms linear;
        -o-transition: background-color 5000ms linear;
        -ms-transition: background-color 5000ms linear;
        transition: background-color 5000ms linear;
      }

      #header.sticky_menu {
        background: <?php echo $header_back_color; ?> !important;
      }

      /*--- MENU ---*/
      #top-nav {
        background: <?php echo $menu_elem_back_color; ?> !important;
      }

      .has_slider #top-nav {
        background: <?php echo $this->hex_to_rgba($menu_elem_back_color, 0.01); ?> !important;
      }

      #header.sticky_menu #top-nav {
        background: <?php echo $menu_elem_back_color; ?> !important;
      }

      .top-nav-list > li > ul, .top-nav-list ul li ul {
        background: <?php echo $menu_elem_back_color ?>;
      }

      .top-nav-list li a, .top-nav-list li.current_page_item > a, .top-nav-list li.current-menu-item > a,
      #site-description-p {
        color: <?php echo $menu_links_color; ?> !important;
      }

      .active_menu, .widget-area a:hover {
        color: <?php echo $primary_links_hover_color; ?> !important;
      }

      #top-nav > div > ul > li.current-menu-item,
      #top-nav > div > div > ul > li.current-menu-item,
      #top-nav > div > ul > li:hover,
      #top-nav > div > div > ul > li:hover,
      .top-nav-list > li > ul li:hover,
      .top-nav-list ul li ul li:hover {
        background-color: <?php echo $selected_menu_item ?> !important;
      }

      .has_slider #top-nav > div > ul > li.current-menu-item,
      .has_slider #top-nav > div > div > ul > li.current-menu-item,
      .has_slider #top-nav > div > ul > li:hover,
      .has_slider #top-nav > div > div > ul > li:hover {
        background-color: <?php echo $this->hex_to_rgba($selected_menu_item, 0.01); ?> !important;
      }

      .sticky_menu #top-nav > div > ul > li.current-menu-item,
      .sticky_menu #top-nav > div > div > ul > li.current-menu-item,
      .sticky_menu #top-nav > div > ul > li:hover,
      .sticky_menu #top-nav > div > div > ul > li:hover {
        background-color: <?php echo $selected_menu_item ?> !important;
      }

      #menu-button-block {
        background-color: <?php echo $text_headers_color; ?>;
      }

      #top-nav > div > ul > li > a:hover, #top-nav > div > ul > li > a:link:hover, .top-nav-list li a:hover,
      #top-nav > div > ul > li > a:visited:hover, #top-nav > div > div > ul > li > a:hover,
      #top-nav > div > div > ul > li > a:link:hover, #top-nav > div > div > ul > li > a:visited:hover, .active_menu {
        color: <?php echo $menu_links_hover_color; ?> !important;
      }

      .active_menu {
        background-color: <?php echo $selected_menu_item; ?> !important;
      }

      /*--- PRIMARY LINKS ---*/
      a {
        color: <?php echo $primary_links_color; ?>;
      }

      a:hover {
        color: <?php echo $primary_links_hover_color; ?>;
      }

      .widget_meta ul li a /*, .slaq*/
      {
        color: <?php echo $primary_links_color; ?>;
      }

      /*--- PRIMARY LINKS HOVER ---*/
      .widget_meta ul li a:hover, /*.slaq:hover,*/
      a:hover, /*.slaq:hover,*/
      #blog a:hover {
        color: <?php echo $primary_links_hover_color; ?>;
      }

      /*--- TOP PART OF PAGES & POSTS---*/
      .before_blog {
        background-color: # <?php echo get_background_color(); ?> !important;
      }

      .before_blog_2 {
        background-color: <?php echo '#'.$this->ligther($text_headers_color,15); ?>;
      }



      /*--- TOP POSTS & PORTFOLIO ---*/
      #top_posts_out, .portfolio_home {
        background-color: <?php echo $top_posts_color; ?>;
      }

      .more_info_tpost .tab-more, .page-navigation a, #copyright a, .logged-in-as a {
        color: <?php echo $primary_links_color; ?> !important;
      }

      .more_info_tpost .tab-more:hover, .page-navigation a:hover, #copyright a:hover, .logged-in-as a:hover {
        color: <?php echo $primary_links_hover_color; ?> !important;
      }

      /*--- CATEGORY TABS BACK. COLOR ---*/
      #wd-categories-tabs ul.tabs li.active, #wd-categories-tabs ul.tabs li.active:link,
      #wd-categories-tabs ul.tabs li a /*, #wd-categories-tabs  ul.content > li ul li div.text .slaq*/
      {
        background-color: <?php echo $cat_tab_back_color; ?>;
      }

      #wd-categories-tabs ul.content > li ul li h3 {
        color: <?php echo $text_headers_color; ?>;
      }

      #wd-categories-tabs ul.content > li ul li.active {
        border: 2px solid <?php echo $cat_tab_back_color; ?>;
      }

      /*--- FEATURED POST ---*/
      .full-width *, #videos-block .full-width #p1 a {
        color: <?php echo $featured_posts_color; ?> ;
      }

      .blog-post h3 a {
        color: <?php echo $text_headers_color; ?> ;
      }

      /*--- SIDEBAR BACK. ---*/
      #wdposts-tabs ul, #sidebar1, #sidebar2 {
        background-color: <?php echo $sideb_background_color; ?>;
      }

      /*--- CONTENT POSTS ---*/
      .home_blog_post {
        background-color: <?php echo $content_post_back; ?>;
      }

      #blog_home .date {
        background-color: #DDDDDD !important;
        color: #ffffff !important;
      }

      /*--- FIRST FOOTER SIDEBAR BACK. ---*/
      #sidebar3 {
        background-color: <?php echo $footer_sideb_background_color; ?>;
      }

      /*--- SECOND FOOTER SIDEBAR BACK. ---*/
      #sidebar4 {
        background-color: <?php echo $second_footer_sideb_background_color; ?>;
      }

      /*--- FOOTER BACK. ---*/
      #footer-bottom {
        background-color: <?php echo $footer_back_color; ?>;
      }

      /*--- FOOTER TITLE ---*/
      .widget-container h3, .widget-area h3, .most_categories h3 > a, .percent_text_title, aside .widget-area > h3 {
        color: <?php echo $footer_title_color; ?>;
      }

      /*--- FOOTER TEXT ---*/
      #footer-bottom, #sidebar3, #sidebar3 p, #sidebar4, #sidebar4 p {
        color: <?php echo $footer_text_color; ?>;
      }

      /*--- META INFO ---*/
      .entry-meta *, .date, .meta-date a, .author.vcard a, .entry-date, .sep, .categories-links a {
        color: <?php echo $date_color; ?> !important;
      }

      .entry-date:hover, .categories-links a:hover {
        color: <?php echo $primary_links_hover_color; ?> !important;
      }

      /*--- BUTTONS ---*/
      #blog .content-posts .tab-more, #blog_home .content-posts .tab-more, .blog-post .read_more {
        color: <?php echo $primary_links_color; ?>;
      }

      #blog .content-posts .tab-more:hover, #blog_home .content-posts .tab-more:hover, .blog-post .read_more:hover {
        color: <?php echo $primary_links_hover_color; ?>;
      }

      .inputboxx_home .reset_home:hover, .inputboxx_home .submit_home:hover,
      .inputboxx_home .reset_home:focus, .inputboxx_home .submit_home:focus {
        border: 1px solid <?php echo $buttons_color; ?>;
      }

      #commentform #submit:focus, .reset:focus, .contact_send:focus, .page-login .log-out:focus, .reply:focus, #log_in div .read_more:focus, #searchsubmit:focus {
        outline: none !important;
      }

      #commentform #submit, .reset, .contact_send, .page-login .log-out, #log_in div .read_more, #searchsubmit, .reply, .slaq a, .about_content a.read_more,
      .top_posts.pagination_button, .content_posts_home_pagination, .portfolio_home_pagination {
        background-color: <?php echo $buttons_color; ?>;
        color: <?php echo $primary_links_color; ?> ;
      }

      .wd_cat_tabs.pagination_button .fa {
        color: <?php echo $buttons_color; ?> !important;
      }

      .wd_cat_tabs.pagination_button .fa:hover {
        color: # <?php echo $this->ligther($buttons_color,30); ?> !important;
      }

      #commentform #submit:hover, .reset:hover, .contact_send:hover, .page-login .log-out:hover, #log_in div .read_more:hover, #searchsubmit:hover, .reply:hover, .slaq a:hover, .about_content a.read_more:hover,
      .top_posts.pagination_button:hover, .content_posts_home_pagination:hover, .portfolio_home_pagination:hover {
        background-color: <?php echo '#'.$this->ligther($buttons_color,15); ?> ;
        color: <?php echo '#'.$this->ligther($primary_links_color,20); ?> ;
      }


      .comment-edit-link, .comment-author.vcard a {
        color: <?php echo $primary_links_color; ?> !important;
      }



      #TB_prev a:hover, #TB_next a:hover {
        color: <?php echo $menu_links_hover_color; ?> !important;
      }

      #blog_home a {
        color: <?php echo $primary_links_color; ?>;
      }

      #blog a:hover, #blog_home a:hover {
        color: <?php echo $primary_links_hover_color; ?>;
      }

      .half-block.sitemap a {
        color: <?php echo $primary_links_color; ?> !important;
      }

      .half-block.sitemap a:hover {
        color: <?php echo $primary_links_hover_color; ?> !important;
      }

      /*--- ZOOM EYE ---*/
      .circle:hover, .eye_port:hover, .eye_blog:hover, .eye_our:hover, .link_post:hover {
        background-color: <?php echo $buttons_color; ?> !important;
      }

      .cont_us_top .circle:hover {
        background-color: inherit !important;
      }

      .sticky_post {
        border: 5px double <?php echo $text_headers_color; ?>;
      }
      @media only screen and (max-width : 767px){
        #menu-button-block #trigram-for-heaven,
        #menu-button-block #trigram-for-heaven {
          color: <?php echo $selected_menu_item; ?> !important;;
        }

        #top-nav > div ul, #top-nav > div > div ul {
          background-color: <?php echo $menu_elem_back_color; ?>;
        }
      }
    </style>
    <?php
  }


  /**
   * styling of menu and logo
   */
  public function menu_size()
  {
    $menu_section_width = intval($this->get_param('menu_section_width', array(), 80));
    $menu_section_width = ($menu_section_width > 0 && $menu_section_width <= 100) ? $menu_section_width : 80;

    ?>
    <style>
      #header-middle {
        width: <?php echo 100 - $menu_section_width; ?>%;
      }

      #header .phone-menu-block {
        width: <?php echo $menu_section_width; ?>%;
      }
    </style>
    <?php
  }

  /*------------Display logo image or text -------------------*/
  public function logo()
  {
    $logo_type = $this->get_param('logo_type');
    $logo_img = esc_url(trim($this->get_param('logo_img')));
    $logo_text = esc_attr(trim($this->get_param('logo_text')));
    if ($logo_text == '') {
      $logo_text = get_bloginfo('name', 'display');
    }

    ?>

    <?php
    if ($logo_type == 'image'): ?>
      <div id="header-middle" class="show_in_stiky">
        <a id="logo" href="<?php echo esc_url(home_url('/')); ?>"
           title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
          <img id="site-title" src="<?php echo $logo_img; ?>" alt="logo">
        </a>
      </div>
    <?php elseif ($logo_type == 'text'): ?>
      <div id="header-middle">
        <a id="logo" href="<?php echo esc_url(home_url('/')); ?>"
           title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
          <h1><?php echo $logo_text; ?></h1>
        </a>
      </div>
      <?php
    endif; ?>

    <?php
  }

  /*------------ SLIDER  -------------------*/
  public function slideshow()
  {
    $hide_slider = $this->get_param('hide_slider');
    $image_height = $this->get_param('image_height');
    $title_position = $this->get_param('title_position');
    $description_position = $this->get_param('description_position');
    $disable_slider_on_mobile = $this->get_param('disable_slider_on_mobile');

    $imgs_url = $this->get_param('slider_head');
    $imgs_href = $this->get_param('slider_head_href');
    $image_title = $this->get_param('slider_head_title');
    $image_textarea = $this->get_param('slider_head_desc');

    $imgs_url = explode('||wd||', $imgs_url);
    $imgs_href = explode('||wd||', $imgs_href);
    $image_title = explode('||wd||', $image_title);
    $image_textarea = explode('||wd||', $image_textarea);
    /*version 1.x*/
    array_splice($imgs_url, 2);
    array_splice($imgs_href, 2);
    array_splice($image_title, 2);
    array_splice($image_textarea, 2);

    $imgs_number = count($imgs_url);


    /*clear from spaces etc */
    foreach ($imgs_url as $i => $url) {
      $imgs_url[$i] = trim($url);
    }
    for ($i = 0; $i <= $imgs_number; $i++) {
      $imgs_href[$i] = isset($imgs_href[$i]) ? trim($imgs_href[$i]) : '';
      $image_title[$i] = isset($image_title[$i]) ? trim($image_title[$i]) : '';
      $image_textarea[$i] = isset($image_textarea[$i]) ? trim($image_textarea[$i]) : '';
    }

    if (($hide_slider[0] != "Hide Slider" && ((is_home() && $hide_slider[0] == "Only on Homepage") || (is_front_page() && $hide_slider[0] == "Only on Front Page") || $hide_slider[0] == "On all the pages and posts")) && count($imgs_url) && is_array($imgs_url)) { ?>
      <script>
        jQuery(document).ready(function ()
        {
          jQuery('#header').addClass('has_slider');
          jQuery('#header').css('position', 'absolute');
        });
      </script>
      <script>
        var data = [];
        var event_stack = [];
        <?php
        /*- image -*/
        if ($imgs_url && is_array($imgs_url))
          $link_array = $imgs_url;
        else
          $link_array = array();

        for ($i = 0; $i < count($link_array); $i++) {
          echo 'data["' . $i . '"]=[];';
        }
        for ($i = 0; $i < count($link_array); $i++) {
          echo 'data["' . $i . '"]["id"]="' . $i . '";';
          echo 'data["' . $i . '"]["image_url"]="' . $link_array[$i] . '";';
        }

        /*- title -*/
        if ($image_title && is_array($image_title)) {
          $title_array = $image_title;
        } else {
          $title_array = array();
        }
        for ($i = 0; $i < count($title_array); $i++) {
          if (isset($title_array[$i]) && $title_array[$i] != '') {
            echo 'data["' . $i . '"]["alt"]="' . str_replace(array("\n", "\r"), '', $title_array[$i]) . '";';
          }
        }

        /*- description -*/
        if ($image_textarea && is_array($image_textarea))
          $textarea_array = $image_textarea;
        else
          $textarea_array = array();

        for ($i = 0; $i < count($textarea_array); $i++) {
          if (isset($textarea_array[$i]) && $textarea_array[$i] != '') {
            echo 'data["' . $i . '"]["description"]="' . str_replace(array("\n", "\r"), '', addslashes($textarea_array[$i])) . '";';
          }
        }
        ?>
      </script>

      <?php $slideshow_title_position = explode('-', trim($title_position[0]));
      $slideshow_description_position = explode('-', trim($description_position[0])); ?>

      <style>
        /*keep slider size ratio before iamges are loaded*/
        /*laoding palceholder*/
        #slideshow {
          padding-bottom: <?php echo $image_height/1024 * 100; ?>%;
        }

        .slider_contener_for_exklusive {
          position: absolute;
          width: 100%;
          height: 100%;
        }

        .bwg_slideshow_image_wrap {
          width: 100% !important;
        }

        .bwg_slideshow_title_span {
          text-align: <?php echo esc_html( $slideshow_title_position[0] ); ?>;
          vertical-align: <?php echo esc_html( $slideshow_title_position[1] ); ?>;
        }

        .bwg_slideshow_description_span {
          text-align: <?php echo esc_html( $slideshow_description_position[0] ); ?>;
          vertical-align: <?php echo esc_html( $slideshow_description_position[1] ); ?>;
        }
      </style>

      <!--SLIDESHOW START-->
      <div id="slideshow" <?php echo ($disable_slider_on_mobile) ? "class='hide_on_phone'" : ""; ?>>
        <div class="slider_contener_for_exklusive">
          <div class="bwg_slideshow_image_wrap" id="bwg_slideshow_image_wrap_id">
            <?php $current_image_id = 0;
            $current_pos = 0;
            $current_key = 0; ?>

            <!--################# DOTS ################# -->
            <a id="spider_slideshow_left"
               onclick="bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) >= 0 ? (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) % data.length : data.length - 1, data); return false;">
              <span id="spider_slideshow_left-ico"><span><i class="bwg_slideshow_prev_btn fa"></i></span></span>
            </a>
            <a id="spider_slideshow_right"
               onclick="bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) + iterator()) % data.length, data); return false;">
              <span id="spider_slideshow_right-ico"><span><i class="bwg_slideshow_next_btn fa "></i></span></span>
            </a>

            <!--################ IMAGES ################## -->
            <div id="bwg_slideshow_image_container" width="100%" class="bwg_slideshow_image_container">
              <div class="bwg_slide_container" width="100%">
                <div class="bwg_slide_bg">
                  <div class="bwg_slider">
                    <?php
                    if ($imgs_href && is_array($imgs_href))
                      $href_array = $imgs_href;
                    else
                      $href_array = array();
                    if ($imgs_url && is_array($imgs_url))
                      $image_rows = $imgs_url;
                    else
                      $image_rows = array();
                    $i = 0;

                    foreach ($image_rows as $key => $image_row) {
                      if ($i == $current_image_id) {
                        $current_key = $key; ?>
                        <span class="bwg_slideshow_image_span" id="image_id_<?php echo $i; ?>">
													<span class="bwg_slideshow_image_span1">
														<span class="bwg_slideshow_image_span2">
															<a href="<?php if (isset($href_array[$i])) echo $href_array[$i]; ?>">
																<img id="bwg_slideshow_image" class="bwg_slideshow_image"
                                     src="<?php echo $image_row; ?>" image_id="<?php echo $i; ?>"/>
															</a>
														</span>
													</span>
												</span>
                        <input type="hidden" id="bwg_current_image_key" value="<?php echo $key; ?>"/>
                        <?php
                      } else { ?>
                        <span class="bwg_slideshow_image_second_span" id="image_id_<?php echo $i; ?>">
													<span class="bwg_slideshow_image_span1">
														<span class="bwg_slideshow_image_span2">
															<a href="<?php if (isset($href_array[$i])) echo $href_array[$i]; ?>"><img
                                  id="bwg_slideshow_image_second" class="bwg_slideshow_image"
                                  src="<?php echo $image_row; ?>"/></a>
														</span>
													</span>
												</span>
                        <?php
                      }
                      $i++;
                    } ?>
                  </div>
                </div>
              </div>
              <?php if (isset($enable_slideshow_ctrl) && $enable_slideshow_ctrl) { ?>
                <a id="spider_slideshow_left"
                   href="javascript:bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) >= 0 ? (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) % data.length : data.length - 1, data);"><span
                    id="spider_slideshow_left-ico"><span><i
                        class="bwg_slideshow_prev_btn fa <?php echo $theme_row->slideshow_rl_btn_style; ?>-left"></i></span></span></a>

                <span id="bwg_slideshow_play_pause"><span><span id="bwg_slideshow_play_pause-ico"><i
                        class="bwg_ctrl_btn bwg_slideshow_play_pause fa fa-play"></i></span></span></span>
                <a id="spider_slideshow_right"
                   href="javascript:bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) + iterator()) % data.length, data);"><span
                    id="spider_slideshow_right-ico"><span><i
                        class="bwg_slideshow_next_btn fa <?php echo $theme_row->slideshow_rl_btn_style; ?>-right"></i></span></span></a>
              <?php } ?>
            </div>
            <!--################ TITLE ################## -->
            <div class="bwg_slideshow_image_container" style="position: absolute;">
              <div class="bwg_slideshow_title_container">
                <div style="display:table; margin:0 auto;">
									<span class="bwg_slideshow_title_span">
										<div class="bwg_slideshow_title_text">
											<?php if (isset($title_array[0]) && $title_array[0] != "") { ?>
                        <div><?php echo $title_array[0]; ?></div>
                      <?php } ?>
										</div>
									</span>
                </div>
              </div>
            </div>
            <!--################ DESCRIPTION ################## -->
            <div class="bwg_slideshow_image_container" style="position: absolute;">
              <div class="bwg_slideshow_title_container">
                <div style="display:table; margin:0 auto;">
									<span class="bwg_slideshow_description_span">
										<div class="bwg_slideshow_description_text">
											<?php if (isset($textarea_array[0]) && $textarea_array[0] != "") { ?>
                        <div><?php echo $textarea_array[0]; ?></div>
                      <?php } ?>
										</div>
									</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="wdwt_loading_slider"></div>
      </div>
      <!--SLIDESHOW END-->
      <?php
    }
  }

  public function frontpage_content_posts()
  {
    global $wdwt_front;
    $content_posts_enable = $wdwt_front->get_param('content_posts_enable');
    $content_posts_margin = intval($wdwt_front->get_param('content_posts_margin', array(), 0));

    if ($content_posts_enable) { ?>
      <style>
        .content-posts-container .content-post {
          width: calc(25% - <?php echo 2* $content_posts_margin +2 ; ?>px);
        }

        .content-posts-container .content-post {
          margin: <?php echo $content_posts_margin; ?>px;
        }
        @media only screen and (max-width: 1024px) {
          .content-posts-container .content-post {
            margin: <?php echo $content_posts_margin; ?>px 0;
            width: calc(100% - 2px);
          }
        }
        @media only screen and (max-width: 767px) {
          .content-posts-container .content-post {
            display: inline-block;
            float: none !important;
          }
          .content-posts-container {
            text-align: center;
          }
        }
      </style>
      <?php
    }
  }


}

?>