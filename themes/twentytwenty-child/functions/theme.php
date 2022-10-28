<?php
/**
 * Theme functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.3.1
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * bh_idx_site_logo
 *
 * This function displays the site logo
 *
 * @param	N/A
 * @return	N/A
 */
function bh_idx_site_logo() {

	$lang	= pll_current_language();
	$logo	= get_stylesheet_directory_uri() . '/assets/images/anu-logo-' . $lang . '-colored.svg';

	echo '<div class="site-logo faux-heading"><a href="' . get_bloginfo( 'url' ) . '" rel="home" aria-current="page"><img style="height: 44px;" src="' . $logo . '" alt="' . get_bloginfo( 'name' ) . '"></a><span class="screen-reader-text">' . get_bloginfo( 'name' ) . '</span></div>';
}

/**
 * bh_idx_header_meta
 *
 * This function hooks header meta in order to add Google Fonts
 *
 * @param	N/A
 * @return	N/A
 */
function bh_idx_header_meta() {

	// globals
	global $globals;

	if ( $globals[ 'google_fonts' ] ) :

		$fonts = array();

		foreach ( $globals[ 'google_fonts' ] as $font ) {
			$fonts[] = 'family=' . $font;
		}

		?>

		<!-- Google Fonts -->
		<style>
		@import url('https://fonts.googleapis.com/css2?<?php echo implode( '&', $fonts ); ?>&display=swap');
		</style>

	<?php endif;

}
add_action( 'wp_head', 'bh_idx_header_meta' );

/**
 * bh_idx_twentytwenty_get_localized_font_family_types
 *
 * This function handles non-latin language styles
 *
 * @param	$font_family_types (array)
 * @return	array
 */
function bh_idx_twentytwenty_get_localized_font_family_types( $font_family_types ) {

	$font_family_types[ 'he-IL' ] = array( '\'Alef\'', '\'Open Sans\'', 'sans-serif' );
	$font_family_types[ 'en-US' ] = array( '\'Alef\'', '\'Open Sans\'', 'sans-serif' );

	// return
	return $font_family_types;

}
add_filter( 'twentytwenty_get_localized_font_family_types', 'bh_idx_twentytwenty_get_localized_font_family_types' );

/**
 * bh_idx_the_post_meta
 *
 * This function displays post meta
 *
 * @param	$post_id (int)
 * @return	N/A
 */
function bh_idx_the_post_meta( $post_id ) {

	if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS || ! $post_id )
		return;

	/**
	 * Variables
	 */
	$meta = array();

	switch ( get_post_type() ) {
		case 'exhibit':
			$exhibit_number		= bh_idx_get_exhibit_number( $post_id );

			$meta[2] = array(
				'icon'			=> 'format-image',
				'title'			=> __( 'Exhibit', 'twentytwenty-child' ) . ' ' . $exhibit_number,
			);

		case 'display_center':
			$display_center_number		= bh_idx_get_display_center_number( $post_id );
			$display_center_permalink	= bh_idx_get_display_center_permalink( $display_center_number );
			$display_center_title		= isset( $meta[2] ) ? bh_idx_get_display_center_title( $display_center_number ) . ' (' . $display_center_number . ')' : __( 'Display Center', 'twentytwenty-child' ) . ' ' . $display_center_number;

			$meta[1] = array(
				'icon'	=> 'store',
				'title'	=> ( isset( $meta[2] ) ? '<a href="' . $display_center_permalink . '">' : '' ) . $display_center_title . ( isset( $meta[2] ) ? '</a>' : '' ),
			);

		case 'floor':
			$floor_number				= bh_idx_get_floor_number( $post_id );
			$floor_permalink			= bh_idx_get_floor_permalink( $floor_number );

			$meta[0] = array(
				'icon'	=> 'building',
				'title'	=> ( isset( $meta[1] ) ? '<a href="' . $floor_permalink . '">' : '' ) . __( 'Floor', 'twentytwenty-child' ) . ' ' . $floor_number . ( isset( $meta[1] ) ? '</a>' : '' ),
			);
	}

	if ( ! $meta )
		return;

	ksort($meta);

	?>

	<div class="post-meta-wrapper post-meta-single post-meta-single-top">
		<ul class="post-meta">

			<?php foreach ( $meta as $m ) { ?>
				<li class="meta-wrapper">
					<span class="meta-icon">
						<span class="screen-reader-text"><?php echo $m[ 'title' ]; ?></span>
						<span class="dashicons dashicons-<?php echo $m[ 'icon' ]; ?>"></span>
					</span>
					<span class="meta-text"><?php echo $m[ 'title' ]; ?></span>
				</li>
			<?php } ?>

		</ul><!-- .post-meta -->
	</div>

	<?php

}

/**
 * bh_idx_get_floor_number
 *
 * This function returns floor number by post ID
 *
 * @param	$post_id (int)
 * @return	(string)
 */
