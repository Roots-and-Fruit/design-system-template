<?php
/**
 * Title: Kit parts
 * Slug: cds/parts
 * Categories: cds
 * Inserter: true
 * Description: Specimen stack for the pieces. Unlisted page, not a nav item.
 */
?>
<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Icon card</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A tile, a title, and one line. The badge sits inline.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-tile-row","layout":{"type":"default"}} -->
<div class="wp-block-group cds-tile-row">
<!-- wp:group {"className":"cds-card","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-card">
<!-- wp:html -->
<span class="cds-icon-tile"><span class="cds-icon cds-icon--users" aria-hidden="true"></span></span>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"cds-badge-host"} -->
<p class="cds-badge-host"><span class="cds-badge">New</span></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
<h3 class="wp-block-heading cds-card__title">People</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Who it is for, in one line.</p>
<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-card","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-card">
<!-- wp:html -->
<span class="cds-icon-tile"><span class="cds-icon cds-icon--chart" aria-hidden="true"></span></span>
<!-- /wp:html -->

<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
<h3 class="wp-block-heading cds-card__title">Proof</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The number a reader can check.</p>
<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-card","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-card">
<!-- wp:html -->
<span class="cds-icon-tile"><span class="cds-icon cds-icon--tag" aria-hidden="true"></span></span>
<!-- /wp:html -->

<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
<h3 class="wp-block-heading cds-card__title">Offer</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>What they walk away with.</p>
<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Icon row</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The same tile, beside a title and one line.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-icon-list","layout":{"type":"default"}} -->
<div class="wp-block-group cds-icon-list">
<!-- wp:group {"className":"cds-icon-row","layout":{"type":"default"}} -->
<div class="wp-block-group cds-icon-row">
<!-- wp:html -->
<span class="cds-icon-tile"><span class="cds-icon cds-icon--users" aria-hidden="true"></span></span>
<!-- /wp:html -->

<!-- wp:group {"className":"cds-icon-row__copy","layout":{"type":"default"}} -->
<div class="wp-block-group cds-icon-row__copy">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">A named owner</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>One person is accountable for the page.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-icon-row","layout":{"type":"default"}} -->
<div class="wp-block-group cds-icon-row">
<!-- wp:html -->
<span class="cds-icon-tile"><span class="cds-icon cds-icon--chart" aria-hidden="true"></span></span>
<!-- /wp:html -->

<!-- wp:group {"className":"cds-icon-row__copy","layout":{"type":"default"}} -->
<div class="wp-block-group cds-icon-row__copy">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">A number you can check</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The metric sits on the page.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-icon-row","layout":{"type":"default"}} -->
<div class="wp-block-group cds-icon-row">
<!-- wp:html -->
<span class="cds-icon-tile"><span class="cds-icon cds-icon--check" aria-hidden="true"></span></span>
<!-- /wp:html -->

<!-- wp:group {"className":"cds-icon-row__copy","layout":{"type":"default"}} -->
<div class="wp-block-group cds-icon-row__copy">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">A clear next step</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The reader knows what to do this week.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Cover</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Photo, scrim, and a chip. The paper hero is unchanged.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-cover","layout":{"type":"default"}} -->
<div class="wp-block-group cds-cover">
<!-- wp:image {"linkDestination":"none","className":"cds-cover__media"} -->
<figure class="wp-block-image cds-cover__media"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/hero.jpg' ) ); ?>" alt="A chair in a bright room"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"cds-cover__scrim","layout":{"type":"default"}} -->
<div class="wp-block-group cds-cover__scrim">
<!-- wp:html -->
<p class="cds-chip cds-chip--float"><span class="cds-icon cds-icon--truck" aria-hidden="true"></span><span><strong>Ships fast</strong><span>In two days</span></span></p>
<!-- /wp:html -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Type on the photo</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The paper hero stays a Switcher. This is the still frame.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Video card</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A play control on the cover opens the dialog.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-cover cds-video","layout":{"type":"default"}} -->
<div class="wp-block-group cds-cover cds-video">
<!-- wp:image {"linkDestination":"none","className":"cds-cover__media"} -->
<figure class="wp-block-image cds-cover__media"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/callout.jpg' ) ); ?>" alt="A still from the film"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"cds-cover__scrim","layout":{"type":"default"}} -->
<div class="wp-block-group cds-cover__scrim">
<!-- wp:html -->
<a class="cds-play" href="#cds-video-dialog" data-cds-dialog-open="cds-video-dialog" aria-label="Play the film"><span class="cds-icon cds-icon--play" aria-hidden="true"></span></a>
<!-- /wp:html -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Watch the walkthrough</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The play control opens a dialog.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<dialog class="cds-dialog" id="cds-video-dialog" aria-labelledby="cds-video-title">
	<h2 id="cds-video-title">The film</h2>
	<p>Replace this with your player. One dialog per page.</p>
	<form method="dialog"><button class="cds-btn cds-btn--outline" type="submit">Close</button></form>
