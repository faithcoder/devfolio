<?php
/**
 * Homepage hero section.
 *
 * @package devfolio
 */

$hero_label       = devfolio_get_theme_mod_value( 'devfolio_hero_label', 'Software Engineer • Full Stack Developer' );
$hero_before      = devfolio_get_theme_mod_value( 'devfolio_hero_title_before', 'I build scalable' );
$hero_highlight   = devfolio_get_theme_mod_value( 'devfolio_hero_title_highlight', 'web and mobile applications' );
$hero_after       = devfolio_get_theme_mod_value( 'devfolio_hero_title_after', 'for a smarter world.' );
$hero_subtitle    = devfolio_get_theme_mod_value( 'devfolio_hero_subtitle', 'Software Engineer with expertise in Laravel, React, Next.js, and Mobile App Development. Dedicated to building innovative solutions that make the world easier and faster.' );
$hero_cta_1_text  = devfolio_get_theme_mod_value( 'devfolio_hero_cta_primary_text', 'Contact Me' );
$hero_cta_1_url   = devfolio_get_theme_mod_value( 'devfolio_hero_cta_primary_url', '#' . devfolio_get_section_id( 'contact' ) );
$hero_cta_2_text  = devfolio_get_theme_mod_value( 'devfolio_hero_cta_secondary_text', 'View Contributions' );
$hero_cta_2_url   = devfolio_get_theme_mod_value( 'devfolio_hero_cta_secondary_url', '#' . devfolio_get_section_id( 'projects' ) );
$denim_section_title = devfolio_get_theme_mod_value( 'devfolio_denim_section_title', 'Denim Innovation' );
$denim_section_desc  = devfolio_get_theme_mod_value( 'devfolio_denim_section_subtitle', 'Experimental washes, product ideas, and visual concept development showcased in an interactive 3D slider.' );
$hero_image       = devfolio_get_theme_mod_value( 'devfolio_hero_image', get_template_directory_uri() . '/assets/images/profile.jpeg' );
$hero_section_id  = devfolio_get_section_id( 'hero' );
$hero_stats       = devfolio_get_repeater_value(
	'devfolio_hero_stats',
	array(
		array( 'value' => '6+', 'label' => 'Years Experience' ),
		array( 'value' => '20+', 'label' => 'Projects Completed' ),
		array( 'value' => '4+', 'label' => 'Companies Worked' ),
		array( 'value' => 'Full Stack', 'label' => 'Development Focus' ),
	)
);

