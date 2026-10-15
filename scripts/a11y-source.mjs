import { readdirSync, readFileSync, statSync } from "node:fs";
import { join } from "node:path";

const SOURCE_ROOTS = [
  "wordpress/cds/patterns",
  "wordpress/cds/templates",
  "wordpress/cds/parts",
  "wordpress/showcase",
];

/**
 * Img tags in html that have no alt attribute. Empty alt is decorative and passes.
 * @param {string} html
 * @returns {string[]}
 */
export function missingAltAttributes(html) {
  const missing = [];
  const opener = /<img\b/gi;
  let match;
  while ((match = opener.exec(html))) {
    const start = match.index;
    let end = start + 4;
    while (end < html.length && !(html[end] === ">" && html[end - 1] !== "?")) {
      end += 1;
    }
    const tag = html.slice(start, Math.min(end + 1, html.length));
    if (!/\balt\s*=/i.test(tag)) {
      const line = html.slice(0, start).split("\n").length;
      missing.push(`line ${line}: ${tag.replace(/\s+/g, " ").slice(0, 140)}`);
    }
    opener.lastIndex = end + 1;
  }
  return missing;
}

function htmlFiles(dir, out) {
  for (const name of readdirSync(dir)) {
    const abs = join(dir, name);
    if (statSync(abs).isDirectory()) {
      htmlFiles(abs, out);
      continue;
    }
    if (/\.(html|php)$/i.test(name)) out.push(abs);
  }
}

/**
 * One scan of the theme patterns, templates, parts, and showcase HTML.
 * @param {string} root Kit root.
 * @returns {string[]}
 */
export function missingAltInKit(root) {
  const files = [];
  for (const rel of SOURCE_ROOTS) {
    htmlFiles(join(root, rel), files);
  }
  const errors = [];
  for (const file of files) {
    const html = readFileSync(file, "utf8");
    for (const hit of missingAltAttributes(html)) {
      errors.push(`${file}: ${hit}`);
    }
  }
  return errors;
}
