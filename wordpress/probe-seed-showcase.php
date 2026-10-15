<?php
/**
 * Probe-only: publish the showcase walk and point the header nav at it.
 * Keep /cds-catalog/ /cds-blank/ /cds-allowlist/ /cds-layout/ /kit-parts/ published but unlisted.
 *
 * studio wp --path "C:\Users\reach\Studio\rf-static-probe" eval-file this-file
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cds_permalinks = (string) get_option( 'permalink_structure' );
if ( '/%postname%/' !== $cds_permalinks ) {
	$shown   = '' === $cds_permalinks ? '(plain)' : $cds_permalinks;
	$message = "Permalink structure is {$shown}. Set it to /%postname%/ and flush rewrites, then seed again.";
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::error( $message );
	}
	fwrite( STDERR, $message . PHP_EOL );
	exit( 1 );
}

if ( method_exists( wp_get_theme(), 'delete_pattern_cache' ) ) {
	wp_get_theme()->delete_pattern_cache();
}

/**
 * Showcase HTML uses %%CDS_THEME%%. Point it at this theme's folder.
 *
 * @param string $content Block HTML.
 * @return string
 */
function cds_probe_localize_theme_urls( $content ) {
	$path = wp_parse_url( get_stylesheet_directory_uri(), PHP_URL_PATH );
	if ( ! is_string( $path ) || '' === $path ) {
		return $content;
	}
	return str_replace( '%%CDS_THEME%%', untrailingslashit( $path ), $content );
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
		'post_content' => cds_probe_localize_theme_urls( $content ),
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
 * Attachment for a theme media file. Reused across seeds.
 *
 * @param string $filename File under assets/media.
 * @return int
 */
function cds_probe_theme_image( $filename ) {
	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => 1,
			'meta_key'       => '_cds_theme_media',
			'meta_value'     => $filename,
		)
	);
	if ( $existing ) {
		return (int) $existing[0]->ID;
	}
	$path = get_theme_file_path( 'assets/media/' . $filename );
	if ( ! is_readable( $path ) ) {
		fwrite( STDERR, "Missing theme image {$filename}\n" );
		return 0;
	}
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	$bits = wp_upload_bits( $filename, null, file_get_contents( $path ) );
	if ( ! empty( $bits['error'] ) ) {
		fwrite( STDERR, $bits['error'] . PHP_EOL );
		return 0;
	}
	$filetype = wp_check_filetype( $filename );
	$id       = wp_insert_attachment(
		array(
			'post_mime_type' => $filetype['type'],
			'post_title'     => sanitize_file_name( pathinfo( $filename, PATHINFO_FILENAME ) ),
			'post_status'    => 'inherit',
		),
		$bits['file']
	);
	if ( is_wp_error( $id ) ) {
		fwrite( STDERR, $id->get_error_message() . PHP_EOL );
		return 0;
	}
	wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $bits['file'] ) );
	update_post_meta( $id, '_cds_theme_media', $filename );
	return (int) $id;
}

function cds_probe_term( $name ) {
	$term = term_exists( $name, 'category' );
	if ( ! $term ) {
		$created = wp_insert_term( $name, 'category' );
		if ( is_wp_error( $created ) ) {
			fwrite( STDERR, $created->get_error_message() . PHP_EOL );
			exit( 1 );
		}
		return (int) $created['term_id'];
	}
	return (int) ( is_array( $term ) ? $term['term_id'] : $term );
}

/**
 * Publish or update a probe post.
 *
 * @param string $slug     Post slug.
 * @param string $title    Title.
 * @param string $excerpt  Excerpt. Must not match the first body paragraph.
 * @param string $content  Block HTML.
 * @param int    $term_id  Category term ID.
 * @param string $image    Theme media filename, or empty to clear the thumbnail.
 * @param string $date     Local post date, or empty to leave it.
 * @return int
 */
function cds_probe_put_post( $slug, $title, $excerpt, $content, $term_id, $image = '', $date = '' ) {
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
		'post_content' => cds_probe_localize_theme_urls( $content ),
		'post_author'  => 1,
	);
	if ( $date ) {
		$payload['post_date']     = $date;
		$payload['post_date_gmt'] = get_gmt_from_date( $date );
	}
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
	if ( $image ) {
		$thumb = cds_probe_theme_image( $image );
		if ( $thumb ) {
			set_post_thumbnail( (int) $id, $thumb );
		}
	} else {
		delete_post_thumbnail( (int) $id );
	}
	return (int) $id;
}

