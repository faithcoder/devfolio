<?php
/**
 * Template Name: Project Details
 *
 * Case-study layout for individual portfolio project pages.
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
