<?php
/**
 * Changelog
 */

$Kyma_lite = wp_get_theme( 'Kyma' );

?>
<div class="kyma-lite-tab-pane" id="changelog">

	<div class="kyma-tab-pane-center">
	
		<h1>kyma Lite <?php if( !empty($Kyma_lite['Version']) ): ?> <sup id="kyma-lite-theme-version"><?php echo esc_attr( $Kyma_lite['Version'] ); ?> </sup><?php endif; ?></h1>

	</div>

	<?php
	WP_Filesystem();
	global $wp_filesystem;
	$Kyma_lite_changelog = $wp_filesystem->get_contents( get_template_directory().'/CHANGELOG.md' );
	$Kyma_lite_changelog_lines = explode(PHP_EOL, $Kyma_lite_changelog);
	foreach($Kyma_lite_changelog_lines as $Kyma_lite_changelog_line){
		if(substr( $Kyma_lite_changelog_line, 0, 3 ) === "###"){
			echo '<h1>'.substr($Kyma_lite_changelog_line,3).'</h1>';
		} else {
			echo $Kyma_lite_changelog_line,'<br/>';
		}
	}

	?>
	
</div>