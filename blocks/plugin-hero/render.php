<?php
/**
 * Plugin hero section.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$default_icon   = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 1.5 21 6.7v10.6l-9 5.2-9-5.2V6.7l9-5.2Zm0 3.1L5.7 8.2v7.3L12 19.1l6.3-3.6V8.2L12 4.6Zm0 3.3 3.5 2v4.2l-3.5 2-3.5-2V9.9l3.5-2Z"/></svg>';
$download_icon  = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M12 4v12m0 0-4-4m4 4 4-4"/></svg>';
$setup_icon     = '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m13 2-8 12h6l-1 8 8-12h-6l1-8Z"/></svg>';
$controls_icon  = '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>';
$output_icon    = '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8 4h8v16H8zM11 18h2"/></svg>';
$fallback_image = get_template_directory_uri() . '/assets/images/checkoutly-dashboard-placeholder.svg';

$section_id   = devfolio_get_block_section_id( $args, 'plugin-hero' );
$product_name = devfolio_get_block_attr( $args, 'productName', 'ShopApp' );
$title        = devfolio_get_block_attr( $args, 'titleText', 'ShopApp — WooCommerce Product Grid Block, ready for WordPress.' );
$desc         = devfolio_get_block_attr( $args, 'desc', 'ShopApp is a custom WordPress block plugin that presents WooCommerce products in a clean, app-inspired shopping interface.' );
$button_text  = devfolio_get_block_attr( $args, 'buttonText', 'Download Free' );
$button_url   = trim( devfolio_get_block_attr( $args, 'buttonUrl', '' ) );
$downloads    = devfolio_get_block_attr( $args, 'downloads', '2.3K' );
$image        = devfolio_get_block_attr( $args, 'image', $fallback_image );
$icon_image   = devfolio_get_block_attr( $args, 'iconImage', '' );
$benefits     = devfolio_get_block_array_attr(
	$args,
	'benefitItems',
	array(
		array( 'title' => __( 'Fast Setup', 'devfolio' ), 'desc' => __( 'Install and configure without heavy setup work.', 'devfolio' ), 'icon' => $setup_icon ),
		array( 'title' => __( 'Practical Controls', 'devfolio' ), 'desc' => __( 'Manage the important settings from WordPress.', 'devfolio' ), 'icon' => $controls_icon ),
		array( 'title' => __( 'Clean Output', 'devfolio' ), 'desc' => __( 'Lightweight markup that fits modern themes.', 'devfolio' ), 'icon' => $output_icon ),
	)
);

if ( '' === trim( $image ) ) {
	$image = $fallback_image;
}
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section devfolio-plugin-hero-section">
  <div class="devfolio-container">
    <div class="devfolio-plugin-hero-layout">
      <div class="devfolio-plugin-hero-copy">
        <div class="devfolio-plugin-product-mark">
          <span class="devfolio-plugin-product-icon"><?php echo devfolio_render_icon( $icon_image, $default_icon, $product_name ); ?></span>
          <span><?php echo esc_html( $product_name ); ?></span>
        </div>
        <h1><?php echo esc_html( $title ); ?></h1>
        <?php if ( '' !== trim( $desc ) ) : ?>
        <p><?php echo esc_html( $desc ); ?></p>
        <?php endif; ?>
        <div class="devfolio-plugin-hero-actions">
          <?php if ( devfolio_has_valid_url( $button_url ) ) : ?>
          <a class="devfolio-btn devfolio-plugin-download-btn" href="<?php echo esc_url( $button_url ); ?>" target="_blank" rel="noopener noreferrer">
            <?php echo $default_icon; ?>
            <?php echo esc_html( $button_text ); ?>
          </a>
          <?php endif; ?>
          <span class="devfolio-plugin-download-meta">
            <?php echo $download_icon; ?>
            <strong><?php echo esc_html( $downloads ); ?></strong>
            <span><?php esc_html_e( 'downloads', 'devfolio' ); ?></span>
          </span>
        </div>
      </div>
      <figure class="devfolio-plugin-screen devfolio-plugin-hero-screen">
        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( sprintf( __( '%s product screenshot', 'devfolio' ), $product_name ) ); ?>">
      </figure>
    </div>

    <?php if ( ! empty( $benefits ) ) : ?>
    <div class="devfolio-plugin-benefits devfolio-glass">
      <?php foreach ( $benefits as $benefit ) : ?>
      <article>
        <span class="devfolio-plugin-benefit-icon">
          <?php echo devfolio_render_icon( $benefit['iconImage'] ?? '', $benefit['icon'] ?? '', $benefit['title'] ?? __( 'Benefit', 'devfolio' ) ); ?>
        </span>
        <div>
          <h2><?php echo esc_html( $benefit['title'] ?? '' ); ?></h2>
          <p><?php echo esc_html( $benefit['desc'] ?? '' ); ?></p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>