</dialog>
<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Logo row</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Replace the marks with sponsor logos.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cds-meta"} -->
<p class="cds-meta">As seen in</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-logo-row","layout":{"type":"default"}} -->
<div class="wp-block-group cds-logo-row">
<!-- wp:image {"linkDestination":"none","className":"cds-logo-row__mark is-style-cds-original"} -->
<figure class="wp-block-image cds-logo-row__mark is-style-cds-original"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/mark.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"linkDestination":"none","className":"cds-logo-row__mark is-style-cds-original"} -->
<figure class="wp-block-image cds-logo-row__mark is-style-cds-original"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/mark.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"linkDestination":"none","className":"cds-logo-row__mark is-style-cds-original"} -->
<figure class="wp-block-image cds-logo-row__mark is-style-cds-original"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/mark.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"linkDestination":"none","className":"cds-logo-row__mark is-style-cds-original"} -->
<figure class="wp-block-image cds-logo-row__mark is-style-cds-original"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/mark.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"linkDestination":"none","className":"cds-logo-row__mark is-style-cds-original"} -->
<figure class="wp-block-image cds-logo-row__mark is-style-cds-original"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/mark.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Product card</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Frame, corner badge, name, and a compare-at price.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-tile-row","layout":{"type":"default"}} -->
<div class="wp-block-group cds-tile-row">
<!-- wp:group {"className":"cds-product","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-product">
<!-- wp:group {"className":"cds-media","layout":{"type":"default"}} -->
<div class="wp-block-group cds-media">
<!-- wp:image {"linkDestination":"none","className":"cds-product__photo"} -->
<figure class="wp-block-image cds-product__photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) ); ?>" alt="Side chair"/></figure>
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

<!-- wp:group {"className":"cds-product","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-product">
<!-- wp:group {"className":"cds-media","layout":{"type":"default"}} -->
<div class="wp-block-group cds-media">
<!-- wp:image {"linkDestination":"none","className":"cds-product__photo"} -->
<figure class="wp-block-image cds-product__photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-2.jpg' ) ); ?>" alt="Floor lamp"/></figure>
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

<!-- wp:group {"className":"cds-product","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-product">
<!-- wp:group {"className":"cds-media","layout":{"type":"default"}} -->
<div class="wp-block-group cds-media">
<!-- wp:image {"linkDestination":"none","className":"cds-product__photo"} -->
<figure class="wp-block-image cds-product__photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-3.jpg' ) ); ?>" alt="Oak stool"/></figure>
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

<!-- wp:group {"className":"cds-product","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-product">
<!-- wp:group {"className":"cds-media","layout":{"type":"default"}} -->
<div class="wp-block-group cds-media">
<!-- wp:image {"linkDestination":"none","className":"cds-product__photo"} -->
<figure class="wp-block-image cds-product__photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/split.jpg' ) ); ?>" alt="Wool throw"/></figure>
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

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Category tile</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A square cover with a label.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-tile-row","layout":{"type":"default"}} -->
<div class="wp-block-group cds-tile-row">
<!-- wp:group {"className":"cds-cover cds-category","layout":{"type":"default"}} -->
<div class="wp-block-group cds-cover cds-category">
<!-- wp:image {"linkDestination":"none","className":"cds-cover__media"} -->
<figure class="wp-block-image cds-cover__media"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) ); ?>" alt="Seating"/></figure>
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
<figure class="wp-block-image cds-cover__media"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-2.jpg' ) ); ?>" alt="Lighting"/></figure>
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
<figure class="wp-block-image cds-cover__media"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/callout.jpg' ) ); ?>" alt="Textiles"/></figure>
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

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Contact form</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Stacked fields. This sample does not send.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<form class="cds-form" action="#" method="post">
	<div class="cds-field">
		<label for="cds-contact-name">Name</label>
		<input class="cds-input" id="cds-contact-name" name="name" type="text" autocomplete="name" required>
	</div>
	<div class="cds-field">
		<label for="cds-contact-email">Email</label>
		<input class="cds-input" id="cds-contact-email" name="email" type="email" autocomplete="email" required>
	</div>
	<div class="cds-field">
		<label for="cds-contact-note">Message</label>
		<textarea class="cds-textarea" id="cds-contact-note" name="note" rows="4"></textarea>
	</div>
	<button class="cds-btn cds-btn--primary" type="submit">Send</button>
	<p class="cds-hint">This sample does not send. Point it at your form.</p>
</form>
<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Subscribe</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Avatars plus an inline email and button.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-subscribe","layout":{"type":"default"}} -->
<div class="wp-block-group cds-subscribe">
<!-- wp:html -->
<div class="cds-avatars" aria-hidden="true"><span class="cds-avatar">AK</span><span class="cds-avatar">JL</span><span class="cds-avatar">MR</span></div>
<!-- /wp:html -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Join the list</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A short note on what arrives, and how often.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<form class="cds-form cds-form--inline" action="#" method="post">
	<div class="cds-field">
		<label for="cds-subscribe-email">Email</label>
		<input class="cds-input" id="cds-subscribe-email" name="email" type="email" autocomplete="email" placeholder="you@example.com" required>
	</div>
	<button class="cds-btn cds-btn--primary" type="submit">Join</button>
</form>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Icon link</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A tile that is a link.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="cds-cluster">
	<a class="cds-icon-link" href="#" aria-label="Email"><span class="cds-icon cds-icon--mail" aria-hidden="true"></span></a>
	<a class="cds-icon-link" href="#" aria-label="Next"><span class="cds-icon cds-icon--arrow" aria-hidden="true"></span></a>
	<a class="cds-icon-link" href="#" aria-label="People"><span class="cds-icon cds-icon--users" aria-hidden="true"></span></a>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Reel</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Scroll the row. The review grid stays the default.</p>
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
	<p class="cds-review__body">We shipped the page from the jobs in the catalog. No second theme.</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"tagName":"footer","className":"cds-review__by","layout":{"type":"default"}} -->
	<footer class="wp-block-group cds-review__by">
		<!-- wp:paragraph {"className":"cds-review__name"} -->
		<p class="cds-review__name">Alex Kim</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"cds-review__date"} -->
		<p class="cds-review__date"><time datetime="2026-01-20">January 20, 2026</time></p>
		<!-- /wp:paragraph -->
	</footer>
	<!-- /wp:group -->
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

	<!-- wp:group {"tagName":"footer","className":"cds-review__by","layout":{"type":"default"}} -->
	<footer class="wp-block-group cds-review__by">
		<!-- wp:paragraph {"className":"cds-review__name"} -->
		<p class="cds-review__name">Jordan Lee</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"cds-review__date"} -->
		<p class="cds-review__date"><time datetime="2026-03-02">March 2, 2026</time></p>
		<!-- /wp:paragraph -->
	</footer>
	<!-- /wp:group -->
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

	<!-- wp:group {"tagName":"footer","className":"cds-review__by","layout":{"type":"default"}} -->
	<footer class="wp-block-group cds-review__by">
		<!-- wp:paragraph {"className":"cds-review__name"} -->
		<p class="cds-review__name">Mina Ortiz</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"cds-review__date"} -->
		<p class="cds-review__date"><time datetime="2026-04-09">April 9, 2026</time></p>
		<!-- /wp:paragraph -->
	</footer>
	<!-- /wp:group -->
