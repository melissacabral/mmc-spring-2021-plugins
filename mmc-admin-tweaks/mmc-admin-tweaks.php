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

/**
 * add and remove pages from  the admin panel
 */
add_action('admin_menu', 'mmc_admin_menu');
function mmc_admin_menu(){
	//add a page under "dashboard"
					//  page title 			menu title 		capability 	 menu_slug 			callback 		position
	add_dashboard_page( 'Helpful Resources', 'Resources', 'edit_posts', 'mmc_resources', 'mmc_resources_page', 10 );

	//remove comments from the menu (only if not an administrator)
	if( ! current_user_can('manage_options') ){
		remove_menu_page( 'edit-comments.php' );   
	}
}

function mmc_resources_page(){
	?>
	<div class="wrap">
		<h1>Helpful Resources</h1>
	</div>
	<?php
}


/**
 * Remove Dashboard widgets
 */
add_action( 'admin_menu', 'mmc_dashboard' );
function mmc_dashboard(){
	//detect what type of user (manage options checks for administrator)
	if( current_user_can('manage_options') ){
		//remove quick press for admins
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	}else{
		//remove news and events for every other type of user
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	}	

	
}

/**
 * Add dashboard widgets
 */
add_action( 'wp_dashboard_setup', 'mmc_dash_widget_add' );
function mmc_dash_widget_add(){
	wp_add_dashboard_widget( 'mmc_support', 'Helpful Videos', 'mmc_custom_dash_widget' );
}


//custom callback for the content of the widget
function mmc_custom_dash_widget(){
	?>

	<iframe width="300" height="169" src="https://www.youtube.com/embed/x7R2HcTAyjI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

	<?php
}

