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
		'detailUrl' => '',
		'github'    => 'https://github.com/username/devfolio-social-share',
	),
	array(
		'title'     => 'Devfolio SEO Toolkit',
		'desc'      => 'A lightweight SEO plugin that helps you optimize meta tags, Open Graph, Twitter Cards, and schema markup without bloat.',
		'features'  => 'Meta tag management, Open Graph support, XML sitemap generation, Schema markup',
		'tags'      => 'WordPress, SEO, PHP',
		'downloads' => '5.1K',
		'detailUrl' => '',
		'github'    => 'https://github.com/username/devfolio-seo-toolkit',
	),
	array(
		'title'     => 'Devfolio Contact Forms',
		'desc'      => 'Drag-and-drop form builder with spam protection, email notifications, and entries management dashboard.',
		'features'  => 'Drag & drop builder, Spam protection, Email notifications, Entries dashboard',
		'tags'      => 'WordPress, PHP, JavaScript',
		'downloads' => '1.8K',
		'detailUrl' => '',
		'github'    => 'https://github.com/username/devfolio-contact-forms',
	),
);

$plugin_default_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>';
$plugin_download_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M12 4v12m0 0-4-4m4 4 4-4"/></svg>';

$plugins       = devfolio_get_block_array_attr( $args, 'pluginItems', $default_plugins );
$section_id    = devfolio_get_block_section_id( $args, 'plugins' );
$plugins_label = devfolio_get_block_attr( $args, 'label', 'Free Plugins' );
$plugins_title = devfolio_get_block_attr( $args, 'titleText', 'Open Source WordPress Plugins' );
$plugins_desc  = devfolio_get_block_attr( $args, 'desc', 'Free plugins built for the WordPress community. Download, contribute, or use them in your projects.' );
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
        $github_url  = trim( $plugin['github'] ?? '' );
        $detail_url  = trim( $plugin['detailUrl'] ?? '' );
        $downloads   = devfolio_format_download_count( $plugin['downloads'] ?? '', $plugin['title'] ?? ( 'plugin-' . $plugin_index ) );

        $learn_href      = '';
        $learn_external  = false;
        if ( devfolio_has_valid_url( $detail_url ) ) {
          $learn_href = $detail_url;
        } elseif ( devfolio_has_valid_url( $github_url ) ) {
          $learn_href     = $github_url;
          $learn_external = true;
        }
      ?>
      <div class="devfolio-plugin-card devfolio-glass devfolio-anim">
        <div class="devfolio-plugin-icon">
          <?php echo devfolio_render_icon( $plugin['iconImage'] ?? '', $plugin['icon'] ?? $plugin_default_icon, $plugin['title'] ?? 'Plugin Icon' ); ?>
        </div>
        <h3><?php echo esc_html( $plugin['title'] ?? '' ); ?></h3>
        <p class="devfolio-plugin-desc"><?php echo esc_html( $plugin['desc'] ?? '' ); ?></p>
        <div class="devfolio-plugin-card-footer">
          <?php if ( '' !== $learn_href ) : ?>
          <a class="devfolio-btn devfolio-plugin-learn-btn" href="<?php echo esc_url( $learn_href ); ?>"<?php echo $learn_external ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
            <?php esc_html_e( 'Learn More', 'devfolio' ); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7 7 7-7 7"/></svg>
          </a>
          <?php else : ?>
          <span class="devfolio-btn devfolio-plugin-learn-btn devfolio-disabled"><?php esc_html_e( 'Learn More', 'devfolio' ); ?></span>
          <?php endif; ?>
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
</section>
