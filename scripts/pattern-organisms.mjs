/**
 * Organisms that landed in the kit after the first piece set.
 * Generated on compile. Not page jobs, and not a ninth section.
 *
 * Tabs, gallery, facts, and steps are one HTML block: Core has no honest
 * object, and the theme script binds the kit markup. The rest are Groups
 * so the words stay editable.
 */
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

export function tabsPattern() {
  return html(`<div class="cds-tabs">
	<div class="cds-tabs__list" role="tablist" aria-label="Settings sections">
		<button type="button" class="cds-tabs__tab is-current" role="tab" data-cds-tab="agents" aria-selected="true">
			<span class="cds-tabs__dot" aria-hidden="true"></span>Agents
		</button>
		<button type="button" class="cds-tabs__tab" role="tab" data-cds-tab="settings" aria-selected="false" tabindex="-1">
			<span class="cds-tabs__dot" aria-hidden="true"></span>Settings
		</button>
		<button type="button" class="cds-tabs__tab" role="tab" data-cds-tab="activity" aria-selected="false" tabindex="-1">
			<span class="cds-tabs__dot" aria-hidden="true"></span>Activity
		</button>
	</div>
	<div class="cds-tabs__panel" role="tabpanel" data-cds-panel="agents"><p>The list of connected accounts.</p></div>
	<div class="cds-tabs__panel" role="tabpanel" data-cds-panel="settings" hidden><p>Limits for the whole workspace.</p></div>
	<div class="cds-tabs__panel" role="tabpanel" data-cds-panel="activity" hidden><p>A log of recent changes.</p></div>
</div>`);
}

export function galleryPattern() {
  const shots = [
    ["card-1.jpg", "A path through trees"],
    ["card-2.jpg", "A valley in the afternoon"],
    ["card-3.jpg", "A city after rain"],
  ];
  const first = themeFile(`assets/media/${shots[0][0]}`);
  const thumbs = shots
    .map(([file, alt], index) => {
      const current = index === 0 ? ' aria-current="true"' : "";
      return `<button type="button" class="cds-gallery__thumb"${current}><img src="${themeFile(`assets/media/${file}`)}" alt="${alt}" width="800" height="600" /></button>`;
    })
    .join("\n\t\t");
  return html(`<div class="cds-gallery">
	<figure class="cds-gallery__stage">
		<div class="cds-gallery__head">
			<p class="cds-gallery__name">Places</p>
		</div>
		<div class="cds-gallery__view">
			<button type="button" class="cds-gallery__float" data-cds-gallery="prev" aria-label="Previous">
				${icon("arrow")}
			</button>
			<button type="button" class="cds-gallery__open" data-cds-gallery="open" aria-label="Open the picture">
				<img class="cds-gallery__img" alt="" src="${first}" width="800" height="600" />
			</button>
			<button type="button" class="cds-gallery__float cds-gallery__float--next" data-cds-gallery="next" aria-label="Next">
				${icon("arrow")}
			</button>
		</div>
		<figcaption class="cds-gallery__bar">
			<span class="cds-gallery__count"></span>
			<span class="cds-gallery__caption"></span>
			<button type="button" class="cds-btn cds-btn--outline cds-btn--sm" data-cds-gallery="open">Open</button>
		</figcaption>
	</figure>
	<div class="cds-gallery__strip">
		${thumbs}
	</div>
	<dialog class="cds-gallery__dialog">
		<img alt="" />
		<p class="cds-gallery__dialog-caption"></p>
		<form method="dialog"><button class="cds-btn cds-btn--ghost cds-btn--sm">Close</button></form>
	</dialog>
</div>`);
}

function postCard({ file, alt, kicker, title, text, date }) {
  return group(
    "cds-post",
    `${image(file, "cds-post__media", alt)}\n\n${paragraph(kicker, "cds-meta")}\n\n${heading(3, `<a href="#post">${title}</a>`, "cds-post__title")}\n\n${paragraph(text)}\n\n${paragraph(date, "cds-meta")}`,
    { tag: "article" },
  );
}

export function postsPattern() {
  return group(
    "cds-posts",
    [
      postCard({
        file: "card-1.jpg",
        alt: "A path through trees",
        kicker: "Notes",
        title: "A named offer, written down",
        text: "Say what the work is, who it is for, and what they leave with.",
        date: "April 17, 2026",
      }),
      postCard({
        file: "card-2.jpg",
        alt: "A green valley under cloud",
        kicker: "Proof",
        title: "A number you can check",
        text: "The metric sits on the page. It is not a slide in a deck.",
        date: "April 2, 2026",
      }),
    ].join("\n\n"),
  );
}

function factRows(rows) {
  return rows
    .map(([label, value]) => `<div><dt>${label}</dt><dd>${value}</dd></div>`)
    .join("\n\t\t\t");
}

export function factsPattern() {
  return html(`<div class="cds-facts">
	<p class="cds-facts__title">Theme details</p>
	<dl>
		${factRows([
      ["Downloads", "12"],
      ["Version", "1.4"],
      ["Rating", "4.9"],
      ["File size", "2 MB"],
    ])}
	</dl>
</div>`);
}

export function factsPlainPattern() {
  return html(`<dl class="cds-facts">
	${factRows([
    ["Client", "Northwind"],
    ["Date", "May 2026"],
    ["Services", "Brand, type"],
    ["Visit", '<a href="#facts">example.com</a>'],
  ])}
</dl>`);
}

