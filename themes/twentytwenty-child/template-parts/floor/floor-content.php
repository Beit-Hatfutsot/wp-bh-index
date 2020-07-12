<?php
/**
 * Floor content
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts/floor
 * @version		1.0.0
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

	<?php echo $floor_text; ?>

	<?php if ( $central_questions ) { ?>

		<div class="entry-central-questions">

			<h2 class="section-title"><?php _e( 'Central Questions', 'twentytwenty-child' ); ?></h2>

			<?php echo $central_questions; ?>

		</div><!-- .entry-central-questions -->

	<?php } ?>

	<?php
		/**
		 * display tags
		 */
		get_template_part( 'template-parts/tags' );
	?>

</div><!-- .entry-content -->