/**
 * Stamp the progressive showcase nav + pager on kit HTML pages.
 * Run from the kit root: node scripts/patch-showcase-nav.mjs
 */
import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");

const walk = [
  ["index.html", "Start"],
  ["colors.html", "Color"],
  ["typography.html", "Type"],
  ["layout.html", "Layout"],
  ["sections.html", "Sections"],
  ["the-site.html", "The site"],
];

const more = [
  ["components.html", "Pieces"],
  ["media-kit.html", "Assets"],
  ["design-md.html", "Contract"],
];

const pagerNext = {
  "index.html": ["colors.html", "Color"],
  "colors.html": ["typography.html", "Type"],
  "typography.html": ["layout.html", "Layout"],
  "layout.html": ["sections.html", "Sections"],
  "sections.html": ["the-site.html", "The site"],
  "components.html": ["design-md.html", "Contract"],
  "media-kit.html": ["colors.html", "Color"],
  "design-md.html": ["the-site.html", "The site"],
  "customize.html": ["index.html", "Start"],
};

const pagerPrev = {
  "colors.html": ["index.html", "Start"],
  "typography.html": ["colors.html", "Color"],
  "layout.html": ["typography.html", "Type"],
  "sections.html": ["layout.html", "Layout"],
  "components.html": ["sections.html", "Sections"],
  "media-kit.html": ["index.html", "Start"],
  "design-md.html": ["components.html", "Pieces"],
  "customize.html": ["index.html", "Start"],
};

function links(items, current) {
  return items
    .map(([href, label]) => {
      const cur = href === current ? ' aria-current="page"' : "";
      return `          <a href="${href}"${cur}>${label}</a>`;
    })
    .join("\n");
}

function navHtml(current) {
  return `        <nav class="kit-nav" aria-label="What the system does">
${links(walk, current)}
        </nav>
        <nav class="kit-nav kit-nav--more" aria-label="Builder pages">
${links(more, current)}
        </nav>`;
}

function pagerHtml(file) {
  const prev = pagerPrev[file];
  const next = pagerNext[file];
  const left = prev
    ? `<a href="${prev[0]}">&larr; ${prev[1]}</a>`
    : `<span class="kit-pager__spacer"></span>`;
  const right = next ? `<a href="${next[0]}">Next: ${next[1]} &rarr;</a>` : "";
  return `          <nav class="kit-pager" aria-label="Pagination">
            ${left}
            ${right}
          </nav>`;
}

const navRe =
  /<nav class="kit-nav"[\s\S]*?<\/nav>(?:\s*<nav class="kit-nav kit-nav--more"[\s\S]*?<\/nav>)?/;
const pagerRe = /<nav class="kit-pager"[\s\S]*?<\/nav>/;

const files = [
  "index.html",
  "colors.html",
  "typography.html",
  "layout.html",
  "sections.html",
  "components.html",
  "media-kit.html",
  "design-md.html",
  "customize.html",
];

for (const file of files) {
  const full = path.join(root, file);
  let html = fs.readFileSync(full, "utf8");
  if (!navRe.test(html)) {
    console.error("No kit-nav in", file);
    process.exit(1);
  }
  html = html.replace(navRe, navHtml(file));
  if (pagerRe.test(html)) {
    html = html.replace(pagerRe, pagerHtml(file));
  }
  fs.writeFileSync(full, html);
  console.log("updated", file);
}
