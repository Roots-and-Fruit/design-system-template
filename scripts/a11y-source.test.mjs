import assert from "node:assert/strict";
import { readFileSync } from "node:fs";
import { dirname, join } from "node:path";
import { test } from "node:test";
import { fileURLToPath } from "node:url";
import { missingAltAttributes, missingAltInKit } from "./a11y-source.mjs";

const root = join(dirname(fileURLToPath(import.meta.url)), "..");

test("an img without alt fails", () => {
  const hits = missingAltAttributes('<img src="x.jpg">');
  assert.equal(hits.length, 1);
});

test("empty alt is decorative and passes", () => {
  assert.deepEqual(missingAltAttributes('<img src="x.jpg" alt="">'), []);
});

test("a description passes", () => {
  assert.deepEqual(missingAltAttributes('<img src="x.jpg" alt="A peach">'), []);
});

test("theme and showcase trees have an alt on every img", () => {
  assert.deepEqual(missingAltInKit(root), []);
});

test("the focus ring ships in components.css and not base.css", () => {
  const source = readFileSync(join(root, "css/components.css"), "utf8");
  const base = readFileSync(join(root, "css/base.css"), "utf8");
  const compiled = readFileSync(join(root, "wordpress/cds/assets/css/components.css"), "utf8");
  const rule = /:focus-visible\s*\{[^}]*box-shadow:\s*var\(--cds-focus\)/;
  assert.match(source, rule);
  assert.doesNotMatch(base, /:focus-visible/);
  assert.match(compiled, rule);
});