</article>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Folder tabs</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The active tab shares its bottom edge with the panel.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="cds-tabs">
	<div class="cds-tabs__list" role="tablist" aria-label="Settings sections">
		<button type="button" class="cds-tabs__tab is-current" role="tab" data-cds-tab="agents" aria-selected="true">
			<span class="cds-tabs__dot" aria-hidden="true"></span>Agents
		</button>
		<button type="button" class="cds-tabs__tab" role="tab" data-cds-tab="settings" aria-selected="false" tabindex="-1">
			<span class="cds-tabs__dot" aria-hidden="true"></span>Settings
		</button>
		<button type="button" class="cds-tabs__tab" role="tab" data-cds-tab="activity" aria-selected="false" tabindex="-1">
			<span class="cds-tabs__dot" aria-hidden="true"></span>Activity
		</button>
	</div>
	<div class="cds-tabs__panel" role="tabpanel" data-cds-panel="agents"><p>The list of connected accounts.</p></div>
	<div class="cds-tabs__panel" role="tabpanel" data-cds-panel="settings" hidden><p>Limits for the whole workspace.</p></div>
	<div class="cds-tabs__panel" role="tabpanel" data-cds-panel="activity" hidden><p>A log of recent changes.</p></div>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Gallery</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Arrows come in on hover. Open uses the same pictures.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="cds-gallery">
	<figure class="cds-gallery__stage">
		<div class="cds-gallery__head">
			<p class="cds-gallery__name">Places</p>
		</div>
		<div class="cds-gallery__view">
			<button type="button" class="cds-gallery__float" data-cds-gallery="prev" aria-label="Previous">
				<span class="cds-icon cds-icon--arrow" aria-hidden="true"></span>
			</button>
			<button type="button" class="cds-gallery__open" data-cds-gallery="open" aria-label="Open the picture">
				<img class="cds-gallery__img" alt="" src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) ); ?>" width="800" height="600" />
			</button>
			<button type="button" class="cds-gallery__float cds-gallery__float--next" data-cds-gallery="next" aria-label="Next">
				<span class="cds-icon cds-icon--arrow" aria-hidden="true"></span>
			</button>
		</div>
		<figcaption class="cds-gallery__bar">
			<span class="cds-gallery__count"></span>
			<span class="cds-gallery__caption"></span>
			<button type="button" class="cds-btn cds-btn--outline cds-btn--sm" data-cds-gallery="open">Open</button>
		</figcaption>
	</figure>
	<div class="cds-gallery__strip">
		<button type="button" class="cds-gallery__thumb" aria-current="true"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) ); ?>" alt="A path through trees" width="800" height="600" /></button>
		<button type="button" class="cds-gallery__thumb"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-2.jpg' ) ); ?>" alt="A valley in the afternoon" width="800" height="600" /></button>
		<button type="button" class="cds-gallery__thumb"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-3.jpg' ) ); ?>" alt="A city after rain" width="800" height="600" /></button>
	</div>
	<dialog class="cds-gallery__dialog">
		<img alt="" />
		<p class="cds-gallery__dialog-caption"></p>
		<form method="dialog"><button class="cds-btn cds-btn--ghost cds-btn--sm">Close</button></form>
	</dialog>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Post cards</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Image, category, title, one line, date.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-posts","layout":{"type":"default"}} -->
