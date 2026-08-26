---
version: 1.0.0
name: Example Brand
description: >-
  Core design system contract for Example Brand. Normative for marketing pages, product UI, dashboards, and admin chrome. This file is a template: replace the values and the brand-specific prose with your own, keep the token names, and prefer the CSS custom properties in css/tokens.css (--cds-*) when implementing.
colors:
  primary: "#0891b2"
  primary-deep: "#0e7490"
  primary-soft: "#cffafe"
  accent: "#e11d48"
  accent-soft: "#ffe4e6"
  paper: "#f1f5f9"
  paper-deep: "#e2e8f0"
  surface: "#ffffff"
  panel: "#e2e8f0"
  panel-deep: "#cbd5e1"
  panel-soft: "#f8fafc"
  ink: "#1e293b"
  ink-deep: "#0f172a"
  ink-muted: "#64748b"
  ink-soft: "#94a3b8"
  rule: "rgba(15, 23, 42, 0.12)"
  success: "#059669"
  success-soft: "#d1fae5"
  warning: "#d97706"
  warning-soft: "#ffedd5"
  danger: "#dc2626"
  danger-soft: "#fee2e2"
  info: "#0891b2"
  info-soft: "#cffafe"
  surface-dark: "#0f172a"
  on-primary: "#ffffff"
  on-accent: "#ffffff"
  on-dark: "#f1f5f9"
  on-dark-muted: "rgba(241, 245, 249, 0.78)"
typography:
  display-xl:
    fontFamily: PT Serif, Georgia, Times New Roman, serif
    fontSize: 3.5rem
    fontWeight: 700
    lineHeight: 1.1
    letterSpacing: -0.015em
  display-lg:
    fontFamily: PT Serif, Georgia, Times New Roman, serif
    fontSize: 3rem
    fontWeight: 700
    lineHeight: 1.1
    letterSpacing: -0.015em
  display-md:
    fontFamily: PT Serif, Georgia, Times New Roman, serif
    fontSize: 2.25rem
    fontWeight: 700
    lineHeight: 1.1
    letterSpacing: -0.015em
  display-sm:
    fontFamily: PT Serif, Georgia, Times New Roman, serif
    fontSize: 1.75rem
    fontWeight: 700
    lineHeight: 1.15
    letterSpacing: -0.015em
  body-lg:
    fontFamily: Lato, system-ui, sans-serif
    fontSize: 1.375rem
    fontWeight: 400
    lineHeight: 1.5
  body-md:
    fontFamily: Lato, system-ui, sans-serif
    fontSize: 1.125rem
    fontWeight: 400
    lineHeight: 1.6
  body-sm:
    fontFamily: Lato, system-ui, sans-serif
    fontSize: 1rem
    fontWeight: 400
    lineHeight: 1.35
  label:
    fontFamily: Lato, system-ui, sans-serif
    fontSize: 1rem
    fontWeight: 700
    lineHeight: 1.35
  meta:
    fontFamily: Lato, system-ui, sans-serif
    fontSize: 1rem
    fontWeight: 700
    lineHeight: 1.35
    letterSpacing: 0.06em
  code:
    fontFamily: JetBrains Mono, ui-monospace, Consolas, monospace
    fontSize: 1rem
    fontWeight: 400
    lineHeight: 1.55
rounded:
  sm: 0.5rem
  md: 0.75rem
  lg: 1.125rem
  pill: 999px
spacing:
  1: 0.25rem
  2: 0.5rem
  3: 0.75rem
  4: 1rem
  5: 1.5rem
  6: 2.25rem
  7: 3.375rem
  8: 5.0625rem
