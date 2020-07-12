<?php
/**
 * Exhibit template
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts
 * @version		1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
	return;

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php
		/**
		 * display title
		 */
		get_template_part( 'template-parts/entry-header' );
	?>

	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

		<?php
			/**
			 * display center content
			 */
			get_template_part( 'template-parts/exhibit/exhibit-content' );
		?>

	</div><!-- .post-inner -->

	<?php
		/**
		 * navigation
		 */
		get_template_part( 'template-parts/navigation' );
	?>

</article><!-- .post -->