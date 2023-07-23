<?php
/**
 * Displays the embedded video in single posts
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts
 * @version		1.3.5
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
    return;

if ( ! bh_idx_is_visible( 'exhibit', 'embeddedvideo' ) )
	return;

/**
 * Variables
 */
$embedded_video = get_field( 'acf-exhibit_embedded_video' );

if ( ! $embedded_video )
	return;

?>

<div class="embedded-video">

	<?php echo $embedded_video; ?>

</div>