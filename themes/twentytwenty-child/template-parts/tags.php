<?php
/**
 * Floor tags
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts
 * @version		1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Variables
 */
global $post;

$title		= '';
$taxonomy	= '';

switch ( get_post_type() ) {
	case 'floor':
		$title		= __( 'Themes and Connections', 'twentytwenty-child' ) . ': ';
		$taxonomy	= 'theme';
		break;

	case 'display_center':
	case 'exhibit':
		$title		= __( 'Themes and Connections', 'twentytwenty-child' ) . ': ';
		$taxonomy	= 'hashtag';
}

if ( ! $title || ! $taxonomy )
	return;

$terms = get_the_term_list( $post->ID, $taxonomy, '<p>', ', ', '</p>' );

if ( ! $terms )
	return;

?>

<div class="entry-tags">

	<h5 class="tags-title"><?php echo $title; ?></h5>

	<?php echo $terms; ?>

</div><!-- .entry-tags -->