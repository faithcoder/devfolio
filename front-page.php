<?php
/**
 * Front page template.
 *
 * @package devfolio
 */

get_header();

if ( 'page' === get_option( 'show_on_front' ) && have_posts() ) {
	while ( have_posts() ) {
		the_post();
		echo devfolio_render_home_content( get_the_content() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
} else {
	echo devfolio_render_home_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

get_footer();
