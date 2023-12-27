<?php
/**
 * Headless CMS uploader
 * @use Directus API
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// load the Directus package
require_once( realpath(dirname(__FILE__) . '/..' ) . '/lib/directus-api/autoload.php' );


/**
 * anu_index_item_insert_post
 *
 * This function uploads an index item to Directus
 * Hooked by pmxi_saved_post (will be hooked only for WP All Import import action)
 *
 * @param	$post_id (int)
 * @param	$xml_node (SimpleXMLElement)
 * @return	N/A
 */
function anu_index_item_insert_post( $post_id, $xml_node ) {

	// only set for post_type in floor, display_center, exhibit
	if ( ! in_array( get_post_type( $post_id ), array( 'floor', 'display_center', 'exhibit' ) ) || 'publish' !== get_post_status( $post_id ) || ! function_exists( 'get_field' ) )
		return;

	// insert index item to Directus
	anu_index_item_insert_to_directus( $post_id, $xml_node );

}
add_action( 'pmxi_saved_post', 'anu_index_item_insert_post', 10, 3 );


/**
 * anu_index_item_delete_post
 *
 * This function deletes an index item from Directus
 * Hooked by before_delete_post
 *
 * @param	$post_id (int)
 * @param	$post (obj)
 * @return	N/A
 */
function anu_index_item_delete_post( $post_id, $post ) {

	// only set for post_type in floor, display_center, exhibit
	if ( ! in_array( $post->post_type, array( 'floor', 'display_center', 'exhibit' ) ) || ! function_exists( 'get_field' ) )
		return;

	// delete index item from Directus
	anu_index_item_delete_from_directus( $post_id );

}
add_action( 'before_delete_post', 'anu_index_item_delete_post', 10, 2 );


/**
 * anu_index_item_delete_from_directus
 *
 * This function deletes an index item from Directus
 *
 * @param	$post_id (int)
 * @return	N/A
 */
function anu_index_item_delete_from_directus( $post_id ) {

	// get Directus api
	$api = anu_index_get_directus_api();

	if ( ! $api )
		return;

	// get collection
	$collection = anu_index_get_item_collection( $post_id );

	if ( ! $collection )
		return;

	try {

		// unlimit items return
		$api->_limit(-1);

		// get all items
		$items = $api->items( $collection )->get();

		if ( $api->isError( $items ) )
			return;

		if ( $items->data ) {
			foreach ( $items->data as $item ) {

				if ( (int)$item->wp_id == $post_id ) {

					// item is found - delete it
					$api->item( $collection, $item->id )->delete();

				}

			}
		}

	}

	catch ( Exception $e ) {
		return;
	}

}


/**
 * anu_index_item_insert_to_directus
 *
 * This function inserts an index item to Directus
 *
 * @param	$post_id (int)
 * @param	$xml_node (SimpleXMLElement)
 * @return	N/A
 */
function anu_index_item_insert_to_directus( $post_id, $xml_node ) {

	// get Directus api
	$api = anu_index_get_directus_api();

	if ( ! $api )
		return;

	// get collection
	$collection = anu_index_get_item_collection( $post_id );

	if ( ! $collection )
		return;

	try {

		// get post data
		switch ( $collection ) {
			case 'index_floors':
				$data = anu_index_get_floor_data( $post_id, $xml_node );
				break;
			
			case 'index_display_centers':
				$data = anu_index_get_display_center_data( $post_id, $xml_node );
				break;
			
			case 'index_exhibits':
				$data = anu_index_get_exhibit_data( $post_id, $xml_node );
				break;
		}

		if ( ! $data )
			return;

		// get item if exists
		$item = anu_index_get_item( $post_id );

		if ( $item ) {
			// item_exists - update item
			$api->item( $collection, $item->id )->update( $data );
		} else {
			// create item
			$item = $api->items( $collection )->create( $data );
		}

		// update item translations
		if ( $data[ 'translations_id' ] ) {
			anu_index_update_translations( $post_id, $data[ 'translations_id' ] );
		}

	}

	catch ( Exception $e ) {
		return;
	}

}


/**
 * anu_index_get_floor_data
 *
 * This function gets floor post data
 *
 * @param	$post_id (int)
 * @param	$xml_node (SimpleXMLElement)
 * @return	(array)
 */
function anu_index_get_floor_data( $post_id, $xml_node ) {

	$data = [];

	// get post language
	$lang = (string)$xml_node->language;

	// get post translations ID
	$translations_ids = get_the_terms( $post_id, 'post_translations' );
	$translations_id = ( ! is_wp_error( $translations_ids ) && $translations_ids !== false && ! empty( $translations_ids ) ) ? $translations_ids[0]->term_id : 0;

	// get post fields
	$data = array(
		'wp_id'					=> $post_id,
		'translations_id'		=> $translations_id,
		'floor'					=> (int)$xml_node->floor,
		'title'					=> (string)$xml_node->title,
		'panoramic_picture'		=> anu_index_get_post_featured_image( $post_id ),
		'text'					=> (string)$xml_node->text,
		'text_picture'			=> anu_index_get_image_url( get_field( 'acf-floor_text_picture', $post_id ) ),
		'central_questions'		=> (string)$xml_node->centralquestions,
		'themes'				=> html_entity_decode( strip_tags( get_the_term_list( $post_id, 'hashtag', '', ', ') ) ),
		'language'				=> $lang,
	);

	// return
	return $data;

}


