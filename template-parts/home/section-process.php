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
?>
<!-- Process -->
<section id="process" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">Process</p>
    <h2 class="devfolio-section-title devfolio-anim">How I work</h2>
    <div class="devfolio-process-grid">
      <?php foreach ( $steps as $step ) : ?>
      <div class="devfolio-process-card devfolio-glass devfolio-anim"><span class="devfolio-process-num devfolio-gradient-text"><?php echo esc_html( $step['num'] ?? '' ); ?></span><h3><?php echo esc_html( $step['title'] ?? '' ); ?></h3><p><?php echo esc_html( $step['desc'] ?? '' ); ?></p></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
