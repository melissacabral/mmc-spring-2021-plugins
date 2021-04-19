<?php 
/*
Plugin Name: MMC Aloha Bar
Description: Adds a call-to-action bar at the top of every page
Version: 0.1
Author: Melissa Cabral
License: GPLv3
*/

/**
 * HTML output of the bar
 */
add_action('wp_footer', 'mmc_aloha_html');
function mmc_aloha_html(){
	?>
	<!-- Aloha Bar by Melissa Cabral -->
	<div id="mmc-howdy-bar">
		<span class="howdy-message">This is an important message on the Aloha Bar!</span>
		<a class="howdy-button" src="#">Call to Action!</a>
	</div>
	<!-- end Aloha Bar by Melissa Cabral -->
	<?php
}

/**
 * Attach any CSS or JS needed
 */
add_action('wp_enqueue_scripts', 'mmc_aloha_scripts');
function mmc_aloha_scripts(){
	//get the absolute URL to the css file
	$css_url = plugins_url('css/mmc-aloha-style.css', __FILE__);
	//put it on the page
	wp_enqueue_style( 'mmc-aloha-style', $css_url, array(), '0.1' );

	//attach jquery (built into WordPress)
	wp_enqueue_script( 'jquery' );

	//get the url of our custom script
	$js_url = plugins_url('js/mmc-aloha-script.js', __FILE__);
	//					handle, 			url, 	dependencies, 	version, in_footer?
	wp_enqueue_script( 'mmc_aloha-script', $js_url, array('jquery'), '0.1', true );

}
//no close php