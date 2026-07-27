#!/usr/bin/env node
// Embed DESIGN.md into the Agent contract page (contract.html).
//
// DESIGN.md stays canonical; the HTML copy exists so the page works when opened
// straight from disk (no server, no fetch). Re-run after every DESIGN.md edit.
// Windows users can run sync-design-md-embed.ps1 instead.
//
//   node sync-design-md-embed.mjs

import { readFile, writeFile } from "node:fs/promises";
import { dirname, join } from "node:path";
import { fileURLToPath } from "node:url";

const root = dirname(fileURLToPath(import.meta.url));
const mdPath = join(root, "DESIGN.md");
const htmlPath = join(root, "contract.html");

const escapeHtml = (value) =>
  value
    .replaceAll("&", "&amp;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;")
    .replaceAll('"', "&quot;")
    .replaceAll("'", "&#39;");

const raw = await readFile(mdPath, "utf8");
// Normalise to LF so the embed matches the file on disk byte for byte.
const md = `${raw.replace(/\r\n?/g, "\n").trimEnd()}\n`;

const html = await readFile(htmlPath, "utf8");
if (!html.includes('id="design-md-source"')) {
  throw new Error('contract.html is missing <code id="design-md-source">');
}

const updated = html.replace(
  /(<code id="design-md-source">)[\s\S]*?(<\/code>)/,
  (_match, open, close) => `${open}${escapeHtml(md)}${close}`
);

await writeFile(htmlPath, updated, "utf8");
console.log(`Embedded DESIGN.md into contract.html (${md.split("\n").length} lines).`);
