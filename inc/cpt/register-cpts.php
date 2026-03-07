<?php
/**
 * Register custom post types.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function devfolio_register_cpts() {
	$cpts = array(
		'devfolio_experience' => array(
			'name'          => __( 'Experiences', 'devfolio' ),
			'singular_name' => __( 'Experience', 'devfolio' ),
		),
		'devfolio_portfolio'  => array(
			'name'          => __( 'Portfolio Items', 'devfolio' ),
			'singular_name' => __( 'Portfolio Item', 'devfolio' ),
		),
		'devfolio_event'      => array(
			'name'          => __( 'Events', 'devfolio' ),
			'singular_name' => __( 'Event', 'devfolio' ),
		),
		'devfolio_service'    => array(
			'name'          => __( 'Services', 'devfolio' ),
			'singular_name' => __( 'Service', 'devfolio' ),
		),
			'devfolio_journey'    => array(
				'name'          => __( 'Journey Items', 'devfolio' ),
				'singular_name' => __( 'Journey Item', 'devfolio' ),
			),
			'devfolio_testimonial' => array(
				'name'          => __( 'Testimonials', 'devfolio' ),
				'singular_name' => __( 'Testimonial', 'devfolio' ),
			),
		);

	foreach ( $cpts as $slug => $labels ) {
		register_post_type(
			$slug,
			array(
				'labels'       => array(
					'name'          => $labels['name'],
					'singular_name' => $labels['singular_name'],
				),
				'public'       => true,
				'show_in_rest' => true,
				'menu_icon'    => 'dashicons-portfolio',
				'supports'     => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' ),
				'has_archive'  => false,
				'rewrite'      => array( 'slug' => str_replace( 'devfolio_', '', $slug ) ),
			)
		);
	}
}
add_action( 'init', 'devfolio_register_cpts' );
