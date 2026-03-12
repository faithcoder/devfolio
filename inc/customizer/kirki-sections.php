<?php
/**
 * Kirki fields.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function devfolio_register_kirki_fields() {
	if ( ! class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_panel(
		'devfolio_home_panel',
		array(
			'priority'    => 10,
			'title'       => esc_html__( 'Devfolio Options', 'devfolio' ),
			'description' => esc_html__( 'Homepage global content and style options.', 'devfolio' ),
		)
	);

	Kirki::add_section( 'devfolio_hero_section', array( 'title' => esc_html__( 'Hero', 'devfolio' ), 'panel' => 'devfolio_home_panel' ) );
	Kirki::add_section( 'devfolio_skills_section', array( 'title' => esc_html__( 'Skills', 'devfolio' ), 'panel' => 'devfolio_home_panel' ) );
	Kirki::add_section( 'devfolio_project_section', array( 'title' => esc_html__( 'Projects', 'devfolio' ), 'panel' => 'devfolio_home_panel' ) );
	Kirki::add_section( 'devfolio_process_section', array( 'title' => esc_html__( 'Process', 'devfolio' ), 'panel' => 'devfolio_home_panel' ) );
	Kirki::add_section( 'devfolio_contact_section', array( 'title' => esc_html__( 'Contact', 'devfolio' ), 'panel' => 'devfolio_home_panel' ) );
	Kirki::add_section( 'devfolio_navigation_section', array( 'title' => esc_html__( 'Navigation', 'devfolio' ), 'panel' => 'devfolio_home_panel' ) );
	Kirki::add_section( 'devfolio_styles_section', array( 'title' => esc_html__( 'Style Settings', 'devfolio' ), 'panel' => 'devfolio_home_panel' ) );
	Kirki::add_section( 'devfolio_typography_section', array( 'title' => esc_html__( 'Typography', 'devfolio' ), 'panel' => 'devfolio_home_panel' ) );

	Kirki::add_section( 'devfolio_homepage_layout', array( 'title' => esc_html__( 'Homepage Layout', 'devfolio' ), 'panel' => 'devfolio_home_panel', 'priority' => 1 ) );

	foreach ( devfolio_get_section_defaults() as $section_key => $section_meta ) {
		$title = ucfirst( str_replace( '_', ' ', $section_key ) );

		Kirki::add_field(
			'devfolio_config',
			array(
				'type'     => 'text',
				'settings' => 'devfolio_section_id_' . $section_key,
				'label'    => sprintf( esc_html__( '%s Section ID', 'devfolio' ), $title ),
				'section'  => 'devfolio_navigation_section',
				'default'  => $section_meta['id'],
			)
		);

		Kirki::add_field(
			'devfolio_config',
			array(
				'type'     => 'text',
				'settings' => 'devfolio_nav_label_' . $section_key,
				'label'    => sprintf( esc_html__( '%s Menu Label', 'devfolio' ), $title ),
				'section'  => 'devfolio_navigation_section',
				'default'  => $section_meta['label'],
			)
		);
	}

	// ── Homepage Layout Sorters & Toggles ──
	$layout_choices = array();
	foreach ( devfolio_get_section_defaults() as $section_key => $section_meta ) {
		// Include the "About" section we hardcoded earlier in front-page.php but missing in the defaults array
		$layout_choices[ $section_key ] = $section_meta['label'];

		Kirki::add_field(
			'devfolio_config',
			array(
				'type'     => 'switch',
				'settings' => 'devfolio_enable_' . $section_key,
				'label'    => sprintf( esc_html__( 'Enable %s', 'devfolio' ), $section_meta['label'] ),
				'section'  => 'devfolio_homepage_layout',
				'default'  => true,
				'choices'  => array(
					'on'  => esc_html__( 'On', 'devfolio' ),
					'off' => esc_html__( 'Off', 'devfolio' ),
				),
			)
		);
	}

	// Also add the newly built About section to the toggles since it isn't in devfolio_get_section_defaults()
	$about_key = 'about';
	$about_label = esc_html__( 'About', 'devfolio' );
	$layout_choices[ $about_key ] = $about_label;

	Kirki::add_field(
		'devfolio_config',
		array(
			'type'     => 'switch',
			'settings' => 'devfolio_enable_' . $about_key,
			'label'    => sprintf( esc_html__( 'Enable %s', 'devfolio' ), $about_label ),
			'section'  => 'devfolio_homepage_layout',
			'default'  => true,
			'choices'  => array(
				'on'  => esc_html__( 'On', 'devfolio' ),
				'off' => esc_html__( 'Off', 'devfolio' ),
			),
		)
	);

	Kirki::add_field(
		'devfolio_config',
		array(
			'type'     => 'sortable',
			'settings' => 'devfolio_home_sections_order',
			'label'    => esc_html__( 'Homepage Section Order', 'devfolio' ),
			'section'  => 'devfolio_homepage_layout',
			'default'  => array(
				'hero',
				'experience',
				'about',
				'skills',
				'projects',
				'portfolio',
				'services',
				'process',
				'origin',
				'blog',
				'testimonials',
				'contact',
			),
			'choices'  => $layout_choices,
		)
	);

	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_label', 'label' => esc_html__( 'Hero Label', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'Support Engineer • WordPress • Customer Success' ) );

	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_title_before', 'label' => esc_html__( 'Hero Title (Before Highlight)', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'I help users solve' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_title_highlight', 'label' => esc_html__( 'Hero Highlight', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'WordPress plugin and theme issues' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_title_after', 'label' => esc_html__( 'Hero Title (After Highlight)', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'with clear, reliable support.' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'textarea', 'settings' => 'devfolio_hero_subtitle', 'label' => esc_html__( 'Hero Subtitle', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'Support Engineer at Webba Booking. Over 5+ years in technical support and 6,000+ unique users assisted via CRM, live chat, and WordPress forums.' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'image', 'settings' => 'devfolio_hero_image', 'label' => esc_html__( 'Hero Image', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => '' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_cta_primary_text', 'label' => esc_html__( 'Primary CTA Text', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'Contact Me' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_cta_primary_url', 'label' => esc_html__( 'Primary CTA URL', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => '#contact' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_cta_secondary_text', 'label' => esc_html__( 'Secondary CTA Text', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'View Contributions' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_cta_secondary_url', 'label' => esc_html__( 'Secondary CTA URL', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => '#projects' ) );
	Kirki::add_field( 'devfolio_config', array(
		'type' => 'repeater', 'settings' => 'devfolio_social_profiles', 'label' => esc_html__( 'Social Profiles', 'devfolio' ), 'section' => 'devfolio_hero_section',
		'default' => array(
			array( 'label' => 'LinkedIn', 'url' => 'https://linkedin.com', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zm2-3a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>' ),
			array( 'label' => 'GitHub', 'url' => 'https://github.com', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.4 5.4 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65S8.93 17.38 9 18v4m0 0H6c-1 0-1.5-.5-2-1s-1.5-1-2-1"/></svg>' ),
			array( 'label' => 'WordPress', 'url' => 'https://wordpress.org', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2.1 12.1 7 21l4-9"/><path d="m14.6 21 3.4-7.3c.6-1.3.9-2.4.9-3.5 0-.9-.2-1.7-.4-2.5"/><path d="M7.8 4.7A8 8 0 0 1 20 11.5c0 1.5-.3 2.9-.9 4.2"/><path d="M3 10.5A8 8 0 0 1 7.8 4.7L5.4 10.5"/></svg>' ),
			array( 'label' => 'YouTube', 'url' => 'https://youtube.com', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58"/><path d="m10 15 5-3-5-3z"/></svg>' ),
		),
		'fields' => array(
			'label' => array( 'type' => 'text', 'label' => esc_html__( 'Label', 'devfolio' ) ),
			'url'   => array( 'type' => 'text', 'label' => esc_html__( 'URL', 'devfolio' ) ),
			'icon_image' => array( 'type' => 'image', 'label' => esc_html__( 'Icon Image (SVG/PNG)', 'devfolio' ) ),
			'icon'  => array( 'type' => 'textarea', 'label' => esc_html__( 'SVG Icon Markup', 'devfolio' ) ),
		),
	) );
	Kirki::add_field( 'devfolio_config', array(
		'type' => 'repeater', 'settings' => 'devfolio_hero_stats', 'label' => esc_html__( 'Hero Stats', 'devfolio' ), 'section' => 'devfolio_hero_section',
		'default' => array(
			array( 'value' => '5+', 'label' => 'Years Support Experience' ),
			array( 'value' => '6,000+', 'label' => 'Users Supported' ),
			array( 'value' => '15-20/day', 'label' => 'Avg Daily Support' ),
			array( 'value' => 'Remote', 'label' => 'Global Team Collaboration' ),
		),
		'fields' => array(
			'value' => array( 'type' => 'text', 'label' => esc_html__( 'Value', 'devfolio' ) ),
			'label' => array( 'type' => 'text', 'label' => esc_html__( 'Label', 'devfolio' ) ),
		),
	) );
	Kirki::add_field( 'devfolio_config', array(
		'type' => 'repeater', 'settings' => 'devfolio_skill_groups', 'label' => esc_html__( 'Skill Groups', 'devfolio' ), 'section' => 'devfolio_skills_section',
		'default' => array(
			array( 'title' => 'Support Operations', 'tags' => 'Troubleshooting, Problem Solving, Customer Support, Documentation Writing, Communication, Website Migration' ),
			array( 'title' => 'WordPress & CMS', 'tags' => 'WordPress Theme Development, Elementor Widget Development, WooCommerce, Shopify Store Design, Landing Page Design' ),
			array( 'title' => 'Technical Stack', 'tags' => 'HTML/CSS, Bootstrap, TailwindCSS, PHP, MySQL, JavaScript, ReactJS, jQuery, AJAX, WP CLI, WP REST API' ),
			array( 'title' => 'Tools & Workflow', 'tags' => 'HelpScout, ThriveDesk, Ticksy, Tawk.to, Crisp, Git, ClickUp, BrowserStack, Slack, Figma, cPanel, WHM, FTP' ),
		),
		'fields' => array(
			'title' => array( 'type' => 'text', 'label' => esc_html__( 'Group Title', 'devfolio' ) ),
			'tags'  => array( 'type' => 'text', 'label' => esc_html__( 'Tags (comma separated)', 'devfolio' ) ),
		),
	) );

	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_featured_label', 'label' => esc_html__( 'Featured Label', 'devfolio' ), 'section' => 'devfolio_project_section', 'default' => 'Support Impact' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_featured_title', 'label' => esc_html__( 'Featured Title', 'devfolio' ), 'section' => 'devfolio_project_section', 'default' => 'WordPress Product Support at Scale' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'textarea', 'settings' => 'devfolio_featured_desc', 'label' => esc_html__( 'Featured Description', 'devfolio' ), 'section' => 'devfolio_project_section', 'default' => 'Supported 6,000+ unique users across CRM, live chat, and WordPress forums. Delivered clear resolutions for plugin conflicts, licensing, migrations, and compatibility issues.' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_featured_tags', 'label' => esc_html__( 'Featured Tags (comma separated)', 'devfolio' ), 'section' => 'devfolio_project_section', 'default' => 'WordPress Support, WooCommerce, Elementor, Documentation, Debugging' ) );
	Kirki::add_field( 'devfolio_config', array(
		'type' => 'repeater', 'settings' => 'devfolio_contributions', 'label' => esc_html__( 'Contribution Cards', 'devfolio' ), 'section' => 'devfolio_project_section',
		'default' => array(
			array( 'title' => 'Support Engineer', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 18v-6a9 9 0 1 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1v-7h3z"/><path d="M3 14h3v7H5a2 2 0 0 1-2-2z"/></svg>' ),
			array( 'title' => 'Documentation Writer', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M8 13h8"/><path d="M8 17h8"/><path d="M8 9h2"/></svg>' ),
			array( 'title' => 'WordPress Contributor', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2.1 12.1 7 21l4-9"/><path d="m14.6 21 3.4-7.3c.6-1.3.9-2.4.9-3.5"/></svg>' ),
			array( 'title' => 'Mentor & Trainer', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m22 10-10-5L2 10l10 5 10-5Z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>' ),
		),
		'fields' => array(
			'title'    => array( 'type' => 'text', 'label' => esc_html__( 'Card Title', 'devfolio' ) ),
			'icon_image' => array( 'type' => 'image', 'label' => esc_html__( 'Icon Image (SVG/PNG)', 'devfolio' ) ),
			'icon_svg' => array( 'type' => 'textarea', 'label' => esc_html__( 'SVG Icon Markup', 'devfolio' ) ),
		),
	) );

	Kirki::add_field( 'devfolio_config', array(
		'type' => 'repeater', 'settings' => 'devfolio_process_steps', 'label' => esc_html__( 'Process Steps', 'devfolio' ), 'section' => 'devfolio_process_section',
		'default' => array(
			array( 'num' => '01', 'title' => 'Clarify scope', 'desc' => 'Quick questions, no confusion.' ),
			array( 'num' => '02', 'title' => 'Plan', 'desc' => 'Estimate + milestones.' ),
			array( 'num' => '03', 'title' => 'Build', 'desc' => 'Staging first, clean commits.' ),
			array( 'num' => '04', 'title' => 'QA + Ship', 'desc' => 'Test, notes, smooth launch.' ),
		),
		'fields' => array(
			'num'   => array( 'type' => 'text', 'label' => esc_html__( 'Step Number', 'devfolio' ) ),
			'title' => array( 'type' => 'text', 'label' => esc_html__( 'Step Title', 'devfolio' ) ),
			'desc'  => array( 'type' => 'text', 'label' => esc_html__( 'Step Description', 'devfolio' ) ),
		),
	) );

	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_contact_label', 'label' => esc_html__( 'Contact Label', 'devfolio' ), 'section' => 'devfolio_contact_section', 'default' => 'Let us talk support' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_contact_title', 'label' => esc_html__( 'Contact Title', 'devfolio' ), 'section' => 'devfolio_contact_section', 'default' => 'Need WordPress Support Help?' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'textarea', 'settings' => 'devfolio_contact_desc', 'label' => esc_html__( 'Contact Description', 'devfolio' ), 'section' => 'devfolio_contact_section', 'default' => 'For plugin support workflows, troubleshooting systems, or documentation planning, reach me at acc.arif@gmail.com or +8801769179697.' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_contact_email', 'label' => esc_html__( 'Contact Email', 'devfolio' ), 'section' => 'devfolio_contact_section', 'default' => 'acc.arif@gmail.com' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_contact_button_text', 'label' => esc_html__( 'Contact Button Text', 'devfolio' ), 'section' => 'devfolio_contact_section', 'default' => 'Email Md Abdullah Al Arif' ) );

	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_primary', 'label' => esc_html__( 'Primary Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#2fad4e' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_accent', 'label' => esc_html__( 'Accent Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#24b35a' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_bg', 'label' => esc_html__( 'Background Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#eff1f6' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_fg', 'label' => esc_html__( 'Foreground Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#1a2e1f' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_card', 'label' => esc_html__( 'Card Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#fcfdfd' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_card_fg', 'label' => esc_html__( 'Card Text Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#1a2e1f' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_primary_fg', 'label' => esc_html__( 'Primary Text Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#ffffff' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_secondary', 'label' => esc_html__( 'Secondary Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#d6f0dc' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_secondary_fg', 'label' => esc_html__( 'Secondary Text Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#1d6b30' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_accent_fg', 'label' => esc_html__( 'Accent Text Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#ffffff' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_destructive', 'label' => esc_html__( 'Destructive Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#e54545' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_destructive_fg', 'label' => esc_html__( 'Destructive Text Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#ffffff' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_muted', 'label' => esc_html__( 'Muted Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#e4e7ed' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_muted_fg', 'label' => esc_html__( 'Muted Foreground', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#636b75' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_border', 'label' => esc_html__( 'Border Color', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#d6dbe3' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_gradient_lime', 'label' => esc_html__( 'Gradient Lime', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#4abf5e' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_gradient_mint', 'label' => esc_html__( 'Gradient Mint', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => '#30b870' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_glass_bg', 'label' => esc_html__( 'Glass Background', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 'rgba(255,255,255,0.55)', 'choices' => array( 'alpha' => true ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_glass_border', 'label' => esc_html__( 'Glass Border', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 'rgba(47,173,78,0.15)', 'choices' => array( 'alpha' => true ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_glass_bg_hover', 'label' => esc_html__( 'Glass Hover Background', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 'rgba(255,255,255,0.65)', 'choices' => array( 'alpha' => true ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_glass_border_hover', 'label' => esc_html__( 'Glass Hover Border', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 'rgba(47,173,78,0.22)', 'choices' => array( 'alpha' => true ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_glow_primary', 'label' => esc_html__( 'Primary Glow', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 'rgba(47,173,78,0.4)', 'choices' => array( 'alpha' => true ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_glow_dot', 'label' => esc_html__( 'Dot Glow', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 'rgba(47,173,78,0.5)', 'choices' => array( 'alpha' => true ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_glow_card', 'label' => esc_html__( 'Card Glow', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 'rgba(47,173,78,0.08)', 'choices' => array( 'alpha' => true ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_overlay_bg', 'label' => esc_html__( 'Overlay Background', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 'rgba(26,46,31,0.7)', 'choices' => array( 'alpha' => true ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_style_overlay_light', 'label' => esc_html__( 'Overlay Light', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 'rgba(26,46,31,0.6)', 'choices' => array( 'alpha' => true ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'slider', 'settings' => 'devfolio_style_radius', 'label' => esc_html__( 'Border Radius (rem)', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 1, 'choices' => array( 'min' => 0.2, 'max' => 3, 'step' => 0.1 ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'slider', 'settings' => 'devfolio_style_glass_blur', 'label' => esc_html__( 'Glass Blur (px)', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 20, 'choices' => array( 'min' => 0, 'max' => 40, 'step' => 1 ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'slider', 'settings' => 'devfolio_style_glass_strong_blur', 'label' => esc_html__( 'Strong Glass Blur (px)', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 24, 'choices' => array( 'min' => 0, 'max' => 50, 'step' => 1 ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'slider', 'settings' => 'devfolio_style_overlay_blur', 'label' => esc_html__( 'Overlay Blur (px)', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 12, 'choices' => array( 'min' => 0, 'max' => 30, 'step' => 1 ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'slider', 'settings' => 'devfolio_style_orb_blur', 'label' => esc_html__( 'Orb Filter Blur (px)', 'devfolio' ), 'section' => 'devfolio_styles_section', 'default' => 80, 'choices' => array( 'min' => 0, 'max' => 140, 'step' => 1 ) ) );

	Kirki::add_field( 'devfolio_config', array( 'type' => 'typography', 'settings' => 'devfolio_typography_body', 'label' => esc_html__( 'Body Typography', 'devfolio' ), 'section' => 'devfolio_typography_section', 'default' => array( 'font-family' => 'Inter', 'font-size' => '16px', 'font-weight' => '400', 'line-height' => '1.6' ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'typography', 'settings' => 'devfolio_typography_heading', 'label' => esc_html__( 'Heading Typography', 'devfolio' ), 'section' => 'devfolio_typography_section', 'default' => array( 'font-family' => 'Space Grotesk', 'font-size' => '48px', 'font-weight' => '700', 'line-height' => '1.2' ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'typography', 'settings' => 'devfolio_typography_link', 'label' => esc_html__( 'Link Typography', 'devfolio' ), 'section' => 'devfolio_typography_section', 'default' => array( 'font-family' => 'Inter', 'font-size' => '14px', 'font-weight' => '500', 'line-height' => '1.5' ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'typography', 'settings' => 'devfolio_typography_button', 'label' => esc_html__( 'Button Typography', 'devfolio' ), 'section' => 'devfolio_typography_section', 'default' => array( 'font-family' => 'Inter', 'font-size' => '14px', 'font-weight' => '500', 'line-height' => '1.5' ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'typography', 'settings' => 'devfolio_typography_label', 'label' => esc_html__( 'Label Typography', 'devfolio' ), 'section' => 'devfolio_typography_section', 'default' => array( 'font-family' => 'Space Grotesk', 'font-size' => '12px', 'font-weight' => '600', 'line-height' => '1.2' ) ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_text_color_body', 'label' => esc_html__( 'Body Text Color', 'devfolio' ), 'section' => 'devfolio_typography_section', 'default' => '#1a2e1f' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_text_color_heading', 'label' => esc_html__( 'Heading Color', 'devfolio' ), 'section' => 'devfolio_typography_section', 'default' => '#1a2e1f' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_text_color_link', 'label' => esc_html__( 'Link Color', 'devfolio' ), 'section' => 'devfolio_typography_section', 'default' => '#1a2e1f' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_text_color_link_hover', 'label' => esc_html__( 'Link Hover Color', 'devfolio' ), 'section' => 'devfolio_typography_section', 'default' => '#2fad4e' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_text_color_button', 'label' => esc_html__( 'Button Text Color', 'devfolio' ), 'section' => 'devfolio_typography_section', 'default' => '#1a2e1f' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'color', 'settings' => 'devfolio_text_color_label', 'label' => esc_html__( 'Label Text Color', 'devfolio' ), 'section' => 'devfolio_typography_section', 'default' => '#2fad4e' ) );
}
add_action( 'init', 'devfolio_register_kirki_fields' );
