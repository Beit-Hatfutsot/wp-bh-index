<?php
/**
 * Exhibit template
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts
 * @version		1.2.0
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

	<div class="container section-inner">

		<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

			<?php
				/**
				 * display center content
				 */
				get_template_part( 'template-parts/exhibit/exhibit-content' );
			?>

		</div><!-- .post-inner -->

		<div class="post-inner aside">

			<div class="entry-content">

				<?php
					/**
					 * display featured image
					 */
					get_template_part( 'template-parts/featured-image' );
				?>

				<?php
					/**
					 * display embedded video
					 */
					get_template_part( 'template-parts/embedded-video' );
				?>

			</div><!-- .entry-content -->

		</div><!-- .aside -->

	</div><!-- .container -->

	<?php
		/**
		 * navigation
		 */
		get_template_part( 'template-parts/navigation' );
	?>

</article><!-- .post -->