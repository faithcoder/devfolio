<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package devfolio
 */

if ( ! is_active_sidebar( 'devfolio-sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="devfolio-sidebar">
	<?php dynamic_sidebar( 'devfolio-sidebar-1' ); ?>
</aside><!-- #secondary -->
