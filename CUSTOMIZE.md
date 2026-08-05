# Customization checklist

Bare minimum to make this kit reflect a real brand. Prefer an agent. Paste the
prompt from `customize.html` ("Walk me through this project's customization
checklist") or point the agent at this file and `AGENTS.md` Job B.

Work top to bottom. Skip a step only when the answer is genuinely "no / not
yet." After the interview, the agent applies `brand.json`, runs
`npm run customize`, rewrites `DESIGN.md` prose, and replaces assets.

---

## 1. Logos and marks

Put every variety you have in:

```
assets/
  mark.svg                 # square icon (favicon, sidebar, tight badges)
  logos/
    wordmark.svg           # full lockup for light backgrounds (+ PNG)
    wordmark-white.svg     # monotone reverse for dark backgrounds (+ PNG)
    wordmark-mono.svg      # single-colour black fallback (+ PNG)
```

Tell the agent which file is the default mark and which is the wordmark. If you
only have a PNG or PDF, say so and let the agent place what it can and note the
gap. Do not invent a logo. The Media Kit page downloads whatever sits in those
paths.

Also fill `brand.json` → `mediaKit` when you have it: `shortName`, `website`,
`contactEmail`, `boilerplate`, and `oneLiner`. The customize script stamps those
onto `media-kit.html`.

## 2. Brand name and one-line feel

What is the brand called? In one or two sentences: who it serves, how it should
feel, and what it must never look like. The agent writes this into
`brand.json` (`name`, `tagline`, `description`) and the Overview in
`DESIGN.md`.

## 3. Colour palette

Do you already have a palette?

- **Yes.** Give the agent the values you care about, ideally as hex, with roles
  if you know them: primary, primary hover/deep, accent (must contrast with
  primary), page background, body text, optional success / warning / danger.
  Soft fills can be derived if you only have the solid brand colours.
- **No.** Tell the agent the vibe (for example "calm cool tech" or "warm
  editorial") and one must-use colour if you have it. It will propose a light
  palette that keeps accent contrasting with primary and keeps warning/danger
  separate from the brand accent.

## 4. Fonts

Do you already have brand type?

- **Yes.** Display (headings) family, body family, and whether they may be
  loaded from Google Fonts or only from your own host. Licensed fonts must not
  be committed to a public repo.
- **No.** Keep the demo pairing (PT Serif + Lato) or ask the agent for two open
  alternatives that match the feel from step 2.

## 5. Shape knobs (optional, thirty seconds)

Prefer pill buttons or squarer ones? Serif headings or sans headings? These map
to `brand.json` → `knobs.buttonRadius` and `knobs.headingFont`. Skip if you do
not care yet.

## 6. Apply and verify

Ask the agent to:

1. Write the answers into `brand.json` and set `"placeholder": false`.
2. Run `npm run customize` (or `node scripts/apply-brand.mjs`).
3. Rewrite `DESIGN.md` prose so it no longer talks about Example Brand.
4. Wire the new mark into the reference pages / favicon as needed.
5. Run customize again after prose edits, then open the reference site and
   confirm Colors, Typography, and the sidebar name look right.

Done when `placeholder` is false, the sidebar shows your name, chips match your
palette, and `DESIGN.md` reads like your brand — not the demo.
