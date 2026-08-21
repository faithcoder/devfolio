<?php
/**
 * Template Name: Plugin Details
 *
 * Funnel-style layout for individual plugin pages.
 *
 * @package devfolio
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
endif;

get_footer();
