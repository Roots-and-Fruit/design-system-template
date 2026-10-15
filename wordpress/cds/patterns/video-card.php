<?php
/**
 * Title: Video card
 * Slug: cds/video-card
 * Categories: cds
 * Inserter: true
 * Description: A piece inside a section. Not a page job.
 */
?>
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
