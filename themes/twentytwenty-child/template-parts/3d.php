<?php
/**
 * Displays the 3D url in single posts
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts
 * @version		1.3.5
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
    return;

if ( ! bh_idx_is_visible( 'exhibit', 'el_3d' ) )
	return;

/**
 * Variables
 */
$threeD = get_field( 'acf-exhibit_3d' );

if ( ! $threeD )
	return;

?>

<div class="3d">

	<a href="<?php echo $threeD; ?>" target="_blank"><?php _e( '3D presentation', 'twentytwenty-child' ); ?></a>

</div>