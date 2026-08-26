#!/usr/bin/env node
/**
 * Copy wordpress/cds into a WordPress themes directory.
 *
 *   node scripts/sync-theme.mjs --dest "C:/path/to/wp-content/themes/cds"
 *
 * Destination is required. Do not hardcode a local Studio path in this file.
 *
 * When WordPress at CDS_WP_BASE_URL (default http://localhost:8893) is up,
 * runs `npm run test:wp` after the copy. Pass --skip-test to copy only.
 */

import { cpSync, existsSync } from "node:fs";
import { spawnSync } from "node:child_process";
import { dirname, join } from "node:path";
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

async function wpIsUp(base) {
  try {
    const res = await fetch(base, { signal: AbortSignal.timeout(2500) });
    return res.status < 500;
  } catch {
    return false;
  }
}

const dest = destFromArgs(argv);
if (!dest) {
  console.error("Pass --dest <wp-content/themes/cds> or set CDS_WP_THEME_DEST.");
  process.exit(1);
}
if (!existsSync(source)) {
  console.error("Missing wordpress/cds. Run npm run compile:wordpress first.");
  process.exit(1);
}

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

const result = spawnSync("npm", ["run", "test:wp"], {
  cwd: root,
  stdio: "inherit",
  shell: true,
  env: { ...process.env, CDS_WP_BASE_URL: base },
});
process.exit(result.status === null ? 1 : result.status);
