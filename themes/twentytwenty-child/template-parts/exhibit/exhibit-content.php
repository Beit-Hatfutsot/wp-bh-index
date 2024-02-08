<?php
/**
 * Exhibit content
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts/exhibit
 * @version		1.3.7
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
	return;

/**
 * Variables
 */
$label				= get_field( 'acf-exhibit_label' );
$extended_label		= get_field( 'acf-exhibit_extended_label' );
$text_panel			= get_field( 'acf-exhibit_text_panel' );
$must_know			= get_field( 'acf-exhibit_must_know' );
$good_for_guiding	= get_field( 'acf-exhibit_good_for_guiding' );
$more_sources		= get_field( 'acf-exhibit_more_sources' );

?>

<div class="entry-content">

	<?php if ( $label && bh_idx_is_visible( 'exhibit', 'label' ) ) { ?>

		<div class="entry-lebel">

			<h2 class="section-title"><?php echo str_replace( [ '<p>', '</p>' ], '', $label ); ?></h2>

		</div><!-- .entry-label -->

	<?php } ?>

	<?php if ( $extended_label && bh_idx_is_visible( 'exhibit', 'extendedlabel' ) ) { ?>

		<div class="entry-extended-label">

			<?php echo $extended_label; ?>

		</div><!-- .entry-extended-label -->

	<?php } ?>

	<?php if ( $text_panel && bh_idx_is_visible( 'exhibit', 'textpanel' ) ) { ?>

		<div class="entry-text-panel">

			<h3 class="section-title"><?php _e( 'Text Panel', 'twentytwenty-child' ); ?></h3>

			<?php echo $text_panel; ?>

		</div><!-- .entry-text-panel -->

	<?php } ?>

	<?php if ( $must_know && bh_idx_is_visible( 'exhibit', 'mustknow' ) ) { ?>

		<div class="entry-must-know">

			<h3 class="section-title"><?php _e( 'Must Know', 'twentytwenty-child' ); ?></h3>

			<?php echo $must_know; ?>

		</div><!-- .entry-must-know -->

	<?php } ?>

	<?php if ( $good_for_guiding && bh_idx_is_visible( 'exhibit', 'goodforguiding' ) ) { ?>

		<div class="entry-good-for-guiding toggle-section">

			<h3 class="section-title"><?php _e( 'More Info', 'twentytwenty-child' ); ?><span class="close"></span></h3>

			<div class="toggle-content close">
				<?php echo $good_for_guiding; ?>
			</div>

		</div><!-- .entry-good-for-guiding -->

	<?php } ?>

	<?php if ( $more_sources && bh_idx_is_visible( 'exhibit', 'moresources' ) ) { ?>

		<div class="entry-more-sources toggle-section">

			<h3 class="section-title"><?php _e( 'Additional Reading', 'twentytwenty-child' ); ?><span class="close"></span></h3>

			<div class="toggle-content close">
				<?php echo $more_sources; ?>
			</div>

		</div><!-- .entry-more-sources -->

	<?php } ?>

	<?php
		/**
		 * display tags
		 */
		if ( bh_idx_is_visible( 'exhibit', 'hashtags' ) ) {
			get_template_part( 'template-parts/tags' );
		}
	?>

</div><!-- .entry-content -->