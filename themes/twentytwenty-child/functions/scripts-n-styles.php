<?php
/**
 * Scripts and styles functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.1.2
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'login_enqueue_scripts',	'bh_idx_login_scripts_n_styles' );
add_action( 'admin_enqueue_scripts',	'bh_idx_admin_scripts_n_styles' );
add_action( 'wp_enqueue_scripts',		'bh_idx_wp_scripts_n_styles' );
add_filter( 'mce_css',					'bh_idx_editor_style' );

/**
 * bh_idx_login_scripts_n_styles
 *
 * used before authentication
 *
 * @param	N/A
 * @return	N/A
 */
function bh_idx_login_scripts_n_styles() {

	wp_register_style( 'admin-login',	CSS_DIR . 'admin/login.css',	array(),	VERSION );

}

/**
 * bh_idx_admin_scripts_n_styles
 *
 * @param	N/A
 * @return	N/A
 */
function bh_idx_admin_scripts_n_styles() {

//	wp_register_style( 'admin-general',	CSS_DIR . 'admin/general.css',	array(),	VERSION );

}

/**
 * bh_idx_wp_scripts_n_styles
 *
 * @param	N/A
 * @return	N/A
 */
function bh_idx_wp_scripts_n_styles() {

	/**
	 * Styles
	 */
	wp_enqueue_style( 'parent-style',	get_template_directory_uri() . '/style.css',				array(),				VERSION );
	wp_enqueue_style( 'general',		CSS_DIR . 'general.css',									array(),				VERSION );
	wp_enqueue_style( 'dashicons',		SITE_URL . '/wp-includes/css/dashicons.min.css',			array(),				VERSION );

	if ( is_rtl() ) {

		wp_enqueue_style( 'parent-style-rtl',	get_template_directory_uri() . '/style-rtl.css',	array(),				VERSION );
		wp_enqueue_style( 'general-rtl',		CSS_DIR . 'rtl.css',								array( 'general' ),		VERSION );

	}

	/**
	 * Scripts
	 */
	wp_register_script( 'general',		JS_DIR . 'general.min.js',		array( 'jquery' ),	VERSION,	true );

	wp_enqueue_script( 'general' );

}

/**
 * bh_idx_editor_style
 *
 * This function declares tinyMCE styles
 *
 * @param	N/A
 * @return	(string)
 */
function bh_idx_editor_style( $styles ) {

	// globals
	global $globals;

	if ( $globals[ 'google_fonts' ] ) {

		$styles .= ',https://fonts.googleapis.com/css2?';

		foreach ( $globals[ 'google_fonts' ] as $font ) {

			$styles .= 'family=' . $font . '&';

		}

		$styles .= 'display=swap';

	}

	// return
	return $styles;

}