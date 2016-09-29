<?php
	$post_types = get_post_types( array( 'public' => true ), 'objects' );
	// delete_option( 'znhg_post_love_options' );
	$saved_options = get_option( 'znhg_post_love_options', array('post_types' => array('post')) );
?>


<div class="wrap plhg_options_wrapper">
	<form method="post" id="znhg_plh_form" action="<?php echo admin_url('admin-ajax.php'); ?>">
		<h2>Post Love options</h2>
		<div class="plhg_tagline">by Hogash</div>
		<div class="plhg_options_container">
			<div class="plhg_left">

				<table class="plhg_option_wrapper">
					<tbody>
						<tr>
							<td class="plhg_titledesc"><h3>Post types :</h3></td>
							<td>
								<?php

								$saved_post_types = isset( $saved_options['post_types'] ) ? $saved_options['post_types'] : array();

								foreach ($post_types as $key => $post_object ) {
									$checked = '';
									if ( in_array( $key, $saved_post_types ) ) {
										$checked = 'checked="checked"';
									}

									echo '<label>';
										echo '<input type="checkbox" class="radio" value="'.$key.'" '.$checked.' name="plhg_post_types[]" />'.$post_object->labels->name;
									echo '</label>';
								}
								?>
							</td>
						</tr>

						<tr>
							<td class="plhg_titledesc"><h3>Who can love :</h3></td>
							<td>
								<?php
									$saved_allowed_voters = isset( $saved_options['allowed_voters'] ) ? $saved_options['allowed_voters'] : 'anyone';
								?>
								<select name="plhg_allowed_voters">
									<option value="anyone" <?php selected( $saved_allowed_voters, 'anyone' ); ?>>Anyone</option>
									<option value="registered" <?php selected( $saved_allowed_voters, 'registered' ); ?>>Registered only</option>
								</select>
							</td>
						</tr>

					</tbody>
				</table>

				<input name="save" class="button-primary" type="submit" value="Save changes">
				<span class="znhg_ts_save_message"></span>

			</div>
			<div class="plhg_right ">
<!-- 				<div class="plhg_example_label">How it will display:</div>
				<h1>This is just a sample post name</h1>
				<p>Look, just because I don't be givin' no man a foot massage don't make it right for Marsellus to throw Antwone into a glass motherfuckin' house, fuckin' up the way the nigger talks. Motherfucker do that shit to me, he better paralyze my ass, 'cause I'll kill the motherfucker, know what I'm sayin'?</p>

				<div class="plhg-love-button-container">
					<span class="plhg-love-button-inner">
						<a href="#" class="plhg-love-action-trigger">
							<span class="plhg-love-count">14</span>
						</a>
					</span>
				</div> -->

			</div>
		</div>
	</form>
</div>