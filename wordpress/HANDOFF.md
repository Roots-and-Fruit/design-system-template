# WordPress projection — handoff

**Date:** 2026-08-26  
**Open first:** [`../WORDPRESS.md`](../WORDPRESS.md), then this file. Kit job: **D** in [`../AGENTS.md`](../AGENTS.md).

WordPress is a **projection** of this kit. The kit is the system. A brand pack
(including Roots & Fruit) may alias onto it later. Do not invert that.

## What is true

- `DESIGN.md` + `css/tokens.css` are the source of truth.
- Compiler: `npm run compile:wordpress` → `wordpress/cds/` (theme.json, token
  registry, copied kit CSS). Customize runs the same compiler.
- Thin block theme slug: `cds`. Enqueues tokens/layouts/components +
  `block-styles.css`. Skips `base.css` so `theme.json` owns elements.
- Pickers locked. Slugs are semantic (`paper`, `primary`, `accent`). `info` is
  off the marketing palette.
- Recipes in the inserter: section jobs (`cds/hero`, `cds/proof`,
  `cds/card-grid`, `cds/split`, `cds/quote`, `cds/dark-band`, `cds/cta`,
  `cds/alert`) and page recipes (`cds/article`, `cds/landing`). Landing is a
  stack of sections. Button styles: secondary / outline / accent / ghost.
  Group styles: surface / tint / panel / dark. Columns style: split.
- Token layers (primitive → semantic → component) live in `DESIGN.md`.
- Layout / elevation / focus are YAML on `DESIGN.md`. Customize does not own them.
- Visual check: `npm run test:wp`. Layout locks, not screenshots: identity,
  blank Core defaults, catalog wash vs `wide` column, two-track hero with pill,
  five centered proof tracks, card-grid fills + AA contrast + tint/dark outline hover, dark-band paint. `sync-theme` runs this when the probe is up
  (`--skip-test` to copy only).
- Page / single / front templates: `main` is default flow. Constrained layout
  lives on `post-content` (and a title wrapper). `alignfull` washes can reach
  the viewport. Do not wrap `post-content` in a second constrained Group.
- The kit **Sections** page is the catalog (`sections.html`). WordPress
  projects the same jobs as patterns. The probe stacks them on `/cds-catalog/`.
  Proof is five centered stats on `wide` inside a full-bleed wash. Hero is a
  split: pill, title, lede, one primary, proof cluster, media. Card grid
  uses three paired fills (surface, tint, dark); Playwright checks AA and that
  tint/dark outline hover is not the tile colour. Layout probe
  `/cds-layout/` stacks those jobs like a marketing home (hero, proof, product
  grid, alert, split, why, quote, path chooser, dark band). Not a ninth section.
- Header / footer compose native Site Identity: `core/site-logo`,
  `core/site-title`, `core/site-tagline`, plus `core/navigation` (page list).
  No hardcoded brand strings in the parts. Compiler writes `brand-defaults.json`
  and copies `assets/mark.svg`. The theme seeds title/tagline and falls back
  to the kit mark when no Site Logo is set.

## Done (steps 1–8)

1. Contract — `WORDPRESS.md` (was a hub draft; now kit-canonical).
2. Compiler — `scripts/compile-wordpress.mjs`.
3. Thin theme on a local probe + activate.
4. Recipes + block styles. Band padding / stack gap fixed after a visual miss
   (HTTP checks passed; layout was wrong). Playwright added because of that.
5. **Blank page** — `/cds-blank/`. Core heading + paragraph + default button, no
   recipe. Block defaults already resolve as Example Brand (PT Serif / Lato /
   cyan pill). That test is content only. It does not prove the chrome.
6. **Site Identity + header/footer.** Kit defaults: identity chrome in the
   parts, compiler `brand-defaults.json` + `assets/mark.svg`, theme seed and
   logo fallback. Probe review at `/cds-blank/`.
7. **Playwright gate.** Identity cluster, blank Core page, recipe bands, dark
   band. `sync-theme` runs `test:wp` when the probe is up.
