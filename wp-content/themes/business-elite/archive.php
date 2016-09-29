<?php 

get_header(); 
global $wdwt_front;
$blog_style = $wdwt_front->blog_style();
$grab_image = $wdwt_front->get_param('grab_image');
$single_title_bg = $wdwt_front->get_param('single_title_bg', array(), true);
?>

</header>
  <div class="<?php echo $single_title_bg ?  'before_blog_2' : 'before_blog_1'; ?> archive_back_phone">
   
    <?php
   if(have_posts()){
      if (is_category()) { ?>
        <h2 class="styledHeading"><?php _e('Archive For The ', "business-elite"); ?>&ldquo;<?php single_cat_title(); ?>&rdquo; <?php _e('Category', "business-elite"); ?></h2>
      <?php  
      } elseif( is_tag() ) { ?>
        <h2 class="styledHeading"><?php _e('Posts Tagged ', "business-elite"); ?>&ldquo;<?php single_tag_title(); ?>&rdquo;</h2>
      <?php  
      } elseif (is_day()) { ?>
        <h2 class="styledHeading"><?php _e('Archive For ', "business-elite");?> <?php the_time(get_option( 'date_format' )); ?></h2>
      <?php  
      } elseif (is_month()) { ?>
        <h2 class="styledHeading"><?php _e('Archive For ', "business-elite"); ?><?php the_time(get_option( 'date_format' )); ?></h2>
      <?php 
      } elseif (is_year()) { ?>
        <h2 class="styledHeading"><?php _e('Archive For ', "business-elite"); ?><?php the_time(get_option( 'date_format' )); ?></h2>
      <?php  
      } elseif (is_author()) { ?>
        <h2 class="styledHeading"><?php _e('Author Archive', "business-elite"); ?></h2>
      <?php  } 
      elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
        <h2 class="styledHeading"><?php _e('Blog Archives', "business-elite"); ?></h2>
      <?php 
      } 
    }
    else{

      ?>
      <h2 class="styledHeading"><?php _e('Not Found', "business-elite"); ?></h2>
    <?php
    } ?>


  </div>
  <?php  if($single_title_bg) { ?>
    <div class="before_blog"></div>
  <?php } ?>
  
<div class="container">
  <?php 
  if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
    <aside id="sidebar1">
      <div class="sidebar-container">
        <?php  dynamic_sidebar( 'sidebar-1' );  ?>  
        <div class="clear"></div>
      </div>
    </aside>
  <?php } ?>

  <div id="blog" class="blog archive-page">

    <?php if (have_posts()) : $post = $posts[0]; ?>

      

      <?php while (have_posts()) : the_post(); ?>

        <div class="archive-page" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="post">
            <h3 class="archive-header">
              <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </h3>
            <?php
            if($wdwt_front->get_param('date_enable')){ ?>
              <p class="meta-date"><?php _e('By ', "business-elite"); ?><?php the_author_posts_link(); ?> | <?php echo Business_elite_frontend_functions::posted_on();?> </p>
            <?php } ?>
          </div>
          
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( ); ?>" rel="bookmark">
            <?php
            if(has_post_thumbnail() || (Business_elite_frontend_functions::post_image_url() && $blog_style & $grab_image)){
          ?>
            <div class="img_container fixed size180x150">
              <?php echo Business_elite_frontend_functions::fixed_thumbnail(180,150, $grab_image); ?>
            </div>
          <?php
          } ?>
          </a>
          <div class="clear"></div>
          <?php
          if($blog_style){
            the_excerpt();
          }
          else{
            the_content();
          }
          if($wdwt_front->get_param('date_enable')){ ?>
            <div class="entry-meta">
              <?php Business_elite_frontend_functions::posted_on_single(); ?>
            </div>
            <?php Business_elite_frontend_functions::entry_meta(); 
          } ?>   
        </div>
      <?php endwhile; ?>
      
      <div class="page-navigation">
        <?php posts_nav_link(' ', '&laquo;Previous', 'Next &raquo;');  ?>
      </div>
      <?php else : ?>

        
        <p><?php _e('There are not posts belonging to this category or tag. Try searching below:', "business-elite"); ?></p>
        <div id="search-block-category"><?php get_search_form(); ?></div>

    <?php endif; ?>
    
    <?php $wdwt_front->bottom_advertisment(); ?>
  </div>  
  
  <?php
  if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
    <aside id="sidebar2" class="widget-area">
      <div class="sidebar-container">
        <?php  dynamic_sidebar( 'sidebar-2' );  ?>
        <div class="clear"></div>
      </div>
    </aside>
  <?php } ?>
  
  <div class="clear"></div>
  
  <?php wp_reset_query(); ?>
  
  <!--COMMENTS-->
  <?php if(comments_open()) {  ?>
    <div class="comments-template">
      <?php comments_template();  ?>
    </div>
  <?php }  ?>
</div>

<?php get_footer(); ?>
