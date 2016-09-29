<?php
// TEMPLATE USED TO PREVIEW BLOCKS

global $woo_options;
global $woocommerce;
global $flatsome_opt;
global $page;
if ( !current_user_can( 'manage_options' ) ) die;
?>

<!--[if lte IE 9 ]><html class="ie lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	<style>
	.blocks-cats li{margin-right: 10px;list-style:none;}
	.blocks-cats a{font-size: 13px; padding-bottom: 5px;display: block;}
	.blocks-cats a.current{color:#000;}
	.block-title{position:relative;width:100%;top:-40px;padding-left: 30px;}
	.block-title a{padding:15px;background-color: #FFF;opacity: 0}
	.block-shortcode{position: relative; display: block; border-top: 2px dashed #ddd;padding-top:30px;margin-bottom: 60px;}
	.block-shortcode:hover .block-title a{opacity: 1}
	</style>
</head>

<body style="background-color:#FFF;padding-top:40px;" class="full-width">
<div class="blocks-header" style="position:fixed;left:0;padding:50px 10px; width:160px; top:0; bottom:0; background-color:#eee;z-index:99;">
<?php
//list terms in a given taxonomy (useful as a widget for twentyten)
$taxonomy = 'block_categories';
$tax_terms = get_terms($taxonomy);
?>
<ul class="blocks-cats">
<?php
foreach ($tax_terms as $tax_term) {
$cur_class = '';
if(isset($_GET["cat"])){
if($tax_term->slug == $_GET["cat"]) {$cur_class = 'current';}
}
echo '<li><a href="?cat='.$tax_term->slug.'" class="'.$cur_class.'">'.$tax_term->name.'</a></li>';
}
?>
</div><!-- .header-wrapper -->


<div id="blocks-wrapper" style="height:0;padding-left:160px;">
				<?php if(!isset($_GET["cat"])){ ?> 
					<div class="text-center" style="padding-top:100px;">
						<h1>Browse Blocks</h1>
						<p class="lead">Blocks are collections of Shortcodes<br> that can be inserted anywhere by using a shortcode</p>

				<?php } ?>
			

				<?php
				if(isset($_GET["cat"])){ $cat = $_GET["cat"];
				} else {$cat = '';}
 
				$wp_query = new WP_Query(array(
					'post_type' => 'blocks',
					'orderby'=> 'menu_order',
					'tax_query' => array(
					array(
						'taxonomy' => 'block_categories',
						'field' => 'slug',
						'terms' => $cat,
					)
				)
				));
				while ($wp_query->have_posts()) : $wp_query->the_post();
				$post_data = get_post(get_the_ID(), ARRAY_A);
	 			 $slug = $post_data['post_name'];
				?>
				<div class="block-shortcode">
				<div class="block-title">
						<a href="<?php echo get_edit_post_link();?>" class="tip-top" title="Edit Block"><?php echo the_title(); ?></a>
				</div>
					<?php echo fixShortcode(get_the_content()); ?>
				</div>

				<?php endwhile; // end of the loop. ?>
</div><!-- #blocks-wrapper -->

<?php wp_footer(); ?>

</body>
</html>
