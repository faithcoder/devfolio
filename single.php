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
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'devfolio-glass' ); ?> style="padding:32px;">
					<p class="devfolio-label"><?php echo esc_html( get_the_date( 'd F, Y' ) ); ?></p>
					<h1 class="devfolio-section-title"><?php the_title(); ?></h1>
					<div class="devfolio-job-desc"><?php the_content(); ?></div>
				</article>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
