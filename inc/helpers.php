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
	$value = get_theme_mod( $key, null );
	return null === $value ? $default : $value;
}

function devfolio_get_repeater_value( $key, $default = array() ) {
	$value = get_theme_mod( $key, null );

	if ( null === $value ) {
		return $default;
	}

	if ( '' === $value ) {
		return array();
	}

	if ( is_string( $value ) ) {
		$decoded = json_decode( $value, true );
		if ( JSON_ERROR_NONE === json_last_error() && is_array( $decoded ) ) {
			return $decoded;
		}
	}

	return is_array( $value ) ? $value : $default;
}

function devfolio_css_value( $value, $fallback = '' ) {
	if ( '' === $value || null === $value ) {
		return $fallback;
	}
	return preg_replace( '/[^#(),.%\\sa-zA-Z0-9\\-+]/', '', (string) $value );
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

function devfolio_get_section_defaults() {
	return array(
		'hero'         => array( 'id' => 'home', 'label' => __( 'Home', 'devfolio' ) ),
		'experience'   => array( 'id' => 'experience', 'label' => __( 'Experience', 'devfolio' ) ),
		'about'        => array( 'id' => 'about', 'label' => __( 'About', 'devfolio' ) ),
		'skills'       => array( 'id' => 'skills', 'label' => __( 'Skills', 'devfolio' ) ),
		'projects'     => array( 'id' => 'projects', 'label' => __( 'Projects', 'devfolio' ) ),
		'portfolio'    => array( 'id' => 'portfolio', 'label' => __( 'Portfolio', 'devfolio' ) ),
		'services'     => array( 'id' => 'services', 'label' => __( 'Services', 'devfolio' ) ),
		'process'      => array( 'id' => 'process', 'label' => __( 'Process', 'devfolio' ) ),
		'origin'       => array( 'id' => 'origin', 'label' => __( 'Origin Story', 'devfolio' ) ),
		'blog'         => array( 'id' => 'blog', 'label' => __( 'Blog', 'devfolio' ) ),
		'testimonials' => array( 'id' => 'testimonials', 'label' => __( 'Testimonials', 'devfolio' ) ),
		'contact'      => array( 'id' => 'contact', 'label' => __( 'Contact', 'devfolio' ) ),
	);
}

function devfolio_get_section_id( $key ) {
	$defaults = devfolio_get_section_defaults();
	if ( ! isset( $defaults[ $key ]['id'] ) ) {
		return sanitize_html_class( (string) $key );
	}

	$setting = 'devfolio_section_id_' . $key;
	$value   = devfolio_get_theme_mod_value( $setting, $defaults[ $key ]['id'] );
	$value   = sanitize_title( (string) $value );

	return '' !== $value ? $value : $defaults[ $key ]['id'];
}

function devfolio_get_section_label( $key ) {
	$defaults = devfolio_get_section_defaults();
	if ( ! isset( $defaults[ $key ]['label'] ) ) {
		return ucfirst( (string) $key );
	}

	$setting = 'devfolio_nav_label_' . $key;
	$value   = trim( (string) devfolio_get_theme_mod_value( $setting, $defaults[ $key ]['label'] ) );

	return '' !== $value ? $value : $defaults[ $key ]['label'];
}

function devfolio_get_nav_sections() {
	$defaults = devfolio_get_section_defaults();
	$items    = array();

	foreach ( $defaults as $key => $data ) {
		$items[ $key ] = array(
			'id'    => devfolio_get_section_id( $key ),
			'label' => devfolio_get_section_label( $key ),
		);
	}

	return $items;
}
