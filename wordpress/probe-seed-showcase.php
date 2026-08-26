<?php
/**
 * Probe-only: publish the six-page showcase walk and point the header nav at it.
 * Keep /cds-catalog/ /cds-blank/ /cds-allowlist/ /cds-layout/ published but unlisted.
 *
 * studio wp --path "C:\Users\reach\Studio\rf-static-probe" eval-file this-file
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( method_exists( wp_get_theme(), 'delete_pattern_cache' ) ) {
	wp_get_theme()->delete_pattern_cache();
}

$dir = __DIR__ . '/showcase';

$pages = array(
	array(
		'slug'     => 'start',
		'title'    => 'Start',
		'file'     => 'start.html',
		'front'    => true,
		'template' => '',
		'order'    => 1,
	),
	array(
		'slug'     => 'color',
		'title'    => 'Color',
		'file'     => 'color.html',
		'front'    => false,
		'template' => '',
		'order'    => 2,
	),
	array(
		'slug'     => 'type',
		'title'    => 'Type',
		'file'     => 'type.html',
		'front'    => false,
		'template' => '',
		'order'    => 3,
	),
	array(
		'slug'     => 'layout',
		'title'    => 'Layout',
		'file'     => 'layout.html',
		'front'    => false,
		'template' => '',
		'order'    => 4,
	),
	array(
		'slug'     => 'sections',
		'title'    => 'Sections',
		'file'     => 'sections.html',
		'front'    => false,
		'template' => '',
		'order'    => 5,
	),
	array(
		'slug'     => 'the-site',
		'title'    => 'The site',
		'file'     => '',
		'front'    => false,
		'template' => 'page-the-site',
		'order'    => 6,
	),
);

$nav = array();
$front_id = 0;

foreach ( $pages as $spec ) {
	if ( 'the-site' === $spec['slug'] ) {
		$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( 'cds/layout-home' );
		if ( ! $pattern || empty( $pattern['content'] ) ) {
			fwrite( STDERR, "cds/layout-home is not registered.\n" );
			exit( 1 );
		}
		$content = $pattern['content'];
		// Nested pattern refs go empty on the front. Inline hero + proof.
		foreach ( array( 'cds/hero', 'cds/proof', 'cds/alert', 'cds/quote', 'cds/dark-band' ) as $slug ) {
			$inner = WP_Block_Patterns_Registry::get_instance()->get_registered( $slug );
			if ( ! $inner ) {
				continue;
			}
			$content = str_replace(
				'<!-- wp:pattern {"slug":"' . $slug . '"} /-->',
				$inner['content'],
				$content
			);
		}
	} else {
		$path = $dir . '/' . $spec['file'];
		if ( ! is_readable( $path ) ) {
			fwrite( STDERR, "Missing $path\n" );
			exit( 1 );
		}
		$content = file_get_contents( $path );
	}

	$page = get_page_by_path( $spec['slug'] );
	$payload = array(
		'post_type'    => 'page',
		'post_title'   => $spec['title'],
		'post_name'    => $spec['slug'],
		'post_status'  => 'publish',
		'post_content' => $content,
		'menu_order'   => $spec['order'],
	);

	if ( $page ) {
		$payload['ID'] = $page->ID;
		$id            = wp_update_post( $payload, true );
	} else {
		$id = wp_insert_post( $payload, true );
	}

	if ( is_wp_error( $id ) ) {
		fwrite( STDERR, $id->get_error_message() . PHP_EOL );
		exit( 1 );
	}

	if ( $spec['template'] ) {
		update_post_meta( $id, '_wp_page_template', $spec['template'] );
	} else {
		delete_post_meta( $id, '_wp_page_template' );
	}

	$nav[] = array(
		'label' => $spec['title'],
		'id'    => (int) $id,
	);

	if ( ! empty( $spec['front'] ) ) {
		$front_id = (int) $id;
	}

	echo $spec['slug'] . ' id=' . (int) $id . ' url=' . get_permalink( $id ) . PHP_EOL;
}

update_option( 'cds_showcase_nav', $nav );
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $front_id );
update_option( 'page_for_posts', 0 );

$old_home = get_page_by_path( 'home' );
if ( $old_home && (int) $old_home->ID !== $front_id ) {
	wp_update_post(
		array(
			'ID'          => $old_home->ID,
			'post_status' => 'draft',
		)
	);
	echo 'old home drafted id=' . (int) $old_home->ID . PHP_EOL;
}

echo 'front=' . $front_id . PHP_EOL;
echo 'nav=' . count( $nav ) . PHP_EOL;
