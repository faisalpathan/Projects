<div class="wrap" id="of_container">

	<div id="of-popup-save" class="of-save-popup">
		<div class="of-save-save">Options Updated</div>
	</div>
	
	<div id="of-popup-reset" class="of-save-popup">
		<div class="of-save-reset">Options Reset</div>
	</div>
	
	<div id="of-popup-fail" class="of-save-popup">
		<div class="of-save-fail">Error!</div>
	</div>
	
	<span style="display: none;" id="hooks"><?php echo json_encode(of_get_header_classes_array()); ?></span>
	<input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>" />
	<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />

	<form id="of_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >
		
		<div id="main">
		
			<div id="of-nav">

				<div class="logo">
				<h3><?php echo THEMENAME; ?> <span><?php echo ('Version: '. THEMEVERSION); ?></span></h3>
				</div>
						<div class="save_bar"> 
						<button id ="of_save" type="button" class="button-primary"><?php _e('Save All Changes', 'ux-admin');?></button>			
						<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
			
					</div><!--.save_bar--> 
				<ul>
				  <?php echo $options_machine->Menu ?>
				</ul>

				<?php if(function_exists('pll_get_post')) { 
					$url = get_admin_url().'options-general.php?page=mlang&tab=strings';
					?>
					<div style="padding:18px">
						<h3>Translate theme options</h3>
						<a href="<?php echo $url; ?>">Click here to translate Theme Options Strings</a><br><br>
						<small>NB: You need to translate Theme Options strings once more if you have changed them.</small>
					</div>
				<?php } ?>
		
			</div>

			<div id="content">
		  		<?php echo $options_machine->Inputs /* Settings */ ?>
	  			<div class="save_bar" style="padding-left:0;"> 

					<button id="of_save" type="button" class="button-primary"><?php _e('Save All Changes', 'ux-admin');?></button>
					<button id ="of_reset" type="button" class="button submit-button reset-button" ><?php _e('Options Reset', 'ux-admin');?></button>
					<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />
					<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />

				</div><!--.save_bar--> 
		  	</div>

		  
		  	
			<div class="clear"></div>
			
		</div>
		
 
	</form>
	
	<div style="clear:both;"></div>


  <script>
	jQuery( document ).ready(function($) {

			$('a.preset').click(function(){
				var settings = $(this).find('textarea').val();
				$('#export_data').val(settings);
				$('.backupandimport').click();
				$('#of_import_button').click();

			});


			// PRESETS
			$('.section-presets .button-primary').click(function(e){
				$(this).parent().find('.pre_select_wrapper').slideToggle();
				e.preventDefault();
			});

			$('a[data-preset]').click(function(e){
				var preset = $(this).data('preset');
				if(preset == 'header_1') { 
					value = "YToxODp7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIxMDAiO3M6MTA6ImxvZ29fd2lkdGgiO3M6MzoiMjM0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MTA6InNlYXJjaF9wb3MiO3M6NDoibGVmdCI7czoxMjoibmF2X3Bvc2l0aW9uIjtzOjM6InRvcCI7czoxODoibXlhY2NvdW50X2Ryb3Bkb3duIjtzOjE6IjEiO3M6OToic2hvd19jYXJ0IjtzOjE6IjEiO3M6MTQ6InRvcF9yaWdodF90ZXh0IjtzOjA6IiI7czoxMzoiaGVhZGVyX3N0aWNreSI7czoxOiIxIjtzOjIwOiJoZWFkZXJfaGVpZ2h0X3N0aWNreSI7czoyOiI3MCI7czoxMjoiaGVhZGVyX2NvbG9yIjtzOjU6ImxpZ2h0IjtzOjk6ImhlYWRlcl9iZyI7czo1OiIjZmZmZiI7czoxMzoiaGVhZGVyX2JnX2ltZyI7czowOiIiO3M6MTc6ImhlYWRlcl9iZ19pbWdfcG9zIjtzOjg6InJlcGVhdC14IjtzOjExOiJ0b3BiYXJfc2hvdyI7aToxO3M6OToidG9wYmFyX2JnIjtzOjA6IiI7czoxNzoibmF2X3Bvc2l0aW9uX3RleHQiO3M6MDoiIjtzOjIxOiJuYXZfcG9zaXRpb25fdGV4dF90b3AiO3M6MDoiIjt9"
				}

				if(preset == 'header_1_2') { 
					value = "YToyMDp7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIxMDAiO3M6MTA6ImxvZ29fd2lkdGgiO3M6MzoiMjM0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MTA6InNlYXJjaF9wb3MiO3M6NDoibGVmdCI7czoxMjoibmF2X3Bvc2l0aW9uIjtzOjM6InRvcCI7czoxODoibXlhY2NvdW50X2Ryb3Bkb3duIjtzOjE6IjAiO3M6OToic2hvd19jYXJ0IjtzOjE6IjAiO3M6MTQ6InRvcF9yaWdodF90ZXh0IjtzOjE2MToiW3Bob25lIG51bWJlcj0iKzk5IDkwMSA5MDIiIGJvcmRlcj0iMnB4IiB0b29sdGlwPSJDb250YWN0IHVzIHRvZGF5Il0gW2hlYWRlcl9idXR0b24gdGV4dD0iT3JkZXIgbm93IiB0b29sdGlwPSJDbGljayBoZXJlIHRvIG9yZGVyIiBsaW5rPSJodHRwOi8vIyIiIGJvcmRlcj0iMnB4Il0iO3M6MTM6ImhlYWRlcl9zdGlja3kiO3M6MToiMSI7czoyMDoiaGVhZGVyX2hlaWdodF9zdGlja3kiO3M6MjoiNzAiO3M6MTI6ImhlYWRlcl9jb2xvciI7czo1OiJsaWdodCI7czo5OiJoZWFkZXJfYmciO3M6NToiI2ZmZmYiO3M6MTM6ImhlYWRlcl9iZ19pbWciO3M6MDoiIjtzOjE3OiJoZWFkZXJfYmdfaW1nX3BvcyI7czo4OiJyZXBlYXQteCI7czoxMToidG9wYmFyX3Nob3ciO2k6MTtzOjk6InRvcGJhcl9iZyI7czowOiIiO3M6MTU6Im5hdl9wb3NpdGlvbl9iZyI7czo3OiIjMGEwYTBhIjtzOjE4OiJuYXZfcG9zaXRpb25fY29sb3IiO3M6MTE6ImRhcmstaGVhZGVyIjtzOjE3OiJuYXZfcG9zaXRpb25fdGV4dCI7czowOiIiO3M6MjE6Im5hdl9wb3NpdGlvbl90ZXh0X3RvcCI7czowOiIiO30="
				}

				if(preset == 'header_1_3') { 
					value = "YToyMDp7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIxMDAiO3M6MTA6ImxvZ29fd2lkdGgiO3M6MzoiMjM0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MTA6InNlYXJjaF9wb3MiO3M6NDoibGVmdCI7czoxMjoibmF2X3Bvc2l0aW9uIjtzOjM6InRvcCI7czoxODoibXlhY2NvdW50X2Ryb3Bkb3duIjtzOjE6IjAiO3M6OToic2hvd19jYXJ0IjtzOjE6IjAiO3M6MTQ6InRvcF9yaWdodF90ZXh0IjtzOjc0OiJbZm9sbG93IGZhY2Vib29rPSIjIiIgdHdpdHRlcj0iIyIgaW5zdGFncmFtPSIjIiAgZ29vZ2xlcGx1cz0iIyIgZW1haWw9IiMiXSI7czoxMzoiaGVhZGVyX3N0aWNreSI7czoxOiIxIjtzOjIwOiJoZWFkZXJfaGVpZ2h0X3N0aWNreSI7czoyOiI3MCI7czoxMjoiaGVhZGVyX2NvbG9yIjtzOjU6ImxpZ2h0IjtzOjk6ImhlYWRlcl9iZyI7czo1OiIjZmZmZiI7czoxMzoiaGVhZGVyX2JnX2ltZyI7czowOiIiO3M6MTc6ImhlYWRlcl9iZ19pbWdfcG9zIjtzOjg6InJlcGVhdC14IjtzOjExOiJ0b3BiYXJfc2hvdyI7aToxO3M6OToidG9wYmFyX2JnIjtzOjA6IiI7czoxNToibmF2X3Bvc2l0aW9uX2JnIjtzOjc6IiMwYTBhMGEiO3M6MTg6Im5hdl9wb3NpdGlvbl9jb2xvciI7czoxMToiZGFyay1oZWFkZXIiO3M6MTc6Im5hdl9wb3NpdGlvbl90ZXh0IjtzOjA6IiI7czoyMToibmF2X3Bvc2l0aW9uX3RleHRfdG9wIjtzOjA6IiI7fQ=="
				}

				if(preset == 'header_1_4') { 
					value = "YToyMDp7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIxMDAiO3M6MTA6ImxvZ29fd2lkdGgiO3M6MzoiMjM0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjY6ImNlbnRlciI7czoxMDoic2VhcmNoX3BvcyI7czo0OiJsZWZ0IjtzOjEyOiJuYXZfcG9zaXRpb24iO3M6MzoidG9wIjtzOjE4OiJteWFjY291bnRfZHJvcGRvd24iO3M6MToiMSI7czo5OiJzaG93X2NhcnQiO3M6MToiMSI7czoxNDoidG9wX3JpZ2h0X3RleHQiO3M6MDoiIjtzOjEzOiJoZWFkZXJfc3RpY2t5IjtzOjE6IjEiO3M6MjA6ImhlYWRlcl9oZWlnaHRfc3RpY2t5IjtzOjI6IjcwIjtzOjEyOiJoZWFkZXJfY29sb3IiO3M6NToibGlnaHQiO3M6OToiaGVhZGVyX2JnIjtzOjU6IiNmZmZmIjtzOjEzOiJoZWFkZXJfYmdfaW1nIjtzOjA6IiI7czoxNzoiaGVhZGVyX2JnX2ltZ19wb3MiO3M6ODoicmVwZWF0LXgiO3M6MTE6InRvcGJhcl9zaG93IjtpOjE7czo5OiJ0b3BiYXJfYmciO3M6MDoiIjtzOjE1OiJuYXZfcG9zaXRpb25fYmciO3M6NzoiIzBhMGEwYSI7czoxODoibmF2X3Bvc2l0aW9uX2NvbG9yIjtzOjExOiJkYXJrLWhlYWRlciI7czoxNzoibmF2X3Bvc2l0aW9uX3RleHQiO3M6MDoiIjtzOjIxOiJuYXZfcG9zaXRpb25fdGV4dF90b3AiO3M6MDoiIjt9"
				}

				if(preset == 'header_1_5') { 
					value = "YToxODp7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIxMDAiO3M6MTA6ImxvZ29fd2lkdGgiO3M6MzoiMjM0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjY6ImNlbnRlciI7czoxMDoic2VhcmNoX3BvcyI7czo0OiJsZWZ0IjtzOjEyOiJuYXZfcG9zaXRpb24iO3M6MzoidG9wIjtzOjE4OiJteWFjY291bnRfZHJvcGRvd24iO3M6MToiMSI7czo5OiJzaG93X2NhcnQiO3M6MToiMSI7czoxNDoidG9wX3JpZ2h0X3RleHQiO3M6MDoiIjtzOjEzOiJoZWFkZXJfc3RpY2t5IjtzOjE6IjEiO3M6MjA6ImhlYWRlcl9oZWlnaHRfc3RpY2t5IjtzOjI6IjcwIjtzOjEyOiJoZWFkZXJfY29sb3IiO3M6NToibGlnaHQiO3M6OToiaGVhZGVyX2JnIjtzOjU6IiNmZmZmIjtzOjEzOiJoZWFkZXJfYmdfaW1nIjtzOjA6IiI7czoxNzoiaGVhZGVyX2JnX2ltZ19wb3MiO3M6ODoicmVwZWF0LXgiO3M6MTE6InRvcGJhcl9zaG93IjtpOjE7czo5OiJ0b3BiYXJfYmciO3M6MDoiIjtzOjE3OiJuYXZfcG9zaXRpb25fdGV4dCI7czowOiIiO3M6MjE6Im5hdl9wb3NpdGlvbl90ZXh0X3RvcCI7czowOiIiO30="	
				}

				if(preset == 'header_6') { 
					value = "YToxODp7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIxMDAiO3M6MTA6ImxvZ29fd2lkdGgiO3M6MzoiMjM0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MTA6InNlYXJjaF9wb3MiO3M6NDoibGVmdCI7czoxMjoibmF2X3Bvc2l0aW9uIjtzOjM6InRvcCI7czoxODoibXlhY2NvdW50X2Ryb3Bkb3duIjtzOjE6IjEiO3M6OToic2hvd19jYXJ0IjtzOjE6IjEiO3M6MTQ6InRvcF9yaWdodF90ZXh0IjtzOjA6IiI7czoxMzoiaGVhZGVyX3N0aWNreSI7czoxOiIxIjtzOjIwOiJoZWFkZXJfaGVpZ2h0X3N0aWNreSI7czoyOiI3MCI7czoxMjoiaGVhZGVyX2NvbG9yIjtzOjQ6ImRhcmsiO3M6OToiaGVhZGVyX2JnIjtzOjQ6IiMwMDAiO3M6MTM6ImhlYWRlcl9iZ19pbWciO3M6MDoiIjtzOjE3OiJoZWFkZXJfYmdfaW1nX3BvcyI7czo4OiJyZXBlYXQteCI7czoxMToidG9wYmFyX3Nob3ciO2k6MDtzOjk6InRvcGJhcl9iZyI7czowOiIiO3M6MTc6Im5hdl9wb3NpdGlvbl90ZXh0IjtzOjA6IiI7czoyMToibmF2X3Bvc2l0aW9uX3RleHRfdG9wIjtzOjA6IiI7fQ=="
				}
					if(preset == 'header_2') { 
					value = "YToyMDp7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIxMjAiO3M6MTA6ImxvZ29fd2lkdGgiO3M6MzoiMjU0IjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjY6ImNlbnRlciI7czoxMDoic2VhcmNoX3BvcyI7czo1OiJyaWdodCI7czoxMjoibmF2X3Bvc2l0aW9uIjtzOjEzOiJib3R0b21fY2VudGVyIjtzOjE4OiJteWFjY291bnRfZHJvcGRvd24iO3M6MToiMSI7czo5OiJzaG93X2NhcnQiO3M6MToiMSI7czoxNDoidG9wX3JpZ2h0X3RleHQiO3M6MDoiIjtzOjEzOiJoZWFkZXJfc3RpY2t5IjtzOjE6IjEiO3M6MjA6ImhlYWRlcl9oZWlnaHRfc3RpY2t5IjtzOjI6IjkwIjtzOjEyOiJoZWFkZXJfY29sb3IiO3M6NDoiZGFyayI7czo5OiJoZWFkZXJfYmciO3M6NDoiIzIyMiI7czoxMzoiaGVhZGVyX2JnX2ltZyI7czowOiIiO3M6MTc6ImhlYWRlcl9iZ19pbWdfcG9zIjtzOjg6InJlcGVhdC14IjtzOjExOiJ0b3BiYXJfc2hvdyI7aToxO3M6OToidG9wYmFyX2JnIjtzOjQ6IiMxMTEiO3M6MTU6Im5hdl9wb3NpdGlvbl9iZyI7czo0OiIjMzMzIjtzOjE4OiJuYXZfcG9zaXRpb25fY29sb3IiO3M6MTE6ImRhcmstaGVhZGVyIjtzOjE3OiJuYXZfcG9zaXRpb25fdGV4dCI7czowOiIiO3M6MjE6Im5hdl9wb3NpdGlvbl90ZXh0X3RvcCI7czo1NzoiW2ZvbGxvdyBmYWNlYm9vaz0iIyIgdHdpdHRlcj0iIyIgaW5zdGFncmFtPSIjIiBlbWFpbD0iIyJdIjt9"
				}
					if(preset == 'header_3') { 
					value = "YToyMTp7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIxMjAiO3M6MTA6ImxvZ29fd2lkdGgiO3M6MzoiMjAwIjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MTA6InNlYXJjaF9wb3MiO3M6NDoibGVmdCI7czoxMjoibmF2X3Bvc2l0aW9uIjtzOjY6ImJvdHRvbSI7czoxODoibXlhY2NvdW50X2Ryb3Bkb3duIjtzOjE6IjEiO3M6OToic2hvd19jYXJ0IjtzOjE6IjEiO3M6MTQ6InRvcF9yaWdodF90ZXh0IjtzOjA6IiI7czoxMzoiaGVhZGVyX3N0aWNreSI7czoxOiIxIjtzOjIwOiJoZWFkZXJfaGVpZ2h0X3N0aWNreSI7czoyOiI3MCI7czoxMjoiaGVhZGVyX2NvbG9yIjtzOjU6ImxpZ2h0IjtzOjk6ImhlYWRlcl9iZyI7czo1OiIjZmZmZiI7czoxMzoiaGVhZGVyX2JnX2ltZyI7czowOiIiO3M6MTc6ImhlYWRlcl9iZ19pbWdfcG9zIjtzOjg6InJlcGVhdC14IjtzOjExOiJ0b3BiYXJfc2hvdyI7aToxO3M6OToidG9wYmFyX2JnIjtzOjQ6IiMxMTEiO3M6MTU6ImNvbG9yX3NlY29uZGFyeSI7czo3OiIjOGYwMDAwIjtzOjE1OiJuYXZfcG9zaXRpb25fYmciO3M6NzoiIzhmMDAwMCI7czoxODoibmF2X3Bvc2l0aW9uX2NvbG9yIjtzOjExOiJkYXJrLWhlYWRlciI7czoxNzoibmF2X3Bvc2l0aW9uX3RleHQiO3M6MTMzOiI8YSBocmVmPSIjbmV3c2xldHRlci1zaWdudXAiIGNsYXNzPSJvcGVuLXBvcHVwLWxpbmstbmV3c2xldHRlci1zaWdudXAiPjxzcGFuIGNsYXNzPSJpY29uLWVudmVsb3AiPjwvc3Bhbj4gU2lnbiB1cCBmb3IgbmV3c2xldHRlciE8L2E+IjtzOjIxOiJuYXZfcG9zaXRpb25fdGV4dF90b3AiO3M6NTc6Iltmb2xsb3cgZmFjZWJvb2s9IiMiIHR3aXR0ZXI9IiMiIGluc3RhZ3JhbT0iIyIgZW1haWw9IiMiXSI7fQ=="
				}
					if(preset == 'header_3_1') { 
					value = "YToyMDp7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIxMjAiO3M6MTA6ImxvZ29fd2lkdGgiO3M6MzoiMjMwIjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MTA6InNlYXJjaF9wb3MiO3M6NDoibGVmdCI7czoxMjoibmF2X3Bvc2l0aW9uIjtzOjY6ImJvdHRvbSI7czoxODoibXlhY2NvdW50X2Ryb3Bkb3duIjtzOjE6IjEiO3M6OToic2hvd19jYXJ0IjtzOjE6IjEiO3M6MTQ6InRvcF9yaWdodF90ZXh0IjtzOjA6IiI7czoxMzoiaGVhZGVyX3N0aWNreSI7czoxOiIxIjtzOjIwOiJoZWFkZXJfaGVpZ2h0X3N0aWNreSI7czoyOiI3MCI7czoxMjoiaGVhZGVyX2NvbG9yIjtzOjQ6ImRhcmsiO3M6OToiaGVhZGVyX2JnIjtzOjQ6IiMwMDAiO3M6MTM6ImhlYWRlcl9iZ19pbWciO3M6MDoiIjtzOjE3OiJoZWFkZXJfYmdfaW1nX3BvcyI7czo4OiJyZXBlYXQteCI7czoxMToidG9wYmFyX3Nob3ciO2k6MTtzOjk6InRvcGJhcl9iZyI7czo0OiIjMTExIjtzOjE1OiJuYXZfcG9zaXRpb25fYmciO3M6NDoiIzIyMiI7czoxODoibmF2X3Bvc2l0aW9uX2NvbG9yIjtzOjExOiJkYXJrLWhlYWRlciI7czoxNzoibmF2X3Bvc2l0aW9uX3RleHQiO3M6MTU6IkFkZCBIVE1MIGhlcmUuLiI7czoyMToibmF2X3Bvc2l0aW9uX3RleHRfdG9wIjtzOjE2OiJBZGQgSFRNTCAgaGVyZS4uIjt9"
				}
					if(preset == 'header_3_2') { 
					value = "YToyMDp7czoxMzoiaGVhZGVyX2hlaWdodCI7czozOiIxMjAiO3M6MTA6ImxvZ29fd2lkdGgiO3M6MzoiMjAwIjtzOjEzOiJsb2dvX3Bvc2l0aW9uIjtzOjQ6ImxlZnQiO3M6MTA6InNlYXJjaF9wb3MiO3M6NDoibGVmdCI7czoxMjoibmF2X3Bvc2l0aW9uIjtzOjY6ImJvdHRvbSI7czoxODoibXlhY2NvdW50X2Ryb3Bkb3duIjtzOjE6IjEiO3M6OToic2hvd19jYXJ0IjtzOjE6IjEiO3M6MTQ6InRvcF9yaWdodF90ZXh0IjtzOjA6IiI7czoxMzoiaGVhZGVyX3N0aWNreSI7czoxOiIxIjtzOjIwOiJoZWFkZXJfaGVpZ2h0X3N0aWNreSI7czoyOiI3MCI7czoxMjoiaGVhZGVyX2NvbG9yIjtzOjU6ImxpZ2h0IjtzOjk6ImhlYWRlcl9iZyI7czo1OiIjZmZmZiI7czoxMzoiaGVhZGVyX2JnX2ltZyI7czowOiIiO3M6MTc6ImhlYWRlcl9iZ19pbWdfcG9zIjtzOjg6InJlcGVhdC14IjtzOjExOiJ0b3BiYXJfc2hvdyI7aToxO3M6OToidG9wYmFyX2JnIjtzOjQ6IiMxMTEiO3M6MTU6Im5hdl9wb3NpdGlvbl9iZyI7czo3OiIjZjFmMWYxIjtzOjE4OiJuYXZfcG9zaXRpb25fY29sb3IiO3M6MTI6ImxpZ2h0LWhlYWRlciI7czoxNzoibmF2X3Bvc2l0aW9uX3RleHQiO3M6Mjk6IkFkZCBIVE1MIG9yIFNob3J0Y29kZXMgaGVyZS4uIjtzOjIxOiJuYXZfcG9zaXRpb25fdGV4dF90b3AiO3M6Mjk6IkFkZCBIVE1MIG9yIFNob3J0Y29kZXMgaGVyZS4uIjt9"
				}
					if(preset == 'header_5') { 
					value = "YToxODp7czoxMzoiaGVhZGVyX2hlaWdodCI7czoyOiI4NSI7czoxMDoibG9nb193aWR0aCI7czozOiIyMDAiO3M6MTM6ImxvZ29fcG9zaXRpb24iO3M6NDoibGVmdCI7czoxMDoic2VhcmNoX3BvcyI7czo0OiJsZWZ0IjtzOjEyOiJuYXZfcG9zaXRpb24iO3M6MzoidG9wIjtzOjE4OiJteWFjY291bnRfZHJvcGRvd24iO3M6MToiMSI7czo5OiJzaG93X2NhcnQiO3M6MToiMSI7czoxNDoidG9wX3JpZ2h0X3RleHQiO3M6MDoiIjtzOjEzOiJoZWFkZXJfc3RpY2t5IjtzOjE6IjEiO3M6MjA6ImhlYWRlcl9oZWlnaHRfc3RpY2t5IjtzOjI6IjcwIjtzOjEyOiJoZWFkZXJfY29sb3IiO3M6NToibGlnaHQiO3M6OToiaGVhZGVyX2JnIjtzOjQ6IiNmZmYiO3M6MTM6ImhlYWRlcl9iZ19pbWciO3M6MDoiIjtzOjE3OiJoZWFkZXJfYmdfaW1nX3BvcyI7czo4OiJyZXBlYXQteCI7czoxMToidG9wYmFyX3Nob3ciO2k6MDtzOjk6InRvcGJhcl9iZyI7czowOiIiO3M6MTc6Im5hdl9wb3NpdGlvbl90ZXh0IjtzOjA6IiI7czoyMToibmF2X3Bvc2l0aW9uX3RleHRfdG9wIjtzOjA6IiI7fQ=="
				}
					if(preset == 'header_5_2') { 
					value = "YToxODp7czoxMzoiaGVhZGVyX2hlaWdodCI7czoyOiI4NSI7czoxMDoibG9nb193aWR0aCI7czozOiIyMDAiO3M6MTM6ImxvZ29fcG9zaXRpb24iO3M6NDoibGVmdCI7czoxMDoic2VhcmNoX3BvcyI7czo0OiJsZWZ0IjtzOjEyOiJuYXZfcG9zaXRpb24iO3M6MzoidG9wIjtzOjE4OiJteWFjY291bnRfZHJvcGRvd24iO3M6MToiMCI7czo5OiJzaG93X2NhcnQiO3M6MToiMCI7czoxNDoidG9wX3JpZ2h0X3RleHQiO3M6NzA6Iltmb2xsb3cgc2l6ZT0ic21hbGwiIGZhY2Vib29rPSIjIiB0d2l0dGVyPSIjIiBpbnN0YWdyYW09IiMiIGVtYWlsPSIjIl0iO3M6MTM6ImhlYWRlcl9zdGlja3kiO3M6MToiMSI7czoyMDoiaGVhZGVyX2hlaWdodF9zdGlja3kiO3M6MjoiNzAiO3M6MTI6ImhlYWRlcl9jb2xvciI7czo1OiJsaWdodCI7czo5OiJoZWFkZXJfYmciO3M6NDoiI2ZmZiI7czoxMzoiaGVhZGVyX2JnX2ltZyI7czowOiIiO3M6MTc6ImhlYWRlcl9iZ19pbWdfcG9zIjtzOjg6InJlcGVhdC14IjtzOjExOiJ0b3BiYXJfc2hvdyI7aTowO3M6OToidG9wYmFyX2JnIjtzOjA6IiI7czoxNzoibmF2X3Bvc2l0aW9uX3RleHQiO3M6MDoiIjtzOjIxOiJuYXZfcG9zaXRpb25fdGV4dF90b3AiO3M6MDoiIjt9"
				}
				
				$('#export_data').val(value);
				$('#of_import_button').click();
				$(this).parent().slideUp();
				e.preventDefault();
			});

	});
	</script>

</div><!--wrap-->