function bh_idx_get_floor_number( $post_id ) {

	if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS || ! $post_id )
		return '';

	/**
	 * Variables
	 */
	$floor_number = '';

	switch ( get_post_type( $post_id ) ) {
		case 'exhibit':
			$display_center_number = get_field( 'acf-exhibit_display_center', $post_id );

			$args = array(
				'post_type'			=> 'display_center',
				'posts_per_page'	=> 1,
				'meta_key'			=> 'acf-display-center_curator_number',
				'meta_value'		=> $display_center_number,
			);
			$posts = new WP_Query( $args );

			if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post();

				$display_center = $posts->post;

			endwhile; endif;

			wp_reset_postdata();

			$floor_number = get_field( 'acf-display-center_floor', $display_center->ID );
			break;

		case 'display_center':
			$floor_number = get_field( 'acf-display-center_floor', $post_id );
			break;

		case 'floor':
			$floor_number = get_field( 'acf-floor_floor_number', $post_id );

	}

	// return
	return $floor_number;

}

/**
 * bh_idx_get_floor_permalink
 *
 * This function returns floor permalink by floor number
 *
 * @param	$floor_number (int)
 * @return	(string)
 */
function bh_idx_get_floor_permalink( $floor_number ) {

	if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS || ! ! is_null( $floor_number ) )
		return '';

	$args = array(
		'post_type'			=> 'floor',
		'posts_per_page'	=> 1,
		'meta_key'			=> 'acf-floor_floor_number',
		'meta_value'		=> $floor_number,
	);
	$posts = new WP_Query( $args );

	if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post();

		$p = $posts->post;

	endwhile; endif;

	wp_reset_postdata();

	// return
	return $p ? get_permalink( $p->ID ) : '';

}

/**
 * bh_idx_get_display_center_number
 *
 * This function returns display center number by post ID
 *
 * @param	$post_id (int)
 * @return	(string)
 */
function bh_idx_get_display_center_number( $post_id ) {

	if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS || ! $post_id )
		return '';

	/**
	 * Variables
	 */
	$display_center_number = '';

	switch ( get_post_type( $post_id ) ) {
		case 'exhibit':
			$display_center_number = get_field( 'acf-exhibit_display_center', $post_id );
			break;

		case 'display_center':
			$display_center_number = get_field( 'acf-display-center_curator_number', $post_id );

	}

	// return
	return $display_center_number;

}

/**
 * bh_idx_get_display_center_permalink
 *
 * This function returns display center permalink by display center number
 *
 * @param	$display_center_number (int)
 * @return	(string)
 */
function bh_idx_get_display_center_permalink( $display_center_number ) {

	if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS || ! $display_center_number )
		return '';

	$args = array(
		'post_type'			=> 'display_center',
		'posts_per_page'	=> 1,
		'meta_key'			=> 'acf-display-center_curator_number',
		'meta_value'		=> $display_center_number,
	);
	$posts = new WP_Query( $args );

	if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post();

		$p = $posts->post;

	endwhile; endif;

	wp_reset_postdata();

	// return
	return $p ? get_permalink( $p->ID ) : '';

}

/**
 * bh_idx_get_display_center_title
 *
 * This function returns display center title by display center number
 *
 * @param	$display_center_number (int)
 * @return	(string)
 */
function bh_idx_get_display_center_title( $display_center_number ) {

	if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS || ! $display_center_number )
		return '';

	$args = array(
		'post_type'			=> 'display_center',
		'posts_per_page'	=> 1,
		'meta_key'			=> 'acf-display-center_curator_number',
		'meta_value'		=> $display_center_number,
	);
	$posts = new WP_Query( $args );

	if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post();

		$p = $posts->post;

	endwhile; endif;

	wp_reset_postdata();

	// return
	return $p ? $p->post_title : '';

}

/**
 * bh_idx_get_exhibit_number
 *
 * This function returns exhibit number by post ID
 *
 * @param	$post_id (int)
 * @return	(string)
 */
function bh_idx_get_exhibit_number( $post_id ) {

	if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS || ! $post_id )
		return '';

	// return
	return get_field( 'acf-exhibit_item_id', $post_id );

}

/**
 * bh_idx_get_floors
 *
 * This function returns all floors
 *
 * @param	N/A
 * @return	(array)
 */
function bh_idx_get_floors() {

	/**
	 * Variables
	 */
	$floors = array();

	// get floors
	$args = array(
		'post_type'			=> 'floor',
		'posts_per_page'	=> -1,
		'meta_key'			=> 'acf-floor_floor_number',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC',
	);
	$posts = new WP_Query( $args );

	if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post();

		$floors[] = $posts->post;

	endwhile; endif;

	wp_reset_postdata();

	// return
	return $floors;

}

/**
 * bh_idx_get_display_centers
 *
 * This function returns display centers by floor post ID
 *
 * @param	$post_id (int)
 * @param	$inner_number (bool) [true|false] Whether refer $post_id as inner number (true) or post ID (false)
 * @return	(array)
 */
