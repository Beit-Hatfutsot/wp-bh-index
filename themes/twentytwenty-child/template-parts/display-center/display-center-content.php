<?php
/**
 * Display Center content
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts/display-center
 * @version		1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
	return;

/**
 * Variables
 */
$one_line_description	= get_field( 'acf-display-center_one_line_description' );
$master_label			= get_field( 'acf-display-center_master_label' );
$location				= get_field( 'acf-display-center_location' );
$media					= get_field( 'acf-display-center_media' );

?>

<div class="entry-content">

	<?php echo $one_line_description; ?>

	<?php if ( $master_label ) { ?>

		<div class="entry-master-label">

			<h2 class="section-title"><?php _e( 'Master Label', 'twentytwenty-child' ); ?></h2>

			<?php echo $master_label; ?>

		</div><!-- .entry-master-label -->

	<?php } ?>

	<?php if ( $location ) { ?>

		<div class="entry-location">

			<h2 class="section-title"><?php _e( 'Location', 'twentytwenty-child' ); ?></h2>

			<?php echo $location; ?>

		</div><!-- .entry-location -->

	<?php } ?>

	<?php if ( $media ) { ?>

		<div class="entry-media">

			<h2 class="section-title"><?php _e( 'Media', 'twentytwenty-child' ); ?></h2>

			<?php echo $media; ?>

		</div><!-- .entry-media -->

	<?php } ?>

	<?php
		/**
		 * display tags
		 */
		get_template_part( 'template-parts/tags' );
	?>

</div><!-- .entry-content -->