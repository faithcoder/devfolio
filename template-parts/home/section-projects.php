<?php
/**
 * Homepage projects and events section.
 *
 * @package devfolio
 */

$featured_label = devfolio_get_theme_mod_value( 'devfolio_featured_label', 'Featured Project' );
$featured_title = devfolio_get_theme_mod_value( 'devfolio_featured_title', 'WPReactPanel' );
$featured_desc  = devfolio_get_theme_mod_value( 'devfolio_featured_desc', 'A modern WordPress React Admin Settings Builder using React, ShadCN UI, and TypeScript. A new way to build beautiful admin panels for WordPress plugins.' );
$featured_tags  = devfolio_parse_tag_list( devfolio_get_theme_mod_value( 'devfolio_featured_tags', 'React, TypeScript, ShadCN UI, WordPress' ) );
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
			array( 'title' => 'Core Contributor', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>' ),
			array( 'title' => 'Docs Contributor', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>' ),
			array( 'title' => 'Meetup Organizer', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>' ),
			array( 'title' => 'Plugin Developer', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="6" x2="6" y1="3" y2="15"/><circle cx="18" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M18 9a9 9 0 0 1-9 9"/></svg>' ),
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

if ( ! $show_featured && empty( $contrib_items ) && empty( $events ) ) {
	return;
}
?>
<!-- Projects -->
<section id="projects" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">Open Source</p>
    <h2 class="devfolio-section-title devfolio-anim">Contributions & Projects</h2>
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
