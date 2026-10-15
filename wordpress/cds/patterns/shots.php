<?php
/**
 * Title: Photo cluster
 * Slug: cds/shots
 * Categories: cds
 * Inserter: true
 * Description: A piece inside a section. Not a page job.
 */
?>
<!-- wp:group {"className":"cds-shots","layout":{"type":"default"}} -->
<div class="wp-block-group cds-shots">
<!-- wp:image {"linkDestination":"none","className":"cds-shots__lead"} -->
<figure class="wp-block-image cds-shots__lead"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/hero.jpg' ) ); ?>" alt="A ridge in warm light"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"cds-shots__side","layout":{"type":"default"}} -->
<div class="wp-block-group cds-shots__side">
<!-- wp:image {"linkDestination":"none","className":""} -->
<figure class="wp-block-image "><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) ); ?>" alt="A path through trees"/></figure>
<!-- /wp:image -->

<!-- wp:image {"linkDestination":"none","className":""} -->
<figure class="wp-block-image "><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-3.jpg' ) ); ?>" alt="A city street at sunrise"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
