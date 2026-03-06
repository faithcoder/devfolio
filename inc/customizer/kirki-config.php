<?php
/**
 * Kirki config.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function devfolio_register_kirki_config() {
	if ( ! class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_config(
		'devfolio_config',
		array(
			'capability'  => 'edit_theme_options',
			'option_type' => 'theme_mod',
		)
	);
}
add_action( 'init', 'devfolio_register_kirki_config' );
