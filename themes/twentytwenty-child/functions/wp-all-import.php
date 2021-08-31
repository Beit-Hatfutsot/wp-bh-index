<?php
/**
 * WP All Import functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.2.2
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * bh_idx_set_import_lang
 *
 * This sets polylang language indicator for imported post and sets post translations
 *
 * This action fires when WP All Import saves a post of any type.
 * The post ID, the record's data from your file, and a boolean value showing if the post is being updated are provided
 *
 * @param	$post_id (int) The ID of the item (post/user/taxonomy) saved or updated
 * @param	$xml_node (object) The libxml resource of the current XML element
 * @param	$is_update (bool) returns 0 for new item 1 for updated item
 * @return	N/A
 */
function bh_idx_set_import_lang( $post_id, $xml_node, $is_update ) {

	if ( ! function_exists( 'pll_the_languages' ) )
		return;

	// set polylang language indicator for imported/saved post
	pll_set_post_language( $post_id, (string)$xml_node->language );

	// set post translation
	// get all correlated posts by a shared key
	$post_type = get_post_type( $post_id );

	if ( 'floor' == $post_type ) {

		$key	= 'acf-floor_floor_number';
		$value	= (string)$xml_node->floor;

	}
	elseif ( 'display_center' == $post_type ) {

		$key = 'acf-display-center_curator_number';
		$value	= (string)$xml_node->curatornumber;

	}
	elseif ( 'exhibit' == $post_type ) {

		$key = 'acf-exhibit_item_id';
		$value	= (string)$xml_node->itemid;

	}
	else {
		return;
	}

	$posts = bh_idx_get_posts_by_key( $post_type, $key, $value );

	if ( $posts && count( $posts ) > 1 ) {
		//set the translations
		pll_save_post_translations( $posts );
	}

}
add_action( 'pmxi_saved_post', 'bh_idx_set_import_lang', 10, 3 );

/**
 * bh_idx_get_posts_by_key
 *
 * This function returns array of language codes and post ids for posts sharing a same meta_key and meta_value
 *
 * @param	$post_type (string) Post type
 * @param	$key (string) Meta key
 * @param	$value (mix) Meta value
 * @return	(array)
 */
function bh_idx_get_posts_by_key( $post_type, $key, $value ) {

	if ( ! $post_type || ! $key || ! $value )
		return;

	/**
	 * Variables
	 */
	$posts = array();

	$args = array(
		'post_type'		=> $post_type,
		'meta_key'		=> $key,
		'meta_value'	=> $value,
		'lang'			=> '',
	);
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

		$language = pll_get_post_language( $query->post->ID );
		$posts[ $language ] = $query->post->ID;

	endwhile; endif;

	wp_reset_postdata();

	// return
	return $posts;

}

/**
 * bh_idx_wp_all_import_set_post_terms
 *
 * This function assigns language to created taxonomy terms
 *
 * @param	$term_taxonomy_ids (array) Array of taxonomy IDs
 * @param	$tx_name (string) The name of the taxonomy
 * @param	$pid (int) The post ID
 * @param	$import_id (int) The import ID
 * @return	(array)
 */
function bh_idx_wp_all_import_set_post_terms( $term_taxonomy_ids, $tx_name, $pid, $import_id ) {

	if ( ! function_exists( 'pll_the_languages' ) )
		return;

	/**
	 * Variables
	 */
	$language = pll_get_post_language( $pid );

	foreach ( $term_taxonomy_ids as $term_id ) {
		pll_set_term_language( $term_id, $language );
	}

	// return
	return $term_taxonomy_ids;

}
add_filter( 'wp_all_import_set_post_terms', 'bh_idx_wp_all_import_set_post_terms', 10, 4 );