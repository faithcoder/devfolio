<?php
/**
 * Blog card item.
 *
 * @package devfolio
 */

$devfolio_fallback_image = get_template_directory_uri() . '/assets/images/blog-placeholder.svg';
$devfolio_image_url      = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : $devfolio_fallback_image;
$devfolio_content_text   = wp_strip_all_tags( get_the_content( null, false, get_the_ID() ) );
$devfolio_word_count     = str_word_count( $devfolio_content_text );
$devfolio_read_minutes   = (int) ceil( $devfolio_word_count / 200 );
$devfolio_read_minutes   = max( 1, $devfolio_read_minutes );
$devfolio_terms          = get_the_category();
$devfolio_tag            = ! empty( $devfolio_terms ) ? $devfolio_terms[0]->name : __( 'Article', 'devfolio' );
?>
<article class="devfolio-blog-card devfolio-glass devfolio-anim" data-featured-image="<?php echo esc_url( $devfolio_image_url ); ?>">
	<span class="devfolio-blog-tag"><?php echo esc_html( $devfolio_tag ); ?></span>
	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<p class="devfolio-excerpt"><?php echo esc_html( devfolio_excerpt_text( get_the_ID(), 180 ) ); ?></p>
	<div class="devfolio-blog-meta">
		<div class="devfolio-info">
			<span><?php echo esc_html( '📅 ' . get_the_date( 'd F, Y' ) ); ?></span>
			<span><?php echo esc_html( '🕒 ' . $devfolio_read_minutes . ' min read' ); ?></span>
		</div>
		<a class="devfolio-arrow" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'devfolio' ), get_the_title() ) ); ?>">→</a>
	</div>
</article>
