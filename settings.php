<?php

function wpvltr_checkmark($field, $text, $html = "") {

	$val = get_option($field);

	if ($val == 'Yes') {
		$checked = 'checked';
	}


	echo "<input type='checkbox' value='Yes' id='".$field."' name='".$field."' ".$html." ".$checked.">";
	echo " <label for='".$field."'>".$text."</label>";


}



function wpvltr_register_settings() {


	register_setting('wpvltr-settings-group', 'wpvltr-settings-likebutton-show');
	register_setting('wpvltr-settings-group', 'wpvltr-settings-likebutton-colorscheme');		// light/dark
	register_setting('wpvltr-settings-group', 'wpvltr-settings-likebutton-action'); 			//like/recommend
	register_setting('wpvltr-settings-group', 'wpvltr-settings-likebutton-layout'); 			// box_count / button_count / standard
	register_setting('wpvltr-settings-group', 'wpvltr-settings-likebutton-send');			// false / true
	register_setting('wpvltr-settings-group', 'wpvltr-settings-likebutton-locale');			// en_US

	register_setting('wpvltr-settings-group', 'wpvltr-settings-plusone-show');
	register_setting('wpvltr-settings-group', 'wpvltr-settings-plusone-annotation');			// none, bubble, inline
	register_setting('wpvltr-settings-group', 'wpvltr-settings-plusone-size');			// small, medium, standard, tall

	register_setting('wpvltr-settings-group', 'wpvltr-settings-twitter-show');
	register_setting('wpvltr-settings-group', 'wpvltr-settings-twitter-count');			// none horizontal vertical
	register_setting('wpvltr-settings-group', 'wpvltr-settings-twitter-size');			// medium large
	register_setting('wpvltr-settings-group', 'wpvltr-settings-twitter-text');			// "Look at this: " or similar - goes before the URL






/*	data-width="500" data-show-faces="true" data-font="tahoma" */
//		'locale' => 'en_US', // en_US


	register_setting('wpvltr-settings-group-ltr', 'wpvltr-settings-liketokeepreading-message');
	register_setting('wpvltr-settings-group-ltr', 'wpvltr-settings-liketokeepreading-thanksmessage');
	register_setting('wpvltr-settings-group-ltr', 'wpvltr-settings-liketokeepreading-bordercolor');
	register_setting('wpvltr-settings-group-ltr', 'wpvltr-settings-liketokeepreading-bgcolor');
	register_setting('wpvltr-settings-group-ltr', 'wpvltr-settings-liketokeepreading-borderwidth');
	register_setting('wpvltr-settings-group-ltr', 'wpvltr-settings-liketokeepreading-borderstyle');
	register_setting('wpvltr-settings-group-ltr', 'wpvltr-settings-liketokeepreading-attdlcss');
	register_setting('wpvltr-settings-group-ltr', 'wpvltr-settings-liketokeepreading-hide');
	register_setting('wpvltr-settings-group-ltr', 'wpvltr-settings-liketokeepreading-href');






}

add_action('admin_init', 'wpvltr_register_settings');




function wpvltr_settings_page() {

	$url_to_here = str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);
	$url_to_here = explode("&", $url_to_here);
	$url_to_here = $url_to_here[0];

	?>


	<div class="wrap wpvltr_settings_admin">


		<div id="icon-options-general" class="icon32"><br /></div><h2>Button Display Settings</h2>


		<form method="post" action="options.php">

			<?php settings_fields('wpvltr-settings-group'); ?>


<h3>Facebook Like Button</h3>
<table class="form-table">

	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-likebutton-show">Show</label></th>

		<td>
			<?php wpvltr_checkmark('wpvltr-settings-likebutton-show', "Show the Facebook Like Button"); ?>
		</td>

	</tr>


	<tr>

		<th scope="row"><label for="wpvltr-settings-likebutton-colorscheme">Color Scheme</label></th>
		<td>
			<fieldset>
				<?php $checked['colorscheme'][get_option('wpvltr-settings-likebutton-colorscheme')] = " checked='checked' "; ?>
				<label><input type='radio' name='wpvltr-settings-likebutton-colorscheme' value='light' <?php echo $checked['colorscheme']['light']; ?> /> <span>light</span></label><br />
				<label><input type='radio' name='wpvltr-settings-likebutton-colorscheme' value='dark' <?php echo $checked['colorscheme']['dark']; ?> /> <span>dark</span></label><br />
			</fieldset>
		</td>

	</tr>

	<tr>

		<th scope="row"><label for="wpvltr-settings-likebutton-action">Action</label></th>
		<td>
			<fieldset>
				<?php $checked['action'][get_option('wpvltr-settings-likebutton-action')] = " checked='checked' "; ?>
				<label><input type='radio' name='wpvltr-settings-likebutton-action' value='like' <?php echo $checked['action']['like']; ?> /> <span>like</span></label><br />
				<label><input type='radio' name='wpvltr-settings-likebutton-action' value='recommend' <?php echo $checked['action']['recommend']; ?> /> <span>recommend</span></label><br />
			</fieldset>
		</td>

	</tr>

	<tr>

		<th scope="row"><label for="wpvltr-settings-likebutton-layout">Layout</label></th>
		<td>
			<fieldset>
				<?php $checked['layout'][get_option('wpvltr-settings-likebutton-layout')] = " checked='checked' "; ?>
				<label><input type='radio' name='wpvltr-settings-likebutton-layout' value='standard' <?php echo $checked['layout']['standard']; ?> /> <span>standard</span></label><br />
				<label><input type='radio' name='wpvltr-settings-likebutton-layout' value='box_count' <?php echo $checked['layout']['box_count']; ?> /> <span>box_count</span></label><br />
				<label><input type='radio' name='wpvltr-settings-likebutton-layout' value='button_count' <?php echo $checked['layout']['button_count']; ?> /> <span>button_count</span></label><br />
			</fieldset>
		</td>

	</tr>

	<tr>

		<th scope="row"><label for="wpvltr-settings-likebutton-send">Send</label></th>
		<td>
			<fieldset>
				<?php $checked['send'][get_option('wpvltr-settings-likebutton-send')] = " checked='checked' "; ?>
				<label><input type='radio' name='wpvltr-settings-likebutton-send' value='false' <?php echo $checked['send']['false']; ?> /> <span>false</span></label><br />
				<label><input type='radio' name='wpvltr-settings-likebutton-send' value='true' <?php echo $checked['send']['true']; ?> /> <span>true</span></label><br />
			</fieldset>
		</td>

	</tr>

	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-likebutton-locale">Locale</label></th>

		<td><input name="wpvltr-settings-likebutton-locale" type="text" value="<?php echo get_option('wpvltr-settings-likebutton-locale'); ?>" class="regular-text" style='width: 130px;' /></td>

	</tr>