<div class="wp-block-group cds-posts">
<!-- wp:group {"className":"cds-post","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-post">
<!-- wp:image {"linkDestination":"none","className":"cds-post__media"} -->
<figure class="wp-block-image cds-post__media"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) ); ?>" alt="A path through trees"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"cds-meta"} -->
<p class="cds-meta">Notes</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"cds-post__title"} -->
<h3 class="wp-block-heading cds-post__title"><a href="#post">A named offer, written down</a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Say what the work is, who it is for, and what they leave with.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cds-meta"} -->
<p class="cds-meta">April 17, 2026</p>
<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-post","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-post">
<!-- wp:image {"linkDestination":"none","className":"cds-post__media"} -->
<figure class="wp-block-image cds-post__media"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-2.jpg' ) ); ?>" alt="A green valley under cloud"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"cds-meta"} -->
<p class="cds-meta">Proof</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"cds-post__title"} -->
<h3 class="wp-block-heading cds-post__title"><a href="#post">A number you can check</a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The metric sits on the page. It is not a slide in a deck.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cds-meta"} -->
<p class="cds-meta">April 2, 2026</p>
<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Fact list</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A title bar is the download card. Leave the title off for case-study meta.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-cluster cds-facts-pair","layout":{"type":"default"}} -->
<div class="wp-block-group cds-cluster cds-facts-pair">
<!-- wp:html -->
<div class="cds-facts">
	<p class="cds-facts__title">Theme details</p>
	<dl>
		<div><dt>Downloads</dt><dd>12</dd></div>
			<div><dt>Version</dt><dd>1.4</dd></div>
			<div><dt>Rating</dt><dd>4.9</dd></div>
			<div><dt>File size</dt><dd>2 MB</dd></div>
	</dl>
