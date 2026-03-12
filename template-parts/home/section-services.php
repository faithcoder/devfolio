<?php
/**
 * Homepage services section.
 *
 * @package devfolio
 */

$services_query = new WP_Query(
	array(
		'post_type'      => 'devfolio_service',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);

$default_services = array(
	array( 'title' => 'WordPress Technical Support', 'desc' => 'Troubleshoot plugin and theme conflicts, Elementor compatibility, and provide reliable CRM/live chat support.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 18v-6a9 9 0 1 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1v-7h3z"/><path d="M3 14h3v7H5a2 2 0 0 1-2-2z"/></svg>' ),
	array( 'title' => 'Custom Theme & Site Development', 'desc' => 'Develop dynamic WordPress themes, Elementor widgets, and build stores using WooCommerce and Shopify.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 7h18"/><path d="M5 7l1 12h12l1-12"/><path d="M9 11v4"/><path d="M15 11v4"/></svg>' ),
	array( 'title' => 'Documentation & Video Tutorials', 'desc' => 'Create structured knowledge base articles, screencasts, and YouTube tutorials for extended customer education.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M16 13 10 17v-8l6 4z"/></svg>' ),
);
$default_service_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>';

$services = array();
if ( $services_query->have_posts() ) {
	while ( $services_query->have_posts() ) {
		$services_query->the_post();
		$services[] = array(
			'title' => get_the_title(),
			'desc'  => get_post_meta( get_the_ID(), 'devfolio_service_desc', true ),
			'icon_image' => get_post_meta( get_the_ID(), 'devfolio_service_icon_image', true ),
		);
	}
	wp_reset_postdata();
}

if ( empty( $services ) ) {
	$services = $default_services;
}
$section_id = devfolio_get_section_id( 'services' );
?>
<!-- Services -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">Services</p>
    <h2 class="devfolio-section-title devfolio-anim">How I Can Help Your Users</h2>
    <p class="devfolio-services-subtitle devfolio-anim">Support-first execution with technical depth and clear communication.</p>
    <div class="devfolio-services-grid">
      <?php foreach ( $services as $service ) : ?>
      <div class="devfolio-service-card devfolio-glass devfolio-anim">
        <div class="devfolio-service-icon"><?php echo devfolio_render_icon( $service['icon_image'] ?? '', $service['icon'] ?? $default_service_icon, $service['title'] ?? 'Icon' ); ?></div>
        <h3><?php echo esc_html( $service['title'] ?? '' ); ?></h3>
        <p><?php echo esc_html( $service['desc'] ?? '' ); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