$dir = __DIR__ . '/showcase';
$section_slugs = array(
	'cds/hero',
	'cds/proof',
	'cds/card-grid',
	'cds/split',
	'cds/quote',
	'cds/quote-portrait',
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
		'nav'      => false,
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
		'post_content' => cds_probe_localize_theme_urls( $content ),
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

	if ( ! array_key_exists( 'nav', $spec ) || $spec['nav'] ) {
		$nav_ids[ $spec['slug'] ] = (int) $id;
	}

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
	$essay_term_id,
	'card-3.jpg',
	'2026-03-20 09:00:00'
);
echo 'sample-essay id=' . $sample_id . ' url=' . get_permalink( $sample_id ) . PHP_EOL;

$note_shot = esc_url( get_theme_file_uri( 'assets/media/shot-offer.jpg' ) );
$note_body = <<<HTML
<!-- wp:paragraph -->
<p>Say what the work is, who it is for, and what they leave with. The title and the excerpt stay in the template. The body is the offer itself, written so someone who missed the call can still use it.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Name the person, the work, and the thing they hold at the end. One paragraph is enough for the promise. The rest of the page shows the pieces that make the promise checkable.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">What they said</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A quote here is from the buyer, not from the author. It sits on the measure, under the claim it supports.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"tagName":"figure","className":"cds-quote","layout":{"type":"default"}} -->
<figure class="wp-block-group cds-quote">
	<!-- wp:quote -->
	<blockquote class="wp-block-quote"><!-- wp:paragraph -->
	<p>We knew the price, the person, and what we would have on Friday.</p>
	<!-- /wp:paragraph --></blockquote>
	<!-- /wp:quote -->

	<!-- wp:group {"tagName":"figcaption","className":"cds-quote__who","layout":{"type":"default"}} -->
	<figcaption class="wp-block-group cds-quote__who">
		<!-- wp:group {"className":"cds-quote__id","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-quote__id">
			<!-- wp:paragraph {"className":"cds-quote__name"} -->
			<p class="cds-quote__name">A store owner</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"cds-quote__role"} -->
			<p class="cds-quote__role">Retail</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</figcaption>
	<!-- /wp:group -->
</figure>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p>The citation under that is the note from the call. It is a source. It does not get a portrait.</p>
<!-- /wp:paragraph -->

<!-- wp:quote {"className":"cds-cite"} -->
<blockquote class="wp-block-quote cds-cite"><!-- wp:paragraph -->
<p>Price named on the call. Delivery is one page and one file. No second workshop.</p>
<!-- /wp:paragraph --><cite>Call notes, 2 April 2026</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:group {"className":"cds-takeaways","layout":{"type":"default"}} -->
<div class="wp-block-group cds-takeaways">
	<!-- wp:heading {"level":3,"className":"cds-takeaways__title"} -->
	<h3 class="wp-block-heading cds-takeaways__title">How to write it</h3>
	<!-- /wp:heading -->

	<!-- wp:list {"ordered":true} -->
	<ol class="wp-block-list"><!-- wp:list-item -->
	<li>Name the person in the first sentence.</li>
	<!-- /wp:list-item -->

	<!-- wp:list-item -->
	<li>Name the work in the second.</li>
	<!-- /wp:list-item -->

	<!-- wp:list-item -->
	<li>Name what they leave with, and stop.</li>
	<!-- /wp:list-item --></ol>
	<!-- /wp:list -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph -->
<p>The screenshot is Wide. The words around it stay on the measure. Wide is wider than this column and stops before the rail.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"align":"wide","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image alignwide"><img src="{$note_shot}" alt="An offer card with a price and one button"/><figcaption class="wp-element-caption">The offer as a card. One price, one button.</figcaption></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">In, and out</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The table is Wide for the same reason. Three columns of short words still need a row that does not wrap into a stack.</p>
<!-- /wp:paragraph -->

<!-- wp:table {"align":"wide"} -->
<figure class="wp-block-table alignwide"><table><thead><tr><th></th><th>In the offer</th><th>Left out</th></tr></thead><tbody><tr><td>Person</td><td>The store owner</td><td>A general audience</td></tr><tr><td>Work</td><td>One page</td><td>A second workshop</td></tr><tr><td>Leaves with</td><td>The page and the file</td><td>A slide deck</td></tr><tr><td>Price</td><td>Named once</td><td>A range</td></tr></tbody></table></figure>
<!-- /wp:table -->
HTML;
$note_id = cds_probe_put_post(
	'named-offer',
	'A named offer, written down',
	'The offer, in one paragraph, for someone who was not on the call.',
	$note_body,
	cds_probe_term( 'Notes' ),
	'card-1.jpg',
	'2026-04-17 09:00:00'
);

