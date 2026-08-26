<?php
/**
 * CDS block theme.
 *
 * Enqueues the kit CSS (tokens + layout + components, not base.css).
 * Registers Layer B tokens when register_design_token() exists.
 *
 * @package cds
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Editor styles so the canvas tracks the same kit files as the front.
 */
function cds_setup() {
	add_editor_style(
		array(
			'assets/css/fonts.css',
			'assets/css/tokens.css',
			'assets/css/layouts.css',
			'assets/css/components.css',
			'assets/css/block-styles.css',
		)
	);
}
add_action( 'after_setup_theme', 'cds_setup' );

/**
 * Front-end kit CSS. Skip base.css — theme.json owns element styles.
 */
function cds_enqueue_styles() {
	$version = wp_get_theme()->get( 'Version' );
	$base    = get_theme_file_uri( 'assets/css/' );

	wp_enqueue_style( 'cds-fonts', $base . 'fonts.css', array(), $version );
	wp_enqueue_style( 'cds-tokens', $base . 'tokens.css', array( 'cds-fonts' ), $version );
	wp_enqueue_style( 'cds-layouts', $base . 'layouts.css', array( 'cds-tokens' ), $version );
	wp_enqueue_style( 'cds-components', $base . 'components.css', array( 'cds-tokens' ), $version );
	wp_enqueue_style( 'cds-block-styles', $base . 'block-styles.css', array( 'cds-tokens' ), $version );
}
add_action( 'wp_enqueue_scripts', 'cds_enqueue_styles' );

/**
 * Let CSS size the Site Logo. Core prints width/height attributes (and
 * sometimes an inline width) which would otherwise need !important to beat.
 */
function cds_logo_image_attributes( $attr ) {
	unset( $attr['width'], $attr['height'], $attr['style'] );
	return $attr;
}
add_filter( 'get_custom_logo_image_attributes', 'cds_logo_image_attributes' );

/**
 * Load compiler identity defaults (brand.json → brand-defaults.json).
 *
 * @return array{name:string,tagline:string,mark:string}|null
 */
function cds_brand_defaults() {
	$path = get_theme_file_path( 'brand-defaults.json' );
	if ( ! is_readable( $path ) ) {
		return null;
	}
	$data = json_decode( (string) file_get_contents( $path ), true );
	if ( empty( $data['name'] ) || ! is_string( $data['name'] ) ) {
		return null;
	}
	return array(
		'name'    => $data['name'],
		'tagline' => isset( $data['tagline'] ) ? (string) $data['tagline'] : '',
		'mark'    => isset( $data['mark'] ) ? (string) $data['mark'] : 'assets/mark.svg',
	);
}

/**
 * Seed Site Title and Tagline from the kit defaults.
 *
 * First run (or theme switch): always apply. Later compiles: only if WP still
 * holds the last seeded name, so a hand-edited identity is left alone.
 */
function cds_seed_site_identity() {
	$defaults = cds_brand_defaults();
	if ( ! $defaults ) {
		return;
	}

	$hash     = md5( $defaults['name'] . "\n" . $defaults['tagline'] );
	$stored   = get_option( 'cds_identity_hash' );
	$owned    = get_option( 'cds_identity_seed_name' );
	$blogname = (string) get_option( 'blogname' );

	if ( $stored === $hash ) {
		return;
	}

	$unseeded = ( false === $owned || '' === $owned );
	$still_ours = ( $owned && $blogname === $owned );
	if ( $unseeded || $still_ours ) {
		update_option( 'blogname', $defaults['name'] );
		update_option( 'blogdescription', $defaults['tagline'] );
		update_option( 'cds_identity_seed_name', $defaults['name'] );
	}

	update_option( 'cds_identity_hash', $hash );
}
add_action( 'after_switch_theme', 'cds_seed_site_identity' );
add_action( 'init', 'cds_seed_site_identity', 5 );

/**
 * If Core has no Site Logo, use the kit mark shipped in the theme.
 *
 * @param string $html  Block HTML.
 * @return string
 */