</div>
<!-- /wp:html -->

<!-- wp:html -->
<dl class="cds-facts">
	<div><dt>Client</dt><dd>Northwind</dd></div>
			<div><dt>Date</dt><dd>May 2026</dd></div>
			<div><dt>Services</dt><dd>Brand, type</dd></div>
			<div><dt>Visit</dt><dd><a href="#facts">example.com</a></dd></div>
</dl>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Stat row</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Four figures, equal and centered, on the dark band.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-surface cds-surface--dark","layout":{"type":"default"}} -->
<div class="wp-block-group cds-surface cds-surface--dark">
<!-- wp:group {"className":"cds-stats","layout":{"type":"default"}} -->
<div class="wp-block-group cds-stats">
<!-- wp:group {"className":"cds-stat","layout":{"type":"default"}} -->
<div class="wp-block-group cds-stat">
<!-- wp:paragraph {"className":"cds-stat__value"} -->
<p class="cds-stat__value">140+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cds-meta"} -->
<p class="cds-meta">Projects</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-stat","layout":{"type":"default"}} -->
<div class="wp-block-group cds-stat">
<!-- wp:paragraph {"className":"cds-stat__value"} -->
<p class="cds-stat__value">98%</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cds-meta"} -->
<p class="cds-meta">Kept</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-stat","layout":{"type":"default"}} -->
<div class="wp-block-group cds-stat">
<!-- wp:paragraph {"className":"cds-stat__value"} -->
<p class="cds-stat__value">12</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cds-meta"} -->
<p class="cds-meta">Years</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-stat","layout":{"type":"default"}} -->
<div class="wp-block-group cds-stat">
<!-- wp:paragraph {"className":"cds-stat__value"} -->
<p class="cds-stat__value">4</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cds-meta"} -->
<p class="cds-meta">People</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Episode row</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A square cover and one play button.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-episodes","layout":{"type":"default"}} -->
<div class="wp-block-group cds-episodes">
<!-- wp:group {"className":"cds-episode","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-episode">
<!-- wp:image {"linkDestination":"none","className":"cds-episode__thumb"} -->
<figure class="wp-block-image cds-episode__thumb"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/hero.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"cds-episode__body","layout":{"type":"default"}} -->
<div class="wp-block-group cds-episode__body">
<!-- wp:paragraph {"className":"cds-meta cds-episode__kicker"} -->
<p class="cds-meta cds-episode__kicker">Episode 20 · 45 min</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"cds-episode__title"} -->
<h3 class="wp-block-heading cds-episode__title">The offer, said out loud</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>What the work is, who it is for, and what they leave with.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<a class="cds-btn cds-btn--primary cds-btn--sm cds-episode__play" href="#episode"><span class="cds-icon cds-icon--play" aria-hidden="true"></span>Play</a>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-episode","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-episode">
<!-- wp:image {"linkDestination":"none","className":"cds-episode__thumb"} -->
<figure class="wp-block-image cds-episode__thumb"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/split.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"cds-episode__body","layout":{"type":"default"}} -->
<div class="wp-block-group cds-episode__body">
<!-- wp:paragraph {"className":"cds-meta cds-episode__kicker"} -->
<p class="cds-meta cds-episode__kicker">Episode 19 · 42 min</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"cds-episode__title"} -->
<h3 class="wp-block-heading cds-episode__title">A number you can count</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The figure on the page, and the notes that match it.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<a class="cds-btn cds-btn--primary cds-btn--sm cds-episode__play" href="#episode"><span class="cds-icon cds-icon--play" aria-hidden="true"></span>Play</a>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</article>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Steps</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A mark on the left. The mark is a step number or a year.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<ol class="cds-steps">
		<li class="cds-step"><p class="cds-step__mark">01</p><div><h3 class="cds-step__title">Book a conversation</h3><p>One call to name the offer and the number you are watching.</p></div></li>
		<li class="cds-step"><p class="cds-step__mark">02</p><div><h3 class="cds-step__title">Write the page</h3><p>The work, who it is for, and what they leave with. One paragraph is enough.</p></div></li>
		<li class="cds-step"><p class="cds-step__mark">03</p><div><h3 class="cds-step__title">Put the number where they can see it</h3><p>It stays on the page. It does not move into a deck.</p></div></li>
	</ol>
