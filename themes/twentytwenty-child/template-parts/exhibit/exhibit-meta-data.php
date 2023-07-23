<?php
/**
 * Exhibit meta data
 *
 * @author		Nir Goldberg
 * @package		twentytwenty-child/template-parts/exhibit
 * @version		1.3.5
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'ACF_EXISTS' ) || ! ACF_EXISTS )
	return;

/**
 * Variables
 */
$data = array(
	'artist_name'	=> array(
		'name'		=> __( 'Artist Name', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_artist_name' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'artistname' ),
	),
	'sku'			=> array(
		'name'		=> __( 'SKU', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_makat' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'makat' ),
	),
	'height'			=> array(
		'name'		=> __( 'Height', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_height' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'height' ),
	),
	'width'			=> array(
		'name'		=> __( 'Width', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_width' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'width' ),
	),
	'depth'			=> array(
		'name'		=> __( 'Depth', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_depth' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'depth' ),
	),
	'weight'			=> array(
		'name'		=> __( 'Weight', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_weight' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'weight' ),
	),
	'status'			=> array(
		'name'		=> __( 'Status', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_status' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'status' ),
	),
	'ownership'			=> array(
		'name'		=> __( 'Ownership', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_ownership' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'ownership' ),
	),
	'loan_end_date'	=> array(
		'name'		=> __( 'Loan End Date', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_loan_end_date' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'loanenddate' ),
	),
	'date_out_of_exhibition'	=> array(
		'name'		=> __( 'Date out of Exhibition', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_date_out_of_exhibition' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'dateoutofexhibition' ),
	),
	'conservation'	=> array(
		'name'		=> __( 'Conservation', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_conservation' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'conservation' ),
	),
	'rights'	=> array(
		'name'		=> __( 'Rights', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_rights' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'rights' ),
	),
	'app_number'	=> array(
		'name'		=> __( 'App Number', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_app_number' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'appnumber' ),
	),
	'app_tours'	=> array(
		'name'		=> __( 'App Tours', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_app_tours' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'apptours' ),
	),
	'audio_guide'	=> array(
		'name'		=> __( 'Audio Guide', 'twentytwenty-child' ),
		'value'		=> get_field( 'acf-exhibit_audioguide' ),
		'visible'	=> bh_idx_is_visible( 'exhibit', 'audioguide' ),
	),
);

?>

<div class="exhibit-meta-data">

	<?php foreach ( $data as $key => $val ) {
		if ( $val[ 'value' ] && $val[ 'visible' ] ) { ?>

			<div class="<?php echo $key; ?>-meta-data-entry">

				<strong class="meta-data-entry-title"><?php echo $val[ 'name' ] . ': '; ?></strong>

				<?php echo $val[ 'value' ]; ?>

			</div><!-- .<?php echo $key; ?>-meta-data-entry -->

		<?php }
	} ?>

</div><!-- .exhibit-meta-data -->