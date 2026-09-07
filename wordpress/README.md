# WordPress projection

Generated. Do not edit these files by hand.

```bash
npm run compile:wordpress
```

`customize` runs the same compiler after it applies `brand.json`.

| File | What it is |
| --- | --- |
| `cds/` | Thin block theme. `theme.json` and `assets/css/` are generated. |
| `cds/brand-defaults.json` | Name + tagline from `brand.json`. Theme seeds Site Identity. |
| `cds/assets/mark.svg` | Kit mark. Site Logo fallback when none is uploaded. |
| `theme.json` | Same presets, for copy-only use. |
| `design-tokens.json` | Layer B registry for `register_design_token()`. |

```bash
node scripts/sync-theme.mjs --dest "C:/path/to/wp-content/themes/cds"
npm run test:wp
```

`test:wp` needs a running WordPress. Set `CDS_WP_BASE_URL` if it is not `http://localhost:8893`.

Contract: [`../WORDPRESS.md`](../WORDPRESS.md). `DESIGN.md` and `css/tokens.css` stay the source of truth. WordPress is a projection.

Authors start from **CDS sections** in the inserter (`cds/hero`, `cds/proof`, `cds/card-grid`, `cds/split`, `cds/quote`, `cds/dark-band`, `cds/cta`, `cds/alert`). Page recipes: `cds/article`, `cds/landing` (a stack). Button styles: secondary, outline, accent, ghost. Group layout styles: Copy, Cluster, Switcher, Sidebar, Center, Box. Group paint styles: surface, tint, panel, dark. Paragraph style: pill. Image styles: Frame, Original. Two-up marketing is Switcher, not Columns.

## Decision: literals in the projection

Date: 2026-08-26

Context: palette values can be `var(--cds-primary)` (one CSS SoR) or copied hex (self-contained `theme.json`).

Options considered: alias vars; literals; both.

Choice: literals copied from DESIGN.md / tokens.css. A theme can ship this file before it enqueues `cds.css`. Re-run the compiler after a brand change.

Reversibility: two-way door.

Revisit trigger: step 3 theme is enqueueing `cds.css` and the editor swatches still track.

## Decision: `info` stays off the paint picker

Marketing authors do not get `info`. It lives under `settings.custom` with the pairing tokens. Product UI can still read it.
