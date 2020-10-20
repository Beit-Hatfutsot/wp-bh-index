<?php
/**
 * Custom Taxonomies functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * bh_idx_register_custom_taxonomies
 *
 * This function registers custom taxonomies
 *
 * @param	N/A
 * @return	N/A
 */
function bh_idx_register_custom_taxonomies() {

	bh_idx_register_hashtag_taxonomy();

}
add_action( 'init', 'bh_idx_register_custom_taxonomies' );

/**
 * bh_idx_get_tax_labels
 *
 * This function generates custom taxonomy labels
 *
 * @param	$name (string)
 * @param	$singular (string)
 * @return	(array)
 */
function bh_idx_get_tax_labels( $name, $singular ) {

	$labels = array();

	if ( $name && $singular ) {

		$labels = array(
			'name'							=> $name,
			'singular_name'					=> $singular,
			'menu_name'						=> $name,
			'all_items'						=> sprintf( __( 'All %s',							'twentytwenty-child' ), $name ),
			'edit_item'						=> sprintf( __( 'Edit %s',							'twentytwenty-child' ), $singular ),
			'view_item'						=> sprintf( __( 'View %s',							'twentytwenty-child' ), $singular ),
			'update_item'					=> sprintf( __( 'Update %s',						'twentytwenty-child' ), $singular ),
			'add_new_item'					=> sprintf( __( 'Add New %s',						'twentytwenty-child' ), $singular ),
			'new_item_name'					=> sprintf( __( 'New %s Name',						'twentytwenty-child' ), $singular ),
			'parent_item'					=> sprintf( __( 'Parent %s',						'twentytwenty-child' ), $singular ),
			'parent_item_colon'				=> sprintf( __( 'Parent %s:',						'twentytwenty-child' ), $singular ),
			'search_items'					=> sprintf( __( 'Search %s',						'twentytwenty-child' ), $name ),
			'popular_items'					=> sprintf( __( 'Popular %s',						'twentytwenty-child' ), $name ),
			'separate_items_with_commas'	=> sprintf( __( 'Separate %s with commas',			'twentytwenty-child' ), $name ),
			'add_or_remove_items'			=> sprintf( __( 'Add or remove %s',					'twentytwenty-child' ), $name ),
			'choose_from_most_used'			=> sprintf( __( 'Choose from the most used %s',		'twentytwenty-child' ), $name ),
			'not_found'						=> sprintf( __( 'No %s Found',						'twentytwenty-child' ), $name ),
			'back_to_items'					=> sprintf( __( '← Back to %s',						'twentytwenty-child' ), $name ),
		);

	}

	// return
	return $labels;

}

/**
 * bh_idx_register_hashtag_taxonomy
 *
 * This function registers the hashtag custom taxonomy
 *
 * @param	N/A
 * @return	N/A
 */
function bh_idx_register_hashtag_taxonomy() {

	/**
	 * Variables
	 */
	$name		= __( 'Hashtags',	'twentytwenty-child' );
	$singular	= __( 'Hashtag',	'twentytwenty-child' );

	$labels = bh_idx_get_tax_labels( $name, $singular );

	$args = array(

		'labels'						=> $labels,
		'public'						=> true,
		'publicly_queryable'			=> true,
		'show_ui'						=> true,
		'show_in_menu'					=> true,
		'show_in_nav_menus'				=> true,
		'show_in_rest'					=> false,
		'rest_base'						=> 'hashtag',
		'show_tagcloud'					=> true,
		'show_in_quick_edit'			=> true,
		'show_admin_column'				=> true,
		'description'					=> '',
		'hierarchical'					=> false,
		'query_var'						=> 'hashtag',
		'rewrite'						=> array( 'slug' => 'hashtag', 'with_front' => false ),

	);

	register_taxonomy( 'hashtag', array( 'floor', 'display_center', 'exhibit' ), $args );

}