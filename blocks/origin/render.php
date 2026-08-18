<?php
/**
 * Homepage journey/origin section.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$journey_items = devfolio_get_block_array_attr(
	$args,
	'items',
	array(
		array( 'year' => '2016', 'title' => 'Start Exploring', 'desc' => 'Began my journey with a Diploma in Telecommunication Engineering at Jashore Polytechnic Institute.', 'position' => 'top' ),
		array( 'year' => '2018', 'title' => 'First Tech Role', 'desc' => 'Joined LinkingCC as a Junior Software Engineer, contributing to over 20+ live web projects.', 'position' => 'bottom' ),
		array( 'year' => '2019', 'title' => 'International Exposure', 'desc' => 'Worked with Denmark-based TF INTERNET ApS, handling client products and full-stack development.', 'position' => 'top' ),
		array( 'year' => '2021', 'title' => 'E-Commerce & Medical', 'desc' => 'Transitioned to EXPRESS SYSTEMS & PARTS NETWORK INC., building mobile apps and complex architectures.', 'position' => 'bottom' ),
		array( 'year' => '2022', 'title' => 'Scaling at REALTY.COM', 'desc' => 'Joined REALTY.COM as a Software Engineer, scaling their infrastructure for over 1M+ active property listings.', 'position' => 'top' ),
	)
);

$section_id   = devfolio_get_block_section_id( $args, 'origin' );
$origin_label = devfolio_get_block_attr( $args, 'label', 'Origin Story' );
$origin_title = devfolio_get_block_attr( $args, 'titleText', 'My Journey' );
$origin_desc  = devfolio_get_block_attr( $args, 'desc', '' );
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim"><?php echo esc_html( $origin_label ); ?></p>
    <h2 class="devfolio-section-title devfolio-anim"><?php echo esc_html( $origin_title ); ?></h2>
    <?php if ( ! empty( $origin_desc ) ) : ?><p class="devfolio-section-desc devfolio-anim"><?php echo esc_html( $origin_desc ); ?></p><?php endif; ?>
    <div class="devfolio-zigzag-road devfolio-anim">
      <div class="devfolio-road-line"></div>
      <div class="devfolio-road-line-dash"></div>
      <div class="devfolio-zigzag-scooter"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="5" cy="19" r="2.5"/><circle cx="19" cy="19" r="2.5"/><path d="M7.5 19H16.5"/><path d="M19 16.5V12L15 8H12V12H7.5L5 16.5"/><path d="M15 8L17 5"/></svg></div>
      <div class="devfolio-zigzag-grid">
        <?php foreach ( $journey_items as $item ) : $is_top = 'bottom' !== ( $item['position'] ?? 'top' ); ?>
          <?php if ( $is_top ) : ?>
        <div class="devfolio-zigzag-item devfolio-zigzag-top devfolio-anim"><div class="devfolio-zigzag-card devfolio-glass"><span class="devfolio-origin-year"><?php echo esc_html( $item['year'] ?? '' ); ?></span><h3><?php echo esc_html( $item['title'] ?? '' ); ?></h3><p class="devfolio-job-desc"><?php echo esc_html( $item['desc'] ?? '' ); ?></p></div><div class="devfolio-zigzag-connector"></div><div class="devfolio-zigzag-dot"></div></div>
          <?php else : ?>
        <div class="devfolio-zigzag-item devfolio-zigzag-bottom devfolio-anim"><div class="devfolio-zigzag-dot"></div><div class="devfolio-zigzag-connector"></div><div class="devfolio-zigzag-card devfolio-glass"><span class="devfolio-origin-year"><?php echo esc_html( $item['year'] ?? '' ); ?></span><h3><?php echo esc_html( $item['title'] ?? '' ); ?></h3><p class="devfolio-job-desc"><?php echo esc_html( $item['desc'] ?? '' ); ?></p></div></div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
