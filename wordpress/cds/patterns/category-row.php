<?php
/**
 * Title: Category tiles
 * Slug: cds/category-row
 * Categories: cds
 * Inserter: true
 * Description: A piece inside a section. Not a page job.
 */
?>
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
