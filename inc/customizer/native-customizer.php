<?php
/**
 * Native Customizer settings.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function devfolio_customize_sanitize_font_family( $value ) {
	return sanitize_text_field( (string) $value );
}

function devfolio_customize_sanitize_layout_mode( $value ) {
	$value = sanitize_key( (string) $value );

	return in_array( $value, array( 'full', 'boxed' ), true ) ? $value : 'full';
}

function devfolio_register_native_customizer( $wp_customize ) {
	$wp_customize->add_panel(
		'devfolio_options',
		array(
			'title'       => __( 'Devfolio Options', 'devfolio' ),
			'description' => __( 'Native theme settings for layout, colors, and typography.', 'devfolio' ),
			'priority'    => 10,
		)
	);

	$sections = array(
		'devfolio_layout_section'     => __( 'Layout', 'devfolio' ),
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

	$wp_customize->add_setting(
		'devfolio_layout_mode',
		array(
			'default'           => 'full',
			'sanitize_callback' => 'devfolio_customize_sanitize_layout_mode',
			'type'              => 'theme_mod',
		)
	);
	$wp_customize->add_control(
		'devfolio_layout_mode',
		array(
			'label'       => __( 'Site Layout', 'devfolio' ),
			'description' => __( 'Choose full width or a boxed layout with a 1350px maximum width.', 'devfolio' ),
			'section'     => 'devfolio_layout_section',
			'type'        => 'select',
			'choices'     => array(
				'full'  => __( 'Full Width Layout', 'devfolio' ),
				'boxed' => __( 'Boxed Layout', 'devfolio' ),
			),
		)
	);

	$color_fields = array(
		'devfolio_style_primary'         => '#2fad4e',
		'devfolio_style_accent'          => '#2fad4e',
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
