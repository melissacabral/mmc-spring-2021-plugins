<?php 
/*
Plugin Name: MMC Admin Tweaks
Description: Customizes the admin panel and login/register forms
Author: Melissa Cabral
Plugin URI: http://wordpress.melissacabral.com
Author URI: http://melissacabral.com
Version: 0.1
License: GPLv3
*/


/**
 * Style the login and register forms
 */
add_action( 'login_enqueue_scripts', 'mmc_tweak_login_css' );
function mmc_tweak_login_css(){
	//url to stylesheet
	$url = plugins_url('css/login.css', __FILE__);
	//enqueue it
	wp_enqueue_style('mmc-login-style', $url);
}

/**
 * Fix the href and text of the WP logo on the login form
 */
add_filter('login_headerurl', 'mmc_login_logo_link');
function mmc_login_logo_link(){
	//any valid url
	return home_url();
}

add_filter('login_headertext', 'mmc_login_logo_text');
function mmc_login_logo_text(){
	//any text here
	return 'Return Home';
}


/**
 * Remove the WordPress logo and support node from the tool bar
 * @see https://developer.wordpress.org/reference/classes/wp_admin_bar/ 
 */
add_action('admin_bar_menu', 'mmc_tweak_toolbar', 999);
function mmc_tweak_toolbar( $wp_admin_bar ){
	$wp_admin_bar->remove_node( 'wp-logo' );

	//add a custom node
	$wp_admin_bar->add_node( array(
			'id' => 'mmc-help',
			'title' => '<span class="ab-icon dashicons dashicons-editor-help"></span> Get Help',
			'href' => 'http://google.com',
	) );
}

//add or remove a page to the admin panel
add_action('admin_menu', 'mmc_help_page');
function mmc_help_page(){
					//  page title 			menu title 		capability 	 menu_slug 			callback 		position
	add_dashboard_page( 'Helpful Resources', 'Resources', 'edit_posts', 'mmc_resources', 'mmc_resources_page', 10 );

	//remove comments from the menum (only if not an administrator)
	if( ! current_user_can('manage_options') ){
		remove_menu_page( 'edit-comments.php' );          //Comments
	}
}

function mmc_resources_page(){
	?>
	<div class="wrap">
		<h1>Helpful Resources</h1>
	</div>
	<?php
}