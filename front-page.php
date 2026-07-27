<?php
/**
 * Front page template.
 *
 * @package devfolio
 */

get_header();

$post_content = get_post_field( 'post_content', get_the_ID() );
$blocks       = has_blocks( $post_content ) ? parse_blocks( $post_content ) : array();

echo devfolio_render_home_blocks( $blocks ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

get_footer();
