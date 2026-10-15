<?php
/**
 * Title: Hero
 * Slug: cds/hero
 * Categories: cds
 * Description: Pill, display title, lede, one primary, optional proof cluster, media. Not a page.
 * Viewport Width: 960
 */
$cds_media_hero = esc_url( get_theme_file_uri( 'assets/media/hero.jpg' ) );
?>
<!-- wp:group {"align":"wide","className":"cds-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-7","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide cds-hero" style="padding-top:var(--wp--preset--spacing--space-7);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:group {"className":"is-style-cds-switcher","layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-cds-switcher">
		<!-- wp:group {"className":"is-style-cds-copy","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group is-style-cds-copy">
			<!-- wp:paragraph {"className":"is-style-cds-pill"} -->
			<p class="is-style-cds-pill">Trusted by teams like yours</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"fontSize":"display-xl"} -->
			<h1 class="wp-block-heading has-display-xl-font-size">A system you can hand to an agent</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"cds-lede","fontSize":"body-lg"} -->
			<p class="cds-lede has-body-lg-font-size">Colors, type, and a few sections. Authors compose. They do not design.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"className":"cds-cluster"} -->
			<div class="wp-block-buttons cds-cluster">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">See how it works</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->

			<!-- wp:group {"className":"is-style-cds-cluster","layout":{"type":"flex","flexWrap":"wrap"}} -->
			<div class="wp-block-group is-style-cds-cluster">
				<!-- wp:paragraph {"fontSize":"meta","textColor":"ink-muted"} -->
				<p class="has-ink-muted-color has-text-color has-meta-font-size">4.9 average rating</p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"fontSize":"meta","textColor":"ink-muted"} -->
				<p class="has-ink-muted-color has-text-color has-meta-font-size">14-day guarantee</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-cds-frame"} -->
			<figure class="wp-block-image size-full is-style-cds-frame"><img src="<?php echo $cds_media_hero; ?>" alt="Mountain landscape"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
