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
	wp_enqueue_style( 'cds-tokens', $base . 'tokens.css', array( 'cds-fonts' ), $version );
	wp_enqueue_style( 'cds-layouts', $base . 'layouts.css', array( 'cds-tokens' ), $version );
	wp_enqueue_style( 'cds-components', $base . 'components.css', array( 'cds-tokens' ), $version );
	wp_enqueue_style( 'cds-block-styles', $base . 'block-styles.css', array( 'cds-tokens' ), $block_ver );

	wp_register_script( 'cds-avatar', false, array(), $version, true );
	wp_enqueue_script( 'cds-avatar' );
	wp_add_inline_script(
		'cds-avatar',
		'(function(){document.querySelectorAll("img[data-cds-avatar]").forEach(function(img){var url=img.getAttribute("data-cds-avatar");if(!url)return;var probe=new Image();probe.onload=function(){img.src=url;};probe.src=url;});})();'
	);
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

	// Paint only. Copy / Switcher / Sidebar and the other layout jobs are
	// classes + the editor "How it sits" panel so a fill can sit on the same Group.
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
 * Missing Gravatars 404 instead of showing the mystery-person default.
 *
 * @param array $args Avatar data.
 * @return array
 */
function cds_avatar_default_404( $args ) {
	$args['default'] = '404';
	return $args;
}
add_filter( 'pre_get_avatar_data', 'cds_avatar_default_404' );

/**
 * Print the kit mark first. Same-origin uploads stay as-is.
 * A remote URL (Gravatar) is probed in the browser; if it loads, it replaces the mark.
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
		'src=$1' . esc_url( $mark ) . '$1 data-cds-avatar=$1' . esc_url( $remote ) . '$1',
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

