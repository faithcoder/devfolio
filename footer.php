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
<?php wp_footer(); ?>
</body>
</html>
