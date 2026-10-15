<?php
/**
 * Title: Show layout
 * Slug: cds/layout-show
 * Categories: cds
 * Description: A show page. A title, a stack of episodes, and a way to subscribe.
 * Post Types: page
 * Viewport Width: 960
 */
$cds_hero  = esc_url( get_theme_file_uri( 'assets/media/hero.jpg' ) );
$cds_split = esc_url( get_theme_file_uri( 'assets/media/split.jpg' ) );
$cds_card  = esc_url( get_theme_file_uri( 'assets/media/card-3.jpg' ) );
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-7","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-7);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:group {"className":"is-style-cds-copy","layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-cds-copy">
		<!-- wp:paragraph {"className":"is-style-cds-pill"} -->
		<p class="is-style-cds-pill">A show</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":1,"fontSize":"display-xl"} -->
		<h1 class="wp-block-heading has-display-xl-font-size">On the record</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"cds-lede"} -->
		<p class="cds-lede">One play button per episode. The list is the page.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:0;padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:group {"className":"cds-episodes","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-episodes">
		<!-- wp:group {"tagName":"article","className":"cds-episode","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-episode">
			<!-- wp:image {"linkDestination":"none","className":"cds-episode__thumb"} -->
			<figure class="wp-block-image cds-episode__thumb"><img src="<?php echo $cds_hero; ?>" alt=""/></figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":"cds-episode__body","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-episode__body">
				<!-- wp:paragraph {"className":"cds-meta cds-episode__kicker"} -->
				<p class="cds-meta cds-episode__kicker">Episode 20 · 45 min</p>
				<!-- /wp:paragraph -->
				<!-- wp:heading {"level":2,"className":"cds-episode__title"} -->
				<h2 class="wp-block-heading cds-episode__title">The offer, said out loud</h2>
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

		<!-- wp:group {"tagName":"article","className":"cds-episode","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-episode">
			<!-- wp:image {"linkDestination":"none","className":"cds-episode__thumb"} -->
			<figure class="wp-block-image cds-episode__thumb"><img src="<?php echo $cds_split; ?>" alt=""/></figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":"cds-episode__body","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-episode__body">
				<!-- wp:paragraph {"className":"cds-meta cds-episode__kicker"} -->
				<p class="cds-meta cds-episode__kicker">Episode 19 · 42 min</p>
				<!-- /wp:paragraph -->
				<!-- wp:heading {"level":2,"className":"cds-episode__title"} -->
				<h2 class="wp-block-heading cds-episode__title">A number you can count</h2>
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

		<!-- wp:group {"tagName":"article","className":"cds-episode","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-episode">
			<!-- wp:image {"linkDestination":"none","className":"cds-episode__thumb"} -->
			<figure class="wp-block-image cds-episode__thumb"><img src="<?php echo $cds_card; ?>" alt=""/></figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":"cds-episode__body","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-episode__body">
				<!-- wp:paragraph {"className":"cds-meta cds-episode__kicker"} -->
				<p class="cds-meta cds-episode__kicker">Episode 18 · 38 min</p>
				<!-- /wp:paragraph -->
				<!-- wp:heading {"level":2,"className":"cds-episode__title"} -->
				<h2 class="wp-block-heading cds-episode__title">The page after the call</h2>
				<!-- /wp:heading -->
				<!-- wp:paragraph -->
				<p>What got written down, and what was left off.</p>
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

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-7"}}},"backgroundColor":"paper-deep","layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide has-paper-deep-background-color has-background" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-7)">
	<!-- wp:group {"className":"cds-subscribe","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-subscribe">
		<!-- wp:html -->
		<div class="cds-avatars" aria-hidden="true"><span class="cds-avatar">AK</span><span class="cds-avatar">JL</span><span class="cds-avatar">MC</span></div>
		<!-- /wp:html -->
		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading">Hear the next one</h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph -->
		<p>A note when a new episode is up. No other mail.</p>
		<!-- /wp:paragraph -->
		<!-- wp:html -->
		<form class="cds-form cds-form--inline" action="#" method="post">
			<div class="cds-field">
				<label for="cds-show-email">Email</label>
				<input class="cds-input" id="cds-show-email" name="email" type="email" autocomplete="email" placeholder="you@example.com" required>
			</div>
			<button class="cds-btn cds-btn--primary" type="submit">Join</button>
		</form>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
