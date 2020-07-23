<?php
/**
 * Custom Post Types functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * bh_idx_register_custom_post_types
 *
 * This function registers custom post types
 *
 * @param	N/A
 * @return	N/A
 */
function bh_idx_register_custom_post_types() {

	bh_idx_register_floor_post_type();
	bh_idx_register_display_center_post_type();
	bh_idx_register_exhibit_post_type();

}
add_action( 'init', 'bh_idx_register_custom_post_types' );

/**
 * bh_idx_get_cpt_labels
 *
 * This function generates custom post type labels
 *
 * @param	$name (string)
 * @param	$singular (string)
 * @return	(array)
 */
function bh_idx_get_cpt_labels( $name, $singular ) {

	$labels = array();

	if ( $name && $singular ) {

		$labels = array(
			'name'						=> $name,
			'singular_name'				=> $singular,
			'add_new'					=> __( 'Add New',							'twentytwenty-child' ),
			'add_new_item'				=> sprintf( __( 'Add New %s',				'twentytwenty-child' ), $singular ),
			'edit_item'					=> sprintf( __( 'Edit %s',					'twentytwenty-child' ), $singular ),
			'new_item'					=> sprintf( __( 'New %s',					'twentytwenty-child' ), $singular ),
			'view_item'					=> sprintf( __( 'View %s',					'twentytwenty-child' ), $singular ),
			'view_items'				=> sprintf( __( 'View %s',					'twentytwenty-child' ), $name ),
			'search_items'				=> sprintf( __( 'Search %s',				'twentytwenty-child' ), $name ),
			'not_found'					=> sprintf( __( 'No %s Found',				'twentytwenty-child' ), $name ),
			'not_found_in_trash'		=> sprintf( __( 'No %s Found in Trash',		'twentytwenty-child' ), $name ),
			'parent_item_colon'			=> sprintf( __( 'Parent %s:',				'twentytwenty-child' ), $singular ),
			'all_items'					=> sprintf( __( 'All %s',					'twentytwenty-child' ), $name ),
			'archives'					=> sprintf( __( '%s Archives',				'twentytwenty-child' ), $singular ),
			'attributes'				=> sprintf( __( '%s Attributes',			'twentytwenty-child' ), $singular ),
			'insert_into_item'			=> sprintf( __( 'Insert into %s',			'twentytwenty-child' ), $singular ),
			'uploaded_to_this_item'		=> sprintf( __( 'Uploaded to this %s',		'twentytwenty-child' ), $singular ),
			'menu_name'					=> $name,
			'name_admin_bar'			=> $singular,
			'item_published'			=> sprintf( __( '%s published',				'twentytwenty-child' ), $singular ),
			'item_published_privately'	=> sprintf( __( '%s published privately',	'twentytwenty-child' ), $singular ),
			'item_reverted_to_draft'	=> sprintf( __( '%s reverted to draft',		'twentytwenty-child' ), $singular ),
			'item_scheduled'			=> sprintf( __( '%s scheduled',				'twentytwenty-child' ), $singular ),
			'item_updated'				=> sprintf( __( '%s updated',				'twentytwenty-child' ), $singular ),
		);

	}

	// return
	return $labels;

}

/**
 * bh_idx_register_floor_post_type
 *
 * This function registers the floor custom post type
 *
 * @param	N/A
 * @return	N/A
 */
function bh_idx_register_floor_post_type() {

	/**
	 * Variables
	 */
	$name		= __( 'Floors',	'twentytwenty-child' );
	$singular	= __( 'Floor',	'twentytwenty-child' );

	$labels = bh_idx_get_cpt_labels( $name, $singular );

	$args = array(
		'labels'					=> $labels,
		'public'					=> true,
		'exclude_from_search'		=> false,
		'publicly_queryable'		=> true,
		'show_ui'					=> true,
		'show_in_nav_menus'			=> true,
		'show_in_menu'				=> true,
		'show_in_admin_bar'			=> true,
		'menu_position'				=> 25.1,
		'menu_icon'					=> 'dashicons-building',
		'capability_type'			=> 'post',
		'hierarchical'				=> true,
		'supports'					=> array( 'title' ),
		'taxonomies'				=> array(),
		'has_archive'				=> false,
		'rewrite'					=> array( 'slug' => 'floor', 'with_front' => false ),
		'query_var'					=> true,
		'can_export'				=> true,
		'delete_with_user'			=> false,
		'show_in_rest'				=> true,
		'rest_base'					=> 'floor',
	);

	register_post_type( 'floor', $args );

}

/**
 * bh_idx_register_display_center_post_type
 *
 * This function registers the display_center custom post type
 *
 * @param	N/A
 * @return	N/A
 */
function bh_idx_register_display_center_post_type() {

	/**
	 * Variables
	 */
	$name		= __( 'Display Centers',	'twentytwenty-child' );
	$singular	= __( 'Display Center',		'twentytwenty-child' );

	$labels = bh_idx_get_cpt_labels( $name, $singular );

	$args = array(
		'labels'					=> $labels,
		'public'					=> true,
		'exclude_from_search'		=> false,
		'publicly_queryable'		=> true,
		'show_ui'					=> true,
		'show_in_nav_menus'			=> true,
		'show_in_menu'				=> true,
		'show_in_admin_bar'			=> true,
		'menu_position'				=> 25.2,
		'menu_icon'					=> 'dashicons-store',
		'capability_type'			=> 'post',
		'hierarchical'				=> true,
		'supports'					=> array( 'title', 'thumbnail' ),
		'taxonomies'				=> array(),
		'has_archive'				=> false,
		'rewrite'					=> array( 'slug' => 'display_center', 'with_front' => false ),
		'query_var'					=> true,
		'can_export'				=> true,
		'delete_with_user'			=> false,
		'show_in_rest'				=> true,
		'rest_base'					=> 'display_center',
	);

	register_post_type( 'display_center', $args );

}

/**
 * bh_idx_register_exhibit_post_type
 *
 * This function registers the exhibit custom post type
 *
 * @param	N/A
 * @return	N/A
 */
function bh_idx_register_exhibit_post_type() {

	/**
	 * Variables
	 */
	$name		= __( 'Exhibits',	'twentytwenty-child' );
	$singular	= __( 'Exhibit',	'twentytwenty-child' );

	$labels = bh_idx_get_cpt_labels( $name, $singular );

	$args = array(
		'labels'					=> $labels,
		'public'					=> true,
		'exclude_from_search'		=> false,
		'publicly_queryable'		=> true,
		'show_ui'					=> true,
		'show_in_nav_menus'			=> true,
		'show_in_menu'				=> true,
		'show_in_admin_bar'			=> true,
		'menu_position'				=> 25.3,
		'menu_icon'					=> 'dashicons-format-image',
		'capability_type'			=> 'post',
		'hierarchical'				=> true,
		'supports'					=> array( 'title', 'thumbnail' ),
		'taxonomies'				=> array(),
		'has_archive'				=> false,
		'rewrite'					=> array( 'slug' => 'exhibit', 'with_front' => false ),
		'query_var'					=> true,
		'can_export'				=> true,
		'delete_with_user'			=> false,
		'show_in_rest'				=> true,
		'rest_base'					=> 'exhibit',
	);

	register_post_type( 'exhibit', $args );

}