<?php
/**
 * Template part: About.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$skill_groups = devfolio_get_block_array_attr(
	$args,
	'skillGroups',
	array(
		array( 'title' => 'Programming Languages', 'tags' => 'PHP, Javascript, Python' ),
		array( 'title' => 'Frameworks & Platforms', 'tags' => 'Laravel, Vue.Js, Node/Express.Js, React.Js, React Native, Next.Js, Flutter' ),
		array( 'title' => 'Databases & Backend', 'tags' => 'SQL (MySQL, PostgreSQL), NoSQL (MongoDB), JWT, Passport, REST API' ),
		array( 'title' => 'Frontend & Tools', 'tags' => 'HTML, CSS, Tailwind CSS, Material UI, Docker, Git, GitHub, GitLab, Linux' ),
	)
);

$default_experience = array(
	array( 'title' => 'REALTY.COM, LLC.', 'meta' => 'Software Engineer (Full Stack) | April 2022 - Present', 'desc' => 'Developing & maintaining mobile apps, designing architecture, writing unit tests, and developing backend REST APIs for 1M+ active listings.', 'iconImage' => '' ),
	array( 'title' => 'EXPRESS SYSTEMS & PARTS NETWORK INC.', 'meta' => 'Software Engineer (Full Stack) | November 2021 - April 2022', 'desc' => 'Designed architecture, developed mobile apps, backend REST APIs, and e-commerce sites for medical equipment services.', 'iconImage' => '' ),
	array( 'title' => 'TF INTERNET ApS', 'meta' => 'Software Engineer | June 2019 - November 2021', 'desc' => 'Worked for Denmark-based IT firm creating client and in-house products, handling full-stack development and UI implementations.', 'iconImage' => '' ),
	array( 'title' => 'LinkingCC', 'meta' => 'Junior Software Engineer | January 2018 - June 2019', 'desc' => 'Contributed to 20+ live projects developing web-based applications and fixing bugs on existing applications.', 'iconImage' => '' ),
);

$default_education = array(
	array( 'title' => 'B.Sc. in Computer Science and Engineering', 'meta' => 'International University of Scholars | 2023 - Present', 'desc' => 'Currently pursuing undergraduate degree in Computer Science.', 'iconImage' => '' ),
	array( 'title' => 'Diploma in Telecommunication Engineering', 'meta' => 'Jashore Polytechnic Institute | 2016 - 2021', 'desc' => 'Completed diploma in Telecommunication Engineering.', 'iconImage' => '' ),
	array( 'title' => 'Secondary School Certificate', 'meta' => 'RB Govt High School, Joypurhat | 2015 - 2016', 'desc' => 'Completed secondary education.', 'iconImage' => '' ),
);

$experience_items = devfolio_get_block_array_attr( $args, 'experienceItems', $default_experience );
$education_items  = devfolio_get_block_array_attr( $args, 'educationItems', $default_education );
$default_icon     = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="7" rx="2"/><path d="M16 3h-8l-2 4h12z"/></svg>';
$default_edu_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c0 1.1 2.7 3 6 3s6-1.9 6-3v-5"/></svg>';
$about_label      = devfolio_get_block_attr( $args, 'label', 'About Me' );
$about_title      = devfolio_get_block_attr( $args, 'titleText', 'Skills, Experience & Education' );
$about_desc       = devfolio_get_block_attr( $args, 'desc', '' );
$about_tab_skills = devfolio_get_block_attr( $args, 'tabSkills', 'Skills' );
$about_tab_exp    = devfolio_get_block_attr( $args, 'tabExperience', 'Experience' );
$about_tab_edu    = devfolio_get_block_attr( $args, 'tabEducation', 'Education' );
$section_id       = devfolio_get_block_section_id( $args, 'about' );
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim"><?php echo esc_html( $about_label ); ?></p>
    <h2 class="devfolio-section-title devfolio-anim"><?php echo esc_html( $about_title ); ?></h2>
    <?php if ( ! empty( $about_desc ) ) : ?><p class="devfolio-section-desc devfolio-anim"><?php echo esc_html( $about_desc ); ?></p><?php endif; ?>
    <div class="devfolio-tabs devfolio-anim">
      <div class="devfolio-tabs-list">
        <button class="devfolio-tab-trigger" data-tab="skills"><?php echo esc_html( $about_tab_skills ); ?></button>
        <button class="devfolio-tab-trigger devfolio-tab-active" data-tab="experience"><?php echo esc_html( $about_tab_exp ); ?></button>
        <button class="devfolio-tab-trigger" data-tab="education"><?php echo esc_html( $about_tab_edu ); ?></button>
      </div>
      <div class="devfolio-tab-panel" data-panel="skills"><div class="devfolio-skills-grid"><?php foreach ( $skill_groups as $group ) : $group_tags = devfolio_parse_tag_list( $group['tags'] ?? '' ); ?><div class="devfolio-skill-group devfolio-glass"><?php if ( ! empty( $group['title'] ) ) : ?><h3 class="devfolio-gradient-text-accent"><?php echo esc_html( $group['title'] ); ?></h3><?php endif; ?><?php if ( ! empty( $group_tags ) ) : ?><div class="devfolio-skill-tags"><?php foreach ( $group_tags as $tag ) : ?><span class="devfolio-skill-tag"><?php echo esc_html( $tag ); ?></span><?php endforeach; ?></div><?php endif; ?></div><?php endforeach; ?></div></div>
      <div class="devfolio-tab-panel devfolio-tab-panel-active" data-panel="experience"><div class="devfolio-timeline"><?php foreach ( $experience_items as $item ) : ?><div class="devfolio-timeline-item"><div class="devfolio-timeline-dot"></div><div class="devfolio-timeline-card devfolio-glass"><div class="devfolio-job-header"><div class="devfolio-job-icon"><?php echo devfolio_render_icon( $item['iconImage'] ?? '', $default_icon, $item['title'] ?? '' ); ?></div><div><p class="devfolio-job-title"><?php echo esc_html( $item['title'] ?? '' ); ?></p><p class="devfolio-job-meta"><?php echo esc_html( $item['meta'] ?? '' ); ?></p></div></div><p class="devfolio-job-desc"><?php echo esc_html( $item['desc'] ?? '' ); ?></p></div></div><?php endforeach; ?></div></div>
      <div class="devfolio-tab-panel" data-panel="education"><div class="devfolio-timeline devfolio-timeline-education"><?php foreach ( $education_items as $item ) : ?><div class="devfolio-timeline-item"><div class="devfolio-timeline-dot devfolio-dot-accent"></div><div class="devfolio-timeline-card devfolio-glass"><div class="devfolio-job-header"><div class="devfolio-job-icon devfolio-icon-accent"><?php echo devfolio_render_icon( $item['iconImage'] ?? '', $default_edu_icon, $item['title'] ?? '' ); ?></div><div><p class="devfolio-job-title"><?php echo esc_html( $item['title'] ?? '' ); ?></p><p class="devfolio-job-meta"><?php echo esc_html( $item['meta'] ?? '' ); ?></p></div></div><p class="devfolio-job-desc"><?php echo esc_html( $item['desc'] ?? '' ); ?></p></div></div><?php endforeach; ?></div></div>
    </div>
  </div>
</section>
