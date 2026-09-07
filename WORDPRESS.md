# WordPress contract

`DESIGN.md` is the source of truth. `theme.json` is a projection. This file
names the facts a compiler needs so it does not invent slugs, pickers, or
recipes.

Run `npm run compile:wordpress`. Output lives in `wordpress/cds/`.

A brand fork may alias private CSS (`--brand-green` → `primary`). Authors,
`theme.json` slugs, and other brands only see the semantic names in
`DESIGN.md`. Do not put hue names (`green`, `cream`, `orange`) or leftover
ranks (`secondary`, `tertiary`) on the paint picker.

---

## Token layers

Same as `DESIGN.md`. Repeated so this file can stand alone.

1. **Primitives** may be hue-named. Charts and scales. Not a theme picker.
2. **Semantic tokens** are jobs: `primary`, `ink`, `paper`, `accent`. WP slugs.
3. **Component tokens** bind a job to a control: `button-primary`, `on-primary`.

---

## Choose a layer

When a kit fact needs to exist in WordPress, pick **one** home. Ask in order.
Stop at the first yes. Inventory of what already landed: [`WORDPRESS-THEME-MAP.md`](WORDPRESS-THEME-MAP.md).

| # | Test | Home |
| --- | --- | --- |
| 1 | Is it a named step on a scale an author should pick onto a block? Colour jobs, type sizes, `space-1`…`8`, radii, quiet shadows. | **Presets** (Site Editor Global Styles). Lock custom hex, default palettes, gradients, fluid type. |
| 2 | Is it a *role* that is not a scale step, and putting it in the paint picker would break the system? Pairing (`on-primary`), `rule`, button radius/padding, surface padding, `contentSize` / `wideSize`, line-height optics. | **Custom design tokens** (`settings.custom` + `register_design_token()`). Forks retune globally. Authors do not free-paint them. |
| 3 | Should a blank Core block already look like the kit? Default button, heading, `post-content` gap, Group gap. | **Block / element defaults** in `theme.json` (`styles.blocks`, `styles.elements`). Per-block override stays legal. |
| 4 | Does Core have no honest object for it — or would the honest object lie? Copy proximity, Switcher, Frame, measure in `ch`, even inset. Columns for Split is the lie. | **Theme CSS**, usually plus a **block style** so authors opt in. Not a Global Styles slider. |
| 5 | Is it a page job, not a token? Hero, Dark band, landing. | **Pattern.** |

A **name for a step we already have** (`stack` = `space-5`) is test 1 plus a YAML alias, then test 3 and/or 4. It is not a new custom token.

**Site Editor leftover chrome** is not a sixth implementation layer. Use the Layout panel for content/wide (that *is* `contentSize` / `wideSize`). Use Settings for Site Identity. Turn tools **off** when they fight the kit. Do not put measure, gap jobs, or primitives in extra Layout fields.

| Kit fact | Layer |
| --- | --- |
| `paper`, `primary`, `display-xl`, `space-5` | Preset |
| `on-primary`, `rule`, button radius, `contentSize` | Custom token |
| `section` / `stack` / `grid` | YAML alias → block default and/or CSS |
| Measure, Copy, Switcher, Frame | Theme CSS (+ block style) |
| Last wash flush to footer | Theme CSS (`:has` on `main`) |
| Article + takeaways rail | Template `single`: `.cds-article-hero` (paper-deep wash, title, byline, excerpt) above `.cds-article-frame` (body + `sidebar-post`). Featured image as the hero photo is post meta `cds_hero_featured`, off by default. Not Group style Sidebar. Takeaways are a shell, not post meta. |
| Title-hidden landing | Template `page-canvas`. No `post-title`. Shared by The site, Offer, and Pricing. Do not invent `page-offer.html` or `page-pricing.html`. |
| Posts page H1 | `core/query-title` plus `cds_query_title_posts_page`. Core leaves the title empty on `is_home()`. |
| Dark band, hero | Pattern (`alignfull` where the job is a wash) |
| Logo, title, tagline | Site Identity, not a token |

Compiler writes presets, custom tokens, and block defaults from `DESIGN.md`. Theme CSS and patterns stay hand-owned. Do not hand-edit generated `theme.json`.

---

## Paint map

WP slug = semantic name. `info` stays off the marketing palette (Layer B).

| Slug | Layer | Author may paint? |
| --- | --- | --- |
| `paper` | semantic | Yes — page wash |
| `paper-deep` | semantic | Yes — alternating bands |
| `surface` | semantic | Yes — cards |
| `panel` | semantic | Yes |
| `panel-soft` | semantic | Yes |
| `panel-deep` | semantic | Optional (picker noise) |
| `ink` | semantic | Yes — body |
| `ink-deep` | semantic | Yes — headings |
| `ink-muted` | semantic | Yes — captions |
| `ink-soft` | semantic | No — Layer B |
| `primary` / `primary-deep` / `primary-soft` | semantic | Yes |
| `accent` / `accent-soft` | semantic | Yes — one CTA fill, never a theme |
| `surface-dark` | semantic | Yes — dark callout |
| `success` / `warning` / `danger` (+ soft) | semantic | Yes — status |
| `on-primary` / `on-accent` / `on-dark` / `on-dark-muted` | component | No — pairing |
| `rule` | semantic | No — default border |
| `info` / `info-soft` | semantic | Product UI only |

