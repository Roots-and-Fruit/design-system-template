#!/usr/bin/env node
/**
 * Copy wordpress/cds into a WordPress themes directory.
 *
 *   node scripts/sync-theme.mjs --dest "C:/path/to/wp-content/themes/<slug>"
 *
 * <slug> comes from brand-defaults.json (Example Brand → example-brand).
 * A dest folder named cds is retargeted to that slug, so a resync updates
 * the brand theme instead of writing a second CDS copy.
 * Passing the themes directory (…/wp-content/themes) appends the slug.
 *
 * Destination is required. Do not hardcode a local Studio path in this file.
 *
 * When WordPress at CDS_WP_BASE_URL (default http://localhost:8893) is up,
 * runs `npm run test:wp` after the copy, one worker at a time.
 * Pass --skip-test to copy only.
 */

import { cpSync, existsSync, readFileSync } from "node:fs";
import { spawnSync } from "node:child_process";
import { basename, dirname, join } from "node:path";
import { fileURLToPath } from "node:url";

const __dirname = dirname(fileURLToPath(import.meta.url));
const root = join(__dirname, "..");
const source = join(root, "wordpress", "cds");
const argv = process.argv.slice(2);

function destFromArgs(list) {
  const flag = list.indexOf("--dest");
  if (flag !== -1 && list[flag + 1]) return list[flag + 1];
  if (process.env.CDS_WP_THEME_DEST) return process.env.CDS_WP_THEME_DEST;
  return "";
}

function skipTest(list) {
  return list.includes("--skip-test");
}

function installSlug() {
  const path = join(source, "brand-defaults.json");
  if (!existsSync(path)) {
    console.error("Missing brand-defaults.json. Run npm run compile:wordpress first.");
    process.exit(1);
  }
  let data;
  try {
    data = JSON.parse(readFileSync(path, "utf8"));
  } catch (error) {
    console.error(`brand-defaults.json is not valid JSON: ${error.message}`);
    process.exit(1);
  }
  if (!data.slug || !/^[a-z][a-z0-9-]*$/.test(data.slug)) {
    console.error("brand-defaults.json has no install slug. Recompile.");
    process.exit(1);
  }
  return data.slug;
}

function resolveDest(dest, slug) {
  const trimmed = dest.replace(/[\\/]+$/, "");
  const base = basename(trimmed);
  if (base.toLowerCase() === "themes") {
    const next = join(trimmed, slug);
    console.log(`Themes directory given. Installing as ${next}`);
    return next;
  }
  if (base === "cds" && slug !== "cds") {
    const next = join(dirname(trimmed), slug);
    console.log(`Brand slug is ${slug}. Updating ${next} instead of a cds folder.`);
    return next;
  }
  if (base !== slug) {
    console.log(
      `Destination folder is ${base}. Theme Name still comes from brand.json (slug ${slug}).`,
    );
  }
  return trimmed;
}

async function wpIsUp(base) {
  try {
    const res = await fetch(base, { signal: AbortSignal.timeout(2500) });
    return res.status < 500;
  } catch {
    return false;
  }
}

const requested = destFromArgs(argv);
if (!requested) {
  console.error("Pass --dest <wp-content/themes/<slug>> or set CDS_WP_THEME_DEST.");
  process.exit(1);
}
if (!existsSync(source)) {
  console.error("Missing wordpress/cds. Run npm run compile:wordpress first.");
  process.exit(1);
}

const dest = resolveDest(requested, installSlug());
cpSync(source, dest, { recursive: true });
console.log(`Copied wordpress/cds → ${dest}`);

if (skipTest(argv)) {
  process.exit(0);
}

const base = process.env.CDS_WP_BASE_URL || "http://localhost:8893";
const up = await wpIsUp(base);
if (!up) {
  console.log(`Skipped test:wp (${base} not reachable).`);
  process.exit(0);
}

const result = spawnSync("npm", ["run", "test:wp", "--", "--workers=1"], {
  cwd: root,
  stdio: "inherit",
  shell: true,
  env: { ...process.env, CDS_WP_BASE_URL: base },
});
process.exit(result.status === null ? 1 : result.status);
