<?php




function wpvltr_ltr_settings_page() {

	$url_to_here = str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);
	$url_to_here = explode("&", $url_to_here);
	$url_to_here = $url_to_here[0];

	?>


	<div class="wrap wpvltr_likebox_admin">


		<div id="icon-options-general" class="icon32"><br /></div><h2>Like To Keep Reading Settings</h2>


		<form method="post" action="options.php">

			<?php settings_fields('wpvltr-settings-group-ltr'); ?>


<table class="form-table">

	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-liketokeepreading-hide">Hide</label></th>

		<td>
			<?php wpvltr_checkmark('wpvltr-settings-liketokeepreading-hide', "Hide the Like To Keep Reading box after the Like button is clicked."); ?>
		</td>

	</tr>


	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-liketokeepreading-message">Pre-Like Message</label></th>

		<td><input name="wpvltr-settings-liketokeepreading-message" type="text" value="<?php echo get_option('wpvltr-settings-liketokeepreading-message'); ?>" class="regular-text" /></td>

	</tr>


	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-liketokeepreading-thanksmessage">After-Like Message</label></th>

		<td><input name="wpvltr-settings-liketokeepreading-thanksmessage" type="text" value="<?php echo get_option('wpvltr-settings-liketokeepreading-thanksmessage'); ?>" class="regular-text" /></td>

	</tr>



	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-liketokeepreading-bgcolor">Box Background Color</label></th>

		<td><input name="wpvltr-settings-liketokeepreading-bgcolor" type="text" value="<?php echo get_option('wpvltr-settings-liketokeepreading-bgcolor'); ?>" class="regular-text" /></td>

	</tr>

	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-liketokeepreading-bordercolor">Box Border Color</label></th>

		<td><input name="wpvltr-settings-liketokeepreading-bordercolor" type="text" value="<?php echo get_option('wpvltr-settings-liketokeepreading-bordercolor'); ?>" class="regular-text" /></td>

	</tr>


	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-liketokeepreading-borderwidth">Box Border Width</label></th>

		<td><input name="wpvltr-settings-liketokeepreading-borderwidth" type="text" value="<?php echo get_option('wpvltr-settings-liketokeepreading-borderwidth'); ?>" class="regular-text" /></td>

	</tr>

	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-liketokeepreading-borderstyle">Box Border Style</label></th>

		<td><input name="wpvltr-settings-liketokeepreading-borderstyle" type="text" value="<?php echo get_option('wpvltr-settings-liketokeepreading-borderstyle'); ?>" class="regular-text" /></td>

	</tr>


	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-liketokeepreading-attdlcss">Additional CSS To Apply To Box</label></th>

		<td><input name="wpvltr-settings-liketokeepreading-attdlcss" type="text" value="<?php echo get_option('wpvltr-settings-liketokeepreading-attdlcss'); ?>" class="regular-text" /></td>

	</tr>



	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-liketokeepreading-href">URL to Like</label></th>

		<td><input name="wpvltr-settings-liketokeepreading-href" type="text" value="<?php echo get_option('wpvltr-settings-liketokeepreading-href'); ?>" class="regular-text code" /></td>

	</tr>



</table>







<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"  /></p></form>





	</div>


	<?php

}


