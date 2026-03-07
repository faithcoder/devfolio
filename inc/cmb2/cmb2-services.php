<?php
/**
 * CMB2 fields: Services.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'cmb2_admin_init', 'devfolio_register_service_metabox' );

function devfolio_register_service_metabox() {
	if ( ! function_exists( "new_cmb2_box" ) ) {
		return;
	}

	$box = new_cmb2_box(
		array(
			'id'           => 'devfolio_service_metabox',
			'title'        => __( 'Service Details', 'devfolio' ),
			'object_types' => array( 'devfolio_service' ),
		)
	);

	$box->add_field( array( 'name' => __( 'Description', 'devfolio' ), 'id' => 'devfolio_service_desc', 'type' => 'textarea_small' ) );
	$box->add_field( array( 'name' => __( 'Icon Image (SVG/PNG)', 'devfolio' ), 'id' => 'devfolio_service_icon_image', 'type' => 'file' ) );
}
