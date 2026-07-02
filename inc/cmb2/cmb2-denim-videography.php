<?php
/**
 * CMB2 fields: Denim Innovation Videography.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'cmb2_admin_init', 'devfolio_register_denim_videography_metabox' );

function devfolio_register_denim_videography_metabox() {
	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$box = new_cmb2_box(
		array(
			'id'           => 'devfolio_denim_videography_metabox',
			'title'        => __( 'Denim Innovation Videography Details', 'devfolio' ),
			'object_types' => array( 'devfolio_denim_video' ),
		)
	);

	$box->add_field( array( 'name' => __( 'Subtitle', 'devfolio' ), 'id' => 'devfolio_denim_video_subtitle', 'type' => 'text' ) );
	$box->add_field(
		array(
			'name'    => __( 'Video Source Type', 'devfolio' ),
			'id'      => 'devfolio_denim_video_source_type',
			'type'    => 'radio_inline',
			'options' => array(
				'youtube' => __( 'YouTube', 'devfolio' ),
				'hosted'  => __( 'Hosted Upload', 'devfolio' ),
			),
			'default' => 'youtube',
		)
	);
	$box->add_field( array( 'name' => __( 'YouTube URL', 'devfolio' ), 'id' => 'devfolio_denim_video_youtube_url', 'type' => 'text_url' ) );
	$box->add_field( array( 'name' => __( 'Hosted Video File', 'devfolio' ), 'id' => 'devfolio_denim_video_hosted_file', 'type' => 'file' ) );
	$box->add_field( array( 'name' => __( 'Thumbnail Override Image', 'devfolio' ), 'id' => 'devfolio_denim_video_thumbnail_url', 'type' => 'file' ) );
}
