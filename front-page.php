<?php
/**
 * Front page template.
 *
 * @package devfolio
 */

get_header();

$section_slugs = array(
	'hero',
	'experience',
	'about',
	'skills',
	'projects',
	'portfolio',
	'services',
	'process',
	'origin',
	'blog',
	'testimonials',
	'contact',
);

$rendered_sections = array();
foreach ( $section_slugs as $slug ) {
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
