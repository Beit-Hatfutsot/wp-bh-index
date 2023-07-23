<?php
/**
 * Floor template
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts
 * @version		1.3.5
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
				 * floor content
				 */
				get_template_part( 'template-parts/floor/floor-content' );
			?>

		</div><!-- .post-inner -->

		<div class="post-inner aside">

			<div class="entry-content">

				<?php
					/**
					 * text picture
					 */
					get_template_part( 'template-parts/floor/floor-text-picture' );
				?>

				<?php
					/**
					 * display centers
					 */
					get_template_part( 'template-parts/floor/floor-display-centers' );
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