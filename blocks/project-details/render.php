<?php
/**
 * Project case-study detail section.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$section_id       = devfolio_get_block_section_id( $args, 'project-details' );
$label            = devfolio_get_block_attr( $args, 'label', 'Case Study' );
$title            = devfolio_get_block_attr( $args, 'titleText', get_the_title() );
$summary          = devfolio_get_block_attr( $args, 'summary', '' );
$image            = devfolio_get_block_attr( $args, 'image', get_template_directory_uri() . '/assets/images/blog-placeholder.svg' );
$role             = devfolio_get_block_attr( $args, 'role', '' );
$challenge        = devfolio_get_block_attr( $args, 'challenge', '' );
$approach         = devfolio_get_block_attr( $args, 'approach', '' );
$screenshots      = devfolio_get_block_array_attr( $args, 'screenshots', array() );
$technologies     = devfolio_parse_tag_list( devfolio_get_block_attr( $args, 'technologies', '' ) );
$features         = devfolio_parse_tag_list( devfolio_get_block_attr( $args, 'features', '' ) );
$result           = devfolio_get_block_attr( $args, 'result', '' );
$live_url         = trim( (string) devfolio_get_block_attr( $args, 'liveUrl', '' ) );
$portfolio_url    = devfolio_get_block_attr( $args, 'portfolioUrl', '#portfolio' );
$live_button_text = devfolio_get_block_attr( $args, 'liveButtonText', 'Visit Live Website' );
$back_button_text = devfolio_get_block_attr( $args, 'backButtonText', 'Back to Portfolio' );
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section devfolio-portfolio-single-section">
  <div class="devfolio-container">
    <a class="devfolio-portfolio-back-link" href="<?php echo esc_url( $portfolio_url ); ?>">
      <span aria-hidden="true">&#8592;</span>
      <?php echo esc_html( $back_button_text ); ?>
    </a>
    <article class="devfolio-portfolio-single">
      <div class="devfolio-portfolio-single-hero">
        <div class="devfolio-portfolio-single-media devfolio-glass">
          <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy"/>
        </div>
        <div class="devfolio-portfolio-single-summary-card devfolio-glass">
          <?php if ( ! empty( $label ) ) : ?>
          <p class="devfolio-label"><?php echo esc_html( $label ); ?></p>
          <?php endif; ?>
          <h1 class="devfolio-section-title"><?php echo esc_html( $title ); ?></h1>
          <?php if ( ! empty( $summary ) ) : ?>
          <p class="devfolio-portfolio-single-summary"><?php echo esc_html( $summary ); ?></p>
          <?php endif; ?>
          <?php if ( ! empty( $technologies ) ) : ?>
          <div class="devfolio-tech-tags">
            <?php foreach ( $technologies as $technology ) : ?>
            <span class="devfolio-tech-tag"><?php echo esc_html( $technology ); ?></span>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
          <div class="devfolio-portfolio-links">
            <?php if ( devfolio_has_valid_url( $live_url ) ) : ?>
            <a class="devfolio-link-live" href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $live_button_text ); ?></a>
            <?php endif; ?>
            <a class="devfolio-link-code" href="<?php echo esc_url( $portfolio_url ); ?>"><?php echo esc_html( $back_button_text ); ?></a>
          </div>
        </div>
      </div>
      <div class="devfolio-portfolio-single-content-wrap">
        <?php if ( ! empty( $role ) ) : ?>
        <section class="devfolio-portfolio-single-panel devfolio-glass">
          <h2><?php esc_html_e( 'Your Role', 'devfolio' ); ?></h2>
          <div class="devfolio-job-desc"><?php echo wp_kses_post( wpautop( $role ) ); ?></div>
        </section>
        <?php endif; ?>
        <?php if ( ! empty( $challenge ) ) : ?>
        <section class="devfolio-portfolio-single-panel devfolio-glass">
          <h2><?php esc_html_e( 'Client Requirements or Challenge', 'devfolio' ); ?></h2>
          <div class="devfolio-job-desc"><?php echo wp_kses_post( wpautop( $challenge ) ); ?></div>
        </section>
        <?php endif; ?>
        <?php if ( ! empty( $approach ) ) : ?>
        <section class="devfolio-portfolio-single-panel devfolio-glass">
          <h2><?php esc_html_e( 'Development Approach', 'devfolio' ); ?></h2>
          <div class="devfolio-job-desc"><?php echo wp_kses_post( wpautop( $approach ) ); ?></div>
        </section>
        <?php endif; ?>
        <?php if ( ! empty( $screenshots ) ) : ?>
        <section class="devfolio-portfolio-single-panel devfolio-glass">
          <h2><?php esc_html_e( 'Screenshots', 'devfolio' ); ?></h2>
          <div class="devfolio-project-screenshots">
            <?php foreach ( $screenshots as $screenshot ) : ?>
            <?php if ( empty( $screenshot['src'] ) ) : continue; endif; ?>
            <figure>
              <img src="<?php echo esc_url( $screenshot['src'] ); ?>" alt="<?php echo esc_attr( $screenshot['title'] ?? $title ); ?>" loading="lazy"/>
              <?php if ( ! empty( $screenshot['title'] ) ) : ?>
              <figcaption><?php echo esc_html( $screenshot['title'] ); ?></figcaption>
              <?php endif; ?>
            </figure>
            <?php endforeach; ?>
          </div>
        </section>
        <?php endif; ?>
        <?php if ( ! empty( $features ) ) : ?>
        <section class="devfolio-portfolio-single-panel devfolio-glass">
          <h2><?php esc_html_e( 'Key Features Delivered', 'devfolio' ); ?></h2>
          <div class="devfolio-skill-tags">
            <?php foreach ( $features as $feature ) : ?>
            <span class="devfolio-skill-tag"><?php echo esc_html( $feature ); ?></span>
            <?php endforeach; ?>
          </div>
        </section>
        <?php endif; ?>
        <?php if ( ! empty( $result ) ) : ?>
        <section class="devfolio-portfolio-single-panel devfolio-glass">
          <h2><?php esc_html_e( 'Result', 'devfolio' ); ?></h2>
          <div class="devfolio-job-desc"><?php echo wp_kses_post( wpautop( $result ) ); ?></div>
        </section>
        <?php endif; ?>
      </div>
    </article>
  </div>
</section>
