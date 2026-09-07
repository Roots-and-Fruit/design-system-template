<?php
/**
 * Title: Layout home
 * Slug: cds/layout-home
 * Categories: cds
 * Inserter: false
 * Description: Probe composition. Same jobs as a marketing home, not a ninth section.
 * Viewport Width: 960
 */
$cds_media_card_1 = esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) );
$cds_media_card_2 = esc_url( get_theme_file_uri( 'assets/media/card-2.jpg' ) );
$cds_media_card_3 = esc_url( get_theme_file_uri( 'assets/media/card-3.jpg' ) );
$cds_media_split  = esc_url( get_theme_file_uri( 'assets/media/split.jpg' ) );
?>
<!-- wp:pattern {"slug":"cds/hero"} /-->

<!-- wp:pattern {"slug":"cds/proof"} /-->

<!-- wp:group {"align":"wide","layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Popular starts</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>Three tiles. Title, one line, a picture, a link. Not a catalog of nine.</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"layout":{"type":"grid","columnCount":3}} -->
	<div class="wp-block-group">
		<!-- wp:group {"className":"is-style-cds-surface","layout":{"type":"constrained"}} -->
		<div class="wp-block-group is-style-cds-surface">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-cds-frame"} -->
			<figure class="wp-block-image size-full is-style-cds-frame"><img src="<?php echo $cds_media_card_1; ?>" alt=""/></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Locked palette</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Authors paint from semantic names. They do not pick a new hex.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-cds-outline"} -->
				<div class="wp-block-button is-style-cds-outline"><a class="wp-block-button__link wp-element-button">See tokens</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"is-style-cds-tint","layout":{"type":"constrained"}} -->
		<div class="wp-block-group is-style-cds-tint">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-cds-frame"} -->
			<figure class="wp-block-image size-full is-style-cds-frame"><img src="<?php echo $cds_media_card_2; ?>" alt=""/></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Type scale</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Display serif for titles. Body sans for reading. No third family.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-cds-outline"} -->
				<div class="wp-block-button is-style-cds-outline"><a class="wp-block-button__link wp-element-button">See type</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"is-style-cds-dark","layout":{"type":"constrained"}} -->
		<div class="wp-block-group is-style-cds-dark">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-cds-frame"} -->
			<figure class="wp-block-image size-full is-style-cds-frame"><img src="<?php echo $cds_media_card_3; ?>" alt=""/></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">One contract</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>DESIGN.md is the source of truth. Agents read it before they choose.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-cds-outline"} -->
				<div class="wp-block-button is-style-cds-outline"><a class="wp-block-button__link wp-element-button">Read it</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"cds/alert"} /-->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-6"}}},"backgroundColor":"paper-deep","layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignfull has-paper-deep-background-color has-background" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:group {"className":"is-style-cds-switcher","layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-cds-switcher">
		<!-- wp:group {"className":"is-style-cds-copy","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group is-style-cds-copy">
			<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
			<h2 class="wp-block-heading has-display-sm-font-size">Get the whole toolkit</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"body-lg"} -->
			<p class="has-body-lg-font-size">Copy plus media. The image is a placeholder. The split is the section.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-cds-outline"} -->
				<div class="wp-block-button is-style-cds-outline"><a class="wp-block-button__link wp-element-button">See what is in it</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-cds-frame"} -->
			<figure class="wp-block-image size-full is-style-cds-frame"><img src="<?php echo $cds_media_split; ?>" alt="Water and late-day light"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Why teams stay</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>Three reasons. Same card job. No fourth leftover tile.</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"layout":{"type":"grid","columnCount":3}} -->
	<div class="wp-block-group">
		<!-- wp:group {"className":"is-style-cds-surface","layout":{"type":"constrained"}} -->
		<div class="wp-block-group is-style-cds-surface">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">A team behind it</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Built and kept by people who ship the product, not a ticket queue.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"is-style-cds-surface","layout":{"type":"constrained"}} -->
		<div class="wp-block-group is-style-cds-surface">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Help that answers</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Fast replies from the same people who wrote the code.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"is-style-cds-surface","layout":{"type":"constrained"}} -->
		<div class="wp-block-group is-style-cds-surface">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">A way out</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Try it. If it is not right, the guarantee is the way out.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"cds/quote"} /-->

<!-- wp:group {"align":"wide","layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Find your starting point</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>A path chooser is three tiles.</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"layout":{"type":"grid","columnCount":3}} -->
	<div class="wp-block-group">
		<!-- wp:group {"className":"is-style-cds-surface","layout":{"type":"constrained"}} -->
		<div class="wp-block-group is-style-cds-surface">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">New here</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Browse the catalog and pick a start.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-cds-outline"} -->
				<div class="wp-block-button is-style-cds-outline"><a class="wp-block-button__link wp-element-button">Browse</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"is-style-cds-surface","layout":{"type":"constrained"}} -->
		<div class="wp-block-group is-style-cds-surface">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Not sure</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Say the job. We point at the section that does it.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-cds-outline"} -->
				<div class="wp-block-button is-style-cds-outline"><a class="wp-block-button__link wp-element-button">Ask</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"is-style-cds-surface","layout":{"type":"constrained"}} -->
		<div class="wp-block-group is-style-cds-surface">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Already in</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Open the thing you already have and keep going.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-cds-outline"} -->
				<div class="wp-block-button is-style-cds-outline"><a class="wp-block-button__link wp-element-button">Continue</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"cds/dark-band"} /-->
