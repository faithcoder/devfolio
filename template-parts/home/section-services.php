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
	array( 'title' => 'Plugin & UI Architecture', 'desc' => 'Custom plugins, Gutenberg Blocks, and modern UIs with React/TypeScript. Focus on REST APIs and scalable data syncing.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect width="7" height="7" x="14" y="3" rx="1"/><path d="M10 21V8a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H3"/></svg>' ),
	array( 'title' => 'Performance & Modernization', 'desc' => 'Optimizing legacy codebases, improving Core Web Vitals, and hardening stability for high-traffic environments.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>' ),
	array( 'title' => 'SaaS & Integrations', 'desc' => 'Full-lifecycle API integrations, webhooks, and CI/CD workflows for plugin development and SaaS platforms.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" x2="22" y1="12" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>' ),
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
    <h2 class="devfolio-section-title devfolio-anim">What I can help with</h2>
    <p class="devfolio-services-subtitle devfolio-anim">Clean builds, solid debugging, and product-level quality.</p>
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
