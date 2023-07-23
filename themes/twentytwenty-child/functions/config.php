<?php
/**
 * Configuration functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.3.5
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Theme version
 * Used to register styles and scripts
 */
if ( function_exists( 'wp_get_theme' ) ) {

	$theme_data		= wp_get_theme();
	$theme_version	= $theme_data->get( 'Version' );

}
else {

	$theme_data		= get_theme_data( trailingslashit( get_stylesheet_directory() ) . 'style.css' );
	$theme_version	= $theme_data[ 'Version' ];

}

/**
 * constants
 */
define( 'VERSION',				$theme_version );
define( 'HOME',					home_url( '/' ) );
define( 'SITE_URL',				get_site_url() );
define( 'TEMPLATE',				get_stylesheet_directory_uri() );
define( 'CSS_DIR',				TEMPLATE . '/assets/css/' );
define( 'JS_DIR',				TEMPLATE . '/assets/js/min/' );
define( 'PAGE_TEMPLATE_PATH',	'page-templates/' );
define( 'ACF_EXISTS',			function_exists( 'get_field' ) );

/**
 * Load theme text domain
 */
load_theme_textdomain( 'twentytwenty-child', get_stylesheet_directory() . '/lang' );

/**
 * Globals
 */
global $globals;

$globals = array(

	// google fonts
	'google_fonts' => array(
		'Alef:wght@400;700',
		'Open+Sans:wght@400;700',
	),

	// display modes
	'display' => array(
		'guide'		=> __( 'Guide', 'twentytwenty-child' ),
		'curator'	=> __( 'Curator', 'twentytwenty-child' ),
	),

	// fields
	'fields' => array(
		'floor' => array(
			'floor'					=> array(),
			'title'					=> array(),
			'panoramicpicture'		=> array( 'curator' ),
			'text'					=> array(),
			'textpicture'			=> array( 'curator' ),
			'centralquestions'		=> array( 'guide' ),
			'themes'				=> array(),
		),
		'display_center' => array(
			'floor'					=> array(),
			'curatornumber'			=> array(),
			'title'					=> array(),
			'featuredimage'			=> array( 'curator' ),
			'onelinedescription'	=> array(),
			'masterlabel'			=> array(),
			'masterlabelimage'		=> array( 'curator' ),
			'hashtags'				=> array(),
		),
		'exhibit' => array(
			'floor'					=> array(),
			'displaycenter'			=> array(),
			'casenumber'			=> array( 'curator' ),
			'itemid'				=> array(),
			'title'					=> array(),
			'featuredimage'			=> array(),
			'displayimage'			=> array( 'curator' ),
			'el_3d'					=> array(),
			'embeddedvideo'			=> array(),
			'label'					=> array( 'curator' ),
			'extendedlabel'			=> array( 'curator' ),
			'artistname'			=> array( 'curator' ),
			'textpanel'				=> array( 'curator' ),
			'textpanelimage'		=> array( 'curator' ),
			'mustknow'				=> array( 'guide' ),
			'goodforguiding'		=> array( 'guide' ),
			'moresources'			=> array( 'guide' ),
			'hashtags'				=> array(),
			'makat'					=> array( 'curator' ),
			'height'				=> array( 'curator' ),
			'width'					=> array( 'curator' ),
			'depth'					=> array( 'curator' ),
			'weight'				=> array( 'curator' ),
			'status'				=> array( 'curator' ),
			'ownership'				=> array( 'curator' ),
			'loanenddate'			=> array( 'curator' ),
			'dateoutofexhibition'	=> array( 'curator' ),
			'conservation'			=> array( 'curator' ),
			'rights'				=> array( 'curator' ),
			'appnumber'				=> array(),
			'apptours'				=> array(),
			'audioguide'			=> array(),
		),
		'test_mode' => false,
	),

);

/**
 * Cookies
 */
if ( ! isset( $_COOKIE[ 'index_display_mode' ] ) ) {

	// set a default cookie for 1 month
	setcookie( 'index_display_mode', 'guide', strtotime( "+1 month" ), '/' );

}