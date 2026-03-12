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
	array( 'title' => 'Shadhin Block Theme', 'category' => 'WordPress Theme', 'image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?w=600&h=400&fit=crop', 'desc' => 'A minimal block theme based on Gutenberg, published on WordPress.org. Built following the official Gutenberg design standards.', 'tech' => 'PHP, Gutenberg, CSS', 'live' => 'https://wordpress.org/themes/shadhin/', 'github' => '' ),
	array( 'title' => 'AutoChat Plugin', 'category' => 'WordPress Plugin', 'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop', 'desc' => 'Contributed to the design and development of the settings page as a frontend developer using HTML, CSS, and jQuery.', 'tech' => 'PHP, jQuery, HTML/CSS', 'live' => 'https://wordpress.org/plugins/autochat/', 'github' => '' ),
	array( 'title' => 'Media Profile Avatar', 'category' => 'WordPress Plugin', 'image' => 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=600&h=400&fit=crop', 'desc' => 'A plugin that allows users to upload their profile pictures from the WordPress Media Library instead of Gravatar.', 'tech' => 'PHP, WordPress', 'live' => 'https://wordpress.org/plugins/media-profile-avatar/', 'github' => '' ),
	array( 'title' => 'ToborLife AI – WooCommerce Page', 'category' => 'WooCommerce', 'image' => 'https://images.unsplash.com/photo-1555421689-d68471e189f2?w=600&h=400&fit=crop', 'desc' => 'Custom product page development using WooCommerce. Figma to WordPress conversion with full responsiveness.', 'tech' => 'WooCommerce, PHP, CSS', 'live' => '#', 'github' => '' ),
	array( 'title' => 'XpeedStudio Theme Contributions', 'category' => 'WordPress Theme', 'image' => 'https://images.unsplash.com/photo-1547658719-da2b51169166?w=600&h=400&fit=crop', 'desc' => 'Fixing PHP errors, adding One Click Demo Importer, and integrating new features into Elementor Widget Controller for Evenex, Medizco, BLO, Politino, and Seocify themes.', 'tech' => 'PHP, Elementor, CSS', 'live' => '#', 'github' => '' ),
	array( 'title' => 'Webba Booking Documentation', 'category' => 'Documentation', 'image' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=600&h=400&fit=crop', 'desc' => 'Authored 20+ knowledge base articles and video tutorials for Webba Booking plugin users.', 'tech' => 'Documentation, Video', 'live' => 'https://webba-booking.com', 'github' => '' ),
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

$portfolio_label = devfolio_get_theme_mod_value( 'devfolio_portfolio_label', 'Portfolio' );
$portfolio_title = devfolio_get_theme_mod_value( 'devfolio_portfolio_title', 'Featured Projects' );
$portfolio_desc  = devfolio_get_theme_mod_value( 'devfolio_portfolio_desc', 'A selection of WordPress themes, plugins, and contributions built over the years.' );

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
