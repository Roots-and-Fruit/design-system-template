<?php
/**
 * Title: Core allowlist
 * Slug: cds/allowlist
 * Inserter: false
 * Description: Specimen of allowed Core marketing blocks. Not a recipe.
 * Viewport Width: 960
 */
?>
<!-- wp:paragraph -->
<p>Allowed Core for marketing. No recipes on this page. If these blocks already look like the kit, the theme is doing its job.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Heading</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">A third-level heading</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading">A fourth-level heading</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Body paragraph on paper. Links use <a href="https://example.com/">primary</a>. Strong text stays in the same family.</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">List</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list">
	<!-- wp:list-item -->
	<li>First item in an unordered list</li>
	<!-- /wp:list-item -->
	<!-- wp:list-item -->
	<li>Second item, still on the measure</li>
	<!-- /wp:list-item -->
	<!-- wp:list-item -->
	<li>Third item</li>
	<!-- /wp:list-item -->
</ul>
<!-- /wp:list -->

<!-- wp:list {"ordered":true} -->
<ol class="wp-block-list">
	<!-- wp:list-item -->
	<li>First ordered step</li>
	<!-- /wp:list-item -->
	<!-- wp:list-item -->
	<li>Second ordered step</li>
	<!-- /wp:list-item -->
</ol>
<!-- /wp:list -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Quote</h2>
<!-- /wp:heading -->

<!-- wp:quote -->
<blockquote class="wp-block-quote">
	<!-- wp:paragraph -->
	<p>A short quote should sit on the primary rule, not on a giant pullquote.</p>
	<!-- /wp:paragraph -->
	<cite>Source</cite>
</blockquote>
<!-- /wp:quote -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Image</h2>
<!-- /wp:heading -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="/wp-content/themes/cds/assets/mark.svg" alt="Kit mark"/><figcaption class="wp-element-caption">Kit mark. Captions use muted ink.</figcaption></figure>
<!-- /wp:image -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Buttons</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Default fill, then the four kit styles.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
	<!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Primary</a></div>
	<!-- /wp:button -->
	<!-- wp:button {"className":"is-style-cds-secondary"} -->
	<div class="wp-block-button is-style-cds-secondary"><a class="wp-block-button__link wp-element-button">Secondary</a></div>
	<!-- /wp:button -->
	<!-- wp:button {"className":"is-style-cds-outline"} -->
	<div class="wp-block-button is-style-cds-outline"><a class="wp-block-button__link wp-element-button">Outline</a></div>
	<!-- /wp:button -->
	<!-- wp:button {"className":"is-style-cds-accent"} -->
	<div class="wp-block-button is-style-cds-accent"><a class="wp-block-button__link wp-element-button">Accent</a></div>
	<!-- /wp:button -->
	<!-- wp:button {"className":"is-style-cds-ghost"} -->
	<div class="wp-block-button is-style-cds-ghost"><a class="wp-block-button__link wp-element-button">Ghost</a></div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Group</h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
	<!-- wp:paragraph -->
	<p>Default group. No card chrome.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-cds-surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-cds-surface">
	<!-- wp:heading {"level":3} -->
	<h3 class="wp-block-heading">Surface</h3>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Lifted card. Rule, radius, quiet shadow.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-cds-panel","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-cds-panel">
	<!-- wp:heading {"level":3} -->
	<h3 class="wp-block-heading">Panel</h3>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Quiet grouping. No border.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-cds-dark","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-cds-dark">
	<!-- wp:heading {"level":3} -->
	<h3 class="wp-block-heading">Dark</h3>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Callout strip. Title on-dark. Body muted on-dark.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Columns</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns">
	<!-- wp:column -->
	<div class="wp-block-column">
		<!-- wp:heading {"level":3} -->
		<h3 class="wp-block-heading">Left</h3>
		<!-- /wp:heading -->
		<!-- wp:paragraph -->
		<p>Two columns share the stack gap.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
	<!-- wp:column -->
	<div class="wp-block-column">
		<!-- wp:heading {"level":3} -->
		<h3 class="wp-block-heading">Right</h3>
		<!-- /wp:heading -->
		<!-- wp:paragraph -->
		<p>Keep copy short so the rhythm stays even.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Details</h2>
<!-- /wp:heading -->

<!-- wp:details -->
<details class="wp-block-details">
	<summary>What is this row for?</summary>
	<!-- wp:paragraph -->
	<p>Disclosure. Summary is the control. The answer stays in the kit type.</p>
	<!-- /wp:paragraph -->
</details>
<!-- /wp:details -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Table</h2>
<!-- /wp:heading -->

<!-- wp:table -->
<figure class="wp-block-table">
	<table>
		<thead>
			<tr>
				<th>Role</th>
				<th>Slug</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Page wash</td>
				<td>paper</td>
			</tr>
			<tr>
				<td>Body</td>
				<td>ink</td>
			</tr>
			<tr>
				<td>Action</td>
				<td>primary</td>
			</tr>
		</tbody>
	</table>
</figure>
<!-- /wp:table -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Code</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Inline <code>primary</code> in a sentence.</p>
<!-- /wp:paragraph -->

<!-- wp:code -->
<pre class="wp-block-code"><code>npm run compile:wordpress</code></pre>
<!-- /wp:code -->

<!-- wp:preformatted -->
<pre class="wp-block-preformatted">A preformatted block.
Keeps line breaks.</pre>
<!-- /wp:preformatted -->
