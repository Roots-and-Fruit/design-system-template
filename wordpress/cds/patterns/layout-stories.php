<?php
/**
 * Title: Stories layout
 * Slug: cds/layout-stories
 * Categories: cds
 * Description: A cover, icon cards, a video, and a review reel. One still frame, not a slider.
 * Post Types: page
 * Viewport Width: 960
 */
$cds_media_hero    = esc_url( get_theme_file_uri( 'assets/media/hero.jpg' ) );
$cds_media_callout = esc_url( get_theme_file_uri( 'assets/media/callout.jpg' ) );
?>
<!-- wp:group {"align":"full","className":"cds-cover","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull cds-cover">
	<!-- wp:image {"linkDestination":"none","className":"cds-cover__media"} -->
	<figure class="wp-block-image cds-cover__media"><img src="<?php echo $cds_media_hero; ?>" alt="A landscape in late light"/></figure>
	<!-- /wp:image -->

	<!-- wp:group {"className":"cds-cover__scrim","layout":{"type":"constrained","contentSize":"60rem"}} -->
	<div class="wp-block-group cds-cover__scrim">
		<!-- wp:paragraph {"className":"is-style-cds-pill"} -->
		<p class="is-style-cds-pill">From the people who used it</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"fontSize":"display-xl"} -->
		<h1 class="wp-block-heading has-display-xl-font-size">What they said after</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"cds-lede"} -->
		<p class="cds-lede">One frame of the cover. The row below scrolls. There is no slider library.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-7","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-7);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Three things they named</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"cds-tile-row","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-tile-row">
		<!-- wp:group {"tagName":"article","className":"cds-card","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-card">
			<!-- wp:html -->
			<span class="cds-icon-tile"><span class="cds-icon cds-icon--users" aria-hidden="true"></span></span>
			<!-- /wp:html -->

			<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
			<h3 class="wp-block-heading cds-card__title">A person</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>They could name who answered.</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->

		<!-- wp:group {"tagName":"article","className":"cds-card","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-card">
			<!-- wp:html -->
			<span class="cds-icon-tile"><span class="cds-icon cds-icon--chart" aria-hidden="true"></span></span>
			<!-- /wp:html -->

			<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
			<h3 class="wp-block-heading cds-card__title">A number</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>They could point at what moved.</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->

		<!-- wp:group {"tagName":"article","className":"cds-card","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-card">
			<!-- wp:html -->
			<span class="cds-icon-tile"><span class="cds-icon cds-icon--tag" aria-hidden="true"></span></span>
			<!-- /wp:html -->

			<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
			<h3 class="wp-block-heading cds-card__title">An offer</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>They could say what they bought.</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Watch the walkthrough</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"cds-cover cds-video","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-cover cds-video">
		<!-- wp:image {"linkDestination":"none","className":"cds-cover__media"} -->
		<figure class="wp-block-image cds-cover__media"><img src="<?php echo $cds_media_callout; ?>" alt="A still from the film"/></figure>
		<!-- /wp:image -->

		<!-- wp:group {"className":"cds-cover__scrim","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-cover__scrim">
			<!-- wp:html -->
			<a class="cds-play" href="#cds-stories-dialog" data-cds-dialog-open="cds-stories-dialog" aria-label="Play the film"><span class="cds-icon cds-icon--play" aria-hidden="true"></span></a>
			<!-- /wp:html -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Twelve minutes, no slides</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>The play control opens a dialog. Put your player there.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:html -->
	<dialog class="cds-dialog" id="cds-stories-dialog" aria-labelledby="cds-stories-title">
		<h2 id="cds-stories-title">The film</h2>
		<p>Replace this with your player. One dialog on this page.</p>
		<form method="dialog"><button class="cds-btn cds-btn--outline" type="submit">Close</button></form>
	</dialog>
	<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-7"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-7)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Scroll the row</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>Three reviews. The next one peeks in. The default review grid is still a grid.</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"className":"cds-reel","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-reel">
		<!-- wp:group {"tagName":"article","className":"cds-review","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-review">
			<!-- wp:html -->
			<p class="cds-review__rating"><span class="cds-review__stars" aria-hidden="true"><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star"></span></span><span class="cds-review__score"><span>4</span> out of <span>5</span></span></p>
			<!-- /wp:html -->

			<!-- wp:heading {"level":3,"className":"cds-review__title"} -->
			<h3 class="wp-block-heading cds-review__title">Clear and quick</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"cds-review__body"} -->
			<p class="cds-review__body">We shipped the page from the jobs in the catalog.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"cds-review__name"} -->
			<p class="cds-review__name">Alex Kim</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->

		<!-- wp:group {"tagName":"article","className":"cds-review","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-review">
			<!-- wp:html -->
			<p class="cds-review__rating"><span class="cds-review__stars" aria-hidden="true"><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span></span><span class="cds-review__score"><span>5</span> out of <span>5</span></span></p>
			<!-- /wp:html -->

			<!-- wp:heading {"level":3,"className":"cds-review__title"} -->
			<h3 class="wp-block-heading cds-review__title">Worth the setup</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"cds-review__body"} -->
			<p class="cds-review__body">The row holds. We did not add a slider.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"cds-review__name"} -->
			<p class="cds-review__name">Jordan Lee</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->

		<!-- wp:group {"tagName":"article","className":"cds-review","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-review">
			<!-- wp:html -->
			<p class="cds-review__rating"><span class="cds-review__stars" aria-hidden="true"><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span><span class="cds-review__star cds-review__star--on"></span></span><span class="cds-review__score"><span>5</span> out of <span>5</span></span></p>
			<!-- /wp:html -->

			<!-- wp:heading {"level":3,"className":"cds-review__title"} -->
			<h3 class="wp-block-heading cds-review__title">The grid held</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"cds-review__body"} -->
			<p class="cds-review__body">Three reviews, then the next one peeks in.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"cds-review__name"} -->
			<p class="cds-review__name">Mina Ortiz</p>
			<!-- /wp:paragraph -->
		</article>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