8. **Section catalog.** Kit `sections.html` plus `.cds-split`. WordPress
   patterns for each job. Landing is a stack. Probe `/cds-catalog/` is every
   section. Inserter is not a museum. Page templates no longer double-constrain
   `post-content`. Proof is three even tracks on `wide`.

## Decision: native Site Identity, then branded chrome

Date: 2026-08-26

Context: A blank Core page can look like the kit while the frame still says
Studio leftover. A catalog of more Core blocks will not fix that. Header,
footer, and Site Identity are the fastest way the *site* feels like CDS.

WordPress already owns identity. Do not invent a second one.

| WP setting | Option / UI | Block that reads it |
| --- | --- | --- |
| Site Title | Settings → General → `blogname` | `core/site-title` |
| Tagline | Settings → General → `blogdescription` | `core/site-tagline` |
| Logo | Site Logo (`site_logo` attachment) | `core/site-logo` |
| Site Icon | Settings → General → `site_icon` | favicon, not the header mark |

Header and footer **must** compose those blocks. Do not hardcode “Example
Brand” (or any name) into `parts/header.html` / `parts/footer.html`. Forks
change identity in Settings / Site Editor; the templates keep working.

Default *values* come from `brand.json` via `brand-defaults.json`. The theme
seeds Site Title and Tagline on first run, and again after customize if WP
still holds the last seeded name. If no Site Logo is uploaded, the kit mark
in the theme is the fallback. Example Brand stays a placeholder identity, not
a real company.

What “feels branded” means here — a basic marketing shell, not a homepage:

- **Header:** logo + title + tagline + a short `core/navigation`. Kit tokens
  (ink, measure, space, a hairline `rule` or quiet paper-deep band). Readable
  as Example Brand in one glance.
- **Footer:** more than a muted title repeat. Logo or name, tagline or one
  quiet line, enough structure to feel finished. Still native identity blocks.

Options considered: port the kit sidebar; bake strings into the parts; leave
chrome for a later brand pack.

Choice: native Site Identity blocks + a real header/footer now, generic kit
only. The kit sidebar (`kit-*`) is reference-site chrome, not the system.
Roots & Fruit is a later brand pack, not this header.

Reversibility: two-way door.

Revisit trigger: chrome still feels like a stub with identity set, or a fork
cannot rebrand without editing the parts.

## Next (generic kit only)

Showcase walk is live on the kit HTML and the probe (Start → Color → Type →
Layout → Sections → The site). Header nav is that walk, not a page-list dump.

1. **Match kit specimens.** Side-by-side: `sections.html` vs `/cds-catalog/`,
   and `components.html` vs Core blocks. Same radius, button padding, ink.
   Fix the theme, not the kit.
2. **Author rules in the editor.** Style Book + a one-screen note. `WORDPRESS.md`
   is for agents; editors will not read it.
3. **Stop.** When 1–2 hold, then a brand-pack alias layer. Not production.

Re-seed the probe walk: `studio wp --path <probe> eval-file wordpress/probe-seed-showcase.php`

## Hard stops

- Do not read or copy `company-docs/brand/` (`--rf-*`, Knile, cream, atmosphere)
  into this theme.
- Do not invent hue picker slugs (`green`, `cream`, `orange`) or colour names
  `secondary` / `tertiary`.
- Do not install the Gutenberg plugin on the probe. Do not edit WordPress Core.
- Do not use the stock `frontend-design` skill to restyle this. The kit already
  owns color and type. That skill is for open axes only.
- Do not hand-edit generated `wordpress/cds/theme.json` or copied `assets/css/`
  kit files. Change `DESIGN.md` / `tokens.css` / `block-styles.css` / patterns,
  then compile and sync.
- Do not copy `kit-*` reference chrome (sidebar, kit footer, “Make it your
  own”) into the WordPress theme.
- Do not hardcode brand name, tagline, or mark paths in header/footer parts.
  Those come from WordPress Site Identity.

## Commands

```bash
npm run compile:wordpress
node scripts/sync-theme.mjs --dest "<wp-content/themes/cds>"
npm run test:wp
```

`sync-theme` copies the theme, then runs `test:wp` if WordPress is reachable.
Pass `--skip-test` to copy only.

Probe dest and Studio notes are hub-only: `HUB-CONTEXT.md` (gitignored).
