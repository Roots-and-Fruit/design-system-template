/**
 * Organism patterns the compiler owns.
 * Section jobs (hero, proof, card grid, …) stay hand-owned in wordpress/cds/patterns/.
 * Files the compiler used to write and no longer lists here are deleted.
 */
import { mkdirSync, readdirSync, unlinkSync, writeFileSync } from "node:fs";
import { join } from "node:path";
import {
  cardPattern,
  offer,
  pageHero,
  quote,
  reviewCard,
  takeawaysPattern,
} from "./block-snippets.mjs";
import {
  avatarsPattern,
  categoryRowPattern,
  contactFormPattern,
  coverPattern,
  footerCtaPattern,
  iconCardPattern,
  iconCardsPattern,
  iconLinksPattern,
  iconListPattern,
  logoRowPattern,
  partsPattern,
  productGridPattern,
  reelPattern,
  subscribePattern,
  videoCardPattern,
} from "./pattern-pieces.mjs";
import {
  bentoPattern,
  episodesPattern,
  factsPattern,
  galleryPattern,
  peoplePattern,
  postsPattern,
  searchPattern,
  shotsPattern,
  statsPattern,
  stepsPattern,
  tabsPattern,
} from "./pattern-organisms.mjs";

const HAND_OWNED = new Set([
  "alert.php",
  "allowlist.php",
  "article.php",
  "card-grid.php",
  "catalog.php",
  "cta.php",
  "dark-band.php",
  "hero.php",
  "landing.php",
  "layout-home.php",
  "pricing.php",
  "proof.php",
  "split.php",
  "layout-studio.php",
  "layout-shop.php",
  "layout-stories.php",
  "layout-case.php",
  "layout-show.php",
  "layout-download.php",
]);

function patternFile(title, slug, blocks, headers = []) {
  const extra = headers.map((line) => ` * ${line}`).join("\n");
  return `<?php
/**
 * Title: ${title}
 * Slug: cds/${slug}
 * Categories: cds
 * Inserter: true
${extra ? `${extra}\n` : ""} */
?>
${blocks.trim()}
`;
}

export function writePatterns(root) {
  const patternDir = join(root, "wordpress/cds/patterns");
  mkdirSync(patternDir, { recursive: true });
  const generated = new Map();
  const mark = "<?php echo esc_url( get_theme_file_uri( 'assets/mark.svg' ) ); ?>";

  generated.set(
    "quote.php",
    patternFile(
      "Quote",
      "quote",
      quote({
        text: "The setup was straightforward. When we needed a related fix, the team answered immediately.",
        name: "A store owner",
        role: "Retail",
      }),
    ),
  );
  generated.set(
    "quote-portrait.php",
    patternFile(
      "Portrait quote",
      "quote-portrait",
      quote({
        text: "The work moved in the weeks between the calls.",
        name: "Alex Kim",
        role: "Proof",
        avatar: { initials: "AK" },
      }),
    ),
  );
  generated.set(
    "review.php",
    patternFile("Review card", "review", reviewCard()),
  );
  generated.set("card.php", patternFile("Card", "card", cardPattern()));
  generated.set(
    "offer.php",
    patternFile(
      "Service offer",
      "offer",
      offer({
        eyebrow: "For a founder working alone",
        title: "Working sessions",
        lede: "A sounding board and a clear next step, for someone building without a team.",
        items: ["Weekly sessions for six weeks", "Notes between calls"],
        amount: "€1,200",
        cadence: "Flat rate · six weeks",
        portrait: mark,
        quote: "The work moved in the weeks between the calls.",
        by: '<span class="cds-offer__name">A founder</span> Studio',
      }),
    ),
  );
  generated.set(
    "takeaways.php",
    patternFile("Key takeaways", "takeaways", takeawaysPattern()),
  );
  generated.set(
    "page-hero.php",
    patternFile(
      "Page hero",
      "page-hero",
      pageHero({
        postTitle: true,
        subtitle: "A short line under the title.",
        lede: "One or two sentences on what this page is for.",
        buttons: [
          { classes: "cds-btn cds-btn--primary", href: "#start", label: "Get started" },
          { classes: "cds-btn cds-btn--outline", href: "#details", label: "See the details" },
        ],
      }),
      ["Block Types: core/post-content", "Post Types: page"],
    ),
  );

  const pieces = [
    ["icon-card.php", "Icon card", "icon-card", iconCardPattern()],
    ["icon-cards.php", "Icon cards", "icon-cards", iconCardsPattern()],
    ["icon-list.php", "Icon list", "icon-list", iconListPattern()],
    ["cover.php", "Cover", "cover", coverPattern()],
    ["video-card.php", "Video card", "video-card", videoCardPattern()],
    ["logo-row.php", "Logo row", "logo-row", logoRowPattern()],
    ["product-grid.php", "Product grid", "product-grid", productGridPattern()],
    ["category-row.php", "Category tiles", "category-row", categoryRowPattern()],
    ["contact-form.php", "Contact form", "contact-form", contactFormPattern()],
    ["avatars.php", "Avatars", "avatars", avatarsPattern()],
    ["subscribe.php", "Subscribe", "subscribe", subscribePattern()],
    ["icon-links.php", "Icon links", "icon-links", iconLinksPattern()],
    ["reel.php", "Reel", "reel", reelPattern()],
    ["tabs.php", "Folder tabs", "tabs", tabsPattern()],
    ["gallery.php", "Gallery", "gallery", galleryPattern()],
    ["posts.php", "Post cards", "posts", postsPattern()],
    ["facts.php", "Fact list", "facts", factsPattern()],
    ["stats.php", "Stat row", "stats", statsPattern()],
    ["episodes.php", "Episode row", "episodes", episodesPattern()],
    ["steps.php", "Steps", "steps", stepsPattern()],
    ["people.php", "People", "people", peoplePattern()],
    ["shots.php", "Photo cluster", "shots", shotsPattern()],
    ["bento.php", "Bento", "bento", bentoPattern()],
    ["search.php", "Search", "search", searchPattern()],
    ["footer-cta.php", "Footer with call to action", "footer-cta", footerCtaPattern()],
    ["parts.php", "Kit parts", "parts", partsPattern()],
  ];
  for (const [file, title, slug, blocks] of pieces) {
    const description =
      slug === "footer-cta"
        ? "Description: Inserter pattern. Does not replace the site footer."
        : slug === "parts"
          ? "Description: Specimen stack for the pieces. Unlisted page, not a nav item."
          : "Description: A piece inside a section. Not a page job.";
    generated.set(file, patternFile(title, slug, blocks, [description]));
  }

  const owned = new Set([...HAND_OWNED, ...generated.keys()]);
  for (const name of readdirSync(patternDir)) {
    if (name.endsWith(".php") && !owned.has(name)) {
      unlinkSync(join(patternDir, name));
      console.log(`  removed patterns/${name}`);
    }
  }
  for (const [name, php] of generated) {
    writeFileSync(join(patternDir, name), php.endsWith("\n") ? php : `${php}\n`);
    console.log(`  wrote patterns/${name}`);
  }
}
