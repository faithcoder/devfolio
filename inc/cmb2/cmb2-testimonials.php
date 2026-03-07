<?php
/**
 * CMB2 fields: Testimonials.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'cmb2_admin_init', 'devfolio_register_testimonial_metabox' );

function devfolio_register_testimonial_metabox() {
	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$box = new_cmb2_box(
		array(
			'id'           => 'devfolio_testimonial_metabox',
			'title'        => __( 'Testimonial Details', 'devfolio' ),
			'object_types' => array( 'devfolio_testimonial' ),
		)
	);

	$box->add_field( array( 'name' => __( 'Testimonial Text', 'devfolio' ), 'id' => 'devfolio_testimonial_text', 'type' => 'textarea' ) );
	$box->add_field( array( 'name' => __( 'Client Role', 'devfolio' ), 'id' => 'devfolio_testimonial_role', 'type' => 'text' ) );
	$box->add_field( array( 'name' => __( 'Avatar Initials', 'devfolio' ), 'id' => 'devfolio_testimonial_initials', 'type' => 'text_small' ) );
	$box->add_field(
		array(
			'name'    => __( 'Star Rating', 'devfolio' ),
			'id'      => 'devfolio_testimonial_rating',
			'type'    => 'select',
			'options' => array(
				'5' => '5',
				'4' => '4',
				'3' => '3',
				'2' => '2',
				'1' => '1',
			),
			'default' => '5',
		)
	);
}
