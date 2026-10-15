/**
 * Pieces the compiler projects into the inserter.
 * Icons are mask classes, not inline SVG (kses strips SVG in post content).
 * These sit inside a section job. They are not a ninth page section.
 */
import { buttonCluster, reviewCard } from "./block-snippets.mjs";
import {
  bentoPattern,
  episodesPattern,
  factsPattern,
  factsPlainPattern,
  galleryPattern,
  peoplePattern,
  postsPattern,
  searchPattern,
  shotsPattern,
  statsPattern,
  stepsPattern,
  stepsYearsPattern,
  tabsPattern,
} from "./pattern-organisms.mjs";

function themeFile(path) {
  return `<?php echo esc_url( get_theme_file_uri( '${path}' ) ); ?>`;
}

function icon(name) {
  return `<span class="cds-icon cds-icon--${name}" aria-hidden="true"></span>`;
}

function html(inner) {
  return `<!-- wp:html -->
${inner}
<!-- /wp:html -->`;
}

function heading(level, text, className = "") {
  const attr = className ? ` {"level":${level},"className":"${className}"}` : ` {"level":${level}}`;
  const cls = className ? ` ${className}` : "";
  return `<!-- wp:heading${attr} -->
<h${level} class="wp-block-heading${cls}">${text}</h${level}>
<!-- /wp:heading -->`;
}

function paragraph(text, className = "") {
  const attr = className ? ` {"className":"${className}"}` : "";
  const cls = className ? ` class="${className}"` : "";
  return `<!-- wp:paragraph${attr} -->
<p${cls}>${text}</p>
<!-- /wp:paragraph -->`;
}

function group(className, inner, { tag = "div" } = {}) {
  const tagAttr = tag === "div" ? "" : `,"tagName":"${tag}"`;
  return `<!-- wp:group {"className":"${className}"${tagAttr},"layout":{"type":"default"}} -->
<${tag} class="wp-block-group ${className}">
${inner}
</${tag}>
<!-- /wp:group -->`;
}

function image(file, className, alt) {
  const src = themeFile(`assets/media/${file}`);
  return `<!-- wp:image {"linkDestination":"none","className":"${className}"} -->
<figure class="wp-block-image ${className}"><img src="${src}" alt="${alt}"/></figure>
<!-- /wp:image -->`;
}

function specimen(title, note, inner) {
  return group("cds-part", `${heading(2, title)}\n\n${paragraph(note)}\n\n${inner}`);
}

function iconCard({ name, title, text, badge = "" }) {
  const badgeBlock = badge
    ? `${paragraph(`<span class="cds-badge">${badge}</span>`, "cds-badge-host")}\n\n`
    : "";
  return group(
    "cds-card",
    `${html(`<span class="cds-icon-tile">${icon(name)}</span>`)}\n\n${badgeBlock}${heading(3, title, "cds-card__title")}\n\n${paragraph(text)}`,
    { tag: "article" },
  );
}

const ICON_CARDS = [
  { name: "users", title: "People", text: "Who it is for, in one line.", badge: "New" },
  { name: "chart", title: "Proof", text: "The number a reader can check." },
  { name: "tag", title: "Offer", text: "What they walk away with." },
];

const ICON_ROWS = [
  ["users", "A named owner", "One person is accountable for the page."],
  ["chart", "A number you can check", "The metric sits on the page."],
  ["check", "A clear next step", "The reader knows what to do this week."],
];

export function iconCardPattern() {
  return iconCard(ICON_CARDS[0]);
}

export function iconCardsPattern() {
  return group("cds-tile-row", ICON_CARDS.map((card) => iconCard(card)).join("\n\n"));
}

function iconRow(name, title, text) {
  return group(
    "cds-icon-row",
    `${html(`<span class="cds-icon-tile">${icon(name)}</span>`)}\n\n${group(
      "cds-icon-row__copy",
      `${heading(3, title)}\n\n${paragraph(text)}`,
    )}`,
  );
}

export function iconListPattern() {
  return group(
    "cds-icon-list",
    ICON_ROWS.map(([name, title, text]) => iconRow(name, title, text)).join("\n\n"),
  );
}

function chip(name, title, text) {
  return html(
    `<p class="cds-chip cds-chip--float">${icon(name)}<span><strong>${title}</strong><span>${text}</span></span></p>`,
  );
}

function cover({ file, alt, title, lede, className, extra = "" }) {
  return group(
    className,
    `${image(file, "cds-cover__media", alt)}\n\n${group(
      "cds-cover__scrim",
      `${extra}${heading(2, title)}\n\n${lede ? paragraph(lede) : ""}`,
    )}`,
  );
}

export function coverPattern() {
  return cover({
    file: "hero.jpg",
    alt: "A chair in a bright room",
    title: "Type on the photo",
    lede: "The paper hero stays a Switcher. This is the still frame.",
    className: "cds-cover",
    extra: `${chip("truck", "Ships fast", "In two days")}\n\n`,
  });
}

