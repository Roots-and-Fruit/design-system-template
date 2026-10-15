<?php
/**
 * Title: Search
 * Slug: cds/search
 * Categories: cds
 * Inserter: true
 * Description: A piece inside a section. Not a page job.
 */
?>
<!-- wp:html -->
<form class="cds-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="cds-field">
		<label for="cds-search-q">Search</label>
		<div class="cds-search__row">
			<input class="cds-input" id="cds-search-q" type="search" name="s" placeholder="What are you looking for?" />
			<button type="submit" class="cds-btn cds-btn--primary">Search</button>
		</div>
	</div>
</form>
<!-- /wp:html -->

<!-- wp:html -->
<div class="cds-cluster">
	<span class="cds-meta">Topics</span>
	<a class="cds-pill" href="#notes">Notes</a>
	<a class="cds-pill" href="#proof">Proof</a>
	<a class="cds-pill" href="#type">Type</a>
</div>
<!-- /wp:html -->
