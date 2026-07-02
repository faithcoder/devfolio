<?php
/**
 * Homepage projects and events section.
 *
 * @package devfolio
 */

$featured_label = devfolio_get_theme_mod_value( 'devfolio_featured_label', 'Full Stack Development' );
$featured_title = devfolio_get_theme_mod_value( 'devfolio_featured_title', 'Built Scalable Apps for REALTY.COM' );
$featured_desc  = devfolio_get_theme_mod_value( 'devfolio_featured_desc', 'Developing and maintaining mobile applications and robust back-ends for scale. Writing unit tests, designing application architecture, and crafting APIs to serve over 1,000,000+ real estate listings.' );
$featured_tags  = devfolio_parse_tag_list( devfolio_get_theme_mod_value( 'devfolio_featured_tags', 'React Native, Node.js, Laravel, Mobile App, Architecture' ) );
$contrib_items  = devfolio_get_repeater_value( 'devfolio_contributions', array() );
$contributions_label = devfolio_get_theme_mod_value( 'devfolio_contributions_label', 'Open Source' );
$contributions_title = devfolio_get_theme_mod_value( 'devfolio_contributions_title', 'Contributions & Support Work' );
$contributions_desc  = devfolio_get_theme_mod_value( 'devfolio_contributions_desc', '' );
$events_title        = devfolio_get_theme_mod_value( 'devfolio_events_title', 'Events & Conferences' );
$events_subtitle     = devfolio_get_theme_mod_value( 'devfolio_events_subtitle', 'Moments from WordCamps, meetups, and community events' );

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
			array( 'title' => 'Mobile App Developer', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 18h.01M8 21h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2z"/></svg>' ),
			array( 'title' => 'Backend Architect', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5v14"/></svg>' ),
			array( 'title' => 'Frontend Engineer', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>' ),
			array( 'title' => 'Database Designer', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>' ),
		);
}

$event_fallback = array(
	array( 'src' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&h=500&fit=crop', 'title' => 'Computer Science Education Week', 'loc' => 'Trainer / Speaker' ),
	array( 'src' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800&h=500&fit=crop', 'title' => 'Hour of Code', 'loc' => 'Local Tech Meetup' ),
	array( 'src' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=800&h=500&fit=crop', 'title' => 'React & Node.js Conference', 'loc' => 'Attendee' ),
	array( 'src' => 'https://images.unsplash.com/photo-1591115765373-5f9cf1da241c?w=800&h=500&fit=crop', 'title' => 'Laravel Developer Summit', 'loc' => 'Online Summit' ),
	array( 'src' => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=800&h=500&fit=crop', 'title' => 'Hackathon Mentor', 'loc' => 'Bangladesh Open Source' ),
	array( 'src' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800&h=500&fit=crop', 'title' => 'Local Developer Community', 'loc' => 'Rajshahi / Jessore' ),
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
    <p class="devfolio-label devfolio-anim"><?php echo esc_html( $contributions_label ); ?></p>
    <h2 class="devfolio-section-title devfolio-anim"><?php echo esc_html( $contributions_title ); ?></h2>
    <?php if ( ! empty( $contributions_desc ) ) : ?>
    <p class="devfolio-section-desc devfolio-anim"><?php echo esc_html( $contributions_desc ); ?></p>
    <?php endif; ?>
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
      <h3 class="devfolio-events-title"><?php echo esc_html( $events_title ); ?></h3>
      <?php if ( ! empty( $events_subtitle ) ) : ?>
      <p class="devfolio-events-subtitle"><?php echo esc_html( $events_subtitle ); ?></p>
      <?php endif; ?>

      <div class="devfolio-carousel" data-carousel-lightbox="events">
        <div class="devfolio-carousel-wrap">
          <div class="devfolio-carousel-viewport">
            <div class="devfolio-carousel-track">
              <?php foreach ( $events as $index => $event ) : ?>
              <div class="devfolio-carousel-slide" data-slide="<?php echo esc_attr( $index ); ?>" data-src="<?php echo esc_url( $event['src'] ); ?>" data-title="<?php echo esc_attr( $event['title'] ); ?>" data-subtitle="<?php echo esc_attr( $event['loc'] ); ?>">
                <div class="devfolio-carousel-card devfolio-glass">
                  <div class="devfolio-carousel-img-wrap"><img src="<?php echo esc_url( $event['src'] ); ?>" alt="<?php echo esc_attr( $event['title'] ); ?>" loading="lazy"/><div class="devfolio-carousel-img-overlay"></div><div class="devfolio-carousel-caption"><p class="devfolio-carousel-caption-title"><?php echo esc_html( $event['title'] ); ?></p><p class="devfolio-carousel-caption-subtitle devfolio-carousel-caption-loc"><?php echo esc_html( $event['loc'] ); ?></p></div></div>
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
    </div>

    <?php endif; ?>
  </div>
</section>
