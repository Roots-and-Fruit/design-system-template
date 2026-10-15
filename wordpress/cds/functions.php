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
	add_theme_support( 'post-thumbnails' );
	add_editor_style(
		array(
			'assets/css/fonts.css',
			'assets/css/tokens.css',
			'assets/css/layouts.css',
			'assets/css/components.css',
			'assets/css/block-styles.css',
			'assets/css/site-chrome.css',
		)
	);
}
add_action( 'after_setup_theme', 'cds_setup' );

/**
 * Opt-in: use the featured image as the article hero wash.
 * Default is paper-deep, no photo.
 */
function cds_register_hero_featured_meta() {
	register_post_meta(
		'post',
		'cds_hero_featured',
		array(
			'type'              => 'boolean',
			'single'            => true,
			'default'           => false,
			'show_in_rest'      => true,
			'auth_callback'     => static function () {
				return current_user_can( 'edit_posts' );
			},
			'sanitize_callback' => 'rest_sanitize_boolean',
		)
	);
}
add_action( 'init', 'cds_register_hero_featured_meta' );

/**
 * Front-end kit CSS. Skip base.css — theme.json owns element styles.
 */
function cds_enqueue_styles() {
	$version = wp_get_theme()->get( 'Version' );
	$base    = get_theme_file_uri( 'assets/css/' );
	$block_css = get_theme_file_path( 'assets/css/block-styles.css' );
	$block_ver = filemtime( $block_css ) ? (string) filemtime( $block_css ) : $version;

	wp_enqueue_style( 'cds-fonts', $base . 'fonts.css', array(), $version );
	cds_enqueue_font_pair();
	$token_deps = array( 'cds-fonts' );
	if ( wp_style_is( 'cds-font-pair', 'enqueued' ) ) {
		$token_deps[] = 'cds-font-pair';
	}
	wp_enqueue_style( 'cds-tokens', $base . 'tokens.css', $token_deps, $version );
	wp_enqueue_style( 'cds-layouts', $base . 'layouts.css', array( 'cds-tokens' ), $version );
	wp_enqueue_style( 'cds-components', $base . 'components.css', array( 'cds-tokens' ), $version );
	wp_enqueue_style( 'cds-block-styles', $base . 'block-styles.css', array( 'cds-tokens' ), $block_ver );
	$chrome_css = get_theme_file_path( 'assets/css/site-chrome.css' );
	$chrome_ver = filemtime( $chrome_css ) ? (string) filemtime( $chrome_css ) : $version;
	wp_enqueue_style( 'cds-site-chrome', $base . 'site-chrome.css', array( 'cds-block-styles' ), $chrome_ver );

	$widgets = get_theme_file_path( 'assets/js/kit-widgets.js' );
	if ( file_exists( $widgets ) ) {
		wp_enqueue_script(
			'cds-kit-widgets',
			get_theme_file_uri( 'assets/js/kit-widgets.js' ),
			array(),
			(string) filemtime( $widgets ),
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'cds_enqueue_styles' );
add_action( 'enqueue_block_assets', 'cds_enqueue_font_pair' );

/**
 * Compare font stacks without quote or whitespace differences.
 *
 * @param string $stack CSS font-family list.
 * @return string
 */
function cds_font_stack_key( $stack ) {
	$stack = strtolower( html_entity_decode( (string) $stack, ENT_QUOTES ) );
	$stack = str_replace( array( '"', "'", '\\' ), '', $stack );
	$stack = preg_replace( '/\s+/', ' ', $stack );
	return trim( $stack );
}

/**
 * Resolved fontFamily for a role slug, preferring the user origin.
 *
 * @param array  $raw  Merged theme.json.
 * @param string $slug display, body, or mono.
 * @return string
 */
function cds_font_family_value( $raw, $slug ) {
	$families = $raw['settings']['typography']['fontFamilies'] ?? array();
	$lists    = array();
	if ( isset( $families['custom'] ) || isset( $families['theme'] ) || isset( $families['default'] ) ) {
		foreach ( array( 'custom', 'theme', 'default' ) as $origin ) {
			if ( ! empty( $families[ $origin ] ) && is_array( $families[ $origin ] ) ) {
				$lists[] = $families[ $origin ];
			}
		}
	} elseif ( is_array( $families ) ) {
		$lists[] = $families;
	}

	foreach ( $lists as $list ) {
		foreach ( $list as $family ) {
			if ( ! is_array( $family ) ) {
				continue;
			}
			if ( ( $family['slug'] ?? '' ) === $slug && ! empty( $family['fontFamily'] ) ) {
				return (string) $family['fontFamily'];
			}
		}
	}
	return '';
}

/**
 * Fontshare pair whose display and body stacks match the merged theme.
 *
 * @return array<string,mixed>|null
 */
function cds_active_font_pair() {
	static $resolved = false;
	static $pair     = null;
	if ( $resolved ) {
		return $pair;
	}
	$resolved = true;

	$path = get_theme_file_path( 'font-pairs.json' );
	if ( ! is_readable( $path ) || ! class_exists( 'WP_Theme_JSON_Resolver' ) ) {
		return null;
	}
	$data = json_decode( (string) file_get_contents( $path ), true );
	if ( empty( $data['pairs'] ) || ! is_array( $data['pairs'] ) ) {
		return null;
	}

	$raw     = WP_Theme_JSON_Resolver::get_merged_data()->get_raw_data();
	$display = cds_font_stack_key( cds_font_family_value( $raw, 'display' ) );
	$body    = cds_font_stack_key( cds_font_family_value( $raw, 'body' ) );
	if ( '' === $display || '' === $body ) {
		return null;
	}

	foreach ( $data['pairs'] as $candidate ) {
		if ( empty( $candidate['cssUrl'] ) || empty( $candidate['display'] ) || empty( $candidate['body'] ) ) {
			continue;
		}
		if (
			cds_font_stack_key( $candidate['display'] ) === $display &&
			cds_font_stack_key( $candidate['body'] ) === $body
		) {
			$pair = $candidate;
			return $pair;
		}
	}
	return null;
}

/**
 * Load the active Fontshare pair. No-op for the default brand faces.
 */
function cds_enqueue_font_pair() {
	$pair = cds_active_font_pair();
	if ( ! $pair ) {
		return;
	}
	wp_enqueue_style( 'cds-font-pair', $pair['cssUrl'], array(), null );
}

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
	$defaults = cds_brand_defaults();
	$label    = ( $defaults && '' !== $defaults['name'] )
		? sprintf(
			/* translators: %s: brand name from brand-defaults.json. */
			__( '%s sections', 'cds' ),
			$defaults['name']
		)
		: __( 'CDS sections', 'cds' );

	register_block_pattern_category(
		'cds',
		array( 'label' => $label )
	);

	// Paint styles (surface, tint, panel, dark, and the button variants) live in
	// styles/block/*.json. Do not register those slugs here. WordPress would add
	// a second class (is-style-…--2) and the paint would miss.

	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'cds-pill',
			'label' => __( 'Pill', 'cds' ),
		)
	);

	register_block_style(
		'core/image',
		array(
			'name'  => 'cds-frame',
			'label' => __( 'Frame', 'cds' ),
		)
	);

	register_block_style(
		'core/image',
		array(
			'name'  => 'cds-original',
			'label' => __( 'Original', 'cds' ),
		)
	);
}
add_action( 'init', 'cds_register_block_styles', 5 );

