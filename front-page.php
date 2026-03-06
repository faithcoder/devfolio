<?php
/**
 * Front page template.
 *
 * @package devfolio
 */

get_header();

get_template_part( 'template-parts/home/section', 'hero' );
echo '<div class="devfolio-glow-line"></div>';

get_template_part( 'template-parts/home/section', 'experience' );
echo '<div class="devfolio-glow-line"></div>';

get_template_part( 'template-parts/home/section', 'skills' );
echo '<div class="devfolio-glow-line"></div>';

get_template_part( 'template-parts/home/section', 'projects' );
echo '<div class="devfolio-glow-line"></div>';

get_template_part( 'template-parts/home/section', 'portfolio' );
echo '<div class="devfolio-glow-line"></div>';

get_template_part( 'template-parts/home/section', 'services' );
echo '<div class="devfolio-glow-line"></div>';

get_template_part( 'template-parts/home/section', 'process' );
echo '<div class="devfolio-glow-line"></div>';

get_template_part( 'template-parts/home/section', 'origin' );
echo '<div class="devfolio-glow-line"></div>';

get_template_part( 'template-parts/home/section', 'blog' );
echo '<div class="devfolio-glow-line"></div>';

get_template_part( 'template-parts/home/section', 'contact' );

get_footer();
