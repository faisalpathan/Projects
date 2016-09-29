<?php if(! defined('ABSPATH')){ return; }
/**
 * Details date
 */
?>

<span class="kl-blog-post-date updated">
	<?php
		$date_format = zget_option( 'blog_date_format', 'blog_options', false, 'l, d F Y' );
		the_time( $date_format );
	?>
</span>
<span class="infSep kl-blog-post-details-sep"> / </span>
