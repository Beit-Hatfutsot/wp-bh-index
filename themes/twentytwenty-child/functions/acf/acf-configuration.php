<?php
/**
 * ACF configuration
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child
 * @version		1.1.1
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'get_field' ) )
	return;

/**
 * bh_idx_acf_init
 *
 * This function initializes ACF configuration
 *
 * @param	N/A
 * @return	N/A
 */
function bh_idx_acf_init() {

	if ( function_exists( 'acf_add_options_page' ) ) {

		acf_add_options_page( array(
			'page_title'	=> __( 'Options', 'twentytwenty-child' ),
			'menu_title'	=> __( 'Options', 'twentytwenty-child' ),
			'menu_slug'		=> 'acf-options',
			'icon_url'		=> 'dashicons-admin-tools',
		));

		acf_add_options_sub_page( array(
			'page_title' 	=> __( 'Footer Settings', 'twentytwenty-child' ),
			'menu_title' 	=> __( 'Footer', 'twentytwenty-child' ),
			'menu_slug' 	=> 'acf-options-footer',
			'parent_slug' 	=> 'acf-options',
		));

	}

}
add_action( 'acf/init', 'bh_idx_acf_init' );