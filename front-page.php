<?php
/**
 * Front page template.
 *
 * @package devfolio
 */

get_header();

$default_sections = array_keys( devfolio_get_section_defaults() );

// 1. Get ordered sections from Customizer, fallback to defaults
$section_order = devfolio_get_theme_mod_value( 'devfolio_home_sections_order', $default_sections );

if ( ! is_array( $section_order ) || empty( $section_order ) ) {
	$section_order = $default_sections;
}

// 2. Ensure no newly added sections are completely missing
$missing_sections = array_diff( $default_sections, $section_order );
if ( ! empty( $missing_sections ) ) {
	$section_order = array_merge( $section_order, $missing_sections );
}

$rendered_sections = array();

// 3. Loop through sections based on the sorted order and check toggles
foreach ( $section_order as $slug ) {
	// Check if this section is enabled (default is true)
	$is_enabled = devfolio_get_theme_mod_value( 'devfolio_enable_' . $slug, true );
	
	if ( ! $is_enabled ) {
		continue;
	}

	ob_start();
	get_template_part( 'template-parts/home/section', $slug );
	$section_html = trim( ob_get_clean() );
	
	if ( '' !== $section_html ) {
		$rendered_sections[] = $section_html;
	}
}

foreach ( $rendered_sections as $index => $section_html ) {
	echo $section_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	if ( $index < count( $rendered_sections ) - 1 ) {
		echo '<div class="devfolio-glow-line"></div>';
	}
}

get_footer();