$proof_body = <<<'HTML'
<!-- wp:paragraph -->
<p>The metric sits on the page. It is not a slide in a deck. The title and the excerpt stay in the template. This page is the figure, the source, and the way to check it.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Eighteen is the number. Six is the set it came from. Four is how many of those six a reader can verify without another tool.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">The figure</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The infographic is Wide. The three counts are the same numbers as the table under it. Read the figure first, then the rows.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"align":"wide","className":"cds-surface cds-surface--dark","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide cds-surface cds-surface--dark">
	<!-- wp:group {"className":"cds-stats","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-stats" style="grid-template-columns:repeat(3, minmax(0, 1fr))">
		<!-- wp:group {"className":"cds-stat","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-stat">
			<!-- wp:paragraph {"className":"cds-stat__value"} -->
			<p class="cds-stat__value">18</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"cds-meta"} -->
			<p class="cds-meta">Pages in the set</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<!-- wp:group {"className":"cds-stat","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-stat">
			<!-- wp:paragraph {"className":"cds-stat__value"} -->
			<p class="cds-stat__value">6</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"cds-meta"} -->
			<p class="cds-meta">You can open</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<!-- wp:group {"className":"cds-stat","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-stat">
			<!-- wp:paragraph {"className":"cds-stat__value"} -->
			<p class="cds-stat__value">4</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"cds-meta"} -->
			<p class="cds-meta">With a source</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:quote {"className":"cds-cite"} -->
<blockquote class="wp-block-quote cds-cite"><!-- wp:paragraph -->
<p>Counted on 2 April. The six are the pages already published. The four are the ones with a source line.</p>
<!-- /wp:paragraph --><cite>Count sheet, 2 April 2026</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">The rows</h2>
<!-- /wp:heading -->

<!-- wp:table {"align":"wide"} -->
<figure class="wp-block-table alignwide"><table><thead><tr><th>Count</th><th>What it is</th><th>How to check</th></tr></thead><tbody><tr><td>18</td><td>Pages in the set</td><td>The archive</td></tr><tr><td>6</td><td>Pages you can open</td><td>Each one has a link</td></tr><tr><td>4</td><td>Pages with a source line</td><td>Look under the quote</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:group {"className":"cds-takeaways","layout":{"type":"default"}} -->
<div class="wp-block-group cds-takeaways">
	<!-- wp:heading {"level":3,"className":"cds-takeaways__title"} -->
	<h3 class="wp-block-heading cds-takeaways__title">Check it in order</h3>
	<!-- /wp:heading -->

	<!-- wp:list {"ordered":true} -->
	<ol class="wp-block-list"><!-- wp:list-item -->
	<li>Open the archive and count the pages.</li>
	<!-- /wp:list-item -->

	<!-- wp:list-item -->
	<li>Open the six that link through.</li>
	<!-- /wp:list-item -->

	<!-- wp:list-item -->
	<li>Mark the four that name a source under the quote.</li>
	<!-- /wp:list-item --></ol>
	<!-- /wp:list -->
</div>
<!-- /wp:group -->

<!-- wp:group {"tagName":"figure","className":"cds-quote","layout":{"type":"default"}} -->
<figure class="wp-block-group cds-quote">
	<!-- wp:quote -->
	<blockquote class="wp-block-quote"><!-- wp:paragraph -->
	<p>If the number is not on the page, it is not a number we can use.</p>
	<!-- /wp:paragraph --></blockquote>
	<!-- /wp:quote -->

	<!-- wp:group {"tagName":"figcaption","className":"cds-quote__who","layout":{"type":"default"}} -->
	<figcaption class="wp-block-group cds-quote__who">
		<!-- wp:html -->
		<span class="cds-avatar cds-quote__avatar" role="img" aria-label="Alex Kim">AK</span>
		<!-- /wp:html -->
		<!-- wp:group {"className":"cds-quote__id","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-quote__id">
			<!-- wp:paragraph {"className":"cds-quote__name"} -->
			<p class="cds-quote__name">Alex Kim</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"cds-quote__role"} -->
			<p class="cds-quote__role">Proof</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</figcaption>
	<!-- /wp:group -->
</figure>
<!-- /wp:group -->
HTML;
$proof_id = cds_probe_put_post(
	'number-check',
	'A number you can check',
	'The figure, and the note that says where it came from.',
	$proof_body,
	cds_probe_term( 'Proof' ),
	'card-2.jpg',
	'2026-04-02 09:00:00'
);

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

$blank = <<<'HTML'
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Blank Core</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This page is a blank Core heading, a long paragraph, and the default button. No section recipe. The paragraph has to be long enough to reach the reading measure so a fresh site can prove the compiler's block defaults: display type on the heading, body type on the copy, and a primary pill button. It stays on the page template so the post title and the paragraph share a left edge.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
	<!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Continue</a></div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
HTML;

$blank_id = cds_probe_put_page( 'cds-blank', 'Blank', $blank );
echo 'cds-blank id=' . $blank_id . ' url=' . get_permalink( $blank_id ) . PHP_EOL;

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

$studio_pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( 'cds/layout-studio' );
if ( ! $studio_pattern || empty( $studio_pattern['content'] ) ) {
	fwrite( STDERR, "cds/layout-studio is not registered.\n" );
	exit( 1 );
}
$studio_id = cds_probe_put_page( 'studio', 'Studio', $studio_pattern['content'] );
update_post_meta( $studio_id, '_wp_page_template', 'page-canvas' );
echo 'studio id=' . $studio_id . ' url=' . get_permalink( $studio_id ) . PHP_EOL;

$shop_pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( 'cds/layout-shop' );
if ( ! $shop_pattern || empty( $shop_pattern['content'] ) ) {
	fwrite( STDERR, "cds/layout-shop is not registered.\n" );
	exit( 1 );
}
$shop_id = cds_probe_put_page( 'shop', 'Shop', $shop_pattern['content'] );
update_post_meta( $shop_id, '_wp_page_template', 'page-canvas' );
echo 'shop id=' . $shop_id . ' url=' . get_permalink( $shop_id ) . PHP_EOL;

$stories_pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( 'cds/layout-stories' );
if ( ! $stories_pattern || empty( $stories_pattern['content'] ) ) {
	fwrite( STDERR, "cds/layout-stories is not registered.\n" );
	exit( 1 );
}
$stories_id = cds_probe_put_page( 'stories', 'Stories', $stories_pattern['content'] );
update_post_meta( $stories_id, '_wp_page_template', 'page-canvas' );
echo 'stories id=' . $stories_id . ' url=' . get_permalink( $stories_id ) . PHP_EOL;

$example_pages = array(
	array( 'case-study', 'Case study', 'cds/layout-case' ),
	array( 'show', 'Show', 'cds/layout-show' ),
	array( 'download', 'Download', 'cds/layout-download' ),
);
$example_ids = array();
foreach ( $example_pages as $example ) {
	$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( $example[2] );
	if ( ! $pattern || empty( $pattern['content'] ) ) {
		fwrite( STDERR, $example[2] . " is not registered.\n" );
		exit( 1 );
	}
	$example_id = cds_probe_put_page( $example[0], $example[1], $pattern['content'] );
	update_post_meta( $example_id, '_wp_page_template', 'page-canvas' );
	$example_ids[ $example[0] ] = $example_id;
	echo $example[0] . ' id=' . $example_id . ' url=' . get_permalink( $example_id ) . PHP_EOL;
}

$parts = WP_Block_Patterns_Registry::get_instance()->get_registered( 'cds/parts' );
if ( $parts && ! empty( $parts['content'] ) ) {
	$kid = cds_probe_put_page( 'kit-parts', 'Kit parts', $parts['content'] );
	echo 'kit-parts id=' . $kid . ' url=' . get_permalink( $kid ) . PHP_EOL;
} else {
	fwrite( STDERR, "cds/parts is not registered.\n" );
	exit( 1 );
}

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
				'label' => get_the_title( $studio_id ),
				'id'    => $studio_id,
			),
			array(
				'label' => get_the_title( $shop_id ),
				'id'    => $shop_id,
			),
			array(
				'label' => get_the_title( $stories_id ),
				'id'    => $stories_id,
			),
			array(
				'label' => get_the_title( $example_ids['case-study'] ),
				'id'    => $example_ids['case-study'],
			),
			array(
				'label' => get_the_title( $example_ids['show'] ),
				'id'    => $example_ids['show'],
			),
			array(
				'label' => get_the_title( $example_ids['download'] ),
				'id'    => $example_ids['download'],
			),
			array(
				'label'    => get_the_title( $articles_id ),
				'id'       => $articles_id,
				'children' => array(
					array(
						'label' => get_the_title( $note_id ),
						'id'    => $note_id,
					),
					array(
						'label' => get_the_title( $proof_id ),
						'id'    => $proof_id,
					),
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