components:
  page:
    backgroundColor: "{colors.paper}"
    textColor: "{colors.ink}"
    typography: "{typography.body-md}"
  heading:
    textColor: "{colors.ink-deep}"
    typography: "{typography.display-md}"
  subhead:
    textColor: "{colors.primary}"
    typography: "{typography.display-sm}"
  body:
    textColor: "{colors.ink}"
    typography: "{typography.body-md}"
  muted:
    textColor: "{colors.ink-muted}"
    typography: "{typography.body-sm}"
  link:
    textColor: "{colors.primary}"
    typography: "{typography.label}"
  button-primary:
    backgroundColor: "{colors.primary}"
    textColor: "{colors.on-primary}"
    rounded: "{rounded.pill}"
    padding: 0.7rem 1.15rem
    typography: "{typography.label}"
  button-secondary:
    backgroundColor: "{colors.panel}"
    textColor: "{colors.ink}"
    rounded: "{rounded.pill}"
    padding: 0.7rem 1.15rem
  button-outline:
    backgroundColor: transparent
    textColor: "{colors.primary-deep}"
    rounded: "{rounded.pill}"
    padding: 0.7rem 1.15rem
  button-accent:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.on-accent}"
    rounded: "{rounded.pill}"
    padding: 0.7rem 1.15rem
  button-ghost:
    backgroundColor: transparent
    textColor: "{colors.ink-muted}"
    rounded: "{rounded.pill}"
    padding: 0.7rem 0.65rem
  input:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    rounded: "{rounded.sm}"
    padding: 0.6rem 0.8rem
    typography: "{typography.body-md}"
  surface:
    backgroundColor: "{colors.surface}"
    textColor: "{colors.ink}"
    rounded: "{rounded.md}"
    padding: 1.5rem
  surface-panel:
    backgroundColor: "{colors.panel}"
    textColor: "{colors.ink}"
    rounded: "{rounded.md}"
    padding: 1.5rem
  surface-dark:
    backgroundColor: "{colors.surface-dark}"
    textColor: "{colors.on-dark}"
    rounded: "{rounded.md}"
    padding: 1.5rem
  alert-info:
    backgroundColor: "{colors.info-soft}"
    textColor: "{colors.ink}"
    rounded: "{rounded.md}"
    padding: 0.75rem 1rem
  alert-success:
    backgroundColor: "{colors.success-soft}"
    textColor: "{colors.ink}"
    rounded: "{rounded.md}"
    padding: 0.75rem 1rem
  alert-warning:
    backgroundColor: "{colors.warning-soft}"
    textColor: "{colors.ink}"
    rounded: "{rounded.md}"
    padding: 0.75rem 1rem
  alert-danger:
    backgroundColor: "{colors.danger-soft}"
    textColor: "{colors.ink}"
    rounded: "{rounded.md}"
    padding: 0.75rem 1rem
  alert-note:
    backgroundColor: "{colors.panel-soft}"
    textColor: "{colors.ink-muted}"
    rounded: "{rounded.sm}"
    padding: 1.5rem
  pill:
    backgroundColor: "{colors.panel}"
    textColor: "{colors.ink}"
    rounded: "{rounded.pill}"
    padding: 0.25rem 0.65rem
    typography: "{typography.label}"
  pill-active:
    backgroundColor: "{colors.primary-soft}"
    textColor: "{colors.primary-deep}"
    rounded: "{rounded.pill}"
    padding: 0.25rem 0.65rem
  pill-success:
    backgroundColor: "{colors.success-soft}"
    textColor: "{colors.success}"
    rounded: "{rounded.pill}"
    padding: 0.25rem 0.65rem
  pill-warning:
    backgroundColor: "{colors.warning-soft}"
    textColor: "{colors.ink-deep}"
    rounded: "{rounded.pill}"
    padding: 0.25rem 0.65rem
  pill-danger:
    backgroundColor: "{colors.danger-soft}"
    textColor: "{colors.danger}"
    rounded: "{rounded.pill}"
    padding: 0.25rem 0.65rem
  table-header:
    backgroundColor: "{colors.panel-soft}"
    textColor: "{colors.ink}"
    typography: "{typography.label}"
  details:
    backgroundColor: "{colors.surface}"
    rounded: "{rounded.md}"
  details-summary:
    backgroundColor: "{colors.panel-soft}"
    textColor: "{colors.ink-deep}"
    typography: "{typography.label}"
    padding: 0.7rem 1rem
  code-inline:
    backgroundColor: "{colors.panel-soft}"
    textColor: "{colors.primary-deep}"
    rounded: "{rounded.sm}"
    padding: 0.08em 0.35em
  code-block:
    backgroundColor: "{colors.panel-soft}"
    textColor: "{colors.ink}"
    rounded: "{rounded.md}"
    padding: 1rem
    typography: "{typography.code}"
