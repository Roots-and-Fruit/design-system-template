/**
 * Block markup the kit already knows how to space.
 * Patterns call these. Do not copy the tags by hand.
 *
 * A hero stack is .cds-copy. The line under a title is a paragraph, not a heading.
 * Buttons in that stack are .cds-cluster. A raw button in a full-bleed band sits
 * inside a block, or WordPress parks it on the window edge.
 */

export function buttonLink({ classes, href, label }) {
  const hrefAttr = href ? ` href="${href}"` : "";
  return `<!-- wp:button {"className":"${classes}"} -->
<div class="wp-block-button ${classes}"><a class="wp-block-button__link wp-element-button"${hrefAttr}>${label}</a></div>
<!-- /wp:button -->`;
}

export function buttonCluster(buttons) {
  return `<!-- wp:buttons {"className":"cds-cluster"} -->
<div class="wp-block-buttons cds-cluster">
${buttons.map((button) => buttonLink(button)).join("\n\n")}
</div>
<!-- /wp:buttons -->`;
}

export function pageHero({
  postTitle = false,
  title = "",
  subtitle = "",
  lede,
  buttons,
}) {
  const titleBlock = postTitle
    ? `<!-- wp:post-title {"level":1,"className":"cds-display cds-display--lg"} /-->`
    : `<!-- wp:heading {"level":1,"className":"cds-display cds-display--lg"} -->
<h1 class="wp-block-heading cds-display cds-display--lg">${title}</h1>
<!-- /wp:heading -->`;
  const subtitleBlock = subtitle
    ? `<!-- wp:paragraph {"className":"cds-display cds-display--md"} -->
<p class="cds-display cds-display--md">${subtitle}</p>
<!-- /wp:paragraph -->`
    : "";
  const parts = [
    titleBlock,
    subtitleBlock,
    `<!-- wp:paragraph {"className":"cds-lede"} -->
<p class="cds-lede">${lede}</p>
<!-- /wp:paragraph -->`,
    buttonCluster(buttons),
  ].filter(Boolean);
  return `<!-- wp:group {"align":"wide","className":"page-hero cds-copy","layout":{"type":"constrained","contentSize":"60rem"}} -->
<div class="wp-block-group alignwide page-hero cds-copy">
${parts.join("\n\n")}
</div>
<!-- /wp:group -->`;
}

export function offer({
  modifier = "",
  eyebrow,
  title,
  lede,
  items,
  amount,
  cadence,
  href,
  portrait,
  quote,
  by,
}) {
  const classes = ["cds-offer", modifier].filter(Boolean).join(" ");
  const itemsHtml = items
    .map(
      (item) => `<!-- wp:list-item -->
<li>${item}</li>
<!-- /wp:list-item -->`,
    )
    .join("\n\n");
  return `<!-- wp:group {"className":"${classes}","layout":{"type":"default"}} -->
<div class="wp-block-group ${classes}">
	<!-- wp:group {"className":"cds-offer__main","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-offer__main">
		<!-- wp:paragraph {"className":"cds-offer__eyebrow"} -->
		<p class="cds-offer__eyebrow">${eyebrow}</p>
		<!-- /wp:paragraph -->

		<!-- wp:group {"className":"cds-offer__copy","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-offer__copy">
			<!-- wp:heading {"level":3,"className":"cds-offer__title"} -->
			<h3 class="wp-block-heading cds-offer__title">${title}</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"cds-offer__lede"} -->
			<p class="cds-offer__lede">${lede}</p>
			<!-- /wp:paragraph -->

			<!-- wp:list -->
			<ul class="wp-block-list">
${itemsHtml}
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"cds-offer__price","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-offer__price">
			<!-- wp:paragraph {"className":"cds-offer__amount"} -->
			<p class="cds-offer__amount">${amount}</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"cds-offer__cadence"} -->
			<p class="cds-offer__cadence">${cadence}</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
${buttonLink({ classes: "cds-btn cds-btn--primary cds-btn--sm", href, label: "Book a call" })}
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"cds-offer__band","layout":{"type":"default"}} -->
	<div class="wp-block-group cds-offer__band">
		<!-- wp:html -->
		<img class="cds-offer__portrait" src="${portrait}" alt="" width="72" height="72" />
		<!-- /wp:html -->

		<!-- wp:group {"className":"cds-offer__words","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-offer__words">
			<!-- wp:paragraph {"className":"cds-offer__quote"} -->
			<p class="cds-offer__quote">${quote}</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"cds-offer__by"} -->
			<p class="cds-offer__by">${by}</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->`;
}

