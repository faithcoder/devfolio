<?php
/**
 * Homepage testimonials section.
 *
 * @package devfolio
 */

$args       = isset( $args ) && is_array( $args ) ? $args : array();
$quote_icon = '<svg class="devfolio-testimonial-quote" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V21z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3z"/></svg>';
$items      = devfolio_get_block_array_attr(
	$args,
	'items',
	array(
		array( 'text' => "One of the most talented developers I've worked with. Delivered a complex plugin architecture ahead of schedule with exceptional code quality.", 'name' => 'Sarah Johnson', 'role' => 'CTO, TechStartup Inc.', 'initials' => 'SJ', 'rating' => '★★★★★' ),
		array( 'text' => 'Transformed our legacy codebase into a modern, performant application. Core Web Vitals improved by 40% within the first month.', 'name' => 'Michael Chen', 'role' => 'Product Manager, ScaleApp', 'initials' => 'MC', 'rating' => '★★★★★' ),
		array( 'text' => 'Exceptional problem-solver with deep WordPress expertise. Built our entire SaaS integration layer from scratch - reliable, clean, and well-documented.', 'name' => 'Emily Rodriguez', 'role' => 'Founder, DevTools Co.', 'initials' => 'ER', 'rating' => '★★★★★' ),
	)
);
$section_id         = devfolio_get_block_section_id( $args, 'testimonials' );
$testimonials_label = devfolio_get_block_attr( $args, 'label', 'Testimonials' );
$testimonials_title = devfolio_get_block_attr( $args, 'titleText', 'What clients say' );
$testimonials_desc  = devfolio_get_block_attr( $args, 'desc', '' );
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim"><?php echo esc_html( $testimonials_label ); ?></p>
    <h2 class="devfolio-section-title devfolio-anim"><?php echo esc_html( $testimonials_title ); ?></h2>
    <?php if ( ! empty( $testimonials_desc ) ) : ?><p class="devfolio-section-desc devfolio-anim"><?php echo esc_html( $testimonials_desc ); ?></p><?php endif; ?>
    <div class="devfolio-testimonial-slider devfolio-anim"><div class="devfolio-testimonial-track"><?php foreach ( $items as $index => $item ) : ?><div class="devfolio-testimonial-card devfolio-glass" data-testimonial="<?php echo esc_attr( $index ); ?>"><?php echo devfolio_render_svg( $quote_icon ); ?><p class="devfolio-testimonial-text">"<?php echo esc_html( $item['text'] ?? '' ); ?>"</p><div class="devfolio-testimonial-stars"><?php echo esc_html( $item['rating'] ?? '★★★★★' ); ?></div><div class="devfolio-testimonial-author"><div class="devfolio-testimonial-avatar"><?php echo esc_html( $item['initials'] ?? '' ); ?></div><div><p class="devfolio-testimonial-name"><?php echo esc_html( $item['name'] ?? '' ); ?></p><p class="devfolio-testimonial-role"><?php echo esc_html( $item['role'] ?? '' ); ?></p></div></div></div><?php endforeach; ?></div><button class="devfolio-testimonial-prev" aria-label="Previous">&#8592;</button><button class="devfolio-testimonial-next" aria-label="Next">&#8594;</button><div class="devfolio-testimonial-dots"></div></div>
  </div>
</section>
