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

function devfolio_get_theme_mod_image_url( $key, $default = '' ) {
	$value = devfolio_get_theme_mod_value( $key, $default );

	if ( is_numeric( $value ) ) {
		$image_url = wp_get_attachment_image_url( (int) $value, 'full' );
		if ( $image_url ) {
			return $image_url;
		}
	}

	return (string) $value;
}

function devfolio_get_block_attr( $args, $key, $default = '' ) {
	if ( isset( $args[ $key ] ) && '' !== $args[ $key ] && null !== $args[ $key ] ) {
		return $args[ $key ];
	}

	return $default;
}

function devfolio_get_block_array_attr( $args, $key, $default = array() ) {
	if ( isset( $args[ $key ] ) && is_array( $args[ $key ] ) && ! empty( $args[ $key ] ) ) {
		return $args[ $key ];
	}

	return $default;
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

function devfolio_excerpt_text( $post_id = null, $length = 180 ) {
	$post_id = $post_id ? (int) $post_id : get_the_ID();
	$length  = max( 1, (int) $length );

	if ( ! $post_id ) {
		return '';
	}

	$excerpt = get_the_excerpt( $post_id );

	if ( '' === trim( (string) $excerpt ) ) {
		$content = get_post_field( 'post_content', $post_id );
		if ( function_exists( 'excerpt_remove_blocks' ) ) {
			$content = excerpt_remove_blocks( $content );
		}
		$content = strip_shortcodes( $content );
		$excerpt = wp_strip_all_tags( $content, true );
	}

	$excerpt = trim( preg_replace( '/\s+/', ' ', (string) $excerpt ) );

	if ( function_exists( 'mb_strlen' ) && function_exists( 'mb_substr' ) ) {
		if ( mb_strlen( $excerpt ) <= $length ) {
			return $excerpt;
		}

		return rtrim( mb_substr( $excerpt, 0, $length ), " \t\n\r\0\x0B.,;:" ) . '...';
	}

	if ( strlen( $excerpt ) <= $length ) {
		return $excerpt;
	}

	return rtrim( substr( $excerpt, 0, $length ), " \t\n\r\0\x0B.,;:" ) . '...';
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

function devfolio_has_valid_url( $url ) {
	$url = trim( (string) $url );

	return '' !== $url && '#' !== $url;
}

function devfolio_format_download_count( $value, $seed = '' ) {
	$value = trim( (string) $value );

	if ( '' !== $value && is_numeric( $value ) ) {
		$count = (int) $value;
	} elseif ( '' !== $value ) {
		return $value;
	} else {
		$seed  = '' !== (string) $seed ? (string) $seed : 'plugin';
		$count = ( crc32( $seed ) % 8200 ) + 1800;
	}

	if ( $count >= 1000000 ) {
		return number_format_i18n( $count / 1000000, 1 ) . 'M';
	}
	if ( $count >= 1000 ) {
		return number_format_i18n( $count / 1000, 1 ) . 'K';
	}

	return number_format_i18n( $count );
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
			'caseStudyUrl' => '/realty-com-mobile-app/',
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
			'caseStudyUrl' => '/express-systems-e-commerce/',
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
			'caseStudyUrl' => '/tf-internet-dashboard/',
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
			'caseStudyUrl' => '/real-estate-backend-rest-api/',
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
			'caseStudyUrl' => '/linkingcc-management-portal/',
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
			'caseStudyUrl' => '/figma-to-nextjs-conversion/',
			'live'     => '',
			'github'   => '',
		),
	);

	return $items;
}

function devfolio_get_section_defaults() {
	return array(
		'hero'            => array( 'id' => 'home', 'label' => __( 'Home', 'devfolio' ) ),
		'experience'      => array( 'id' => 'experience', 'label' => __( 'Experience', 'devfolio' ) ),
		'about'           => array( 'id' => 'about', 'label' => __( 'About', 'devfolio' ) ),
		'skills'          => array( 'id' => 'skills', 'label' => __( 'Skills', 'devfolio' ) ),
		'projects'        => array( 'id' => 'contributions', 'label' => __( 'Contributions', 'devfolio' ) ),
		'portfolio'       => array( 'id' => 'portfolio', 'label' => __( 'Portfolio', 'devfolio' ) ),
		'project-details' => array( 'id' => 'project-details', 'label' => __( 'Project Details', 'devfolio' ) ),
		'services'        => array( 'id' => 'services', 'label' => __( 'Services', 'devfolio' ) ),
		'plugins'         => array( 'id' => 'plugins', 'label' => __( 'Plugins', 'devfolio' ) ),
		'plugin-details'  => array( 'id' => 'plugin-details', 'label' => __( 'Plugin Details', 'devfolio' ) ),
		'services-detail' => array( 'id' => 'service-details', 'label' => __( 'Service Details', 'devfolio' ) ),
		'tabbed-showcase' => array( 'id' => 'tabbed-showcase', 'label' => __( 'Tabbed Showcase', 'devfolio' ) ),
		'process'         => array( 'id' => 'process', 'label' => __( 'Process', 'devfolio' ) ),
		'origin'          => array( 'id' => 'origin', 'label' => __( 'Origin Story', 'devfolio' ) ),
		'blog'            => array( 'id' => 'blog', 'label' => __( 'Blog', 'devfolio' ) ),
		'testimonials'    => array( 'id' => 'testimonials', 'label' => __( 'Testimonials', 'devfolio' ) ),
		'contact'         => array( 'id' => 'contact', 'label' => __( 'Contact', 'devfolio' ) ),
	);
}

function devfolio_get_section_id( $key ) {
	$defaults = devfolio_get_section_defaults();
	if ( ! isset( $defaults[ $key ]['id'] ) ) {
		return sanitize_html_class( (string) $key );
	}

	return $defaults[ $key ]['id'];
}

function devfolio_get_block_section_id( $args, $key ) {
	$default = devfolio_get_section_id( $key );
	$value   = devfolio_get_block_attr( $args, 'sectionId', '' );

	if ( '' === trim( (string) $value ) ) {
		$value = devfolio_get_block_attr( $args, 'anchor', $default );
	}

	$value = sanitize_title( (string) $value );

	return '' !== $value ? $value : $default;
}

function devfolio_get_section_label( $key ) {
	$defaults = devfolio_get_section_defaults();
	if ( ! isset( $defaults[ $key ]['label'] ) ) {
		return ucfirst( (string) $key );
	}

	return $defaults[ $key ]['label'];
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
