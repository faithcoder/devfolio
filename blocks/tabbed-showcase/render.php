<?php
/**
 * Tabbed showcase section.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$default_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 5h16v14H4z"/><path d="M4 9h16"/><path d="M8 13h3"/><path d="M13 13h3"/><path d="M8 16h8"/></svg>';
$default_items = array(
	array(
		'title'     => 'Product Catalog',
		'subtitle'  => 'Commerce-ready layout',
		'desc'      => 'Show products, pricing, availability, and actions in a polished tab-driven table view.',
		'features'  => 'Responsive table, Product images, Status badges, Call to action',
		'mediaType' => 'image',
		'image'     => get_template_directory_uri() . '/assets/images/blog-placeholder.svg',
		'icon_svg'  => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M6 6h15l-2 8H8L6 3H3"/><circle cx="9" cy="20" r="1.5"/><circle cx="18" cy="20" r="1.5"/></svg>',
	),
	array(
		'title'     => 'Comparison Tables',
		'subtitle'  => 'Decision support',
		'desc'      => 'Compare plans, services, or product options with a clean feature-first layout.',
		'features'  => 'Feature columns, Highlighted choice, Custom labels, Clear hierarchy',
		'mediaType' => 'image',
		'image'     => get_template_directory_uri() . '/assets/images/blog-placeholder.svg',
		'icon_svg'  => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 4v16"/><path d="M16 4v16"/><path d="M4 8h16"/><path d="M4 16h16"/></svg>',
	),
	array(
		'title'     => 'Academic Table',
		'subtitle'  => 'Structured records',
		'desc'      => 'Display research, coursework, scores, or document records with readable fields.',
		'features'  => 'Categories, Metadata, Ratings, Download links',
		'mediaType' => 'image',
		'image'     => get_template_directory_uri() . '/assets/images/blog-placeholder.svg',
		'icon_svg'  => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
	),
);

$section_id = sanitize_title( devfolio_get_block_attr( $args, 'sectionId', 'tabbed-showcase' ) );
$section_id = '' !== $section_id ? $section_id : 'tabbed-showcase';
$label      = devfolio_get_block_attr( $args, 'label', 'Templates and Data' );
$title      = devfolio_get_block_attr( $args, 'titleText', 'Ready-Made Sections For Real-World Data' );
$desc       = devfolio_get_block_attr( $args, 'desc', 'Design tabs with images, videos, feature lists, and clear data-focused panels.' );
$items      = devfolio_get_block_array_attr( $args, 'showcaseItems', $default_items );
$items      = array_values(
	array_filter(
		(array) $items,
		static function ( $item ) {
			return ! empty( trim( (string) ( $item['title'] ?? '' ) ) );
		}
	)
);

if ( empty( $items ) ) {
	$items = $default_items;
}

$active_item     = $items[0];
$active_features = devfolio_parse_tag_list( $active_item['features'] ?? '' );
$active_media    = 'video' === ( $active_item['mediaType'] ?? 'image' ) && ! empty( $active_item['video'] ?? '' ) ? 'video' : 'image';
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section devfolio-tabbed-showcase-section">
	<div class="devfolio-container">
		<div class="devfolio-tabbed-showcase-header devfolio-anim">
			<?php if ( ! empty( $label ) ) : ?>
			<p class="devfolio-label"><?php echo esc_html( $label ); ?></p>
			<?php endif; ?>
			<?php if ( ! empty( $title ) ) : ?>
			<h2 class="devfolio-tabbed-showcase-title"><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>
			<?php if ( ! empty( $desc ) ) : ?>
			<p class="devfolio-tabbed-showcase-desc"><?php echo esc_html( $desc ); ?></p>
			<?php endif; ?>
		</div>

		<div class="devfolio-tabbed-showcase">
			<button class="devfolio-tabbed-showcase-arrow devfolio-tabbed-showcase-prev" type="button" aria-label="<?php esc_attr_e( 'Previous tab', 'devfolio' ); ?>">&lsaquo;</button>
			<div class="devfolio-tabbed-showcase-tabs devfolio-anim" role="tablist">
				<?php foreach ( $items as $index => $item ) : ?>
				<button
					class="devfolio-tabbed-showcase-tab<?php echo 0 === $index ? ' devfolio-active' : ''; ?>"
					type="button"
					role="tab"
					aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
					data-showcase-index="<?php echo esc_attr( $index ); ?>"
					data-title="<?php echo esc_attr( $item['title'] ?? '' ); ?>"
					data-subtitle="<?php echo esc_attr( $item['subtitle'] ?? '' ); ?>"
					data-desc="<?php echo esc_attr( $item['desc'] ?? '' ); ?>"
					data-features="<?php echo esc_attr( $item['features'] ?? '' ); ?>"
					data-media-type="<?php echo esc_attr( $item['mediaType'] ?? 'image' ); ?>"
					data-image="<?php echo esc_url( $item['image'] ?? $item['src'] ?? '' ); ?>"
					data-video="<?php echo esc_url( $item['video'] ?? '' ); ?>"
				>
					<span class="devfolio-tabbed-showcase-tab-icon">
						<?php echo devfolio_render_icon( $item['iconImage'] ?? $item['icon_image'] ?? '', $item['icon_svg'] ?? $item['icon'] ?? $default_icon, $item['title'] ?? 'Tab' ); ?>
					</span>
					<span class="devfolio-tabbed-showcase-tab-title"><?php echo esc_html( $item['title'] ?? '' ); ?></span>
				</button>
				<?php endforeach; ?>
			</div>
			<button class="devfolio-tabbed-showcase-arrow devfolio-tabbed-showcase-next" type="button" aria-label="<?php esc_attr_e( 'Next tab', 'devfolio' ); ?>">&rsaquo;</button>

			<div class="devfolio-tabbed-showcase-panel devfolio-anim">
				<div class="devfolio-tabbed-showcase-media">
					<?php if ( 'video' === $active_media ) : ?>
					<video src="<?php echo esc_url( $active_item['video'] ?? '' ); ?>" controls playsinline></video>
					<?php elseif ( ! empty( $active_item['image'] ?? $active_item['src'] ?? '' ) ) : ?>
					<img src="<?php echo esc_url( $active_item['image'] ?? $active_item['src'] ?? '' ); ?>" alt="<?php echo esc_attr( $active_item['title'] ?? '' ); ?>" loading="lazy"/>
					<?php else : ?>
					<div class="devfolio-tabbed-showcase-placeholder"><?php esc_html_e( 'Add an image or video for this tab.', 'devfolio' ); ?></div>
					<?php endif; ?>
				</div>
				<div class="devfolio-tabbed-showcase-copy">
					<p class="devfolio-tabbed-showcase-kicker"><?php echo esc_html( $active_item['subtitle'] ?? '' ); ?></p>
					<h3><?php echo esc_html( $active_item['title'] ?? '' ); ?></h3>
					<p class="devfolio-tabbed-showcase-panel-desc"><?php echo esc_html( $active_item['desc'] ?? '' ); ?></p>
					<div class="devfolio-tabbed-showcase-features">
						<?php foreach ( $active_features as $feature ) : ?>
						<span><?php echo esc_html( $feature ); ?></span>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
