<?php
/**
 * Title: Download layout
 * Slug: cds/layout-download
 * Categories: cds
 * Description: Peachy Plugin. The plugin facts, what it does, how to install it, the changelog, and common questions.
 * Post Types: page
 * Viewport Width: 960
 */
$cds_branch  = esc_url( get_theme_file_uri( 'assets/media/peach-branch.jpg' ) );
$cds_rows    = esc_url( get_theme_file_uri( 'assets/media/peach-rows.jpg' ) );
$cds_half    = esc_url( get_theme_file_uri( 'assets/media/peach-half.jpg' ) );
$cds_crate   = esc_url( get_theme_file_uri( 'assets/media/peach-crate.jpg' ) );
$cds_morning = esc_url( get_theme_file_uri( 'assets/media/peach-morning.jpg' ) );
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-7","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-7);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:group {"className":"is-style-cds-switcher","layout":{"type":"default"}} -->
	<div class="wp-block-group is-style-cds-switcher">
		<!-- wp:group {"className":"is-style-cds-copy","layout":{"type":"default"}} -->
		<div class="wp-block-group is-style-cds-copy">
			<!-- wp:paragraph {"className":"is-style-cds-pill"} -->
			<p class="is-style-cds-pill">WordPress plugin</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"fontSize":"display-xl"} -->
			<h1 class="wp-block-heading has-display-xl-font-size">Peachy Plugin</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"cds-lede"} -->
			<p class="cds-lede">One product on the page, an email when someone orders, and a zip you install from Plugins. This is version 1.4.2.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons"><!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#features">Download 1.4.2</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:html -->
		<div class="cds-facts">
			<p class="cds-facts__title">Plugin details</p>
			<dl>
				<div><dt>Version</dt><dd>1.4.2</dd></div>
				<div><dt>Requires WordPress</dt><dd>6.4 or newer</dd></div>
				<div><dt>Tested up to</dt><dd>6.8</dd></div>
				<div><dt>Requires PHP</dt><dd>7.4 or newer</dd></div>
				<div><dt>License</dt><dd>GPL-2.0-or-later</dd></div>
			</dl>
		</div>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" id="features" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">What it does</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"cds-bento","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-bento">
		<!-- wp:group {"tagName":"article","className":"cds-card","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-card">
			<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
			<h3 class="wp-block-heading cds-card__title">Product block</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>Name, price, and one button. That is the whole product.</p>
			<!-- /wp:paragraph -->
			<!-- wp:image {"linkDestination":"none"} -->
			<figure class="wp-block-image"><img src="<?php echo $cds_branch; ?>" alt="Ripe peaches on a branch"/></figure>
			<!-- /wp:image -->
		</article>
		<!-- /wp:group -->
		<!-- wp:group {"tagName":"article","className":"cds-card","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-card">
			<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
			<h3 class="wp-block-heading cds-card__title">Order note</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>The order arrives at the address in Settings, General. No second inbox.</p>
			<!-- /wp:paragraph -->
			<!-- wp:image {"linkDestination":"none"} -->
			<figure class="wp-block-image"><img src="<?php echo $cds_rows; ?>" alt="Rows of peach trees in an orchard"/></figure>
			<!-- /wp:image -->
		</article>
		<!-- /wp:group -->
		<!-- wp:group {"tagName":"article","className":"cds-card","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-card">
			<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
			<h3 class="wp-block-heading cds-card__title">Stock count</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>A number on the block. It drops by one when an order lands.</p>
			<!-- /wp:paragraph -->
			<!-- wp:image {"linkDestination":"none"} -->
			<figure class="wp-block-image"><img src="<?php echo $cds_half; ?>" alt="A peach cut in half on a wooden table"/></figure>
			<!-- /wp:image -->
		</article>
		<!-- /wp:group -->
		<!-- wp:group {"tagName":"article","className":"cds-card cds-bento__wide","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-card cds-bento__wide">
			<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
			<h3 class="wp-block-heading cds-card__title">Season dates</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>Set a start and an end. The block hides outside that range.</p>
			<!-- /wp:paragraph -->
			<!-- wp:image {"linkDestination":"none"} -->
			<figure class="wp-block-image"><img src="<?php echo $cds_crate; ?>" alt="A crate of peaches at the edge of an orchard"/></figure>
			<!-- /wp:image -->
		</article>
		<!-- /wp:group -->
		<!-- wp:group {"tagName":"article","className":"cds-card cds-bento__wide","layout":{"type":"default"}} -->
		<article class="wp-block-group cds-card cds-bento__wide">
			<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
			<h3 class="wp-block-heading cds-card__title">Receipt</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>The buyer gets a short email with the product name, the price, and the site name.</p>
			<!-- /wp:paragraph -->
			<!-- wp:image {"linkDestination":"none"} -->
			<figure class="wp-block-image"><img src="<?php echo $cds_morning; ?>" alt="A peach orchard in the morning mist"/></figure>
			<!-- /wp:image -->
		</article>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Install it</h2>
	<!-- /wp:heading -->

	<!-- wp:html -->
	<ol class="cds-steps">
		<li class="cds-step"><p class="cds-step__mark">01</p><div><h3 class="cds-step__title">Upload the zip</h3><p>Plugins, Add New, Upload Plugin. Choose the Peachy zip.</p></div></li>
		<li class="cds-step"><p class="cds-step__mark">02</p><div><h3 class="cds-step__title">Activate</h3><p>Peachy adds one block. It does not add a menu of its own.</p></div></li>
		<li class="cds-step"><p class="cds-step__mark">03</p><div><h3 class="cds-step__title">Add the product block</h3><p>On the page that sells the thing. Fill in the name, the price, and the season.</p></div></li>
	</ol>
	<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-6"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-6)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Changelog</h2>
	<!-- /wp:heading -->

	<!-- wp:html -->
	<div class="cds-stack">
		<article>
			<p class="cds-meta">1.4.2 · 12 May 2026</p>
			<p>The stock count stays correct when two orders land together.</p>
		</article>
		<article>
			<p class="cds-meta">1.4.0 · 2 April 2026</p>
			<p>Season dates. The product block hides outside the range you set.</p>
		</article>
		<article>
			<p class="cds-meta">1.3.1 · 18 March 2026</p>
			<p>The receipt uses the site name, not the word WordPress.</p>
		</article>
	</div>
	<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|space-6","bottom":"var:preset|spacing|space-7"}}},"layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--space-6);padding-bottom:var(--wp--preset--spacing--space-7)">
	<!-- wp:heading {"level":2,"fontSize":"display-sm"} -->
	<h2 class="wp-block-heading has-display-sm-font-size">Questions</h2>
	<!-- /wp:heading -->

	<!-- wp:html -->
	<div class="cds-stack">
		<details class="cds-details">
			<summary>Does Peachy need WooCommerce?</summary>
			<p>No. One product and one email. Leave WooCommerce out.</p>
		</details>
		<details class="cds-details">
			<summary>Which WordPress versions does it support?</summary>
			<p>WordPress 6.4 or newer. It is tested on 6.8.</p>
		</details>
		<details class="cds-details">
			<summary>Which PHP versions does it support?</summary>
			<p>PHP 7.4 or newer.</p>
		</details>
		<details class="cds-details">
			<summary>Can I use it on more than one site?</summary>
			<p>Yes. The license is GPL-2.0-or-later.</p>
		</details>
	</div>
	<!-- /wp:html -->
</div>
<!-- /wp:group -->
