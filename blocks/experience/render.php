<?php
/**
 * Homepage experience section.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$default_experience = array(
	array( 'title' => 'Webba Booking', 'meta' => 'Support Engineer | Oct 2025 - Present | Full Time | Remote', 'desc' => 'Provide technical support for plugin users including debugging, conflict resolution, licensing, subscriptions, and pre-sales queries across HelpScout and WordPress.org forums.', 'iconImage' => '' ),
	array( 'title' => 'Roxnor (WPmet / GetGenie AI)', 'meta' => 'Support Engineer | Jan 2023 - Sep 2025 | Full Time | Remote', 'desc' => 'Handled customer support across HelpScout, Live Chat, Ticksy, ThriveDesk, and WordPress.org. Reported reproducible bugs to development and wrote user-friendly docs and screencasts.', 'iconImage' => '' ),
	array( 'title' => 'CodeAstrology', 'meta' => 'Technical Support Engineer | Apr 2022 - Dec 2022 | Part Time | Remote', 'desc' => 'Supported WooCommerce plugin users via Tawk.to and Crisp, resolving product table setup, licensing, and integration queries while creating practical tutorials and knowledgebase content.', 'iconImage' => '' ),
	array( 'title' => 'SoftTech-IT Institute', 'meta' => 'Associate Mentor, WordPress Theme Development | Mar 2021 - Oct 2023 | Part Time', 'desc' => 'Guided multiple batches through HTML-to-WordPress conversion, custom post types, taxonomies, and established theme and builder workflows.', 'iconImage' => '' ),
	array( 'title' => 'Fiverr & Upwork', 'meta' => 'Freelance CMS Developer | Nov 2014 - Jan 2021 | Full Time | Remote', 'desc' => 'Built and customized WordPress and WooCommerce websites, landing pages, and theme conversions with a focus on practical client outcomes and clean handoff documentation.', 'iconImage' => '' ),
);

$default_icon      = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="7" rx="2"/><path d="M16 3h-8l-2 4h12z"/></svg>';
$section_id        = devfolio_get_section_id( 'experience' );
$experience_label  = devfolio_get_block_attr( $args, 'label', 'Experience' );
$experience_title  = devfolio_get_block_attr( $args, 'titleText', 'Support & Technical Experience' );
$experience_desc   = devfolio_get_block_attr( $args, 'desc', '' );
$experience_items  = devfolio_get_block_array_attr( $args, 'items', $default_experience );
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim"><?php echo esc_html( $experience_label ); ?></p>
    <h2 class="devfolio-section-title devfolio-anim"><?php echo esc_html( $experience_title ); ?></h2>
    <?php if ( ! empty( $experience_desc ) ) : ?>
    <p class="devfolio-section-desc devfolio-anim"><?php echo esc_html( $experience_desc ); ?></p>
    <?php endif; ?>
    <div class="devfolio-timeline">
      <?php foreach ( $experience_items as $item ) : ?>
      <div class="devfolio-timeline-item devfolio-anim-left">
        <div class="devfolio-timeline-dot"></div>
        <div class="devfolio-timeline-card devfolio-glass">
          <div class="devfolio-job-header">
            <div class="devfolio-job-icon"><?php echo devfolio_render_icon( $item['iconImage'] ?? '', $default_icon, $item['title'] ?? '' ); ?></div>
            <div><p class="devfolio-job-title"><?php echo esc_html( $item['title'] ?? '' ); ?></p><p class="devfolio-job-meta"><?php echo esc_html( $item['meta'] ?? '' ); ?></p></div>
          </div>
          <p class="devfolio-job-desc"><?php echo esc_html( $item['desc'] ?? '' ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
