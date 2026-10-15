<?php
/**
 * Title: Studio layout
 * Slug: cds/layout-studio
 * Categories: cds
 * Description: Alternating features, a FAQ, and a contact form. A page recipe. Not the site footer.
 * Post Types: page
 * Viewport Width: 960
 */
$cds_media_hero  = esc_url( get_theme_file_uri( 'assets/media/hero.jpg' ) );
$cds_media_split = esc_url( get_theme_file_uri( 'assets/media/split.jpg' ) );
$cds_media_mark  = esc_url( get_theme_file_uri( 'assets/mark.svg' ) );
?>
<!-- wp:group {"align":"wide","className":"cds-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-7","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide cds-hero" style="padding-top:var(--wp--preset--spacing--space-7);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:group {"className":"is-style-cds-switcher","layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-cds-switcher">
		<!-- wp:group {"className":"is-style-cds-copy","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group is-style-cds-copy">
			<!-- wp:paragraph {"className":"is-style-cds-pill"} -->
			<p class="is-style-cds-pill">For a small practice</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"fontSize":"display-xl"} -->
			<h1 class="wp-block-heading has-display-xl-font-size">A studio you can hand to someone else</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"cds-lede","fontSize":"body-lg"} -->
			<p class="cds-lede has-body-lg-font-size">The offer, the proof, and a way to write. One primary action.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"className":"cds-cluster"} -->
			<div class="wp-block-buttons cds-cluster">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#contact">Start a conversation</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:image {"linkDestination":"none"} -->
		<figure class="wp-block-image"><img src="<?php echo $cds_media_hero; ?>" alt="A bright room"/></figure>
		<!-- /wp:image -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-6"}}},"backgroundColor":"paper-deep","layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignfull has-paper-deep-background-color has-background" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:group {"className":"is-style-cds-switcher","layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-cds-switcher">
		<!-- wp:group {"className":"is-style-cds-copy","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group is-style-cds-copy">
			<!-- wp:paragraph {"className":"is-style-cds-pill"} -->
			<p class="is-style-cds-pill">What they leave with</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
			<h2 class="wp-block-heading has-display-sm-font-size">A named offer</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Say what the work is, who it is for, and what they leave with. One paragraph is enough.</p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"className":"cds-icon-list","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-icon-list">
				<!-- wp:group {"className":"cds-icon-row cds-icon-row--line","layout":{"type":"default"}} -->
				<div class="wp-block-group cds-icon-row cds-icon-row--line">
					<!-- wp:html -->
					<span class="cds-icon-tile"><span class="cds-icon cds-icon--check" aria-hidden="true"></span></span>
					<!-- /wp:html -->

					<!-- wp:paragraph -->
					<p>A name for the work</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"className":"cds-icon-row cds-icon-row--line","layout":{"type":"default"}} -->
				<div class="wp-block-group cds-icon-row cds-icon-row--line">
					<!-- wp:html -->
					<span class="cds-icon-tile"><span class="cds-icon cds-icon--check" aria-hidden="true"></span></span>
					<!-- /wp:html -->

					<!-- wp:paragraph -->
					<p>A date they can hold</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:image {"linkDestination":"none"} -->
		<figure class="wp-block-image"><img src="<?php echo $cds_media_split; ?>" alt="A desk by a window"/></figure>
		<!-- /wp:image -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:group {"className":"is-style-cds-switcher","layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-cds-switcher">
		<!-- wp:image {"linkDestination":"none"} -->
		<figure class="wp-block-image"><img src="<?php echo $cds_media_hero; ?>" alt="A chair in the same room"/></figure>
		<!-- /wp:image -->

		<!-- wp:group {"className":"is-style-cds-copy","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
		<div class="wp-block-group is-style-cds-copy">
			<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
			<h2 class="wp-block-heading has-display-sm-font-size">A number you can check</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>The metric sits on the page. It is not a slide in a deck.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"cds-display cds-display--lg"} -->
			<p class="cds-display cds-display--lg">12</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"cds-meta"} -->
			<p class="cds-meta">Weeks, on the page</p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"className":"cds-icon-row cds-icon-row--line","layout":{"type":"default"}} -->
			<div class="wp-block-group cds-icon-row cds-icon-row--line">
				<!-- wp:html -->
				<span class="cds-icon-tile"><span class="cds-icon cds-icon--chart" aria-hidden="true"></span></span>
				<!-- /wp:html -->

				<!-- wp:paragraph -->
				<p>Open the notes and it matches.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","className":"is-style-cds-dark cds-copy","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-7","bottom":"var:preset|spacing|space-7"},"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"40rem"}} -->
