<?php
/**
 * Dynamic frontend style variables.
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function devfolio_get_dynamic_style_vars() {
	$primary = devfolio_get_theme_mod_value( 'devfolio_style_primary', '#2fad4e' );
	$accent  = devfolio_get_theme_mod_value( 'devfolio_style_accent', '#24b35a' );
	$bg      = devfolio_get_theme_mod_value( 'devfolio_style_bg', '#eff1f6' );
	$fg      = devfolio_get_theme_mod_value( 'devfolio_style_fg', '#1a2e1f' );
	$card    = devfolio_get_theme_mod_value( 'devfolio_style_card', '#fcfdfd' );
	$card_fg = devfolio_get_theme_mod_value( 'devfolio_style_card_fg', '#1a2e1f' );
	$primary_fg = devfolio_get_theme_mod_value( 'devfolio_style_primary_fg', '#ffffff' );
	$secondary = devfolio_get_theme_mod_value( 'devfolio_style_secondary', '#d6f0dc' );
	$secondary_fg = devfolio_get_theme_mod_value( 'devfolio_style_secondary_fg', '#1d6b30' );
	$accent_fg = devfolio_get_theme_mod_value( 'devfolio_style_accent_fg', '#ffffff' );
	$destructive = devfolio_get_theme_mod_value( 'devfolio_style_destructive', '#e54545' );
	$destructive_fg = devfolio_get_theme_mod_value( 'devfolio_style_destructive_fg', '#ffffff' );
	$muted   = devfolio_get_theme_mod_value( 'devfolio_style_muted', '#e4e7ed' );
	$muted_fg = devfolio_get_theme_mod_value( 'devfolio_style_muted_fg', '#636b75' );
	$border  = devfolio_get_theme_mod_value( 'devfolio_style_border', '#d6dbe3' );
	$gradient_lime = devfolio_get_theme_mod_value( 'devfolio_style_gradient_lime', '#4abf5e' );
	$gradient_mint = devfolio_get_theme_mod_value( 'devfolio_style_gradient_mint', '#30b870' );
	$glass_bg = devfolio_get_theme_mod_value( 'devfolio_style_glass_bg', 'rgba(255,255,255,0.55)' );
	$glass_border = devfolio_get_theme_mod_value( 'devfolio_style_glass_border', 'rgba(47,173,78,0.15)' );
	$glass_bg_hover = devfolio_get_theme_mod_value( 'devfolio_style_glass_bg_hover', 'rgba(255,255,255,0.65)' );
	$glass_border_hover = devfolio_get_theme_mod_value( 'devfolio_style_glass_border_hover', 'rgba(47,173,78,0.22)' );
	$glow_primary = devfolio_get_theme_mod_value( 'devfolio_style_glow_primary', 'rgba(47,173,78,0.4)' );
	$glow_dot = devfolio_get_theme_mod_value( 'devfolio_style_glow_dot', 'rgba(47,173,78,0.5)' );
	$glow_card = devfolio_get_theme_mod_value( 'devfolio_style_glow_card', 'rgba(47,173,78,0.08)' );
	$overlay_bg = devfolio_get_theme_mod_value( 'devfolio_style_overlay_bg', 'rgba(26,46,31,0.7)' );
	$overlay_light = devfolio_get_theme_mod_value( 'devfolio_style_overlay_light', 'rgba(26,46,31,0.6)' );
	$radius = (float) devfolio_get_theme_mod_value( 'devfolio_style_radius', 1 );
	$glass_blur = (int) devfolio_get_theme_mod_value( 'devfolio_style_glass_blur', 20 );
	$glass_strong_blur = (int) devfolio_get_theme_mod_value( 'devfolio_style_glass_strong_blur', 24 );
	$overlay_blur = (int) devfolio_get_theme_mod_value( 'devfolio_style_overlay_blur', 12 );
	$orb_blur = (int) devfolio_get_theme_mod_value( 'devfolio_style_orb_blur', 80 );

	$body_typo = devfolio_get_theme_mod_value(
		'devfolio_typography_body',
		array( 'font-family' => 'Inter', 'font-size' => '16px', 'font-weight' => '400', 'line-height' => '1.6' )
	);
	$heading_typo = devfolio_get_theme_mod_value(
		'devfolio_typography_heading',
		array( 'font-family' => 'Space Grotesk', 'font-size' => '48px', 'font-weight' => '700', 'line-height' => '1.2' )
	);
	$link_typo = devfolio_get_theme_mod_value(
		'devfolio_typography_link',
		array( 'font-family' => 'Inter', 'font-size' => '14px', 'font-weight' => '500', 'line-height' => '1.5' )
	);
	$button_typo = devfolio_get_theme_mod_value(
		'devfolio_typography_button',
		array( 'font-family' => 'Inter', 'font-size' => '14px', 'font-weight' => '500', 'line-height' => '1.5' )
	);
	$label_typo = devfolio_get_theme_mod_value(
		'devfolio_typography_label',
		array( 'font-family' => 'Space Grotesk', 'font-size' => '12px', 'font-weight' => '600', 'line-height' => '1.2' )
	);

	$text_body = devfolio_get_theme_mod_value( 'devfolio_text_color_body', '#1a2e1f' );
	$text_heading = devfolio_get_theme_mod_value( 'devfolio_text_color_heading', '#1a2e1f' );
	$text_link = devfolio_get_theme_mod_value( 'devfolio_text_color_link', '#1a2e1f' );
	$text_link_hover = devfolio_get_theme_mod_value( 'devfolio_text_color_link_hover', '#2fad4e' );
	$text_button = devfolio_get_theme_mod_value( 'devfolio_text_color_button', '#1a2e1f' );
	$text_label = devfolio_get_theme_mod_value( 'devfolio_text_color_label', '#2fad4e' );

	$css  = ':root{';
	$css .= '--primary:' . devfolio_css_value( $primary, '#2fad4e' ) . ';';
	$css .= '--accent:' . devfolio_css_value( $accent, '#24b35a' ) . ';';
	$css .= '--bg:' . devfolio_css_value( $bg, '#eff1f6' ) . ';';
	$css .= '--fg:' . devfolio_css_value( $fg, '#1a2e1f' ) . ';';
	$css .= '--card:' . devfolio_css_value( $card, '#fcfdfd' ) . ';';
	$css .= '--card-fg:' . devfolio_css_value( $card_fg, '#1a2e1f' ) . ';';
	$css .= '--primary-fg:' . devfolio_css_value( $primary_fg, '#ffffff' ) . ';';
	$css .= '--secondary:' . devfolio_css_value( $secondary, '#d6f0dc' ) . ';';
	$css .= '--secondary-fg:' . devfolio_css_value( $secondary_fg, '#1d6b30' ) . ';';
	$css .= '--accent-fg:' . devfolio_css_value( $accent_fg, '#ffffff' ) . ';';
	$css .= '--destructive:' . devfolio_css_value( $destructive, '#e54545' ) . ';';
	$css .= '--destructive-fg:' . devfolio_css_value( $destructive_fg, '#ffffff' ) . ';';
	$css .= '--muted:' . devfolio_css_value( $muted, '#e4e7ed' ) . ';';
	$css .= '--muted-fg:' . devfolio_css_value( $muted_fg, '#636b75' ) . ';';
	$css .= '--border:' . devfolio_css_value( $border, '#d6dbe3' ) . ';';
	$css .= '--gradient-green:' . devfolio_css_value( $primary, '#2fad4e' ) . ';';
	$css .= '--gradient-lime:' . devfolio_css_value( $gradient_lime, '#4abf5e' ) . ';';
	$css .= '--gradient-mint:' . devfolio_css_value( $gradient_mint, '#30b870' ) . ';';
	$css .= '--glass-bg:' . devfolio_css_value( $glass_bg, 'rgba(255,255,255,0.55)' ) . ';';
	$css .= '--glass-border:' . devfolio_css_value( $glass_border, 'rgba(47,173,78,0.15)' ) . ';';
	$css .= '--glass-bg-hover:' . devfolio_css_value( $glass_bg_hover, 'rgba(255,255,255,0.65)' ) . ';';
	$css .= '--glass-border-hover:' . devfolio_css_value( $glass_border_hover, 'rgba(47,173,78,0.22)' ) . ';';
	$css .= '--glow-primary:' . devfolio_css_value( $glow_primary, 'rgba(47,173,78,0.4)' ) . ';';
	$css .= '--glow-dot:' . devfolio_css_value( $glow_dot, 'rgba(47,173,78,0.5)' ) . ';';
	$css .= '--glow-card:' . devfolio_css_value( $glow_card, 'rgba(47,173,78,0.08)' ) . ';';
	$css .= '--overlay-bg:' . devfolio_css_value( $overlay_bg, 'rgba(26,46,31,0.7)' ) . ';';
	$css .= '--overlay-light:' . devfolio_css_value( $overlay_light, 'rgba(26,46,31,0.6)' ) . ';';
	$css .= '--radius:' . max( 0.2, $radius ) . 'rem;';
	$css .= '--glass-blur:' . max( 0, $glass_blur ) . 'px;';
	$css .= '--glass-strong-blur:' . max( 0, $glass_strong_blur ) . 'px;';
	$css .= '--overlay-blur:' . max( 0, $overlay_blur ) . 'px;';
	$css .= '--orb-blur:' . max( 0, $orb_blur ) . 'px;';
	$css .= '--font-body:' . devfolio_css_value( $body_typo['font-family'] ?? 'Inter', 'Inter' ) . ', sans-serif;';
	$css .= '--font-heading:' . devfolio_css_value( $heading_typo['font-family'] ?? 'Space Grotesk', 'Space Grotesk' ) . ', sans-serif;';
	$css .= '--font-link:' . devfolio_css_value( $link_typo['font-family'] ?? 'Inter', 'Inter' ) . ', sans-serif;';
	$css .= '--font-button:' . devfolio_css_value( $button_typo['font-family'] ?? 'Inter', 'Inter' ) . ', sans-serif;';
	$css .= '--font-label:' . devfolio_css_value( $label_typo['font-family'] ?? 'Space Grotesk', 'Space Grotesk' ) . ', sans-serif;';
	$css .= '--body-font-size:' . devfolio_css_value( $body_typo['font-size'] ?? '16px', '16px' ) . ';';
	$css .= '--body-font-weight:' . devfolio_css_value( $body_typo['font-weight'] ?? '400', '400' ) . ';';
	$css .= '--body-line-height:' . devfolio_css_value( $body_typo['line-height'] ?? '1.6', '1.6' ) . ';';
	$css .= '--heading-font-size:' . devfolio_css_value( $heading_typo['font-size'] ?? '48px', '48px' ) . ';';
	$css .= '--heading-font-weight:' . devfolio_css_value( $heading_typo['font-weight'] ?? '700', '700' ) . ';';
	$css .= '--heading-line-height:' . devfolio_css_value( $heading_typo['line-height'] ?? '1.2', '1.2' ) . ';';
	$css .= '--link-font-size:' . devfolio_css_value( $link_typo['font-size'] ?? '14px', '14px' ) . ';';
	$css .= '--link-font-weight:' . devfolio_css_value( $link_typo['font-weight'] ?? '500', '500' ) . ';';
	$css .= '--link-line-height:' . devfolio_css_value( $link_typo['line-height'] ?? '1.5', '1.5' ) . ';';
	$css .= '--button-font-size:' . devfolio_css_value( $button_typo['font-size'] ?? '14px', '14px' ) . ';';
	$css .= '--button-font-weight:' . devfolio_css_value( $button_typo['font-weight'] ?? '500', '500' ) . ';';
	$css .= '--button-line-height:' . devfolio_css_value( $button_typo['line-height'] ?? '1.5', '1.5' ) . ';';
	$css .= '--label-font-size:' . devfolio_css_value( $label_typo['font-size'] ?? '12px', '12px' ) . ';';
	$css .= '--label-font-weight:' . devfolio_css_value( $label_typo['font-weight'] ?? '600', '600' ) . ';';
	$css .= '--label-line-height:' . devfolio_css_value( $label_typo['line-height'] ?? '1.2', '1.2' ) . ';';
	$css .= '--text-body:' . devfolio_css_value( $text_body, '#1a2e1f' ) . ';';
	$css .= '--text-heading:' . devfolio_css_value( $text_heading, '#1a2e1f' ) . ';';
	$css .= '--text-link:' . devfolio_css_value( $text_link, '#1a2e1f' ) . ';';
	$css .= '--text-link-hover:' . devfolio_css_value( $text_link_hover, '#2fad4e' ) . ';';
	$css .= '--text-button:' . devfolio_css_value( $text_button, '#1a2e1f' ) . ';';
	$css .= '--text-label:' . devfolio_css_value( $text_label, '#2fad4e' ) . ';';
	$css .= '}';

	return $css;
}
