# Design System Template

A forkable core design system: one token layer, four layout primitives, a small
component set, a browsable reference page, and a normative `DESIGN.md` contract
that coding agents can follow.

It ships with a placeholder brand called **Example Brand** so everything renders
on first clone. Replace the values, keep the structure, and you have your own
system.

**Reference site:** one page per section (Overview, Colors, Typography, Layout,
Components, Agent contract). Open `index.html` in a browser, or serve the folder:

```bash
npx --yes serve .
```

Serving it also enables the cross-document
[View Transitions](https://developer.mozilla.org/en-US/docs/Web/API/View_Transition_API)
between pages, which need a real origin rather than `file://`.

## Why this exists

Most brand kits are a PDF and a folder of logos, which an agent cannot use. This
template puts the same information where tools can read it: CSS custom
properties for implementation, and a single markdown contract that states the
rules in words, including the things a generator should never do.

## What is inside

| File | Role |
| --- | --- |
| `DESIGN.md` | Canonical contract. Front matter holds the values, prose holds the rules |
| `css/cds.css` | Single entry point: fonts, tokens, base, layouts, components |
| `css/tokens.css` | Palette, type ladder, space scale, radius, shadows, knobs |
| `css/base.css` | Element-level defaults. Skip this file when integrating into an existing site |
| `css/layouts.css` | Stack, Center, Cluster, Grid |
| `css/components.css` | Buttons, pills, alerts, surfaces, forms, tables, code, prose |
| `css/kit.css` | Chrome for the reference site only. Not part of the system |
| `index.html` and friends | Reference site: Overview, Colors, Typography, Layout, Components, Agent contract |
| `assets/` | Placeholder mark, plus a place for your logos |
| `sync-design-md-embed.ps1` / `.mjs` | Copies `DESIGN.md` into `contract.html` |

Use it in a page:

```html
<link rel="stylesheet" href="css/cds.css">
```

Adopting the kit inside a site that already styles bare tags? Import
`tokens.css`, `layouts.css`, and `components.css` and leave out `base.css`, which
is the only file that touches `body`, headings, links, and `code`.

## Make it yours

1. **Tokens.** Edit `css/tokens.css`: palette, font stacks, size ladder, radius,
   space ratio. Keep the token names. Roles like `--cds-primary` survive a
   rebrand, so renaming them to brand words means editing the whole kit.
2. **Fonts.** Point `css/fonts.css` at your webfont source and update the three
   font stacks in `tokens.css`.
3. **Contract.** Update the `DESIGN.md` front matter to match your tokens, then
   rewrite Overview, Colors, Typography, and Do's and Don'ts in your own words.
   That prose is what agents follow when a request is ambiguous.
4. **Assets.** Replace `assets/mark.svg` and add your logos under
   `assets/logos/`.
5. **Sync.** Run the sync script so `contract.html` carries the current
   contract:

```powershell
.\sync-design-md-embed.ps1
```

```bash
node sync-design-md-embed.mjs
```

Optional lint of the contract front matter:

```bash
npx -p "@google/design.md" designmd lint DESIGN.md
```

Keep errors at zero. Some warnings are expected: the linter cannot see which
tokens your CSS uses, so structural values like `rule` and `paper-deep` read as
unreferenced, and it measures transparent buttons against nothing rather than
against the page wash.

### Two knobs worth knowing

Button shape and heading font are single variables in `tokens.css`, so a large
part of the system's personality changes in one line:

```css
--cds-button-radius: var(--cds-radius); /* squarer than the default pill */
--cds-heading-font: var(--cds-font-body); /* sans headings, no serif voice */
```

### Renaming the prefix

Every class and variable is prefixed `cds-`. To rename it, find and replace
`cds-` across `css/`, the HTML pages, and `DESIGN.md`.

### The reference site

Each section is a separate HTML file with a shared sidebar, so pages are
linkable and the markup for one section stays readable. Navigation between them
opts into cross-document view transitions with `@view-transition` in
`css/kit.css`: the sidebar holds still while content cross-fades and lifts.
Browsers without support simply navigate, and the animation is disabled under
`prefers-reduced-motion`. There is no JavaScript and no build step.

## Working with agents

Point your agent at `DESIGN.md` before it writes UI. The contract ends with
directives that make it behave: prefer tokens over raw hex, validate contrast,
flag conflicts instead of silently deviating, and say so when the system has not
been customised yet and still reads "Example Brand".

Anything not covered by the contract (modals, tabs, toasts, dark mode) is out of
scope until you add it. That is deliberate: an agent improvising inside known
constraints is safer than an agent inventing a second visual language.

## Design notes

The layout primitives follow the intrinsic-layout ideas in *Every Layout* by
Heydon Pickering and Andy Bell: a few axioms and composable pieces rather than a
breakpoint for every block. Reading width is capped in `ch` so the measure
tracks font size, space comes from one ratio, and line-height is set per role
instead of one global number.

The contract format follows the [design.md](https://github.com/google/design.md)
convention, so the front matter is machine readable while the prose stays
human readable.

## License

MIT. The kit, the placeholder mark, and the sample palette are free to use and
modify. The brand you build with it is yours.

Demo fonts (Source Serif 4, Source Sans 3, JetBrains Mono) are open licensed and
loaded from Google Fonts. If you swap in a licensed family, do not commit the
binaries to a public repository. Load them from a host you control and keep a
system fallback in the stack.

Maintained by [Roots & Fruit](https://rootsandfruit.com).
