<?php
/**
 * Homepage blog section.
 *
 * @package devfolio
 */
$section_id = devfolio_get_section_id( 'blog' );
$blog_label = devfolio_get_theme_mod_value( 'devfolio_blog_label', 'Blog' );
$blog_title = devfolio_get_theme_mod_value( 'devfolio_blog_title', 'Latest Articles' );
$blog_desc  = devfolio_get_theme_mod_value( 'devfolio_blog_desc', '' );
?>
<!-- Blog -->
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim"><?php echo esc_html( $blog_label ); ?></p>
    <h2 class="devfolio-section-title devfolio-anim"><?php echo esc_html( $blog_title ); ?></h2>
    <?php if ( ! empty( $blog_desc ) ) : ?>
    <p class="devfolio-section-desc devfolio-anim"><?php echo esc_html( $blog_desc ); ?></p>
    <?php endif; ?>
    <div class="devfolio-blog-grid">
      <?php
      $devfolio_blog_query = new WP_Query(
        array(
          'post_type'           => 'post',
          'posts_per_page'      => 3,
          'ignore_sticky_posts' => true,
        )
      );

      if ( $devfolio_blog_query->have_posts() ) :
        while ( $devfolio_blog_query->have_posts() ) :
          $devfolio_blog_query->the_post();
          get_template_part( 'template-parts/content', 'post-card' );
        endwhile;
      else :
        get_template_part( 'template-parts/content', 'none' );
      endif;
      wp_reset_postdata();
      ?>
    </div>
  </div>
</section>
