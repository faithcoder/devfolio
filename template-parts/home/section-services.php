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
	array( 'title' => 'Mobile App Development', 'desc' => 'Building cross-platform and native mobile applications using React Native, Flutter, and Next.js, ensuring a seamless user experience.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 18h.01M8 21h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2z"/></svg>' ),
	array( 'title' => 'Backend & APIs', 'desc' => 'Developing scalable back-end architectures and RESTful APIs using Laravel, Node.js, and Express, integrated with SQL/NoSQL databases.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5v14"/></svg>' ),
	array( 'title' => 'Frontend Engineering', 'desc' => 'Designing and implementing responsive frontends from scratch using React, Vue.js, Tailwind CSS, and Material UI, based on Figma/XD.', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>' ),
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
$services_label = devfolio_get_theme_mod_value( 'devfolio_services_label', 'Services' );
$services_title = devfolio_get_theme_mod_value( 'devfolio_services_title', 'How I Can Help Your Users' );
$services_desc  = devfolio_get_theme_mod_value( 'devfolio_services_desc', 'Support-first execution with technical depth and clear communication.' );
?>
<!-- Services -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim"><?php echo esc_html( $services_label ); ?></p>
    <h2 class="devfolio-section-title devfolio-anim"><?php echo esc_html( $services_title ); ?></h2>
    <?php if ( ! empty( $services_desc ) ) : ?>
    <p class="devfolio-services-subtitle devfolio-anim"><?php echo esc_html( $services_desc ); ?></p>
    <?php endif; ?>
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
