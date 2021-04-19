<?php
/*
Plugin Name: MMC Portfolio CPT
Description: Adds support for our portfolio custom post type
Author: Melissa Cabral
Version: 0.1
License: GPLv3
 */

/**
 * Register the post type
 */
add_action('init', 'mmc_cpt_register');
function mmc_cpt_register(){
	
	register_post_type( 'work', array(
		'public' 		=> true,
		'menu_icon'		=> 'dashicons-portfolio',
		'menu_position' => 5,
		'show_in_rest'	=> true, //use the block editor (false for classic editor)
		'has_archive'	=> true, //make a 'page' to hold all portfolio pieces
		'rewrite'		=> array( 'slug' => 'portfolio' ), //url base
		'supports'		=> array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'),		
		'labels'		=> array(
							'singular_name' => 'Portfolio Piece',
							'name' 			=> 'Portfolio Pieces',
							'menu_name'		=> 'Portfolio',
							'add_new_item'	=> 'Add New Portfolio Piece', 
							'not_found'		=> 'No pieces found',
						),
	) );

	//add portfolio categories
	register_taxonomy('work_category', 'work', array(
		'show_in_rest'		=> true, //show up in the editor window
		'hierarchical' 		=> true, //act like categories, not tags
		'show_admin_column' => true,
		'rewrite'			=> array( 'slug' => 'portfolio-category' ),
		'labels' 			=> array(
								'singular_name' => 'Portfolio Category',
								'name'			=> 'Portfolio Categories',
								'menu_name'		=> 'Category',
								'add_new_item' 	=> 'Add New Category',
								'not_found'		=> 'No categories found',
							),
	));

	//add a "skills" taxonomy to the portfolio

} //end custom function

/**
 * Flush the permalinks when this plugin activates
 */
function mmc_cpt_flush(){
	//register all post types and taxos first
	mmc_cpt_register();
	//fix the permalinks
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'mmc_cpt_flush' );