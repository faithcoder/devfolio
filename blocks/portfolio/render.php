<?php
/**
 * Homepage portfolio section.
 *
 * @package devfolio
 */

$args            = isset( $args ) && is_array( $args ) ? $args : array();
$fallback_items  = devfolio_get_fallback_portfolio_items();
$items           = devfolio_get_block_array_attr( $args, 'items', $fallback_items );
$portfolio_label = devfolio_get_block_attr( $args, 'label', 'Portfolio' );
$portfolio_title = devfolio_get_block_attr( $args, 'titleText', 'Featured Projects' );
$portfolio_desc  = devfolio_get_block_attr( $args, 'desc', 'A selection of WordPress themes, plugins, and contributions built over the years.' );
$section_id      = devfolio_get_block_section_id( $args, 'portfolio' );
?>
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
      <div class="devfolio-portfolio-card devfolio-glass devfolio-anim devfolio-portfolio-card-static">
        <div class="devfolio-portfolio-thumb"><img src="<?php echo esc_url( $item['image'] ?? '' ); ?>" alt="<?php echo esc_attr( $item['title'] ?? '' ); ?>" loading="lazy"/><span class="devfolio-portfolio-cat"><?php echo esc_html( $item['category'] ?? '' ); ?></span></div>
        <div class="devfolio-portfolio-info">
          <h3><?php echo esc_html( $item['title'] ?? '' ); ?></h3>
          <?php if ( ! empty( $item['desc'] ) ) : ?>
          <p class="devfolio-portfolio-summary"><?php echo esc_html( $item['desc'] ); ?></p>
          <?php endif; ?>
          <div class="devfolio-tech-tags"><?php foreach ( array_slice( $techs, 0, 3 ) as $tech ) : ?><span class="devfolio-tech-tag"><?php echo esc_html( $tech ); ?></span><?php endforeach; ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
