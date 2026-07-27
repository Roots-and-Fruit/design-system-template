---
version: 1.0.0
name: Example Brand
description: >-
  Core design system contract for Example Brand. Normative for marketing pages,
  product UI, dashboards, and admin chrome. This file is a template: replace the
  values and the brand-specific prose with your own, keep the token names, and
  prefer the CSS custom properties in css/tokens.css (--cds-*) when implementing.
colors:
  primary: "#2f5f8a"
  primary-deep: "#234a6d"
  primary-soft: "#d9e6f2"
  accent: "#c9781e"
  accent-soft: "#f7e5cd"
  paper: "#f4f6f8"
  paper-deep: "#e9edf2"
  surface: "#ffffff"
  panel: "#dfe5ec"
  panel-deep: "#cdd6e0"
  panel-soft: "#eef1f5"
  ink: "#1a1d24"
  ink-deep: "#0f1218"
  ink-muted: "#565f6b"
  ink-soft: "#8a929c"
  rule: "rgba(26, 29, 36, 0.14)"
  success: "#2f7d55"
  success-soft: "#dcefe4"
  warning: "#c9781e"
  warning-soft: "#f7e5cd"
  danger: "#a33b2b"
  danger-soft: "#f6e0dc"
  info: "#2f5f8a"
  info-soft: "#d9e6f2"
  surface-dark: "#1e3f5d"
  on-primary: "#ffffff"
  on-accent: "#0f1218"
  on-dark: "#ffffff"
  on-dark-muted: "rgba(255, 255, 255, 0.78)"
typography:
  display-xl:
    fontFamily: Source Serif 4, Georgia, Times New Roman, serif
    fontSize: 3.5rem
    fontWeight: 700
    lineHeight: 1.1
    letterSpacing: -0.015em
  display-lg:
    fontFamily: Source Serif 4, Georgia, Times New Roman, serif
    fontSize: 3rem
    fontWeight: 700
    lineHeight: 1.1
    letterSpacing: -0.015em
  display-md:
    fontFamily: Source Serif 4, Georgia, Times New Roman, serif
    fontSize: 2.25rem
    fontWeight: 700
    lineHeight: 1.1
    letterSpacing: -0.015em
  display-sm:
    fontFamily: Source Serif 4, Georgia, Times New Roman, serif
    fontSize: 1.75rem
    fontWeight: 600
    lineHeight: 1.15
    letterSpacing: -0.015em
  body-lg:
    fontFamily: Source Sans 3, system-ui, sans-serif
    fontSize: 1.375rem
    fontWeight: 400
    lineHeight: 1.5
  body-md:
    fontFamily: Source Sans 3, system-ui, sans-serif
    fontSize: 1.125rem
    fontWeight: 400
    lineHeight: 1.6
  body-sm:
    fontFamily: Source Sans 3, system-ui, sans-serif
    fontSize: 1rem
    fontWeight: 400
    lineHeight: 1.35
  label:
    fontFamily: Source Sans 3, system-ui, sans-serif
    fontSize: 1rem
    fontWeight: 600
    lineHeight: 1.35
  meta:
    fontFamily: Source Sans 3, system-ui, sans-serif
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
  sm: 0.375rem
  md: 0.625rem
  lg: 1rem
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
    textColor: "{colors.primary}"
    borderColor: "{colors.primary}"
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
  table-header:
    backgroundColor: "{colors.panel-soft}"
    textColor: "{colors.ink}"
    typography: "{typography.label}"
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
---

## Overview

Example Brand is the placeholder identity shipped with this template so the
system renders and reads as a finished thing on first clone. Replace this
section with your own brand in two or three sentences: who it serves, how it
should feel, and what it must never look like.

The demo identity is deliberately plain: cool paper, near-black ink, one
slate-blue primary, and a single amber accent used sparingly. Serif for voice,
sans for clarity.

This file is normative. Agents and generators must read it before choosing
colour, type, radius, or components, and must map values to the CSS custom
properties in `css/tokens.css` (`--cds-*`) rather than inventing parallel ones.
The human reference is `index.html`.

Brand feel (replace with yours):
- Calm, structured, legible; depth stays quiet
- One primary interactive colour; the accent is rare and intentional
- Air over density: prefer another section over a crowded one

Surfaces this system must serve equally well:
1. Marketing and website pages
2. Product UI (boards, forms, dashboards)
3. Compact admin or plugin chrome
4. Documents and reports

## Make it yours

Keep the token names. Change the values, then the prose.

1. `css/tokens.css` — palette, font stacks, size ladder, radius, space ratio.
2. `css/fonts.css` — your webfont source.
3. This file — front matter values, then Overview, Colors, Typography, and
   Do's and Don'ts in your own words.
4. `assets/` — your marks, replacing the placeholder.
5. Run `sync-design-md-embed.ps1` so `index.html` carries the current contract.

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

Rules:
- Default stack is `paper` background, `ink` text, `primary` for interaction
- Text on a filled surface uses its paired `on-*` token: `on-primary` on primary
  fills, `on-accent` (dark ink) on accent fills, `on-dark` on `surface-dark`
- Never promote `accent` into a second theme colour or a large background fill
- Semantic colours describe state; do not borrow `danger` red for emphasis
- Check WCAG AA (4.5:1) for body text and AA Large (3:1) for display sizes
  before shipping any text-on-colour pair
- The `primary-1`…`primary-5` ramp is for charts, illustrations, and
  progressive emphasis, not random decoration
- `info` ships as an alias of `primary` because the demo primary reads
  informational. If your primary is warm or playful, give `info` its own cool
  hue in `tokens.css`

## Typography

Three families, one job each:
- **Display serif** (`Source Serif 4`): titles, section headings, accent
  subheads. Tracking `--cds-tracking-display`.
- **Body sans** (`Source Sans 3`): body copy, UI labels, tables, forms, meta.
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

Weights are 400, 600, and 700 only. Prefer semibold before bold for UI chrome,
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

Hierarchy:
- One job per section: a heading, a short supporting line, then content
- Space major blocks with `.cds-stack` or steps 5 to 7
- Do not mix ad-hoc child margins with a parent `.cds-stack` gap
- `--cds-max` may wrap shells and specimen grids; paragraphs still obey measure

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
- `button-outline` (`.cds-btn--outline`): low-emphasis outlined action.
- `button-accent` (`.cds-btn--accent`): at most one high-stakes CTA per view
  (Buy, Book, Submit final). Dark ink on the accent fill, never white. Hover
  lightens toward paper so contrast improves.
- `button-ghost` (`.cds-btn--ghost`): text-like dismissal or tertiary nav.
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
- `surface-panel`: grouping without a card shadow
- `surface-dark`: one dark callout per section at most; muted white body copy
- Do not wrap every block in a shadowed card

**Feedback**
- Pills for compact status, alerts for full-sentence messages
- `alert-note` (`.cds-alert--note`) is guidance, not status
- Spinner for indeterminate waits, progress bar only when percent is known

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
   custom properties in code.
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
