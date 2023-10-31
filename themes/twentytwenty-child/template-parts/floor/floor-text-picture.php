<?php
/**
 * Displays the text picture in single floor
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts/floor
 * @version		1.3.6
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
	return;

if ( ! bh_idx_is_visible( 'floor', 'textpicture' ) )
	return;

/**
 * Variables
 */
$floor_text_picture	= get_field( 'acf-floor_text_picture' );

if ( ! $floor_text_picture )
	return;

/**
 * Variables
 */
$image_att	= wp_get_attachment_image_src( $floor_text_picture, 'full' );
$image_alt	= get_post_meta( $floor_text_picture, '_wp_attachment_image_alt', true );

?>

<div class="featured-image">

	<a href="<?php echo $image_att[0]; ?>" target="_blank"><img src="<?php echo $image_att[0]; ?>" alt="<?php echo $image_alt ?: ''; ?>" /></a>

</div>