/**
 * anu_index_get_display_center_data
 *
 * This function gets display center post data
 *
 * @param	$post_id (int)
 * @param	$xml_node (SimpleXMLElement)
 * @return	(array)
 */
function anu_index_get_display_center_data( $post_id, $xml_node ) {

	$data = [];

	// get post language
	$lang = (string)$xml_node->language;

	// get post translations ID
	$translations_ids = get_the_terms( $post_id, 'post_translations' );
	$translations_id = ( ! is_wp_error( $translations_ids ) && $translations_ids !== false && ! empty( $translations_ids ) ) ? $translations_ids[0]->term_id : 0;

	// get post fields
	$data = array(
		'wp_id'					=> $post_id,
		'translations_id'		=> $translations_id,
		'floor'					=> (int)$xml_node->floor,
		'curator_number'		=> (string)$xml_node->curatornumber,
		'title'					=> (string)$xml_node->title,
		'featured_image'		=> anu_index_get_post_featured_image( $post_id ),
		'one_line_description'	=> (string)$xml_node->onelinedescription,
		'master_label'			=> (string)$xml_node->masterlabel,
		'master_label_image'	=> anu_index_get_image_url( get_field( 'acf-display-center_master_label_image', $post_id ) ),
		'hashtags'				=> html_entity_decode( strip_tags( get_the_term_list( $post_id, 'hashtag', '', ', ') ) ),
		'language'				=> $lang,
	);

	// return
	return $data;

}


/**
 * anu_index_get_exhibit_data
 *
 * This function gets exhibit post data
 *
 * @param	$post_id (int)
 * @param	$xml_node (SimpleXMLElement)
 * @return	(array)
 */
function anu_index_get_exhibit_data( $post_id, $xml_node ) {

	$data = [];

	// get post language
	$lang = (string)$xml_node->language;

	// get post translations ID
	$translations_ids = get_the_terms( $post_id, 'post_translations' );
	$translations_id = ( ! is_wp_error( $translations_ids ) && $translations_ids !== false && ! empty( $translations_ids ) ) ? $translations_ids[0]->term_id : 0;

	// get post fields
	$data = array(
		'wp_id'						=> $post_id,
		'translations_id'			=> $translations_id,
		'floor'						=> (int)$xml_node->floor,
		'display_center'			=> (string)$xml_node->displaycenter,
		'case_number'				=> (string)$xml_node->casenumber,
		'item_id'					=> (string)$xml_node->itemid,
		'title'						=> (string)$xml_node->title,
		'featured_image'			=> anu_index_get_post_featured_image( $post_id ),
		'display_image'				=> anu_index_get_image_url( get_field( 'acf-exhibit_display_image', $post_id ) ),
		'3d'						=> (string)$xml_node->el_3d,
		'embedded_video'			=> (string)$xml_node->embeddedvideo,
		'label'						=> (string)$xml_node->label,
		'extended_label'			=> (string)$xml_node->extendedlabel,
		'artist_name'				=> (string)$xml_node->artistname,
		'text_panel'				=> (string)$xml_node->textpanel,
		'text_panel_image'			=> anu_index_get_image_url( get_field( 'acf-exhibit_text_panel_image', $post_id ) ),
		'must_know'					=> (string)$xml_node->mustknow,
		'good_for_guiding'			=> (string)$xml_node->goodforguiding,
		'more_sources'				=> (string)$xml_node->moresources,
		'hashtags'					=> html_entity_decode( strip_tags( get_the_term_list( $post_id, 'hashtag', '', ', ') ) ),
		'makat'						=> (string)$xml_node->makat,
		'height'					=> (string)$xml_node->height,
		'width'						=> (string)$xml_node->width,
		'depth'						=> (string)$xml_node->depth,
		'weight'					=> (string)$xml_node->weight,
		'status'					=> (string)$xml_node->status,
		'ownership'					=> (string)$xml_node->ownership,
		'loan_end_date'				=> (string)$xml_node->loanenddate,
		'date_out_of_exhibition'	=> (string)$xml_node->dateoutofexhibition,
		'conservation'				=> (string)$xml_node->conservation,
		'rights'					=> (string)$xml_node->rights,
		'app_number'				=> (string)$xml_node->appnumber,
		'app_tours'					=> (string)$xml_node->apptours,
		'audioguide'				=> (string)$xml_node->audioguide,
		'language'					=> $lang,
	);

	// return
	return $data;

}


/**
 * anu_index_get_directus_api
 *
 * This function returns Directus api
 *
 * @return	$api (obj) or false
 */
function anu_index_get_directus_api() {

	try {

		// connect to Directus
		$api = new C14r\Directus\API( DIRECTUS_BASE_URL, PROJECT_NAME, 'cookie' );

		// authenticate
		$token = $api->authenticate( DIRECTUS_USER_EMAIL, DIRECTUS_USER_PASSWORD );

		if ( ! $token )
			return false;

		// return
		return $api;

	}

	catch ( Exception $e ) {
		return false;
	}

}