function cds_render_site_logo_fallback( $html ) {
	if ( is_string( $html ) && preg_match( '/<img\s/i', $html ) ) {
		return $html;
	}

	$defaults = cds_brand_defaults();
	$rel      = $defaults && ! empty( $defaults['mark'] ) ? $defaults['mark'] : 'assets/mark.svg';
	$path     = get_theme_file_path( $rel );
	if ( ! is_readable( $path ) ) {
		return $html;
	}

	$url  = get_theme_file_uri( $rel );
	$name = get_bloginfo( 'name' );
	return sprintf(
		'<div class="wp-block-site-logo"><a href="%s" class="custom-logo-link" rel="home"><img src="%s" class="custom-logo" alt="%s" /></a></div>',
		esc_url( home_url( '/' ) ),
		esc_url( $url ),
		esc_attr( $name )
	);
}
add_filter( 'render_block_core/site-logo', 'cds_render_site_logo_fallback' );

/**
 * Recipe category + button / Group styles.
 */
function cds_register_block_styles() {
	register_block_pattern_category(
		'cds',
		array( 'label' => __( 'CDS sections', 'cds' ) )
	);

	$buttons = array(
		'cds-secondary' => __( 'Secondary', 'cds' ),
		'cds-outline'   => __( 'Outline', 'cds' ),
		'cds-accent'    => __( 'Accent', 'cds' ),
		'cds-ghost'     => __( 'Ghost', 'cds' ),
	);
	foreach ( $buttons as $name => $label ) {
		register_block_style(
			'core/button',
			array(
				'name'  => $name,
				'label' => $label,
			)
		);
	}

	$groups = array(
		'cds-surface' => __( 'Surface', 'cds' ),
		'cds-tint'    => __( 'Tint', 'cds' ),
		'cds-panel'   => __( 'Panel', 'cds' ),
		'cds-dark'    => __( 'Dark', 'cds' ),
	);
	foreach ( $groups as $name => $label ) {
		register_block_style(
			'core/group',
			array(
				'name'  => $name,
				'label' => $label,
			)
		);
	}

	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'cds-pill',
			'label' => __( 'Pill', 'cds' ),
		)
	);

	register_block_style(
		'core/columns',
		array(
			'name'  => 'cds-split',
			'label' => __( 'Split', 'cds' ),
		)
	);
}
add_action( 'init', 'cds_register_block_styles', 5 );

/**
 * Feed design-tokens.json to the unpublished / MU-plugin registry.
 */
function cds_register_design_tokens() {
	if ( ! function_exists( 'register_design_token' ) ) {
		return;
	}

	$path = get_theme_file_path( 'design-tokens.json' );
	if ( ! is_readable( $path ) ) {
		return;
	}

	$data = json_decode( (string) file_get_contents( $path ), true );
	if ( empty( $data['tokens'] ) || ! is_array( $data['tokens'] ) ) {
		return;
	}

	foreach ( $data['tokens'] as $token ) {
		if ( empty( $token['id'] ) || empty( $token['label'] ) || empty( $token['type'] ) ) {
			continue;
		}

		register_design_token(
			$token['id'],
			array(
				'label'   => $token['label'],
				'type'    => $token['type'],
				'default' => isset( $token['default'] ) ? $token['default'] : '',
				'scope'   => isset( $token['scope'] ) ? $token['scope'] : 'global',
			)
		);
	}
}
add_action( 'init', 'cds_register_design_tokens', 20 );

/**
 * Header Navigation is empty in the template so this fallback can own the walk.
 * Probe seed writes cds_showcase_nav. Until then, Core's page-list fallback stays.
 *
 * @param array|null $fallback Parsed fallback blocks.
 * @return array|null
 */
function cds_navigation_showcase_fallback( $fallback ) {
	$pages = get_option( 'cds_showcase_nav' );
	if ( ! is_array( $pages ) || empty( $pages ) ) {
		return $fallback;
	}

	$markup = '';
	foreach ( $pages as $item ) {
		if ( empty( $item['id'] ) || empty( $item['label'] ) ) {
			continue;
		}
		$id   = (int) $item['id'];
		$post = get_post( $id );
		if ( ! $post || 'publish' !== $post->post_status ) {
			continue;
		}
		$markup .= sprintf(
			'<!-- wp:navigation-link {"label":%s,"type":"page","id":%d,"url":%s,"kind":"post-type"} /-->' . "\n",
			wp_json_encode( $item['label'] ),
			$id,
			wp_json_encode( get_permalink( $id ) )
		);
	}

	if ( '' === $markup ) {
		return $fallback;
	}

	$parsed = parse_blocks( $markup );
	$parsed = array_values(
		array_filter(
			$parsed,
			static function ( $block ) {
				return ! empty( $block['blockName'] );
			}
		)
	);

	return $parsed;
}
add_filter( 'block_core_navigation_render_fallback', 'cds_navigation_showcase_fallback' );

