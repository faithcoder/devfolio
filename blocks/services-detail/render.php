<?php
/**
 * Interactive services detail section.
 *
 * @package devfolio
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

$default_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1a2 2 0 0 1 0 2.8 2 2 0 0 1-2.8 0l-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6v.3a2 2 0 0 1-4 0V21a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1a2 2 0 0 1-2.8 0 2 2 0 0 1 0-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.6-1H3a2 2 0 0 1 0-4h.3a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9L4.5 7a2 2 0 0 1 0-2.8 2 2 0 0 1 2.8 0l.1.1a1.7 1.7 0 0 0 1.9.3h.1A1.7 1.7 0 0 0 10 3V2.7a2 2 0 0 1 4 0V3a1.7 1.7 0 0 0 1 1.6h.1a1.7 1.7 0 0 0 1.9-.3l.1-.1a2 2 0 0 1 2.8 0 2 2 0 0 1 0 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.9v.1A1.7 1.7 0 0 0 21 10h.3a2 2 0 0 1 0 4H21a1.7 1.7 0 0 0-1.6 1z"/></svg>';
$default_services = array(
	array(
		'title'    => 'UI/UX Design',
		'desc'     => 'Creating beautiful and intuitive user interfaces that users love.',
		'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M4 7a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3z"/><path d="M8 8h8M8 12h5M8 16h3"/></svg>',
	),
	array(
		'title'    => 'Quality Assurance',
		'desc'     => 'Testing workflows, interfaces, and integrations so launches feel stable and polished.',
		'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="m9 12 2 2 4-5"/><path d="M12 3 4 7v5c0 5 3.4 8 8 9 4.6-1 8-4 8-9V7z"/></svg>',
	),
	array(
		'title'    => 'Process Automation',
		'desc'     => 'Designing repeatable systems that reduce manual work and keep teams moving faster.',
		'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M4 12a8 8 0 0 1 13.7-5.7L20 8"/><path d="M20 4v4h-4"/><path d="M20 12a8 8 0 0 1-13.7 5.7L4 16"/><path d="M4 20v-4h4"/></svg>',
	),
	array(
		'title'    => 'SEO',
		'desc'     => 'Improving technical structure, metadata, and content signals for better search visibility.',
		'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="7"/><path d="m16 16 4 4"/><path d="M8 11h6M11 8v6"/></svg>',
	),
	array(
		'title'    => 'Content Management',
		'desc'     => 'Building practical publishing systems for pages, media, posts, and reusable content.',
		'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M6 4h9l3 3v13H6z"/><path d="M14 4v4h4"/><path d="M9 13h6M9 16h6M9 10h2"/></svg>',
	),
	array(
		'title'    => 'E-commerce Integrations',
		'desc'     => 'Connecting carts, payments, catalogues, fulfilment, and customer workflows cleanly.',
		'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M6 6h15l-2 8H8L6 3H3"/><circle cx="9" cy="20" r="1.5"/><circle cx="18" cy="20" r="1.5"/></svg>',
	),
);

$section_id       = devfolio_get_block_section_id( $args, 'services-detail' );
$label            = devfolio_get_block_attr( $args, 'label', 'Production and Technology' );
$title            = devfolio_get_block_attr( $args, 'titleText', 'Services' );
$desc             = devfolio_get_block_attr( $args, 'desc', 'We provide multiple services from digital production to technology services. Based on understanding your business and goals, we tailor the right process for you.' );
$placeholder_text = devfolio_get_block_attr( $args, 'placeholderText', 'Select a service to view details' );
$services         = devfolio_get_block_array_attr( $args, 'items', $default_services );
$services         = array_values(
	array_filter(
		(array) $services,
		static function ( $service ) {
			return ! empty( trim( (string) ( $service['title'] ?? '' ) ) );
		}
	)
);

if ( empty( $services ) ) {
	$services = $default_services;
}
?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="devfolio-section devfolio-service-detail-section">
	<div class="devfolio-container">
		<div class="devfolio-service-detail-layout">
			<div class="devfolio-service-detail-intro devfolio-anim">
				<?php if ( ! empty( $label ) ) : ?>
				<p class="devfolio-service-detail-label"><?php echo esc_html( $label ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $title ) ) : ?>
				<h2 class="devfolio-service-detail-title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $desc ) ) : ?>
				<p class="devfolio-service-detail-desc"><?php echo esc_html( $desc ); ?></p>
				<?php endif; ?>
			</div>

			<div class="devfolio-service-detail-list devfolio-anim" role="list">
				<?php foreach ( $services as $index => $service ) : ?>
				<button
					class="devfolio-service-detail-item"
					type="button"
					role="listitem"
					aria-pressed="false"
					data-service-index="<?php echo esc_attr( $index ); ?>"
					data-service-title="<?php echo esc_attr( $service['title'] ?? '' ); ?>"
					data-service-desc="<?php echo esc_attr( $service['desc'] ?? '' ); ?>"
				>
					<span class="devfolio-service-detail-num"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<span class="devfolio-service-detail-name"><?php echo esc_html( $service['title'] ?? '' ); ?></span>
					<span class="devfolio-service-detail-icon-template" hidden>
						<?php echo devfolio_render_icon( $service['iconImage'] ?? $service['icon_image'] ?? '', $service['icon_svg'] ?? $service['icon'] ?? $default_icon, $service['title'] ?? 'Service' ); ?>
					</span>
				</button>
				<?php endforeach; ?>
			</div>

			<div class="devfolio-service-detail-panel devfolio-anim" aria-live="polite">
				<div class="devfolio-service-detail-empty">
					<?php echo devfolio_render_svg( $default_icon ); ?>
					<p><?php echo esc_html( $placeholder_text ); ?></p>
				</div>
				<div class="devfolio-service-detail-content">
					<div class="devfolio-service-detail-panel-icon"></div>
					<h3 class="devfolio-service-detail-panel-title"></h3>
					<p class="devfolio-service-detail-panel-desc"></p>
					<div class="devfolio-service-detail-neighbors">
						<span class="devfolio-service-detail-prev-title"></span>
						<span class="devfolio-service-detail-next-title"></span>
					</div>
					<div class="devfolio-service-detail-arrows" aria-hidden="true">
						<span>&lsaquo;</span>
						<span>&rsaquo;</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
