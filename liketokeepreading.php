<?php

add_action('wp_enqueue_scripts', 'wpvltr_like_to_keep_reading_styles');

function wpvltr_like_to_keep_reading_styles() {

	wp_enqueue_style('liketokeepreading', WPVLTR_PLUGIN_URL . '/css/liketokeepreading.css');

}



add_shortcode('like_to_read', 'wpvltr_like_to_keep_reading_handler');


function wpvltr_like_to_keep_reading_handler($atts, $content) {


	$showfacebook = get_option('wpvltr-settings-likebutton-show');
	$showgoogle = get_option('wpvltr-settings-plusone-show');
	$showtwitter = get_option('wpvltr-settings-twitter-show');


	extract(shortcode_atts(array(
		'message' => get_option('wpvltr-settings-liketokeepreading-message'),
		'thanksmessage' => get_option('wpvltr-settings-liketokeepreading-thanksmessage'),
		'bordercolor' => get_option('wpvltr-settings-liketokeepreading-bordercolor'),
		'bgcolor' => get_option('wpvltr-settings-liketokeepreading-bgcolor'),
		'borderwidth' => get_option('wpvltr-settings-liketokeepreading-borderwidth'),
		'borderstyle' => get_option('wpvltr-settings-liketokeepreading-borderstyle'),
		'attdlcss'=> get_option('wpvltr-settings-liketokeepreading-attdlcss'),
		'hide' => get_option('wpvltr-settings-liketokeepreading-hide'),
		'href' => get_option('wpvltr-settings-liketokeepreading-href')
	), $atts));

	if ($href == '') {
		$href = site_url();
	}


	$colorscheme = get_option('wpvltr-settings-likebutton-colorscheme');
	$action = get_option('wpvltr-settings-likebutton-action');
	$layout = get_option('wpvltr-settings-likebutton-layout');
	$send = get_option('wpvltr-settings-likebutton-send');
	$locale = get_option('wpvltr-settings-likebutton-locale');

	if ($locale == '') {
		$locale = 'en_US';
	}


	$size = get_option('wpvltr-settings-plusone-size');
	$annotation = get_option('wpvltr-settings-plusone-annotation');


	$tcount = get_option('wpvltr-settings-twitter-count');
	$tsize = get_option('wpvltr-settings-twitter-size');
	$ttext = get_option('wpvltr-settings-twitter-text');




	$dlgroup = 'wpvltr_like_to_keep_reading';


	// using the like to download cookies instead
	$cookiehash = wpvltr_cookiehash($dlgroup, $href);
	$cookiename = 'wpvltr_cookie_'.$cookiehash;

	$cookie = $_COOKIE[$cookiename];

	if ($cookie == 'downloaded') {

		?>

		<script>
			jQuery(document).ready(function() {
				jQuery('.wpvltr_like_to_keep_reading_message .wpvmtext').html("<?php echo htmlspecialchars($thanksmessage); ?>");
				jQuery('.wpvltr_like_to_keep_reading').show();

				<?php

				if ($hide == "Yes") {
					?>
					jQuery('.wpvltr_like_to_keep_reading_message_container').hide('slow');
					<?php
				}

				?>


			});
		</script>

		<?php

	}

	// -------------


	?>



	<div id="fb-root"></div>


	<?php
	if ($GLOBALS['wpvltr_alreadyfbjs'] != true) {
		?>



		<script>

		function wpvltr_callback(href, widget) {

				jQuery('.wpvltr_like_to_keep_reading_message .wpvmtext').html("<?php echo htmlspecialchars($thanksmessage); ?>");

				jQuery('.wpvltr_like_to_keep_reading').show('slow');

				<?php

				if ($hide == "Yes") {
					?>
					jQuery('.wpvltr_like_to_keep_reading_message_container').hide('slow');
					<?php
				}

				?>

				// make ajax request to set the cookie

				var data = {
					dlgroup: '<?php echo $dlgroup; ?>',
					href: '<?php echo $href; ?>',
					action: 'wpvltr_setcookie'
				};

				jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
					// alert(response);
				});

		}

		function wpvltr_gplus(plusone) {
				if (plusone.state == "on") {
					wpvltr_callback(null, null);
				}
		}

		  window.fbAsyncInit = function() {
			FB.init({
			  status     : true, // check login status
			  cookie     : true, // enable cookies to allow the server to access the session
			  xfbml      : true  // parse XFBML
			});

			FB.Event.subscribe('edge.create', function(href, widget) {

				wpvltr_callback(href, widget);

			 });


				twttr.ready(function (twttr) {
					twttr.events.bind("tweet", function(event) {
						wpvltr_callback(null, null);
					});
				});



		  };

		</script>

		<?php echo wpvltr_api_loadasync($locale); ?>


		<?php
		$GLOBALS['wpvltr_alreadyfbjs'] = true;
	}
	?>

	<?php

	if ($href != '') {
		$att_href = 'href="'.$href.'"';
	}

	if ($href != '') {
		$att_href_t = 'data-url="'.$href.'"';
	}


	// data-width="500" data-show-faces="true" data-font="tahoma"></div>


	$css = "border-style: ".$borderstyle."; border-color: ".$bordercolor."; border-width: ".$borderwidth."; background-color: ".$bgcolor."; ".$attdlcss;

	$retcode = '';

	$retcode .= '<div class="wpvltr_like_to_keep_reading_message_container"><div class="wpvltr_like_to_keep_reading_message" style="'.$css.'">';

	$retcode .= '<div class="wpvmtext" style="margin-bottom: 8px;">'.$message.'</div>';

	if ($showfacebook == "Yes") {
		$retcode .= '<fb:like '.$att_href.' send="'.$send.'" layout="'.$layout.'" action="'.$action.'" colorscheme="'.$colorscheme.'" ></fb:like>';
	}

	if ($showgoogle == "Yes") {
		$retcode .= '<div><g:plusone size="'.$size.'" annotation="'.$annotation.'" callback="wpvltr_gplus" '.$att_href.'></g:plusone></div>';
	}

	if ($showtwitter == "Yes") {
		$retcode .= '<div><a href="http://twitter.com/share" class="twitter-share-button" '.$att_href_t.' data-text="'.$ttext.'" data-size="'.$tsize.'" data-count="'.$tcount.'" data-lang="en">Tweet</a></div>';
	}



	$retcode .= '</div>';

	$retcode .= '

	<br /></div><div style="display: none;" class="wpvltr_like_to_keep_reading">

	';

	$retcode .= $content;

	$retcode .= '</div>';

	return $retcode;



}




// TinyMCE button

add_action('init', 'wpvltr_ltr_tinymce_init');

function wpvltr_ltr_tinymce_init() {

	if (current_user_can('edit_posts') or current_user_can('edit_pages')) { // only bother if user can edit something
		if (get_user_option('rich_editing') == 'true') { // user enabled rich editing option
			add_filter("mce_external_plugins", "wpvltr_ltr_tinymce_external_plugins_filter");
			add_filter('mce_buttons', 'wpvltr_ltr_tinymce_buttons_filter');
		}
	}

}

function wpvltr_ltr_tinymce_buttons_filter($buttons) {
	array_push($buttons, "separator", "wpvltr_liketoread");
	return $buttons;
}

function wpvltr_ltr_tinymce_external_plugins_filter($plugins_array) {
	$plugins_array['wpvltr_liketoread'] = WPVLTR_PLUGIN_URL . '/tiny-liketoread.js';
	return $plugins_array;
}


