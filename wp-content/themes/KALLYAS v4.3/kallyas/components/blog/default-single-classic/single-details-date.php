<?php if(! defined('ABSPATH')){ return; }
/**
 * Details date
 */
?>
<span class="itemDateCreated kl-blog-post-date">
	<span class="kl-blog-post-date-icon glyphicon glyphicon-calendar"></span>
	<span class="updated">
		<?php
			$date_format = zget_option( 'blog_date_format', 'blog_options', false, 'l, d F Y' );
			the_time( $date_format );
		?>
	</span>
</span>