</table>





<h3>Google +1 Button</h3>
<table class="form-table">

	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-plusone-show">Show</label></th>

		<td>
			<?php wpvltr_checkmark('wpvltr-settings-plusone-show', "Show the Google +1 Button"); ?>
		</td>

	</tr>

	<tr>

		<th scope="row"><label for="wpvltr-settings-plusone-annotation">Annotation</label></th>
		<td>
			<fieldset>
				<?php $checked['annotation'][get_option('wpvltr-settings-plusone-annotation')] = " checked='checked' "; ?>
				<label><input type='radio' name='wpvltr-settings-plusone-annotation' value='none' <?php echo $checked['annotation']['none']; ?> /> <span>none</span></label><br />
				<label><input type='radio' name='wpvltr-settings-plusone-annotation' value='bubble' <?php echo $checked['annotation']['bubble']; ?> /> <span>bubble</span></label><br />
				<label><input type='radio' name='wpvltr-settings-plusone-annotation' value='inline' <?php echo $checked['annotation']['inline']; ?> /> <span>inline</span></label><br />
			</fieldset>
		</td>

	</tr>


	<tr>

		<th scope="row"><label for="wpvltr-settings-plusone-size">Size</label></th>
		<td>
			<fieldset>
				<?php $checked['size'][get_option('wpvltr-settings-plusone-size')] = " checked='checked' "; ?>

				<label><input type='radio' name='wpvltr-settings-plusone-size' value='standard' <?php echo $checked['size']['standard']; ?> /> <span>standard</span></label><br />
				<label><input type='radio' name='wpvltr-settings-plusone-size' value='small' <?php echo $checked['size']['small']; ?> /> <span>small</span></label><br />
				<label><input type='radio' name='wpvltr-settings-plusone-size' value='medium' <?php echo $checked['size']['medium']; ?> /> <span>medium</span></label><br />
				<label><input type='radio' name='wpvltr-settings-plusone-size' value='tall' <?php echo $checked['size']['tall']; ?> /> <span>tall</span></label><br />

			</fieldset>
		</td>

	</tr>


</table>



<h3>Twitter Button</h3>
<table class="form-table">

	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-twitter-show">Show</label></th>

		<td>
			<?php wpvltr_checkmark('wpvltr-settings-twitter-show', "Show the Twitter Tweet Button"); ?>
		</td>

	</tr>


	<tr>

		<th scope="row"><label for="wpvltr-settings-twitter-count">Count</label></th>
		<td>
			<fieldset>
				<?php $checked['count'][get_option('wpvltr-settings-twitter-count')] = " checked='checked' "; ?>
				<label><input type='radio' name='wpvltr-settings-twitter-count' value='none' <?php echo $checked['count']['none']; ?> /> <span>none</span></label><br />
				<label><input type='radio' name='wpvltr-settings-twitter-count' value='horizontal' <?php echo $checked['count']['horizontal']; ?> /> <span>horizontal</span></label><br />
				<label><input type='radio' name='wpvltr-settings-twitter-count' value='vertical' <?php echo $checked['count']['vertical']; ?> /> <span>vertical</span></label><br />
			</fieldset>
		</td>

	</tr>


	<tr>

		<th scope="row"><label for="wpvltr-settings-twitter-size">Size</label></th>
		<td>
			<fieldset>
				<?php $checked['size'][get_option('wpvltr-settings-twitter-size')] = " checked='checked' "; ?>
				<label><input type='radio' name='wpvltr-settings-twitter-size' value='medium' <?php echo $checked['size']['medium']; ?> /> <span>medium</span></label><br />
				<label><input type='radio' name='wpvltr-settings-twitter-size' value='large' <?php echo $checked['size']['large']; ?> /> <span>large</span></label><br />
			</fieldset>
		</td>

	</tr>

	<tr valign="top">

		<th scope="row"><label for="wpvltr-settings-twitter-text">Before URL Text</label></th>

		<td><input name="wpvltr-settings-twitter-text" type="text" value="<?php echo get_option('wpvltr-settings-twitter-text'); ?>" class="regular-text" /></td>

	</tr>



</table>




<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"  /></p></form>





	</div>


	<?php

}


