<?php
/**
 * Homepage blog section.
 *
 * @package devfolio
 */
?>
<!-- Blog -->
<section id="blog" class="devfolio-section">
  <div class="devfolio-container">
    <p class="devfolio-label devfolio-anim">Blog</p>
    <h2 class="devfolio-section-title devfolio-anim">Latest Articles</h2>
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
