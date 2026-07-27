<?php
/**
 * Gutenberg homepage sections.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function devfolio_get_home_block_definitions() {
	return array(
		'hero'         => __( 'Hero Section', 'devfolio' ),
		'experience'   => __( 'Experience Section', 'devfolio' ),
		'about'        => __( 'About Section', 'devfolio' ),
		'skills'       => __( 'Skills Section', 'devfolio' ),
		'projects'     => __( 'Projects Section', 'devfolio' ),
		'portfolio'    => __( 'Portfolio Section', 'devfolio' ),
		'services'     => __( 'Services Section', 'devfolio' ),
		'process'      => __( 'Process Section', 'devfolio' ),
		'origin'       => __( 'Origin Section', 'devfolio' ),
		'blog'         => __( 'Blog Section', 'devfolio' ),
		'testimonials' => __( 'Testimonials Section', 'devfolio' ),
		'contact'      => __( 'Contact Section', 'devfolio' ),
	);
}

function devfolio_register_block_editor_assets() {
	$script = get_template_directory() . '/assets/js/editor-blocks.js';

	if ( ! file_exists( $script ) ) {
		return;
	}

	wp_register_script(
		'devfolio-editor-blocks',
		get_template_directory_uri() . '/assets/js/editor-blocks.js',
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n', 'wp-server-side-render', 'wp-block-editor' ),
		filemtime( $script ),
		true
	);

	wp_localize_script(
		'devfolio-editor-blocks',
		'devfolioBlocks',
		array(
			'blocks' => devfolio_get_home_block_definitions(),
		)
	);
}
add_action( 'init', 'devfolio_register_block_editor_assets' );

function devfolio_register_block_category( $categories ) {
	$categories[] = array(
		'slug'  => 'devfolio',
		'title' => __( 'Devfolio', 'devfolio' ),
	);

	return $categories;
}
add_filter( 'block_categories_all', 'devfolio_register_block_category' );

function devfolio_register_home_blocks() {
	foreach ( devfolio_get_home_block_definitions() as $slug => $title ) {
		register_block_type(
			'devfolio/' . $slug . '-section',
			array(
				'api_version'   => 2,
				'title'         => $title,
				'category'      => 'devfolio',
				'icon'          => 'layout',
				'description'   => sprintf( __( 'Renders the %s on the homepage.', 'devfolio' ), strtolower( $title ) ),
				'editor_script' => 'devfolio-editor-blocks',
				'supports'      => array(
					'html'      => false,
					'reusable'  => false,
					'multiple'  => true,
					'anchor'    => false,
				),
				'render_callback' => 'devfolio_render_home_block',
				'attributes'      => array(),
			)
		);
	}
}
add_action( 'init', 'devfolio_register_home_blocks' );

function devfolio_render_home_block( $attributes, $content, $block ) {
	$block_name = isset( $block->name ) ? (string) $block->name : '';
	$slug       = str_replace( array( 'devfolio/', '-section' ), '', $block_name );
	$allowed    = array_keys( devfolio_get_home_block_definitions() );

	if ( ! in_array( $slug, $allowed, true ) ) {
		return '';
	}

	ob_start();
	get_template_part( 'template-parts/home/section', $slug );
	return trim( (string) ob_get_clean() );
}

function devfolio_get_default_home_blocks() {
	$blocks = array();

	foreach ( array_keys( devfolio_get_home_block_definitions() ) as $slug ) {
		$blocks[] = array(
			'blockName'    => 'devfolio/' . $slug . '-section',
			'attrs'        => array(),
			'innerBlocks'  => array(),
			'innerHTML'    => '',
			'innerContent' => array(),
		);
	}

	return $blocks;
}

function devfolio_render_home_blocks( $blocks ) {
	$blocks   = is_array( $blocks ) ? $blocks : array();
	$output   = array();
	$allowed  = array_map(
		static function( $slug ) {
			return 'devfolio/' . $slug . '-section';
		},
		array_keys( devfolio_get_home_block_definitions() )
	);

	foreach ( $blocks as $block ) {
		$name = $block['blockName'] ?? '';

		if ( '' === $name ) {
			continue;
		}

		$rendered = render_block( $block );
		$rendered = trim( (string) $rendered );

		if ( '' === $rendered ) {
			continue;
		}

		$output[] = $rendered;
	}

	if ( empty( $output ) ) {
		foreach ( devfolio_get_default_home_blocks() as $block ) {
			$rendered = trim( (string) render_block( $block ) );
			if ( '' !== $rendered ) {
				$output[] = $rendered;
			}
		}
	}

	$html = '';
	foreach ( $output as $index => $section_html ) {
		$html .= $section_html;
		if ( $index < count( $output ) - 1 ) {
			$html .= '<div class="devfolio-glow-line"></div>';
		}
	}

	return $html;
}

function devfolio_register_homepage_pattern() {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	$content = '';
	foreach ( array_keys( devfolio_get_home_block_definitions() ) as $slug ) {
		$content .= sprintf( '<!-- wp:devfolio/%1$s-section /-->', esc_attr( $slug ) );
	}

	register_block_pattern(
		'devfolio/homepage-sections',
		array(
			'title'      => __( 'Devfolio Homepage', 'devfolio' ),
			'categories' => array( 'featured' ),
			'content'    => $content,
		)
	);
}
add_action( 'init', 'devfolio_register_homepage_pattern' );
