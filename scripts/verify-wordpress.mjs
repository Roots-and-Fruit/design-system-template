#!/usr/bin/env node
/**
 * Static gate for the generated theme. Does not prove the probe or Site Editor.
 */
import { existsSync, readFileSync, readdirSync, statSync } from "node:fs";
import { dirname, extname, join, relative } from "node:path";
import { fileURLToPath } from "node:url";

const root = join(dirname(fileURLToPath(import.meta.url)), "..");
const errors = [];

function read(rel) {
  const path = join(root, rel);
  if (!existsSync(path)) {
    errors.push(`missing ${rel}`);
    return "";
  }
  return readFileSync(path, "utf8");
}

function json(rel) {
  const raw = read(rel);
  if (!raw) return null;
  try {
    return JSON.parse(raw);
  } catch (error) {
    errors.push(`${rel} is not valid JSON: ${error.message}`);
    return null;
  }
}

const functions = read("wordpress/cds/functions.php");
const hero = read("wordpress/cds/patterns/hero.php");
const quoteFile = read("wordpress/cds/patterns/quote.php");
const pageHero = read("wordpress/cds/patterns/page-hero.php");
const offer = read("wordpress/cds/patterns/offer.php");
const review = read("wordpress/cds/patterns/review.php");
const takeaways = read("wordpress/cds/patterns/takeaways.php");
const card = read("wordpress/cds/patterns/card.php");
const single = read("wordpress/cds/templates/single.html");
const components = read("wordpress/cds/assets/css/components.css");
const chrome = read("wordpress/cds/assets/css/site-chrome.css");
const themeJson = json("wordpress/cds/theme.json");

for (const rel of [
  "wordpress/cds/styles/block/cds-surface.json",
  "wordpress/cds/styles/block/cds-tint.json",
  "wordpress/cds/styles/block/cds-panel.json",
  "wordpress/cds/styles/block/cds-dark.json",
  "wordpress/cds/styles/block/cds-accent.json",
  "wordpress/cds/styles/block/cds-outline.json",
]) {
  read(rel);
}

if (themeJson?.settings?.typography?.fluid !== false) {
  errors.push("theme.json must disable fluid typography");
}
if (themeJson?.styles?.blocks?.["core/group"]?.variations) {
  errors.push("Group variations belong in styles/block, not theme.json");
}
if (themeJson?.styles?.blocks?.["core/button"]?.variations) {
  errors.push("Button variations belong in styles/block, not theme.json");
}

const jsonStyles = [
  ["cds-surface", "core/group"],
  ["cds-tint", "core/group"],
  ["cds-panel", "core/group"],
  ["cds-dark", "core/group"],
  ["cds-accent", "core/button"],
  ["cds-outline", "core/button"],
  ["cds-secondary", "core/button"],
  ["cds-ghost", "core/button"],
];
for (const [slug, blockType] of jsonStyles) {
  const variation = json(`wordpress/cds/styles/block/${slug}.json`);
  if (variation?.slug !== slug || !variation?.blockTypes?.includes(blockType)) {
    errors.push(`${slug}.json must own the ${blockType} variation`);
  }
  if (functions.includes(`'${slug}'`)) {
    errors.push(`functions.php must not register ${slug}`);
  }
}

if (!/cds-copy|is-style-cds-copy/.test(hero)) {
  errors.push("hero.php must use the copy stack");
}
if (!hero.includes("cds-lede")) errors.push("hero.php lede must use cds-lede");
if (!hero.includes("cds-cluster")) errors.push("hero.php buttons must use cds-cluster");
if (/wp:heading[^>]*cds-display--md/.test(hero)) {
  errors.push("hero subtitle must be a paragraph, not a heading");
}

if (!quoteFile.includes("cds-quote")) errors.push("quote.php must use cds-quote");
if (!quoteFile.includes("cds-quote__name")) errors.push("quote.php must name the person");
if (!quoteFile.includes("wp-block-quote")) errors.push("quote.php must keep a core quote");
if (quoteFile.includes("is-style-cds-surface") && !quoteFile.includes("cds-quote")) {
  errors.push("quote.php must not be a surface standing in for a quote");
}

for (const needle of ["cds-copy", "cds-lede", "cds-cluster", "cds-display--md"]) {
  if (!pageHero.includes(needle)) errors.push(`page-hero.php missing ${needle}`);
}
if (/<h2[^>]*cds-display--md/.test(pageHero)) {
  errors.push("page hero subtitle must be a paragraph");
}

