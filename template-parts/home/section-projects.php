<?php
/**
 * Homepage projects and events section.
 *
 * @package devfolio
 */

$featured_label = devfolio_get_theme_mod_value( 'devfolio_featured_label', 'Support Impact' );
$featured_title = devfolio_get_theme_mod_value( 'devfolio_featured_title', 'WordPress Product Support at Scale' );
$featured_desc  = devfolio_get_theme_mod_value( 'devfolio_featured_desc', 'Supported 6,000+ unique users across CRM, live chat, and WordPress forums. Delivered fast, clear resolutions for plugin conflicts, licensing, migrations, and compatibility issues.' );
$featured_tags  = devfolio_parse_tag_list( devfolio_get_theme_mod_value( 'devfolio_featured_tags', 'WordPress Support, WooCommerce, Elementor, Documentation, Debugging' ) );
$contrib_items  = devfolio_get_repeater_value( 'devfolio_contributions', array() );

$contrib_items = array_values(
	array_filter(
		(array) $contrib_items,
		static function ( $item ) {
			return '' !== trim( (string) ( $item['title'] ?? '' ) ) || '' !== trim( (string) ( $item['icon_image'] ?? '' ) );
		}
	)
);

if ( null === get_theme_mod( 'devfolio_contributions', null ) ) {
	$contrib_items = array(
			array( 'title' => 'Support Engineer', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 18v-6a9 9 0 1 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1v-7h3z"/><path d="M3 14h3v7H5a2 2 0 0 1-2-2z"/></svg>' ),
			array( 'title' => 'Documentation Writer', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M8 13h8"/><path d="M8 17h8"/><path d="M8 9h2"/></svg>' ),
			array( 'title' => 'WordPress Contributor', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2.1 12.1 7 21l4-9"/><path d="m14.6 21 3.4-7.3c.6-1.3.9-2.4.9-3.5"/></svg>' ),
			array( 'title' => 'Video Tutorials', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58"/><path d="m10 15 5-3-5-3z"/></svg>' ),
		);
}

$event_fallback = array(
	array( 'src' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&h=500&fit=crop', 'title' => 'WordCamp Asia 2025', 'loc' => 'Manila, Philippines' ),
	array( 'src' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800&h=500&fit=crop', 'title' => 'Community Meetup', 'loc' => 'Rangpur, Bangladesh' ),
	array( 'src' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=800&h=500&fit=crop', 'title' => 'Tech Conference Talk', 'loc' => 'Speaker Session' ),
	array( 'src' => 'https://images.unsplash.com/photo-1591115765373-5f9cf1da241c?w=800&h=500&fit=crop', 'title' => 'WordPress Workshop', 'loc' => 'Hands-on Training' ),
	array( 'src' => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=800&h=500&fit=crop', 'title' => 'Contributor Day', 'loc' => 'Open Source Sprint' ),
	array( 'src' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800&h=500&fit=crop', 'title' => 'Networking Event', 'loc' => 'Developer Community' ),
);

$events_query = new WP_Query(
	array(
		'post_type'      => 'devfolio_event',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);

$events = array();
if ( $events_query->have_posts() ) {
	while ( $events_query->have_posts() ) {
		$events_query->the_post();
		$events[] = array(
			'src'   => devfolio_get_image_url( get_the_ID(), 'devfolio_event_image_url', 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&h=500&fit=crop' ),
			'title' => get_the_title(),
			'loc'   => get_post_meta( get_the_ID(), 'devfolio_event_location', true ),
		);
	}
	wp_reset_postdata();
}

if ( empty( $events ) ) {
	$events = $event_fallback;
}

$show_featured = '' !== trim( (string) $featured_label ) || '' !== trim( (string) $featured_title ) || '' !== trim( (string) $featured_desc ) || ! empty( $featured_tags );
$section_id    = devfolio_get_section_id( 'projects' );

if ( ! $show_featured && empty( $contrib_items ) && empty( $events ) ) {
	return;
}
?>
<!-- Projects -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">Open Source</p>
    <h2 class="devfolio-section-title devfolio-anim">Contributions & Support Work</h2>
    <?php if ( $show_featured ) : ?>
    <div class="devfolio-featured-project devfolio-glass devfolio-anim">
      <div class="devfolio-content">
        <?php if ( ! empty( $featured_label ) ) : ?>
        <span class="devfolio-featured-label"><?php echo esc_html( $featured_label ); ?></span>
        <?php endif; ?>
        <?php if ( ! empty( $featured_title ) ) : ?>
        <h3><?php echo esc_html( $featured_title ); ?></h3>
        <?php endif; ?>
        <?php if ( ! empty( $featured_desc ) ) : ?>
        <p><?php echo esc_html( $featured_desc ); ?></p>
        <?php endif; ?>
        <?php if ( ! empty( $featured_tags ) ) : ?>
        <div class="devfolio-tech-tags">
          <?php foreach ( $featured_tags as $tag ) : ?>
          <span class="devfolio-tech-tag"><?php echo esc_html( $tag ); ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>
    <?php if ( ! empty( $contrib_items ) ) : ?>
    <div class="devfolio-contrib-grid">
      <?php foreach ( $contrib_items as $item ) : ?>
      <div class="devfolio-contrib-card devfolio-glass devfolio-anim"><div class="devfolio-contrib-icon"><?php echo devfolio_render_icon( $item['icon_image'] ?? '', $item['icon_svg'] ?? '', $item['title'] ?? 'Icon' ); ?></div><span><?php echo esc_html( $item['title'] ?? '' ); ?></span></div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if ( ! empty( $events ) ) : ?>
    <!-- Events & Conferences Carousel -->
    <div class="devfolio-events-section devfolio-anim">
      <h3 class="devfolio-events-title">Events & Conferences</h3>
      <p class="devfolio-events-subtitle">Moments from WordCamps, meetups, and community events</p>

      <div class="devfolio-carousel-wrap">
        <div class="devfolio-carousel-viewport">
          <div class="devfolio-carousel-track">
            <?php foreach ( $events as $index => $event ) : ?>
            <div class="devfolio-carousel-slide" data-slide="<?php echo esc_attr( $index ); ?>" data-src="<?php echo esc_url( $event['src'] ); ?>" data-title="<?php echo esc_attr( $event['title'] ); ?>" data-loc="<?php echo esc_attr( $event['loc'] ); ?>">
              <div class="devfolio-carousel-card devfolio-glass">
                <div class="devfolio-carousel-img-wrap"><img src="<?php echo esc_url( $event['src'] ); ?>" alt="<?php echo esc_attr( $event['title'] ); ?>" loading="lazy"/><div class="devfolio-carousel-img-overlay"></div><div class="devfolio-carousel-caption"><p class="devfolio-carousel-caption-title"><?php echo esc_html( $event['title'] ); ?></p><p class="devfolio-carousel-caption-loc"><?php echo esc_html( $event['loc'] ); ?></p></div></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <button class="devfolio-carousel-btn devfolio-carousel-prev" aria-label="Previous">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="devfolio-carousel-btn devfolio-carousel-next" aria-label="Next">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>
      </div>
      <div class="devfolio-carousel-dots"></div>
    </div>

    <!-- Lightbox for Events -->
    <div class="devfolio-events-lightbox">
      <div class="devfolio-events-lightbox-inner">
        <button class="devfolio-lightbox-btn devfolio-lightbox-close devfolio-events-lightbox-close" aria-label="Close">✕</button>
        <img class="devfolio-events-lightbox-img" src="" alt=""/>
        <div class="devfolio-events-lightbox-info">
          <p class="devfolio-events-lightbox-title"></p>
          <p class="devfolio-events-lightbox-loc"></p>
        </div>
        <button class="devfolio-lightbox-btn devfolio-events-lightbox-prev" aria-label="Previous">‹</button>
        <button class="devfolio-lightbox-btn devfolio-events-lightbox-next" aria-label="Next">›</button>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
