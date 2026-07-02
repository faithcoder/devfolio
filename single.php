<?php
/**
 * Single post template.
 *
 * @package devfolio
 */

get_header();
?>
<section class="devfolio-section" id="blog">
	<div class="devfolio-container">
		<div class="devfolio-layout-with-sidebar">
			<main class="devfolio-main-content">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'devfolio-glass' ); ?> style="padding:32px; margin-bottom: 32px;">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="devfolio-featured-image" style="margin: -32px -32px 32px -32px; overflow: hidden; border-radius: 12px 12px 0 0;">
									<?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: auto; display: block;' ) ); ?>
								</div>
							<?php endif; ?>
							
							<p class="devfolio-label"><?php echo esc_html( get_the_date( 'd F, Y' ) ); ?></p>
							<h1 class="devfolio-section-title"><?php the_title(); ?></h1>
							<div class="devfolio-job-desc"><?php the_content(); ?></div>
						</article>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>

					<?php endwhile; ?>
				<?php endif; ?>
			</main>
			
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<?php
get_footer();
