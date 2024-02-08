<?php
/**
 * Floor content
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts/floor
 * @version		1.3.7
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
	return;

/**
 * Variables
 */
$floor_text			= get_field( 'acf-floor_text' );
$central_questions	= get_field( 'acf-floor_central_questions' );

?>

<div class="entry-content">

	<?php echo bh_idx_is_visible( 'floor', 'text' ) ? $floor_text : ''; ?>

	<?php if ( $central_questions && bh_idx_is_visible( 'floor', 'centralquestions' ) ) { ?>

		<div class="entry-central-questions">

			<h3 class="section-title"><?php _e( 'Central Questions', 'twentytwenty-child' ); ?></h3>

			<?php echo $central_questions; ?>

		</div><!-- .entry-central-questions -->

	<?php } ?>

	<?php
		/**
		 * display tags
		 */
		if ( bh_idx_is_visible( 'floor', 'themes' ) ) {
			get_template_part( 'template-parts/tags' );
		}
	?>

</div><!-- .entry-content -->