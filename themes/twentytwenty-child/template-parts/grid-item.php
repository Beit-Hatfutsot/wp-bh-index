<?php
/**
 * Grid item template
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts
 * @version		1.1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
	return;

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php
		/**
		 * display post meta
		 */
		bh_idx_the_post_meta( get_the_ID() );
	?>

	<?php
		/**
		 * display title
		 */
		echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
	?>

</article><!-- .post -->