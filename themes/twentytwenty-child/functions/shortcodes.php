<?php
/**
 * Shortcodes functions
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * bh_idx_menu
 *
 * This function adds the "menu" Shortcode
 *
 * @param	$atts (array)
 * @return	(string)
 */
function bh_idx_menu( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'name'	=> null,
		'class'	=> 'shortcode-menu',
	), $atts ) );

	if ( ! $name )
		// return
		return '';

	// return
	return wp_nav_menu( array( 'menu' => $name, 'menu_class' => $class, 'echo' => false ) );

}
add_shortcode( 'menu', 'bh_idx_menu' );