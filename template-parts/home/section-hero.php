<?php
/**
 * Homepage hero section.
 *
 * @package devfolio
 */

$hero_label       = devfolio_get_theme_mod_value( 'devfolio_hero_label', 'Senior Developer • Plugins • Performance' );
$hero_before      = devfolio_get_theme_mod_value( 'devfolio_hero_title_before', 'I build fast, secure' );
$hero_highlight   = devfolio_get_theme_mod_value( 'devfolio_hero_title_highlight', 'plugins and custom features' );
$hero_after       = devfolio_get_theme_mod_value( 'devfolio_hero_title_after', 'that scale.' );
$hero_subtitle    = devfolio_get_theme_mod_value( 'devfolio_hero_subtitle', '10+ years of experience. Product-focused development, clean code, and reliable delivery. Available for ongoing work or project-based builds.' );
$hero_cta_1_text  = devfolio_get_theme_mod_value( 'devfolio_hero_cta_primary_text', 'Book a Call' );
$hero_cta_1_url   = devfolio_get_theme_mod_value( 'devfolio_hero_cta_primary_url', '#contact' );
$hero_cta_2_text  = devfolio_get_theme_mod_value( 'devfolio_hero_cta_secondary_text', 'View Profile' );
$hero_cta_2_url   = devfolio_get_theme_mod_value( 'devfolio_hero_cta_secondary_url', '#projects' );
$hero_image       = devfolio_get_theme_mod_value( 'devfolio_hero_image', get_template_directory_uri() . '/assets/images/profile.jpeg' );
$hero_stats       = devfolio_get_repeater_value(
	'devfolio_hero_stats',
	array(
		array( 'value' => '10+', 'label' => 'Years Experience' ),
		array( 'value' => 'Architecture', 'label' => 'Plugin-first' ),
		array( 'value' => 'CWV +', 'label' => 'Performance' ),
		array( 'value' => 'Async-ready', 'label' => 'Remote' ),
	)
);

$social_profiles = devfolio_get_repeater_value(
	'devfolio_social_profiles',
	array(
		array( 'label' => 'LinkedIn', 'url' => 'https://linkedin.com', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zm2-3a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>' ),
		array( 'label' => 'GitHub', 'url' => 'https://github.com', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.4 5.4 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65S8.93 17.38 9 18v4m0 0H6c-1 0-1.5-.5-2-1s-1.5-1-2-1"/></svg>' ),
		array( 'label' => 'WordPress', 'url' => 'https://wordpress.org', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2.1 12.1 7 21l4-9"/><path d="m14.6 21 3.4-7.3c.6-1.3.9-2.4.9-3.5 0-.9-.2-1.7-.4-2.5"/><path d="M7.8 4.7A8 8 0 0 1 20 11.5c0 1.5-.3 2.9-.9 4.2"/><path d="M3 10.5A8 8 0 0 1 7.8 4.7L5.4 10.5"/></svg>' ),
	)
);

if ( empty( $social_profiles ) ) {
	$social_profiles = array(
		array( 'label' => 'LinkedIn', 'url' => devfolio_get_theme_mod_value( 'devfolio_social_linkedin', 'https://linkedin.com' ) ),
		array( 'label' => 'GitHub', 'url' => devfolio_get_theme_mod_value( 'devfolio_social_github', 'https://github.com' ) ),
		array( 'label' => 'WordPress', 'url' => devfolio_get_theme_mod_value( 'devfolio_social_wordpress', 'https://wordpress.org' ) ),
	);
}
?>
<!-- Hero -->
<section class="devfolio-hero">
  <div class="devfolio-container">
    <div class="devfolio-hero-layout">
      <div class="devfolio-hero-text">
        <p class="devfolio-label devfolio-anim"><?php echo esc_html( $hero_label ); ?></p>
        <h1 class="devfolio-anim"><?php echo esc_html( $hero_before ); ?> <span class="devfolio-gradient-text"><?php echo esc_html( $hero_highlight ); ?></span> <?php echo esc_html( $hero_after ); ?></h1>
        <p class="devfolio-subtitle devfolio-anim"><?php echo esc_html( $hero_subtitle ); ?></p>

        <div class="devfolio-hero-actions devfolio-anim">
          <a href="<?php echo esc_url( $hero_cta_1_url ); ?>" class="devfolio-btn devfolio-btn-glow"><?php echo esc_html( $hero_cta_1_text ); ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7 7 7-7 7"/></svg></a>
          <a href="<?php echo esc_url( $hero_cta_2_url ); ?>" class="devfolio-btn devfolio-btn-glass"><?php echo esc_html( $hero_cta_2_text ); ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6m4-3h6v6m-11 5L21 3"/></svg></a>
          <div class="devfolio-social-icons">
            <?php foreach ( $social_profiles as $profile ) : ?>
              <?php if ( empty( $profile['url'] ) ) { continue; } ?>
            <a href="<?php echo esc_url( $profile['url'] ); ?>" target="_blank" class="devfolio-social-icon devfolio-glass" aria-label="<?php echo esc_attr( $profile['label'] ?? 'Social' ); ?>">
              <?php echo devfolio_render_icon( $profile['icon_image'] ?? '', $profile['icon'] ?? '', $profile['label'] ?? 'Social' ); ?>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Profile Image with tilt -->
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
    </div>

    <div class="devfolio-stats-grid devfolio-anim">
      <?php foreach ( $hero_stats as $stat ) : ?>
      <div class="devfolio-stat-card devfolio-glass"><p class="devfolio-stat-value devfolio-gradient-text"><?php echo esc_html( $stat['value'] ?? '' ); ?></p><p class="devfolio-stat-label"><?php echo esc_html( $stat['label'] ?? '' ); ?></p></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
