<?php

	// Skin
	if(isset($_GET['skin']) && !empty($_GET['skin'])) {
		$skin = $_GET['skin'];
	} else {

		// Open folder
		$files = scandir(dirname(__FILE__) . '/skins');

		// Iterate over the contents
		foreach($files as $entry) {
			if($entry == '.' || $entry == '..' || $entry == 'preview') {
				continue;
			} else {
				$skin = $entry;
				break;
			}
		}
	}

	// File
	$file = dirname(__FILE__) . '/skins/' . $skin . '/style/slider-style.css';
?>

<div class="wrap">

	<!-- Page title -->
	<div class="cuteslider-icon"></div>
	<h2>
		<?php _e('Cute Slider Skin Editor', 'CuteSlider') ?>
		<a href="?page=cuteslider" class="add-new-h2"><?php _e('Back to the list', 'CuteSlider') ?></a>
	</h2>

	<?php if(isset($_GET['edited'])) : ?>
	<div class="updated"><?php _e('Your changes has been saved!', 'CuteSlider') ?></div>
	<?php  endif; ?>

	<!-- Editor box -->
	<div class="cs-box cs-skin-editor-box">
		<h3 class="header">
			<?php _e('Skin Editor', 'CuteSlider') ?>
			<p>
				<span><?php _e('Choose a skin:', 'CuteSlider') ?></span>
				<select name="skin" class="cs-skin-editor-select">
					<?php $files = scandir(dirname(__FILE__) . '/skins'); ?>
					<?php foreach($files as $entry) : ?>
					<?php if($entry == '.' || $entry == '..' || $entry == 'preview') continue; ?>
					<?php if($entry == $skin) { ?>
					<option selected="selected"><?php echo $entry ?></option>
					<?php } else { ?>
					<option><?php echo $entry ?></option>
					<?php } ?>
					<?php endforeach; ?>
					<?php closedir($handle); ?>
				</select>
			</p>
		</h3>
		<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="inner">
			<input type="hidden" name="posted_skin_editor" value="1">
			<textarea rows="10" cols="50" name="contents" id="editor"><?php echo file_get_contents($file); ?></textarea>
			<p>
				<?php if(!is_writable($file)) { ?>
				<?php _e('You need to make this file writable before you can save your changes. See the <a href="http://codex.wordpress.org/Changing_File_Permissions" target="_blank">Codex</a> for more information.', 'CuteSlider') ?>
				<?php } else { ?>
				<button class="button-primary">Save changes</button>
				<?php _e('Modifying a skin could be dangerous, these changes will be permanent, you can\'t revert it.', 'CuteSlider') ?>'
				<?php } ?>
			</p>
		</form>
	</div>
</div>