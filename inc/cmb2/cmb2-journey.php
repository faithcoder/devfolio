<?php
/**
 * CMB2 fields: Journey.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'cmb2_admin_init', 'devfolio_register_journey_metabox' );

function devfolio_register_journey_metabox() {
	if ( ! function_exists( "new_cmb2_box" ) ) {
		return;
	}

	$box = new_cmb2_box(
		array(
			'id'           => 'devfolio_journey_metabox',
			'title'        => __( 'Journey Details', 'devfolio' ),
			'object_types' => array( 'devfolio_journey' ),
		)
	);

	$box->add_field( array( 'name' => __( 'Year', 'devfolio' ), 'id' => 'devfolio_journey_year', 'type' => 'text' ) );
	$box->add_field( array( 'name' => __( 'Description', 'devfolio' ), 'id' => 'devfolio_journey_desc', 'type' => 'textarea_small' ) );
	$box->add_field(
		array(
			'name'    => __( 'Card Position', 'devfolio' ),
			'id'      => 'devfolio_journey_position',
			'type'    => 'radio_inline',
			'options' => array(
				'top'    => __( 'Top', 'devfolio' ),
				'bottom' => __( 'Bottom', 'devfolio' ),
			),
		)
	);
}
