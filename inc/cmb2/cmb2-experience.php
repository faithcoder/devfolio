<?php
/**
 * CMB2 fields: Experience.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'cmb2_admin_init', 'devfolio_register_experience_metabox' );

function devfolio_register_experience_metabox() {
	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$box = new_cmb2_box(
		array(
			'id'           => 'devfolio_experience_metabox',
			'title'        => __( 'Experience Details', 'devfolio' ),
			'object_types' => array( 'devfolio_experience' ),
		)
	);

	$box->add_field( array( 'name' => __( 'Role', 'devfolio' ), 'id' => 'devfolio_experience_role', 'type' => 'text' ) );
	$box->add_field( array( 'name' => __( 'Period', 'devfolio' ), 'id' => 'devfolio_experience_period', 'type' => 'text' ) );
	$box->add_field( array( 'name' => __( 'Description', 'devfolio' ), 'id' => 'devfolio_experience_desc', 'type' => 'textarea_small' ) );
	$box->add_field( array( 'name' => __( 'Icon Image (SVG/PNG)', 'devfolio' ), 'id' => 'devfolio_experience_icon_image', 'type' => 'file' ) );
}
