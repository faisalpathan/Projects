<?php
/* include front end framework class */
require_once('WDWT_front_functions.php');

class Business_elite_frontend_functions extends WDWT_frontend_functions {
  
/*----------- PAGE/POST INFORMATION --------------*/
  public static function posted_on() {
    printf('<span class="sep date"></span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
      esc_url( get_permalink() ),
      esc_attr( get_the_time() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() )
    );
  } 
/*----- PAGE/POST INFORMATION ------*/  
  public static function posted_on_single() {
    printf('<span class="sep date"></span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep author"></span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>',
      esc_url( get_permalink() ),
      esc_attr( get_the_time() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() ),
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      esc_attr( sprintf( __( 'View all posts by %s', "business-elite" ), get_the_author() ) ),
      get_the_author()
    );
  }
  
/*----- HOME TOP POST ------*/
  public static function top_posts($paged = 1) {
    global $wdwt_front;

    $top_posts_enable = $wdwt_front->get_param('top_posts_enable');
    $top_posts_title = stripcslashes($wdwt_front->get_param('top_posts_title'));
    $top_posts_description = stripslashes( $wdwt_front->get_param('top_posts_description'));    
    $top_posts_categories = implode(",", $wdwt_front->get_param('top_posts_categories', array(), array(''))) ;

    $home_top_posts = get_option( 'posts_per_page', 2); 
    
    if($top_posts_enable && $home_top_posts!=0){ 
      $args = array('paged'=> $paged,
                    'posts_per_page'=>3,
                    'cat' => $top_posts_categories,
                    'orderby' => 'date',
                    'order'=>'DESC');

      $wp_query = new WP_Query($args);

      if($wp_query->have_posts()) {   ?>
      <div class="container">
        <div id="top-posts">
          <!-- TTILE & DESCRIPTION-->
          <div class="top_part">
            <h2> <?php echo $top_posts_title; ?> </h2>
            <p> <?php echo $top_posts_description; ?> </p>
          </div>
          
          <ul id="top_posts_list">
            <?php 
              while ($wp_query->have_posts()) {               
                  $wp_query->the_post();
                  $tumb_id = get_post_thumbnail_id( get_the_ID() );
                  $thumb_url = wp_get_attachment_image_src($tumb_id,'full');

                  if( $thumb_url ) {
                    $thumb_url = $thumb_url[0];
                  }  
                  else {
                    $thumb_url = self::catch_that_image();
                    $thumb_url = $thumb_url['src'];
                  }
                  
                  $background_image = $thumb_url; 
                  ?>
                  <li>
                    <div class="image-block">                   
                      <div style="background: url(<?php echo $background_image; ?>) no-repeat center !important; background-size:contain !important; "></div>
                    </div>
                    <div class="top_content">
                      <!-- TITLE -->
                      <a href="<?php the_permalink(); ?>"><h3 class="top_post_title"><?php the_title(); ?></h3></a>
                      <!-- CONTENT -->
                      <div class="text-block">              
                        <div class="text" style="color:white;">
                          <p><?php self::the_excerpt_max_charlength(200); ?></p>
                        </div>  
                      </div>
                      <!-- MORE INFO -->
                      <div class="more_info_tpost">
                        <a class="tab-more" href="<?php echo get_permalink(); ?>"><?php echo __('More Info',"business-elite");?>  </a>
                      </div>
                    </div>
                  </li>
                  <?php
                
            } ?>
          </ul>
          
        </div>
      </div>
      <?php
      
        if($paged >1){ ?>
          <span class="top_posts pagination_button" id="top_posts_left" onclick="wdwt_front_ajax_pagination(<?php echo $paged-1; ?>, 'top_posts', '#top_posts_out');" ><i class="fa fa-chevron-left"></i></span>
      <?php
        }
        if($paged < $wp_query->max_num_pages){ ?>
          <span class="top_posts pagination_button" id="top_posts_right" onclick="wdwt_front_ajax_pagination(<?php echo $paged+1; ?>, 'top_posts', '#top_posts_out');"><i class="fa fa-chevron-right"></i></span>
        <?php
        }
      }

    }
  } 


