<?php
/**
 * Probe-only: publish the showcase walk and point the header nav at it.
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

/**
 * Nested <!-- wp:pattern /--> refs render empty on the front. Inline them.
 *
 * @param string   $content Pattern content.
 * @param string[] $slugs   Pattern slugs to replace.
 * @return string
 */
function cds_probe_inline_patterns( $content, $slugs ) {
	foreach ( $slugs as $slug ) {
		$inner = WP_Block_Patterns_Registry::get_instance()->get_registered( $slug );
		if ( ! $inner || empty( $inner['content'] ) ) {
			continue;
		}
		$content = str_replace(
			'<!-- wp:pattern {"slug":"' . $slug . '"} /-->',
			$inner['content'],
			$content
		);
	}
	return $content;
}

/**
 * Publish or update a probe page from already-inlined HTML.
 *
 * @param string $slug    Page slug.
 * @param string $title   Page title.
 * @param string $content Block HTML.
 * @return int
 */
function cds_probe_put_page( $slug, $title, $content ) {
	$page    = get_page_by_path( $slug );
	$payload = array(
		'post_type'    => 'page',
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_status'  => 'publish',
		'post_content' => $content,
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
	return (int) $id;
}

/**
 * Publish or update a probe post.
 *
 * @param string $slug     Post slug.
 * @param string $title    Title.
 * @param string $excerpt  Excerpt (template lede). Must not match the first body paragraph.
 * @param string $content  Block HTML.
 * @param int    $term_id  Category term ID.
 * @return int
 */
function cds_probe_put_post( $slug, $title, $excerpt, $content, $term_id ) {
	$found = get_posts(
		array(
			'name'           => $slug,
			'post_type'      => 'post',
			'post_status'    => 'any',
			'posts_per_page' => 1,
		)
	);
	$payload = array(
		'post_type'    => 'post',
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_excerpt' => $excerpt,
		'post_status'  => 'publish',
		'post_content' => $content,
		'post_author'  => 1,
	);
	if ( $found ) {
		$payload['ID'] = $found[0]->ID;
		$id            = wp_update_post( $payload, true );
	} else {
		$id = wp_insert_post( $payload, true );
	}
	if ( is_wp_error( $id ) ) {
		fwrite( STDERR, $id->get_error_message() . PHP_EOL );
		exit( 1 );
	}
	if ( $term_id ) {
		wp_set_object_terms( (int) $id, array( (int) $term_id ), 'category' );
	}
	delete_post_thumbnail( (int) $id );
	return (int) $id;
}

$dir = __DIR__ . '/showcase';
$section_slugs = array(
	'cds/hero',
	'cds/proof',
	'cds/card-grid',
	'cds/split',
	'cds/quote',
	'cds/dark-band',
	'cds/cta',
	'cds/alert',
);

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
		'slug'     => 'pieces',
		'title'    => 'Pieces',
		'file'     => '',
		'pattern'  => 'cds/allowlist',
		'front'    => false,
		'template' => '',
		'order'    => 5,
	),
	array(
		'slug'     => 'sections',
		'title'    => 'Sections',
		'file'     => '',
		'pattern'  => 'cds/catalog',
		'front'    => false,
		'template' => 'page-canvas',
		'order'    => 6,
	),
	array(
		'slug'     => 'the-site',
		'title'    => 'The site',
		'file'     => '',
		'pattern'  => 'cds/layout-home',
		'front'    => false,
		'template' => 'page-canvas',
		'order'    => 7,
	),
);

$nav_ids  = array();
$front_id = 0;