---

## Layout, elevation, focus

First-class YAML on `DESIGN.md` (customize does not overwrite these):

```yaml
layout:
  measure: 62ch
  content-size: 60rem
  wide-size: 60rem
  gutter: "{spacing.5}"
  inset: "{spacing.6}"
  cluster: "{spacing.3}"
  stack: "{spacing.5}"
  grid: "{spacing.5}"
  section: "{spacing.6}"
  split: "{spacing.7}"
elevation:
  sm: "…"
  md: "…"
focus:
  ring: "…"
```

| Use | `theme.json` |
| --- | --- |
| Page shell | `contentSize` and `wideSize` both ← 60rem (`--cds-max`) |
| Reading column | Layer C: prose still uses `measure` (`ch`) |
| Gap jobs | YAML `layout.cluster` / `stack` / `grid` / `section` / `split`. Aliases of `space-*`, not Layer B. Compiler: `buttons` ← cluster, `group` + root ← stack, `post-content` ← section. CSS: `--cds-*` on primitives and Core grid. Do not turn on `settings.spacing.blockGap` until layout jobs that hide a first child (Best Offer pill) and last-wash flush are accounted for. Space stacked `core/details` with `.wp-block-details + .wp-block-details` so the front matches the editor (the editor spaces `.wp-block` wrappers; the front does not). |

Keep the content / wide split in Core, and set both to the header column for
now. A 40rem `contentSize` next to a 60rem header looks like leftover margin,
not a reading column. The `ch` measure is the reading column. A post with a complementary rail
uses `.cds-article-hero` above `.cds-article-frame` on `single` (body first in the frame). Default `page` stays
the 60rem shell with no rail.

**Templates:** one constrained layout, on `post-content`. The article title
lives in `.cds-article-hero` with default layout (constrained shrink-wraps the
H1). `main` stays default flow so `alignfull` can reach the viewport.
Do not nest a constrained Group around `post-content`. `main`’s bottom margin
is `--cds-section` in `block-styles.css`, not an inline template style — a last
`alignfull` wash zeroes it so it can meet the footer. Site Editor → Styles →
Layout content/wide must stay these sizes. That panel does not fix a template
that double-constrains.

**Bands:** `proof`, `split`, and `dark-band` are `alignfull` washes. Inner
marketing column is 60rem (content and wide are the same today): hero, proof
stats, split, card grid, dark-band copy, CTA. That is the same column as the
header. Flow text still caps at `measure`. A last wash flushes to the footer;
`layout.section` is not a paper stripe between two full-bleed bands. Proof is
three or five centered tracks. Do not auto-fit four or five tiles into a leftover.

**Visual locks (`npm run test:wp`):** these are layout facts, not a screenshot
suite. Fail the build if they drift. A landing wash is wider than the hero and
reaches the viewport. Hero is two tracks (copy plus media) with a pill eyebrow.
The copy column is `.cds-copy` (proximity, not an even stack gap).
Hero and proof stats share `wideSize`. Proof has five tracks and five children.
Proof numbers are centered in their track. Card-grid
tiles use three different fills; heading, body, and outline label meet WCAG AA
against the tile. Outline hover on tint and dark fills a colour that is not the
tile. Hero and Split two-up is a Group with style Switcher, not `core/columns`.
Painted Groups (surface, tint, panel, dark) and `.has-background` use even
`--cds-inset`, same as kit `.cds-surface` / `.cds-box`. A blank paragraph's
`max-inline-size` is `--cds-measure` (`ch`), start-aligned with the title, not
centred in the shell. Group style Center is the centred measure. Hero images
have no prescribed px width or height. Photos use Image style Frame. A last
dark (or paper-deep) wash on `/the-site/` meets the footer; catalog CTA still
keeps section gap. Pricing is three plan cards at 1280, Best Offer in the
middle, one primary, six `core/details`. A details block is the column width
open or closed. Do not treat HTTP 200 as “it looks right.”

Spacing slugs: `space-1` … `space-8`. Fluid type is off.

---

## Type split

Composites stay in `DESIGN.md`. WP gets families + sizes + optics.

| Role | `fontSize` | `fontFamily` | Optics |
| --- | --- | --- | --- |
| `display-xl` … `display-sm` | same slug | `display` | leading / tracking from the composite |
| `body-lg` / `body-md` / `body-sm` | same slug | `body` | leading `body` or `ui` |
| `label` / `meta` | same slug | `body` | weight / tracking |
| `code` | `code` | `mono` | — |

