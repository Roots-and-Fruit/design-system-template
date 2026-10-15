import assert from "node:assert/strict";
import { readFileSync } from "node:fs";
import { dirname, join } from "node:path";
import { test } from "node:test";
import { fileURLToPath } from "node:url";
import { checkPairs, contrastRatio, PROMISED_PAIRS } from "./contrast.mjs";

const root = join(dirname(fileURLToPath(import.meta.url)), "..");

function paletteFromTokens() {
  const css = readFileSync(join(root, "css/tokens.css"), "utf8");
  const palette = {};
  for (const match of css.matchAll(/--cds-([a-z0-9-]+):\s*(#[0-9a-fA-F]{3,6})\s*;/g)) {
    palette[match[1]] = match[2];
  }
  return palette;
}

test("white on primary clears 4.5", () => {
  assert.ok(contrastRatio("#ffffff", "#0e7490") >= 4.5);
});

test("the Lighthouse miss stays under 4.5", () => {
  assert.ok(contrastRatio("#64748b", "#e2e8f0") < 4.5);
});

test("checkPairs reports the bad fixture and clears the good one", () => {
  const bad = checkPairs(
    { fg: "#64748b", bg: "#e2e8f0" },
    [{ fg: "fg", bg: "bg", min: 4.5 }],
  );
  assert.equal(bad.length, 1);
  assert.match(bad[0], /#64748b/);
  assert.match(bad[0], /#e2e8f0/);
  assert.match(bad[0], /needs 4\.5:1/);

  const good = checkPairs(
    { fg: "#ffffff", bg: "#0e7490" },
    [{ fg: "fg", bg: "bg", min: 4.5 }],
  );
  assert.deepEqual(good, []);
});

test("Example Brand tokens clear the promised pairs", () => {
  const errors = checkPairs(paletteFromTokens(), PROMISED_PAIRS);
  assert.deepEqual(errors, []);
});
