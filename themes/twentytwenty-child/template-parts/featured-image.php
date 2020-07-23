<?php
/**
 * Displays the featured image in single posts
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts
 * @version		1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! has_post_thumbnail() )
	return;

/**
 * Variables
 */
$image_id	= get_post_thumbnail_id();

if ( ! $image_id )
	return;

$image_att	= wp_get_attachment_image_src( $image_id, 'large' );
$image_alt	= get_post_meta( $image_id, '_wp_attachment_image_alt', true );

?>

<div class="featured-image">

	<a href="<?php echo $image_att[0]; ?>" target="_blank"><img src="<?php echo $image_att[0]; ?>" alt="<?php echo $image_alt ?: ''; ?>" /></a>

</div>