  /*----- CATEGORY TAB ------*/
  public static function category_tab(){
    global $wdwt_front;
    

    $category_tabs_enable = $wdwt_front->get_param('category_tabs_enable');
    $category_tabs_categories2 = $wdwt_front->get_param('category_tabs_categories', array(), array());
    
    $category_tabs_categories = array();
    foreach ($category_tabs_categories2 as $category_id) {
      
      $category_translated_id = apply_filters( 'wpml_object_id', $category_id, 'category' );
      if($category_translated_id){
        array_push($category_tabs_categories, $category_translated_id);  
      }
      
    }

    $args = array(
      'orderby' => 'name',
      'order' => 'ASC'
    );
    $categories = get_categories($args);
    $lang_defined = defined('ICL_LANGUAGE_CODE');
    if($lang_defined){
      $lang_current = ICL_LANGUAGE_CODE;
    }
    else{
     $lang_current = 0; 
    }

    if ($category_tabs_enable){ 
      if( empty($category_tabs_categories)){
        $category_tabs_categories = array(1);/*only uncategorized*/
      } ?>
      <div id="wd-categories-tabs" class="content-inner-block">
        <ul class="tabs">
          <?php
          $count_of_posts=3;
          $user_selected_categories=$category_tabs_categories;
          
          $top_tabs_categorys = array();
          $real_category_exsist=0;
          if( $category_tabs_categories == "" ){
            $user_selected_categories=array();
            for($i=1; $i<count($categories); $i++){
              $user_selected_category = $categories[$i]->name;
              $user_selected_category_desc = $categories[$i]->description;
              $top_tabs_categorys[$i]['category_name']=$user_selected_category;
              $top_tabs_categorys[$i]['category_description']=$user_selected_category_desc;
              
              $top_tabs_categorys[$i]['query']='posts_per_page='.($count_of_posts).'&cat='.$categories[$i]->term_id.'&order=DESC';
              if($i==3)
                break;
            } 
          } 
          foreach($user_selected_categories as $key=>$user_selected_categorie){
            if(is_numeric($user_selected_categorie)){
              if(isset(get_category($user_selected_categorie)->name)){
                $user_selected_category = get_category($user_selected_categorie)->name;
                $user_selected_category_desc =get_category($user_selected_categorie)->description;
              }
              else{
                $user_selected_category = "";
                $user_selected_category_desc = "";
              }

              $top_tabs_categorys[$key]['category_name']=$user_selected_category;
              $top_tabs_categorys[$key]['category_description']=$user_selected_category_desc;
              $top_tabs_categorys[$key]['query']='posts_per_page='.($count_of_posts).'&cat='.$user_selected_categorie.'&order=DESC';
            }
            else {
              switch($user_selected_categorie){
                case 'random':{                 
                  $top_tabs_categorys[$key]['category_name']=__('Random Posts', "business-elite");
                  $top_tabs_categorys[$key]['query']='orderby=rand&ignore_sticky_posts=1&posts_per_page='.$count_of_posts;                  
                  break;
                }
                case 'popular':{                  
                  $top_tabs_categorys[$key]['category_name']=__('Popular Posts', "business-elite");
                  $top_tabs_categorys[$key]['query']='meta_key=wpb_post_views_count&orderby=>meta_value&posts_per_page='.$count_of_posts;
                  break;
                }
                case 'recent':{
                  $top_tabs_categorys[$key]['category_name']=__('Recent Posts', "business-elite");
                  if(isset($data))
                    $top_tabs_categorys[$key]['query']='meta_key=wpb_post_views_count&orderby=>meta_value&numberposts='.$data["postsCount"];
                  $args = array(
                    'numberposts' => $count_of_posts,
                    'offset' => 0,
                    'category' => 0,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'post_type' => 'post',
                    /*'post_status' => 'draft, publish, future, pending, private',*/
                    'suppress_filters' => true 
                  );
                  $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
                  $recentList="";
                    foreach( $recent_posts as $recent ){
                      $img_html='';
                      $img=wp_get_attachment_image_src( get_post_thumbnail_id($recent["ID"]));
                      if($img){
                        $img_html="<div class=\"thumbnail-block\"> \r\n \t\t\t\t\t\t\t\t <a class=\"image-block\" href=\"".get_permalink($recent["ID"]) ."\">\r\n \t\t\t\t\t\t\t\t\t<img src=\"".$img[0]."\" alt=\"".$recent["post_title"]."\" />\r\n \t\t\t\t\t\t\t\t</a>\r\n \t\t\t\t\t\t\t</div>";
                      }
                      $recentList= "\t\t\t\t\t\t<li>\r\n \t\t\t\t\t\t\t".$img_html."\r\n \t\t\t\t\t\t\t<div class=\"text\">\r\n \t\t\t\t\t\t\t\t<a href=\"".get_permalink($recent["ID"]) ."\">\r\n \t\t\t\t\t\t\t\t\t<h3>".$recent["post_title"]."</h3>\r\n \t\t\t\t\t\t\t\t</a>\r\n \t\t\t\t\t\t\t\t<p>".substr( strip_tags( $recent["post_content"] ),0,50)."...</p>\r\n \t\t\t\t\t\t\t\t<span class=\"date\">".$recent["post_date"]."</span>\r\n \t\t\t\t\t\t\t</div>\r\n \t\t\t\t\t\t</li>";
                  }
                  $top_tabs_categorys[$key]['recent']=$recentList;
                  break;
                }
              }
            }             
          }
          foreach($top_tabs_categorys as $key=>$top_tabs_category){  ?>
            <li <?php if($key==0) echo 'class="active"'; ?>>
              <a href="#<?php echo $key; ?>"><?php echo $top_tabs_category['category_name']; ?><br></a>
            </li>
          <?php } ?>
        </ul>
        <div class="tabs-block">
          <span class="categories-tabs-leftt"><span></span></span>
          <span class="categories-tabs-rightt"><span></span></span>
        </div>
        
        <!--CONTENT-->
        <?php if(!empty($top_tabs_categorys)){ ?>
          <div class="cont_vat_tab">
            <ul class="content">
              <?php           
              foreach($top_tabs_categorys as $key=>$top_tabs_category){  ?>
                <li <?php if($key==0) echo 'class="active"'; ?> id="categories-tabs-content-<?php echo $key; ?>">
                  <ul>
                    <?php
                    if(isset($top_tabs_category['recent'])){
                      echo $top_tabs_category['recent'];
                    }
                    else{
                      $tabs_query = new WP_Query($top_tabs_category['query']);

                      if ( $tabs_query->have_posts() ) : while ( $tabs_query->have_posts() ) : $tabs_query->the_post();
                        $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); 
                        $url_d =get_template_directory_uri('template_url').'/images/default.png';
                        $style="style='background:url(".$url.") no-repeat center; background-size:cover;'";
                        $style_d="style='background:url(".$url_d.") no-repeat center; background-size:100%;'";
                        $listt='<li>';
                          if(has_post_thumbnail()){
                            $listt.='<div class="thumbnail-block" '.$style.'><div class="hide_title"><h3>'.get_the_title().'</h3></div></div> ';
                          }
                          else{ 
                            $listt.='<div class="thumbnail-block" '.$style_d.'><div class="hide_title"><h3>'.get_the_title().'</h3></div></div> ';  
                          }     
                          $listt.='<div class="text">
                              <h3>'.get_the_title().'</h3>
                              <p>'.substr( strip_tags( get_the_excerpt() ),0,250).'...</p>';
                              if($wdwt_front->get_param('date_enable')){    
                                $listt.='<div class="div_date"><img src="'.WDWT_IMG.'meta_icons/date_icon.png"><span class="sep">'.get_the_time( 'F d, Y' ).'</span></div>';
                              } 
                          $listt.='<div class="slaq"><a href="'.get_permalink().'">READ MORE</a></div>
                            </div></li>';  
                        echo $listt;
                      endwhile;endif;
                      
                      
                        if($tabs_query->max_num_pages >=2 ){ ?>
                          <span class="wd_cat_tabs pagination_button" id="wd_cat_tabs_right" onclick="wdwt_front_ajax_pagination(2, 'wd_tabs_dynamic', '#categories-tabs-content-<?php echo $key; ?> > ul', {cat:<?php echo $tabs_query->query['cat']; ?>, key: <?php echo $key; ?>, lang: '<?php echo $lang_current; ?>'} );"><i class="fa fa-chevron-right"></i></span>
                        <?php
                        }


                    wp_reset_query(); } ?>
                  </ul>
                </li>
              <?php } ?>  
            </ul>
          </div>
        <?php } ?>
      </div>
      <div class="clear"></div>
    <?php
    }
  }




  public static function category_tab_ajax($cat_paged = 1, $cat_id = 0, $key = 0, $lang = false){
    global $wdwt_front;
    
    
    if($lang){
      global $sitepress;
      $sitepress->switch_lang($lang);

    }
    $lang_current = $lang ? $lang : 0;
    
    
  $args=array('posts_per_page' =>3,
              'cat' =>$cat_id,
              'order'=>'DESC',
              'paged' => $cat_paged
              );
      $tabs_query = new WP_Query($args);
      

      if ( $tabs_query->have_posts() ) : while ( $tabs_query->have_posts() ) : $tabs_query->the_post();
        
        $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); 
        $url_d =get_template_directory_uri('template_url').'/images/default.png';
        $style="style='background:url(".$url.") no-repeat center; background-size:cover;'";
        $style_d="style='background:url(".$url_d.") no-repeat center; background-size:100%;'";
        $listt='<li>';
          if(has_post_thumbnail()){
            $listt.='<div class="thumbnail-block" '.$style.'><div class="hide_title"><h3>'.get_the_title().'</h3></div></div> ';
          }
          else{ 
            $listt.='<div class="thumbnail-block" '.$style_d.'><div class="hide_title"><h3>'.get_the_title().'</h3></div></div> ';  
          }     
          $listt.='<div class="text">
              <h3>'.get_the_title().'</h3>
              <p>'.substr( strip_tags( get_the_excerpt() ),0,250).'...</p>';
              if($wdwt_front->get_param('date_enable')){    
                $listt.='<div class="div_date"><img src="'.WDWT_IMG.'meta_icons/date_icon.png"><span class="sep">'.get_the_time( 'F d, Y' ).'</span></div>';
              } 
          $listt.='<div class="slaq"><a href="'.get_permalink().'">READ MORE</a></div>
            </div></li>';  
        echo $listt;
      endwhile;endif;
      
      if($tabs_query->query['paged'] >1){ ?>
          <span class="wd_cat_tabs pagination_button" id="wd_cat_tabs_left" onclick="wdwt_front_ajax_pagination(<?php echo $tabs_query->query['paged']-1; ?>, 'wd_tabs_dynamic', '#categories-tabs-content-<?php echo $key; ?> > ul', {cat:<?php echo $cat_id; ?>, key: <?php echo $key; ?>, lang: '<?php echo $lang_current; ?>'});" ><i class="fa fa-chevron-left"></i></span>
      <?php
        }
        if($tabs_query->query['paged'] < $tabs_query->max_num_pages){ ?>
          <span class="wd_cat_tabs pagination_button" id="wd_cat_tabs_right" onclick="wdwt_front_ajax_pagination(<?php echo $tabs_query->query['paged']+1; ?>, 'wd_tabs_dynamic', '#categories-tabs-content-<?php echo $key; ?> > ul', {cat:<?php echo $cat_id; ?>, key: <?php echo $key; ?>, lang: '<?php echo $lang_current; ?>'});"><i class="fa fa-chevron-right"></i></span>
        <?php
        }


    wp_reset_query();
                
  }






