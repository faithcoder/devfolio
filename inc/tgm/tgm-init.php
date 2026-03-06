<?php
/**
 * TGMPA plugin registration.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'tgmpa_register', 'devfolio_register_required_plugins' );

function devfolio_register_required_plugins() {
	$plugins = array(
		array(
			'name'     => 'Kirki Customizer Framework',
			'slug'     => 'kirki',
			'required' => false,
		),
		array(
			'name'     => 'CMB2',
			'slug'     => 'cmb2',
			'required' => false,
		),
	);

	tgmpa( $plugins );
}
