<?php

/*
Plugin Name: Like To Keep Reading
Plugin URI: http://www.soflyy.com/
Description: Get more Facebook Likes, Google +1s, and Tweets by forcing users to perform a social action before accessing the rest of your content.
Version: 1.0
Author: Soflyy
Author URI: http://www.soflyy.com
*/


define('WPVLTR_PLUGIN_URL', plugins_url('', __FILE__));
define('WPVLTR_PLUGIN_DIR', dirname(__FILE__));

include "api.php";

include "liketokeepreading.php";
include "liketokeepreadingsettings.php";

include "settings.php";


add_action("admin_menu", "wpvltr_add_menus");
add_action("admin_head", "wpvltr_admin_head");
add_action("admin_init", "wpvltr_admin_init");


register_activation_hook(__FILE__, 'wpvltr_activate');


function wpvltr_add_menus() {

	add_menu_page('LT Keep Reading', 'LT Keep Reading', 8, __FILE__, 'wpvltr_ltr_settings_page', WPVLTR_PLUGIN_URL."/images/icon.png");

	add_submenu_page(__FILE__, 'Box Settings', 'Box Settings', 8, __FILE__, 'wpvltr_ltr_settings_page');

	add_submenu_page(__FILE__, 'Button Settings', 'Button Settings', 8, 'wpvltr_settings_page', 'wpvltr_settings_page');

}



function wpvltr_admin_head() {

}


function wpvltr_admin_init() {

}

function wpvltr_enqueue_scripts() {

	wp_register_script('gplusone', 'https://apis.google.com/js/plusone.js');
	wp_register_script('twitterwidgets', 'https://platform.twitter.com/widgets.js');

	wp_enqueue_script('jquery');

	wp_enqueue_script('gplusone');
	wp_enqueue_script('twitterwidgets');



}
add_action('wp_enqueue_scripts', 'wpvltr_enqueue_scripts');


function wpvltr_activate() {

	global $wpdb;


	update_option('wpvltr-settings-likebutton-colorscheme', 'light');
	update_option('wpvltr-settings-likebutton-action', 'like');
	update_option('wpvltr-settings-likebutton-layout', 'standard');
	update_option('wpvltr-settings-likebutton-send', 'false');
	update_option('wpvltr-settings-likebutton-locale', 'en_US');
	update_option('wpvltr-settings-likebutton-show', 'Yes');

	update_option('wpvltr-settings-plusone-annotation', 'inline');
	update_option('wpvltr-settings-plusone-size', 'standard');
	update_option('wpvltr-settings-plusone-show', 'Yes');


	update_option('wpvltr-settings-twitter-count', 'horizontal');
	update_option('wpvltr-settings-twitter-size', 'medium');
	update_option('wpvltr-settings-twitter-show', 'Yes');
	update_option('wpvltr-settings-twitter-text', 'Look at this: ');



	/*	data-width="500" data-show-faces="true" data-font="tahoma" locale="en_US" */

	update_option('wpvltr-settings-liketokeepreading-message', "Please Like us on Facebook to continue reading.");
	update_option('wpvltr-settings-liketokeepreading-thanksmessage', "Thanks for the like!");
	update_option('wpvltr-settings-liketokeepreading-bordercolor', "#B9D2EE");
	update_option('wpvltr-settings-liketokeepreading-bgcolor', "#E1EBFF");
	update_option('wpvltr-settings-liketokeepreading-borderwidth', '1px');
	update_option('wpvltr-settings-liketokeepreading-borderstyle', 'solid');
	update_option('wpvltr-settings-liketokeepreading-attdlcss', '');
	update_option('wpvltr-settings-liketokeepreading-hide', '');
	update_option('wpvltr-settings-liketokeepreading-href', site_url());





}


add_action('wp_footer', 'wpvltr_fbml_parse');
function wpvltr_fbml_parse() {
	echo '<script type="text/javascript">FB.XFBML.parse();</script>';
}

















