<?php
/**
 * Native Customizer settings.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function devfolio_customize_sanitize_checkbox( $value ) {
	return (bool) $value;
}

function devfolio_customize_sanitize_json( $value ) {
	$value = trim( (string) $value );

	if ( '' === $value ) {
		return '';
	}

	$decoded = json_decode( $value, true );
	return JSON_ERROR_NONE === json_last_error() ? wp_json_encode( $decoded ) : '';
}

function devfolio_customize_sanitize_font_family( $value ) {
	return sanitize_text_field( (string) $value );
}

function devfolio_register_native_customizer( $wp_customize ) {
	$wp_customize->add_panel(
		'devfolio_options',
		array(
			'title'       => __( 'Devfolio Options', 'devfolio' ),
			'description' => __( 'Native theme settings for navigation, homepage content, colors, and typography.', 'devfolio' ),
			'priority'    => 10,
		)
	);

	$sections = array(
		'devfolio_navigation_section' => __( 'Navigation', 'devfolio' ),
		'devfolio_theme_section'      => __( 'Theme Options', 'devfolio' ),
		'devfolio_hero_section'       => __( 'Hero', 'devfolio' ),
		'devfolio_about_section'      => __( 'About', 'devfolio' ),
		'devfolio_skills_section'     => __( 'Skills', 'devfolio' ),
		'devfolio_experience_section' => __( 'Experience', 'devfolio' ),
		'devfolio_project_section'    => __( 'Projects', 'devfolio' ),
		'devfolio_portfolio_section'  => __( 'Portfolio', 'devfolio' ),
		'devfolio_services_section'   => __( 'Services', 'devfolio' ),
		'devfolio_process_section'    => __( 'Process', 'devfolio' ),
		'devfolio_origin_section'     => __( 'Origin', 'devfolio' ),
		'devfolio_blog_section'       => __( 'Blog', 'devfolio' ),
		'devfolio_testimonials_section'=> __( 'Testimonials', 'devfolio' ),
		'devfolio_contact_section'    => __( 'Contact', 'devfolio' ),
		'devfolio_styles_section'     => __( 'Colors', 'devfolio' ),
		'devfolio_typography_section' => __( 'Typography', 'devfolio' ),
	);

	foreach ( $sections as $section_id => $section_title ) {
		$wp_customize->add_section(
			$section_id,
			array(
				'title' => $section_title,
				'panel' => 'devfolio_options',
			)
		);
	}

	foreach ( devfolio_get_section_defaults() as $section_key => $section_meta ) {
		$id_setting = 'devfolio_section_id_' . $section_key;
		$label_key  = 'devfolio_nav_label_' . $section_key;

		$wp_customize->add_setting(
			$id_setting,
			array(
				'default'           => $section_meta['id'],
				'sanitize_callback' => 'sanitize_title',
				'type'              => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			$id_setting,
			array(
				'label'   => sprintf( __( '%s Section ID', 'devfolio' ), $section_meta['label'] ),
				'section' => 'devfolio_navigation_section',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			$label_key,
			array(
				'default'           => $section_meta['label'],
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			$label_key,
			array(
				'label'   => sprintf( __( '%s Menu Label', 'devfolio' ), $section_meta['label'] ),
				'section' => 'devfolio_navigation_section',
				'type'    => 'text',
			)
		);
	}

	$fields = array(
		array( 'key' => 'devfolio_hero_label', 'section' => 'devfolio_hero_section', 'label' => __( 'Hero Label', 'devfolio' ), 'default' => 'Software Engineer • Full Stack Developer' ),
		array( 'key' => 'devfolio_hero_title_before', 'section' => 'devfolio_hero_section', 'label' => __( 'Hero Title Before Highlight', 'devfolio' ), 'default' => 'I build scalable' ),
		array( 'key' => 'devfolio_hero_title_highlight', 'section' => 'devfolio_hero_section', 'label' => __( 'Hero Highlight', 'devfolio' ), 'default' => 'web and mobile applications' ),
		array( 'key' => 'devfolio_hero_title_after', 'section' => 'devfolio_hero_section', 'label' => __( 'Hero Title After Highlight', 'devfolio' ), 'default' => 'for a smarter world.' ),
		array( 'key' => 'devfolio_hero_subtitle', 'section' => 'devfolio_hero_section', 'label' => __( 'Hero Subtitle', 'devfolio' ), 'default' => 'Software Engineer with expertise in Laravel, React, Next.js, and Mobile App Development. Dedicated to building innovative solutions that make the world easier and faster.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_hero_cta_primary_text', 'section' => 'devfolio_hero_section', 'label' => __( 'Primary CTA Text', 'devfolio' ), 'default' => 'Contact Me' ),
		array( 'key' => 'devfolio_hero_cta_primary_url', 'section' => 'devfolio_hero_section', 'label' => __( 'Primary CTA URL', 'devfolio' ), 'default' => '#contact', 'sanitize' => 'esc_url_raw' ),
		array( 'key' => 'devfolio_hero_cta_secondary_text', 'section' => 'devfolio_hero_section', 'label' => __( 'Secondary CTA Text', 'devfolio' ), 'default' => 'View Contributions' ),
		array( 'key' => 'devfolio_hero_cta_secondary_url', 'section' => 'devfolio_hero_section', 'label' => __( 'Secondary CTA URL', 'devfolio' ), 'default' => '#projects', 'sanitize' => 'esc_url_raw' ),
		array( 'key' => 'devfolio_denim_section_title', 'section' => 'devfolio_hero_section', 'label' => __( 'Denim Innovation Title', 'devfolio' ), 'default' => 'Denim Innovation' ),
		array( 'key' => 'devfolio_denim_section_subtitle', 'section' => 'devfolio_hero_section', 'label' => __( 'Denim Innovation Subtitle', 'devfolio' ), 'default' => 'Experimental washes, product ideas, and visual concept development showcased in an interactive 3D slider.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_social_profiles', 'section' => 'devfolio_hero_section', 'label' => __( 'Social Profiles JSON', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'devfolio_customize_sanitize_json', 'description' => __( 'JSON array: [{"label":"LinkedIn","url":"https://...","icon_image":"","icon":"<svg>...</svg>"}]', 'devfolio' ) ),
		array( 'key' => 'devfolio_hero_stats', 'section' => 'devfolio_hero_section', 'label' => __( 'Hero Stats JSON', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'devfolio_customize_sanitize_json', 'description' => __( 'JSON array: [{"value":"6+","label":"Years Experience"}]', 'devfolio' ) ),
		array( 'key' => 'devfolio_about_label', 'section' => 'devfolio_about_section', 'label' => __( 'About Label', 'devfolio' ), 'default' => 'About Me' ),
		array( 'key' => 'devfolio_about_title', 'section' => 'devfolio_about_section', 'label' => __( 'About Title', 'devfolio' ), 'default' => 'Skills, Experience & Education' ),
		array( 'key' => 'devfolio_about_desc', 'section' => 'devfolio_about_section', 'label' => __( 'About Description', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_about_tab_skills', 'section' => 'devfolio_about_section', 'label' => __( 'Skills Tab Label', 'devfolio' ), 'default' => 'Skills' ),
		array( 'key' => 'devfolio_about_tab_experience', 'section' => 'devfolio_about_section', 'label' => __( 'Experience Tab Label', 'devfolio' ), 'default' => 'Experience' ),
		array( 'key' => 'devfolio_about_tab_education', 'section' => 'devfolio_about_section', 'label' => __( 'Education Tab Label', 'devfolio' ), 'default' => 'Education' ),
		array( 'key' => 'devfolio_skills_label', 'section' => 'devfolio_skills_section', 'label' => __( 'Skills Label', 'devfolio' ), 'default' => 'Skills' ),
		array( 'key' => 'devfolio_skills_title', 'section' => 'devfolio_skills_section', 'label' => __( 'Skills Title', 'devfolio' ), 'default' => 'Skills & Toolset' ),
		array( 'key' => 'devfolio_skills_desc', 'section' => 'devfolio_skills_section', 'label' => __( 'Skills Description', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_skill_groups', 'section' => 'devfolio_skills_section', 'label' => __( 'Skill Groups JSON', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'devfolio_customize_sanitize_json', 'description' => __( 'JSON array: [{"title":"Programming Languages","tags":"PHP, JavaScript"}]', 'devfolio' ) ),
		array( 'key' => 'devfolio_experience_label', 'section' => 'devfolio_experience_section', 'label' => __( 'Experience Label', 'devfolio' ), 'default' => 'Experience' ),
		array( 'key' => 'devfolio_experience_title', 'section' => 'devfolio_experience_section', 'label' => __( 'Experience Title', 'devfolio' ), 'default' => 'Support & Technical Experience' ),
		array( 'key' => 'devfolio_experience_desc', 'section' => 'devfolio_experience_section', 'label' => __( 'Experience Description', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_contributions_label', 'section' => 'devfolio_project_section', 'label' => __( 'Projects Label', 'devfolio' ), 'default' => 'Open Source' ),
		array( 'key' => 'devfolio_contributions_title', 'section' => 'devfolio_project_section', 'label' => __( 'Projects Title', 'devfolio' ), 'default' => 'Contributions & Support Work' ),
		array( 'key' => 'devfolio_contributions_desc', 'section' => 'devfolio_project_section', 'label' => __( 'Projects Description', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_featured_label', 'section' => 'devfolio_project_section', 'label' => __( 'Featured Label', 'devfolio' ), 'default' => 'Full Stack Development' ),
		array( 'key' => 'devfolio_featured_title', 'section' => 'devfolio_project_section', 'label' => __( 'Featured Title', 'devfolio' ), 'default' => 'Built Scalable Apps for REALTY.COM' ),
		array( 'key' => 'devfolio_featured_desc', 'section' => 'devfolio_project_section', 'label' => __( 'Featured Description', 'devfolio' ), 'default' => 'Developing and maintaining mobile applications and robust back-ends for scale. Writing unit tests, designing application architecture, and crafting APIs to serve over 1,000,000+ real estate listings.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_featured_tags', 'section' => 'devfolio_project_section', 'label' => __( 'Featured Tags', 'devfolio' ), 'default' => 'React Native, Node.js, Laravel, Mobile App, Architecture' ),
		array( 'key' => 'devfolio_events_title', 'section' => 'devfolio_project_section', 'label' => __( 'Events Title', 'devfolio' ), 'default' => 'Events & Conferences' ),
		array( 'key' => 'devfolio_events_subtitle', 'section' => 'devfolio_project_section', 'label' => __( 'Events Subtitle', 'devfolio' ), 'default' => 'Moments from WordCamps, meetups, and community events', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_contributions', 'section' => 'devfolio_project_section', 'label' => __( 'Contribution Cards JSON', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'devfolio_customize_sanitize_json', 'description' => __( 'JSON array: [{"title":"Mobile App Developer","icon_image":"","icon_svg":"<svg>...</svg>"}]', 'devfolio' ) ),
		array( 'key' => 'devfolio_portfolio_label', 'section' => 'devfolio_portfolio_section', 'label' => __( 'Portfolio Label', 'devfolio' ), 'default' => 'Portfolio' ),
		array( 'key' => 'devfolio_portfolio_title', 'section' => 'devfolio_portfolio_section', 'label' => __( 'Portfolio Title', 'devfolio' ), 'default' => 'Featured Projects' ),
		array( 'key' => 'devfolio_portfolio_desc', 'section' => 'devfolio_portfolio_section', 'label' => __( 'Portfolio Description', 'devfolio' ), 'default' => 'A selection of WordPress themes, plugins, and contributions built over the years.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_services_label', 'section' => 'devfolio_services_section', 'label' => __( 'Services Label', 'devfolio' ), 'default' => 'Services' ),
		array( 'key' => 'devfolio_services_title', 'section' => 'devfolio_services_section', 'label' => __( 'Services Title', 'devfolio' ), 'default' => 'How I Can Help Your Users' ),
		array( 'key' => 'devfolio_services_desc', 'section' => 'devfolio_services_section', 'label' => __( 'Services Description', 'devfolio' ), 'default' => 'Support-first execution with technical depth and clear communication.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_process_label', 'section' => 'devfolio_process_section', 'label' => __( 'Process Label', 'devfolio' ), 'default' => 'Process' ),
		array( 'key' => 'devfolio_process_title', 'section' => 'devfolio_process_section', 'label' => __( 'Process Title', 'devfolio' ), 'default' => 'How I work' ),
		array( 'key' => 'devfolio_process_desc', 'section' => 'devfolio_process_section', 'label' => __( 'Process Description', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_denim_video_section_title', 'section' => 'devfolio_process_section', 'label' => __( 'Videography Title', 'devfolio' ), 'default' => 'Denim Innovation Videography' ),
		array( 'key' => 'devfolio_denim_video_section_subtitle', 'section' => 'devfolio_process_section', 'label' => __( 'Videography Subtitle', 'devfolio' ), 'default' => 'YouTube and hosted videos presented in the same interactive 3D slider style.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_process_steps', 'section' => 'devfolio_process_section', 'label' => __( 'Process Steps JSON', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'devfolio_customize_sanitize_json', 'description' => __( 'JSON array: [{"num":"01","title":"Architecture","desc":"..."}]', 'devfolio' ) ),
		array( 'key' => 'devfolio_origin_label', 'section' => 'devfolio_origin_section', 'label' => __( 'Origin Label', 'devfolio' ), 'default' => 'Origin Story' ),
		array( 'key' => 'devfolio_origin_title', 'section' => 'devfolio_origin_section', 'label' => __( 'Origin Title', 'devfolio' ), 'default' => 'My Journey' ),
		array( 'key' => 'devfolio_origin_desc', 'section' => 'devfolio_origin_section', 'label' => __( 'Origin Description', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_blog_label', 'section' => 'devfolio_blog_section', 'label' => __( 'Blog Label', 'devfolio' ), 'default' => 'Blog' ),
		array( 'key' => 'devfolio_blog_title', 'section' => 'devfolio_blog_section', 'label' => __( 'Blog Title', 'devfolio' ), 'default' => 'Latest Articles' ),
		array( 'key' => 'devfolio_blog_desc', 'section' => 'devfolio_blog_section', 'label' => __( 'Blog Description', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_testimonials_label', 'section' => 'devfolio_testimonials_section', 'label' => __( 'Testimonials Label', 'devfolio' ), 'default' => 'Testimonials' ),
		array( 'key' => 'devfolio_testimonials_title', 'section' => 'devfolio_testimonials_section', 'label' => __( 'Testimonials Title', 'devfolio' ), 'default' => 'What clients say' ),
		array( 'key' => 'devfolio_testimonials_desc', 'section' => 'devfolio_testimonials_section', 'label' => __( 'Testimonials Description', 'devfolio' ), 'default' => '', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_contact_label', 'section' => 'devfolio_contact_section', 'label' => __( 'Contact Label', 'devfolio' ), 'default' => 'Let us talk support' ),
		array( 'key' => 'devfolio_contact_title', 'section' => 'devfolio_contact_section', 'label' => __( 'Contact Title', 'devfolio' ), 'default' => 'Looking for a Software Engineer?' ),
		array( 'key' => 'devfolio_contact_desc', 'section' => 'devfolio_contact_section', 'label' => __( 'Contact Description', 'devfolio' ), 'default' => 'For mobile applications, full-stack backends, or any innovative ideas, reach out to me via email or LinkedIn.', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field' ),
		array( 'key' => 'devfolio_contact_email', 'section' => 'devfolio_contact_section', 'label' => __( 'Contact Email', 'devfolio' ), 'default' => 'shuvogoswamii@gmail.com', 'sanitize' => 'sanitize_email' ),
		array( 'key' => 'devfolio_contact_button_text', 'section' => 'devfolio_contact_section', 'label' => __( 'Contact Button Text', 'devfolio' ), 'default' => 'Email Shuvo Goswami' ),
	);

	foreach ( $fields as $field ) {
		$wp_customize->add_setting(
			$field['key'],
			array(
				'default'           => $field['default'],
				'sanitize_callback' => $field['sanitize'] ?? 'sanitize_text_field',
				'type'              => 'theme_mod',
			)
		);

		$control_args = array(
			'label'       => $field['label'],
			'section'     => $field['section'],
			'type'        => $field['type'] ?? 'text',
			'description' => $field['description'] ?? '',
		);

		if ( 'devfolio_hero_image' === $field['key'] ) {
			continue;
		}

		$wp_customize->add_control( $field['key'], $control_args );
	}

	$wp_customize->add_setting(
		'devfolio_hero_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'absint',
			'type'              => 'theme_mod',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'devfolio_hero_image',
			array(
				'label'     => __( 'Hero Image', 'devfolio' ),
				'section'   => 'devfolio_hero_section',
				'mime_type' => 'image',
			)
		)
	);

	$color_fields = array(
		'devfolio_style_primary'         => '#2fad4e',
		'devfolio_style_accent'          => '#24b35a',
		'devfolio_style_bg'              => '#eff1f6',
		'devfolio_style_fg'              => '#1a2e1f',
		'devfolio_style_card'            => '#fcfdfd',
		'devfolio_style_card_fg'         => '#1a2e1f',
		'devfolio_style_primary_fg'      => '#ffffff',
		'devfolio_style_secondary'       => '#d6f0dc',
		'devfolio_style_secondary_fg'    => '#1d6b30',
		'devfolio_style_accent_fg'       => '#ffffff',
		'devfolio_style_destructive'     => '#e54545',
		'devfolio_style_destructive_fg'  => '#ffffff',
		'devfolio_style_muted'           => '#e4e7ed',
		'devfolio_style_muted_fg'        => '#636b75',
		'devfolio_style_border'          => '#d6dbe3',
		'devfolio_style_gradient_lime'   => '#4abf5e',
		'devfolio_style_gradient_mint'   => '#30b870',
		'devfolio_text_color_body'       => '#1a2e1f',
		'devfolio_text_color_heading'    => '#1a2e1f',
		'devfolio_text_color_link'       => '#1a2e1f',
		'devfolio_text_color_link_hover' => '#2fad4e',
		'devfolio_text_color_button'     => '#1a2e1f',
		'devfolio_text_color_label'      => '#2fad4e',
	);

	foreach ( $color_fields as $key => $default ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $default,
				'sanitize_callback' => 'sanitize_hex_color',
				'type'              => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$key,
				array(
					'label'   => ucwords( str_replace( array( 'devfolio_', '_' ), array( '', ' ' ), $key ) ),
					'section' => 'devfolio_styles_section',
				)
			)
		);
	}

	$text_style_fields = array(
		'devfolio_style_glass_bg'           => 'rgba(255,255,255,0.55)',
		'devfolio_style_glass_border'       => 'rgba(47,173,78,0.15)',
		'devfolio_style_glass_bg_hover'     => 'rgba(255,255,255,0.65)',
		'devfolio_style_glass_border_hover' => 'rgba(47,173,78,0.22)',
		'devfolio_style_glow_primary'       => 'rgba(47,173,78,0.4)',
		'devfolio_style_glow_dot'           => 'rgba(47,173,78,0.5)',
		'devfolio_style_glow_card'          => 'rgba(47,173,78,0.08)',
		'devfolio_style_overlay_bg'         => 'rgba(26,46,31,0.7)',
		'devfolio_style_overlay_light'      => 'rgba(26,46,31,0.6)',
	);

	foreach ( $text_style_fields as $key => $default ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $default,
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			$key,
			array(
				'label'   => ucwords( str_replace( array( 'devfolio_', '_' ), array( '', ' ' ), $key ) ),
				'section' => 'devfolio_styles_section',
				'type'    => 'text',
			)
		);
	}

	$range_fields = array(
		'devfolio_style_radius'            => array( 'default' => 1, 'min' => 0.2, 'max' => 3, 'step' => 0.1 ),
		'devfolio_style_glass_blur'        => array( 'default' => 20, 'min' => 0, 'max' => 40, 'step' => 1 ),
		'devfolio_style_glass_strong_blur' => array( 'default' => 24, 'min' => 0, 'max' => 50, 'step' => 1 ),
		'devfolio_style_overlay_blur'      => array( 'default' => 12, 'min' => 0, 'max' => 30, 'step' => 1 ),
		'devfolio_style_orb_blur'          => array( 'default' => 80, 'min' => 0, 'max' => 140, 'step' => 1 ),
	);

	foreach ( $range_fields as $key => $args ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $args['default'],
				'sanitize_callback' => 'floatval',
				'type'              => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			$key,
			array(
				'label'       => ucwords( str_replace( array( 'devfolio_', '_' ), array( '', ' ' ), $key ) ),
				'section'     => 'devfolio_styles_section',
				'type'        => 'number',
				'input_attrs' => array(
					'min'  => $args['min'],
					'max'  => $args['max'],
					'step' => $args['step'],
				),
			)
		);
	}

	$typography_groups = array(
		'body'    => array( 'family' => 'Inter', 'size' => '16px', 'weight' => '400', 'line' => '1.6' ),
		'heading' => array( 'family' => 'Space Grotesk', 'size' => '48px', 'weight' => '700', 'line' => '1.2' ),
		'link'    => array( 'family' => 'Inter', 'size' => '14px', 'weight' => '500', 'line' => '1.5' ),
		'button'  => array( 'family' => 'Inter', 'size' => '14px', 'weight' => '500', 'line' => '1.5' ),
		'label'   => array( 'family' => 'Space Grotesk', 'size' => '12px', 'weight' => '600', 'line' => '1.2' ),
	);

	foreach ( $typography_groups as $group => $defaults ) {
		$prefix = 'devfolio_typography_' . $group . '_';

		$wp_customize->add_setting(
			$prefix . 'font_family',
			array(
				'default'           => $defaults['family'],
				'sanitize_callback' => 'devfolio_customize_sanitize_font_family',
				'type'              => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			$prefix . 'font_family',
			array(
				'label'   => sprintf( __( '%s Font Family', 'devfolio' ), ucfirst( $group ) ),
				'section' => 'devfolio_typography_section',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			$prefix . 'font_size',
			array(
				'default'           => $defaults['size'],
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			$prefix . 'font_size',
			array(
				'label'   => sprintf( __( '%s Font Size', 'devfolio' ), ucfirst( $group ) ),
				'section' => 'devfolio_typography_section',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			$prefix . 'font_weight',
			array(
				'default'           => $defaults['weight'],
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			$prefix . 'font_weight',
			array(
				'label'   => sprintf( __( '%s Font Weight', 'devfolio' ), ucfirst( $group ) ),
				'section' => 'devfolio_typography_section',
				'type'    => 'text',
			)
		);

		$wp_customize->add_setting(
			$prefix . 'line_height',
			array(
				'default'           => $defaults['line'],
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'theme_mod',
			)
		);
		$wp_customize->add_control(
			$prefix . 'line_height',
			array(
				'label'   => sprintf( __( '%s Line Height', 'devfolio' ), ucfirst( $group ) ),
				'section' => 'devfolio_typography_section',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'devfolio_register_native_customizer' );
