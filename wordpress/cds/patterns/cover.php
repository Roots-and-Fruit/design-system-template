<?php
/**
 * Title: Cover
 * Slug: cds/cover
 * Categories: cds
 * Inserter: true
 * Description: A piece inside a section. Not a page job.
 */
?>
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
