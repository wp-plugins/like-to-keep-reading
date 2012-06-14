<?php

function wpvltr_api_loadasync($locale) {

	return "
	<script>

	  // Load the SDK Asynchronously
	  (function(d){
		 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement('script'); js.id = id; js.async = true;
		 js.src = \"//connect.facebook.net/".$locale."/all.js\";
		 ref.parentNode.insertBefore(js, ref);
	   }(document));

	</script>
	";

}






function wpvltr_cookiehash($dlgroup, $href) {

	if ($dlgroup != '') {
		$cookiehash = md5($dlgroup);
	} else {
		if ($href != '') {
			$cookiehash = md5($href);
		} else {
			$cookiehash = 'null';
		}
	}

	return $cookiehash;

}

// ajax

add_action('wp_ajax_wpvltr_setcookie', 'wpvltr_setcookie');
add_action('wp_ajax_nopriv_wpvltr_setcookie', 'wpvltr_setcookie');

function wpvltr_setcookie() {

	$dlgroup = $_REQUEST["dlgroup"];
	$href = $_REQUEST["href"];

	$cookiehash = wpvltr_cookiehash($dlgroup, $href);

	setcookie('wpvltr_cookie_'.$cookiehash, 'downloaded', time()+60*60*24*365, '/');

	die();

}

