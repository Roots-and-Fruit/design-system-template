<?php
/**
 * Title: Dark band
 * Slug: cds/dark-band
 * Categories: cds
 * Description: Callout strip. Not a full page. One accent button max.
 * Viewport Width: 960
 */
?>
<!-- wp:group {"align":"full","className":"is-style-cds-dark","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-7","bottom":"var:preset|spacing|space-7"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignfull is-style-cds-dark" style="padding-top:var(--wp--preset--spacing--space-7);padding-bottom:var(--wp--preset--spacing--space-7)">
	<!-- wp:paragraph {"fontSize":"meta","textColor":"accent-soft"} -->
	<p class="has-accent-soft-color has-text-color has-meta-font-size">Note</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"fontSize":"display-md"} -->
	<h2 class="wp-block-heading has-display-md-font-size">One callout is enough</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>Use this strip once per view. Title stays on-dark. Do not turn accent into a second theme.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons -->
	<div class="wp-block-buttons">
		<!-- wp:button {"className":"is-style-cds-accent"} -->
		<div class="wp-block-button is-style-cds-accent"><a class="wp-block-button__link wp-element-button">Act now</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
