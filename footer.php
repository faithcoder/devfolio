<?php
/**
 * Theme footer.
 *
 * @package devfolio
 */
?>
<!-- Footer -->
<footer class="devfolio-footer">
	<div class="devfolio-container">
		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'menu-list',
				)
			);
			?>
		<?php endif; ?>
		<p><?php echo esc_html( sprintf( 'Copyright %1$s %2$s', gmdate( 'Y' ), get_bloginfo( 'name' ) ) ); ?></p>
	</div>
</footer>
<?php if ( ! is_admin() ) : ?>
<div class="devfolio-events-lightbox">
	<div class="devfolio-events-lightbox-inner">
		<button class="devfolio-lightbox-btn devfolio-lightbox-close devfolio-events-lightbox-close" aria-label="Close">✕</button>
		<img class="devfolio-events-lightbox-img" src="" alt=""/>
		<div class="devfolio-events-lightbox-info">
			<p class="devfolio-events-lightbox-title"></p>
			<p class="devfolio-events-lightbox-loc"></p>
		</div>
		<button class="devfolio-lightbox-btn devfolio-events-lightbox-prev" aria-label="Previous">‹</button>
		<button class="devfolio-lightbox-btn devfolio-events-lightbox-next" aria-label="Next">›</button>
	</div>
</div>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
