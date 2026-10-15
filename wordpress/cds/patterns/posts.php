<?php
/**
 * Title: Post cards
 * Slug: cds/posts
 * Categories: cds
 * Inserter: true
 * Description: A piece inside a section. Not a page job.
 */
?>
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