if (!offer.includes("cds-offer")) errors.push("offer.php must use cds-offer");
if (!review.includes("cds-review")) errors.push("review.php must use cds-review");
if (!takeaways.includes("cds-takeaways")) errors.push("takeaways.php must use cds-takeaways");
if (!card.includes("cds-card")) errors.push("card.php must use cds-card");

if (!single.includes("cds-byline")) errors.push("single.html byline must use cds-byline");
if (!single.includes("cds-lede")) errors.push("single.html excerpt must use cds-lede");
if (!functions.includes("default_content")) {
  errors.push("functions.php must seed empty pages with the page hero");
}
if (!components.includes(".cds-offer")) {
  errors.push("theme components.css is missing the offer organism");
}
if (!chrome.includes("@property --cds-measure")) {
  errors.push("site-chrome.css must register the measure as a length");
}

const styleCss = read("wordpress/cds/style.css");
const brandDefaults = json("wordpress/cds/brand-defaults.json");
const themeName = styleCss.match(/^Theme Name:\s*(.+)$/m)?.[1]?.trim();
const themeDescription = styleCss.match(/^Description:\s*(.+)$/m)?.[1]?.trim();
if (!brandDefaults?.slug || !/^[a-z][a-z0-9-]*$/.test(brandDefaults.slug)) {
  errors.push("brand-defaults.json needs an install slug");
}
if (brandDefaults?.name && themeName !== brandDefaults.name) {
  errors.push(
    `style.css Theme Name is "${themeName || ""}", brand name is "${brandDefaults.name}"`,
  );
}
if (brandDefaults?.description && themeDescription !== brandDefaults.description) {
  errors.push("style.css Description does not match brand-defaults.json");
}

const registerStart = functions.indexOf("function cds_register_block_styles");
const registerEnd = functions.indexOf("function cds_default_page_content");
const registerBody =
  registerStart >= 0 && registerEnd > registerStart
    ? functions.slice(registerStart, registerEnd)
    : "";
if (!registerBody.includes("cds_brand_defaults")) {
  errors.push("pattern category label must be read from brand-defaults.json");
}

function walkFiles(dir, out = []) {
  if (!existsSync(dir)) return out;
  for (const name of readdirSync(dir)) {
    const abs = join(dir, name);
    if (statSync(abs).isDirectory()) walkFiles(abs, out);
    else out.push(abs);
  }
  return out;
}

const textExt = new Set([".php", ".html", ".css", ".js", ".json", ".svg"]);
for (const file of [
  ...walkFiles(join(root, "wordpress/cds")),
  ...walkFiles(join(root, "wordpress/showcase")),
]) {
  if (!textExt.has(extname(file).toLowerCase())) continue;
  const text = readFileSync(file, "utf8");
  if (text.includes("/wp-content/themes/")) {
    errors.push(`${relative(root, file)} hardcodes a theme-folder URL`);
  }
}

const seed = read("wordpress/probe-seed-showcase.php");
const seedSlugs = new Set();
for (const match of seed.matchAll(/'slug'\s*=>\s*'([^']+)'/g)) seedSlugs.add(match[1]);
for (const match of seed.matchAll(/cds_probe_put_(?:page|post)\(\s*'([^']+)'/g)) {
  seedSlugs.add(match[1]);
}
const seedHasFront = /'front'\s*=>\s*true/.test(seed);
const reported = new Set();
const e2eDir = join(root, "wordpress/e2e");
if (existsSync(e2eDir)) {
  for (const name of readdirSync(e2eDir)) {
    if (!name.endsWith(".js")) continue;
    const spec = readFileSync(join(e2eDir, name), "utf8");
    if (/goto\(\s*["']\/["']\s*\)/.test(spec) && !seedHasFront) {
      errors.push(`${name} opens / but the seed sets no front page`);
    }
    for (const match of spec.matchAll(/["'](\/[a-z0-9]+(?:-[a-z0-9]+)*\/)["']/g)) {
      const slug = match[1].slice(1, -1);
      const key = `${name}:${slug}`;
      if (reported.has(key) || seedSlugs.has(slug)) continue;
      reported.add(key);
      errors.push(`${name} opens ${match[1]} but the seed never publishes "${slug}"`);
    }
  }
}

if (errors.length) {
  console.error(`Static WordPress projection verification failed:\n- ${errors.join("\n- ")}`);
  process.exit(1);
}
console.log("Static WordPress projection verification passed.");
