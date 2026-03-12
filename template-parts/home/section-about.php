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
		array( 'title' => 'Languages', 'tags' => 'PHP, JavaScript (ES6+), TypeScript, SQL' ),
		array( 'title' => 'WordPress', 'tags' => 'Plugin/Theme Dev, WP-CLI, REST API, Gutenberg Blocks' ),
		array( 'title' => 'Frameworks', 'tags' => 'Laravel, React.js, Vue.js, Tailwind CSS' ),
		array( 'title' => 'DevOps', 'tags' => 'Docker, CI/CD Pipelines, Git, Composer' ),
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
	array( 'title' => 'Convey Digital', 'meta' => 'Senior WordPress Developer (Contract) | May 2025 – Dec 2025', 'desc' => 'Delivered high-performance, secure B2B WordPress solutions for enterprise clients.' ),
	array( 'title' => 'InstaWP', 'meta' => 'Team Lead & Senior WordPress Developer | Sep 2022 – Apr 2025', 'desc' => 'Architected and built the InstaWP Connect plugin from the ground up.' ),
	array( 'title' => 'UpdraftPlus', 'meta' => 'WordPress Plugin Developer | Jun 2021 – Aug 2022', 'desc' => 'Maintained one of the world\'s most popular backup plugins with 3M+ active installs.' ),
	array( 'title' => 'PickPlugins', 'meta' => 'Lead WordPress Developer | Jun 2014 – May 2020', 'desc' => 'Anchored the team for 6 years, managing flagship plugins.' ),
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
	array( 'title' => 'B.Sc. in Computer Science & Engineering', 'meta' => 'Begum Rokeya University, Rangpur | 2015 – 2019', 'desc' => 'Focused on software engineering, algorithms, and web technologies.' ),
	array( 'title' => 'Higher Secondary Certificate (HSC)', 'meta' => 'Rangpur Cadet College | 2012 – 2014', 'desc' => 'Science group with emphasis on mathematics and physics.' ),
	array( 'title' => 'Secondary School Certificate (SSC)', 'meta' => 'Rangpur Zilla School | 2010 – 2012', 'desc' => 'Achieved top marks in science and mathematics.' ),
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
