<?php
/**
 * Floor display centers
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts/floor
 * @version		1.2.3
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// get display centers
$display_centers = bh_idx_get_display_centers( get_the_ID() );

if ( ! $display_centers )
	return;

?>

<div class="entry-content">

	<h3><span class="dashicons dashicons-store"></span><?php _e( 'Display Centers', 'twentytwenty-child' ); ?></h3>

	<ul class="display-centers">

		<?php foreach ( $display_centers as $c ) {

			echo '<li><a href="' . esc_url( get_permalink( $c->ID ) ) . '">' . $c->post_title . '</a></li>';

		} ?>

	</ul><!-- .display-centers -->

</div><!-- .entry-content -->