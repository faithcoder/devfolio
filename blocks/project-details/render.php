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
        <?php if ( ! empty( $role ) || ! empty( $challenge ) || ! empty( $approach ) ) : ?>
        <div class="devfolio-portfolio-single-trio">
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
        </div>
        <?php endif; ?>
        <?php if ( ! empty( $screenshots ) ) : ?>
        <section class="devfolio-portfolio-single-panel devfolio-glass">
          <h2><?php esc_html_e( 'Screenshots', 'devfolio' ); ?></h2>
          <div class="devfolio-carousel" data-carousel-lightbox="screenshots">
            <div class="devfolio-carousel-wrap">
              <div class="devfolio-carousel-viewport">
                <div class="devfolio-carousel-track">
                  <?php $slide_index = 0; foreach ( $screenshots as $screenshot ) : ?>
                  <?php if ( empty( $screenshot['src'] ) ) : continue; endif; ?>
                  <div class="devfolio-carousel-slide" data-slide="<?php echo esc_attr( $slide_index ); ?>" data-src="<?php echo esc_url( $screenshot['src'] ); ?>" data-title="<?php echo esc_attr( $screenshot['title'] ?? $title ); ?>">
                    <div class="devfolio-carousel-card devfolio-glass">
                      <div class="devfolio-carousel-img-wrap">
                        <img src="<?php echo esc_url( $screenshot['src'] ); ?>" alt="<?php echo esc_attr( $screenshot['title'] ?? $title ); ?>" loading="lazy"/>
                        <div class="devfolio-carousel-img-overlay"></div>
                        <div class="devfolio-carousel-caption">
                          <?php if ( ! empty( $screenshot['title'] ) ) : ?>
                          <p class="devfolio-carousel-caption-title"><?php echo esc_html( $screenshot['title'] ); ?></p>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php $slide_index++; endforeach; ?>
                </div>
              </div>
              <button class="devfolio-carousel-btn devfolio-carousel-prev" aria-label="Previous"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg></button>
              <button class="devfolio-carousel-btn devfolio-carousel-next" aria-label="Next"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></button>
            </div>
            <div class="devfolio-carousel-dots"></div>
          </div>
        </section>
        <?php endif; ?>
        <?php if ( ! empty( $features ) || ! empty( $result ) ) : ?>
        <div class="devfolio-portfolio-single-duo">
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
        <?php endif; ?>
      </div>
    </article>
  </div>
</section>
