<?php
/**
 * Display Center template
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
				 * display center content
				 */
				get_template_part( 'template-parts/display-center/display-center-content' );
			?>

		</div><!-- .post-inner -->

		<div class="post-inner aside">

			<div class="entry-content">

				<?php
					/**
					 * master label image
					 */
					get_template_part( 'template-parts/display-center/display-center-master-label-image' );
				?>

				<?php
					/**
					 * display exhibits
					 */
					get_template_part( 'template-parts/display-center/display-center-exhibits' );
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