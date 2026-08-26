<?php
/**
 * Title: Article
 * Slug: cds/article
 * Categories: cds
 * Description: Eyebrow, lede, measured prose, one CTA. Post title stays in the template.
 * Block Types: core/post-content
 * Post Types: post
 * Viewport Width: 720
 */
?>
<!-- wp:paragraph {"fontSize":"meta","textColor":"ink-muted"} -->
<p class="has-ink-muted-color has-text-color has-meta-font-size">Essay</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"body-lg"} -->
<p class="has-body-lg-font-size">One sentence that says what this piece is, and why someone should keep going.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cds-prose","layout":{"type":"constrained"}} -->
<div class="wp-block-group cds-prose">
	<!-- wp:paragraph -->
	<p>Body copy uses the measured column. Authors compose from presets. They do not pick a new hex or a new type size.</p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph -->
	<p>Keep the article on paper. One primary action at the end is enough.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
	<!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Keep reading</a></div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
