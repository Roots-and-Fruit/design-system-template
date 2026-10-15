<?php
/**
 * Title: Case study layout
 * Slug: cds/layout-case
 * Categories: cds
 * Description: A study of one engagement. Gallery, facts, steps, a result, and the people.
 * Post Types: page
 * Viewport Width: 960
 */
$cds_card_1 = esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) );
$cds_card_2 = esc_url( get_theme_file_uri( 'assets/media/card-2.jpg' ) );
$cds_card_3 = esc_url( get_theme_file_uri( 'assets/media/card-3.jpg' ) );
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-7","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-7);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:group {"className":"is-style-cds-switcher","layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-cds-switcher">
		<!-- wp:group {"className":"is-style-cds-copy","layout":{"type":"default"}} -->
		<div class="wp-block-group is-style-cds-copy">
			<!-- wp:paragraph {"className":"is-style-cds-pill"} -->
			<p class="is-style-cds-pill">Case study</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"fontSize":"display-xl"} -->
			<h1 class="wp-block-heading has-display-xl-font-size">Northwind, on one page</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"cds-lede"} -->
			<p class="cds-lede">The offer, the pictures, and the number they can still check. Six weeks, one page.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:html -->
		<dl class="cds-facts">
			<div><dt>Client</dt><dd>Northwind</dd></div>
			<div><dt>Date</dt><dd>May 2026</dd></div>
			<div><dt>Services</dt><dd>Brand, type</dd></div>
			<div><dt>Visit</dt><dd><a href="#northwind">example.com</a></dd></div>
		</dl>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:0;padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:html -->
	<div class="cds-gallery">
		<figure class="cds-gallery__stage">
			<div class="cds-gallery__head"><p class="cds-gallery__name">The work</p></div>
			<div class="cds-gallery__view">
				<button type="button" class="cds-gallery__float" data-cds-gallery="prev" aria-label="Previous"><span class="cds-icon cds-icon--arrow" aria-hidden="true"></span></button>
				<button type="button" class="cds-gallery__open" data-cds-gallery="open" aria-label="Open the picture"><img class="cds-gallery__img" alt="" src="<?php echo $cds_card_1; ?>" width="800" height="600" /></button>
				<button type="button" class="cds-gallery__float cds-gallery__float--next" data-cds-gallery="next" aria-label="Next"><span class="cds-icon cds-icon--arrow" aria-hidden="true"></span></button>
			</div>
			<figcaption class="cds-gallery__bar">
				<span class="cds-gallery__count"></span>
				<span class="cds-gallery__caption"></span>
				<button type="button" class="cds-btn cds-btn--outline cds-btn--sm" data-cds-gallery="open">Open</button>
			</figcaption>
		</figure>
		<div class="cds-gallery__strip">
			<button type="button" class="cds-gallery__thumb" aria-current="true"><img src="<?php echo $cds_card_1; ?>" alt="A path through trees" width="800" height="600" /></button>
			<button type="button" class="cds-gallery__thumb"><img src="<?php echo $cds_card_2; ?>" alt="A valley in the afternoon" width="800" height="600" /></button>
			<button type="button" class="cds-gallery__thumb"><img src="<?php echo $cds_card_3; ?>" alt="A city after rain" width="800" height="600" /></button>
		</div>
		<dialog class="cds-gallery__dialog"><img alt="" /><p class="cds-gallery__dialog-caption"></p><form method="dialog"><button class="cds-btn cds-btn--ghost cds-btn--sm">Close</button></form></dialog>
	</div>
	<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">How the work went</h2>
	<!-- /wp:heading -->

	<!-- wp:html -->
	<ol class="cds-steps">
		<li class="cds-step"><p class="cds-step__mark">01</p><div><h3 class="cds-step__title">Name the offer</h3><p>One sentence for the work, and who it was for.</p></div></li>
		<li class="cds-step"><p class="cds-step__mark">02</p><div><h3 class="cds-step__title">Write the page</h3><p>The pictures and the number stayed on the same page.</p></div></li>
		<li class="cds-step"><p class="cds-step__mark">03</p><div><h3 class="cds-step__title">Leave it where they can check it</h3><p>No deck. The figure is still on the site.</p></div></li>
	</ol>
	<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:0;padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:group {"className":"cds-surface cds-surface--dark","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-surface cds-surface--dark">
		<!-- wp:group {"className":"cds-stats","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-stats">
			<!-- wp:group {"className":"cds-stat","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-stat">
				<!-- wp:paragraph {"className":"cds-stat__value"} -->
				<p class="cds-stat__value">18</p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"cds-meta"} -->
				<p class="cds-meta">Pages</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<!-- wp:group {"className":"cds-stat","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-stat">
				<!-- wp:paragraph {"className":"cds-stat__value"} -->
				<p class="cds-stat__value">6</p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"cds-meta"} -->
				<p class="cds-meta">Weeks</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<!-- wp:group {"className":"cds-stat","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-stat">
				<!-- wp:paragraph {"className":"cds-stat__value"} -->
				<p class="cds-stat__value">1</p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"cds-meta"} -->
				<p class="cds-meta">Offer</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<!-- wp:group {"className":"cds-stat","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-stat">
				<!-- wp:paragraph {"className":"cds-stat__value"} -->
				<p class="cds-stat__value">4.9</p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"cds-meta"} -->
				<p class="cds-meta">Rating</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Who did the work</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"cds-people","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-people">
		<!-- wp:group {"tagName":"article","className":"cds-person","layout":{"type":"default"}} -->
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
		<!-- wp:group {"tagName":"article","className":"cds-person","layout":{"type":"default"}} -->
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
		<!-- wp:group {"tagName":"article","className":"cds-person","layout":{"type":"default"}} -->
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

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:0;padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:group {"tagName":"figure","className":"cds-quote","layout":{"type":"default"}} -->
	<figure class="wp-block-group cds-quote">
		<!-- wp:quote -->
		<blockquote class="wp-block-quote"><!-- wp:paragraph -->
		<p>The number stayed on the page. We did not have to ask where it went.</p>
		<!-- /wp:paragraph --></blockquote>
		<!-- /wp:quote -->
		<!-- wp:group {"tagName":"figcaption","className":"cds-quote__who","layout":{"type":"default"}} -->
		<figcaption class="wp-block-group cds-quote__who">
			<!-- wp:group {"className":"cds-quote__id","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-quote__id">
				<!-- wp:paragraph {"className":"cds-quote__name"} -->
				<p class="cds-quote__name">A founder</p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"className":"cds-quote__role"} -->
				<p class="cds-quote__role">Northwind</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</figcaption>
		<!-- /wp:group -->
	</figure>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-7"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-7)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Start with the offer</h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>One conversation to name the work and the number you are watching.</p>
	<!-- /wp:paragraph -->
	<!-- wp:buttons -->
	<div class="wp-block-buttons"><!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/offer/">See the offer</a></div>
	<!-- /wp:button --></div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
