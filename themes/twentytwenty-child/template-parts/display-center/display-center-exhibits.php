<?php
/**
 * Display Center exhibits
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts/display-center
 * @version		1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// get display centers
$exhibits = bh_idx_get_exhibits( get_the_ID() );

if ( ! $exhibits )
	return;

?>

<h3><span class="dashicons dashicons-format-image"></span><?php _e( 'Exhibits', 'twentytwenty-child' ); ?></h3>

<ul class="exhibits">

	<?php foreach ( $exhibits as $e ) {

		echo '<li><a href="' . esc_url( get_permalink( $e->ID ) ) . '">' . $e->post_title . '</a> (' . bh_idx_get_exhibit_number( $e->ID ) . ')</li>';

	} ?>

</ul><!-- .exhibits -->