/**
 * New pages start with the page hero. Existing pages are unchanged.
 *
 * @param string  $content Default post content.
 * @param WP_Post $post    Post being created.
 */
function cds_default_page_content( $content, $post ) {
	if ( ! $post instanceof WP_Post || 'page' !== $post->post_type ) {
		return $content;
	}
	if ( '' !== trim( (string) $content ) ) {
		return $content;
	}
	$path = get_theme_file_path( 'patterns/page-hero.php' );
	if ( ! is_readable( $path ) ) {
		return $content;
	}
	$markup = strstr( (string) file_get_contents( $path ), '<!--' );
	return is_string( $markup ) ? trim( $markup ) : $content;
}
add_filter( 'default_content', 'cds_default_page_content', 10, 2 );

/**
 * Editor: pick Copy / Switcher / … without using a block style slot.
 */
function cds_enqueue_editor_assets() {
	$path    = get_theme_file_path( 'assets/js/group-layout.js' );
	$version = filemtime( $path ) ? (string) filemtime( $path ) : wp_get_theme()->get( 'Version' );
	wp_enqueue_script(
		'cds-group-layout',
		get_theme_file_uri( 'assets/js/group-layout.js' ),
		array(
			'wp-hooks',
			'wp-element',
			'wp-block-editor',
			'wp-components',
			'wp-i18n',
		),
		$version,
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'cds_enqueue_editor_assets' );

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
 * One showcase nav node as a Core navigation-link or navigation-submenu.
 *
 * @param array $item { id, label, children?: array }.
 * @return string Block markup, or empty if the target is missing.
 */
function cds_navigation_item_markup( $item ) {
	if ( empty( $item['id'] ) || empty( $item['label'] ) ) {
		return '';
	}
	$id   = (int) $item['id'];
	$post = get_post( $id );
	if ( ! $post || 'publish' !== $post->post_status ) {
		return '';
	}
	$type = get_post_type( $id );
	if ( ! in_array( $type, array( 'page', 'post' ), true ) ) {
		return '';
	}

	$attrs = wp_json_encode(
		array(
			'label' => $item['label'],
			'type'  => $type,
			'id'    => $id,
			'url'   => get_permalink( $id ),
			'kind'  => 'post-type',
		)
	);

	$inner = '';
	if ( ! empty( $item['children'] ) && is_array( $item['children'] ) ) {
		foreach ( $item['children'] as $child ) {
			$inner .= cds_navigation_item_markup( $child );
		}
	}

	if ( '' !== $inner ) {
		return sprintf(
			"<!-- wp:navigation-submenu %s -->\n%s<!-- /wp:navigation-submenu -->\n",
			$attrs,
			$inner
		);
	}

	return sprintf( "<!-- wp:navigation-link %s /-->\n", $attrs );
}

/**
 * Header Navigation is empty in the template so this fallback can own the walk.
 * Probe seed writes cds_showcase_nav (nested). Until then, Core's page-list fallback stays.
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
		$markup .= cds_navigation_item_markup( $item );
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

/**
 * A same-origin profile photo stays. A remote avatar (Gravatar) is swapped
 * for the kit mark so the page does not request it.
 *
 * @param string $avatar      HTML img.
 * @param mixed  $id_or_email Unused.
 * @param int    $size        Unused.
 * @param string $default     Unused.
 * @param string $alt         Unused.
 * @param array  $args        Avatar args; url is the resolved src.
 * @return string
 */
function cds_avatar_placeholder_html( $avatar, $id_or_email, $size, $default, $alt, $args ) {
	unset( $id_or_email, $size, $default, $alt );
	if ( ! is_string( $avatar ) || ! str_contains( $avatar, '<img' ) ) {
		return $avatar;
	}
	$mark   = get_theme_file_uri( 'assets/mark.svg' );
	$remote = isset( $args['url'] ) ? (string) $args['url'] : '';
	if ( $remote === '' || str_contains( $remote, $mark ) ) {
		return $avatar;
	}
	$home_host   = wp_parse_url( home_url(), PHP_URL_HOST );
	$remote_host = wp_parse_url( $remote, PHP_URL_HOST );
	if ( $home_host && $remote_host && strcasecmp( (string) $home_host, (string) $remote_host ) === 0 ) {
		return $avatar;
	}
	$avatar = preg_replace( '/\s+srcset=("|\')(.*?)\\1/i', '', $avatar );
	$avatar = preg_replace( '/\s+sizes=("|\')(.*?)\\1/i', '', $avatar );
	$avatar = preg_replace(
		'/src=("|\')(.*?)\\1/i',
		'src=$1' . esc_url( $mark ) . '$1',
		$avatar,
		1
	);
	return $avatar;
}
add_filter( 'get_avatar', 'cds_avatar_placeholder_html', 10, 6 );

/**
 * Core query-title is empty on the Posts page (`is_home()` is not an archive).
 * Use the Posts page title so the template does not hardcode "Articles".
 *
 * @param string $content Rendered block HTML.
 * @param array  $block   Parsed block.
 * @return string
 */
function cds_query_title_posts_page( $content, $block ) {
	if ( ( $block['blockName'] ?? '' ) !== 'core/query-title' ) {
		return $content;
	}
	if ( ! is_home() || is_front_page() ) {
		return $content;
	}
	$page_id = (int) get_option( 'page_for_posts' );
	if ( $page_id < 1 ) {
		return $content;
	}
	$title = get_the_title( $page_id );
	if ( $title === '' ) {
		return $content;
	}
	$level = isset( $block['attrs']['level'] ) ? (int) $block['attrs']['level'] : 1;
	if ( $level < 1 || $level > 6 ) {
		$level = 1;
	}
	$tag = 'h' . $level;
	return sprintf(
		'<%1$s class="wp-block-query-title">%2$s</%1$s>',
		$tag,
		esc_html( $title )
	);
}
add_filter( 'render_block', 'cds_query_title_posts_page', 10, 2 );

/**
 * @param int $post_id Post ID.
 * @return bool
 */
function cds_post_uses_featured_hero( $post_id ) {
	$post_id = (int) $post_id;
	if ( $post_id < 1 ) {
		return false;
	}
	if ( ! get_post_thumbnail_id( $post_id ) ) {
		return false;
	}
	return (bool) get_post_meta( $post_id, 'cds_hero_featured', true );
}

/**
 * Sidebar checkbox under Featured image: use that photo as the hero wash.
 */
function cds_hero_featured_meta_box() {
	add_meta_box(
		'cds-hero-featured',
		'Hero background',
		'cds_hero_featured_meta_box_html',
		'post',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'cds_hero_featured_meta_box' );

/**
 * @param WP_Post $post Post.
 */
function cds_hero_featured_meta_box_html( $post ) {
	wp_nonce_field( 'cds_hero_featured', 'cds_hero_featured_nonce' );
	$on = (bool) get_post_meta( $post->ID, 'cds_hero_featured', true );
	echo '<p>';
	echo '<label><input type="checkbox" name="cds_hero_featured" value="1"' . checked( $on, true, false ) . '> Use the featured image as the hero background</label>';
	echo '</p>';
	echo '<p class="description">Off is a paper wash. On needs a featured image.</p>';
}

/**
 * @param int $post_id Post ID.
 */
function cds_hero_featured_save( $post_id ) {
	if ( ! isset( $_POST['cds_hero_featured_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cds_hero_featured_nonce'] ) ), 'cds_hero_featured' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$on = ! empty( $_POST['cds_hero_featured'] );
	update_post_meta( $post_id, 'cds_hero_featured', $on );
}
add_action( 'save_post_post', 'cds_hero_featured_save' );

/**
 * When the setting is on, paint the featured image on the article hero.
 *
 * @param string $content Rendered HTML.
 * @param array  $block   Parsed block.
 * @return string
 */
function cds_article_hero_featured_background( $content, $block ) {
	if ( ( $block['blockName'] ?? '' ) !== 'core/group' ) {
		return $content;
	}
	$class = $block['attrs']['className'] ?? '';
	if ( ! str_contains( $class, 'cds-article-hero' ) ) {
		return $content;
	}
	if ( ! is_singular( 'post' ) ) {
		return $content;
	}
	$post_id = get_the_ID();
	if ( ! cds_post_uses_featured_hero( $post_id ) ) {
		return $content;
	}
	$url = get_the_post_thumbnail_url( $post_id, 'full' );
	if ( ! $url ) {
		return $content;
	}
	$content = preg_replace(
		'/class="([^"]*cds-article-hero[^"]*)"/',
		'class="$1 has-cds-featured-hero"',
		$content,
		1
	);
	$var = '--cds-hero-image:url(' . esc_url( $url ) . ')';
	if ( preg_match( '/<div[^>]*cds-article-hero[^>]*style="/', $content ) ) {
		$content = preg_replace(
			'/(<div[^>]*cds-article-hero[^>]*style=")/',
			'$1' . $var . ';',
			$content,
			1
		);
	}
	return $content;
}
add_filter( 'render_block', 'cds_article_hero_featured_background', 10, 2 );

/**
 * Forms, dialogs, and icon spans in saved patterns.
 * Admins have unfiltered HTML. This is for every other editor.
 *
 * @param array<string, array<string, bool>> $tags    Allowed tags.
 * @param string                              $context Kses context.
 * @return array<string, array<string, bool>>
 */
function cds_kses_kit_html( $tags, $context ) {
	if ( 'post' !== $context ) {
		return $tags;
	}
	$tags['form']     = array(
		'class'  => true,
		'action' => true,
		'method' => true,
	);
	$tags['label']    = array(
		'class' => true,
		'for'   => true,
	);
	$tags['input']    = array(
		'class'        => true,
		'id'           => true,
		'type'         => true,
		'name'         => true,
		'placeholder'  => true,
		'required'     => true,
		'value'        => true,
		'autocomplete' => true,
	);
	$tags['textarea'] = array(
		'class'       => true,
		'id'          => true,
		'name'        => true,
		'placeholder' => true,
		'rows'        => true,
	);
	$tags['button']   = array(
		'class' => true,
		'type'  => true,
	);
	$tags['dialog']   = array(
		'class'           => true,
		'id'              => true,
		'aria-labelledby' => true,
	);
	if ( isset( $tags['a'] ) ) {
		$tags['a']['data-cds-dialog-open'] = true;
		$tags['a']['aria-label']           = true;
	}
	if ( isset( $tags['span'] ) ) {
		$tags['span']['aria-hidden'] = true;
	}
	return $tags;
}
add_filter( 'wp_kses_allowed_html', 'cds_kses_kit_html', 10, 2 );

