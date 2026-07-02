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

function devfolio_get_youtube_video_id( $url ) {
	$url = trim( (string) $url );

	if ( '' === $url ) {
		return '';
	}

	$parts = wp_parse_url( $url );
	if ( empty( $parts['host'] ) ) {
		return '';
	}

	$host      = strtolower( (string) $parts['host'] );
	$path      = trim( (string) ( $parts['path'] ?? '' ), '/' );
	$candidate = '';

	if ( false !== strpos( $host, 'youtu.be' ) ) {
		$candidate = strtok( $path, '/' );
	} elseif ( false !== strpos( $host, 'youtube.com' ) || false !== strpos( $host, 'youtube-nocookie.com' ) ) {
		if ( 'watch' === $path ) {
			parse_str( (string) ( $parts['query'] ?? '' ), $query_args );
			$candidate = (string) ( $query_args['v'] ?? '' );
		} elseif ( 0 === strpos( $path, 'embed/' ) ) {
			$candidate = substr( $path, 6 );
		} elseif ( 0 === strpos( $path, 'shorts/' ) ) {
			$candidate = substr( $path, 7 );
		}
	}

	$candidate = strtok( $candidate, '?&/' );

	return preg_match( '/^[A-Za-z0-9_-]{6,}$/', $candidate ) ? $candidate : '';
}

function devfolio_get_youtube_embed_url( $video_id ) {
	$video_id = trim( (string) $video_id );

	if ( '' === $video_id ) {
		return '';
	}

	return sprintf(
		'https://www.youtube.com/embed/%s?autoplay=1&rel=0&modestbranding=1&playsinline=1',
		rawurlencode( $video_id )
	);
}

function devfolio_get_video_placeholder_image( $title = '' ) {
	$label = trim( (string) $title );
	if ( '' === $label ) {
		$label = __( 'Video', 'devfolio' );
	}

	$svg = sprintf(
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 675"><defs><linearGradient id="g" x1="0" x2="1" y1="0" y2="1"><stop stop-color="#2fad4e"/><stop offset="1" stop-color="#24b35a"/></linearGradient></defs><rect width="1200" height="675" fill="#0f1712"/><rect x="32" y="32" width="1136" height="611" rx="30" fill="url(#g)" opacity=".22"/><circle cx="600" cy="338" r="88" fill="rgba(255,255,255,.92)"/><polygon points="570,286 570,390 654,338" fill="#18301c"/><text x="600" y="560" text-anchor="middle" fill="#f4f8f5" font-family="Arial, sans-serif" font-size="38">%s</text></svg>',
		esc_html( wp_trim_words( $label, 6, '...' ) )
	);

	return 'data:image/svg+xml;charset=utf-8,' . rawurlencode( $svg );
}

function devfolio_has_valid_url( $url ) {
	$url = trim( (string) $url );

	return '' !== $url && '#' !== $url;
}

function devfolio_get_fallback_portfolio_items() {
	$items = array(
		array(
			'slug'     => 'realty-com-mobile-app',
			'title'    => 'REALTY.COM Mobile App',
			'category' => 'React Native',
			'image'    => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=600&h=400&fit=crop',
			'desc'     => 'Designed the application architecture and developed a high-performance native mobile app for 1,000,000+ real estate listings.',
			'tech'     => 'React Native, Node.js, REST API',
			'live'     => '',
			'github'   => '',
		),
		array(
			'slug'     => 'express-systems-e-commerce',
			'title'    => 'EXPRESS SYSTEMS E-Commerce',
			'category' => 'Web App',
			'image'    => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop',
			'desc'     => 'A robust e-commerce platform for selling medical equipment. Handled both frontend design (Figma constraints) and backend API development.',
			'tech'     => 'Laravel, React.Js, MySQL',
			'live'     => '',
			'github'   => '',
		),
		array(
			'slug'     => 'tf-internet-dashboard',
			'title'    => 'TF INTERNET Dashboard',
			'category' => 'Dashboard',
			'image'    => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop',
			'desc'     => 'Internal monitoring tool developed for a Denmark-based IT firm, handling client management, statistics, and continuous deployment tracking.',
			'tech'     => 'Vue.Js, Express.Js, MongoDB',
			'live'     => '',
			'github'   => '',
		),
		array(
			'slug'     => 'real-estate-backend-rest-api',
			'title'    => 'Real Estate Backend REST API',
			'category' => 'Backend',
			'image'    => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&h=400&fit=crop',
			'desc'     => 'Built a secure backend API connecting frontends and mobile apps using Node.Js. Implemented JWT, Passport authentication, and Unit tests.',
			'tech'     => 'Node.Js, MongoDB, Docker',
			'live'     => '',
			'github'   => '',
		),
		array(
			'slug'     => 'linkingcc-management-portal',
			'title'    => 'LinkingCC Management Portal',
			'category' => 'Web App',
			'image'    => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=600&h=400&fit=crop',
			'desc'     => 'Developed custom business applications with efficient flowcharts and responsive UI. Contributed to over 20+ live client projects.',
			'tech'     => 'PHP, Bootstrap 4, MySQL',
			'live'     => '',
			'github'   => '',
		),
		array(
			'slug'     => 'figma-to-nextjs-conversion',
			'title'    => 'Figma to Next.Js Conversion',
			'category' => 'Frontend',
			'image'    => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?w=600&h=400&fit=crop',
			'desc'     => 'Pixel-perfect UI development from Figma mockups, utilizing Next.Js for SEO-friendly performance and Tailwind CSS for rapid styling.',
			'tech'     => 'Next.Js, Tailwind CSS, Figma',
			'live'     => '',
			'github'   => '',
		),
	);

	foreach ( $items as $index => $item ) {
		$items[ $index ]['permalink'] = add_query_arg( 'devfolio_portfolio_demo', $item['slug'], home_url( '/' ) );
	}

	return $items;
}

function devfolio_get_fallback_portfolio_item( $slug ) {
	$slug = sanitize_title( (string) $slug );

	if ( '' === $slug ) {
		return null;
	}

	foreach ( devfolio_get_fallback_portfolio_items() as $item ) {
		if ( $slug === $item['slug'] ) {
			return $item;
		}
	}

	return null;
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
