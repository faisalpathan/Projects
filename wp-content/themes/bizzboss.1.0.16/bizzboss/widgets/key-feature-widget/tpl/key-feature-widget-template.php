<?php
    $icon_styles = array();
    if(!empty($instance['keyFeatureIconSection']['keyFeatureIconSize'])) $icon_styles[] = 'font-size: '.intval($instance['keyFeatureIconSection']['keyFeatureIconSize']).'px';
    if(!empty($instance['keyFeatureIconSection']['keyFeatureIconColor'])) $icon_styles[] = 'color: '.$instance['keyFeatureIconSection']['keyFeatureIconColor'];
?>
<div class="feature-box">
	<?php if(!empty($instance['keyFeatureIconSection']['keyFeatureIcon'])) : ?>
		<div class="iconbox <?php echo wp_kses_post($instance['keyFeatureIconSection']['keyFeatureIconBoxStyle']) ?>">		
			<?php echo siteorigin_widget_get_icon( $instance['keyFeatureIconSection']['keyFeatureIcon'], $icon_styles); ?>
		</div>
	<?php endif; ?>
	<div class="feature-content">
		<?php if (!empty($instance['keyFeatureTitle'])) : ?>
			<h5><?php echo wp_kses_post($instance['keyFeatureTitle']) ?></h5>
		<?php endif; ?>
		<?php if (!empty($instance['keyFeatureDescription'])) : ?>
			<p><?php echo wp_kses_post($instance['keyFeatureDescription']) ?></p>
		<?php endif; ?>
		<?php if ( !empty($instance['keyFeatureLinktext']) && !empty($instance['keyFeatureLink'])) : ?>
			<div class="button-div">
				<a class="button-read" href="<?php echo esc_url($instance['keyFeatureLink']) ?>"><?php echo wp_kses_post($instance['keyFeatureLinktext']) ?></a>
			</div>
		<?php endif; ?>			
	</div>
</div>