layout:
  measure: 62ch
  content-size: 40rem
  wide-size: 60rem
  gutter: "{spacing.5}"
elevation:
  sm: "0 2px 14px rgba(15, 23, 42, 0.06)"
  md: "0 10px 32px rgba(15, 23, 42, 0.1)"
focus:
  ring: "0 0 0 3px color-mix(in srgb, {colors.primary} 38%, transparent)"
---

## Overview

Example Brand is the placeholder identity shipped with this template so the
system renders and reads as a finished thing on first clone. Replace this
section with your own brand in two or three sentences: who it serves, how it
should feel, and what it must never look like.

The demo identity is light and easy on the eyes: cool slate paper, navy ink,
one cyan primary, and a single rose accent used sparingly for contrast. Serif
for voice, sans for clarity.

This file is normative. Agents and generators must read it before choosing
colour, type, radius, or components, and must map values to the CSS custom
properties in `css/tokens.css` (`--cds-*`) rather than inventing parallel ones.
The human reference site starts at `index.html`, with one page per section.

Brand feel (replace with yours):
- Calm, structured, legible; depth stays quiet
- One primary interactive colour; the accent is rare and intentional
- Air over density: prefer another section over a crowded one

Surfaces this system must serve equally well:
1. Marketing and website pages
2. Product UI (boards, forms, dashboards)
3. Compact admin or plugin chrome
4. Documents and reports

## Token layers

Tokens come in three layers. Keep these names when a brand forks. Only values change.

1. **Primitives** may be hue-named (`cyan-500`, a green ramp). Charts, illustrations, and raw scales live here. Authors do not pick from this layer in a theme.
2. **Semantic tokens** are jobs: `primary`, `ink`, `ink-deep`, `paper`, `accent`. The `colors:` map in this file is that layer. Compilers and WordPress presets use these names.
3. **Component tokens** bind a job to a control: `button-primary`, `on-primary`. Hierarchy words (`primary`, `secondary`) belong on components, not on leftover brand colours.

Do not put a hue in the semantic map (`green`, `cream`, `orange`). A fork may alias primitives in CSS (`--cds-primary` pointing at a private green). Authors, `theme.json` slugs, and other brands only see the job names.

`ink-deep` is a rank of ink, not a colour. Do not use `secondary` or `tertiary` as colour names — they collide with `button-secondary`. Muted text is `ink-muted`. A rare second punch is `accent`.

## WordPress

WordPress is a projection of this file, not a second system. The contract is
[`WORDPRESS.md`](WORDPRESS.md). The compiler writes `wordpress/cds/`. Keep the
`layout`, `elevation`, and `focus` front-matter groups — customize does not
own them.

## Make it yours

Keep the token names. Change the values via `brand.json`, then the prose.

1. Edit `brand.json` (name, colours, fonts, radii). Set `placeholder` to false.
2. Run `npm run customize` (applies tokens, fonts, this file's front matter,
   HTML stamps, and the `design-md.html` embed).
3. Rewrite Overview, Colors, Typography, and Do's and Don'ts below in your own
   words. Leave **Token layers** and **WordPress** as-is. Do not hand-edit the
   generated colour / typography / rounded front matter — customize overwrites
   those blocks.
4. Replace `assets/` marks. Run customize again after prose edits.
5. See `CUSTOMIZE.md` and `AGENTS.md` Job B (entry UI: `customize.html`).

Anything you do not customise stays a visible placeholder rather than a silent
default, which is intentional.

## Colors

Semantic roles. Use these names in reasoning; hex values live in front matter.

