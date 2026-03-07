<?php
/**
 * Homepage experience section.
 *
 * @package devfolio
 */

$experience_query = new WP_Query(
	array(
		'post_type'      => 'devfolio_experience',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);

$default_experience = array(
	array( 'title' => 'Webba Booking', 'meta' => 'Support Engineer | Oct 2025 - Present | Full Time | Remote', 'desc' => 'Provide technical support for plugin users including debugging, conflict resolution, licensing, subscriptions, and pre-sales queries across HelpScout and WordPress.org forums.' ),
	array( 'title' => 'Roxnor (WPmet / GetGenie AI)', 'meta' => 'Support Engineer | Jan 2023 - Sep 2025 | Full Time | Remote', 'desc' => 'Handled customer support across HelpScout, Live Chat, Ticksy, ThriveDesk, and WordPress.org. Reported reproducible bugs to development via GitScrum and wrote user-friendly docs and screencasts.' ),
	array( 'title' => 'CodeAstrology', 'meta' => 'Technical Support Engineer | Apr 2022 - Dec 2022 | Part Time | Remote', 'desc' => 'Supported WooCommerce plugin users via Tawk.to and Crisp, resolving product table setup, licensing, and integration queries while creating practical tutorials and knowledgebase content.' ),
	array( 'title' => 'SoftTech-IT Institute', 'meta' => 'Associate Mentor, WordPress Theme Development | Mar 2021 - Oct 2023 | Part Time', 'desc' => 'Guided multiple batches through HTML-to-WordPress conversion, custom post types, taxonomies, and tools like Kirki, ACF, Redux, and Elementor.' ),
	array( 'title' => 'Fiverr & Upwork', 'meta' => 'Freelance CMS Developer | Nov 2014 - Jan 2021 | Full Time | Remote', 'desc' => 'Built and customized WordPress and WooCommerce websites, landing pages, and theme conversions with a focus on practical client outcomes and clean handoff documentation.' ),
);

$default_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="7" rx="2"/><path d="M16 3h-8l-2 4h12z"/></svg>';
$section_id   = devfolio_get_section_id( 'experience' );
?>
<!-- Experience -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">Experience</p>
    <h2 class="devfolio-section-title devfolio-anim">Support & Technical Experience</h2>
    <div class="devfolio-timeline">
      <?php if ( $experience_query->have_posts() ) : ?>
        <?php while ( $experience_query->have_posts() ) : $experience_query->the_post(); ?>
          <?php
          $role     = get_post_meta( get_the_ID(), 'devfolio_experience_role', true );
          $period   = get_post_meta( get_the_ID(), 'devfolio_experience_period', true );
          $meta     = trim( $role . ( $period ? ' | ' . $period : '' ) );
          $desc     = get_post_meta( get_the_ID(), 'devfolio_experience_desc', true );
          $icon_img = get_post_meta( get_the_ID(), 'devfolio_experience_icon_image', true );
          ?>
      <div class="devfolio-timeline-item devfolio-anim-left">
        <div class="devfolio-timeline-dot"></div>
        <div class="devfolio-timeline-card devfolio-glass">
          <div class="devfolio-job-header">
            <div class="devfolio-job-icon"><?php echo devfolio_render_icon( $icon_img, $default_icon, get_the_title() ); ?></div>
            <div><p class="devfolio-job-title"><?php the_title(); ?></p><p class="devfolio-job-meta"><?php echo esc_html( $meta ); ?></p></div>
          </div>
          <p class="devfolio-job-desc"><?php echo esc_html( $desc ? $desc : get_the_excerpt() ); ?></p>
        </div>
      </div>
        <?php endwhile; wp_reset_postdata(); ?>
      <?php else : ?>
        <?php foreach ( $default_experience as $item ) : ?>
      <div class="devfolio-timeline-item devfolio-anim-left">
        <div class="devfolio-timeline-dot"></div>
        <div class="devfolio-timeline-card devfolio-glass">
          <div class="devfolio-job-header">
            <div class="devfolio-job-icon"><?php echo devfolio_render_icon( '', $default_icon, $item['title'] ); ?></div>
            <div><p class="devfolio-job-title"><?php echo esc_html( $item['title'] ); ?></p><p class="devfolio-job-meta"><?php echo esc_html( $item['meta'] ); ?></p></div>
          </div>
          <p class="devfolio-job-desc"><?php echo esc_html( $item['desc'] ); ?></p>
        </div>
      </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>