foreach ( $pages as $spec ) {
	if ( ! empty( $spec['pattern'] ) ) {
		$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( $spec['pattern'] );
		if ( ! $pattern || empty( $pattern['content'] ) ) {
			fwrite( STDERR, $spec['pattern'] . " is not registered.\n" );
			exit( 1 );
		}
		$content = cds_probe_inline_patterns( $pattern['content'], $section_slugs );
		if ( 'sections' === $spec['slug'] ) {
			$content .= "\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\">\n\t<!-- wp:button {\"className\":\"is-style-cds-outline\"} -->\n\t<div class=\"wp-block-button is-style-cds-outline\"><a class=\"wp-block-button__link wp-element-button\" href=\"/the-site/\">Next: The site</a></div>\n\t<!-- /wp:button -->\n</div>\n<!-- /wp:buttons -->\n";
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

	$nav_ids[ $spec['slug'] ] = (int) $id;

	if ( ! empty( $spec['front'] ) ) {
		$front_id = (int) $id;
	}

	echo $spec['slug'] . ' id=' . (int) $id . ' url=' . get_permalink( $id ) . PHP_EOL;
}

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $front_id );

$essay_term = term_exists( 'Essay', 'category' );
if ( ! $essay_term ) {
	$created = wp_insert_term( 'Essay', 'category' );
	if ( is_wp_error( $created ) ) {
		fwrite( STDERR, $created->get_error_message() . PHP_EOL );
		exit( 1 );
	}
	$essay_term_id = (int) $created['term_id'];
} else {
	$essay_term_id = (int) $essay_term['term_id'];
}

$article = WP_Block_Patterns_Registry::get_instance()->get_registered( 'cds/article' );
if ( ! $article || empty( $article['content'] ) ) {
	fwrite( STDERR, "cds/article is not registered.\n" );
	exit( 1 );
}

$sample_excerpt = 'The template owns the title. The rail holds takeaways. Body stays on the measure.';
$sample_id      = cds_probe_put_post(
	'sample-essay',
	'A measured essay',
	$sample_excerpt,
	$article['content'],
	$essay_term_id
);
echo 'sample-essay id=' . $sample_id . ' url=' . get_permalink( $sample_id ) . PHP_EOL;

$articles_id = cds_probe_put_page( 'articles', 'Articles', '' );
update_option( 'page_for_posts', $articles_id );
echo 'articles id=' . $articles_id . ' url=' . get_permalink( $articles_id ) . ' page_for_posts=' . $articles_id . PHP_EOL;

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

$catalog = WP_Block_Patterns_Registry::get_instance()->get_registered( 'cds/catalog' );
if ( $catalog && ! empty( $catalog['content'] ) ) {
	$cid = cds_probe_put_page(
		'cds-catalog',
		'Catalog',
		cds_probe_inline_patterns( $catalog['content'], $section_slugs )
	);
	echo 'cds-catalog id=' . $cid . PHP_EOL;
}

$home = WP_Block_Patterns_Registry::get_instance()->get_registered( 'cds/layout-home' );
if ( $home && ! empty( $home['content'] ) ) {
	$lid = cds_probe_put_page(
		'cds-layout',
		'Layout',
		cds_probe_inline_patterns( $home['content'], $section_slugs )
	);
	echo 'cds-layout id=' . $lid . PHP_EOL;
}

$landing = WP_Block_Patterns_Registry::get_instance()->get_registered( 'cds/landing' );
if ( $landing && ! empty( $landing['content'] ) ) {
	$oid = cds_probe_put_page(
		'offer',
		'Offer',
		cds_probe_inline_patterns( $landing['content'], $section_slugs )
	);
	update_post_meta( $oid, '_wp_page_template', 'page-canvas' );
	echo 'offer id=' . $oid . ' url=' . get_permalink( $oid ) . PHP_EOL;
} else {
	fwrite( STDERR, "cds/landing is not registered.\n" );
	exit( 1 );
}

$pricing = WP_Block_Patterns_Registry::get_instance()->get_registered( 'cds/pricing' );
if ( $pricing && ! empty( $pricing['content'] ) ) {
	$pid = cds_probe_put_page(
		'pricing',
		'Pricing',
		cds_probe_inline_patterns( $pricing['content'], $section_slugs )
	);
	update_post_meta( $pid, '_wp_page_template', 'page-canvas' );
	echo 'pricing id=' . $pid . ' url=' . get_permalink( $pid ) . PHP_EOL;
} else {
	fwrite( STDERR, "cds/pricing is not registered.\n" );
	exit( 1 );
}

$legal_privacy = <<<'HTML'
<!-- wp:paragraph -->
<p>Specimen copy for the kit footer. A fork replaces this page with a real privacy policy. Nothing here is legal advice.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>This kit does not collect personal data. Pages you publish from a fork may. Write the policy that matches that site, then keep this slug so the footer link still lands.</p>
<!-- /wp:paragraph -->
HTML;

$legal_terms = <<<'HTML'
<!-- wp:paragraph -->
<p>Specimen copy for the kit footer. A fork replaces this page with real terms of use. Nothing here is a contract.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Keep the <code>/terms/</code> slug so the footer link still lands. Edit the copy to match the product you ship.</p>
<!-- /wp:paragraph -->
HTML;

$privacy_id = cds_probe_put_page( 'privacy', 'Privacy policy', $legal_privacy );
echo 'privacy id=' . $privacy_id . ' url=' . get_permalink( $privacy_id ) . PHP_EOL;

$terms_id = cds_probe_put_page( 'terms', 'Terms', $legal_terms );
echo 'terms id=' . $terms_id . ' url=' . get_permalink( $terms_id ) . PHP_EOL;

$nav = array();
foreach ( $pages as $spec ) {
	$slug = $spec['slug'];
	if ( empty( $nav_ids[ $slug ] ) ) {
		continue;
	}
	$item = array(
		'label' => $spec['title'],
		'id'    => $nav_ids[ $slug ],
	);
	if ( 'the-site' === $slug ) {
		$item['children'] = array(
			array(
				'label' => get_the_title( $oid ),
				'id'    => $oid,
			),
			array(
				'label' => get_the_title( $pid ),
				'id'    => $pid,
			),
			array(
				'label'    => get_the_title( $articles_id ),
				'id'       => $articles_id,
				'children' => array(
					array(
						'label' => get_the_title( $sample_id ),
						'id'    => $sample_id,
					),
				),
			),
		);
	}
	$nav[] = $item;
}
update_option( 'cds_showcase_nav', $nav );

echo 'front=' . $front_id . PHP_EOL;
echo 'nav=' . count( $nav ) . PHP_EOL;
