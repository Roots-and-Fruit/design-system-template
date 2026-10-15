<?php
/**
 * Title: Episode row
 * Slug: cds/episodes
 * Categories: cds
 * Inserter: true
 * Description: A piece inside a section. Not a page job.
 */
?>
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
