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
  `cds/alert`) and page recipes (`cds/article`, `cds/landing`, `cds/pricing`). Landing is a
  stack of sections. Button styles: secondary / outline / accent / ghost.
  Group Styles are paint only (surface / tint / panel / dark). Copy, Cluster,
  Switcher, Sidebar, Center, Box sit in the Group sidebar (Arrangement) so a
  background can share the Group. Image styles: Frame / Original.
  Two-up marketing is Switcher, not Columns. Walk: Pieces is the Core allowlist
  (`/pieces/`). Sections is the stacked catalog (`/sections/`).
- Token layers (primitive → semantic → component) live in `DESIGN.md`.
- Layout / elevation / focus are YAML on `DESIGN.md`. Customize does not own them.
- Visual check: `npm run test:wp`. Layout locks, not screenshots: identity,
  blank Core defaults, paragraph measure in `ch`, catalog wash vs `wide` column, two-track Switcher hero with pill,
  five centered proof tracks, card-grid fills + AA contrast + tint/dark outline hover, dark-band paint,
  layout walk (Copy proximity, Switcher, Sidebar, Frame ratio, even Box inset), last wash flush to footer on `/the-site/`, article frame + rail, articles list, offer canvas, pricing canvas, details column width. `sync-theme` runs this when the probe is up
  (`--skip-test` to copy only).
- Page / single / front templates: `main` is default flow. Constrained layout
  lives on `post-content` (and a title wrapper). `alignfull` washes can reach
  the viewport. Do not wrap `post-content` in a second constrained Group.
- The kit **Sections** page is the catalog (`sections.html`). WordPress
  projects the same jobs as patterns. The walk stacks them on `/sections/`.
  Proof is five centered stats on `wide` inside a full-bleed wash. Hero is a
  Switcher: pill, title, lede, one primary, proof cluster, media. Card grid
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
- **Footer:** brand cluster plus social links underneath, then three labeled
  columns (Product, Explore, Legal) including Privacy and Terms. Still native
  identity blocks — no hardcoded brand name.

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
Layout → Pieces → Sections → The site). Header nav is that walk, not a page-list dump.

1. **Match kit specimens.** Side-by-side: `sections.html` vs `/sections/`,
   and `components.html` vs `/pieces/`. Same radius, button padding, ink.
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

## Phase 1 — Article frame (2026-09-07)

**Shipped.** `single.html` uses `.cds-article-frame` (content first, `aside` last). Part `sidebar-post` is a panel + “Key takeaways” list of three (shell, not post meta). Pattern `cds/article` is body + CTA only. Probe post: `/sample-essay/` (category Essay). `page_for_posts` is still `0`. Playwright: `wordpress/e2e/article.spec.js`. Compiler lists `sidebar-post` in `theme.json`.

**Audit.** No JS for sticky. No extra enqueue. Layout walk Sidebar specimen unchanged. Dropped unused `THIRD_PARTY_BLOCK_SELECTOR`. Three CSS exceptions on the frame are load-bearing, not decoration: (1) skip the 60rem `cqi` start pin, (2) `post-title` full width so constrained layout cannot centre a shrink-wrapped heading, (3) zero `post-content` inline padding (`has-global-padding` is 24px and the hero Copy group does not have it). Do not delete those to “simplify.”

**What we learned.** Group style Sidebar is the wrong object (first child is the side). Nested `constrained` inside a column that is already narrower than `--cds-max` auto-centres shrink-wrapped titles. `getComputedStyle` resolves `ch` to px — lock measure the same way as the blank page. Phase 2 must not put `.cds-article-frame` on the archive. Archive is a **one-column list**, not card-grid, not Sidebar.

**Next.** `home.html` Query Loop + Posts page `articles`. Click through to `/sample-essay/`; do not re-assert rail geometry.

## Phase 2 — Articles index (2026-09-07)

**Shipped.** `home.html` and `index.html` share the same Query Loop (terms, h2 title link, date, excerpt + Read more). Posts page `/articles/` is empty content; `page_for_posts` is that page. `cds_query_title_posts_page` fills Core `query-title` on `is_home()` (Core leaves it empty because the posts page is not an archive). Playwright: `wordpress/e2e/archive.spec.js`.

**Audit.** Two template files because WP hierarchy (`home` vs `index`), not a nested pattern (those render empty in post content on this probe). No `.cds-article-frame` on the list. One-column gap is `--cds-section` on `.wp-block-post-template`. Filter is small and only runs on the posts page.

**What we learned.** `core/query-title` does not print the Posts page title without a render filter. Phase 3 must not assign Offer to `page.html` (that template prints `post-title` and landing already has an `h1`).

## Phase 3 — Offer canvas (2026-09-07)

**Shipped.** `page-the-site.html` is now `page-canvas.html` (no `post-title`, `main` margin-top 0). The site and Offer both use it. `/offer/` is inlined `cds/landing` (hero + proof + card-grid). Compiler registers custom template **Canvas**. Playwright: `wordpress/e2e/offer.spec.js`. `/the-site/` flush still passes.

**Audit.** No twin `page-offer.html`. Landing nested `wp:pattern` refs are inlined in the seed (same probe rule as The site). Default `page.html` still prints a title — that is correct for Color / Type / Layout / Sections.

**What we learned.** One title-hidden canvas is enough for landing jobs. Assign the template in meta; do not rely on `page-{slug}.html` auto-match unless the page slug is the template name.

**Nav (2026-09-07).** Header walk is Start, Color, Type, Layout, Pieces, Sections, The site. **The site** is a submenu: Offer, Pricing, Articles, then **A measured essay** under Articles. Labels come from post titles. Seed writes nested `cds_showcase_nav`; `cds_navigation_item_markup` emits `navigation-submenu`. Playwright: `wordpress/e2e/nav.spec.js`.

## Article hero above the rail (2026-09-07)

**Shipped.** Title, byline, and excerpt sit in `.cds-article-hero` (paper-deep wash, flush under the header, `space-7` padding, rule border). Inner column is 60rem. Featured image as the wash is a post sidebar checkbox (`cds_hero_featured`), off by default. `.cds-article-frame` is only body + sticky rail. Excerpt uses lede type. Author avatar uses the kit mark until a real photo loads. Playwright: `wordpress/e2e/article.spec.js` (sticky lock is the inset, not a 400px delta).

**Next.** Out of this plan. Research CPT, LCF takeaways, and extra singles stay parked.

## Pricing canvas (2026-09-07)

**Shipped.** `/pricing/` is inlined `cds/pricing` on `page-canvas`. Three plan cards (Start / Team / Studio), Best Offer on Team, one primary, guarantee, nested proof, a short validator, six `core/details`. Not a ninth section. Playwright: `wordpress/e2e/pricing.spec.js`.

**Audit.** No `page-pricing.html`. No Columns. No second primary (`cds/cta` stays off this page). Seed inlines `cds/proof`. Nav: Pricing sits under The site, after Offer. FAQ details use `.wp-block-details + .wp-block-details` stack gap on the front (editor already spaces `.wp-block` wrappers). Do not enable `settings.spacing.blockGap` until the Best Offer pill and last-wash flush are accounted for.