| Role | Token | Use |
| --- | --- | --- |
| Page wash | `paper` | Default background |
| Wash deep | `paper-deep` | Alternating page bands |
| Surface | `surface` | Cards, inputs, lifted modules |
| Panel | `panel` | Grouping without a card shadow |
| Panel soft | `panel-soft` | Quietest fill: notes, code paper, table headers |
| Ink | `ink` | Body text |
| Ink deep | `ink-deep` | Headings, text on light accent fills |
| Ink muted | `ink-muted` | Captions, helper text, secondary copy |
| Ink soft | `ink-soft` | Meta only, never body copy |
| Primary | `primary` | Links, primary action, accent subheads |
| Primary deep | `primary-deep` | Primary hover and pressed |
| Primary soft | `primary-soft` | Soft fills, chips, selected states |
| Accent | `accent` | Rare high-stakes CTA, emphasis rules |
| Surface dark | `surface-dark` | Dark callout cards and hero bands |
| Success / Warning / Danger / Info | semantic | Status only, not decoration |

**How primary and accent relate.** Brand colours need a deliberate relationship,
not a second random favourite. For this kit, **accent must contrast with
primary** so a rare high-stakes CTA can cut through a cyan-led page. The common
options:

- **Complementary / near-complementary** (opposites or near-opposites): maximum
  pop. The demo uses this: cyan primary + rose accent. Warm amber stays on
  `warning`, and red stays on `danger`, so the brand CTA does not look like a
  status colour.
- **Analogous** (neighbours on the wheel): calm and cohesive, but a weak choice
  for accent if the job of accent is to stand out.
- **Split-complementary / triadic**: more energy than analogous, slightly less
  clash than a straight complement. Useful when you need a third brand hue.

