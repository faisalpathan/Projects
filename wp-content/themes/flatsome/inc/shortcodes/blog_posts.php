<?php
// [blog_posts]
function shortcode_latest_from_blog($atts, $content = null) {
	global $flatsome_opt;
	$element_id = rand();
	extract(shortcode_atts(array(
		"posts" => '8',
		"columns" => '4',
		"category" => '',
		"style" => 'text-normal',
		"auto_slide" => 'false',
		"type" => "slider", // Slider / Grid / Masonry
		"image_height" => 'auto',
		"show_date" => 'true',
		"excerpt" => 'true',
	), $atts));

	if($type == 'masonry'){
		$style = 'text-boxed';
		$image_height = 'auto';
	}

	ob_start();
	?>

<div class="row">
 <div class="large-12 column">
  <ul id="id-<?php echo $element_id;?>" class="blog-posts <?php if($type == 'masonry') echo 'masonry'; ?> 
  	<?php if($type == 'slider') { ?>
  		ux-row-slider js-flickity
  		<?php if($style !== 'text-overlay') echo ' slider-nav-reveal slider-nav-push'; ?> 
  	 <?php } ?>
  	 large-block-grid-<?php echo $columns; ?> small-block-grid-2"
	    data-flickity-options='{ 
	        "cellAlign": "left",
	        "autoPlay" : <?php echo $auto_slide; ?>,
	        "wrapAround": true,
	        "percentPosition": true,
	        "imagesLoaded": true,
	        "pageDots": false,
	        "contain": true,
	        "selectedAttraction" : 0.05,
	 		"friction": 0.6
	    }'>
			<?php
                    $args = array(
                        'post_status' => 'publish',
                        'post_type' => 'post',
						'category_name' => $category,
                        'posts_per_page' => $posts
                    );

                    $recentPosts = new WP_Query( $args );

                    if ( $recentPosts->have_posts() ) : ?>

                        <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>

						<li class="ux-box text-center post-item ux-<?php echo $style; ?>">
						    <div class="inner">
						      <div class="inner-wrap">
							    <a href="<?php the_permalink() ?>">
							      <div class="ux-box-image">
								        <div class="entry-image-attachment" style="max-height:<?php echo  $image_height; ?>;overflow:hidden;">
											<?php the_post_thumbnail('medium'); ?>
										</div>
							      </div><!-- .ux-box-image -->
							      <div class="ux-box-text text-vertical-center">
							         	<h3 class="from_the_blog_title"><?php the_title(); ?></h3>
							         	<div class="tx-div small"></div>
							            <?php if($excerpt != 'false') { ?>
								            <p class="from_the_blog_excerpt small-font show-next"><?php
								                $excerpt = get_the_excerpt();
								                echo string_limit_words($excerpt,15) . '[...]';
								            ?>
								     	   </p>
								     	 <?php } ?>
								       <?php 
								       // Show comments only if it's enabled or more than 1.
								       if(comments_open() && '0' != get_comments_number()){ ?>
							           <p class="from_the_blog_comments uppercase smallest-font">
							           		<?php comments_popup_link( __( 'Leave a comment', 'flatsome' ), __( '<strong>1</strong> Comment', 'flatsome' ), __( '<strong>%</strong> Comments', 'flatsome' ) ); ?>
							           </p>
							           <?php } ?>
							        	
							         </div><!-- .post_shortcode_text -->
							    </a>

								   <?php if($show_date != 'false') {?>
							            <div class="post-date">
								                <span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span>
								                <span class="post-date-month"><?php echo get_the_time('M', get_the_ID()); ?></span>
								         </div>
									<?php } ?>
								</div><!-- .inner-wrap -->
						    </div><!-- .inner -->
						</li><!-- .blog-item -->
                          
                        <?php endwhile; // end of the loop. ?>

                    <?php

                    endif;
					wp_reset_query();

                    ?>
         </ul>
</div><!-- col -->
</div><!-- row -->

		<?php if($type == 'masonry'){ ?>
			<script>
			jQuery(document).ready(function ($) {
			    imagesLoaded( document.querySelector('#id-<?php echo $element_id; ?>'), function( instance, container ) {
			    	var $container = $("#id-<?php echo $element_id; ?>");
				    // initialize
				    $container.packery({
				      itemSelector: ".ux-box",
				      gutter: 0,
				    });
					$container.packery('layout');
				});
			 });
			</script>
		<?php } ?>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

function string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

add_shortcode("blog_posts", "shortcode_latest_from_blog");
