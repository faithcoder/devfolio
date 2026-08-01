<?php
/**
 * Devfolio theme setup and assets.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function devfolio_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'block-template-parts' );
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'devfolio' ),
			'footer'  => __( 'Footer Menu', 'devfolio' ),
		)
	);
}
add_action( 'after_setup_theme', 'devfolio_theme_setup' );

function devfolio_asset_manifest() {
	return array(
		'css' => array(
			array(
				'handle' => 'devfolio-main',
				'path'   => '/assets/css/main.css',
				'deps'   => array(),
				'media'  => 'all',
			),
		),
		'js'  => array(
			array(
				'handle' => 'devfolio-main',
				'path'   => '/assets/js/main.js',
				'deps'   => array( 'jquery', 'jquery-ui-core' ),
				'footer' => true,
			),
		),
	);
}

function devfolio_enqueue_assets() {
	$theme_dir = get_template_directory();
	$theme_uri = get_template_directory_uri();
	$assets    = devfolio_asset_manifest();

	wp_enqueue_style( 'devfolio-theme-style', get_stylesheet_uri(), array(), filemtime( $theme_dir . '/style.css' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );

	if ( ! empty( $assets['css'] ) ) {
		foreach ( $assets['css'] as $style ) {
			$file = $theme_dir . $style['path'];
			if ( file_exists( $file ) ) {
				wp_enqueue_style(
					$style['handle'],
					$theme_uri . $style['path'],
					$style['deps'],
					filemtime( $file ),
					$style['media']
				);
			}
		}
	}

	if ( wp_style_is( 'devfolio-main', 'enqueued' ) ) {
		wp_add_inline_style( 'devfolio-main', devfolio_get_dynamic_style_vars() );
	}

	if ( ! empty( $assets['js'] ) ) {
		foreach ( $assets['js'] as $script ) {
			$file = $theme_dir . $script['path'];
			if ( file_exists( $file ) ) {
				wp_enqueue_script(
					$script['handle'],
					$theme_uri . $script['path'],
					$script['deps'],
					filemtime( $file ),
					$script['footer']
				);
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'devfolio_enqueue_assets' );

function devfolio_enqueue_block_editor_assets() {
	$theme_dir = get_template_directory();
	$theme_uri = get_template_directory_uri();
	$editor_css = $theme_dir . '/assets/css/editor.css';

	wp_enqueue_media();

	if ( file_exists( $editor_css ) ) {
		wp_enqueue_style(
			'devfolio-block-editor',
			$theme_uri . '/assets/css/editor.css',
			array(),
			filemtime( $editor_css )
		);
	}
}
add_action( 'enqueue_block_editor_assets', 'devfolio_enqueue_block_editor_assets' );

function devfolio_allow_svg_uploads( $mimes ) {
	if ( current_user_can( 'manage_options' ) ) {
		$mimes['svg'] = 'image/svg+xml';
	}
	return $mimes;
}
add_filter( 'upload_mimes', 'devfolio_allow_svg_uploads' );

function devfolio_fix_svg_mime_type( $data, $file, $filename, $mimes ) {
	$ext = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
	if ( 'svg' === $ext ) {
		$data['ext']  = 'svg';
		$data['type'] = 'image/svg+xml';
	}
	return $data;
}
add_filter( 'wp_check_filetype_and_ext', 'devfolio_fix_svg_mime_type', 10, 4 );

function devfolio_primary_menu_fallback() {
	$sections = devfolio_get_nav_sections();
	$order    = array( 'hero', 'experience', 'skills', 'projects', 'portfolio', 'services', 'process', 'origin', 'blog', 'testimonials', 'contact' );

	echo '<ul id="devfolio-primary-menu" class="devfolio-nav-links menu-list">';
	foreach ( $order as $key ) {
		if ( empty( $sections[ $key ]['id'] ) ) {
			continue;
		}
		echo '<li><a href="#' . esc_attr( $sections[ $key ]['id'] ) . '">' . esc_html( $sections[ $key ]['label'] ) . '</a></li>';
	}
	echo '</ul>';
}

function devfolio_primary_menu_anchor_links( $atts, $item, $args ) {
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $atts;
	}

	$href = $atts['href'] ?? '';
	if ( is_string( $href ) && '#' === substr( $href, 0, 1 ) && ! is_front_page() ) {
		$atts['href'] = home_url( '/' ) . $href;
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'devfolio_primary_menu_anchor_links', 10, 3 );

$devfolio_includes = array(
	'/inc/helpers.php',
	'/inc/blocks/home-blocks.php',
	'/inc/customizer/native-customizer.php',
	'/inc/customizer/dynamic-styles.php',
);

foreach ( $devfolio_includes as $include_file ) {
	$path = get_template_directory() . $include_file;
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}
