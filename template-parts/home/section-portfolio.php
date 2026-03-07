<?php
/**
 * Homepage portfolio section.
 *
 * @package devfolio
 */

$portfolio_query = new WP_Query(
	array(
		'post_type'      => 'devfolio_portfolio',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);

$fallback_items = array(
	array( 'title' => 'E-Commerce Platform', 'category' => 'Web App', 'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&h=400&fit=crop', 'desc' => 'A full-featured e-commerce platform with product management, cart functionality, payment integration, and order tracking. Built with modern technologies for optimal performance.', 'tech' => 'React, TypeScript, Node.js', 'live' => '#', 'github' => '#' ),
	array( 'title' => 'Analytics Dashboard', 'category' => 'Dashboard', 'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop', 'desc' => 'Real-time analytics dashboard with interactive charts, data filtering, and custom report generation. Designed for data-driven decision making.', 'tech' => 'React, D3.js, Python', 'live' => '#', 'github' => '' ),
	array( 'title' => 'Social Media App', 'category' => 'Mobile App', 'image' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=600&h=400&fit=crop', 'desc' => 'A social media application with real-time messaging, media sharing, stories, and an intelligent feed algorithm.', 'tech' => 'React Native, Firebase, Node.js', 'live' => '#', 'github' => '#' ),
	array( 'title' => 'CMS Plugin Suite', 'category' => 'WordPress', 'image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?w=600&h=400&fit=crop', 'desc' => 'A suite of WordPress plugins for content management, SEO optimization, and performance monitoring. Used by thousands of websites.', 'tech' => 'PHP, WordPress, React', 'live' => '', 'github' => '#' ),
	array( 'title' => 'Task Management Tool', 'category' => 'SaaS', 'image' => 'https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=600&h=400&fit=crop', 'desc' => 'Project management tool with kanban boards, time tracking, team collaboration, and automated workflows.', 'tech' => 'Vue.js, Laravel, Redis', 'live' => '#', 'github' => '' ),
	array( 'title' => 'Portfolio Generator', 'category' => 'Tool', 'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop', 'desc' => 'An automated portfolio website generator that creates beautiful, responsive portfolio sites from simple configuration files.', 'tech' => 'TypeScript, Next.js, Tailwind', 'live' => '#', 'github' => '#' ),
);

$items = array();

if ( $portfolio_query->have_posts() ) {
	while ( $portfolio_query->have_posts() ) {
		$portfolio_query->the_post();
		$items[] = array(
			'title'    => get_the_title(),
			'category' => get_post_meta( get_the_ID(), 'devfolio_portfolio_category', true ),
			'image'    => devfolio_get_image_url( get_the_ID(), 'devfolio_portfolio_image_url', 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&h=400&fit=crop' ),
			'desc'     => get_post_meta( get_the_ID(), 'devfolio_portfolio_popup_desc', true ),
			'tech'     => get_post_meta( get_the_ID(), 'devfolio_portfolio_tech', true ),
			'live'     => get_post_meta( get_the_ID(), 'devfolio_portfolio_live_url', true ),
			'github'   => get_post_meta( get_the_ID(), 'devfolio_portfolio_github_url', true ),
		);
	}
	wp_reset_postdata();
}

if ( empty( $items ) ) {
	$items = $fallback_items;
}
$section_id = devfolio_get_section_id( 'portfolio' );
?>
<!-- Portfolio -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">Portfolio</p>
    <h2 class="devfolio-section-title devfolio-anim">Featured Work</h2>
    <div class="devfolio-portfolio-grid">
      <?php foreach ( $items as $index => $item ) : ?>
      <?php $techs = devfolio_parse_tag_list( $item['tech'] ?? '' ); ?>
      <div class="devfolio-portfolio-card devfolio-glass devfolio-anim" data-index="<?php echo esc_attr( $index ); ?>" data-title="<?php echo esc_attr( $item['title'] ); ?>" data-category="<?php echo esc_attr( $item['category'] ); ?>" data-image="<?php echo esc_url( $item['image'] ); ?>" data-description="<?php echo esc_attr( $item['desc'] ); ?>" data-tech="<?php echo esc_attr( implode( ',', $techs ) ); ?>" data-live-url="<?php echo esc_url( $item['live'] ); ?>" data-github-url="<?php echo esc_url( $item['github'] ); ?>">
        <div class="devfolio-portfolio-thumb"><img src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy"/><span class="devfolio-portfolio-cat"><?php echo esc_html( $item['category'] ); ?></span></div>
        <div class="devfolio-portfolio-info"><h3><?php echo esc_html( $item['title'] ); ?></h3><div class="devfolio-tech-tags"><?php foreach ( array_slice( $techs, 0, 3 ) as $tech ) : ?><span class="devfolio-tech-tag"><?php echo esc_html( $tech ); ?></span><?php endforeach; ?></div></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Portfolio Detail Popup -->
<div class="devfolio-portfolio-popup">
  <div class="devfolio-portfolio-popup-inner">
    <div class="devfolio-portfolio-popup-image"><img src="" alt=""/><span class="devfolio-portfolio-popup-cat"></span></div>
    <div class="devfolio-portfolio-popup-content">
      <h3 class="devfolio-portfolio-popup-title"></h3>
      <p class="devfolio-portfolio-popup-desc"></p>
      <div class="devfolio-portfolio-popup-tags"></div>
      <div class="devfolio-portfolio-popup-links"></div>
    </div>
    <button class="devfolio-lightbox-btn devfolio-lightbox-close devfolio-portfolio-popup-close" aria-label="Close">✕</button>
  </div>
</div>
