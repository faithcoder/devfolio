<?php
/**
 * Plugin feature section.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$fallback_image = get_template_directory_uri() . '/assets/images/checkoutly-dashboard-placeholder.svg';
$section_id     = devfolio_get_block_section_id( $args, 'plugin-feature' );
$title          = devfolio_get_block_attr( $args, 'titleText', 'A checkout your customers will love' );
$image          = devfolio_get_block_attr( $args, 'image', $fallback_image );
$features       = devfolio_get_block_array_attr(
	$args,
	'featureItems',
	array(
		array( 'text' => __( 'Clear progress steps', 'devfolio' ) ),
		array( 'text' => __( 'Clean, distraction-free UI', 'devfolio' ) ),
		array( 'text' => __( 'Trust at every step', 'devfolio' ) ),
	)
);

if ( '' === trim( $image ) ) {
	$image = $fallback_image;
}
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section devfolio-plugin-feature-split-section">
  <div class="devfolio-container">
    <div class="devfolio-plugin-feature-split">
      <div class="devfolio-plugin-feature-copy">
        <h2><?php echo esc_html( $title ); ?></h2>
        <?php if ( ! empty( $features ) ) : ?>
        <ul>
          <?php foreach ( $features as $feature ) : ?>
          <li>
            <span class="devfolio-plugin-feature-dot">
              <?php if ( ! empty( $feature['iconImage'] ) ) : ?>
              <img src="<?php echo esc_url( $feature['iconImage'] ); ?>" alt="">
              <?php endif; ?>
            </span>
            <span><?php echo esc_html( $feature['text'] ?? '' ); ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </div>
      <figure class="devfolio-plugin-screen devfolio-plugin-feature-screen">
        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( sprintf( __( '%s screenshot', 'devfolio' ), $title ) ); ?>">
      </figure>
    </div>
  </div>
</section>
