<?php
/**
 * CMB2 fields: Denim Innovation.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'cmb2_admin_init', 'devfolio_register_denim_innovation_metabox' );

function devfolio_register_denim_innovation_metabox() {
	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$box = new_cmb2_box(
		array(
			'id'           => 'devfolio_denim_innovation_metabox',
			'title'        => __( 'Denim Innovation Details', 'devfolio' ),
			'object_types' => array( 'devfolio_denim' ),
		)
	);

	$box->add_field( array( 'name' => __( 'Subtitle', 'devfolio' ), 'id' => 'devfolio_denim_innovation_subtitle', 'type' => 'text' ) );
	$box->add_field( array( 'name' => __( 'Image URL Override', 'devfolio' ), 'id' => 'devfolio_denim_innovation_image_url', 'type' => 'text_url' ) );
}
