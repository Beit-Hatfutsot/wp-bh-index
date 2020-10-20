<?php
/**
 * Functions
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child
 * @version		1.1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// config
require_once( 'functions/config.php' );

// theme
require_once( 'functions/theme.php' );

// scripts and styles
require_once( 'functions/scripts-n-styles.php' );

// post types
require_once( 'functions/post-types.php' );

// taxonomies
require_once( 'functions/taxonomies.php' );

// ACF field groups
if ( defined( 'USE_LOCAL_ACF_CONFIGURATION' ) && USE_LOCAL_ACF_CONFIGURATION ) {
	require_once( 'functions/acf/acf-field-groups.php' );
}

// shortcodes
require_once( 'functions/shortcodes.php' );

// wp all import
require_once( 'functions/wp-all-import.php' );