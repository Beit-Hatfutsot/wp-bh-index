<?php
/**
 * Display Center content
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts/display-center
 * @version		1.3.5
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
	return;

/**
 * Variables
 */
$one_line_description	= get_field( 'acf-display-center_one_line_description', false, false );
$master_label			= get_field( 'acf-display-center_master_label' );

?>

<div class="entry-content">

	<?php if ( $one_line_description && bh_idx_is_visible( 'display_center', 'onelinedescription' ) ) { ?>

		<div class="entry-one-line-description is-style-wide">

			<h2 class="section-title"><?php echo $one_line_description; ?></h2>

		</div><!-- .entry-one-line-description -->

	<?php } ?>

	<?php if ( $master_label && bh_idx_is_visible( 'display_center', 'masterlabel' ) ) { ?>

		<div class="entry-master-label">

			<?php echo $master_label; ?>

		</div><!-- .entry-master-label -->

	<?php } ?>

	<?php
		/**
		 * display tags
		 */
		if ( bh_idx_is_visible( 'display_center', 'hashtags' ) ) {
			get_template_part( 'template-parts/tags' );
		}
	?>

</div><!-- .entry-content -->