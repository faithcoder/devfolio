<?php
/**
 * Homepage skills section.
 *
 * @package devfolio
 */

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
$section_id = devfolio_get_section_id( 'skills' );

if ( empty( $skill_groups ) ) {
	return;
}
?>
<!-- Skills -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">Skills</p>
    <h2 class="devfolio-section-title devfolio-anim">Technical Arsenal</h2>
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
