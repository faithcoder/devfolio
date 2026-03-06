<?php
/**
 * Homepage journey/origin section.
 *
 * @package devfolio
 */

$journey_query = new WP_Query(
	array(
		'post_type'      => 'devfolio_journey',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
	)
);

$journey_items = array();
if ( $journey_query->have_posts() ) {
	while ( $journey_query->have_posts() ) {
		$journey_query->the_post();
		$journey_items[] = array(
			'year'     => get_post_meta( get_the_ID(), 'devfolio_journey_year', true ),
			'title'    => get_the_title(),
			'desc'     => get_post_meta( get_the_ID(), 'devfolio_journey_desc', true ),
			'position' => get_post_meta( get_the_ID(), 'devfolio_journey_position', true ),
		);
	}
	wp_reset_postdata();
}

if ( empty( $journey_items ) ) {
	$journey_items = array(
		array( 'year' => '2012', 'title' => 'The Beginning', 'desc' => 'Started with small WordPress customizations, discovering the ecosystem.', 'position' => 'top' ),
		array( 'year' => '2013', 'title' => 'First Plugin', 'desc' => 'Published first plugin on WordPress.org, entering open-source development.', 'position' => 'bottom' ),
		array( 'year' => '2019', 'title' => 'Community Builder', 'desc' => 'Founded the Rangpur WordPress Meetup chapter, organizing 27+ events.', 'position' => 'top' ),
		array( 'year' => '2025', 'title' => 'Global Stage', 'desc' => 'Attended WordCamp Asia and wrapped up tenure at InstaWP after leading the engineering team.', 'position' => 'bottom' ),
		array( 'year' => '2026', 'title' => "What's Next", 'desc' => "Exploring 'vibe coding' and seeking the next long-term architectural role.", 'position' => 'top' ),
	);
}
?>
<!-- Origin Timeline - Zigzag Road -->
<section class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">Origin Story</p>
    <h2 class="devfolio-section-title devfolio-anim">My Journey</h2>
    <div class="devfolio-zigzag-road devfolio-anim">
      <!-- Straight horizontal road line -->
      <div class="devfolio-road-line"></div>
      <div class="devfolio-road-line-dash"></div>
      <!-- Scooter icon -->
      <div class="devfolio-zigzag-scooter">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="5" cy="19" r="2.5"/><circle cx="19" cy="19" r="2.5"/>
          <path d="M7.5 19H16.5"/><path d="M19 16.5V12L15 8H12V12H7.5L5 16.5"/><path d="M15 8L17 5"/>
        </svg>
      </div>
      <!-- Cards -->
      <div class="devfolio-zigzag-grid">
        <?php foreach ( $journey_items as $item ) : ?>
          <?php $is_top = 'bottom' !== ( $item['position'] ?? 'top' ); ?>
          <?php if ( $is_top ) : ?>
        <div class="devfolio-zigzag-item devfolio-zigzag-top devfolio-anim"><div class="devfolio-zigzag-card devfolio-glass"><span class="devfolio-origin-year"><?php echo esc_html( $item['year'] ); ?></span><h3><?php echo esc_html( $item['title'] ); ?></h3><p class="devfolio-job-desc"><?php echo esc_html( $item['desc'] ); ?></p></div><div class="devfolio-zigzag-connector"></div><div class="devfolio-zigzag-dot"></div></div>
          <?php else : ?>
        <div class="devfolio-zigzag-item devfolio-zigzag-bottom devfolio-anim"><div class="devfolio-zigzag-dot"></div><div class="devfolio-zigzag-connector"></div><div class="devfolio-zigzag-card devfolio-glass"><span class="devfolio-origin-year"><?php echo esc_html( $item['year'] ); ?></span><h3><?php echo esc_html( $item['title'] ); ?></h3><p class="devfolio-job-desc"><?php echo esc_html( $item['desc'] ); ?></p></div></div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
