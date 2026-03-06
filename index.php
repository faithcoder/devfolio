<?php
/**
 * Main index template.
 *
 * @package devfolio
 */

get_header();
?>
<section class="devfolio-section" id="blog">
	<div class="devfolio-container">
		<p class="devfolio-label devfolio-anim"><?php esc_html_e( 'Blog', 'devfolio' ); ?></p>
		<h1 class="devfolio-section-title devfolio-anim"><?php esc_html_e( 'Latest Articles', 'devfolio' ); ?></h1>
		<div class="devfolio-blog-grid">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'post-card' );
				endwhile;
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
		<?php the_posts_pagination(); ?>
	</div>
</section>
<?php
get_footer();
