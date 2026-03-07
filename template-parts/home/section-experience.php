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
	array( 'title' => 'Convey Digital', 'meta' => 'Senior WordPress Developer (Contract) | May 2025 – Dec 2025', 'desc' => 'Delivered high-performance, secure B2B WordPress solutions for enterprise clients. Focused on optimizing legacy codebases to improve page load times and Core Web Vitals.' ),
	array( 'title' => 'InstaWP', 'meta' => 'Team Lead & Senior WordPress Developer | Sep 2022 – Apr 2025', 'desc' => 'Architected and built the InstaWP Connect plugin from the ground up. Led engineering team in introducing CI/CD workflows and designing high-volume API integrations.' ),
	array( 'title' => 'UpdraftPlus', 'meta' => 'WordPress Plugin Developer | Jun 2021 – Aug 2022', 'desc' => 'Maintained one of the world\'s most popular backup plugins with 3M+ active installs. Ensured 99.9% reliability across diverse hosting environments.' ),
	array( 'title' => 'PickPlugins', 'meta' => 'Lead WordPress Developer | Jun 2014 – May 2020', 'desc' => 'Anchored the team for 6 years, managing flagship plugins like Posts Grid and WooCommerce Product Slider. Built multiple plugins from scratch.' ),
);

$default_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="7" rx="2"/><path d="M16 3h-8l-2 4h12z"/></svg>';
$section_id   = devfolio_get_section_id( 'experience' );
?>
<!-- Experience -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">Experience</p>
    <h2 class="devfolio-section-title devfolio-anim">Where I've Made Impact</h2>
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