export function videoCardPattern() {
  const play = html(
    `<a class="cds-play" href="#cds-video-dialog" data-cds-dialog-open="cds-video-dialog" aria-label="Play the film">${icon("play")}</a>`,
  );
  const dialog = html(`<dialog class="cds-dialog" id="cds-video-dialog" aria-labelledby="cds-video-title">
	<h2 id="cds-video-title">The film</h2>
	<p>Replace this with your player. One dialog per page.</p>
	<form method="dialog"><button class="cds-btn cds-btn--outline" type="submit">Close</button></form>
</dialog>`);
  return `${cover({
    file: "callout.jpg",
    alt: "A still from the film",
    title: "Watch the walkthrough",
    lede: "The play control opens a dialog.",
    className: "cds-cover cds-video",
    extra: `${play}\n\n`,
  })}\n\n${dialog}`;
}

export function logoRowPattern() {
  const mark = themeFile("assets/mark.svg");
  const marks = Array.from({ length: 5 }, () => {
    return `<!-- wp:image {"linkDestination":"none","className":"cds-logo-row__mark is-style-cds-original"} -->
<figure class="wp-block-image cds-logo-row__mark is-style-cds-original"><img src="${mark}" alt=""/></figure>
<!-- /wp:image -->`;
  }).join("\n\n");
  return `${paragraph("As seen in", "cds-meta")}\n\n${group("cds-logo-row", marks)}`;
}

function productCard({ file, name, price, compare = "", badge = "" }) {
  const badgeBlock = badge ? `\n\n${html(`<span class="cds-badge">${badge}</span>`)}` : "";
  const priceText = compare ? `<s>${compare}</s> ${price}` : price;
  return group(
    "cds-product",
    `${group("cds-media", `${image(file, "cds-product__photo", name)}${badgeBlock}`)}\n\n${heading(3, name)}\n\n${paragraph(priceText, "cds-price")}`,
    { tag: "article" },
  );
}

const PRODUCTS = [
  { file: "card-1.jpg", name: "Side chair", price: "$89", compare: "$159", badge: "Sale" },
  { file: "card-2.jpg", name: "Floor lamp", price: "$120" },
  { file: "card-3.jpg", name: "Oak stool", price: "$64", compare: "$80", badge: "Sale" },
  { file: "split.jpg", name: "Wool throw", price: "$48" },
];

export function productGridPattern() {
  return group("cds-tile-row", PRODUCTS.map((item) => productCard(item)).join("\n\n"));
}

function categoryTile(file, label) {
  return group(
    "cds-cover cds-category",
    `${image(file, "cds-cover__media", label)}\n\n${group("cds-cover__scrim", heading(3, label))}`,
  );
}

export function categoryRowPattern() {
  const tiles = [
    ["card-1.jpg", "Seating"],
    ["card-2.jpg", "Lighting"],
    ["callout.jpg", "Textiles"],
  ];
  return group("cds-tile-row", tiles.map(([file, label]) => categoryTile(file, label)).join("\n\n"));
}

export function contactFormPattern() {
  return html(`<form class="cds-form" action="#" method="post">
	<div class="cds-field">
		<label for="cds-contact-name">Name</label>
		<input class="cds-input" id="cds-contact-name" name="name" type="text" autocomplete="name" required>
	</div>
	<div class="cds-field">
		<label for="cds-contact-email">Email</label>
		<input class="cds-input" id="cds-contact-email" name="email" type="email" autocomplete="email" required>
	</div>
	<div class="cds-field">
		<label for="cds-contact-note">Message</label>
		<textarea class="cds-textarea" id="cds-contact-note" name="note" rows="4"></textarea>
	</div>
	<button class="cds-btn cds-btn--primary" type="submit">Send</button>
	<p class="cds-hint">This sample does not send. Point it at your form.</p>
</form>`);
}

export function avatarsPattern() {
  return html(`<div class="cds-avatars" aria-hidden="true"><span class="cds-avatar">AK</span><span class="cds-avatar">JL</span><span class="cds-avatar">MR</span></div>`);
}

export function subscribePattern() {
  return group(
    "cds-subscribe",
    `${avatarsPattern()}\n\n${heading(3, "Join the list")}\n\n${paragraph("A short note on what arrives, and how often.")}\n\n${html(`<form class="cds-form cds-form--inline" action="#" method="post">
	<div class="cds-field">
		<label for="cds-subscribe-email">Email</label>
		<input class="cds-input" id="cds-subscribe-email" name="email" type="email" autocomplete="email" placeholder="you@example.com" required>
	</div>
	<button class="cds-btn cds-btn--primary" type="submit">Join</button>
</form>`)}`,
  );
}

