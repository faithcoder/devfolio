<?php
/**
 * Native post meta registration and meta boxes.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function devfolio_get_meta_field_map() {
	return array(
		'devfolio_experience'  => array(
			'devfolio_experience_role'       => array( 'label' => __( 'Role', 'devfolio' ), 'type' => 'text' ),
			'devfolio_experience_period'     => array( 'label' => __( 'Period', 'devfolio' ), 'type' => 'text' ),
			'devfolio_experience_desc'       => array( 'label' => __( 'Description', 'devfolio' ), 'type' => 'textarea' ),
			'devfolio_experience_icon_image' => array( 'label' => __( 'Icon Image URL', 'devfolio' ), 'type' => 'url' ),
		),
		'devfolio_education'   => array(
			'devfolio_education_period'     => array( 'label' => __( 'Period / Institution', 'devfolio' ), 'type' => 'text' ),
			'devfolio_education_desc'       => array( 'label' => __( 'Description', 'devfolio' ), 'type' => 'textarea' ),
			'devfolio_education_icon_image' => array( 'label' => __( 'Icon Image URL', 'devfolio' ), 'type' => 'url' ),
		),
		'devfolio_portfolio'   => array(
			'devfolio_portfolio_category'   => array( 'label' => __( 'Category', 'devfolio' ), 'type' => 'text' ),
			'devfolio_portfolio_short_desc' => array( 'label' => __( 'Card Description', 'devfolio' ), 'type' => 'textarea' ),
			'devfolio_portfolio_popup_desc' => array( 'label' => __( 'Project Overview', 'devfolio' ), 'type' => 'textarea' ),
			'devfolio_portfolio_tech'       => array( 'label' => __( 'Tech List (comma separated)', 'devfolio' ), 'type' => 'text' ),
			'devfolio_portfolio_live_url'   => array( 'label' => __( 'Live URL', 'devfolio' ), 'type' => 'url' ),
			'devfolio_portfolio_github_url' => array( 'label' => __( 'GitHub URL', 'devfolio' ), 'type' => 'url' ),
			'devfolio_portfolio_image_url'  => array( 'label' => __( 'Image URL Override', 'devfolio' ), 'type' => 'url' ),
		),
		'devfolio_event'       => array(
			'devfolio_event_location'  => array( 'label' => __( 'Location', 'devfolio' ), 'type' => 'text' ),
			'devfolio_event_image_url' => array( 'label' => __( 'Image URL Override', 'devfolio' ), 'type' => 'url' ),
		),
		'devfolio_denim'       => array(
			'devfolio_denim_innovation_subtitle'  => array( 'label' => __( 'Subtitle', 'devfolio' ), 'type' => 'text' ),
			'devfolio_denim_innovation_image_url' => array( 'label' => __( 'Image URL Override', 'devfolio' ), 'type' => 'url' ),
		),
		'devfolio_denim_video' => array(
			'devfolio_denim_video_subtitle'         => array( 'label' => __( 'Subtitle', 'devfolio' ), 'type' => 'text' ),
			'devfolio_denim_video_source_type'      => array(
				'label'   => __( 'Video Source Type', 'devfolio' ),
				'type'    => 'select',
				'options' => array(
					'youtube' => __( 'YouTube', 'devfolio' ),
					'hosted'  => __( 'Hosted Upload', 'devfolio' ),
				),
			),
			'devfolio_denim_video_youtube_url'      => array( 'label' => __( 'YouTube URL', 'devfolio' ), 'type' => 'url' ),
			'devfolio_denim_video_hosted_file'      => array( 'label' => __( 'Hosted Video File URL', 'devfolio' ), 'type' => 'url' ),
			'devfolio_denim_video_thumbnail_url'    => array( 'label' => __( 'Thumbnail Image URL', 'devfolio' ), 'type' => 'url' ),
		),
		'devfolio_service'     => array(
			'devfolio_service_desc'       => array( 'label' => __( 'Description', 'devfolio' ), 'type' => 'textarea' ),
			'devfolio_service_icon_image' => array( 'label' => __( 'Icon Image URL', 'devfolio' ), 'type' => 'url' ),
		),
		'devfolio_journey'     => array(
			'devfolio_journey_year'     => array( 'label' => __( 'Year', 'devfolio' ), 'type' => 'text' ),
			'devfolio_journey_desc'     => array( 'label' => __( 'Description', 'devfolio' ), 'type' => 'textarea' ),
			'devfolio_journey_position' => array(
				'label'   => __( 'Card Position', 'devfolio' ),
				'type'    => 'select',
				'options' => array(
					'top'    => __( 'Top', 'devfolio' ),
					'bottom' => __( 'Bottom', 'devfolio' ),
				),
			),
		),
		'devfolio_testimonial' => array(
			'devfolio_testimonial_text'     => array( 'label' => __( 'Testimonial Text', 'devfolio' ), 'type' => 'textarea' ),
			'devfolio_testimonial_role'     => array( 'label' => __( 'Client Role', 'devfolio' ), 'type' => 'text' ),
			'devfolio_testimonial_initials' => array( 'label' => __( 'Avatar Initials', 'devfolio' ), 'type' => 'text' ),
			'devfolio_testimonial_rating'   => array(
				'label'   => __( 'Star Rating', 'devfolio' ),
				'type'    => 'select',
				'options' => array(
					'5' => '5',
					'4' => '4',
					'3' => '3',
					'2' => '2',
					'1' => '1',
				),
			),
		),
	);
}

function devfolio_register_native_meta() {
	foreach ( devfolio_get_meta_field_map() as $post_type => $fields ) {
		foreach ( $fields as $meta_key => $field ) {
			$schema = array(
				'type'         => 'string',
				'single'       => true,
				'show_in_rest' => true,
				'auth_callback'=> static function() {
					return current_user_can( 'edit_posts' );
				},
			);

			register_post_meta( $post_type, $meta_key, $schema );
		}
	}
}
add_action( 'init', 'devfolio_register_native_meta' );

function devfolio_add_native_meta_boxes() {
	foreach ( devfolio_get_meta_field_map() as $post_type => $fields ) {
		add_meta_box(
			'devfolio_meta_' . $post_type,
			__( 'Details', 'devfolio' ),
			'devfolio_render_native_meta_box',
			$post_type,
			'normal',
			'default',
			array(
				'post_type' => $post_type,
				'fields'    => $fields,
			)
		);
	}
}
add_action( 'add_meta_boxes', 'devfolio_add_native_meta_boxes' );

function devfolio_render_native_meta_box( $post, $metabox ) {
	$args   = $metabox['args'] ?? array();
	$fields = $args['fields'] ?? array();

	wp_nonce_field( 'devfolio_save_meta_box', 'devfolio_meta_box_nonce' );

	echo '<table class="form-table" role="presentation"><tbody>';

	foreach ( $fields as $meta_key => $field ) {
		$value = get_post_meta( $post->ID, $meta_key, true );
		echo '<tr>';
		echo '<th scope="row"><label for="' . esc_attr( $meta_key ) . '">' . esc_html( $field['label'] ) . '</label></th>';
		echo '<td>';

		switch ( $field['type'] ) {
			case 'textarea':
				echo '<textarea class="large-text" rows="4" id="' . esc_attr( $meta_key ) . '" name="' . esc_attr( $meta_key ) . '">' . esc_textarea( $value ) . '</textarea>';
				break;
			case 'select':
				echo '<select id="' . esc_attr( $meta_key ) . '" name="' . esc_attr( $meta_key ) . '">';
				foreach ( $field['options'] as $option_value => $option_label ) {
					echo '<option value="' . esc_attr( $option_value ) . '" ' . selected( (string) $value, (string) $option_value, false ) . '>' . esc_html( $option_label ) . '</option>';
				}
				echo '</select>';
				break;
			default:
				$type = 'url' === $field['type'] ? 'url' : 'text';
				echo '<input class="regular-text" type="' . esc_attr( $type ) . '" id="' . esc_attr( $meta_key ) . '" name="' . esc_attr( $meta_key ) . '" value="' . esc_attr( $value ) . '" />';
				break;
		}

		echo '</td>';
		echo '</tr>';
	}

	echo '</tbody></table>';
}

function devfolio_save_native_meta_boxes( $post_id ) {
	if ( ! isset( $_POST['devfolio_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['devfolio_meta_box_nonce'] ) ), 'devfolio_save_meta_box' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$post_type = get_post_type( $post_id );
	$map       = devfolio_get_meta_field_map();

	if ( empty( $map[ $post_type ] ) ) {
		return;
	}

	foreach ( $map[ $post_type ] as $meta_key => $field ) {
		$raw_value = isset( $_POST[ $meta_key ] ) ? wp_unslash( $_POST[ $meta_key ] ) : '';

		switch ( $field['type'] ) {
			case 'url':
				$value = esc_url_raw( trim( (string) $raw_value ) );
				break;
			case 'textarea':
				$value = sanitize_textarea_field( $raw_value );
				break;
			case 'select':
				$value = sanitize_text_field( $raw_value );
				if ( ! isset( $field['options'][ $value ] ) ) {
					$value = '';
				}
				break;
			default:
				$value = sanitize_text_field( $raw_value );
				break;
		}

		if ( '' === $value ) {
			delete_post_meta( $post_id, $meta_key );
		} else {
			update_post_meta( $post_id, $meta_key, $value );
		}
	}
}
add_action( 'save_post', 'devfolio_save_native_meta_boxes' );
