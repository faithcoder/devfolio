<?php
/**
 * Plugin detail section.
 *
 * Funnel-style layout for individual plugin pages.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$default_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>';
$download_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M12 4v12m0 0-4-4m4 4 4-4"/></svg>';
$github_icon  = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-4.466 19.59c-.405.078-.534-.171-.534-.384v-2.195c0-.747-.262-1.233-.55-1.481 1.782-.198 3.654-.875 3.654-3.947 0-.874-.312-1.588-.823-2.147.082-.202.356-1.016-.079-2.117 0 0-.671-.215-2.198.82-.64-.18-1.324-.267-2.004-.271-.68.003-1.364.091-2.003.269-1.528-1.035-2.2-.82-2.2-.82-.434 1.102-.16 1.915-.077 2.118-.512.56-.824 1.273-.824 2.147 0 3.064 1.867 3.751 3.645 3.954-.229.2-.436.552-.508 1.07-.457.204-1.614.557-2.328-.666 0 0-.423-.768-1.227-.825 0 0-.78-.01-.055.487 0 0 .525.246.889 1.17 0 0 .463 1.428 2.688.944v1.489c0 .211-.129.459-.528.385-3.18-1.057-5.472-4.056-5.472-7.59 0-4.419 3.582-8 8-8s8 3.581 8 8c0 3.533-2.289 6.531-5.466 7.59z"/></svg>';

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

$feature_count = count( $features );
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section devfolio-plugin-details-section">
  <div class="devfolio-container">
    <a class="devfolio-plugin-details-back" href="<?php echo esc_url( $back_url ); ?>">
      <span aria-hidden="true">&#8592;</span>
      <?php echo esc_html( $back_text ); ?>
    </a>

    <div class="devfolio-plugin-funnel">
      <div class="devfolio-plugin-funnel-inner">
        <div class="devfolio-plugin-funnel-head">
          <div class="devfolio-plugin-funnel-icon"><?php echo devfolio_render_icon( $icon_image, $icon, $title ); ?></div>
          <h1 class="devfolio-plugin-funnel-title"><?php echo esc_html( $title ); ?></h1>
          <?php if ( ! empty( $desc ) ) : ?>
          <p class="devfolio-plugin-funnel-desc"><?php echo esc_html( $desc ); ?></p>
          <?php endif; ?>
        </div>

        <?php if ( ! empty( $tags ) ) : ?>
        <div class="devfolio-plugin-funnel-tags">
          <?php foreach ( $tags as $tag ) : ?>
          <span class="devfolio-tech-tag"><?php echo esc_html( $tag ); ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ( ! empty( $features ) ) : ?>
        <div class="devfolio-plugin-funnel-stages">
          <?php foreach ( $features as $index => $feature ) :
            $stage_width = max( 42, 100 - $index * 11 );
          ?>
          <div class="devfolio-plugin-funnel-stage" style="width:<?php echo esc_attr( $stage_width ); ?>%">
            <span class="devfolio-plugin-funnel-stage-num"><?php echo esc_html( $index + 1 ); ?></span>
            <span class="devfolio-plugin-funnel-stage-text"><?php echo esc_html( $feature ); ?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="devfolio-plugin-funnel-cta">
          <?php if ( devfolio_has_valid_url( $github ) ) : ?>
          <a class="devfolio-btn devfolio-plugin-funnel-download" href="<?php echo esc_url( $github ); ?>" target="_blank" rel="noopener noreferrer">
            <?php echo $github_icon; ?>
            <?php esc_html_e( 'Free Download', 'devfolio' ); ?>
          </a>
          <?php endif; ?>
          <span class="devfolio-plugin-funnel-count">
            <?php echo $download_icon; ?>
            <span class="devfolio-plugin-funnel-count-value"><?php echo esc_html( $downloads ); ?></span>
            <?php esc_html_e( 'downloads', 'devfolio' ); ?>
          </span>
        </div>
      </div>
    </div>
  </div>
</section>
