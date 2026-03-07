<?php
/**
 * Theme header.
 *
 * @package devfolio
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description', 'display' ) ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'tt-magic-cursor' ); ?>>
<?php wp_body_open(); ?>

<!-- Background Decorations -->
<div class="devfolio-bg-decor">
	<div class="devfolio-orb devfolio-orb-1"></div>
	<div class="devfolio-orb devfolio-orb-2"></div>
	<div class="devfolio-orb devfolio-orb-3"></div>
	<div class="devfolio-shape devfolio-shape-1"></div>
	<div class="devfolio-shape devfolio-shape-2"></div>
	<div class="devfolio-shape devfolio-shape-3"></div>
	<div class="devfolio-dot devfolio-dot-1"></div>
	<div class="devfolio-dot devfolio-dot-2"></div>
	<div class="devfolio-dot devfolio-dot-3"></div>
</div>

<!-- Navbar -->
<nav class="devfolio-navbar devfolio-glass-strong">
	<div class="devfolio-container devfolio-navbar-inner">
		<div class="devfolio-nav-brand devfolio-gradient-text">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			<?php endif; ?>
		</div>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_id'        => 'devfolio-primary-menu',
				'menu_class'     => 'devfolio-nav-links menu-list',
				'fallback_cb'    => 'devfolio_primary_menu_fallback',
			)
		);
		?>
		<button class="devfolio-nav-toggle" aria-label="Toggle menu" aria-controls="devfolio-primary-menu" aria-expanded="false">
			<span class="devfolio-nav-icon devfolio-nav-icon-menu" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
			</span>
			<span class="devfolio-nav-icon devfolio-nav-icon-close" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6 18 18M6 18 18 6"/></svg>
			</span>
		</button>
	</div>
</nav>
