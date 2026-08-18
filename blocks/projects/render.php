<?php
/**
 * Homepage contributions and events section.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$featured_label = devfolio_get_block_attr( $args, 'featuredLabel', 'Full Stack Development' );
$featured_title = devfolio_get_block_attr( $args, 'featuredTitle', 'Built Scalable Apps for REALTY.COM' );
$featured_desc  = devfolio_get_block_attr( $args, 'featuredDesc', 'Developing and maintaining mobile applications and robust back-ends for scale. Writing unit tests, designing application architecture, and crafting APIs to serve over 1,000,000+ real estate listings.' );
$featured_tags  = devfolio_parse_tag_list( devfolio_get_block_attr( $args, 'featuredTags', 'React Native, Node.js, Laravel, Mobile App, Architecture' ) );
$contrib_items  = devfolio_get_block_array_attr(
	$args,
	'contributionItems',
	array(
		array( 'title' => 'WooCommerce Support', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 6h15l-1.5 9h-12z"/><path d="M6 6 4 3H2"/><circle cx="9" cy="20" r="1"/><circle cx="18" cy="20" r="1"/></svg>' ),
		array( 'title' => 'Theme Development', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 5h16v14H4z"/><path d="M4 9h16"/></svg>' ),
		array( 'title' => 'Plugin Maintenance', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m7 7 3-3 7 7-3 3"/><path d="M4 20l6-6"/><path d="m14 10 6-6"/></svg>' ),
	)
);
$contributions_label = devfolio_get_block_attr( $args, 'label', 'Open Source' );
$contributions_title = devfolio_get_block_attr( $args, 'titleText', 'Contributions & Support Work' );
$contributions_desc  = devfolio_get_block_attr( $args, 'desc', '' );
$events_title        = devfolio_get_block_attr( $args, 'eventsTitle', 'Events & Conferences' );
$events_subtitle     = devfolio_get_block_attr( $args, 'eventsSubtitle', 'Moments from WordCamps, meetups, and community events' );
$events              = devfolio_get_block_array_attr( $args, 'events', array(
	array( 'src' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&h=500&fit=crop', 'title' => 'Computer Science Education Week', 'loc' => 'Trainer / Speaker' ),
	array( 'src' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800&h=500&fit=crop', 'title' => 'Hour of Code', 'loc' => 'Local Tech Meetup' ),
	array( 'src' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=800&h=500&fit=crop', 'title' => 'React & Node.js Conference', 'loc' => 'Attendee' ),
) );
$section_id = devfolio_get_block_section_id( $args, 'projects' );
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim"><?php echo esc_html( $contributions_label ); ?></p>
    <h2 class="devfolio-section-title devfolio-anim"><?php echo esc_html( $contributions_title ); ?></h2>
    <?php if ( ! empty( $contributions_desc ) ) : ?><p class="devfolio-section-desc devfolio-anim"><?php echo esc_html( $contributions_desc ); ?></p><?php endif; ?>
    <?php if ( ! empty( $featured_label ) || ! empty( $featured_title ) || ! empty( $featured_desc ) ) : ?><div class="devfolio-featured-project devfolio-glass devfolio-anim"><div class="devfolio-content"><?php if ( ! empty( $featured_label ) ) : ?><span class="devfolio-featured-label"><?php echo esc_html( $featured_label ); ?></span><?php endif; ?><?php if ( ! empty( $featured_title ) ) : ?><h3><?php echo esc_html( $featured_title ); ?></h3><?php endif; ?><?php if ( ! empty( $featured_desc ) ) : ?><p><?php echo esc_html( $featured_desc ); ?></p><?php endif; ?><?php if ( ! empty( $featured_tags ) ) : ?><div class="devfolio-tech-tags"><?php foreach ( $featured_tags as $tag ) : ?><span class="devfolio-tech-tag"><?php echo esc_html( $tag ); ?></span><?php endforeach; ?></div><?php endif; ?></div></div><?php endif; ?>
    <?php if ( ! empty( $contrib_items ) ) : ?><div class="devfolio-contrib-grid"><?php foreach ( $contrib_items as $item ) : ?><div class="devfolio-contrib-card devfolio-glass devfolio-anim"><div class="devfolio-contrib-icon"><?php echo devfolio_render_icon( $item['icon_image'] ?? '', $item['icon_svg'] ?? '', $item['title'] ?? 'Icon' ); ?></div><span><?php echo esc_html( $item['title'] ?? '' ); ?></span></div><?php endforeach; ?></div><?php endif; ?>
    <?php if ( ! empty( $events ) ) : ?><div class="devfolio-events-section devfolio-anim"><h3 class="devfolio-events-title"><?php echo esc_html( $events_title ); ?></h3><?php if ( ! empty( $events_subtitle ) ) : ?><p class="devfolio-events-subtitle"><?php echo esc_html( $events_subtitle ); ?></p><?php endif; ?><div class="devfolio-carousel" data-carousel-lightbox="events"><div class="devfolio-carousel-wrap"><div class="devfolio-carousel-viewport"><div class="devfolio-carousel-track"><?php foreach ( $events as $index => $event ) : ?><div class="devfolio-carousel-slide" data-slide="<?php echo esc_attr( $index ); ?>" data-src="<?php echo esc_url( $event['src'] ?? '' ); ?>" data-title="<?php echo esc_attr( $event['title'] ?? '' ); ?>" data-subtitle="<?php echo esc_attr( $event['loc'] ?? '' ); ?>"><div class="devfolio-carousel-card devfolio-glass"><div class="devfolio-carousel-img-wrap"><img src="<?php echo esc_url( $event['src'] ?? '' ); ?>" alt="<?php echo esc_attr( $event['title'] ?? '' ); ?>" loading="lazy"/><div class="devfolio-carousel-img-overlay"></div><div class="devfolio-carousel-caption"><p class="devfolio-carousel-caption-title"><?php echo esc_html( $event['title'] ?? '' ); ?></p><p class="devfolio-carousel-caption-subtitle devfolio-carousel-caption-loc"><?php echo esc_html( $event['loc'] ?? '' ); ?></p></div></div></div></div><?php endforeach; ?></div></div><button class="devfolio-carousel-btn devfolio-carousel-prev" aria-label="Previous"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg></button><button class="devfolio-carousel-btn devfolio-carousel-next" aria-label="Next"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></button></div><div class="devfolio-carousel-dots"></div></div></div><?php endif; ?>
  </div>
</section>
