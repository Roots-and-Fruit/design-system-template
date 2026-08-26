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
  content-size: 40rem
  wide-size: 60rem
  gutter: "{spacing.5}"
elevation:
  sm: "…"
  md: "…"
focus:
  ring: "…"
```

| Use | `theme.json` |
| --- | --- |
| Marketing / blog | `contentSize` ← `layout.content-size`, `wideSize` ← `layout.wide-size` |
| Reading column | Layer C: prose still uses `measure` (`ch`) |

`content-size` stays `40rem` so Core alignment has a rem unit. The `ch` measure
is the reading column, not the align width.

**Templates:** one constrained layout, on `post-content` (and on the post title
wrapper). `main` stays default flow so `alignfull` can reach the viewport.
Do not nest a constrained Group around `post-content`. Site Editor → Styles →
Layout content/wide must stay these sizes. That panel does not fix a template
that double-constrains.

**Bands:** `proof`, `split`, and `dark-band` are `alignfull` washes. Inner
marketing column is `wideSize` (60rem): hero, proof stats, split, card grid,
dark-band copy, CTA. That is the same column as the header. `contentSize`
(40rem) is the article reading column, not the landing column. Proof is three
or five centered tracks. Do not auto-fit four or five tiles into a leftover.

**Visual locks (`npm run test:wp`):** these are layout facts, not a screenshot
suite. Fail the build if they drift. A landing wash is wider than the hero and
reaches the viewport. Hero is two tracks (copy plus media) with a pill eyebrow.
Hero and proof stats share `wideSize`. Proof has five tracks and five children.
Proof numbers are centered in their track. Card-grid
tiles use three different fills; heading, body, and outline label meet WCAG AA
against the tile. Outline hover on tint and dark fills a colour that is not the
tile. Do not treat HTTP 200 as “it looks right.”

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
| `cds/split` | Copy plus media. Kit `.cds-split`; WordPress `core/columns` style Split. |
| `cds/quote` | One attribution on a surface. Not a carousel. |
| `cds/dark-band` | Callout strip. `on-dark` title. One accent button max. Not a page. |
| `cds/cta` | Short `display-sm` + one button (primary or accent, not both) |
| `cds/alert` | Status note. Never a hero. Tone is the group fill. |

### Pages

| Recipe | Job |
| --- | --- |
| `cds/article` | Eyebrow → lede → measured prose → one CTA. Paper. |
| `cds/landing` | Hero, proof, card grid. One primary, on the hero. |

`cds/catalog` stacks every section for the probe. `cds/layout-home` is a
homepage composition probe (same jobs, Inserter off). Inserter stays off for
both.

Button styles: `cds-secondary`, `cds-outline`, `cds-accent`, `cds-ghost`.
Group styles: `cds-surface`, `cds-tint`, `cds-panel`, `cds-dark`.
Paragraph style: `cds-pill`.
Columns style: `cds-split`.

**Allowed Core (marketing):** paragraph, heading, list, quote, image, buttons,
group, columns, separator, details, table, code / preformatted, navigation in
templates. No page-builder blocks. No custom HTML unless a recipe names it.

---

## Author rules

**May change globally:** paper / ink / primary from the curated palette; type
size from the scale; spacing from `space-1`–`space-8`; Group style (surface /
tint / panel / dark); paragraph style Pill.

**May not:** custom hex; WP default palette or gradients; custom font size;
fluid type; `info` on marketing; accent as a background theme; pairing colours
as free fills; more than one primary button or one accent CTA per view.

Pairing lives in Custom tokens, not the colour picker.

---

## Site Identity

Header and footer are kit defaults. They compose Core Site Identity blocks
(`core/site-logo`, `core/site-title`, `core/site-tagline`, `core/navigation`).
Do not hardcode the brand name in the parts.

The compiler writes `wordpress/cds/brand-defaults.json` from `brand.json` and
copies `assets/mark.svg` into the theme. On first run (and after customize, if
the WP title still matches the last seed) the theme sets Site Title and
Tagline from those defaults. If no Site Logo is uploaded, the block renders
the kit mark.

`npm run test:wp` is the visual gate. `sync-theme` runs it when the probe is up.

---

## Related

- Kit contract: [`DESIGN.md`](DESIGN.md)
- Theme map (layers, block defaults): [`WORDPRESS-THEME-MAP.md`](WORDPRESS-THEME-MAP.md)
- Theme: [`wordpress/cds/`](wordpress/cds)
- Visual check: `npm run test:wp`
- Next session: [`wordpress/HANDOFF.md`](wordpress/HANDOFF.md)
