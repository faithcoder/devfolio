<?php
/**
 * Gutenberg homepage sections.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function devfolio_get_home_block_specs() {
	return array(
		'hero'         => array(
			'title'       => __( 'Hero Section', 'devfolio' ),
			'description' => __( 'Intro section with hero copy, actions, socials, and stats.', 'devfolio' ),
			'attributes'  => array(
				'heroLabel'        => array( 'type' => 'string', 'default' => '' ),
				'heroTitleBefore'  => array( 'type' => 'string', 'default' => '' ),
				'heroTitleHighlight'=> array( 'type' => 'string', 'default' => '' ),
				'heroTitleAfter'   => array( 'type' => 'string', 'default' => '' ),
				'heroSubtitle'     => array( 'type' => 'string', 'default' => '' ),
				'primaryText'      => array( 'type' => 'string', 'default' => '' ),
				'primaryUrl'       => array( 'type' => 'string', 'default' => '' ),
				'secondaryText'    => array( 'type' => 'string', 'default' => '' ),
				'secondaryUrl'     => array( 'type' => 'string', 'default' => '' ),
				'heroImage'        => array( 'type' => 'string', 'default' => '' ),
				'heroStats'        => array( 'type' => 'array', 'default' => array() ),
				'socialProfiles'   => array( 'type' => 'array', 'default' => array() ),
			),
		),
		'experience'   => array(
			'title'       => __( 'Experience Section', 'devfolio' ),
			'description' => __( 'Timeline cards for work experience.', 'devfolio' ),
			'attributes'  => array(
				'label' => array( 'type' => 'string', 'default' => '' ),
				'titleText' => array( 'type' => 'string', 'default' => '' ),
				'desc' => array( 'type' => 'string', 'default' => '' ),
				'items' => array( 'type' => 'array', 'default' => array() ),
			),
		),
		'about'        => array(
			'title'       => __( 'About Section', 'devfolio' ),
			'description' => __( 'Tabbed skills, experience, and education section.', 'devfolio' ),
			'attributes'  => array(
				'label' => array( 'type' => 'string', 'default' => '' ),
				'titleText' => array( 'type' => 'string', 'default' => '' ),
				'desc' => array( 'type' => 'string', 'default' => '' ),
				'tabSkills' => array( 'type' => 'string', 'default' => '' ),
				'tabExperience' => array( 'type' => 'string', 'default' => '' ),
				'tabEducation' => array( 'type' => 'string', 'default' => '' ),
				'skillGroups' => array( 'type' => 'array', 'default' => array() ),
				'experienceItems' => array( 'type' => 'array', 'default' => array() ),
				'educationItems' => array( 'type' => 'array', 'default' => array() ),
			),
		),
		'skills'       => array(
			'title'       => __( 'Skills Section', 'devfolio' ),
			'description' => __( 'Skill groups and tags.', 'devfolio' ),
			'attributes'  => array(
				'label' => array( 'type' => 'string', 'default' => '' ),
				'titleText' => array( 'type' => 'string', 'default' => '' ),
				'desc' => array( 'type' => 'string', 'default' => '' ),
				'skillGroups' => array( 'type' => 'array', 'default' => array() ),
			),
		),
		'projects'     => array(
			'title'       => __( 'Projects Section', 'devfolio' ),
			'description' => __( 'Featured project, contribution cards, and event gallery.', 'devfolio' ),
			'attributes'  => array(
				'label' => array( 'type' => 'string', 'default' => '' ),
				'titleText' => array( 'type' => 'string', 'default' => '' ),
				'desc' => array( 'type' => 'string', 'default' => '' ),
				'featuredLabel' => array( 'type' => 'string', 'default' => '' ),
				'featuredTitle' => array( 'type' => 'string', 'default' => '' ),
				'featuredDesc' => array( 'type' => 'string', 'default' => '' ),
				'featuredTags' => array( 'type' => 'string', 'default' => '' ),
				'contributionItems' => array( 'type' => 'array', 'default' => array() ),
				'eventsTitle' => array( 'type' => 'string', 'default' => '' ),
				'eventsSubtitle' => array( 'type' => 'string', 'default' => '' ),
				'events' => array( 'type' => 'array', 'default' => array() ),
			),
		),
		'portfolio'    => array(
			'title'       => __( 'Portfolio Section', 'devfolio' ),
			'description' => __( 'Portfolio cards.', 'devfolio' ),
			'attributes'  => array(
				'label' => array( 'type' => 'string', 'default' => '' ),
				'titleText' => array( 'type' => 'string', 'default' => '' ),
				'desc' => array( 'type' => 'string', 'default' => '' ),
				'items' => array( 'type' => 'array', 'default' => array() ),
			),
		),
			'services'     => array(
				'title'       => __( 'Services Section', 'devfolio' ),
				'description' => __( 'Service cards.', 'devfolio' ),
				'attributes'  => array(
					'label' => array( 'type' => 'string', 'default' => '' ),
					'titleText' => array( 'type' => 'string', 'default' => '' ),
					'desc' => array( 'type' => 'string', 'default' => '' ),
					'items' => array( 'type' => 'array', 'default' => array() ),
				),
			),
			'services-detail' => array(
				'title'       => __( 'Service Details Section', 'devfolio' ),
				'description' => __( 'Interactive service list with details displayed in a side panel.', 'devfolio' ),
				'default_home'=> false,
				'keywords'    => array( __( 'services', 'devfolio' ), __( 'details', 'devfolio' ), __( 'interactive', 'devfolio' ) ),
				'attributes'  => array(
					'sectionId' => array( 'type' => 'string', 'default' => '' ),
					'label' => array( 'type' => 'string', 'default' => '' ),
					'titleText' => array( 'type' => 'string', 'default' => '' ),
					'desc' => array( 'type' => 'string', 'default' => '' ),
					'placeholderText' => array( 'type' => 'string', 'default' => '' ),
					'items' => array( 'type' => 'array', 'default' => array() ),
				),
			),
			'tabbed-showcase' => array(
				'title'       => __( 'Tabbed Showcase Section', 'devfolio' ),
				'description' => __( 'Tabbed slider section with media, descriptions, and feature lists.', 'devfolio' ),
				'default_home'=> false,
				'keywords'    => array( __( 'tabs', 'devfolio' ), __( 'showcase', 'devfolio' ), __( 'slider', 'devfolio' ), __( 'templates', 'devfolio' ) ),
				'attributes'  => array(
					'sectionId' => array( 'type' => 'string', 'default' => '' ),
					'label' => array( 'type' => 'string', 'default' => '' ),
					'titleText' => array( 'type' => 'string', 'default' => '' ),
					'desc' => array( 'type' => 'string', 'default' => '' ),
					'showcaseItems' => array( 'type' => 'array', 'default' => array() ),
				),
			),
			'process'      => array(
				'title'       => __( 'Process Section', 'devfolio' ),
				'description' => __( 'Process step cards.', 'devfolio' ),
				'attributes'  => array(
					'label' => array( 'type' => 'string', 'default' => '' ),
					'titleText' => array( 'type' => 'string', 'default' => '' ),
					'desc' => array( 'type' => 'string', 'default' => '' ),
					'steps' => array( 'type' => 'array', 'default' => array() ),
				),
			),
		'origin'       => array(
			'title'       => __( 'Origin Section', 'devfolio' ),
			'description' => __( 'Journey timeline.', 'devfolio' ),
			'attributes'  => array(
				'label' => array( 'type' => 'string', 'default' => '' ),
				'titleText' => array( 'type' => 'string', 'default' => '' ),
				'desc' => array( 'type' => 'string', 'default' => '' ),
				'items' => array( 'type' => 'array', 'default' => array() ),
			),
		),
		'blog'         => array(
			'title'       => __( 'Blog Section', 'devfolio' ),
			'description' => __( 'Recent posts section.', 'devfolio' ),
			'attributes'  => array(
				'label' => array( 'type' => 'string', 'default' => '' ),
				'titleText' => array( 'type' => 'string', 'default' => '' ),
				'desc' => array( 'type' => 'string', 'default' => '' ),
			),
		),
		'testimonials' => array(
			'title'       => __( 'Testimonials Section', 'devfolio' ),
			'description' => __( 'Testimonial slider content.', 'devfolio' ),
			'attributes'  => array(
				'label' => array( 'type' => 'string', 'default' => '' ),
				'titleText' => array( 'type' => 'string', 'default' => '' ),
				'desc' => array( 'type' => 'string', 'default' => '' ),
				'items' => array( 'type' => 'array', 'default' => array() ),
			),
		),
		'contact'      => array(
			'title'       => __( 'Contact Section', 'devfolio' ),
			'description' => __( 'Contact call to action.', 'devfolio' ),
			'attributes'  => array(
				'label' => array( 'type' => 'string', 'default' => '' ),
				'titleText' => array( 'type' => 'string', 'default' => '' ),
				'desc' => array( 'type' => 'string', 'default' => '' ),
				'email' => array( 'type' => 'string', 'default' => '' ),
				'buttonText' => array( 'type' => 'string', 'default' => '' ),
			),
		),
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
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n', 'wp-block-editor', 'wp-server-side-render' ),
		filemtime( $script ),
		true
	);

	wp_localize_script(
		'devfolio-editor-blocks',
		'devfolioBlocks',
		array(
			'specs' => devfolio_get_home_block_specs(),
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

function devfolio_get_home_block_supports() {
	return array(
		'align'           => array( 'wide', 'full' ),
		'anchor'          => true,
		'background'      => array(
			'backgroundImage' => true,
			'backgroundSize'  => true,
		),
		'border'          => array(
			'color'  => true,
			'radius' => true,
			'style'  => true,
			'width'  => true,
		),
		'color'           => array(
			'background' => true,
			'gradients'  => true,
			'link'       => true,
			'text'       => true,
		),
		'customClassName' => true,
		'dimensions'      => array(
			'minHeight' => true,
		),
		'html'            => false,
		'multiple'        => true,
		'reusable'        => false,
		'spacing'         => array(
			'margin'  => true,
			'padding' => true,
		),
		'typography'      => array(
			'fontFamily'     => true,
			'fontSize'       => true,
			'fontStyle'      => true,
			'fontWeight'     => true,
			'letterSpacing'  => true,
			'lineHeight'     => true,
			'textDecoration' => true,
			'textTransform'  => true,
		),
	);
}

function devfolio_register_home_blocks() {
	foreach ( devfolio_get_home_block_specs() as $slug => $spec ) {
		$attributes = array_merge(
			array(
				'align' => array(
					'type'    => 'string',
					'default' => 'full',
				),
			),
			$spec['attributes']
		);

		register_block_type(
			'devfolio/' . $slug . '-section',
			array(
				'api_version'   => 2,
				'title'         => $spec['title'],
					'category'      => 'devfolio',
					'icon'          => 'layout',
					'description'   => $spec['description'],
					'editor_script' => 'devfolio-editor-blocks',
					'keywords'      => $spec['keywords'] ?? array(),
					'supports'      => devfolio_get_home_block_supports(),
					'render_callback' => 'devfolio_render_home_block',
				'attributes'      => $attributes,
			)
		);
	}
}

function devfolio_get_default_home_block_slugs() {
	$slugs = array();

	foreach ( devfolio_get_home_block_specs() as $slug => $spec ) {
		if ( isset( $spec['default_home'] ) && false === $spec['default_home'] ) {
			continue;
		}

		$slugs[] = $slug;
	}

	return $slugs;
}
add_action( 'init', 'devfolio_register_home_blocks' );

function devfolio_render_home_block( $attributes, $content, $block ) {
	$block_name = isset( $block->name ) ? (string) $block->name : '';
	$slug       = str_replace( array( 'devfolio/', '-section' ), '', $block_name );
	$allowed    = array_keys( devfolio_get_home_block_specs() );

	if ( ! in_array( $slug, $allowed, true ) ) {
		return '';
	}

	$render_path = get_template_directory() . '/blocks/' . $slug . '/render.php';

	if ( ! file_exists( $render_path ) ) {
		return '';
	}

	ob_start();
	$args = $attributes;
	require $render_path;
	$section_html = trim( (string) ob_get_clean() );

	if ( '' === $section_html ) {
		return '';
	}

	$wrapper_attributes = get_block_wrapper_attributes(
		array(
			'class' => 'devfolio-section-block devfolio-' . sanitize_html_class( $slug ) . '-section-block',
		)
	);

	return '<div ' . $wrapper_attributes . '>' . $section_html . '</div>';
}

function devfolio_get_default_home_blocks() {
	$blocks = array();

	foreach ( devfolio_get_default_home_block_slugs() as $slug ) {
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
	$blocks = is_array( $blocks ) ? $blocks : array();
	$output = array();

	foreach ( $blocks as $block ) {
		$rendered = trim( (string) render_block( $block ) );

		if ( '' !== $rendered ) {
			$output[] = $rendered;
		}
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

function devfolio_render_home_content( $content = '' ) {
	$content = (string) $content;
	$blocks  = has_blocks( $content ) ? parse_blocks( $content ) : array();

	if ( ! empty( $blocks ) ) {
		return devfolio_render_home_blocks( $blocks );
	}

	$content = trim( apply_filters( 'the_content', $content ) );

	if ( '' !== $content ) {
		return '<section class="devfolio-section"><div class="devfolio-container"><div class="devfolio-page-content">' . $content . '</div></div></section>';
	}

	return devfolio_render_home_blocks( array() );
}

function devfolio_register_homepage_pattern() {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	$content = '';
	foreach ( devfolio_get_default_home_block_slugs() as $slug ) {
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
