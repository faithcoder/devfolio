<?php
/**
 * Homepage process section.
 *
 * @package devfolio
 */

$steps = devfolio_get_repeater_value(
	'devfolio_process_steps',
	array(
		array( 'num' => '01', 'title' => 'Clarify scope', 'desc' => 'Quick questions, no confusion.' ),
		array( 'num' => '02', 'title' => 'Plan', 'desc' => 'Estimate + milestones.' ),
		array( 'num' => '03', 'title' => 'Build', 'desc' => 'Staging first, clean commits.' ),
		array( 'num' => '04', 'title' => 'QA + Ship', 'desc' => 'Test, notes, smooth launch.' ),
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

if ( empty( $steps ) ) {
	return;
}
?>
<!-- Process -->
<section id="process" class="devfolio-section">
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
