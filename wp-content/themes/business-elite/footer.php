<?php global $wdwt_front; ?>

<div class="clear"></div>
<div id="footer">
	<div>
		<?php if ( is_active_sidebar( 'primary-footer-widget-area' ) ) { ?>
			<div id="sidebar3">
				<div class="footer-sidbar">
					<div id="first-sidebar-footer">
						<?php  dynamic_sidebar( 'primary-footer-widget-area' ); ?>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		<?php  }  ?>

		<?php if ( is_active_sidebar( 'secondary-footer-widget-area' ) ) { ?>
			<div id="sidebar4">
				<div class="footer-sidbar">
					<div id="second-sidebar-footer" class="container">
						<?php  dynamic_sidebar( 'secondary-footer-widget-area' ); 	?>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		<?php } ?>

		<div id="footer-bottom">
			<span id="copyright">
				<?php $wdwt_front->footer_text(); ?>
			</span>
		</div>
	</div>
</div>
<a id="go-to-top" href="#" title="Back to top">Go Top</a>

<?php wp_footer();  ?>
</body>
</html>