/*----- FEATURED POST -----*/
  public static function home_featured_post() {
    global $wdwt_front;
    
    $featured_posts = $wdwt_front->get_param('featured_posts');
    $featured_posts = isset( $featured_posts[0]) ?  $featured_posts[0] : '';
    $featured_post_enable = $wdwt_front->get_param('featured_post_enable');
    $featured_bg_img = esc_url(trim($wdwt_front->get_param('featured_bg_img')));
    
    $featured_post_id = apply_filters( 'wpml_object_id', $featured_posts, 'post' );
    if(!is_null($featured_post_id)){
      $featured = get_post($featured_post_id);  
    }
    else{
      $featured = null; 
    }
    if($featured_post_enable && !is_null($featured)){  
      if($featured_bg_img!=""){ ?>
        <div id="videos-block" class="content-inner-block" style="background-image: url(<?php echo $featured_bg_img; ?>); min-height:320px;">
          <div class="full-width">
            <p id="p1"> <a href="<?php echo get_permalink($featured->ID); ?>"> <?php echo $featured->post_title; ?> </a> </p>         
            <p><?php echo self::get_excerpt_by_id($featured->ID); ?> </p><!-- gago-->
            <div class="clear"></div>
          </div>
        </div>
      <?php 
      }
      else{ ?>
        <div id="videos-block" class="content-inner-block" style="background-color:#F8F8F8;padding:7% 0;">
          <div class="full-width">
            <p id="p1"> <a href="<?php echo get_permalink($featured->ID); ?>"> <?php echo $featured->post_title; ?> </a> </p>         
            <p><?php the_excerpt() ?> </p>
            <div class="clear"></div>
          </div>
        </div>
      <?php 
      }
    }
  } 