Product systems also separate **brand roles** (primary, secondary/accent) from
**semantic roles** (success, warning, danger, info). Do not let a brand accent
double as a status colour. Material Design 3's colour roles are a clear,
current reference for that split:
[m3.material.io/styles/color/system/roles](https://m3.material.io/styles/color/system/roles).
For the classic harmony types themselves, Adobe Color's wheel is a solid
interactive primer:
[color.adobe.com/create/color-wheel](https://color.adobe.com/create/color-wheel).

Rules:
- Default stack is `paper` background, `ink` text, `primary` for interaction
- `accent` must read as a contrast to `primary` (complementary or near-
  complementary). Do not pick a neighbour hue and call it accent
- Text on a filled surface uses its paired `on-*` token: `on-primary` on primary
  fills, `on-accent` on accent fills, `on-dark` on `surface-dark`. Recheck AA
  whenever you change an accent hue
- Soft brand fills use `primary-soft` with `ink` (not `ink-muted`). Solid
  `primary` plus `on-primary` is for buttons, not card bodies, in this demo
- Never promote `accent` into a second theme colour or a large background fill
- Semantic colours describe state; do not borrow `danger` or `warning` for brand
  emphasis, and do not alias `accent` to `warning`
- Check WCAG AA (4.5:1) for body text and AA Large (3:1) for display sizes
  before shipping any text-on-colour pair
- The `primary-1`…`primary-5` ramp is for charts, illustrations, and
  progressive emphasis, not random decoration
- `info` ships as an alias of `primary` because the demo primary reads
  informational. If your primary is warm or playful, give `info` its own cool
  hue in `tokens.css`

## Typography

Three families, one job each:
- **Display serif** (`PT Serif`): titles, section headings, accent subheads.
  Tracking `--cds-tracking-display`.
- **Body sans** (`Lato`): body copy, UI labels, tables, forms, meta. The demo
  maps semibold to 700 because Lato has no 600 cut on Google Fonts.
- **Mono** (`JetBrains Mono`): code only, never marketing body copy.

Size ladder (`--cds-text-*`):

| Token | Size | Role |
| --- | --- | --- |
| `sm` | 16px | Compact UI, labels, table cells |
| `md` | 18px | Default body and long-form |
| `lg` | 22px | Short lead or intro emphasis |
| `xl` | 28px | Small display, card titles |
| `2xl` | 36px | Medium display |
| `3xl` | 48px | Large display |
| `4xl` | 56px | Hero display |

`sm` is the demo floor. If your product genuinely needs denser chrome, lower the
floor in `tokens.css` once rather than sprinkling one-off sizes in components.

Line-height is optical, per role: `--cds-leading-display` (1.1) for large
display, `--cds-leading-snug` (1.15) for short titles, `--cds-leading-body`
(1.6) for reading, `--cds-leading-callout` (1.5) for contained copy, and
`--cds-leading-ui` (1.35) for compact UI.

Weights are 400 and 700 in the demo (Lato has no 600 cut). Prefer the
  emphasis weight for UI chrome before inventing a third weight,
and do not introduce 500 or 800 without adding a token for it.

Rules:
- Set reading width with `--cds-measure` in `ch`, never a fixed `px` width
- Display serif carries titles; body sans carries paragraphs
- Sentence case by default; uppercase is for short meta eyebrows with
  `--cds-tracking-meta`
- One display family and one body family. A third display font is a redesign,
  not a variation
- Do not rely on fluid viewport type alone to fix readability

## Layout

Composable primitives beat a breakpoint for every block. The approach follows
the intrinsic-layout ideas in *Every Layout* (Pickering & Bell).

Axioms:
- **Measure:** no reading line exceeds `--cds-measure`. Flow text is capped;
  structural shells are not.
- **Suggestion over prescription:** prefer `max-inline-size`, `min-block-size`,
  `gap`, and `flex-basis` over fixed `width` and `height`.
- **One space ratio:** `--cds-ratio` (1.5) seeds space from `1rem` (step 4).
  Steps 5 to 8 multiply by the ratio; steps 1 to 3 are chrome-only.
- **Boxes:** global `border-box`, logical properties, and `content-box` on
  reading columns so `ch` measures text rather than text plus padding.

Primitives in `css/layouts.css`:

| Class | Job |
| --- | --- |
| `.cds-stack` | Vertical rhythm owned by `gap`. Variants `--sm`, `--md`, `--lg` |
| `.cds-center` | Centred reading column at `--cds-measure`, optional `--gutter` |
| `.cds-cluster` | Wrapping horizontal group for buttons, pills, tags |
| `.cds-grid` | Auto-fitting tiles that wrap at `--cds-grid-min`, no media query |
| `.cds-grid--center` | Center each tile in its track. Proof stats. Not cards. |
| `.cds-grid--five` | Five even tracks. Proof. Stacks to one column when the row cannot hold five. Not auto-fit. |
| `.cds-split` | Two tracks that wrap. Copy plus media. No breakpoint soup |

Hierarchy:
- One job per section: a heading, a short supporting line, then content
- Space major blocks with `.cds-stack` or steps 5 to 7
- Do not mix ad-hoc child margins with a parent `.cds-stack` gap
- `--cds-max` may wrap shells and specimen grids; paragraphs still obey measure

## Sections

Marketing pages are stacks of these jobs. Specimens: `sections.html`. WordPress
projects the same names as patterns in `wordpress/cds/patterns/`. Do not invent
a ninth section. A path chooser is a three-tile card grid. Header and footer
are template parts, not sections.

| Section | Job | Wash | CTA | Not |
| --- | --- | --- | --- | --- |
| Hero | Pill, display title, lede, one primary. Optional proof cluster. Media on the right via `.cds-split`. A text stack is still legal | `paper` | One primary | A whole page, a Split section (wrong wash) |
| Proof | Three or five stats, centered in even tracks, or a logo cluster. No leftover tile | `paper-deep` (viewport wash; numbers sit on `wide`) | None | A feature grid, four tiles wrapping to three, five auto-fitting to four-plus-one, left-aligned stats |
| Card grid | Three paired fills in `.cds-grid` (surface, `primary-soft` tint, dark). Title, one line, optional meta and a link | `paper` | Outline or text link, not a second primary | A dashboard, three identical whites |
| Split | Copy plus media via `.cds-split` (WordPress: `core/columns`) | `paper-deep` (viewport wash; split sits on `wide`) | One primary, optional | A blog layout |
| Quote | One attribution. Surface or a row | `paper` | None | A reviews carousel |
| Dark band | Callout strip. `on-dark` title | `surface-dark` (viewport wash; copy on the measure) | One accent max | A second theme |
| CTA | Short `display-sm` plus one button | `panel` | Primary or accent, not both | Two buttons fighting |
| Alert | Status note. Tone is the fill | soft status or `primary-soft` | None | A hero |

Page recipes compose sections. `landing` is hero, optional proof, and one card
grid or split. The hero holds the primary. Use the CTA section when the page
has no hero button. `article` is measured prose on paper, not this catalog.

If a request needs a section that is not in this table, say so and compose from
what is here. Do not add a class or a pattern to cover a one-off.

Washes (`paper-deep`, `surface-dark`) are viewport bands. Inner marketing
copy sits on `wide` (the same column as the header). Article prose stays on
the measure / `content`. Do not wrap `post-content` in a second constrained
group; `alignfull` cannot escape it. Do not mix `content` and `wide` on one
landing. Do not leave a leftover tile in a proof strip or card grid. Three
items, three tracks. Five items, five tracks (`.cds-grid--five`). Four items only as two by two or four across on `wide`. Do not auto-fit five into four-plus-one.

## Elevation & depth

Depth is quiet.
- Default surfaces: 1px `rule` border with an optional light shadow
- Stronger lift only when something genuinely floats (`--cds-shadow-md`)
- Prefer a border plus a background shift (`surface`, `panel`, `paper-deep`)
  over stacked shadows
- No neon glow, no multi-layer coloured shadows, no glass blur as a brand device

## Shapes

Radii: `rounded.sm` for inputs and small controls, `rounded.md` for surfaces and
alerts, `rounded.lg` for large media frames, `rounded.pill` for buttons and
chips.

Button shape is a single knob: `--cds-button-radius`. Set it to
`var(--cds-radius)` for a squarer system. Do not mix sharp chrome and pill
buttons in the same view unless the exception is documented here.

Focus ring: a soft primary halo (`--cds-focus`). Restyle it if you must, but
never remove it.

## Components

Class names live in `css/components.css`, all prefixed `cds-`.

**Buttons**
- `button-primary` (`.cds-btn--primary`): the main action. One per section.
- `button-secondary` (`.cds-btn--secondary`): panel fill for secondary actions.
- `button-outline` (`.cds-btn--outline`): low-emphasis action, transparent fill
  with a `primary-deep` border and label so body-size type meets WCAG AA on
  `paper` and `surface`. Hover fills `primary-soft`. That hover is invisible on
  a `primary-soft` tile, so `.cds-surface--tint` inverts to `primary-deep` /
  `on-primary`. On `surface-dark`, rest is `on-dark` outline; hover fills
  `surface` with a `primary-deep` label (same pairing as the dark primary
  button). Hover fill must read as a different colour from the tile.
- `button-accent` (`.cds-btn--accent`): at most one high-stakes CTA per view
  (Buy, Book, Submit final). Use `on-accent` for the label. Hover deepens the
  fill so a light label keeps its contrast.
- `button-ghost` (`.cds-btn--ghost`): text-like dismissal or tertiary nav.
- `button-sm` (`.cds-btn--sm`): compact control size for cards, toolbars, and
  download rows. Compose with a colour variant (e.g. `.cds-btn--outline.cds-btn--sm`).
  Keeps the button radius knob; uses denser padding and a 14px control label
  (not a new body type-scale step).
- Disabled reduces opacity. Do not invent a separate grey system.

**Links**
- `primary`, semibold when inline in prose. Never default browser blue.

**Forms**
- Labels sit above fields; hints and errors sit below
- Inputs: surface fill, soft ink border, `rounded.sm`, primary focus ring
- Errors pair a `danger` border with a text message, never colour alone
- Selected chips use `pill-active` (soft fill, deep text), not solid `primary`
  with `ink`

**Surfaces**
- `surface`: default module on the page wash
- `surface-panel`: grouping without a card shadow; body stays `ink` (muted fails AA)
- `surface-tint` (`.cds-surface--tint`): `primary-soft` fill, `ink` body. Soft brand paint, not a second theme
- `surface-dark`: one dark callout per section at most; muted white body copy
- Do not wrap every block in a shadowed card
- Do not fill a card with solid `primary` or `accent`; those fills fail AA with `on-*` at body size in this demo

**Pills**
- `pill`: default panel fill, for compact status, tags, and the hero eyebrow
- `pill-active` (`.cds-pill--active` or `.cds-pill.is-active`): selected state
- `pill-success` / `pill-warning` / `pill-danger`: soft semantic fills, state only. Not the hero eyebrow.

**Feedback**
- Pills for compact status, alerts for full-sentence messages
- `alert-note` (`.cds-alert--note`) is guidance, not status
- Spinner for indeterminate waits, progress bar only when percent is known

**Tables**
- `.cds-table-wrap` is the frame: surface fill, `rule` border, `rounded.md`
- Header row is `table-header`: `panel-soft`, label weight, left-aligned
- Cells use `body-sm` and muted ink. Hairline row rules only, no grid of
  cell borders. Last row drops the bottom rule so it does not double the frame

**Details**
- `.cds-details` is a disclosure, not a card stack. Same frame as the table
- Summary is the control: label weight, `ink-deep`, a kit chevron (not the
  browser triangle). Open state paints the summary `panel-soft` and a hairline
- Body copy inside stays `ink`. Do not nest a second surface

**Code**
- Inline `code` stays quiet: `panel-soft` paper, `primary-deep` text, no border
- Block `.cds-code` soft-wraps; snippets never hide content behind a scrollbar

**Brand assets**
- Marks live in `assets/`. Use the wordmark when naming the brand and the icon
  for favicons, avatars, and tight badges
- Do not add shadows, outlines, recolours, or stretch transforms to mark files
- Prefer SVG on screen; keep raster exports for hosts that require them

## Do's and Don'ts

**Do**
- Start from `paper` plus `ink` plus `primary`
- Keep the accent rare and singular
- Use the space, size, and radius scales exactly
- Check contrast for body text before shipping
- Reuse `css/cds.css` (or tokens plus components) instead of new one-off CSS
- Add a token when you need a new value
- Compose marketing pages from the section catalog, not from a new layout

**Don't**
- Don't invent hex values, font stacks, or spacing that bypass the tokens
- Don't make the accent a theme colour or a page background
- Don't ship more than one primary button, or more than one accent CTA, per view
- Don't use pure black or pure white as the default page wash
- Don't use semantic status colours as decoration
- Don't remove focus indicators
- Don't set paragraph measure in `px`
- Don't introduce a third display family or a fourth type role
- Don't create a dark-mode palette unless it is asked for and tokenised here
- Don't leave the placeholder brand name in shipped work

## Agent directives

When generating or editing UI for this brand:

1. Read this file before choosing colour, type, radius, or components.
2. Prefer token names and `{colors.*}` references in reasoning; emit `--cds-*`
   custom properties in code. Semantic names (`paper`, `primary`, `accent`)
   are the public layer — see Token layers. Do not expose hue names as
   author-facing slugs.
3. If a request conflicts with Do's and Don'ts, follow this file and say so
   briefly rather than silently deviating.
4. Validate text and background pairs against WCAG AA for body copy.
5. Self-check after UI work: correct page wash, display family on titles, one
   primary action, accent used at most once, focus rings intact.
6. Use the mark files in `assets/`; never regenerate a lookalike.
7. Patterns not covered here (modals, tabs, toasts, dark mode) are out of scope
   until they are added. Improvise with existing tokens and keep the same
   constraints instead of inventing a new visual language.
8. If this file still reads "Example Brand", say so before generating brand
   work: the system has not been customised yet.
9. For a WordPress theme, follow [`WORDPRESS.md`](WORDPRESS.md). Do not invent
   palette slugs, picker unlocks, or recipes the compiler does not emit.
10. Marketing pages start from the section catalog above. Compose those jobs.
    Do not invent a layout, a card class, or a ninth section. Do not wrap
    `post-content` in a second constrained group. Do not leave a leftover tile.
    Do not mix `content` and `wide` on one landing. Proof stats are centered.
    Proof is three or five even tracks, never a leftover tile. Marketing hero is
    a split: pill, title, lede, one primary, optional proof cluster, media.
    Card-grid tiles use three paired fills. Body and outline labels must meet
    WCAG AA against the tile. Outline hover on tint and dark must fill a colour
    that is not the tile. Do not ship three identical whites.
