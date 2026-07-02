<?php
/**
 * Homepage process section.
 *
 * @package devfolio
 */

$default_steps = array(
	array( 'num' => '01', 'title' => 'Architecture & Flowchart', 'desc' => 'Design robust application architecture and operation flowcharts for scalable enterprise systems.' ),
	array( 'num' => '02', 'title' => 'Backend & APIs', 'desc' => 'Develop secure, fast, and documented REST APIs focusing on logic, databases, and continuous integration.' ),
	array( 'num' => '03', 'title' => 'Frontend & Mobile UI', 'desc' => 'Build pixel-perfect user interfaces from Figma templates for Web and Mobile platforms.' ),
	array( 'num' => '04', 'title' => 'Unit Testing & Maintenance', 'desc' => 'Write thorough unit tests and fix ongoing bugs to maintain an excellent user experience.' ),
);
$steps = devfolio_get_repeater_value(
	'devfolio_process_steps',
	$default_steps
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
$process_label = devfolio_get_theme_mod_value( 'devfolio_process_label', 'Process' );
$process_title = devfolio_get_theme_mod_value( 'devfolio_process_title', 'How I work' );
$process_desc  = devfolio_get_theme_mod_value( 'devfolio_process_desc', '' );
$denim_section_title = devfolio_get_theme_mod_value( 'devfolio_denim_video_section_title', 'Denim Innovation Videography' );
$denim_section_desc  = devfolio_get_theme_mod_value( 'devfolio_denim_video_section_subtitle', 'YouTube and hosted videos presented in the same interactive 3D slider style.' );

$denim_video_query = new WP_Query(
	array(
		'post_type'      => 'devfolio_denim_video',
		'posts_per_page' => -1,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);

$denim_video_items = array();

if ( $denim_video_query->have_posts() ) {
	while ( $denim_video_query->have_posts() ) {
		$denim_video_query->the_post();

		$post_id      = get_the_ID();
		$source_type  = trim( (string) get_post_meta( $post_id, 'devfolio_denim_video_source_type', true ) );
		$youtube_url  = trim( (string) get_post_meta( $post_id, 'devfolio_denim_video_youtube_url', true ) );
		$hosted_video = trim( (string) get_post_meta( $post_id, 'devfolio_denim_video_hosted_file', true ) );
		$youtube_id   = devfolio_get_youtube_video_id( $youtube_url );

		if ( ! in_array( $source_type, array( 'youtube', 'hosted' ), true ) ) {
			$source_type = '' !== $youtube_id ? 'youtube' : 'hosted';
		}

		if ( 'youtube' === $source_type && '' === $youtube_id ) {
			continue;
		}

		if ( 'hosted' === $source_type && '' === $hosted_video ) {
			continue;
		}

		$thumbnail = devfolio_get_image_url( $post_id, 'devfolio_denim_video_thumbnail_url', '' );
		if ( '' === $thumbnail && '' !== $youtube_id ) {
			$thumbnail = sprintf( 'https://i.ytimg.com/vi/%s/hqdefault.jpg', rawurlencode( $youtube_id ) );
		}
		if ( '' === $thumbnail ) {
			$thumbnail = devfolio_get_video_placeholder_image( get_the_title() );
		}

		$denim_video_items[] = array(
			'src'         => $thumbnail,
			'title'       => get_the_title(),
			'subtitle'    => trim( (string) get_post_meta( $post_id, 'devfolio_denim_video_subtitle', true ) ),
			'description' => devfolio_excerpt_text( $post_id, 200 ),
			'video_type'  => $source_type,
			'video_src'   => 'youtube' === $source_type ? devfolio_get_youtube_embed_url( $youtube_id ) : esc_url( $hosted_video ),
		);
	}
	wp_reset_postdata();
}

if ( empty( $steps ) ) {
	$steps = array();
}

if ( empty( $steps ) && empty( $denim_video_items ) ) {
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

    <?php if ( ! empty( $denim_video_items ) ) : ?>
    <div class="devfolio-denim-innovation devfolio-anim devfolio-visible">
      <div class="devfolio-denim-innovation-head">
        <h3 class="devfolio-events-title"><?php echo esc_html( $denim_section_title ); ?></h3>
        <?php if ( ! empty( $denim_section_desc ) ) : ?>
        <p class="devfolio-events-subtitle"><?php echo esc_html( $denim_section_desc ); ?></p>
        <?php endif; ?>
      </div>
      <div class="devfolio-carousel devfolio-denim-carousel devfolio-denim-video-carousel" data-carousel-lightbox="video">
        <div class="devfolio-carousel-wrap">
          <div class="devfolio-carousel-viewport">
            <div class="devfolio-carousel-track">
              <?php foreach ( $denim_video_items as $index => $item ) : ?>
              <div
                class="devfolio-carousel-slide"
                data-slide="<?php echo esc_attr( $index ); ?>"
                data-src="<?php echo esc_url( $item['src'] ); ?>"
                data-title="<?php echo esc_attr( $item['title'] ); ?>"
                data-subtitle="<?php echo esc_attr( $item['subtitle'] ); ?>"
                data-description="<?php echo esc_attr( $item['description'] ); ?>"
                data-video-type="<?php echo esc_attr( $item['video_type'] ); ?>"
                data-video-src="<?php echo esc_url( $item['video_src'] ); ?>"
              >
                <div class="devfolio-carousel-card devfolio-glass">
                  <div class="devfolio-carousel-img-wrap">
                    <img src="<?php echo esc_url( $item['src'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" loading="lazy"/>
                    <div class="devfolio-carousel-img-overlay"></div>
                    <span class="devfolio-video-play-badge" aria-hidden="true">▶</span>
                    <div class="devfolio-carousel-caption">
                      <p class="devfolio-carousel-caption-title"><?php echo esc_html( $item['title'] ); ?></p>
                      <?php if ( ! empty( $item['subtitle'] ) ) : ?>
                      <p class="devfolio-carousel-caption-subtitle"><?php echo esc_html( $item['subtitle'] ); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <button class="devfolio-carousel-btn devfolio-carousel-prev" aria-label="Previous">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
          </button>
          <button class="devfolio-carousel-btn devfolio-carousel-next" aria-label="Next">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
          </button>
        </div>
        <div class="devfolio-carousel-dots"></div>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
