<?php
/**
 * Exhibit content
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts/exhibit
 * @version		1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
	return;

/**
 * Variables
 */
$must_know			= get_field( 'acf-exhibit_must_know' );
$good_for_guiding	= get_field( 'acf-exhibit_good_for_guiding' );
$more_sources		= get_field( 'acf-exhibit_more_sources' );

?>

<div class="entry-content">

	<?php if ( $must_know ) { ?>

		<div class="entry-must-know">

			<h2 class="section-title"><?php _e( 'Must Know', 'twentytwenty-child' ); ?></h2>

			<?php echo $must_know; ?>

		</div><!-- .entry-must-know -->

	<?php } ?>

	<?php if ( $good_for_guiding ) { ?>

		<div class="entry-good-for-guiding toggle-section">

			<h2 class="section-title"><?php _e( 'Good for Guiding', 'twentytwenty-child' ); ?><span class="close"></span></h2>

			<div class="toggle-content close">
				<?php echo $good_for_guiding; ?>
			</div>

		</div><!-- .entry-good-for-guiding -->

	<?php } ?>

	<?php if ( $more_sources ) { ?>

		<div class="entry-more-sources toggle-section">

			<h2 class="section-title"><?php _e( 'Additional Reading', 'twentytwenty-child' ); ?><span class="close"></span></h2>

			<div class="toggle-content close">
				<?php echo $more_sources; ?>
			</div>

		</div><!-- .entry-more-sources -->

	<?php } ?>

	<?php
		/**
		 * display tags
		 */
		get_template_part( 'template-parts/tags' );
	?>

</div><!-- .entry-content -->