/**
 * anu_index_get_item
 *
 * This function returns item object if exists in Directus
 *
 * @param	$post_id (int)
 * @return	$item (obj) or false 
 */
function anu_index_get_item( $post_id ) {

	if ( ! $post_id )
		return false;

	// get Directus api
	$api = anu_index_get_directus_api();

	if ( ! $api )
		return false;

	// get collection
	$collection = anu_index_get_item_collection( $post_id );

	if ( ! $collection )
		return false;

	try {

		// unlimit items return
		$api->_limit(-1);

		// get all items
		$items = $api->items( $collection )->get();

		if ( $api->isError( $items ) )
			return false;

		if ( $items->data ) {
			foreach ( $items->data as $item ) {

				if ( (int)$item->wp_id == $post_id ) {

					// item is found
					return $item;

				}

			}
		}

		// item not found
		return false;

	}

	catch ( Exception $e ) {
		return;
	}

}


/**
 * anu_index_update_translations
 *
 * This function updates item translations in Directus
 *
 * @param	$post_id (int)
 * @param	$translations_id (int)
 * @return	N/A
 */
function anu_index_update_translations( $post_id, $translations_id ) {

	// get Directus api
	$api = anu_index_get_directus_api();

	if ( ! $api )
		return;

	// get collection
	$collection = anu_index_get_item_collection( $post_id );

	if ( ! $collection )
		return;

	try {

		// get post translations
		$translations = ( function_exists( 'pll_get_post_translations' ) ) ? pll_get_post_translations( $post_id ) : [];

		if ( ! $translations )
			return;

		foreach ( $translations as $lang => $p_id ) {
			if ( $p_id !== $post_id ) {

				// get item if exists
				$item = anu_index_get_item( $p_id );

				if ( $item ) {
					// update item
					$api->item( $collection, $item->id )->update( [ 'translations_id' => $translations_id ] );
				}

			}
		}

	}

	catch ( Exception $e ) {
		return;
	}

}


/**
 * anu_index_get_item_collection
 *
 * This function returns Directus collection
 *
 * @param	$post_id (int)
 * @return	$collection (string) or false
 */
function anu_index_get_item_collection( $post_id ) {

	// get post type
	switch ( get_post_type( $post_id ) ) {
		case 'floor':
			$collection = 'index_floors';
			break;

		case 'display_center':
			$collection = 'index_display_centers';
			break;

		case 'exhibit':
			$collection = 'index_exhibits';
			break;

		default:
			$collection = false;
	}

	// return
	return $collection;

}


/**
 * anu_index_get_post_featured_image
 *
 * This function returns post featured image url
 *
 * @param	$post_id (int)
 * @return	$thumbnail (string)
 */
function anu_index_get_post_featured_image( $post_id ) {

	$thumbnail = '';

	if ( has_post_thumbnail( $post_id ) ) {

		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
		$thumbnail = $thumbnail[0];

	}

	// return
	return $thumbnail;

}


/**
 * anu_index_get_image_url
 *
 * This function returns attachment url by ID
 *
 * @param	$attachment_id (int)
 * @return	$url (string)
 */
function anu_index_get_image_url( $attachment_id ) {

	if ( ! $attachment_id )
		return '';

	$url = wp_get_attachment_url( $attachment_id );

	// return
	return $url ? $url : '';

}


/**
 * anu_index_get_missing_posts_in_directus
 *
 * This function returns array of missing post IDs in Directus
 *
 * @param	$collection
 * @return	$posts (array) or false
 */
function anu_index_get_missing_posts_in_directus( $collection ) {

	$post_type = '';
	$post_ids = [];
	$directus_item_ids = [];
	$missing = [];

	if ( ! $collection )
		return false;

	switch ( $collection ) {
		case 'index_floors':
			$post_type = 'floor';
			break;
		
		case 'index_display_centers':
			$post_type = 'display_center';
			break;
		
		case 'index_exhibits':
			$post_type = 'exhibit';
			break;
	}

	if ( ! $post_type )
		return false;

	// get posts
	$args = array(
		'post_type'			=> $post_type,
		'posts_per_page'	=> -1,
	);
	$posts = new WP_Query( $args );

	if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post();

		$post_ids[] = $posts->post->ID;

	endwhile; endif;

	wp_reset_postdata();

	if ( ! $post_ids ) {
		return $missing;
	}

	// get Directus api
	$api = anu_index_get_directus_api();

	if ( ! $api )
		return false;

	try {

		// unlimit items return
		$api->_limit(-1);

		// get all items
		$items = $api->items( $collection )->get();

		if ( $api->isError( $items ) )
			return false;

		if ( $items->data ) {
			foreach ( $items->data as $item ) {
				$directus_item_ids[] = (int)$item->wp_id;
			}
		}

		if ( ! $directus_item_ids ) {
			return $missing;
		}

		// find missing posts
		$missing = array_diff( $post_ids, $directus_item_ids );

		// return
		return $missing;

	}

	catch ( Exception $e ) {
		return;
	}

}
