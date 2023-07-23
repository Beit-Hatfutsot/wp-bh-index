<?php
/**
 * Displays the text panel image in single exhibit
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts/exhibit
 * @version		1.3.5
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
	return;

if ( ! bh_idx_is_visible( 'exhibit', 'textpanelimage' ) )
	return;

/**
 * Variables
 */
$exhibit_text_panel_image	= get_field( 'acf-exhibit_text_panel_image' );

if ( ! $exhibit_text_panel_image )
	return;

/**
 * Variables
 */
$image_att	= wp_get_attachment_image_src( $exhibit_text_panel_image, 'large' );
$image_alt	= get_post_meta( $exhibit_text_panel_image, '_wp_attachment_image_alt', true );

?>

<figure class="featured-image">

	<a href="<?php echo $image_att[0]; ?>" target="_blank"><img src="<?php echo $image_att[0]; ?>" alt="<?php echo $image_alt ?: ''; ?>" /></a>
	<figcaption><?php _e( 'Text Panel Image', 'twentytwenty-child' ); ?></figcaption>

</figure>