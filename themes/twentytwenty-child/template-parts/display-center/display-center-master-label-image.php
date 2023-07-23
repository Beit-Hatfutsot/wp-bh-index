<?php
/**
 * Displays the master label image in single display center
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts/display-center
 * @version		1.3.5
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
	return;

if ( ! bh_idx_is_visible( 'display_center', 'masterlabelimage' ) )
	return;

/**
 * Variables
 */
$display_center_master_label_image	= get_field( 'acf-display-center_master_label_image' );

if ( ! $display_center_master_label_image )
	return;

/**
 * Variables
 */
$image_att	= wp_get_attachment_image_src( $display_center_master_label_image, 'large' );
$image_alt	= get_post_meta( $display_center_master_label_image, '_wp_attachment_image_alt', true );

?>

<div class="featured-image">

	<a href="<?php echo $image_att[0]; ?>" target="_blank"><img src="<?php echo $image_att[0]; ?>" alt="<?php echo $image_alt ?: ''; ?>" /></a>

</div>