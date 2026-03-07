<?php
/**
 * Homepage skills section.
 *
 * @package devfolio
 */

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
$section_id = devfolio_get_section_id( 'skills' );

if ( empty( $skill_groups ) ) {
	return;
}
?>
<!-- Skills -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">Skills</p>
    <h2 class="devfolio-section-title devfolio-anim">Skills & Toolset</h2>
    <div class="devfolio-skills-grid">
      <?php foreach ( $skill_groups as $group ) : ?>
      <?php $group_tags = devfolio_parse_tag_list( $group['tags'] ?? '' ); ?>
      <div class="devfolio-skill-group devfolio-glass devfolio-anim">
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
    </div>
  </div>
</section>
