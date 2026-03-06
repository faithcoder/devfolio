<?php
/**
 * CMB2 fields: Events.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'cmb2_admin_init', 'devfolio_register_event_metabox' );

function devfolio_register_event_metabox() {
	if ( ! function_exists( "new_cmb2_box" ) ) {
		return;
	}

	$box = new_cmb2_box(
		array(
			'id'           => 'devfolio_event_metabox',
			'title'        => __( 'Event Details', 'devfolio' ),
			'object_types' => array( 'devfolio_event' ),
		)
	);

	$box->add_field( array( 'name' => __( 'Location', 'devfolio' ), 'id' => 'devfolio_event_location', 'type' => 'text' ) );
	$box->add_field( array( 'name' => __( 'Image URL Override', 'devfolio' ), 'id' => 'devfolio_event_image_url', 'type' => 'text_url' ) );
}