Family *files* are a brand pack. Do not commit licensed WOFF2s.

---

## Recipes

Authors start from sections. Pages compose them. Markup: `wordpress/cds/patterns/`.
Specimens in the kit: `sections.html`.

### Sections

| Recipe | Job |
| --- | --- |
| `cds/hero` | Pill, display title, lede, one primary, optional proof cluster, media on the right. Paper. Not a page. |
| `cds/proof` | Five centered stats on wide, inside a full-bleed paper-deep wash. Three-up is also legal. No leftover tile. |
| `cds/card-grid` | Three paired fills (surface, tint, dark). Title, one line, optional outline link. |
| `cds/split` | Copy plus media. Kit `.cds-split`; WordPress Group style Switcher. |
| `cds/quote` | One attribution on a surface. Not a carousel. |
| `cds/dark-band` | Callout strip. `on-dark` title. One accent button max. Not a page. |
| `cds/cta` | Short `display-sm` + one button (primary or accent, not both) |
| `cds/alert` | Status note. Never a hero. Tone is the group fill. |

### Pages

| Recipe | Job |
| --- | --- |
| `cds/article` | Measured prose → one CTA. Title, excerpt, and takeaways live in the `single` template. Paper. |
| `cds/landing` | Hero, proof, card grid. One primary, on the hero. Assign `page-canvas` so the hero is the only `h1`. |
| `cds/pricing` | Three plans (middle Best Offer, one primary), guarantee, proof, a short validator, FAQ. Assign `page-canvas`. Not a ninth section job. |

`cds/catalog` stacks every section for the probe. Walk `/sections/` is that
stack (Canvas, so the hero `h1` is the only title). Walk `/pieces/` is the
Core allowlist (quote, table, details, buttons, code). `cds/layout-home` is a
homepage composition probe (same jobs, Inserter off). Inserter stays off for
catalog and layout-home.

Button styles: `cds-secondary`, `cds-outline`, `cds-accent`, `cds-ghost`.
Group **Styles** (paint only): `cds-surface`, `cds-tint`, `cds-panel`,
`cds-dark`. Group **layout** (Copy, Cluster, Switcher, Sidebar, Center, Box)
is a class (`cds-copy`, …) picked from the Arrangement sidebar so a
background (Surface, Tint, Panel, Dark) and an arrangement can share one Group. Saved `is-style-cds-copy` still paints;
selecting that Group in the editor rewrites it to `cds-copy`. Nested groups
stay valid (Switcher parent, Copy child). Paragraph style: `cds-pill`. Image
styles: `cds-frame`, `cds-original`. Do not register a Columns style for Split.

**Allowed Core (marketing):** paragraph, heading, list, quote, image, buttons,
group, columns, separator, details, table, code / preformatted, navigation in
templates, social-links in the footer. Columns stay for genuine tabular columns. Two-up marketing uses
Switcher. No page-builder blocks. No custom HTML unless a recipe names it.

---

## Author rules

**May change globally:** paper / ink / primary from the curated palette; type
size from the scale; spacing from `space-1`–`space-8`; Group layout (Copy,
Cluster, Switcher, Sidebar, Center, Box — Arrangement panel); Group fill (surface /
tint / panel / dark — Styles); paragraph style Pill; image Frame or Original.

**May not:** custom hex; WP default palette or gradients; custom font size;
fluid type; `info` on marketing; accent as a background theme; pairing colours
as free fills; more than one primary button or one accent CTA per view.

Pairing lives in Custom tokens, not the colour picker.

---

## Site Identity

Header and footer are kit defaults. They compose Core Site Identity blocks
(`core/site-logo`, `core/site-title`, `core/site-tagline`, `core/navigation`).
The footer adds `core/social-links` under the brand cluster, then three labeled
link columns (Product, Explore, Legal). Do not hardcode the brand name in the parts.

The compiler writes `wordpress/cds/brand-defaults.json` from `brand.json` and
copies `assets/mark.svg` into the theme. On first run (and after customize, if
the WP title still matches the last seed) the theme sets Site Title and
Tagline from those defaults. If no Site Logo is uploaded, the block renders
the kit mark.

`npm run test:wp` is the visual gate. `sync-theme` runs it when the probe is up.

---

## Related

- Kit contract: [`DESIGN.md`](DESIGN.md)
- Theme map (inventory of slugs per layer): [`WORDPRESS-THEME-MAP.md`](WORDPRESS-THEME-MAP.md)
- Theme: [`wordpress/cds/`](wordpress/cds)
- Visual check: `npm run test:wp`
- Next session: [`wordpress/HANDOFF.md`](wordpress/HANDOFF.md)
