<?php
/**
 * CMB2 fields: Portfolio.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'cmb2_admin_init', 'devfolio_register_portfolio_metabox' );

function devfolio_register_portfolio_metabox() {
	if ( ! function_exists( "new_cmb2_box" ) ) {
		return;
	}

	$box = new_cmb2_box(
		array(
			'id'           => 'devfolio_portfolio_metabox',
			'title'        => __( 'Portfolio Details', 'devfolio' ),
			'object_types' => array( 'devfolio_portfolio' ),
		)
	);

	$box->add_field( array( 'name' => __( 'Category', 'devfolio' ), 'id' => 'devfolio_portfolio_category', 'type' => 'text' ) );
	$box->add_field( array( 'name' => __( 'Card Description', 'devfolio' ), 'id' => 'devfolio_portfolio_short_desc', 'type' => 'textarea_small' ) );
	$box->add_field( array( 'name' => __( 'Popup Description', 'devfolio' ), 'id' => 'devfolio_portfolio_popup_desc', 'type' => 'textarea' ) );
	$box->add_field( array( 'name' => __( 'Tech List (comma separated)', 'devfolio' ), 'id' => 'devfolio_portfolio_tech', 'type' => 'text' ) );
	$box->add_field( array( 'name' => __( 'Live URL', 'devfolio' ), 'id' => 'devfolio_portfolio_live_url', 'type' => 'text_url' ) );
	$box->add_field( array( 'name' => __( 'GitHub URL', 'devfolio' ), 'id' => 'devfolio_portfolio_github_url', 'type' => 'text_url' ) );
	$box->add_field( array( 'name' => __( 'Image URL Override', 'devfolio' ), 'id' => 'devfolio_portfolio_image_url', 'type' => 'text_url' ) );
}
