<?php
/**
 * Title: Subscribe
 * Slug: cds/subscribe
 * Categories: cds
 * Inserter: true
 * Description: A piece inside a section. Not a page job.
 */
?>
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
