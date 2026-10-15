<?php
/**
 * Title: Article
 * Slug: cds/article
 * Categories: cds
 * Description: Measured prose and one CTA. Post title, excerpt, and takeaways live in the template.
 * Block Types: core/post-content
 * Post Types: post
 * Viewport Width: 720
 */
$cds_shot_reading = esc_url( get_theme_file_uri( 'assets/media/shot-reading.jpg' ) );
?>
<!-- wp:paragraph -->
<p>Body copy uses the measured column. Authors compose from presets. They do not pick a new hex or a new type size.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Keep the article on paper. One primary action at the end is enough.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">What this piece is doing</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The walk still teaches the system. This page is a site shell: a title the template owns, a rail that is not the marketing Sidebar group, and a body that does not repeat the excerpt.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Scroll past the opening. The takeaways card should stay in view on a wide screen. On a narrow screen it stacks under the essay, content first.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Do not put a featured image in this layout. Featured media is for sharing cards, not a second hero. The kit Frame style is for photos inside the essay, when an author actually inserts one.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Two-up marketing still uses Switcher. This template is not that job. A Query Loop list is not this job either. One frame, one complementary rail, Core blocks only.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>If a fork needs per-post takeaways, bind the list later. The theme does not grow a custom field UI in this pass. The rail has to exist as a shell first or the archive has nowhere to land.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>More room to scroll. Sticky is not a screenshot. It is a bounding box after a scroll, and it has to stay on screen without JavaScript.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Last movement on the page is a CTA panel, not a full-bleed wash. Section gap still sits between that card and the footer.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Quotes stay with the paragraph</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A quote is a sentence from a person. It sits on the same measure as the paragraph above it. The name and the role go under the words.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"tagName":"figure","className":"cds-quote","layout":{"type":"default"}} -->
<figure class="wp-block-group cds-quote">
	<!-- wp:quote -->
	<blockquote class="wp-block-quote"><!-- wp:paragraph -->
	<p>The work moved in the weeks between the calls.</p>
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

<!-- wp:paragraph -->
<p>A citation is a source. Leave the portrait out. The line under the words names the document.</p>
<!-- /wp:paragraph -->

<!-- wp:quote {"className":"cds-cite"} -->
<blockquote class="wp-block-quote cds-cite"><!-- wp:paragraph -->
<p>Leave the photo out when the source is a document. The line under the words is enough.</p>
<!-- /wp:paragraph --><cite>Example Brand field notes, May 2026</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">A list, then a wider figure</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Numbered steps stay on the measure. A screenshot and a table need the type inside them to stay readable, so they use Wide. Wide is one step past the column. It stops before the rail, and it does not run to the edge of the window.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-takeaways","layout":{"type":"default"}} -->
<div class="wp-block-group cds-takeaways">
	<!-- wp:heading {"level":3,"className":"cds-takeaways__title"} -->
	<h3 class="wp-block-heading cds-takeaways__title">In this order</h3>
	<!-- /wp:heading -->

	<!-- wp:list {"ordered":true} -->
	<ol class="wp-block-list"><!-- wp:list-item -->
	<li>Write the paragraph first.</li>
	<!-- /wp:list-item -->

	<!-- wp:list-item -->
	<li>Add the quote under the claim it supports.</li>
	<!-- /wp:list-item -->

	<!-- wp:list-item -->
	<li>Set the screenshot to Wide so the type in it can be read.</li>
	<!-- /wp:list-item --></ol>
	<!-- /wp:list -->
</div>
<!-- /wp:group -->

<!-- wp:image {"align":"wide","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image alignwide"><img src="<?php echo $cds_shot_reading; ?>" alt="A reading column with a quote and a small table"/><figcaption class="wp-element-caption">The reading column. The quote stays with the text. The table is the piece that wants the extra width.</figcaption></figure>
<!-- /wp:image -->

<!-- wp:table {"align":"wide"} -->
<figure class="wp-block-table alignwide"><table><thead><tr><th>Piece</th><th>Alignment</th><th>Job</th></tr></thead><tbody><tr><td>Paragraph</td><td>Measure</td><td>The argument</td></tr><tr><td>Quote</td><td>Measure</td><td>A person, under the claim</td></tr><tr><td>Citation</td><td>Measure</td><td>A document, no portrait</td></tr><tr><td>Numbered list</td><td>Measure</td><td>Steps, in order</td></tr><tr><td>Screenshot</td><td>Wide</td><td>The picture of the thing</td></tr><tr><td>Table</td><td>Wide</td><td>Rows that need room</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:group {"className":"is-style-cds-panel cds-copy","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-cds-panel cds-copy">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Ready when you are</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>Continue opens the next page in the walk.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons -->
	<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Continue</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
