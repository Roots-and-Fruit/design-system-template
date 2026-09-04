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
	<!-- wp:columns {"verticalAlignment":"center","className":"is-style-cds-split"} -->
	<div class="wp-block-columns are-vertically-aligned-center is-style-cds-split">
		<!-- wp:column {"verticalAlignment":"center","className":"cds-copy","style":{"spacing":{"blockGap":"0"}}} -->
		<div class="wp-block-column is-vertically-aligned-center cds-copy">
			<!-- wp:paragraph {"className":"is-style-cds-pill"} -->
			<p class="is-style-cds-pill">Trusted by teams like yours</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"fontSize":"display-xl"} -->
			<h1 class="wp-block-heading has-display-xl-font-size">A system you can hand to an agent</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"body-lg"} -->
			<p class="has-body-lg-font-size">Colors, type, and a few sections. Authors compose. They do not design.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">See how it works</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->

			<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"fontSize":"meta","textColor":"ink-muted"} -->
				<p class="has-ink-muted-color has-text-color has-meta-font-size">4.9 average rating</p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"fontSize":"meta","textColor":"ink-muted"} -->
				<p class="has-ink-muted-color has-text-color has-meta-font-size">14-day guarantee</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:image {"width":"800px","height":"600px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?php echo $cds_media_hero; ?>" alt="Mountain landscape" width="800" height="600"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
