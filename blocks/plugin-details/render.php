<?php
/**
 * Plugin detail section.
 *
 * Product-style landing layout for individual plugin pages.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$default_icon  = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>';
$download_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M12 4v12m0 0-4-4m4 4 4-4"/></svg>';
$github_icon   = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-4.466 19.59c-.405.078-.534-.171-.534-.384v-2.195c0-.747-.262-1.233-.55-1.481 1.782-.198 3.654-.875 3.654-3.947 0-.874-.312-1.588-.823-2.147.082-.202.356-1.016-.079-2.117 0 0-.671-.215-2.198.82-.64-.18-1.324-.267-2.004-.271-.68.003-1.364.091-2.003.269-1.528-1.035-2.2-.82-2.2-.82-.434 1.102-.16 1.915-.077 2.118-.512.56-.824 1.273-.824 2.147 0 3.064 1.867 3.751 3.645 3.954-.229.2-.436.552-.508 1.07-.457.204-1.614.557-2.328-.666 0 0-.423-.768-1.227-.825 0 0-.78-.01-.055.487 0 0 .525.246.889 1.17 0 0 .463 1.428 2.688.944v1.489c0 .211-.129.459-.528.385-3.18-1.057-5.472-4.056-5.472-7.59 0-4.419 3.582-8 8-8s8 3.581 8 8c0 3.533-2.289 6.531-5.466 7.59z"/></svg>';

$section_id = devfolio_get_block_section_id( $args, 'plugin-details' );
$title      = devfolio_get_block_attr( $args, 'titleText', get_the_title() );
$desc       = devfolio_get_block_attr( $args, 'desc', '' );
$features   = devfolio_parse_tag_list( devfolio_get_block_attr( $args, 'features', '' ) );
$tags       = devfolio_parse_tag_list( devfolio_get_block_attr( $args, 'tags', '' ) );
$github     = trim( devfolio_get_block_attr( $args, 'github', '' ) );
$downloads  = devfolio_format_download_count( devfolio_get_block_attr( $args, 'downloads', '' ), $title );
$icon       = devfolio_get_block_attr( $args, 'icon', '' );
$icon_image = devfolio_get_block_attr( $args, 'iconImage', '' );
$back_text  = devfolio_get_block_attr( $args, 'backText', 'Back to Plugins' );
$back_url   = devfolio_get_block_attr( $args, 'backUrl', home_url( '/' ) . '#plugins' );

$is_checkoutly = false !== stripos( $title, 'checkoutly' );
$hero_title    = $is_checkoutly ? __( 'A better checkout. More completed orders.', 'devfolio' ) : sprintf( __( '%s, ready for WordPress.', 'devfolio' ), $title );
$hero_desc     = $desc ? $desc : __( 'A focused WordPress plugin built to make daily workflows faster, cleaner, and easier to manage.', 'devfolio' );
$badge_text    = $is_checkoutly ? __( 'Free WooCommerce Plugin', 'devfolio' ) : __( 'Free WordPress Plugin', 'devfolio' );
$screenshot    = get_template_directory_uri() . '/assets/images/checkoutly-dashboard-placeholder.svg';

if ( empty( $features ) ) {
	$features = $is_checkoutly
		? array(
			__( 'Multi-step checkout workflow', 'devfolio' ),
			__( 'Reorder and control native fields', 'devfolio' ),
			__( 'Add custom checkout fields', 'devfolio' ),
			__( 'Save custom data to order meta', 'devfolio' ),
		)
		: array(
			__( 'Simple setup', 'devfolio' ),
			__( 'Editor-friendly controls', 'devfolio' ),
			__( 'Lightweight front-end output', 'devfolio' ),
			__( 'Built for maintainability', 'devfolio' ),
		);
}

$benefits = $is_checkoutly
	? array(
		array( 'title' => __( 'Faster Checkout', 'devfolio' ), 'desc' => __( 'Reduce steps and time to complete.', 'devfolio' ), 'icon' => 'bolt' ),
		array( 'title' => __( 'Fewer Abandoned Carts', 'devfolio' ), 'desc' => __( 'Remove friction that stops customers from buying.', 'devfolio' ), 'icon' => 'cart' ),
		array( 'title' => __( 'Mobile Ready', 'devfolio' ), 'desc' => __( 'Optimized checkout control on every device.', 'devfolio' ), 'icon' => 'phone' ),
	)
	: array(
		array( 'title' => __( 'Fast Setup', 'devfolio' ), 'desc' => __( 'Install and configure without heavy setup work.', 'devfolio' ), 'icon' => 'bolt' ),
		array( 'title' => __( 'Practical Controls', 'devfolio' ), 'desc' => __( 'Manage the important settings from WordPress.', 'devfolio' ), 'icon' => 'cart' ),
		array( 'title' => __( 'Clean Output', 'devfolio' ), 'desc' => __( 'Lightweight markup that fits modern themes.', 'devfolio' ), 'icon' => 'phone' ),
	);

$feature_cards = $is_checkoutly
	? array(
		array( 'title' => __( 'Field Manager', 'devfolio' ), 'desc' => __( 'Add, remove, or reorder checkout fields with drag and drop.', 'devfolio' ) ),
		array( 'title' => __( 'One-Page Checkout', 'devfolio' ), 'desc' => __( 'Show everything on one smooth purchase page.', 'devfolio' ) ),
		array( 'title' => __( 'Order Bumps', 'devfolio' ), 'desc' => __( 'Increase order value with relevant offers at checkout.', 'devfolio' ) ),
		array( 'title' => __( 'Smart Checkout Rules', 'devfolio' ), 'desc' => __( 'Show or hide fields based on shipping, payment, or customer choices.', 'devfolio' ) ),
	)
	: array_map(
		static function ( $feature ) {
			return array(
				'title' => $feature,
				'desc'  => __( 'A focused feature designed for real WordPress workflows.', 'devfolio' ),
			);
		},
		array_slice( $features, 0, 4 )
	);

$steps = array(
	array( 'title' => __( 'Install', 'devfolio' ), 'desc' => __( 'Add the plugin to WordPress and activate it.', 'devfolio' ) ),
	array( 'title' => __( 'Customize', 'devfolio' ), 'desc' => __( 'Adjust fields, steps, rules, and display settings.', 'devfolio' ) ),
	array( 'title' => __( 'Publish', 'devfolio' ), 'desc' => __( 'Launch the improved experience on your store.', 'devfolio' ) ),
);
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section devfolio-plugin-details-section">
  <div class="devfolio-container">
    <a class="devfolio-plugin-details-back" href="<?php echo esc_url( $back_url ); ?>">
      <span aria-hidden="true">&#8592;</span>
      <?php echo esc_html( $back_text ); ?>
    </a>

    <div class="devfolio-plugin-landing">
      <div class="devfolio-plugin-hero">
        <div class="devfolio-plugin-hero-copy">
          <div class="devfolio-plugin-hero-brand">
            <span class="devfolio-plugin-brand-icon"><?php echo devfolio_render_icon( $icon_image, $icon ? $icon : $default_icon, $title ); ?></span>
            <span><?php echo esc_html( $title ); ?></span>
          </div>
          <span class="devfolio-plugin-badge"><?php echo esc_html( $badge_text ); ?></span>
          <h1><?php echo esc_html( $hero_title ); ?></h1>
          <p><?php echo esc_html( $hero_desc ); ?></p>
          <div class="devfolio-plugin-hero-actions">
            <?php if ( devfolio_has_valid_url( $github ) ) : ?>
            <a class="devfolio-btn devfolio-plugin-primary-cta" href="<?php echo esc_url( $github ); ?>" target="_blank" rel="noopener noreferrer">
              <?php echo $github_icon; ?>
              <?php esc_html_e( 'Download Free', 'devfolio' ); ?>
            </a>
            <?php endif; ?>
            <span class="devfolio-plugin-download-count">
              <?php echo $download_icon; ?>
              <span><?php echo esc_html( $downloads ); ?></span>
              <?php esc_html_e( 'downloads', 'devfolio' ); ?>
            </span>
          </div>
        </div>

        <figure class="devfolio-plugin-screenshot devfolio-plugin-screenshot-hero devfolio-glass">
          <img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php echo esc_attr( sprintf( __( '%s dashboard screenshot placeholder', 'devfolio' ), $title ) ); ?>">
        </figure>
      </div>

      <div class="devfolio-plugin-benefit-strip devfolio-glass">
        <?php foreach ( $benefits as $benefit ) : ?>
        <div>
          <span class="devfolio-benefit-icon devfolio-benefit-<?php echo esc_attr( $benefit['icon'] ); ?>"></span>
          <strong><?php echo esc_html( $benefit['title'] ); ?></strong>
          <p><?php echo esc_html( $benefit['desc'] ); ?></p>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="devfolio-plugin-feature-section">
        <h2><?php esc_html_e( 'Everything your checkout actually needs', 'devfolio' ); ?></h2>
        <div class="devfolio-plugin-feature-grid">
          <?php foreach ( $feature_cards as $index => $card ) : ?>
          <article class="devfolio-plugin-feature-card devfolio-glass">
            <span class="devfolio-plugin-feature-mark"><?php echo esc_html( $index + 1 ); ?></span>
            <h3><?php echo esc_html( $card['title'] ); ?></h3>
            <p><?php echo esc_html( $card['desc'] ); ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="devfolio-plugin-steps">
        <h2><?php esc_html_e( 'Live in three simple steps', 'devfolio' ); ?></h2>
        <div class="devfolio-plugin-step-grid">
          <?php foreach ( $steps as $index => $step ) : ?>
          <article class="devfolio-plugin-step-card devfolio-glass">
            <span><?php echo esc_html( $index + 1 ); ?></span>
            <h3><?php echo esc_html( $step['title'] ); ?></h3>
            <p><?php echo esc_html( $step['desc'] ); ?></p>
          </article>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="devfolio-plugin-admin-preview">
        <div class="devfolio-plugin-admin-copy">
          <h2><?php esc_html_e( 'Your checkout, controlled from WordPress', 'devfolio' ); ?></h2>
          <p><?php esc_html_e( 'Manage fields, checkout steps, order options, and the customer-facing preview without leaving your dashboard.', 'devfolio' ); ?></p>
        </div>
        <figure class="devfolio-plugin-screenshot devfolio-glass">
          <img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Checkoutly WordPress dashboard screenshot placeholder', 'devfolio' ); ?>">
        </figure>
      </div>

      <div class="devfolio-plugin-customer-preview">
        <div class="devfolio-plugin-customer-copy">
          <h2><?php esc_html_e( 'A checkout your customers will love', 'devfolio' ); ?></h2>
          <ul>
            <li><?php esc_html_e( 'Clear progress steps', 'devfolio' ); ?></li>
            <li><?php esc_html_e( 'Clean, distraction-free UI', 'devfolio' ); ?></li>
            <li><?php esc_html_e( 'Trust at every step', 'devfolio' ); ?></li>
          </ul>
        </div>
        <figure class="devfolio-plugin-screenshot devfolio-glass">
          <img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Checkoutly checkout screen screenshot placeholder', 'devfolio' ); ?>">
        </figure>
      </div>

      <div class="devfolio-plugin-compat devfolio-glass">
        <span><?php esc_html_e( 'Works with WooCommerce', 'devfolio' ); ?></span>
        <span><?php esc_html_e( 'Compatible with the latest WordPress versions', 'devfolio' ); ?></span>
      </div>

      <div class="devfolio-plugin-final-cta">
        <span class="devfolio-plugin-brand-icon"><?php echo devfolio_render_icon( $icon_image, $icon ? $icon : $default_icon, $title ); ?></span>
        <h2><?php esc_html_e( 'Make every checkout feel effortless', 'devfolio' ); ?></h2>
        <?php if ( devfolio_has_valid_url( $github ) ) : ?>
        <a class="devfolio-btn devfolio-plugin-primary-cta" href="<?php echo esc_url( $github ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Start with Checkoutly', 'devfolio' ); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
