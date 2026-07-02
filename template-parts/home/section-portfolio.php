<?php
/**
 * Homepage portfolio section.
 *
 * @package devfolio
 */

$portfolio_query = new WP_Query(
	array(
		'post_type'      => 'devfolio_portfolio',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);

$fallback_items = devfolio_get_fallback_portfolio_items();

$items = array();

if ( $portfolio_query->have_posts() ) {
	while ( $portfolio_query->have_posts() ) {
		$portfolio_query->the_post();
		$short_desc = get_post_meta( get_the_ID(), 'devfolio_portfolio_short_desc', true );
		$full_desc  = get_post_meta( get_the_ID(), 'devfolio_portfolio_popup_desc', true );

		$items[] = array(
			'title'     => get_the_title(),
			'category'  => get_post_meta( get_the_ID(), 'devfolio_portfolio_category', true ),
			'image'     => devfolio_get_image_url( get_the_ID(), 'devfolio_portfolio_image_url', 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&h=400&fit=crop' ),
			'desc'      => $short_desc ? $short_desc : $full_desc,
			'tech'      => get_post_meta( get_the_ID(), 'devfolio_portfolio_tech', true ),
			'live'      => get_post_meta( get_the_ID(), 'devfolio_portfolio_live_url', true ),
			'github'    => get_post_meta( get_the_ID(), 'devfolio_portfolio_github_url', true ),
			'permalink' => get_permalink(),
		);
	}
	wp_reset_postdata();
}

$portfolio_label = devfolio_get_theme_mod_value( 'devfolio_portfolio_label', 'Portfolio' );
$portfolio_title = devfolio_get_theme_mod_value( 'devfolio_portfolio_title', 'Featured Projects' );
$portfolio_desc  = devfolio_get_theme_mod_value( 'devfolio_portfolio_desc', 'A selection of WordPress themes, plugins, and contributions built over the years.' );

if ( empty( $items ) ) {
	$items = $fallback_items;
}
$section_id = devfolio_get_section_id( 'portfolio' );
?>
<!-- Portfolio -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim"><?php echo esc_html( $portfolio_label ); ?></p>
    <h2 class="devfolio-section-title devfolio-anim"><?php echo esc_html( $portfolio_title ); ?></h2>
    <?php if ( ! empty( $portfolio_desc ) ) : ?>
    <p class="devfolio-portfolio-section-desc devfolio-anim"><?php echo esc_html( $portfolio_desc ); ?></p>
    <?php endif; ?>
    <div class="devfolio-portfolio-grid">
      <?php foreach ( $items as $item ) : ?>
      <?php $techs = devfolio_parse_tag_list( $item['tech'] ?? '' ); ?>
      <?php $is_linked = ! empty( $item['permalink'] ); ?>
      <?php $card_class = 'devfolio-portfolio-card devfolio-glass devfolio-anim' . ( $is_linked ? '' : ' devfolio-portfolio-card-static' ); ?>
      <?php if ( $is_linked ) : ?>
      <a class="<?php echo esc_attr( $card_class ); ?>" href="<?php echo esc_url( $item['permalink'] ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View portfolio item: %s', 'devfolio' ), $item['title'] ) ); ?>">
      <?php else : ?>
      <div class="<?php echo esc_attr( $card_class ); ?>">
      <?php endif; ?>
        <div class="devfolio-portfolio-thumb"><img src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy"/><span class="devfolio-portfolio-cat"><?php echo esc_html( $item['category'] ); ?></span></div>
        <div class="devfolio-portfolio-info">
          <h3><?php echo esc_html( $item['title'] ); ?></h3>
          <?php if ( ! empty( $item['desc'] ) ) : ?>
          <p class="devfolio-portfolio-summary"><?php echo esc_html( $item['desc'] ); ?></p>
          <?php endif; ?>
          <div class="devfolio-tech-tags"><?php foreach ( array_slice( $techs, 0, 3 ) as $tech ) : ?><span class="devfolio-tech-tag"><?php echo esc_html( $tech ); ?></span><?php endforeach; ?></div>
        </div>
      <?php if ( $is_linked ) : ?>
      </a>
      <?php else : ?>
      </div>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
