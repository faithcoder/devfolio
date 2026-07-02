<?php
/**
 * Single portfolio item template.
 *
 * @package devfolio
 */

get_header();

$demo_item      = devfolio_get_fallback_portfolio_item( get_query_var( 'devfolio_portfolio_demo' ) );
$item_id        = '';
$item_title     = '';
$category       = '';
$summary        = '';
$overview       = '';
$techs          = array();
$live_url       = '';
$github_url     = '';
$image_url      = '';
$content_html   = '';
$portfolio_link = home_url( '/#' . devfolio_get_section_id( 'portfolio' ) );

if ( $demo_item ) {
	$item_id    = 'portfolio-demo-' . sanitize_html_class( $demo_item['slug'] );
	$item_title = $demo_item['title'];
	$category   = $demo_item['category'];
	$summary    = $demo_item['desc'];
	$overview   = $demo_item['desc'];
	$techs      = devfolio_parse_tag_list( $demo_item['tech'] );
	$live_url   = devfolio_has_valid_url( $demo_item['live'] ) ? $demo_item['live'] : '';
	$github_url = devfolio_has_valid_url( $demo_item['github'] ) ? $demo_item['github'] : '';
	$image_url  = $demo_item['image'];
} elseif ( have_posts() ) {
	the_post();

	$post_id    = get_the_ID();
	$item_id    = 'post-' . $post_id;
	$item_title = get_the_title();
	$category   = get_post_meta( $post_id, 'devfolio_portfolio_category', true );
	$summary    = get_post_meta( $post_id, 'devfolio_portfolio_short_desc', true );
	$overview   = get_post_meta( $post_id, 'devfolio_portfolio_popup_desc', true );
	$techs      = devfolio_parse_tag_list( get_post_meta( $post_id, 'devfolio_portfolio_tech', true ) );
	$live_url   = get_post_meta( $post_id, 'devfolio_portfolio_live_url', true );
	$github_url = get_post_meta( $post_id, 'devfolio_portfolio_github_url', true );
	$image_url  = devfolio_get_image_url( $post_id, 'devfolio_portfolio_image_url', 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1200&h=800&fit=crop' );

	if ( empty( $summary ) && ! empty( $overview ) ) {
		$summary = wp_trim_words( wp_strip_all_tags( $overview ), 30, '...' );
	}

	if ( empty( $summary ) ) {
		$summary = devfolio_excerpt_text( $post_id, 220 );
	}

	if ( trim( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) ) ) {
		$content_html = apply_filters( 'the_content', get_the_content() );
	}
}

if ( ! empty( $item_title ) ) :
	?>
	<section class="devfolio-section devfolio-portfolio-single-section">
		<div class="devfolio-container">
			<a class="devfolio-portfolio-back-link" href="<?php echo esc_url( $portfolio_link ); ?>">← <?php esc_html_e( 'Back to portfolio', 'devfolio' ); ?></a>

			<article id="<?php echo esc_attr( $item_id ); ?>" class="devfolio-portfolio-single">
				<div class="devfolio-portfolio-single-hero">
					<div class="devfolio-portfolio-single-media devfolio-glass">
						<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $item_title ); ?>" />
						<?php if ( ! empty( $category ) ) : ?>
						<span class="devfolio-portfolio-cat"><?php echo esc_html( $category ); ?></span>
						<?php endif; ?>
					</div>

					<div class="devfolio-portfolio-single-summary-card devfolio-glass">
						<p class="devfolio-label"><?php esc_html_e( 'Portfolio Item', 'devfolio' ); ?></p>
						<h1 class="devfolio-section-title"><?php echo esc_html( $item_title ); ?></h1>

						<?php if ( ! empty( $summary ) ) : ?>
						<p class="devfolio-portfolio-single-summary"><?php echo esc_html( $summary ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $techs ) ) : ?>
						<div class="devfolio-tech-tags">
							<?php foreach ( $techs as $tech ) : ?>
							<span class="devfolio-tech-tag"><?php echo esc_html( $tech ); ?></span>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>

						<?php if ( devfolio_has_valid_url( $live_url ) || devfolio_has_valid_url( $github_url ) ) : ?>
						<div class="devfolio-portfolio-links">
							<?php if ( devfolio_has_valid_url( $live_url ) ) : ?>
							<a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener noreferrer" class="devfolio-link-live">↗ <?php esc_html_e( 'Live Preview', 'devfolio' ); ?></a>
							<?php endif; ?>
							<?php if ( devfolio_has_valid_url( $github_url ) ) : ?>
							<a href="<?php echo esc_url( $github_url ); ?>" target="_blank" rel="noopener noreferrer" class="devfolio-link-code">⌥ <?php esc_html_e( 'Source Code', 'devfolio' ); ?></a>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="devfolio-portfolio-single-content-wrap">
					<?php if ( ! empty( $overview ) ) : ?>
					<section class="devfolio-portfolio-single-panel devfolio-glass">
						<h2><?php esc_html_e( 'Project Overview', 'devfolio' ); ?></h2>
						<div class="devfolio-job-desc"><?php echo wpautop( esc_html( $overview ) ); ?></div>
					</section>
					<?php endif; ?>

					<?php if ( ! empty( $content_html ) ) : ?>
					<section class="devfolio-portfolio-single-panel devfolio-glass">
						<h2><?php esc_html_e( 'Details', 'devfolio' ); ?></h2>
						<div class="devfolio-job-desc">
							<?php echo $content_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					</section>
					<?php endif; ?>
				</div>
			</article>
		</div>
	</section>
	<?php
endif;

get_footer();