/*----- BLOG ------*/
  public static function content_posts($paged = null) {
    
    if(!isset($paged)){
      global $paged;
    }
    if($paged === 0){
      $paged = 1;
    }
    global $wdwt_front, $wp_query, $post;

    $content_posts_enable = $wdwt_front->get_param('content_posts_enable');
    $content_posts_title = $wdwt_front->get_param('content_posts_title');
    $lbox_disable = $wdwt_front->get_param('lbox_disable');
    $content_posts_description = stripslashes( $wdwt_front->get_param('content_posts_description'));    
    $content_posts_categories = implode(",", $wdwt_front->get_param('content_posts_categories'));
    $lbox_width = $wdwt_front->get_param('lbox_image_width');
    $lbox_height = $wdwt_front->get_param('lbox_image_height');
    
    $n_of_content_post = get_option( 'posts_per_page', 3 ); 

    if($content_posts_enable  && $n_of_content_post!=0){  ?>
      <div id="blog_home" class="content-inner-block">
      <?php
      $args = array(
        'posts_per_page' => $n_of_content_post,
        'cat' => self::remove_last_comma($content_posts_categories),
        'paged'=> $paged,
        'order'=>'DESC',
      );
      $wp_query = new WP_Query($args);          
        if($wp_query->have_posts()) { ?>
          <div class="blog-post content-posts"> 
            <!-- TTILE & DESCRIPTION-->
            <div class="top_part">
              <h2><?php echo $content_posts_title; ?></h2>
              <p id="cont_desc"><?php echo $content_posts_description; ?></p>
            </div>
            
            <div class="content-posts-container">
              <?php
              $id = 0;
              while ($wp_query->have_posts()) {
                $wp_query->the_post();
                $tumb_id = get_post_thumbnail_id( get_the_ID() );
                $thumb_url=wp_get_attachment_image_src($tumb_id,'full');
                
                $has_image = true;
                if( $thumb_url ) {
                  $thumb_url = $thumb_url[0];
                }  
                else {
                  $thumb_url = self::catch_that_image();
                  $has_image = $thumb_url['image_catched'];
                  $thumb_url=$thumb_url['src'];
                }
                $background_image = $thumb_url; ?>
                <div class="content-post post_image slide-in-right">
                  <!--IMAGE-->
                  <div class="div_image" style="background: url(<?php echo $background_image; ?>) no-repeat center !important; background-size:cover !important;">
                    <?php if(($has_image) && !$lbox_disable){ ?>
                      <a href="<?php echo $thumb_url; ?>" class=" " onclick="wdwt_lbox.init(this, 'wdwt-lightbox', <?php echo intval($lbox_width);?> , <?php echo intval($lbox_height);?>); return false;" rel="wdwt-lightbox" id="content-post-<?php echo $id; ?>">
                        <div class="eye_blog" id="eye_bg"> </div>
                      </a>
                    <?php } ?>
                    <a href="<?php echo get_permalink() ?>"></a>
                  </div>
                  <!--CONTENT-->
                  <div class="home_blog_post">
                    <h3> <a href="<?php echo get_permalink() ?>" rel="content-post-<?php echo $id; ?>-title"> <?php the_title(); ?> </a> </h3>

                    <div id="single_text">
                      <p rel="content-post-<?php echo $id; ?>-desc"> <?php self::the_excerpt_max_charlength(250); ?> </p>
                    </div>
                    <div class="more_info">
                      <a class="tab-more" href="<?php echo get_permalink(); ?>"><?php echo __('Read more',"business-elite");?></a>
                      <?php if($wdwt_front->get_param('date_enable')){ ?>
                        <div class="date" style="position:absolute; width:40px !important;">
                          <span class="blog_date_number"><?php echo get_the_date('j'); ?></span><br />
                          <span class="blog_date_month"><?php echo get_the_date('M'); ?></span>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php
              $id++;
              }
              $id=0; ?>
              <div class="clear"></div>
            </div>
            <div class="clear"></div>
          </div>
        <?php
        } ?>
        <div class="clear"> </div>
      </div>
      <?php 
      if($content_posts_enable){ 
          
            if($paged >1){ ?>
              <span class="content_posts_home_pagination" id="content_posts_home_left" onclick="wdwt_front_ajax_pagination(<?php echo $paged-1; ?>, 'content_posts', '#blog_home_out');" ><i class="fa fa-chevron-left"></i><?php esc_html_e('Previous', "business-elite"); ?> </span>
            <?php
              }
            if($paged < $wp_query->max_num_pages){ ?>
              <span class="content_posts_home_pagination" id="content_posts_home_right" onclick="wdwt_front_ajax_pagination(<?php echo $paged+1; ?>, 'content_posts', '#blog_home_out');"><?php esc_html_e('Next', "business-elite"); ?> <i class="fa fa-chevron-right"></i></span>
            <?php
            }
          
      } 
      ?>
      <div class="clear"></div>
      <?php $wdwt_front->bottom_advertisment();?>
    <?php
    }       
  } 
/*---- PORTFOLIO ------*/ 
  public static function portfolio_home($paged= 1) {  
    global $wdwt_front;
    
    $portfolio_posts_enable = $wdwt_front->get_param('portfolio_posts_enable');
    $portfolio_title = $wdwt_front->get_param('portfolio_title');
    $portfolio_posts_lightbox = $wdwt_front->get_param('portfolio_posts_lightbox', array(), 'lightbox');
    $lbox_disable = $wdwt_front->get_param('lbox_disable');
    $portfolio_description = stripslashes( $wdwt_front->get_param('portfolio_description'));
    $portfolio_categories = implode(",", $wdwt_front->get_param('portfolio_categories')) ;
    $grab_image = $wdwt_front->get_param('grab_image');
    $cat_checked=0;
    $post_count=0;
    $printed_featured=false;
    $lbox_width = $wdwt_front->get_param('lbox_image_width');
    $lbox_height = $wdwt_front->get_param('lbox_image_height');
    
    if($portfolio_posts_enable){ 
      $args = array(  "paged" => $paged,
                      "posts_per_page"=>6,
                      "cat"=>$portfolio_categories,
                      "orderby"=>'date',
                      "order"=>"DESC");

      $wp_query = new WP_Query($args);
      if($wp_query->have_posts()) { ?>
        <div id="portfolio-block" class="portfolio_home" style="clear:both;">
          <!-- TTILE & DESCRIPTION-->
          <div class="top_part">
            <h2><?php echo $portfolio_title; ?></h2>
            <p id="contact_text"><?php echo $portfolio_description; ?></p>
          </div>
          
            <ul class="port_list">
            <?php 
            $id = 0;
              while ($wp_query->have_posts()) {
                $wp_query->the_post();    

                $tumb_id = get_post_thumbnail_id( get_the_ID() ); 
                $thumb_url=wp_get_attachment_image_src($tumb_id,'full');  
                $has_image = true;
                if( $thumb_url ) {                    
                  $thumb_url = $thumb_url[0];
                }  
                else {
                  $thumb_url = self::catch_that_image();
                  $has_image = $thumb_url['image_catched'];
                  $thumb_url=$thumb_url['src'];
                }
                $background_image = $thumb_url; ?>
                <li style="background: url(<?php echo $background_image; ?>) no-repeat center !important; background-size:cover !important;" class="port_rel">
                  <div class="overlay_port"></div>
                  <p rel="port_rel-<?php echo $id; ?>-title" style="display:none;"> <?php the_title(); ?> </p>
                  <?php 
                  if(($has_image) && $portfolio_posts_lightbox == "lightbox" && !$lbox_disable){ ?>
                    <div>
                    <a href="<?php echo $thumb_url; ?>" class=" " onclick="wdwt_lbox.init(this, 'wdwt-lightbox', <?php echo intval($lbox_width);?> , <?php echo intval($lbox_height);?>); return false;" rel="wdwt-lightbox" id="port_rel-<?php echo $id; ?>">
                      <div class="eye_port" id="eye_bg"></div>
                    </a>
                    </div>
                  <?php }
                  if($portfolio_posts_lightbox == 'link'){ ?>
                    <div>
                    <a href="<?php echo get_permalink(); ?>" class=" ">
                      <div class="link_post" id="link_post"></div>
                    </a>
                    </div>
                  <?php } ?> 
                </li>
              <?php 
              $id++;
              } 
            $id=0;
            ?>
          </ul>
          <div class="clear"> </div>
          <?php
          
            if($paged >1){ ?>
              <span class="portfolio_home_pagination" id="portfolio_home_left" onclick="wdwt_front_ajax_pagination(<?php echo $paged-1; ?>, 'portfolio_home', '#portfolio_home_out');" ><i class="fa fa-chevron-left"></i><?php esc_html_e('Previous', "business-elite"); ?> </span>
            <?php
              }
            if($paged < $wp_query->max_num_pages){ ?>
              <span class="portfolio_home_pagination" id="portfolio_home_right" onclick="wdwt_front_ajax_pagination(<?php echo $paged+1; ?>, 'portfolio_home', '#portfolio_home_out');"><?php esc_html_e('Next', "business-elite"); ?> <i class="fa fa-chevron-right"></i></span>
            <?php
            }
          ?>
          <div class="clear"> </div>
        </div>
      <?php 
      }
    }
  }
/*---- SHOW ICONS ------*/  
  public static function social_icons() {
    global $wdwt_front;
    /*1*/
    $twitter_enable = $wdwt_front->get_param('twitter_enable');
    $twitter_url = $wdwt_front->get_param('twitter_url');
    /*2*/
    $facebook_enable = $wdwt_front->get_param('facebook_enable');
    $facebook_url = $wdwt_front->get_param('facebook_url');
    /*3*/
    $rss_enable = $wdwt_front->get_param('rss_enable');
    $rss_url = $wdwt_front->get_param('rss_url');
    /*4*/
    $youtube_enable = $wdwt_front->get_param('youtube_enable');
    $youtube_url = $wdwt_front->get_param('youtube_url');
    /*5*/
    $googlep_enable = $wdwt_front->get_param('googlep_enable');
    $googlep_url = $wdwt_front->get_param('googlep_url');
    /*6*/
    $instagram_enable = $wdwt_front->get_param('instagram_enable');
    $instagram_url = $wdwt_front->get_param('instagram_url');
    /*7*/
    $linkedin_enable = $wdwt_front->get_param('linkedin_enable');
    $linkedin_url = $wdwt_front->get_param('linkedin_url');
    ?>
    
    <?php if( $twitter_enable=='on' && $twitter_url != "" ){ ?>
    <div class="flip-container-soc" id="flip-container">
      <div class="flipper">
        <div id="social_home" <?php if( $twitter_enable=='' || $twitter_enable == ""){ echo "style=\"display:none;\""; } ?>>
          <a href="<?php if( trim($twitter_url) ){ echo esc_url($twitter_url);} else { echo "javascript:;";}?>" target="_blank" title="Twitter" class="round">
            <div class="front twitter_home" id="front"><i class="fa fa-twitter"></i></div>
          </a>
        </div>
      </div>
    </div>
    <?php } ?>        
    <!--2-->
    <?php if( $facebook_enable=='on' && $facebook_url != "" ){ ?>
    <div class="flip-container-soc" id="flip-container">
      <div class="flipper"> 
        <div id="social_home" <?php if( $facebook_enable=='' || $facebook_enable == ""){ echo "style=\"display:none;\""; } ?>>
          <a href="<?php if( trim($facebook_url) ){ echo esc_url($facebook_url);} else { echo "javascript:;";}?>" target="_blank" title="Facebook"> 
            <div class="front facebook_home" id="front"><i class="fa fa-facebook"></i></div>
          </a>
        </div>
      </div>
    </div>
    <?php } ?>
    <!--3-->
    <?php if( $rss_enable=='on' && $rss_url != "" ){ ?>
    <div class="flip-container-soc" id="flip-container">
      <div class="flipper"> 
        <div id="social_home" <?php if( $rss_enable=='' || $rss_enable == ""){ echo "style=\"display:none;\""; } ?>>
          <a href="<?php if( trim($rss_url) ){ echo esc_url($rss_url);} else { echo "javascript:;";}?>" target="_blank" title="Rss">
            <div class="front rss_home" id="front"><i class="fa fa-rss"></i></div>
          </a>
        </div>
      </div>
    </div>
    <?php } ?>
    <!--4-->
    <?php if( $youtube_enable=='on' && $youtube_url != "" ){ ?>
    <div class="flip-container-soc" id="flip-container">
      <div class="flipper"> 
        <div id="social_home" <?php if( $youtube_enable=='' || $youtube_enable == ""){ echo "style=\"display:none;\""; } ?>>
          <a  href="<?php if( trim($youtube_url) ){ echo esc_url($youtube_url);} else { echo "javascript:;";}?>" target="_blank" title="Youtube">
            <div class="front youtube_home" id="front"><i class="fa fa-youtube"></i></div>
          </a>
        </div>
      </div>
    </div>
    <?php } ?>
    <!--5-->
    <?php if( $googlep_enable=='on' && $googlep_url != "" ){ ?>
    <div class="flip-container-soc" id="flip-container">
      <div class="flipper"> 
        <div id="social_home" <?php if( $googlep_enable=='' || $googlep_enable == ""){ echo "style=\"display:none;\""; } ?>>
          <a  href="<?php if( trim($googlep_url) ){ echo esc_url($googlep_url);} else { echo "javascript:;";}?>" target="_blank" title="Google+">
            <div class="front google-plus_home" id="front"><i class="fa fa-google-plus"></i></div>
          </a>
        </div>
      </div>
    </div>
    <?php } ?>
    <!--6-->
    <?php if( $instagram_enable=='on' && $instagram_url != "" ){ ?>
    <div class="flip-container-soc" id="flip-container">
      <div class="flipper"> 
        <div id="social_home" <?php if( $instagram_enable=='' || $instagram_enable == ""){ echo "style=\"display:none;\""; } ?>>
          <a  href="<?php if( trim($instagram_url) ){ echo esc_url($instagram_url);} else { echo "javascript:;";}?>" target="_blank" title="Instagram">
            <div class="front instagram_home" id="front"><i class="fa fa-instagram"></i></div>
          </a>
        </div>
      </div>
    </div>
    <?php } ?>
    <!--6-->
    <?php if( $linkedin_enable=='on' && $linkedin_url != "" ){ ?>
    <div class="flip-container-soc" id="flip-container">
      <div class="flipper"> 
        <div id="social_home" <?php if( $linkedin_enable=='' || $linkedin_enable == ""){ echo "style=\"display:none;\""; } ?>>
          <a  href="<?php if( trim($linkedin_url) ){ echo esc_url($linkedin_url);} else { echo "javascript:;";}?>" target="_blank" title="Linkedin">
            <div class="front linkedin_home" id="front"><i class="fa fa-linkedin"></i></div>
          </a>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php do_action('business_elite_more_social_links'); ?>
    <div class="clear"></div>
  <?php 
  }
  
/*---- CONTACT US -----*/ 
  public static function contact_us() {
    global $wdwt_front,$post;


    $contact_us_enable = $wdwt_front->get_param('contact_us_enable');
    $contact_us_bg = esc_url(trim($wdwt_front->get_param('contact_us_bg')));
    $contact_us_title = $wdwt_front->get_param('contact_us_title');
    $contact_us_description = stripslashes( $wdwt_front->get_param('contact_us_description'));
    $contact_us_name = trim($wdwt_front->get_param('contact_us_name'));
    $contact_us_address = trim($wdwt_front->get_param('contact_us_address'));
    $contact_us_mail = trim($wdwt_front->get_param('contact_us_mail'));

    $contact_us_showmail = true;
    ?>
    
    <?php if ( $contact_us_enable) { ?>
      <div id="contact_us" class="contact_home" style="clear:both;">
        <!-- TITLE * DESCRIPTION-->
        <div class="top_part">
          <h2> <?php echo $contact_us_title; ?> </h2>
          <p id="contact_text"><?php echo $contact_us_description; ?></p>
        </div>
        <div id="contactForm_div" style="background: url(<?php echo $contact_us_bg; ?>) no-repeat; background-size:cover; position: relative; text-align:center;">
          <div class="overlay_contact"></div>
          <!-- TOP PART -->
          <ul class="cont_us_top container">
            <?php if($contact_us_name) { ?>
            <!--name-->
            <li>
              <div class="circle" id="circle_bg1"></div>
              <div> <p class="cont_title"> <?php echo __('FULL NAME',"business-elite"); ?> </p> <p class="cont_text"> <?php echo $contact_us_name; ?> </p> </div>
            </li>
            <?php } ?>
            <?php if($contact_us_address) { ?>
            <!--address-->
            <li>
              <div class="circle" id="circle_bg2"></div>  
              <div> <p class="cont_title"> <?php echo __('ADDRESS',"business-elite"); ?> </p> <p class="cont_text"> <?php echo $contact_us_address; ?> </p> </div>
            </li>
            <?php } ?>
            <?php if($contact_us_mail && $contact_us_showmail) { ?>
            <!--mail-->
            <li>
              <div class="circle" id="circle_bg3"></div>  
              <div> <p class="cont_title"> <?php echo __('EMAIL',"business-elite"); ?> </p> <p class="cont_text"> <?php echo $contact_us_mail; ?> </p> </div>
            </li>
            <?php } ?>
          </ul>
        
            <div class="right_home right_home_center">
              <?php self::social_icons(); ?>
            </div>
            <div class="clear"></div> 
        </div>
      </div>
      <div class="clear"></div>
    <?php
    }
  }

  
/*---- CONTENT POST -------*/ 
  public static function content_for_home() {
    global $wdwt_front, $wp_query, $paged;
    $date_enable =  $wdwt_front->get_param('date_enable');
    $grab_image = $wdwt_front->get_param('grab_image');
    $blog_style = $wdwt_front->blog_style();


    $is_index = is_home();

    ?>
    
    <div id="blog_home" class="content-posts" >
      <style> #sidebar1, #sidebar2 { margin-top:10px !important; } </style>
      <?php  if(have_posts()) : while (have_posts()) : the_post();   ?>
        <div class="blog-post home-post entry">        
          <a class="title_href" href="<?php echo get_permalink() ?>">
            <h2><?php  self::the_title_max_charlength(40); /*the_title();*/ ?></h2>
          </a>
          <?php  if($date_enable && $is_index){ ?>
            <div class="home-post-date">
              <?php echo self::posted_on();?>
            </div>
          <?php
          }
          if($is_index){
            if(has_post_thumbnail() || (Business_elite_frontend_functions::post_image_url() && $blog_style && $grab_image)){ ?>
              <div class="img_container fixed size250x180">
              <?php echo Business_elite_frontend_functions::fixed_thumbnail(250, 180, $grab_image); ?>
              </div>
            <?php
            }  
          }
          
          if($blog_style && $is_index) {
            the_excerpt();
          }
          elseif($is_index) {
            the_content(__('More', "business-elite"));
          }
          else{
            the_content(); 
          }
          ?>
          <div class="clear"></div>  
        </div>
      <?php 
      endwhile;
      if( $wp_query->max_num_pages > 2 ){ ?>
        <div class="page-navigation">
          <?php posts_nav_link(); ?>
        </div>     
      <?php 
      }
      endif; ?>
      <div class="clear"></div>
      <?php
      $wdwt_front->bottom_advertisment();
      wp_reset_query(); ?>      
    </div>
  <?php 
  }
/*-------------------*/ 
  public static function entry_meta() {
    $categories_list = get_the_category_list(', ' );
      echo '<div class="entry-meta-cat">';
    if ( $categories_list ) {
    echo '<span class="categories-links"><span class="sep category"></span> ' . $categories_list . '</span>';
    }
    $tag_list = get_the_tag_list( '', ' , ' );
    if ( $tag_list ) {
    echo '<span class="tags-links"><span class="sep tag"></span>' . $tag_list . '</span>';
    }
    echo '</div>';
  }

  
}