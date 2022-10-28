<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


function acf_get_pretty_field_group_keys() {

	/**
	 * Variables
	 */
	$field_groups	= acf_get_field_groups();
	$arr			= array();

	if ( ! $field_groups )
		return $arr;

	foreach ( $field_groups as $g ) {

		$fields = acf_get_fields( $g[ 'key' ] );

		if ( $fields ) {

			$arr[ $g[ 'title' ] ] = array();

			foreach ( $fields as $f ) {
				$arr[ $g[ 'title' ] ][ $f[ 'key' ] ] = $f[ 'label' ];
			}

		}

	}

	// return
	return $arr;

}


function acf_get_posts_foreign_key_values( $field ) {

	/**
	 * Variables
	 */
	$post_type		= $field[ 'post_type' ];
	$foreign_key	= $field[ 'foreign_key' ];
	$arr			= array();

	if ( ! $post_type || ! $foreign_key )
		return $arr;

	$field_obj = get_field_object( $foreign_key );

	if ( ! $field_obj || ! $field_obj[ 'name' ] )
		return $arr;

	$posts = new WP_Query(array(
		'post_type'			=> $post_type,
		'meta_key'			=> $field_obj[ 'name' ],
		'posts_per_page'	=> -1,
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC',
	));

	if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post();

		$field_obj = get_field_object( $foreign_key, $posts->post->ID );

		if ( $field_obj && ! is_null( $field_obj[ 'value' ] ) ) {
			$arr[ $field_obj[ 'value' ] ] = $field_obj[ 'value' ];
		}

	endwhile; endif;

	wp_reset_postdata();

	// return
	return $arr;

}