<?php
/**
 * Template part: About — Tabbed Section (Skills, Experience & Education).
 *
 * @package devfolio
 */

// --- 1. Fetch Skills ---
$skill_groups = devfolio_get_repeater_value(
	'devfolio_skill_groups',
	array(
		array( 'title' => 'Support Operations', 'tags' => 'Troubleshooting, Problem Solving, Customer Support, Documentation Writing, Communication, Website Migration' ),
		array( 'title' => 'WordPress & CMS', 'tags' => 'WordPress Theme Development, Elementor Widget Development, WooCommerce, Shopify Store Design, Landing Page Design' ),
		array( 'title' => 'Technical Stack', 'tags' => 'HTML/CSS, Bootstrap, TailwindCSS, PHP, MySQL, JavaScript, ReactJS, jQuery, AJAX, WP CLI, WP REST API' ),
		array( 'title' => 'Tools & Workflow', 'tags' => 'HelpScout, ThriveDesk, Ticksy, Tawk.to, Crisp, Git, ClickUp, BrowserStack, Slack, Figma, cPanel, WHM, FTP' ),
	)
);

$skill_groups = array_values(
	array_filter(
		(array) $skill_groups,
		static function ( $group ) {
			$title = trim( (string) ( $group['title'] ?? '' ) );
			$tags  = trim( (string) ( $group['tags'] ?? '' ) );
			return '' !== $title || '' !== $tags;
		}
	)
);

