<?php
/**
 * Title: Card
 * Slug: cds/card
 * Categories: cds
 * Inserter: true
 */
?>
<!-- wp:group {"tagName":"article","className":"cds-card","layout":{"type":"default"}} -->
<article class="wp-block-group cds-card">
	<!-- wp:paragraph {"className":"cds-meta"} -->
	<p class="cds-meta">Note</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
	<h3 class="wp-block-heading cds-card__title">A short note</h3>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>The pattern stays in the editor. The page reads from that same pattern.</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"tagName":"footer","className":"cds-card__foot","layout":{"type":"default"}} -->
	<footer class="wp-block-group cds-card__foot">
		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"cds-btn cds-btn--outline cds-btn--sm"} -->
			<div class="wp-block-button cds-btn cds-btn--outline cds-btn--sm"><a class="wp-block-button__link wp-element-button">Open</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</footer>
	<!-- /wp:group -->
</article>
<!-- /wp:group -->
