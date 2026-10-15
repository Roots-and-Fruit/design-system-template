<?php
/**
 * Title: Split
 * Slug: cds/split
 * Categories: cds
 * Description: Copy plus media. Maps the kit .cds-split primitive to a Switcher Group.
 * Viewport Width: 960
 */
$cds_media_mark = esc_url( get_theme_file_uri( 'assets/mark.svg' ) );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-6"}}},"backgroundColor":"paper-deep","layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignfull has-paper-deep-background-color has-background" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:group {"className":"is-style-cds-switcher","layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-cds-switcher">
		<!-- wp:group {"className":"is-style-cds-copy","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group is-style-cds-copy">
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
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-cds-original"} -->
			<figure class="wp-block-image size-full is-style-cds-original"><img src="<?php echo $cds_media_mark; ?>" alt="Kit mark"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
