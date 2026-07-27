<?php
/**
 * Homepage process section.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$default_steps = array(
	array( 'num' => '01', 'title' => 'Architecture & Flowchart', 'desc' => 'Design robust application architecture and operation flowcharts for scalable enterprise systems.' ),
	array( 'num' => '02', 'title' => 'Backend & APIs', 'desc' => 'Develop secure, fast, and documented REST APIs focusing on logic, databases, and continuous integration.' ),
	array( 'num' => '03', 'title' => 'Frontend & Mobile UI', 'desc' => 'Build pixel-perfect user interfaces from Figma templates for Web and Mobile platforms.' ),
	array( 'num' => '04', 'title' => 'Unit Testing & Maintenance', 'desc' => 'Write thorough unit tests and fix ongoing bugs to maintain an excellent user experience.' ),
);
$steps = devfolio_get_block_array_attr( $args, 'steps', $default_steps );

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
$process_label = devfolio_get_block_attr( $args, 'label', 'Process' );
$process_title = devfolio_get_block_attr( $args, 'titleText', 'How I work' );
$process_desc  = devfolio_get_block_attr( $args, 'desc', '' );

if ( empty( $steps ) ) {
	$steps = array();
}

if ( empty( $steps ) ) {
	return;
}
?>
<!-- Process -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim"><?php echo esc_html( $process_label ); ?></p>
    <h2 class="devfolio-section-title devfolio-anim"><?php echo esc_html( $process_title ); ?></h2>
    <?php if ( ! empty( $process_desc ) ) : ?>
    <p class="devfolio-section-desc devfolio-anim"><?php echo esc_html( $process_desc ); ?></p>
    <?php endif; ?>
    <?php if ( ! empty( $steps ) ) : ?>
    <div class="devfolio-process-grid">
      <?php foreach ( $steps as $step ) : ?>
      <div class="devfolio-process-card devfolio-glass devfolio-anim">
        <?php if ( ! empty( $step['num'] ) ) : ?><span class="devfolio-process-num devfolio-gradient-text"><?php echo esc_html( $step['num'] ?? '' ); ?></span><?php endif; ?>
        <?php if ( ! empty( $step['title'] ) ) : ?><h3><?php echo esc_html( $step['title'] ?? '' ); ?></h3><?php endif; ?>
        <?php if ( ! empty( $step['desc'] ) ) : ?><p><?php echo esc_html( $step['desc'] ?? '' ); ?></p><?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>
