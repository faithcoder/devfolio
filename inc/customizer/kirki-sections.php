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

	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_label', 'label' => esc_html__( 'Hero Label', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'Senior Developer • Plugins • Performance' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_title_before', 'label' => esc_html__( 'Hero Title (Before Highlight)', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'I build fast, secure' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_title_highlight', 'label' => esc_html__( 'Hero Highlight', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'plugins and custom features' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_title_after', 'label' => esc_html__( 'Hero Title (After Highlight)', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'that scale.' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'textarea', 'settings' => 'devfolio_hero_subtitle', 'label' => esc_html__( 'Hero Subtitle', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => '10+ years of experience. Product-focused development, clean code, and reliable delivery. Available for ongoing work or project-based builds.' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'image', 'settings' => 'devfolio_hero_image', 'label' => esc_html__( 'Hero Image', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => '' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_cta_primary_text', 'label' => esc_html__( 'Primary CTA Text', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'Book a Call' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_cta_primary_url', 'label' => esc_html__( 'Primary CTA URL', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => '#contact' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_cta_secondary_text', 'label' => esc_html__( 'Secondary CTA Text', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => 'View Profile' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_hero_cta_secondary_url', 'label' => esc_html__( 'Secondary CTA URL', 'devfolio' ), 'section' => 'devfolio_hero_section', 'default' => '#projects' ) );
	Kirki::add_field( 'devfolio_config', array(
		'type' => 'repeater', 'settings' => 'devfolio_social_profiles', 'label' => esc_html__( 'Social Profiles', 'devfolio' ), 'section' => 'devfolio_hero_section',
		'default' => array(
			array( 'label' => 'LinkedIn', 'url' => 'https://linkedin.com', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zm2-3a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>' ),
			array( 'label' => 'GitHub', 'url' => 'https://github.com', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.4 5.4 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65S8.93 17.38 9 18v4m0 0H6c-1 0-1.5-.5-2-1s-1.5-1-2-1"/></svg>' ),
			array( 'label' => 'WordPress', 'url' => 'https://wordpress.org', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2.1 12.1 7 21l4-9"/><path d="m14.6 21 3.4-7.3c.6-1.3.9-2.4.9-3.5 0-.9-.2-1.7-.4-2.5"/><path d="M7.8 4.7A8 8 0 0 1 20 11.5c0 1.5-.3 2.9-.9 4.2"/><path d="M3 10.5A8 8 0 0 1 7.8 4.7L5.4 10.5"/></svg>' ),
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
			array( 'value' => '10+', 'label' => 'Years Experience' ),
			array( 'value' => 'Architecture', 'label' => 'Plugin-first' ),
			array( 'value' => 'CWV +', 'label' => 'Performance' ),
			array( 'value' => 'Async-ready', 'label' => 'Remote' ),
		),
		'fields' => array(
			'value' => array( 'type' => 'text', 'label' => esc_html__( 'Value', 'devfolio' ) ),
			'label' => array( 'type' => 'text', 'label' => esc_html__( 'Label', 'devfolio' ) ),
		),
	) );
	Kirki::add_field( 'devfolio_config', array(
		'type' => 'repeater', 'settings' => 'devfolio_skill_groups', 'label' => esc_html__( 'Skill Groups', 'devfolio' ), 'section' => 'devfolio_skills_section',
		'default' => array(
			array( 'title' => 'Languages', 'tags' => 'PHP, JavaScript (ES6+), TypeScript, SQL' ),
			array( 'title' => 'WordPress', 'tags' => 'Plugin/Theme Dev, WP-CLI, REST API, Gutenberg Blocks' ),
			array( 'title' => 'Frameworks', 'tags' => 'Laravel, React.js, Vue.js, Tailwind CSS' ),
			array( 'title' => 'DevOps', 'tags' => 'Docker, CI/CD Pipelines, Git, Composer' ),
		),
		'fields' => array(
			'title' => array( 'type' => 'text', 'label' => esc_html__( 'Group Title', 'devfolio' ) ),
			'tags'  => array( 'type' => 'text', 'label' => esc_html__( 'Tags (comma separated)', 'devfolio' ) ),
		),
	) );

	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_featured_label', 'label' => esc_html__( 'Featured Label', 'devfolio' ), 'section' => 'devfolio_project_section', 'default' => 'Featured Project' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_featured_title', 'label' => esc_html__( 'Featured Title', 'devfolio' ), 'section' => 'devfolio_project_section', 'default' => 'WPReactPanel' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'textarea', 'settings' => 'devfolio_featured_desc', 'label' => esc_html__( 'Featured Description', 'devfolio' ), 'section' => 'devfolio_project_section', 'default' => 'A modern WordPress React Admin Settings Builder using React, ShadCN UI, and TypeScript. A new way to build beautiful admin panels for WordPress plugins.' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_featured_tags', 'label' => esc_html__( 'Featured Tags (comma separated)', 'devfolio' ), 'section' => 'devfolio_project_section', 'default' => 'React, TypeScript, ShadCN UI, WordPress' ) );
	Kirki::add_field( 'devfolio_config', array(
		'type' => 'repeater', 'settings' => 'devfolio_contributions', 'label' => esc_html__( 'Contribution Cards', 'devfolio' ), 'section' => 'devfolio_project_section',
		'default' => array(
			array( 'title' => 'Core Contributor', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>' ),
			array( 'title' => 'Docs Contributor', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>' ),
			array( 'title' => 'Meetup Organizer', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>' ),
			array( 'title' => 'Plugin Developer', 'icon_image' => '', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="6" x2="6" y1="3" y2="15"/><circle cx="18" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M18 9a9 9 0 0 1-9 9"/></svg>' ),
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

	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_contact_label', 'label' => esc_html__( 'Contact Label', 'devfolio' ), 'section' => 'devfolio_contact_section', 'default' => 'Get in touch' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_contact_title', 'label' => esc_html__( 'Contact Title', 'devfolio' ), 'section' => 'devfolio_contact_section', 'default' => 'Contact' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'textarea', 'settings' => 'devfolio_contact_desc', 'label' => esc_html__( 'Contact Description', 'devfolio' ), 'section' => 'devfolio_contact_section', 'default' => "Tell me what you're building (or what's broken). I'll reply with a clear next step." ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_contact_email', 'label' => esc_html__( 'Contact Email', 'devfolio' ), 'section' => 'devfolio_contact_section', 'default' => 'you@example.com' ) );
	Kirki::add_field( 'devfolio_config', array( 'type' => 'text', 'settings' => 'devfolio_contact_button_text', 'label' => esc_html__( 'Contact Button Text', 'devfolio' ), 'section' => 'devfolio_contact_section', 'default' => 'Send a Message' ) );

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
