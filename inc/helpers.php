<?php
/**
 * Theme helper utilities.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function devfolio_get_theme_mod_value( $key, $default = '' ) {
	$value = get_theme_mod( $key, $default );
	return ( '' === $value || null === $value ) ? $default : $value;
}

function devfolio_get_repeater_value( $key, $default = array() ) {
	$value = get_theme_mod( $key, $default );

	if ( is_string( $value ) ) {
		$decoded = json_decode( $value, true );
		if ( JSON_ERROR_NONE === json_last_error() && is_array( $decoded ) ) {
			return $decoded;
		}
	}

	return is_array( $value ) ? $value : $default;
}

function devfolio_parse_tag_list( $value ) {
	if ( empty( $value ) ) {
		return array();
	}
	$items = preg_split( '/\s*,\s*/', (string) $value );
	$items = array_filter( array_map( 'trim', $items ) );
	return array_values( $items );
}

function devfolio_render_svg( $svg_markup ) {
	if ( empty( $svg_markup ) ) {
		return '';
	}

	$allowed = array(
		'svg'      => array(
			'xmlns'       => true,
			'width'       => true,
			'height'      => true,
			'fill'        => true,
			'viewbox'     => true,
			'viewBox'     => true,
			'stroke'      => true,
			'stroke-width'=> true,
			'class'       => true,
		),
		'path'     => array(
			'd'               => true,
			'fill'            => true,
			'stroke'          => true,
			'stroke-width'    => true,
			'stroke-linecap'  => true,
			'stroke-linejoin' => true,
		),
		'circle'   => array(
			'cx'           => true,
			'cy'           => true,
			'r'            => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
		),
		'rect'     => array(
			'x'            => true,
			'y'            => true,
			'width'        => true,
			'height'       => true,
			'rx'           => true,
			'ry'           => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
		),
		'line'     => array(
			'x1'           => true,
			'y1'           => true,
			'x2'           => true,
			'y2'           => true,
			'stroke'       => true,
			'stroke-width' => true,
		),
		'polygon'  => array(
			'points'       => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
		),
		'polyline' => array(
			'points'       => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
		),
	);

	return wp_kses( $svg_markup, $allowed );
}

function devfolio_render_icon( $icon_image = '', $svg_markup = '', $alt = '' ) {
	if ( ! empty( $icon_image ) ) {
		return '<img src="' . esc_url( $icon_image ) . '" alt="' . esc_attr( $alt ) . '" width="20" height="20" />';
	}

	return devfolio_render_svg( $svg_markup );
}

function devfolio_get_image_url( $post_id, $meta_key = '', $fallback = '' ) {
	if ( ! empty( $meta_key ) ) {
		$meta_url = get_post_meta( $post_id, $meta_key, true );
		if ( ! empty( $meta_url ) ) {
			return esc_url( $meta_url );
		}
	}

	if ( has_post_thumbnail( $post_id ) ) {
		$thumb = get_the_post_thumbnail_url( $post_id, 'large' );
		if ( $thumb ) {
			return esc_url( $thumb );
		}
	}

	return esc_url( $fallback );
}
