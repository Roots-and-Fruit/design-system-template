<?php
/**
 * Title: Shop layout
 * Slug: cds/layout-shop
 * Categories: cds
 * Description: Cover hero, category tiles, and a product grid. A poster, not a cart.
 * Post Types: page
 * Viewport Width: 960
 */
$cds_media_hero   = esc_url( get_theme_file_uri( 'assets/media/hero.jpg' ) );
$cds_media_card_1 = esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) );
$cds_media_card_2 = esc_url( get_theme_file_uri( 'assets/media/card-2.jpg' ) );
$cds_media_card_3 = esc_url( get_theme_file_uri( 'assets/media/card-3.jpg' ) );
$cds_media_split  = esc_url( get_theme_file_uri( 'assets/media/split.jpg' ) );
$cds_media_callout = esc_url( get_theme_file_uri( 'assets/media/callout.jpg' ) );
?>
<!-- wp:group {"align":"full","className":"cds-cover","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull cds-cover">
	<!-- wp:image {"linkDestination":"none","className":"cds-cover__media"} -->
	<figure class="wp-block-image cds-cover__media"><img src="<?php echo $cds_media_hero; ?>" alt="A chair in a bright room"/></figure>
	<!-- /wp:image -->

	<!-- wp:group {"className":"cds-cover__scrim","layout":{"type":"constrained","contentSize":"60rem"}} -->
	<div class="wp-block-group cds-cover__scrim">
		<!-- wp:html -->
		<p class="cds-chip cds-chip--float"><span class="cds-icon cds-icon--truck" aria-hidden="true"></span><span><strong>Ships fast</strong><span>In two days</span></span></p>
		<!-- /wp:html -->

		<!-- wp:heading {"level":1,"fontSize":"display-xl"} -->
		<h1 class="wp-block-heading has-display-xl-font-size">Goods, set in the kit's type</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"cds-lede"} -->
		<p class="cds-lede">A poster of the shop. Prices are on the cards. There is no cart on this page.</p>
		<!-- /wp:paragraph -->

		<!-- wp:html -->
		<p class="cds-review__rating"><span class="cds-review__stars" aria-hidden="true"><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span></span> <span class="cds-review__score"><span>5</span> out of <span>5</span></span></p>
		<!-- /wp:html -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#goods">See the goods</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-7","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-7);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Shop by room</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"cds-tile-row","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-tile-row">
		<!-- wp:group {"className":"cds-cover cds-category","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-cover cds-category">
			<!-- wp:image {"linkDestination":"none","className":"cds-cover__media"} -->
			<figure class="wp-block-image cds-cover__media"><img src="<?php echo $cds_media_card_1; ?>" alt="Seating"/></figure>
			<!-- /wp:image -->

			<!-- wp:group {"className":"cds-cover__scrim","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-cover__scrim">
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading">Seating</h3>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"cds-cover cds-category","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-cover cds-category">
			<!-- wp:image {"linkDestination":"none","className":"cds-cover__media"} -->
			<figure class="wp-block-image cds-cover__media"><img src="<?php echo $cds_media_card_2; ?>" alt="Lighting"/></figure>
			<!-- /wp:image -->

			<!-- wp:group {"className":"cds-cover__scrim","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-cover__scrim">
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading">Lighting</h3>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"cds-cover cds-category","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-cover cds-category">
			<!-- wp:image {"linkDestination":"none","className":"cds-cover__media"} -->
			<figure class="wp-block-image cds-cover__media"><img src="<?php echo $cds_media_callout; ?>" alt="Textiles"/></figure>
			<!-- /wp:image -->

			<!-- wp:group {"className":"cds-cover__scrim","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-cover__scrim">
				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading">Textiles</h3>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-7"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div id="goods" class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-7)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">In the room now</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"cds-tile-row","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-tile-row">
		<!-- wp:group {"tagName":"article","className":"cds-product","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-product">
			<!-- wp:group {"className":"cds-media","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-media">
				<!-- wp:image {"linkDestination":"none","className":"cds-product__photo"} -->
				<figure class="wp-block-image cds-product__photo"><img src="<?php echo $cds_media_card_1; ?>" alt="Side chair"/></figure>
				<!-- /wp:image -->

				<!-- wp:html -->
				<span class="cds-badge">Sale</span>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Side chair</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"cds-price"} -->
			<p class="cds-price"><s>$159</s> $89</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->

		<!-- wp:group {"tagName":"article","className":"cds-product","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-product">
			<!-- wp:group {"className":"cds-media","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-media">
				<!-- wp:image {"linkDestination":"none","className":"cds-product__photo"} -->
				<figure class="wp-block-image cds-product__photo"><img src="<?php echo $cds_media_card_2; ?>" alt="Floor lamp"/></figure>
				<!-- /wp:image -->
			</div>
			<!-- /wp:group -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Floor lamp</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"cds-price"} -->
			<p class="cds-price">$120</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->

		<!-- wp:group {"tagName":"article","className":"cds-product","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-product">
			<!-- wp:group {"className":"cds-media","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-media">
				<!-- wp:image {"linkDestination":"none","className":"cds-product__photo"} -->
				<figure class="wp-block-image cds-product__photo"><img src="<?php echo $cds_media_card_3; ?>" alt="Oak stool"/></figure>
				<!-- /wp:image -->

				<!-- wp:html -->
				<span class="cds-badge">Sale</span>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Oak stool</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"cds-price"} -->
			<p class="cds-price"><s>$80</s> $64</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->

		<!-- wp:group {"tagName":"article","className":"cds-product","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-product">
			<!-- wp:group {"className":"cds-media","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-media">
				<!-- wp:image {"linkDestination":"none","className":"cds-product__photo"} -->
				<figure class="wp-block-image cds-product__photo"><img src="<?php echo $cds_media_split; ?>" alt="Wool throw"/></figure>
				<!-- /wp:image -->
			</div>
			<!-- /wp:group -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Wool throw</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"cds-price"} -->
			<p class="cds-price">$48</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","className":"is-style-cds-dark cds-copy","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-7","bottom":"var:preset|spacing|space-7"},"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignfull is-style-cds-dark cds-copy" style="padding-top:var(--wp--preset--spacing--space-7);padding-bottom:var(--wp--preset--spacing--space-7)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Need it in the room this week?</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>Write with the piece and the date. This sample does not take an order.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons -->
	<div class="wp-block-buttons">
		<!-- wp:button {"className":"is-style-cds-accent"} -->
		<div class="wp-block-button is-style-cds-accent"><a class="wp-block-button__link wp-element-button" href="/studio/#contact">Ask about a piece</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