function bh_idx_get_display_centers( $post_id, $inner_number = false ) {

	if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS || ! $post_id )
		return array();

	/**
	 * Variables
	 */
	$floor_number		= ! $inner_number ? get_field( 'acf-floor_floor_number', $post_id ) : $post_id;
	$display_centers	= array();

	if ( is_null( $floor_number ) )
		return $display_centers;

	// get display centers
	$args = array(
		'post_type'			=> 'display_center',
		'posts_per_page'	=> -1,
		'meta_key'			=> 'acf-display-center_curator_number',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC',
		'meta_query'		=> array(
			array(
				'key'		=> 'acf-display-center_floor',
				'value'		=> $floor_number,
			),
		),
	);
	$posts = new WP_Query( $args );

	if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post();

		$display_centers[] = $posts->post;

	endwhile; endif;

	wp_reset_postdata();

	// return
	return $display_centers;

}

/**
 * bh_idx_get_exhibits
 *
 * This function returns exhibits by display center post ID
 *
 * @param	$post_id (int)
 * @param	$inner_number (bool) [true|false] Whether refer $post_id as inner number (true) or post ID (false)
 * @return	(array)
 */
function bh_idx_get_exhibits( $post_id, $inner_number = false ) {

	if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS || ! $post_id )
		return array();

	/**
	 * Variables
	 */
	$display_center_number	= ! $inner_number ? get_field( 'acf-display-center_curator_number', $post_id ) : $post_id;
	$exhibits				= array();

	if ( ! $display_center_number )
		return $exhibits;

	// get display centers
	$args = array(
		'post_type'			=> 'exhibit',
		'posts_per_page'	=> -1,
		'meta_key'			=> 'acf-exhibit_item_id',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC',
		'meta_query'		=> array(
			array(
				'key'		=> 'acf-exhibit_display_center',
				'value'		=> $display_center_number,
			),
		),
	);
	$posts = new WP_Query( $args );

	if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post();

		$exhibits[] = $posts->post;

	endwhile; endif;

	wp_reset_postdata();

	// return
	return $exhibits;

}

/**
 * bh_idx_get_adjacent_posts
 *
 * This function returns array of next and previous posts by their menu order
 *
 * @param	$post_id (int)
 * @return	(array)
 */
function bh_idx_get_adjacent_posts( $post_id ) {

	if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS || ! $post_id )
		return array();

	/**
	 * Variables
	 */
	$post_type	= get_post_type( $post_id );
	$posts		= array();

	if ( 'floor' == $post_type ) {
		$posts = bh_idx_get_floors();
	}
	elseif ( 'display_center' == $post_type ) {
		$floor_number = get_field( 'acf-display-center_floor', $post_id );
		$posts = bh_idx_get_display_centers( $floor_number, true );
	}
	elseif ( 'exhibit' == $post_type ) {
		$display_center_number = get_field( 'acf-exhibit_display_center', $post_id );
		$posts = bh_idx_get_exhibits( $display_center_number, true );
	}

	$nummber_of_posts = count( $posts );

	if ( $nummber_of_posts <= 1 )
		return $adjacent_posts;

	// loop
	for ( $p = 0 ; $p < count( $posts ) ; $p++ ) {
		if ( $post_id == $posts[ $p ]->ID )
			// current post key been found
			break;
	}

	$adjacent_posts[ 'next' ] = isset( $posts[ $p+1 ] ) ? $posts[ $p+1 ] : '';
	$adjacent_posts[ 'prev' ] = isset( $posts[ $p-1 ] ) ? $posts[ $p-1 ] : '';

	// return
	return $adjacent_posts;

}

/**
 * bh_idx_get_nav_menu_items
 *
 * This function adds a prefix for floor objects menu items
 *
 * @param	$items (array)
 * @param	$menu (object)
 * @param	$args (array)
 * @return	(array)
 */
function bh_idx_get_nav_menu_items( $items, $menu, $args ) {

	if ( ! $items )
		return $items;

	foreach ( $items as $item ) {
		if ( 'floor' == $item->object ) {
			$post_id = $item->object_id;
			$floor_number = bh_idx_get_floor_number( $post_id );
			$item->title = __( 'Floor', 'twentytwenty-child' ) . ' ' . $floor_number . ': ' . $item->title;
		}
	}

	// return
	return $items;

}
add_filter( 'wp_get_nav_menu_items', 'bh_idx_get_nav_menu_items', 10, 3 );

/**
 * bh_idx_pre_get_posts
 *
 * This function order search results by floor number
 *
 * @param	$query (obj)
 * @return	(obj)
 */
function bh_idx_pre_get_posts( $query ) {

	// skip admin
	if( is_admin() || ! $query->is_main_query() ) {
		return $query;
	}

	if ( $query->is_search ) {

		$query->set( 'orderby', array( 'meta_value' => 'DESC' ) );
		$query->set( 'meta_key', 'acf-exhibit_display_center' );

	}

	// return
	return $query;

}
add_action( 'pre_get_posts', 'bh_idx_pre_get_posts' );