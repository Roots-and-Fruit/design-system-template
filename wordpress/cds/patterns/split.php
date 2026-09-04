<?php
/**
 * Title: Split
 * Slug: cds/split
 * Categories: cds
 * Description: Copy plus media. Maps the kit .cds-split primitive to core/columns.
 * Viewport Width: 960
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-6"}}},"backgroundColor":"paper-deep","layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignfull has-paper-deep-background-color has-background" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:columns {"verticalAlignment":"center","className":"is-style-cds-split"} -->
	<div class="wp-block-columns are-vertically-aligned-center is-style-cds-split">
		<!-- wp:column {"verticalAlignment":"center","className":"cds-copy","style":{"spacing":{"blockGap":"0"}}} -->
		<div class="wp-block-column is-vertically-aligned-center cds-copy">
			<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
			<h2 class="wp-block-heading has-display-sm-font-size">What the kit gives you</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"body-lg"} -->
			<p class="has-body-lg-font-size">A locked palette, a type scale, and starts for the jobs on this catalog.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">See the catalog</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img src="/wp-content/themes/cds/assets/mark.svg" alt="Kit mark"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