<div class="wp-block-group alignfull is-style-cds-dark cds-copy" style="padding-top:var(--wp--preset--spacing--space-7);padding-bottom:var(--wp--preset--spacing--space-7)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">The work between the calls</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>Notes, a next step, and one person who answers. That is the third row. It does not need a picture.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-7","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-7);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:heading {"textAlign":"center","level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-text-align-center has-display-sm-font-size">Questions that come up</h2>
	<!-- /wp:heading -->

	<!-- wp:columns -->
	<div class="wp-block-columns">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">How long is a session?</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Fifty minutes. The notes arrive the same day.</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Do I need a team?</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>No. The page is written for one person doing the work.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">What do I bring?</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>The offer as it stands, and the number you are watching.</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Can this wait?</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Write first. The call is for the part you cannot see alone.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:group {"className":"is-style-cds-panel","layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-cds-panel">
		<!-- wp:html -->
		<p class="cds-badge-host"><span class="cds-avatar" aria-hidden="true">AK</span> <strong>Alex Kim</strong></p>
		<!-- /wp:html -->

		<!-- wp:paragraph -->
		<p>If the questions above are not yours, write the one that is.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"is-style-cds-outline"} -->
			<div class="wp-block-button is-style-cds-outline"><a class="wp-block-button__link wp-element-button" href="#contact">Ask a question</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-7","bottom":"var:preset|spacing|space-7"}}},"backgroundColor":"paper-deep","layout":{"type":"constrained","contentSize":"60rem"}} -->
<div id="contact" class="wp-block-group alignfull has-paper-deep-background-color has-background" style="padding-top:var(--wp--preset--spacing--space-7);padding-bottom:var(--wp--preset--spacing--space-7)">
	<!-- wp:group {"className":"is-style-cds-switcher","layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-cds-switcher">
		<!-- wp:group {"className":"cds-icon-list","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-icon-list">
			<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
			<h2 class="wp-block-heading has-display-sm-font-size">What you get</h2>
			<!-- /wp:heading -->

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
					<p>One person answers. The page says who.</p>
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
					<h3 class="wp-block-heading">A number</h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p>You can check it without opening another tool.</p>
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
					<h3 class="wp-block-heading">A next step</h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p>The form is the action. It does not send from this sample.</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:html -->
		<form class="cds-form" action="#" method="post">
			<div class="cds-field">
				<label for="cds-studio-name">Name</label>
				<input class="cds-input" id="cds-studio-name" name="name" type="text" autocomplete="name" required>
			</div>
			<div class="cds-field">
				<label for="cds-studio-email">Email</label>
				<input class="cds-input" id="cds-studio-email" name="email" type="email" autocomplete="email" required>
			</div>
			<div class="cds-field">
				<label for="cds-studio-note">What should we look at?</label>
				<textarea class="cds-textarea" id="cds-studio-note" name="note" rows="4"></textarea>
			</div>
			<button class="cds-btn cds-btn--primary" type="submit">Send</button>
		</form>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->

	<!-- wp:paragraph {"align":"center","className":"cds-meta"} -->
	<p class="has-text-align-center cds-meta">As seen in</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"className":"cds-logo-row","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-logo-row">
		<!-- wp:image {"linkDestination":"none","className":"cds-logo-row__mark is-style-cds-original"} -->
		<figure class="wp-block-image cds-logo-row__mark is-style-cds-original"><img src="<?php echo $cds_media_mark; ?>" alt=""/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"linkDestination":"none","className":"cds-logo-row__mark is-style-cds-original"} -->
		<figure class="wp-block-image cds-logo-row__mark is-style-cds-original"><img src="<?php echo $cds_media_mark; ?>" alt=""/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"linkDestination":"none","className":"cds-logo-row__mark is-style-cds-original"} -->
		<figure class="wp-block-image cds-logo-row__mark is-style-cds-original"><img src="<?php echo $cds_media_mark; ?>" alt=""/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"linkDestination":"none","className":"cds-logo-row__mark is-style-cds-original"} -->
		<figure class="wp-block-image cds-logo-row__mark is-style-cds-original"><img src="<?php echo $cds_media_mark; ?>" alt=""/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"linkDestination":"none","className":"cds-logo-row__mark is-style-cds-original"} -->
		<figure class="wp-block-image cds-logo-row__mark is-style-cds-original"><img src="<?php echo $cds_media_mark; ?>" alt=""/></figure>
		<!-- /wp:image -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
