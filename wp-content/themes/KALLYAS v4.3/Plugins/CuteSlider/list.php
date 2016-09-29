<?php

	// Get WPDB Object
	global $wpdb;

	// Table name
	$table_name = $wpdb->prefix . "cuteslider";

	// Get sliders
	$sliders = $wpdb->get_results( "SELECT * FROM $table_name
										WHERE flag_hidden = '0' AND flag_deleted = '0'
										ORDER BY date_c ASC LIMIT 100" );

?>
<div class="wrap">
	<div class="cuteslider-icon"></div>
	<h2>
		<?php _e('Cute Slider sliders', 'CuteSlider') ?>
		<a href="?page=cuteslider_add_new" class="add-new-h2"><?php _e('Add New', 'CuteSlider') ?></a>
	</h2>

	<div class="cs-box cs-slider-list">
		<table>
			<thead>
				<tr>
					<td><?php _e('ID', 'CuteSlider') ?></td>
					<td><?php _e('Name', 'CuteSlider') ?></td>
					<td><?php _e('Shortcode', 'CuteSlider') ?></td>
					<td><?php _e('Actions', 'CuteSlider') ?></td>
					<td><?php _e('Created', 'CuteSlider') ?></td>
					<td><?php _e('Modified', 'CuteSlider') ?></td>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($sliders)) : ?>
				<?php foreach($sliders as $key => $item) : ?>
				<?php $name = empty($item->name) ? 'Unnamed' : $item->name; ?>
				<tr>
					<td><?php echo $item->id ?></td>
					<td><a href="?page=cuteslider&action=edit&id=<?php echo $item->id ?>"><?php echo $name ?></a></td>
					<td>[cuteslider id="<?php echo $item->id ?>"]</td>
					<td>
						<a href="?page=cuteslider&action=edit&id=<?php echo $item->id ?>"><?php _e('Edit', 'CuteSlider') ?></a> |
						<a href="?page=cuteslider&action=duplicate&id=<?php echo $item->id ?>"><?php _e('Duplicate', 'CuteSlider') ?></a> |
						<a href="?page=cuteslider&action=remove&id=<?php echo $item->id ?>" class="remove"><?php _e('Remove', 'CuteSlider') ?></a>
					</td>
					<td><?php echo date('M. d. Y.', $item->date_c) ?></td>
					<td><?php echo date('M. d. Y.', $item->date_m) ?></td>
				</tr>
				<?php endforeach; ?>
				<?php endif; ?>
				<?php if(empty($sliders)) : ?>
				<tr>
					<td colspan="6"><?php _e('You didn\'t create a slider yet.', 'CuteSlider') ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>

	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="cs-box cs-import-box">
		<h3 class="header"><?php _e('Import sliders', 'CuteSlider') ?></h3>
		<div class="inner">
			<textarea name="import" rows="10" cols="50"></textarea>
			<button class="button-primary"><?php _e('Import', 'CuteSlider') ?></button>
		</div>
	</form>

	<?php

		// Array for export sliders data
		$export = array();

		// Get sliders data
		foreach($sliders as $item) {
			$export[] = json_decode($item->data, true);
		}
	?>
	<div class="cs-box cs-import-box">
		<h3 class="header"><?php _e('Export sliders', 'CuteSlider') ?></h3>
		<div class="inner">
			<textarea rows="10" cols="50" readonly="readonly"><?php echo base64_encode(json_encode($export)) ?></textarea>
			<p><?php _e('Place this export code into the import text field in your new site and press "Import".', 'CuteSlider') ?></p>
		</div>
	</div>
</div>

<!-- Help menu WP Pointer -->
<?php

// Get users data
global $current_user;
get_currentuserinfo();

if(get_user_meta($current_user->ID, 'cuteslider_help_wp_pointer', true) != '1') {
add_user_meta($current_user->ID, 'cuteslider_help_wp_pointer', '1'); ?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#contextual-help-link-wrap').pointer({
			pointerClass : 'cs-help-pointer',
			pointerWidth : 320,
			content: '<?php _e('<h3>The documentation is here</h3><div class="inner">This is a WordPress contextual help menu, we use it to give you fast access to our documentation. Please keep in mind that because this menu is contextual, it only shows the relevant information to the page that you are currently viewing. So if you search something, you should visit the corresponding page first and then open this help menu.', 'CuteSlider') ?></div>',
			position: {
				edge : 'top',
				align : 'right'
			}
		}).pointer('open');
	});
</script>
<?php } ?>