<!-- /wp:html -->

<!-- wp:html -->
<ol class="cds-steps">
		<li class="cds-step"><p class="cds-step__mark">2024</p><div><p>Started with one offer and a single page.</p></div></li>
		<li class="cds-step"><p class="cds-step__mark">2026</p><div><p>The number is on the page, and the notes match it.</p></div></li>
	</ol>
<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">People</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A square slot, a name, a role.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-people","layout":{"type":"default"}} -->
<div class="wp-block-group cds-people">
<!-- wp:group {"className":"cds-person","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-person">
<!-- wp:html -->
<span class="cds-avatar" role="img" aria-label="Jordan Lee">JL</span>
<!-- /wp:html -->

<!-- wp:heading {"level":3,"className":"cds-person__name"} -->
<h3 class="wp-block-heading cds-person__name">Jordan Lee</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cds-person__role"} -->
<p class="cds-person__role">Notes</p>
<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-person","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-person">
<!-- wp:html -->
<span class="cds-avatar" role="img" aria-label="Alex Kim">AK</span>
<!-- /wp:html -->

<!-- wp:heading {"level":3,"className":"cds-person__name"} -->
<h3 class="wp-block-heading cds-person__name">Alex Kim</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cds-person__role"} -->
<p class="cds-person__role">Proof</p>
<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-person","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-person">
<!-- wp:html -->
<span class="cds-avatar" role="img" aria-label="Mina Cole">MC</span>
<!-- /wp:html -->

<!-- wp:heading {"level":3,"className":"cds-person__name"} -->
<h3 class="wp-block-heading cds-person__name">Mina Cole</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cds-person__role"} -->
<p class="cds-person__role">Type</p>
<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Photo cluster</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>One lead picture and two smaller ones.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-shots","layout":{"type":"default"}} -->
<div class="wp-block-group cds-shots">
<!-- wp:image {"linkDestination":"none","className":"cds-shots__lead"} -->
<figure class="wp-block-image cds-shots__lead"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/hero.jpg' ) ); ?>" alt="A ridge in warm light"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"cds-shots__side","layout":{"type":"default"}} -->
<div class="wp-block-group cds-shots__side">
<!-- wp:image {"linkDestination":"none","className":""} -->
<figure class="wp-block-image "><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) ); ?>" alt="A path through trees"/></figure>
<!-- /wp:image -->