export function iconLinksPattern() {
  return html(`<div class="cds-cluster">
	<a class="cds-icon-link" href="#" aria-label="Email">${icon("mail")}</a>
	<a class="cds-icon-link" href="#" aria-label="Next">${icon("arrow")}</a>
	<a class="cds-icon-link" href="#" aria-label="People">${icon("users")}</a>
</div>`);
}

export function reelPattern() {
  const cards = [
    reviewCard(),
    reviewCard({
      title: "Worth the setup",
      body: "The row holds. We did not add a slider.",
      name: "Jordan Lee",
      date: "March 2, 2026",
      datetime: "2026-03-02",
      score: 5,
    }),
    reviewCard({
      title: "The grid held",
      body: "Three reviews, then the next one peeks in.",
      name: "Mina Ortiz",
      date: "April 9, 2026",
      datetime: "2026-04-09",
      score: 5,
    }),
  ];
  return group("cds-reel", cards.join("\n\n"));
}

function linkColumn(title, links) {
  const items = links
    .map(
      (label) => `<!-- wp:list-item -->
<li><a href="#">${label}</a></li>
<!-- /wp:list-item -->`,
    )
    .join("\n\n");
  return `<!-- wp:column -->
<div class="wp-block-column">
	<!-- wp:paragraph {"className":"cds-meta"} -->
	<p class="cds-meta">${title}</p>
	<!-- /wp:paragraph -->

	<!-- wp:list {"className":"cds-footer-cta__links"} -->
	<ul class="wp-block-list cds-footer-cta__links">
		${items}
	</ul>
	<!-- /wp:list -->
</div>
<!-- /wp:column -->`;
}

export function footerCtaPattern() {
  const columns = [
    ["Work", ["Offers", "Pricing", "Stories"]],
    ["Studio", ["About", "Method", "Contact"]],
    ["Notes", ["Journal", "Guides", "Updates"]],
    ["Visit", ["Privacy", "Terms", "Imprint"]],
  ]
    .map(([title, links]) => linkColumn(title, links))
    .join("\n\n");
  return group(
    "cds-footer-cta",
    `${group(
      "cds-footer-cta__bar",
      `${group(
        "cds-footer-cta__invite",
        `${heading(2, "Ready when you are")}\n\n${paragraph("A short line under the invitation.")}`,
      )}\n\n${buttonCluster([{ classes: "cds-btn cds-btn--primary", href: "#start", label: "Get started" }])}`,
    )}\n\n<!-- wp:columns -->
<div class="wp-block-columns">
${columns}
</div>
<!-- /wp:columns -->`,
  );
}

export function partsPattern() {
  return [
    specimen("Icon card", "A tile, a title, and one line. The badge sits inline.", iconCardsPattern()),
    specimen("Icon row", "The same tile, beside a title and one line.", iconListPattern()),
    specimen("Cover", "Photo, scrim, and a chip. The paper hero is unchanged.", coverPattern()),
    specimen("Video card", "A play control on the cover opens the dialog.", videoCardPattern()),
    specimen("Logo row", "Replace the marks with sponsor logos.", logoRowPattern()),
    specimen("Product card", "Frame, corner badge, name, and a compare-at price.", productGridPattern()),
    specimen("Category tile", "A square cover with a label.", categoryRowPattern()),
    specimen("Contact form", "Stacked fields. This sample does not send.", contactFormPattern()),
    specimen("Subscribe", "Avatars plus an inline email and button.", subscribePattern()),
    specimen("Icon link", "A tile that is a link.", iconLinksPattern()),
    specimen("Reel", "Scroll the row. The review grid stays the default.", reelPattern()),
    specimen("Folder tabs", "The active tab shares its bottom edge with the panel.", tabsPattern()),
    specimen("Gallery", "Arrows come in on hover. Open uses the same pictures.", galleryPattern()),
    specimen("Post cards", "Image, category, title, one line, date.", postsPattern()),
    specimen(
      "Fact list",
      "A title bar is the download card. Leave the title off for case-study meta.",
      group("cds-cluster cds-facts-pair", `${factsPattern()}\n\n${factsPlainPattern()}`),
    ),
    specimen("Stat row", "Four figures, equal and centered, on the dark band.", statsPattern()),
    specimen("Episode row", "A square cover and one play button.", episodesPattern()),
    specimen("Steps", "A mark on the left. The mark is a step number or a year.", `${stepsPattern()}\n\n${stepsYearsPattern()}`),
    specimen("People", "A square slot, a name, a role.", peoplePattern()),
    specimen("Photo cluster", "One lead picture and two smaller ones.", shotsPattern()),
    specimen("Bento", "Three equal cells, then two that share the row.", bentoPattern()),
    specimen("Search", "The label stays above the field. Topic chips are links.", searchPattern()),
    specimen("Footer with a call to action", "An inserter pattern. The site footer is unchanged.", footerCtaPattern()),
  ].join("\n\n");
}
