# Agent instructions

This repository is a brand-agnostic core design system template. Two different
jobs land here, so work out which one you are doing first.

## Job A: building UI with this system

1. Read `DESIGN.md` before choosing colour, type, radius, spacing, or a
   component. It is normative, and its Agent directives section wins over
   personal taste.
2. Implement with the CSS custom properties in `css/tokens.css` (`--cds-*`) and
   the classes in `css/layouts.css` and `css/components.css`. Do not introduce
   parallel hex values, font stacks, or spacing.
3. If a request conflicts with the Do's and Don'ts, follow the file and say so
   briefly.
4. Check text and background pairs against WCAG AA for body copy.
5. If `DESIGN.md` still reads `Example Brand`, the system has not been
   customised. Say so before producing brand work.

## Job B: changing the template itself

Edit in this order so the pieces stay in sync:

1. `css/tokens.css`, then `css/layouts.css` or `css/components.css`.
2. The matching reference page when a pattern is new or its specimen is now
   wrong: `colors.html`, `typography.html`, `layout.html`, or
   `components.html`.
3. `DESIGN.md`: front matter values first, then the prose rules.
4. Run the sync script so the embedded contract matches the markdown:

```powershell
.\sync-design-md-embed.ps1
```

```bash
node sync-design-md-embed.mjs
```

## Boundaries

- `DESIGN.md` is the source of truth. The markdown inside
  `<code id="design-md-source">` in `contract.html` is a generated copy, so
  never hand-edit it.
- `css/kit.css` styles the reference site only, including the
  `@view-transition` rules. Keep it out of the system, and keep system classes
  out of it.
- The sidebar markup is duplicated across pages on purpose: no build step, no
  JavaScript. When you change nav links, change all six pages and keep
  `aria-current="page"` on the current one.
- `css/base.css` is the only file allowed to style bare tags, because adopters
  need to be able to skip it.
- Component classes are prefixed `cds-`, reference-page classes `kit-`. Do not
  add unprefixed global classes.
- Example Brand is a placeholder. Keep it neutral and generic rather than
  evolving it into a real identity, and do not commit licensed fonts or
  third-party marks.
