<?php
/**
 * Homepage process section.
 *
 * @package devfolio
 */

$steps = devfolio_get_repeater_value(
	'devfolio_process_steps',
	array(
		array( 'num' => '01', 'title' => 'Clarify Scope', 'desc' => 'Understand the core issue, reproduce gracefully, and clear up any confusion immediately.' ),
		array( 'num' => '02', 'title' => 'Debug & Plan', 'desc' => 'Dig deep into conflicts, create test environments, and find optimal, non-invasive solutions.' ),
		array( 'num' => '03', 'title' => 'Build or Fix', 'desc' => 'Write custom code, adjust configurations, or provide foolproof steps to resolve the problem.' ),
		array( 'num' => '04', 'title' => 'Document & QA', 'desc' => 'Test thoroughly, deliver screencasts or knowledgebase articles for extended support.' ),
	)
);

$steps = array_values(
	array_filter(
		(array) $steps,
		static function ( $step ) {
			$num   = trim( (string) ( $step['num'] ?? '' ) );
			$title = trim( (string) ( $step['title'] ?? '' ) );
			$desc  = trim( (string) ( $step['desc'] ?? '' ) );
			return '' !== $num || '' !== $title || '' !== $desc;
		}
	)
);

$section_id = devfolio_get_section_id( 'process' );

if ( empty( $steps ) ) {
	return;
}
?>
<!-- Process -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">Process</p>
    <h2 class="devfolio-section-title devfolio-anim">How I work</h2>
    <div class="devfolio-process-grid">
      <?php foreach ( $steps as $step ) : ?>
      <div class="devfolio-process-card devfolio-glass devfolio-anim">
        <?php if ( ! empty( $step['num'] ) ) : ?><span class="devfolio-process-num devfolio-gradient-text"><?php echo esc_html( $step['num'] ?? '' ); ?></span><?php endif; ?>
        <?php if ( ! empty( $step['title'] ) ) : ?><h3><?php echo esc_html( $step['title'] ?? '' ); ?></h3><?php endif; ?>
        <?php if ( ! empty( $step['desc'] ) ) : ?><p><?php echo esc_html( $step['desc'] ?? '' ); ?></p><?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
