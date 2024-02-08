<?php
/**
 * display-mode
 *
 * API for toggle display mode and update cookie
 *
 * @author		Nir Goldberg
 * @package		functions
 * @version		1.3.7
 */

define( 'DOING_AJAX', true );
define( 'WP_ADMIN', false );
header( 'Cache-Control: no-cache, must-revalidate' );

require_once( '../../../../wp-load.php' );

// Setup variables
$mode	= ( isset( $_POST[ 'mode' ] ) && $_POST[ 'mode' ] ) ? $_POST[ 'mode' ] : '';
$pass	= ( isset( $_POST[ 'pass' ] ) && $_POST[ 'pass' ] ) ? $_POST[ 'pass' ] : '';

$result = array(
	'status'	=> '',
	'newmode'	=> ''
);

if ( ! function_exists( 'get_field' ) )
	return;

if ( ! $mode )
	return;

if ( 'curator' == $mode && get_field( 'acf-options_curator_password', 'option' ) != $pass ) {
	// return error
	$result[ 'status' ]		= 1;
}
else {
	// set cookie for 1 month
	setcookie( 'index_display_mode', $mode, strtotime( "+1 month" ), '/' );

	// return success
	$result[ 'status' ]		= 0;
	$result[ 'newmode' ]	= $mode;
}

$result = json_encode( $result );
echo $result;