export function quote({ text, name, role, avatar }) {
  const avatarBlock = avatar
    ? avatar.initials
      ? `<!-- wp:html -->
<span class="cds-avatar cds-quote__avatar" role="img" aria-label="${name}">${avatar.initials}</span>
<!-- /wp:html -->

`
      : `<!-- wp:html -->
<img class="cds-quote__avatar" src="${avatar.src}" alt="" width="${avatar.width}" height="${avatar.height}" />
<!-- /wp:html -->

`
    : "";
  const roleBlock = role
    ? `
		<!-- wp:paragraph {"className":"cds-quote__role"} -->
		<p class="cds-quote__role">${role}</p>
		<!-- /wp:paragraph -->`
    : "";
  return `<!-- wp:group {"align":"wide","tagName":"figure","className":"cds-quote","layout":{"type":"default"}} -->
<figure class="wp-block-group alignwide cds-quote">
	<!-- wp:quote -->
	<blockquote class="wp-block-quote">
		<!-- wp:paragraph -->
		<p>${text}</p>
		<!-- /wp:paragraph -->
	</blockquote>
	<!-- /wp:quote -->

	<!-- wp:group {"tagName":"figcaption","className":"cds-quote__who","layout":{"type":"default"}} -->
	<figcaption class="wp-block-group cds-quote__who">
${avatarBlock}		<!-- wp:group {"className":"cds-quote__id","layout":{"type":"default"}} -->
		<div class="wp-block-group cds-quote__id">
			<!-- wp:paragraph {"className":"cds-quote__name"} -->
			<p class="cds-quote__name">${name}</p>
			<!-- /wp:paragraph -->${roleBlock}
		</div>
		<!-- /wp:group -->
	</figcaption>
	<!-- /wp:group -->
</figure>
<!-- /wp:group -->`;
}

export function reviewCard({
  title = "Clear and quick",
  body = "We shipped the page from the jobs in the catalog. No second theme.",
  name = "Alex Kim",
  date = "January 20, 2026",
  datetime = "2026-01-20",
  score = 4,
} = {}) {
  const stars = Array.from({ length: 5 }, (_, index) => {
    const on = index < score ? " cds-review__star--on" : "";
    return `<span class="cds-review__star${on}"></span>`;
  }).join("");
  return `<!-- wp:group {"tagName":"article","className":"cds-review","layout":{"type":"default"}} -->
<article class="wp-block-group cds-review">
	<!-- wp:html -->
	<p class="cds-review__rating"><span class="cds-review__stars" aria-hidden="true">${stars}</span><span class="cds-review__score"><span>${score}</span> out of <span>5</span></span></p>
	<!-- /wp:html -->

	<!-- wp:heading {"level":3,"className":"cds-review__title"} -->
	<h3 class="wp-block-heading cds-review__title">${title}</h3>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cds-review__body"} -->
	<p class="cds-review__body">${body}</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"tagName":"footer","className":"cds-review__by","layout":{"type":"default"}} -->
	<footer class="wp-block-group cds-review__by">
		<!-- wp:paragraph {"className":"cds-review__name"} -->
		<p class="cds-review__name">${name}</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"cds-review__date"} -->
		<p class="cds-review__date"><time datetime="${datetime}">${date}</time></p>
		<!-- /wp:paragraph -->
	</footer>
	<!-- /wp:group -->
</article>
<!-- /wp:group -->`;
}

export function cardPattern() {
  return `<!-- wp:group {"tagName":"article","className":"cds-card","layout":{"type":"default"}} -->
<article class="wp-block-group cds-card">
	<!-- wp:paragraph {"className":"cds-meta"} -->
	<p class="cds-meta">Note</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":3,"className":"cds-card__title"} -->
	<h3 class="wp-block-heading cds-card__title">A short note</h3>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
	<p>The pattern stays in the editor. The page reads from that same pattern.</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"tagName":"footer","className":"cds-card__foot","layout":{"type":"default"}} -->
	<footer class="wp-block-group cds-card__foot">
		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"cds-btn cds-btn--outline cds-btn--sm"} -->
			<div class="wp-block-button cds-btn cds-btn--outline cds-btn--sm"><a class="wp-block-button__link wp-element-button">Open</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</footer>
	<!-- /wp:group -->
</article>
<!-- /wp:group -->`;
}

export function takeawaysPattern() {
  return `<!-- wp:group {"className":"cds-takeaways","layout":{"type":"default"}} -->
<div class="wp-block-group cds-takeaways">
	<!-- wp:heading {"level":3,"className":"cds-takeaways__title"} -->
	<h3 class="wp-block-heading cds-takeaways__title">Key takeaways</h3>
	<!-- /wp:heading -->

	<!-- wp:list {"ordered":true} -->
	<ol class="wp-block-list">
		<!-- wp:list-item -->
		<li>Lead with one clear action the reader can take this week.</li>
		<!-- /wp:list-item -->

		<!-- wp:list-item -->
		<li>Name the constraint before you name the tactic.</li>
		<!-- /wp:list-item -->

		<!-- wp:list-item -->
		<li>Keep the list short enough to scan without scrolling twice.</li>
		<!-- /wp:list-item -->
	</ol>
	<!-- /wp:list -->
</div>
<!-- /wp:group -->`;
}
