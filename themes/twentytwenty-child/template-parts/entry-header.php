<?php
/**
 * Post header
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts
 * @version		1.3.5
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
	return;

$entry_header_classes	= '';
$entry_header_style		= '';
$has_cover_image		= false;

if ( is_singular() ) {

	$entry_header_classes .= ' header-footer-group';

	switch ( get_post_type() ) {
		case 'floor':
			$has_cover_image = bh_idx_is_visible( 'floor', 'panoramicpicture' );
			$featured_image = $has_cover_image ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : '';
			break;
		
		case 'display_center':
			$has_cover_image = bh_idx_is_visible( 'display_center', 'featuredimage' );
			$featured_image = $has_cover_image ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : '';
			break;
		
		case 'exhibit':
			$has_cover_image = bh_idx_is_visible( 'exhibit', 'displayimage' );
			if ( $has_cover_image ) {
				$featured_image_id = get_field( 'acf-exhibit_display_image' );
				$featured_image_att	= wp_get_attachment_image_src( $featured_image_id, 'full' );
				$featured_image = $featured_image_att[0];
			}
			break;
	}

	if ( $featured_image ) {
		$entry_header_classes .= ' has-cover-image';
		$entry_header_style = "background-image: url('" . $featured_image . "');";
	}

}

?>

<header class="entry-header has-text-align-center<?php echo esc_attr( $entry_header_classes ); ?>" style="<?php echo $entry_header_style; ?>">

	<div class="entry-header-wrap">

		<div class="entry-header-inner section-inner medium">

			<?php
				/**
				 * Allow child themes and plugins to filter the display of the categories in the entry header.
				 *
				 * @since Twenty Twenty 1.0
				 *
				 * @param bool   Whether to show the categories in header, Default true.
				 */
			$show_categories = apply_filters( 'twentytwenty_show_categories_in_entry_header', true );

			if ( true === $show_categories && has_category() ) {
				?>

				<div class="entry-categories">
					<span class="screen-reader-text"><?php _e( 'Categories', 'twentytwenty' ); ?></span>
					<div class="entry-categories-inner">
						<?php the_category( ' ' ); ?>
					</div><!-- .entry-categories-inner -->
				</div><!-- .entry-categories -->

				<?php
			}

			if ( is_singular() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title heading-size-1"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
			}

			$intro_text_width = '';

			if ( is_singular() ) {
				$intro_text_width = ' small';
			} else {
				$intro_text_width = ' thin';
			}

			if ( has_excerpt() && is_singular() ) {
				?>

				<div class="intro-text section-inner max-percentage<?php echo $intro_text_width; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
					<?php the_excerpt(); ?>
				</div>

				<?php
			}

			// Default to displaying the post meta.
			bh_idx_the_post_meta( get_the_ID() );
			?>

		</div><!-- .entry-header-inner -->

	</div><!-- .entry-header-wrap -->

</header><!-- .entry-header -->