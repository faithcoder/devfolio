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

function devfolio_register_sidebar() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'devfolio' ),
			'id'            => 'devfolio-sidebar-1',
			'description'   => __( 'Main sidebar area.', 'devfolio' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'devfolio_register_sidebar' );

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

function devfolio_get_dynamic_style_vars() {
	$primary = devfolio_get_theme_mod_value( 'devfolio_style_primary', '#2fad4e' );
	$accent  = devfolio_get_theme_mod_value( 'devfolio_style_accent', '#24b35a' );
	$bg      = devfolio_get_theme_mod_value( 'devfolio_style_bg', '#eff1f6' );

	$css  = ':root{';
	$css .= '--primary:' . sanitize_hex_color( $primary ) . ';';
	$css .= '--gradient-green:' . sanitize_hex_color( $primary ) . ';';
	$css .= '--accent:' . sanitize_hex_color( $accent ) . ';';
	$css .= '--gradient-mint:' . sanitize_hex_color( $accent ) . ';';
	$css .= '--bg:' . sanitize_hex_color( $bg ) . ';';
	$css .= '}';

	return $css;
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
	echo '<ul class="devfolio-nav-links menu-list">';
	echo '<li><a href="#experience">' . esc_html__( 'Experience', 'devfolio' ) . '</a></li>';
	echo '<li><a href="#skills">' . esc_html__( 'Skills', 'devfolio' ) . '</a></li>';
	echo '<li><a href="#projects">' . esc_html__( 'Projects', 'devfolio' ) . '</a></li>';
	echo '<li><a href="#portfolio">' . esc_html__( 'Portfolio', 'devfolio' ) . '</a></li>';
	echo '<li><a href="#services">' . esc_html__( 'Services', 'devfolio' ) . '</a></li>';
	echo '<li><a href="#process">' . esc_html__( 'Process', 'devfolio' ) . '</a></li>';
	echo '<li><a href="#blog">' . esc_html__( 'Blog', 'devfolio' ) . '</a></li>';
	echo '<li><a href="#contact">' . esc_html__( 'Contact', 'devfolio' ) . '</a></li>';
	echo '</ul>';
}

function devfolio_excerpt_text( $post_id, $length = 160 ) {
	$text = get_the_excerpt( $post_id );
	if ( empty( $text ) ) {
		$text = wp_strip_all_tags( get_post_field( 'post_content', $post_id ) );
	}
	return wp_trim_words( $text, max( 10, (int) floor( $length / 5 ) ), '...' );
}

$devfolio_includes = array(
	'/inc/helpers.php',
	'/inc/cpt/register-cpts.php',
	'/inc/cmb2/cmb2-experience.php',
	'/inc/cmb2/cmb2-portfolio.php',
	'/inc/cmb2/cmb2-events.php',
	'/inc/cmb2/cmb2-services.php',
	'/inc/cmb2/cmb2-journey.php',
	'/inc/cmb2/cmb2-testimonials.php',
	'/inc/customizer/kirki-config.php',
	'/inc/customizer/kirki-sections.php',
	'/inc/tgm/class-tgm-plugin-activation.php',
	'/inc/tgm/tgm-init.php',
);

foreach ( $devfolio_includes as $include_file ) {
	$path = get_template_directory() . $include_file;
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}
