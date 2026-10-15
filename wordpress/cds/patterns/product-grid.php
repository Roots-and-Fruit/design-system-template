<?php
/**
 * Title: Product grid
 * Slug: cds/product-grid
 * Categories: cds
 * Inserter: true
 * Description: A piece inside a section. Not a page job.
 */
?>
<!-- wp:group {"className":"cds-tile-row","layout":{"type":"default"}} -->
<div class="wp-block-group cds-tile-row">
<!-- wp:group {"className":"cds-product","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-product">
<!-- wp:group {"className":"cds-media","layout":{"type":"default"}} -->
<div class="wp-block-group cds-media">
<!-- wp:image {"linkDestination":"none","className":"cds-product__photo"} -->
<figure class="wp-block-image cds-product__photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) ); ?>" alt="Side chair"/></figure>
<!-- /wp:image -->

<!-- wp:html -->
<span class="cds-badge">Sale</span>
<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Side chair</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cds-price"} -->
<p class="cds-price"><s>$159</s> $89</p>
<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-product","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-product">
<!-- wp:group {"className":"cds-media","layout":{"type":"default"}} -->
<div class="wp-block-group cds-media">
<!-- wp:image {"linkDestination":"none","className":"cds-product__photo"} -->
<figure class="wp-block-image cds-product__photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-2.jpg' ) ); ?>" alt="Floor lamp"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Floor lamp</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cds-price"} -->
<p class="cds-price">$120</p>
<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-product","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-product">
<!-- wp:group {"className":"cds-media","layout":{"type":"default"}} -->
<div class="wp-block-group cds-media">
<!-- wp:image {"linkDestination":"none","className":"cds-product__photo"} -->
<figure class="wp-block-image cds-product__photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-3.jpg' ) ); ?>" alt="Oak stool"/></figure>
<!-- /wp:image -->

<!-- wp:html -->
<span class="cds-badge">Sale</span>
<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Oak stool</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cds-price"} -->
<p class="cds-price"><s>$80</s> $64</p>
<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->

<!-- wp:group {"className":"cds-product","tagName":"article","layout":{"type":"default"}} -->
<article class="wp-block-group cds-product">
<!-- wp:group {"className":"cds-media","layout":{"type":"default"}} -->
<div class="wp-block-group cds-media">
<!-- wp:image {"linkDestination":"none","className":"cds-product__photo"} -->
<figure class="wp-block-image cds-product__photo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/split.jpg' ) ); ?>" alt="Wool throw"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Wool throw</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cds-price"} -->
<p class="cds-price">$48</p>
<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
