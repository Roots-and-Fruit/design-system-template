# WordPress theme map — DESIGN.md → FSE

**Contract:** [`WORDPRESS.md`](WORDPRESS.md) is normative — start at **Choose a layer**. This file is the inventory (which slug landed in which bucket). Values come from `DESIGN.md` front matter and `css/tokens.css` (`--cds-*`).

**Assumptions**

- Custom design-token UI for FSE ships in the theme or a companion plugin (per [gutenberg#76509](https://github.com/WordPress/gutenberg/issues/76509)), without waiting for Core. Probe uses the MU-plugin `register_design_token()`; do not install the Gutenberg plugin.
- `DESIGN.md` remains normative. `theme.json` is a WordPress projection. `--cds-*` stays the CSS SoR. Preset slugs are **semantic** names (`paper`, `ink`, `primary`, `accent`). Hue names stay on primitives.
- Core blocks get purposeful defaults so a blank page already speaks the system.

Do not invent a new projection layer because a Site Editor panel exists. Layout content/wide *is* `contentSize` / `wideSize`. Measure, gap jobs, and kit primitives are not extra Layout fields.

---

## 1. Projection layers

Same five homes as *Choose a layer*. A–E here are the implementation names.

| Layer | Role | Editable in FSE? |
| --- | --- | --- |
| A. WordPress presets | `settings.color.palette`, `fontFamilies`, `fontSizes`, `spacingSizes`, `border.radiusSizes`, `shadow.presets` | Yes (Global Styles) |
| B. Custom tokens + UI metadata | `settings.custom` + `register_design_token()` | Yes (custom-token UI, not the paint picker) |
| C. Structural CSS | Enqueued `--cds-*` (measure, ratio, tracking, chart ramp, primitive gaps) | No (developer / sync only) |
| D. Block & element defaults | `styles.elements`, `styles.blocks` | Overrides via Global Styles |
| E. Patterns / block styles | Section jobs; opt-in primitives (Switcher, Copy, Frame) | Pattern inserter / block style |

Sync direction: `brand.json` → `tokens.css` + `DESIGN.md` front matter (`npm run customize`) → `wordpress/theme.json` + `wordpress/design-tokens.json` (`npm run compile:wordpress`; customize already runs it). Do not hand-maintain three palettes. Do not hand-edit generated `theme.json`.

---

## 2. Token map

### 2.1 Colors → Layer A (palette) and Layer B (roles that should stay out of the picker)

**Rule:** Anything an author should paint onto a block belongs in the palette. Pairing tokens (`on-*`), rules, and chart ramps usually stay Layer B/C so the picker stays small.

| DESIGN.md / `--cds-*` | theme.json | Layer | Notes |
| --- | --- | --- | --- |
| `paper` | palette slug `paper` | A | Page wash; also root `styles.color.background` |
| `paper-deep` | `paper-deep` | A | Alternating bands |
| `surface` | `surface` | A | Cards / lifted modules |
| `panel` | `panel` | A | Quiet grouping |
| `panel-soft` | `panel-soft` | A | Notes, code paper, table headers |
| `panel-deep` | `panel-deep` | A optional | Or Layer B if picker gets noisy |
| `ink` | `ink` | A | Body text; root `styles.color.text` |
| `ink-deep` | `ink-deep` | A | Headings |
| `ink-muted` | `ink-muted` | A | Captions / secondary |
| `ink-soft` | `ink-soft` | A optional | Meta only; consider Layer B |
| `primary` | `primary` | A | Links, primary actions |
| `primary-deep` | `primary-deep` | A | Hover / pressed (also styles) |
| `primary-soft` | `primary-soft` | A | Soft fills / chips |
| `accent` | `accent` | A | Rare CTA fill |
| `accent-soft` | `accent-soft` | A optional | |
| `surface-dark` | `surface-dark` | A | Dark bands |
| `success` / `warning` / `danger` / `info` | same slugs | A | Status; keep separate from accent |
| `success-soft` … `info-soft` | soft variants | A optional | Useful for Group backgrounds |
| `on-primary`, `on-accent`, `on-dark`, `on-dark-muted` | custom | B | Pairing tokens; expose in FSE custom-token UI, not as free paint colors |
| `rule` | custom | B | Border default |
| `primary-1` … `primary-5` (CSS ramp) | custom or omit | C | Charts / illustration; usually not editor paint |

**Editor policy (recommended):** `settings.color.custom: false`, `defaultPalette: false`, `defaultGradients: false`. Authors pick from the curated palette only.

**CSS output:** presets become `--wp--preset--color--{slug}`. Prefer values that equal or `var()`-alias `--cds-{slug}` so one SoR remains.

### 2.2 Typography → Layer A (split composites) + Layer B (optical roles)

DESIGN.md typography tokens are **composites** (family + size + weight + line-height + tracking). WordPress splits these. Projection:

| DESIGN.md composite | WP fontSize slug | WP fontFamily | Layer B custom (optical) |
| --- | --- | --- | --- |
| `display-xl` | `display-xl` (`--cds-text-4xl`) | `display` | `lineHeight.display`, `letterSpacing.display` |
| `display-lg` | `display-lg` | `display` | same |
| `display-md` | `display-md` | `display` | same |
| `display-sm` | `display-sm` | `display` | `lineHeight.snug` |
| `body-lg` | `body-lg` | `body` | `lineHeight.body` |
| `body-md` | `body-md` (default) | `body` | `lineHeight.body` |
| `body-sm` | `body-sm` | `body` | `lineHeight.ui` |
| `label` | `label` (same size as `body-sm`) | `body` | weight via element/button defaults |
| `meta` | `meta` | `body` | `letterSpacing.meta` + uppercase via CSS / block style |
| `code` | `code` | `mono` | `lineHeight` for code |

**Font families (Layer A)**

| Slug | Source | Loading |
| --- | --- | --- |
| `display` | `typography.display-*.fontFamily` / `--cds-font-display` | `theme.json` `fontFace` and/or enqueue from `css/fonts.css` |
| `body` | `--cds-font-body` | same |
| `mono` | `--cds-font-mono` | same |

**Custom FSE tokens (Layer B) — typography**

| Token key | Type | Default source | Why custom UI |
| --- | --- | --- | --- |
| `lineHeight.display` | number | `--cds-leading-display` | Not a first-class Global Styles scale today |
| `lineHeight.snug` | number | `--cds-leading-snug` | |
| `lineHeight.body` | number | `--cds-leading-body` | |
| `lineHeight.callout` | number | `--cds-leading-callout` | |
| `lineHeight.ui` | number | `--cds-leading-ui` | |
| `letterSpacing.display` | dimension | `--cds-tracking-display` | |
| `letterSpacing.meta` | dimension | `--cds-tracking-meta` | |
| `fontWeight.regular` | number | `--cds-weight-regular` | |
| `fontWeight.emphasis` | number | `--cds-weight-semibold` / bold | Kit may map “semibold” → 700 |
| `fontWeight.bold` | number | `--cds-weight-bold` | |

**Editor policy:** `settings.typography.customFontSize: false`, `defaultFontSizes: false`, `fluid: false` unless a fork explicitly opts into fluid type (this kit’s prose prefers optical steps).

### 2.3 Spacing → Layer A

| DESIGN.md `spacing.*` | WP `spacingSizes` slug | CSS |
| --- | --- | --- |
| `1` | `space-1` | `--cds-space-1` |
| `2` | `space-2` | `--cds-space-2` |
| … | … | … |
| `8` | `space-8` | `--cds-space-8` |

Numeric YAML keys are awkward as WP slugs; always prefix `space-`. Set `defaultSpacingSizes: false`. Root `styles.spacing.blockGap` → `space-5` (kit default stack rhythm).

### 2.4 Rounded → Layer A

| DESIGN.md `rounded.*` | WP `border.radiusSizes` slug |
| --- | --- |
| `sm` | `sm` |
| `md` | `md` |
| `lg` | `lg` |
| `pill` | `pill` |

### 2.5 Layout shell → Layer B (sizes) + Layer C (gap jobs)

`contentSize` / `wideSize` stay Layer B (dimensions, not space-scale steps). Gap jobs live in DESIGN.md `layout:` as aliases of `spacing.*`. They are **not** extra spacing presets and **not** Layer B custom tokens.

| Token key | Type | Default source | WP projection |
| --- | --- | --- | --- |
| `layout.contentSize` | dimension | `layout.content-size` / `--cds-max` (60rem) | `theme.json` `settings.layout.contentSize` (Layer B) |
| `layout.wideSize` | dimension | `layout.wide-size` / `--cds-max` (60rem) | `theme.json` `settings.layout.wideSize` (Layer B) |
| `layout.measure` | dimension | `--cds-measure` (`62ch`) | Layer C `block-styles.css` |
| `layout.gutter` | spacing step | `{spacing.5}` | Root inline padding |
| `layout.inset` | spacing step | `{spacing.6}` | `--cds-inset`; surface padding |
| `layout.cluster` | spacing step | `{spacing.3}` | `core/buttons` `blockGap`; `--cds-cluster` |
| `layout.stack` | spacing step | `{spacing.5}` | Root + `core/group` `blockGap`; `--cds-stack` |
| `layout.grid` | spacing step | `{spacing.5}` | `--cds-grid` on `.cds-grid` and Core `is-layout-grid` |
| `layout.section` | spacing step | `{spacing.6}` | `core/post-content` `blockGap`; `--cds-section`; `main` `margin-block-end` (0 when last child is an `alignfull` wash) |
| Article rail | template | `--cds-sidebar-side` + `--cds-split` | `single.html`: `.cds-article-hero` (paper-deep; featured photo via `cds_hero_featured`) above `.cds-article-frame`; part `sidebar-post`. |
| Title-hidden landing | template | — | `page-canvas.html`. Hide `post-title`; `main` margin-top 0. The site, Offer, and Pricing share it. |
| Posts page title | PHP filter | — | `cds_query_title_posts_page` fills `core/query-title` on the Posts page. |
| `layout.split` | spacing step | `{spacing.7}` | `--cds-split` on Switcher / Sidebar / Stack `--lg` |

If grid should diverge from stack, change the YAML step. Do not add `cds/layout-grid` to the custom-token registry.

### 2.6 Elevation → Layer A (shadow presets) + Layer B

DESIGN.md Elevation is mostly prose; kit CSS may define quiet shadows. Propose:

| Token | Layer | Notes |
| --- | --- | --- |
| `shadow.sm` / `shadow.md` | A `settings.shadow.presets` | Quiet lift; disable `defaultPresets` |
| `border.default` → `rule` | B | 1px rule as default surface edge |

**Gap:** no `elevation` / `shadow` map in DESIGN.md front matter. Candidates to add to the generic template.

### 2.7 Components → Layer B (component tokens) + Layer D (block defaults)

Component entries in DESIGN.md are **not** WordPress blocks. Project them as:

1. Custom tokens for values authors might tune globally (button radius, button padding, surface padding, input radius).
2. Block style variations or pattern recipes for variants (primary / outline / accent / ghost buttons; alert tones; pills).

| DESIGN.md component | Custom FSE token(s) | Core target |
| --- | --- | --- |
| `page` | (root styles) | `styles.color` + `styles.typography` |
| `heading` / `subhead` | — | `styles.elements.h1`–`h3`, `core/heading` |
| `body` / `muted` | — | `styles.typography`, `core/paragraph` |
| `link` | — | `styles.elements.link` |
| `button-primary` | `button.radius`, `button.padding-block`, `button.padding-inline` | `styles.elements.button`, `core/button` |
| `button-secondary` | — | block style `is-style-cds-secondary` |
| `button-outline` | — | Core outline + token color, or `is-style-cds-outline` |
| `button-accent` | — | `is-style-cds-accent` |
| `button-ghost` | — | `is-style-cds-ghost` |
| `input` | `input.radius`, `input.padding` | `core/search`, forms CSS (Fluent etc. separate) |
| `surface` / `surface-panel` / `surface-dark` | `surface.radius`, `surface.padding` | `core/group` styles / block styles |
| `alert-*` | — | Group + pattern, or `core/paragraph` in Group with background |
| `pill` / `pill-*` | — | Paragraph style `cds-pill`; status tones stay kit classes |
| `table-header` | — | `core/table` |
| `code-inline` / `code-block` | — | `styles.elements.code`, `core/code`, `core/preformatted` |

**Recommended Layer B component tokens (FSE UI via theme/plugin)**

| Key | Type | From |
| --- | --- | --- |
| `button.radius` | border-radius | `components.button-primary.rounded` → usually `pill` |
| `button.padding-block` | spacing | parse `padding` |
| `button.padding-inline` | spacing | parse `padding` |
| `input.radius` | border-radius | `rounded.sm` |
| `surface.radius` | border-radius | `rounded.md` |
| `surface.padding` | spacing | `layout.inset` / `--cds-inset` |

---

## 3. Core block & element defaults

Defaults use `var:preset|…` / `var:custom|…` so they track the token map. Names below follow this kit’s roles (`paper`, `ink`, `primary`, …).

### 3.1 Global (`styles`)

| Path | Default intent |
| --- | --- |
| `color.background` | `paper` |
| `color.text` | `ink` |
| `typography.fontFamily` | `body` |
| `typography.fontSize` | `body-md` |
| `typography.lineHeight` | custom `lineHeight.body` |
| `spacing.blockGap` | `layout.stack` (`space-5`) |
| `spacing.padding` (root) | inline `layout.gutter`; block `0` |

### 3.2 Elements (`styles.elements`)

| Element | Defaults |
| --- | --- |
| `link` | text `primary`; weight from `label`; underline on hover only (or underline always if a11y fork prefers) |
| `button` | bg `primary`, text `on-primary`, radius from `button.radius` (pill), padding from button tokens, font `body` + `label` size/weight; hover bg `primary-deep` |
| `caption` | `ink-muted`, `body-sm` |
| `cite` | `ink-muted`, `body-sm` |
| `h1` | family `display`, size `display-xl`, color `ink-deep`, lineHeight display, letterSpacing display |
| `h2` | `display-lg` |
| `h3` | `display-md` |
| `h4` | `display-sm` |
| `h5` | `body-lg` + weight emphasis (or keep display-sm smaller forks) |
| `h6` | `label` / `body-sm` + emphasis |
| `heading` | family `display`, color `ink-deep` (shared) |
| `code` | family `mono`, bg soft panel, radius `sm` (inline) |

### 3.3 Blocks — priority set (ship first)

These are the blocks that make the design language feel authoritative on day one.

| Block | Default styles (intent) | Block styles / notes |
| --- | --- | --- |
| `core/paragraph` | inherits body; `.has-background` gets `space-3`–`space-4` padding | |
| `core/heading` | inherits elements; margin-block-end ≥ `space-3` | |
| `core/list` / `list-item` | gap rhythm; item margin-bottom `space-2`–`space-3` | |
| `core/quote` | border-inline-start `primary` 4–5px; padding-inline `space-5`; cite muted | |
| `core/pullquote` | stronger border or display size; cite muted | |
| `core/code` | `code-block` component: panel-soft bg, mono, radius `md`, padding `space-4` | |
| `core/preformatted` | same as code | |
| `core/table` | header row → `table-header` (panel-soft + label) | |
| `core/separator` | color `ink` or `rule`; style wide optional | |
| `core/buttons` / `core/button` | element button; gap `space-3` | Styles: `cds-secondary`, `cds-outline`, `cds-accent`, `cds-ghost` |
| `core/group` | no forced card; constrained layout default | Styles: `cds-surface`, `cds-tint`, `cds-panel`, `cds-dark` (map to surface components) |
| `core/columns` / `column` | blockGap `space-5` | |
| `core/image` | radius optional `md` for framed media | |
| `core/cover` | dim overlay using `ink-deep` / dark; title uses `on-dark` | |
| `core/navigation` | weight emphasis; link hover underline; color `ink` | |
| `core/site-title` | `body` or `label`, weight emphasis; no decoration on link | |
| `core/site-tagline` | `ink-muted`, `body-sm` | |
| `core/post-title` | display scale by context (single vs query) | |
| `core/post-excerpt` | `ink-muted` or body | |
| `core/post-date` / `post-terms` | `meta` / muted | |
| `core/query-pagination` | button-like links using surface/panel | |
| `core/search` | input tokens (radius sm, surface bg) | |
| `core/details` | summary weight emphasis; column width open or closed (`--cds-max`, `cqi` so a flex parent cannot shrink-wrap) | Kit `.cds-details` |

### 3.4 Blocks — second wave

`core/gallery`, `core/media-text`, `core/row`, `core/stack`, `core/grid`, `core/avatar`, `core/comment-*`, `core/loginout`, `core/verse`, `core/footnotes`. Same token references; lower urgency unless the site uses them heavily.

### 3.5 Intentionally not Core

| DESIGN.md idea | WordPress home |
| --- | --- |
| Alert variants | Patterns (Group + heading + paragraph) or a small block later |
| Pills / chips | Patterns or button styles |
| Stack / Copy / Center / Cluster / Grid / Split / Sidebar / Frame / Box / Prose | Theme CSS classes. Group **Styles** are paint only (`cds-surface` … `cds-dark`). Copy / Switcher / … are `cds-copy` classes from the editor Arrangement panel (saved `is-style-cds-copy` still works). Split → `.cds-switcher` (kit `.cds-split`). Do not map Split to `core/columns`. |
| Form controls beyond Search | Plugin form CSS consuming `--cds-*` |

---

## 4. Custom token extensibility (theme / plugin)

Ship in the theme or a **theme functionality plugin**:

1. **Declare** values under `settings.custom` (existing WP behavior → `--wp--custom--*`).
2. **Register UI** via `customTokenDefinitions` in theme.json and/or `register_design_token()` (your #76509 shape).
3. **Persist** through the global-styles user layer under `settings.custom`.
4. **Bridge** optional: when a custom token changes, keep `--cds-*` in sync on `:root` so enqueued `cds.css` components still track FSE edits (filter `wp_theme_json_data_user` or print a small alias sheet).

Suggested Global Styles grouping for the custom UI (matches your issue mockups):

- Typography optics (line heights, tracking, weights)
- Layout shell (content / wide)
- Components (button, input, surface)
- Pairing colors (`on-primary`, `rule`) if not in the main palette

---

## 5. Gaps this exercise surfaces (generic kit / DESIGN.md)

`layout` and `elevation` YAML exist. Choose a layer before adding more.

| Gap | Why it matters for FSE | Status |
| --- | --- | --- |
| Typography composites vs WP splits | Agents must not invent slug maps | Documented in this file §2.2 and `WORDPRESS.md` |
| Component `padding` is a free string | Hard to split into block/inline tokens | Prefer `{spacing.n}` or `paddingBlock` / `paddingInline` |
| Spacing keys `1`…`8` | Awkward as bare WP slugs | Mapped as `space-1`…; keep YAML numeric |
| Style variations / dark | `surface-dark` is a wash, not a theme | No `styles/dark.json`. Dark band is a pattern |
| Gradient / duotone | Kit avoids them; WP defaults are loud | Keep disabled |
| Form ecosystem | `input` component ≠ Fluent/GF markup | Companion CSS later; Search uses input tokens |

---

## 6. Minimal build order

1. Theme skeleton (block theme) + enqueue kit CSS / fonts (skip `base.css`).
2. Generate Layer A presets from DESIGN.md / tokens.css.
3. Set §3.1–3.3 defaults so Core looks like the kit with no patterns yet.
4. Ship custom-token registry (Layer B); wire FSE UI when the probe has `register_design_token()`.
5. Button + Group + Image block styles and section patterns — in `wordpress/cds/`.
6. Compiler: `scripts/compile-wordpress.mjs` emits `theme.json` + `design-tokens.json`. Customize runs it.

---

## 7. Open decisions

1. **Alias vs duplicate:** Should `--wp--preset--color--primary` be a literal hex copy of `--cds-primary`, or `var(--cds-primary)`? Compiler currently writes literals. Alias keeps one SoR; some hosts resolve presets more reliably as literals.
2. **Where extensibility lives:** Theme-only vs must-use functionality plugin (cleaner if the token UI should survive theme swaps). Probe: MU-plugin + theme `design-tokens.json`.
3. **Palette size:** Full soft/deep set in the picker vs a short “author” palette + Layer B for the rest.

Do not reopen “should layout YAML exist.” It does. New kit facts go through *Choose a layer*.

---

## Related

- Kit contract: [`DESIGN.md`](DESIGN.md)
- Tokens: [`css/tokens.css`](css/tokens.css)
- Gutenberg proposal: [Design Token Extensibility #76509](https://github.com/WordPress/gutenberg/issues/76509)
- Example plugin shape: [mathetos/custom-tokens-example-plugin](https://github.com/mathetos/custom-tokens-example-plugin)
