# Agent instructions

This repository is a brand-agnostic core design system template. Work out which
job you are doing first.

| Job | When | Open first |
| --- | --- | --- |
| **A — Build UI** | Implementing screens with this system | `DESIGN.md` |
| **B — Customize a fork** | Applying a real brand to a clone | `brand.json` + `customize.html` |
| **C — Change the template** | Editing the kit itself (components, docs chrome) | this file, then the matching CSS/HTML |

Most fork work is **Job B**. Do not skip the customize script and hand-edit
generated regions.

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
5. If `brand.json` still has `"placeholder": true` or `DESIGN.md` still reads
   `Example Brand`, the system has not been customised. Say so before producing
   brand work.

## Job B: customize a fork for a real brand

This is the path almost every fork should take. Humans and agents both follow
the checklist on `customize.html`; this section is the machine-readable twin.

1. **Edit `brand.json` only** for name, tagline, description, colours, font
   stacks / Google Fonts import, radii, and knobs. Set `"placeholder": false`.
2. **Run the apply script** (zero install):

```bash
npm run customize
```

```bash
node scripts/apply-brand.mjs
```

   That writes the `@@brand` region in `css/tokens.css`, updates
   `css/fonts.css`, regenerates the `DESIGN.md` front matter (name, colours,
   type stacks, radii), stamps `[data-brand]` fields in the HTML pages, and
   syncs `design-md.html`.
3. **Rewrite `DESIGN.md` prose** below the front matter (Overview, pairing
   notes if the harmony changed, Typography voice, Do's and Don'ts). Keep token
   names. Do not hand-edit the colour / typography / rounded front-matter blocks
   the script owns — your next customize run will overwrite them.
4. **Run `npm run customize` again** (or `npm run sync:design-md`) after prose
   edits so the embed matches.
5. **Replace assets** under `assets/`. The sidebar mark is inlined in each HTML
   page; update those copies if the chrome should show the new mark.
6. **Stop when** `placeholder` is false, leftover `"Example Brand"` strings are
   gone from prose (the script reports leftovers), and specimens look right.

Source of truth map:

| Concern | Edit | Generated |
| --- | --- | --- |
| Name, colours, fonts, radii | `brand.json` | tokens `@@brand` region, fonts import, DESIGN.md front matter, HTML stamps |
| Rules and voice | `DESIGN.md` prose | `design-md.html` after sync |
| Size / space / shadows | `css/tokens.css` below `@@brand` | — |
| Colour chip labels | — | `js/kit-swatches.js` from computed CSS |

Viewing the reference site never requires a build. Customize is optional
tooling for forks only.

## Job C: changing the template itself

Edit in this order so the pieces stay in sync:

1. If the value is forkable, put it in `brand.json` and run `npm run customize`.
2. Otherwise edit `css/tokens.css` (below `@@brand`), `layouts.css`, or
   `components.css`.
3. Update the matching reference page when a specimen is wrong.
4. Update `DESIGN.md` prose / component front-matter entries the script does not
   own (`spacing`, `components`).
5. Run `npm run customize` or `npm run sync:design-md`.

## Boundaries

- `brand.json` is the fork surface. The `@@brand` region in `css/tokens.css` is
  generated — never hand-edit it.
- `DESIGN.md` prose is the source of truth for rules. The markdown inside
  `<code id="design-md-source">` in `design-md.html` is a generated copy.
- `css/kit.css` and `js/kit-swatches.js` are reference-site chrome only.
- The sidebar markup is duplicated across pages on purpose (no build step).
  Brand **strings** are stamped via `[data-brand]`; structural nav changes still
  need every HTML file updated (or a small patch script).
- `css/base.css` is the only file allowed to style bare tags.
- Prefixes: system `cds-`, reference chrome `kit-`.
- Example Brand is a placeholder. Do not evolve it into a real identity inside
  this upstream repo.

## Credit

The sidebar carries a small "A Roots & Fruit system" credit with the Roots &
Fruit mark inlined, linking back to this template. Leaving it in place is a kind
thing to do, and it is how other people find the kit. If it does not fit the
site you are building, remove it with no hard feelings, and a shout-out on
social instead is genuinely appreciated.

That mark is the one intentionally brand-specific asset in the repo. It is
attribution, so do not restyle it with `--cds-*` colours or treat it as part of
Example Brand.