<!-- wp:image {"linkDestination":"none","className":""} -->
<figure class="wp-block-image "><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-3.jpg' ) ); ?>" alt="A city street at sunrise"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Bento</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Three equal cells, then two that share the row.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-bento","layout":{"type":"default"}} -->
<div class="wp-block-group cds-bento">
<!-- wp:group {"className":"cds-card","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-card">
<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
<h3 class="wp-block-heading cds-card__title">The offer</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Name the work, the person, and what they leave with.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"linkDestination":"none","className":""} -->
<figure class="wp-block-image "><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-card","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-card">
<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
<h3 class="wp-block-heading cds-card__title">The number</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A figure they can check without another tool.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"linkDestination":"none","className":""} -->
<figure class="wp-block-image "><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-2.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-card","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-card">
<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
<h3 class="wp-block-heading cds-card__title">The next step</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>One action. The page says what it is.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"linkDestination":"none","className":""} -->
<figure class="wp-block-image "><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-3.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-card cds-bento__wide","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-card cds-bento__wide">
<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
<h3 class="wp-block-heading cds-card__title">The notes</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>What happened between the calls, written where the next person can find it.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"linkDestination":"none","className":""} -->
<figure class="wp-block-image "><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/split.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-card cds-bento__wide","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-card cds-bento__wide">
<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
<h3 class="wp-block-heading cds-card__title">The room</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The same work, shown. No second system for the pictures.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"linkDestination":"none","className":""} -->
<figure class="wp-block-image "><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/hero.jpg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->
</article>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Search</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>The label stays above the field. Topic chips are links.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<form class="cds-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="cds-field">
		<label for="cds-search-q">Search</label>
		<div class="cds-search__row">
			<input class="cds-input" id="cds-search-q" type="search" name="s" placeholder="What are you looking for?" />
			<button type="submit" class="cds-btn cds-btn--primary">Search</button>
		</div>
	</div>
</form>
<!-- /wp:html -->

<!-- wp:html -->
<div class="cds-cluster">
	<span class="cds-meta">Topics</span>
	<a class="cds-pill" href="#notes">Notes</a>
	<a class="cds-pill" href="#proof">Proof</a>
	<a class="cds-pill" href="#type">Type</a>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-part","layout":{"type":"default"}} -->
<div class="wp-block-group cds-part">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Footer with a call to action</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>An inserter pattern. The site footer is unchanged.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-footer-cta","layout":{"type":"default"}} -->
<div class="wp-block-group cds-footer-cta">
<!-- wp:group {"className":"cds-footer-cta__bar","layout":{"type":"default"}} -->
<div class="wp-block-group cds-footer-cta__bar">
<!-- wp:group {"className":"cds-footer-cta__invite","layout":{"type":"default"}} -->
<div class="wp-block-group cds-footer-cta__invite">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Ready when you are</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A short line under the invitation.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:buttons {"className":"cds-cluster"} -->
<div class="wp-block-buttons cds-cluster">
<!-- wp:button {"className":"cds-btn cds-btn--primary"} -->
<div class="wp-block-button cds-btn cds-btn--primary"><a class="wp-block-button__link wp-element-button" href="#start">Get started</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:columns -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column">
	<!-- wp:paragraph {"className":"cds-meta"} -->
	<p class="cds-meta">Work</p>
	<!-- /wp:paragraph -->

	<!-- wp:list {"className":"cds-footer-cta__links"} -->
	<ul class="wp-block-list cds-footer-cta__links">
		<!-- wp:list-item -->
<li><a href="#">Offers</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">Pricing</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">Stories</a></li>
<!-- /wp:list-item -->
	</ul>
	<!-- /wp:list -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
	<!-- wp:paragraph {"className":"cds-meta"} -->
	<p class="cds-meta">Studio</p>
	<!-- /wp:paragraph -->

	<!-- wp:list {"className":"cds-footer-cta__links"} -->
	<ul class="wp-block-list cds-footer-cta__links">
		<!-- wp:list-item -->
<li><a href="#">About</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">Method</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">Contact</a></li>
<!-- /wp:list-item -->
	</ul>
	<!-- /wp:list -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
	<!-- wp:paragraph {"className":"cds-meta"} -->
	<p class="cds-meta">Notes</p>
	<!-- /wp:paragraph -->

	<!-- wp:list {"className":"cds-footer-cta__links"} -->
	<ul class="wp-block-list cds-footer-cta__links">
		<!-- wp:list-item -->
<li><a href="#">Journal</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">Guides</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">Updates</a></li>
<!-- /wp:list-item -->
	</ul>
	<!-- /wp:list -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
	<!-- wp:paragraph {"className":"cds-meta"} -->
	<p class="cds-meta">Visit</p>
	<!-- /wp:paragraph -->

	<!-- wp:list {"className":"cds-footer-cta__links"} -->
	<ul class="wp-block-list cds-footer-cta__links">
		<!-- wp:list-item -->
<li><a href="#">Privacy</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">Terms</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="#">Imprint</a></li>
<!-- /wp:list-item -->
	</ul>
	<!-- /wp:list -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