// --- 2. Fetch Experience ---
$experience_query = new WP_Query(
	array(
		'post_type'      => 'devfolio_experience',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);

$default_experience = array(
	array( 'title' => 'Webba Booking', 'meta' => 'Support Engineer | Oct 2025 - PRESENT', 'desc' => 'Provided technical support, managed queries via HelpScout, resolved plugin/theme conflicts, and reported bugs via ClickUp.' ),
	array( 'title' => 'Roxnor', 'meta' => 'Support Engineer | Jan 2023 - Sep 2025', 'desc' => 'Customer Support for WPmet plugins and GetGenie AI. Handled technical queries, troubleshooting, and created documentation/screencasts.' ),
	array( 'title' => 'CodeAstrology', 'meta' => 'Technical Support Engineer | Apr 2022 – Dec 2022', 'desc' => 'Provided support for WooCommerce-based plugins via live chat using Tawk.to and Crisp, assisting 15-20 customers daily.' ),
	array( 'title' => 'SoftTech-IT Institute', 'meta' => 'Associate Mentor, WP Theme Development | Mar 2021 – Oct 2023', 'desc' => 'Led theme development classes covering HTML to WordPress conversion, custom posts, Elementor, and Redux.' ),
	array( 'title' => 'Freelance CMS Developer', 'meta' => 'Fiverr & Upwork | Nov 2014 – Jan 2021', 'desc' => 'Created outstanding websites using Elementor, WooCommerce, Shopify, and transitioned HTML to WordPress themes.' ),
);

// --- 3. Fetch Education ---
$education_query = new WP_Query(
	array(
		'post_type'      => 'devfolio_education',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);

$default_education = array(
	array( 'title' => 'Post Graduate Diploma in IT (PGDICT)', 'meta' => 'BKIICT | Jun 2023 - Jul 2024', 'desc' => 'Information and Communication Technology focus.' ),
	array( 'title' => 'Executive M.B.A. (EMBA)', 'meta' => 'Presidency University, Bangladesh | Feb 2021 - Jun 2022', 'desc' => 'Executive postgraduate business program.' ),
);

$default_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="7" rx="2"/><path d="M16 3h-8l-2 4h12z"/></svg>';
$default_edu_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 1.1 2.7 3 6 3s6-1.9 6-3v-5"/></svg>';
?>

<!-- About — Tabbed Section -->
<section id="about" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">About Me</p>
    <h2 class="devfolio-section-title devfolio-anim">Skills, Experience &amp; Education</h2>
    <div class="devfolio-tabs devfolio-anim">
      <div class="devfolio-tabs-list">
        <button class="devfolio-tab-trigger devfolio-tab-active" data-tab="skills"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg> Skills</button>
        <button class="devfolio-tab-trigger" data-tab="experience"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="7" rx="2"/><path d="M16 3h-8l-2 4h12z"/></svg> Experience</button>
        <button class="devfolio-tab-trigger" data-tab="education"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 1.1 2.7 3 6 3s6-1.9 6-3v-5"/></svg> Education</button>
      </div>

      <!-- Skills Tab -->
      <div class="devfolio-tab-panel devfolio-tab-panel-active" data-panel="skills">
        <div class="devfolio-skills-grid">
          <?php if ( ! empty( $skill_groups ) ) : ?>
            <?php foreach ( $skill_groups as $group ) : ?>
              <?php $group_tags = devfolio_parse_tag_list( $group['tags'] ?? '' ); ?>
              <div class="devfolio-skill-group devfolio-glass">
                <?php if ( ! empty( $group['title'] ) ) : ?>
                  <h3 class="devfolio-gradient-text-accent"><?php echo esc_html( $group['title'] ?? '' ); ?></h3>
                <?php endif; ?>
                <?php if ( ! empty( $group_tags ) ) : ?>
                  <div class="devfolio-skill-tags">
                    <?php foreach ( $group_tags as $tag ) : ?>
                      <span class="devfolio-skill-tag"><?php echo esc_html( $tag ); ?></span>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

      <!-- Experience Tab -->
      <div class="devfolio-tab-panel" data-panel="experience">
        <div class="devfolio-timeline">
          <?php if ( $experience_query->have_posts() ) : ?>
            <?php while ( $experience_query->have_posts() ) : $experience_query->the_post(); ?>
              <?php
              $role     = get_post_meta( get_the_ID(), 'devfolio_experience_role', true );
              $period   = get_post_meta( get_the_ID(), 'devfolio_experience_period', true );
              $meta     = trim( $role . ( $period ? ( $role ? ' | ' : '' ) . $period : '' ) );
              $desc     = get_post_meta( get_the_ID(), 'devfolio_experience_desc', true );
              $icon_img = get_post_meta( get_the_ID(), 'devfolio_experience_icon_image', true );
              ?>
              <div class="devfolio-timeline-item">
                <div class="devfolio-timeline-dot"></div>
                <div class="devfolio-timeline-card devfolio-glass">
                  <div class="devfolio-job-header">
                    <div class="devfolio-job-icon"><?php echo devfolio_render_icon( $icon_img, $default_icon, get_the_title() ); ?></div>
                    <div>
                      <p class="devfolio-job-title"><?php the_title(); ?></p>
                      <p class="devfolio-job-meta"><?php echo esc_html( $meta ); ?></p>
                    </div>
                  </div>
                  <p class="devfolio-job-desc"><?php echo esc_html( $desc ? $desc : get_the_excerpt() ); ?></p>
                </div>
              </div>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php else : ?>
            <?php foreach ( $default_experience as $item ) : ?>
              <div class="devfolio-timeline-item">
                <div class="devfolio-timeline-dot"></div>
                <div class="devfolio-timeline-card devfolio-glass">
                  <div class="devfolio-job-header">
                    <div class="devfolio-job-icon"><?php echo devfolio_render_icon( '', $default_icon, $item['title'] ); ?></div>
                    <div>
                      <p class="devfolio-job-title"><?php echo esc_html( $item['title'] ); ?></p>
                      <p class="devfolio-job-meta"><?php echo esc_html( $item['meta'] ); ?></p>
                    </div>
                  </div>
                  <p class="devfolio-job-desc"><?php echo esc_html( $item['desc'] ); ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

      <!-- Education Tab -->
      <div class="devfolio-tab-panel" data-panel="education">
        <div class="devfolio-timeline devfolio-timeline-education">
          <?php if ( $education_query->have_posts() ) : ?>
            <?php while ( $education_query->have_posts() ) : $education_query->the_post(); ?>
              <?php
              $period   = get_post_meta( get_the_ID(), 'devfolio_education_period', true );
              $desc     = get_post_meta( get_the_ID(), 'devfolio_education_desc', true );
              $icon_img = get_post_meta( get_the_ID(), 'devfolio_education_icon_image', true );
              ?>
              <div class="devfolio-timeline-item">
                <div class="devfolio-timeline-dot devfolio-dot-accent"></div>
                <div class="devfolio-timeline-card devfolio-glass">
                  <div class="devfolio-job-header">
                    <div class="devfolio-job-icon devfolio-icon-accent"><?php echo devfolio_render_icon( $icon_img, $default_edu_icon, get_the_title() ); ?></div>
                    <div>
                      <p class="devfolio-job-title"><?php the_title(); ?></p>
                      <p class="devfolio-job-meta"><?php echo esc_html( $period ); ?></p>
                    </div>
                  </div>
                  <p class="devfolio-job-desc"><?php echo esc_html( $desc ? $desc : get_the_excerpt() ); ?></p>
                </div>
              </div>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php else : ?>
            <?php foreach ( $default_education as $item ) : ?>
              <div class="devfolio-timeline-item">
                <div class="devfolio-timeline-dot devfolio-dot-accent"></div>
                <div class="devfolio-timeline-card devfolio-glass">
                  <div class="devfolio-job-header">
                    <div class="devfolio-job-icon devfolio-icon-accent"><?php echo devfolio_render_icon( '', $default_edu_icon, $item['title'] ); ?></div>
                    <div>
                      <p class="devfolio-job-title"><?php echo esc_html( $item['title'] ); ?></p>
                      <p class="devfolio-job-meta"><?php echo esc_html( $item['meta'] ); ?></p>
                    </div>
                  </div>
                  <p class="devfolio-job-desc"><?php echo esc_html( $item['desc'] ); ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>
