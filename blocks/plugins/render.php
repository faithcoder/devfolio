<?php
/**
 * Homepage plugins section.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$default_plugins = array(
	array(
		'title'     => 'Devfolio Social Share',
		'desc'      => 'Adds beautiful social sharing buttons to posts, pages, and custom post types with customizable design and placement options.',
		'features'  => 'Customizable button styles, Floating sidebar support, Shortcode ready, Lightweight & fast',
		'tags'      => 'WordPress, PHP, Social',
		'downloads' => '2.4K',
		'github'    => 'https://github.com/username/devfolio-social-share',
	),
	array(
		'title'     => 'Devfolio SEO Toolkit',
		'desc'      => 'A lightweight SEO plugin that helps you optimize meta tags, Open Graph, Twitter Cards, and schema markup without bloat.',
		'features'  => 'Meta tag management, Open Graph support, XML sitemap generation, Schema markup',
		'tags'      => 'WordPress, SEO, PHP',
		'downloads' => '5.1K',
		'github'    => 'https://github.com/username/devfolio-seo-toolkit',
	),
	array(
		'title'     => 'Devfolio Contact Forms',
		'desc'      => 'Drag-and-drop form builder with spam protection, email notifications, and entries management dashboard.',
		'features'  => 'Drag & drop builder, Spam protection, Email notifications, Entries dashboard',
		'tags'      => 'WordPress, PHP, JavaScript',
		'downloads' => '1.8K',
		'github'    => 'https://github.com/username/devfolio-contact-forms',
	),
);

$plugin_default_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>';
$plugin_download_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M12 4v12m0 0-4-4m4 4 4-4"/></svg>';
$plugin_github_icon  = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-4.466 19.59c-.405.078-.534-.171-.534-.384v-2.195c0-.747-.262-1.233-.55-1.481 1.782-.198 3.654-.875 3.654-3.947 0-.874-.312-1.588-.823-2.147.082-.202.356-1.016-.079-2.117 0 0-.671-.215-2.198.82-.64-.18-1.324-.267-2.004-.271-.68.003-1.364.091-2.003.269-1.528-1.035-2.2-.82-2.2-.82-.434 1.102-.16 1.915-.077 2.118-.512.56-.824 1.273-.824 2.147 0 3.064 1.867 3.751 3.645 3.954-.229.2-.436.552-.508 1.07-.457.204-1.614.557-2.328-.666 0 0-.423-.768-1.227-.825 0 0-.78-.01-.055.487 0 0 .525.246.889 1.17 0 0 .463 1.428 2.688.944v1.489c0 .211-.129.459-.528.385-3.18-1.057-5.472-4.056-5.472-7.59 0-4.419 3.582-8 8-8s8 3.581 8 8c0 3.533-2.289 6.531-5.466 7.59z"/></svg>';

$plugins             = devfolio_get_block_array_attr( $args, 'pluginItems', $default_plugins );
$section_id          = devfolio_get_block_section_id( $args, 'plugins' );
$plugins_label       = devfolio_get_block_attr( $args, 'label', 'Free Plugins' );
$plugins_title       = devfolio_get_block_attr( $args, 'titleText', 'Open Source WordPress Plugins' );
$plugins_desc        = devfolio_get_block_attr( $args, 'desc', 'Free plugins built for the WordPress community. Download, contribute, or use them in your projects.' );
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim"><?php echo esc_html( $plugins_label ); ?></p>
    <h2 class="devfolio-section-title devfolio-anim"><?php echo esc_html( $plugins_title ); ?></h2>
    <?php if ( ! empty( $plugins_desc ) ) : ?>
    <p class="devfolio-plugins-subtitle devfolio-anim"><?php echo esc_html( $plugins_desc ); ?></p>
    <?php endif; ?>
    <div class="devfolio-plugins-grid">
      <?php foreach ( $plugins as $plugin_index => $plugin ) :
        $plugin_tags     = devfolio_parse_tag_list( $plugin['tags'] ?? '' );
        $plugin_features = devfolio_parse_tag_list( $plugin['features'] ?? '' );
        $github_url      = trim( $plugin['github'] ?? '' );
        $downloads       = devfolio_format_download_count( $plugin['downloads'] ?? '', $plugin['title'] ?? ( 'plugin-' . $plugin_index ) );
      ?>
      <div
        class="devfolio-plugin-card devfolio-glass devfolio-anim"
        data-title="<?php echo esc_attr( $plugin['title'] ?? '' ); ?>"
        data-desc="<?php echo esc_attr( $plugin['desc'] ?? '' ); ?>"
        data-features="<?php echo esc_attr( wp_json_encode( $plugin_features ) ); ?>"
        data-tags="<?php echo esc_attr( wp_json_encode( $plugin_tags ) ); ?>"
        data-downloads="<?php echo esc_attr( $downloads ); ?>"
        data-github="<?php echo esc_url( $github_url ); ?>"
      >
        <div class="devfolio-plugin-icon">
          <?php echo devfolio_render_icon( $plugin['iconImage'] ?? '', $plugin['icon'] ?? $plugin_default_icon, $plugin['title'] ?? 'Plugin Icon' ); ?>
        </div>
        <h3><?php echo esc_html( $plugin['title'] ?? '' ); ?></h3>
        <p class="devfolio-plugin-desc"><?php echo esc_html( $plugin['desc'] ?? '' ); ?></p>
        <div class="devfolio-plugin-card-footer">
          <button type="button" class="devfolio-btn devfolio-plugin-learn-btn" data-plugin-open>
            <?php esc_html_e( 'Learn More', 'devfolio' ); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7 7 7-7 7"/></svg>
          </button>
          <span class="devfolio-plugin-downloads" title="<?php esc_attr_e( 'Downloads', 'devfolio' ); ?>">
            <?php echo $plugin_download_icon; ?>
            <span class="devfolio-plugin-downloads-count"><?php echo esc_html( $downloads ); ?></span>
            <span class="devfolio-plugin-downloads-label"><?php esc_html_e( 'downloads', 'devfolio' ); ?></span>
          </span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="devfolio-plugin-funnel" aria-hidden="true">
    <button type="button" class="devfolio-plugin-funnel-backdrop" data-plugin-close aria-label="<?php esc_attr_e( 'Close', 'devfolio' ); ?>"></button>
    <div class="devfolio-plugin-funnel-panel devfolio-glass" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Plugin details', 'devfolio' ); ?>">
      <button type="button" class="devfolio-plugin-funnel-close" data-plugin-close aria-label="<?php esc_attr_e( 'Close', 'devfolio' ); ?>">&times;</button>
      <div class="devfolio-plugin-funnel-head">
        <div class="devfolio-plugin-funnel-icon"></div>
        <h3 class="devfolio-plugin-funnel-title"></h3>
        <p class="devfolio-plugin-funnel-desc"></p>
      </div>
      <div class="devfolio-plugin-funnel-stages"></div>
      <div class="devfolio-plugin-funnel-tags"></div>
      <div class="devfolio-plugin-funnel-cta">
        <a href="#" class="devfolio-btn devfolio-btn-glow devfolio-plugin-funnel-download" target="_blank" rel="noopener noreferrer">
          <?php echo $plugin_github_icon; ?>
          <?php esc_html_e( 'Free Download', 'devfolio' ); ?>
        </a>
        <span class="devfolio-plugin-funnel-count">
          <?php echo $plugin_download_icon; ?>
          <span class="devfolio-plugin-funnel-count-value"></span>
          <?php esc_html_e( 'downloads', 'devfolio' ); ?>
        </span>
      </div>
    </div>
  </div>
</section>