function stat(value, label) {
  return group(
    "cds-stat",
    `${paragraph(value, "cds-stat__value")}\n\n${paragraph(label, "cds-meta")}`,
  );
}

export function statsPattern() {
  return group(
    "cds-surface cds-surface--dark",
    group(
      "cds-stats",
      [
        stat("140+", "Projects"),
        stat("98%", "Kept"),
        stat("12", "Years"),
        stat("4", "People"),
      ].join("\n\n"),
    ),
  );
}

function episode({ file, kicker, title, text }) {
  const play = html(
    `<a class="cds-btn cds-btn--primary cds-btn--sm cds-episode__play" href="#episode">${icon("play")}Play</a>`,
  );
  return group(
    "cds-episode",
    `${image(file, "cds-episode__thumb", "")}\n\n${group(
      "cds-episode__body",
      `${paragraph(kicker, "cds-meta cds-episode__kicker")}\n\n${heading(3, title, "cds-episode__title")}\n\n${paragraph(text)}\n\n${play}`,
    )}`,
    { tag: "article" },
  );
}

export function episodesPattern() {
  return group(
    "cds-episodes",
    [
      episode({
        file: "hero.jpg",
        kicker: "Episode 20 · 45 min",
        title: "The offer, said out loud",
        text: "What the work is, who it is for, and what they leave with.",
      }),
      episode({
        file: "split.jpg",
        kicker: "Episode 19 · 42 min",
        title: "A number you can count",
        text: "The figure on the page, and the notes that match it.",
      }),
    ].join("\n\n"),
  );
}

function stepList(items) {
  const rows = items
    .map(([mark, title, text]) => {
      const heading = title ? `<h3 class="cds-step__title">${title}</h3>` : "";
      return `<li class="cds-step"><p class="cds-step__mark">${mark}</p><div>${heading}<p>${text}</p></div></li>`;
    })
    .join("\n\t\t");
  return `<ol class="cds-steps">
		${rows}
	</ol>`;
}

export function stepsPattern() {
  return html(
    stepList([
      ["01", "Book a conversation", "One call to name the offer and the number you are watching."],
      ["02", "Write the page", "The work, who it is for, and what they leave with. One paragraph is enough."],
      ["03", "Put the number where they can see it", "It stays on the page. It does not move into a deck."],
    ]),
  );
}

export function stepsYearsPattern() {
  return html(
    stepList([
      ["2024", "", "Started with one offer and a single page."],
      ["2026", "", "The number is on the page, and the notes match it."],
    ]),
  );
}

function person(initials, name, role) {
  return group(
    "cds-person",
    `${html(`<span class="cds-avatar" role="img" aria-label="${name}">${initials}</span>`)}\n\n${heading(3, name, "cds-person__name")}\n\n${paragraph(role, "cds-person__role")}`,
    { tag: "article" },
  );
}

export function peoplePattern() {
  return group(
    "cds-people",
    [
      person("JL", "Jordan Lee", "Notes"),
      person("AK", "Alex Kim", "Proof"),
      person("MC", "Mina Cole", "Type"),
    ].join("\n\n"),
  );
}

export function shotsPattern() {
  return group(
    "cds-shots",
    `${image("hero.jpg", "cds-shots__lead", "A ridge in warm light")}\n\n${group(
      "cds-shots__side",
      `${image("card-1.jpg", "", "A path through trees")}\n\n${image("card-3.jpg", "", "A city street at sunrise")}`,
    )}`,
  );
}

function bentoCard({ title, text, file, wide = false }) {
  const classes = wide ? "cds-card cds-bento__wide" : "cds-card";
  return group(
    classes,
    `${heading(3, title, "cds-card__title")}\n\n${paragraph(text)}\n\n${image(file, "", "")}`,
    { tag: "article" },
  );
}

export function bentoPattern() {
  return group(
    "cds-bento",
    [
      bentoCard({
        title: "The offer",
        text: "Name the work, the person, and what they leave with.",
        file: "card-1.jpg",
      }),
      bentoCard({
        title: "The number",
        text: "A figure they can check without another tool.",
        file: "card-2.jpg",
      }),
      bentoCard({
        title: "The next step",
        text: "One action. The page says what it is.",
        file: "card-3.jpg",
      }),
      bentoCard({
        title: "The notes",
        text: "What happened between the calls, written where the next person can find it.",
        file: "split.jpg",
        wide: true,
      }),
      bentoCard({
        title: "The room",
        text: "The same work, shown. No second system for the pictures.",
        file: "hero.jpg",
        wide: true,
      }),
    ].join("\n\n"),
  );
}

export function searchPattern() {
  const action = `<?php echo esc_url( home_url( '/' ) ); ?>`;
  return `${html(`<form class="cds-search" role="search" method="get" action="${action}">
	<div class="cds-field">
		<label for="cds-search-q">Search</label>
		<div class="cds-search__row">
			<input class="cds-input" id="cds-search-q" type="search" name="s" placeholder="What are you looking for?" />
			<button type="submit" class="cds-btn cds-btn--primary">Search</button>
		</div>
	</div>
</form>`)}

${html(`<div class="cds-cluster">
	<span class="cds-meta">Topics</span>
	<a class="cds-pill" href="#notes">Notes</a>
	<a class="cds-pill" href="#proof">Proof</a>
	<a class="cds-pill" href="#type">Type</a>
</div>`)}`;
}
