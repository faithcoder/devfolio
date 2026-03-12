<?php
/**
 * CMB2 fields: Education.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'cmb2_admin_init', 'devfolio_register_education_metabox' );

function devfolio_register_education_metabox() {
	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$box = new_cmb2_box(
		array(
			'id'           => 'devfolio_education_metabox',
			'title'        => __( 'Education Details', 'devfolio' ),
			'object_types' => array( 'devfolio_education' ),
		)
	);

	$box->add_field( array( 'name' => __( 'Period/Institution', 'devfolio' ), 'id' => 'devfolio_education_period', 'type' => 'text' ) );
	$box->add_field( array( 'name' => __( 'Description', 'devfolio' ), 'id' => 'devfolio_education_desc', 'type' => 'textarea_small' ) );
	$box->add_field( array( 'name' => __( 'Icon Image (SVG/PNG)', 'devfolio' ), 'id' => 'devfolio_education_icon_image', 'type' => 'file' ) );
}