$social_profiles = devfolio_get_repeater_value(
	'devfolio_social_profiles',
	array(
		array( 'label' => 'LinkedIn', 'url' => 'https://linkedin.com', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zm2-3a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>' ),
		array( 'label' => 'GitHub', 'url' => 'https://github.com', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.4 5.4 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65S8.93 17.38 9 18v4m0 0H6c-1 0-1.5-.5-2-1s-1.5-1-2-1"/></svg>' ),
		array( 'label' => 'WordPress', 'url' => 'https://wordpress.org', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2.1 12.1 7 21l4-9"/><path d="m14.6 21 3.4-7.3c.6-1.3.9-2.4.9-3.5 0-.9-.2-1.7-.4-2.5"/><path d="M7.8 4.7A8 8 0 0 1 20 11.5c0 1.5-.3 2.9-.9 4.2"/><path d="M3 10.5A8 8 0 0 1 7.8 4.7L5.4 10.5"/></svg>' ),
		array( 'label' => 'YouTube', 'url' => 'https://youtube.com', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58"/><path d="m10 15 5-3-5-3z"/></svg>' ),
	)
);

$denim_fallback = array(
	array(
		'src'      => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=900&h=600&fit=crop',
		'title'    => 'Smart Wash Development',
		'subtitle' => 'Experimenting with finish quality, consistency, and modern denim treatment.',
	),
	array(
		'src'      => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=900&h=600&fit=crop',
		'title'    => 'Fabric-led Prototyping',
		'subtitle' => 'Building better samples through iterative design, wash, and product testing.',
	),
	array(
		'src'      => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=900&h=600&fit=crop',
		'title'    => 'Denim Product Innovation',
		'subtitle' => 'Showcasing premium garment imagery for new collections and concept direction.',
	),
	array(
		'src'      => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=900&h=600&fit=crop',
		'title'    => 'Sustainable Collection Study',
		'subtitle' => 'Highlighting cleaner processes and design-forward denim experimentation.',
	),
);

$denim_query = new WP_Query(
	array(
		'post_type'      => 'devfolio_denim',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);

$denim_items = array();
if ( $denim_query->have_posts() ) {
	while ( $denim_query->have_posts() ) {
		$denim_query->the_post();
		$denim_items[] = array(
			'src'      => devfolio_get_image_url( get_the_ID(), 'devfolio_denim_innovation_image_url', 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=900&h=600&fit=crop' ),
			'title'    => get_the_title(),
			'subtitle' => get_post_meta( get_the_ID(), 'devfolio_denim_innovation_subtitle', true ),
		);
	}
	wp_reset_postdata();
}

if ( empty( $denim_items ) ) {
	$denim_items = $denim_fallback;
}

$hero_stats = array_values(
	array_filter(
		(array) $hero_stats,
		static function ( $stat ) {
			return ! empty( trim( (string) ( $stat['value'] ?? '' ) ) ) || ! empty( trim( (string) ( $stat['label'] ?? '' ) ) );
		}
	)
);

$social_profiles = array_values(
	array_filter(
		(array) $social_profiles,
		static function ( $profile ) {
			return ! empty( trim( (string) ( $profile['url'] ?? '' ) ) );
		}
	)
);

if (
	'' === trim( (string) $hero_label ) &&
	'' === trim( (string) $hero_before ) &&
	'' === trim( (string) $hero_highlight ) &&
	'' === trim( (string) $hero_after ) &&
	'' === trim( (string) $hero_subtitle ) &&
	'' === trim( (string) $hero_cta_1_text ) &&
	'' === trim( (string) $hero_cta_2_text ) &&
	empty( $social_profiles ) &&
	empty( $hero_stats ) &&
	empty( $denim_items )
) {
	return;
}
?>
<!-- Hero -->
<section id="<?php echo esc_attr( $hero_section_id ); ?>" class="devfolio-hero">
  <div class="devfolio-container">
    <div class="devfolio-hero-layout">
      <div class="devfolio-hero-text">
        <?php if ( ! empty( $hero_label ) ) : ?>
        <p class="devfolio-label devfolio-anim"><?php echo esc_html( $hero_label ); ?></p>
        <?php endif; ?>
        <?php if ( ! empty( $hero_before ) || ! empty( $hero_highlight ) || ! empty( $hero_after ) ) : ?>
        <h1 class="devfolio-anim"><?php echo esc_html( $hero_before ); ?> <span class="devfolio-gradient-text"><?php echo esc_html( $hero_highlight ); ?></span> <?php echo esc_html( $hero_after ); ?></h1>
        <?php endif; ?>
        <?php if ( ! empty( $hero_subtitle ) ) : ?>
        <p class="devfolio-subtitle devfolio-anim"><?php echo esc_html( $hero_subtitle ); ?></p>
        <?php endif; ?>

        <div class="devfolio-hero-actions devfolio-anim">
          <?php if ( ! empty( $hero_cta_1_text ) && ! empty( $hero_cta_1_url ) ) : ?>
          <a href="<?php echo esc_url( $hero_cta_1_url ); ?>" class="devfolio-btn devfolio-btn-glow"><?php echo esc_html( $hero_cta_1_text ); ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7 7 7-7 7"/></svg></a>
          <?php endif; ?>
          <?php if ( ! empty( $hero_cta_2_text ) && ! empty( $hero_cta_2_url ) ) : ?>
          <a href="<?php echo esc_url( $hero_cta_2_url ); ?>" class="devfolio-btn devfolio-btn-glass"><?php echo esc_html( $hero_cta_2_text ); ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6m4-3h6v6m-11 5L21 3"/></svg></a>
          <?php endif; ?>
          <?php if ( ! empty( $social_profiles ) ) : ?>
          <div class="devfolio-social-icons">
            <?php foreach ( $social_profiles as $profile ) : ?>
            <a href="<?php echo esc_url( $profile['url'] ); ?>" target="_blank" class="devfolio-social-icon devfolio-glass" aria-label="<?php echo esc_attr( $profile['label'] ?? 'Social' ); ?>">
              <?php echo devfolio_render_icon( $profile['icon_image'] ?? '', $profile['icon'] ?? '', $profile['label'] ?? 'Social' ); ?>
            </a>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Profile Image with tilt -->
      <?php if ( ! empty( $hero_image ) ) : ?>
      <div class="devfolio-hero-image devfolio-anim">
        <div class="devfolio-tilt-container" id="devfolio-tilt-container">
          <div class="devfolio-tilt-shape devfolio-tilt-shape-1"></div>
          <div class="devfolio-tilt-shape devfolio-tilt-shape-2"></div>
          <div class="devfolio-tilt-shape devfolio-tilt-shape-3"></div>
          <div class="devfolio-tilt-shape devfolio-tilt-shape-4"></div>
          <div class="devfolio-tilt-img-wrap">
            <img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
            <div class="devfolio-tilt-img-overlay"></div>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>

    <?php if ( ! empty( $hero_stats ) ) : ?>
    <div class="devfolio-stats-grid devfolio-anim">
      <?php foreach ( $hero_stats as $stat ) : ?>
      <div class="devfolio-stat-card devfolio-glass"><p class="devfolio-stat-value devfolio-gradient-text"><?php echo esc_html( $stat['value'] ?? '' ); ?></p><p class="devfolio-stat-label"><?php echo esc_html( $stat['label'] ?? '' ); ?></p></div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if ( ! empty( $denim_items ) ) : ?>
    <div class="devfolio-denim-innovation devfolio-anim">
      <?php if ( ! empty( $denim_section_title ) || ! empty( $denim_section_desc ) ) : ?>
      <div class="devfolio-denim-innovation-head">
        <?php if ( ! empty( $denim_section_title ) ) : ?>
        <h3 class="devfolio-events-title"><?php echo esc_html( $denim_section_title ); ?></h3>
        <?php endif; ?>
        <?php if ( ! empty( $denim_section_desc ) ) : ?>
        <p class="devfolio-events-subtitle"><?php echo esc_html( $denim_section_desc ); ?></p>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      <div class="devfolio-carousel devfolio-denim-carousel" data-carousel-lightbox="denim">
        <div class="devfolio-carousel-wrap">
          <div class="devfolio-carousel-viewport">
            <div class="devfolio-carousel-track">
              <?php foreach ( $denim_items as $index => $item ) : ?>
              <div class="devfolio-carousel-slide" data-slide="<?php echo esc_attr( $index ); ?>" data-src="<?php echo esc_url( $item['src'] ); ?>" data-title="<?php echo esc_attr( $item['title'] ); ?>" data-subtitle="<?php echo esc_attr( $item['subtitle'] ); ?>">
                <div class="devfolio-carousel-card devfolio-glass">
                  <div class="devfolio-carousel-img-wrap"><img src="<?php echo esc_url( $item['src'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy"/><div class="devfolio-carousel-img-overlay"></div><div class="devfolio-carousel-caption"><p class="devfolio-carousel-caption-title"><?php echo esc_html( $item['title'] ); ?></p><?php if ( ! empty( $item['subtitle'] ) ) : ?><p class="devfolio-carousel-caption-subtitle"><?php echo esc_html( $item['subtitle'] ); ?></p><?php endif; ?></div></div>
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
        <br>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
