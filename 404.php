<?php
/**
 * 404 template.
 *
 * @package devfolio
 */

get_header();
?>
<section class="devfolio-section">
	<div class="devfolio-container">
		<div class="devfolio-contact-box devfolio-glass devfolio-anim">
			<div class="devfolio-content">
				<p class="devfolio-label"><?php esc_html_e( 'Error', 'devfolio' ); ?></p>
				<h1><?php esc_html_e( '404', 'devfolio' ); ?></h1>
				<p><?php esc_html_e( 'The page you are looking for could not be found.', 'devfolio' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devfolio-btn devfolio-btn-glow"><?php esc_html_e( 'Back to Home', 'devfolio' ); ?></a>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
