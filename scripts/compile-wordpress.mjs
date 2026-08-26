#!/usr/bin/env node
/**
 * Compile DESIGN.md + css/tokens.css into a WordPress projection.
 *
 *   node scripts/compile-wordpress.mjs
 *
 * Writes:
 *   wordpress/cds/theme.json         into the thin block theme
 *   wordpress/cds/design-tokens.json Layer B registry
 *   wordpress/cds/assets/css/        copied kit CSS (no base.css)
 *   wordpress/cds/assets/mark.svg    kit mark (Site Logo fallback)
 *   wordpress/cds/brand-defaults.json name + tagline for first-run identity
 *   wordpress/theme.json             same JSON, for copy-only use
 *
 * DESIGN.md stays the source of truth. Re-run after customize or token edits.
 * Zero install. Do not hand-edit the generated files.
 */

import { copyFileSync, existsSync, mkdirSync, readFileSync, writeFileSync } from "node:fs";
import { dirname, join } from "node:path";
import { fileURLToPath } from "node:url";
import {
  parseCdsTokens,
  parseDesignMdFrontMatter,
  resolveInlineRefs,
  resolveTokenRef,
} from "./lib/parse-yaml-map.mjs";

const __dirname = dirname(fileURLToPath(import.meta.url));
const root = join(__dirname, "..");
const outDir = join(root, "wordpress");

/** Fallback when DESIGN.md has no layout.content-size yet. */
const CONTENT_SIZE = "40rem";

const HUE_SLUG = /^(green|cream|orange|cyan|rose|blue|brown|navy|slate|yellow|red|purple|pink|teal|moss|neutral|secondary|tertiary)(-|$)/i;

/** Semantic colors authors may paint. `info` stays off the marketing palette. */
const PALETTE = [
  ["paper", "Paper"],
  ["paper-deep", "Paper deep"],
  ["surface", "Surface"],
  ["panel", "Panel"],
  ["panel-soft", "Panel soft"],
  ["ink", "Ink"],
  ["ink-deep", "Ink deep"],
  ["ink-muted", "Ink muted"],
  ["primary", "Primary"],
  ["primary-deep", "Primary deep"],
  ["primary-soft", "Primary soft"],
  ["accent", "Accent"],
  ["accent-soft", "Accent soft"],
  ["surface-dark", "Surface dark"],
  ["success", "Success"],
  ["success-soft", "Success soft"],
  ["warning", "Warning"],
  ["warning-soft", "Warning soft"],
  ["danger", "Danger"],
  ["danger-soft", "Danger soft"],
];

const FONT_SIZE_ROLES = [
  "display-xl",
  "display-lg",
  "display-md",
  "display-sm",
  "body-lg",
  "body-md",
  "body-sm",
  "label",
  "meta",
  "code",
];

const RADIUS_NAMES = {
  sm: "Small",
  md: "Medium",
  lg: "Large",
  pill: "Pill",
};

function read(rel) {
  return readFileSync(join(root, rel), "utf8");
}

function writeJson(rel, data) {
  const abs = join(root, rel);
  mkdirSync(dirname(abs), { recursive: true });
  writeFileSync(abs, `${JSON.stringify(data, null, 2)}\n`, "utf8");
  console.log(`  wrote ${rel}`);
}

function prettyName(slug) {
  return slug
    .split("-")
    .map((part) => {
      if (/^(xl|lg|md|sm)$/i.test(part)) return part.toUpperCase();
      return part.charAt(0).toUpperCase() + part.slice(1);
    })
    .join(" ");
}

function quoteStack(stack) {
  return String(stack)
    .split(",")
    .map((part) => {
      const name = part.trim();
      if (!name) return "";
      if (/^["'].*["']$/.test(name)) return name;
      if (/\s/.test(name)) return `"${name}"`;
      return name;
    })
    .filter(Boolean)
    .join(", ");
}

function preset(kind, slug) {
  return `var:preset|${kind}|${slug}`;
}

function custom(path) {
  return `var:custom|${path}`;
}

function splitPadding(value) {
  const parts = String(value).trim().split(/\s+/);
  if (parts.length >= 2) return { block: parts[0], inline: parts[1] };
  return { block: parts[0] || "0", inline: parts[0] || "0" };
}

function idToCustomKey(id) {
  const slug = id.replaceAll("/", "-").replace(/[^a-z0-9-]/gi, "");
  return slug
    .split("-")
    .map((part, i) =>
      i === 0 ? part : part.charAt(0).toUpperCase() + part.slice(1),
    )
    .join("");
}

function loadSources() {
  const design = parseDesignMdFrontMatter(read("DESIGN.md"));
  const tokens = parseCdsTokens(read("css/tokens.css"));
  const required = ["colors", "typography", "rounded", "spacing", "components"];
  for (const key of required) {
    if (!design[key] || typeof design[key] !== "object") {
      throw new Error(`DESIGN.md front matter missing "${key}"`);
    }
  }
  return { design, tokens };
}

function loadBrandDefaults(design) {
  let name = design.name || "Example Brand";
  let tagline = "";
  try {
    const brand = JSON.parse(read("brand.json"));
    if (brand.name) name = brand.name;
    if (brand.tagline) tagline = brand.tagline;
  } catch {
    // DESIGN.md name is enough for a missing or broken brand.json
  }
  return { name, tagline, mark: "assets/mark.svg" };
}

function color(design, tokens, slug) {
  const value = resolveTokenRef(
    design.colors[slug] ?? tokens[slug],
    design,
    tokens,
  );
  if (!value) throw new Error(`Missing color token "${slug}"`);
  return value;
}

function css(design, tokens, name, fallback) {
  const value = resolveTokenRef(tokens[name], design, tokens);
  return value || fallback;
}

function yamlOrCss(design, tokens, group, key, cssName, fallback) {
  const yaml = design[group]?.[key];
  if (yaml != null && String(yaml).trim() !== "") {
    return resolveInlineRefs(yaml, design, tokens);
  }
  return css(design, tokens, cssName, fallback);
}

function buildPalette(design, tokens) {
  return PALETTE.map(([slug, name]) => {
    if (HUE_SLUG.test(slug)) {
      throw new Error(`Palette slug "${slug}" is a hue/alias, not a job`);
    }
    return { slug, name, color: color(design, tokens, slug) };
  });
}

function buildFontFamilies(design) {
  const type = design.typography;
  return [
    {
      slug: "display",
      name: "Display",
      fontFamily: quoteStack(type["display-xl"].fontFamily),
    },
    {
      slug: "body",
      name: "Body",
      fontFamily: quoteStack(type["body-md"].fontFamily),
    },
    {
      slug: "mono",
      name: "Mono",
      fontFamily: quoteStack(type.code.fontFamily),
    },
  ];
}

function buildFontSizes(design) {
  return FONT_SIZE_ROLES.map((slug) => {
    const role = design.typography[slug];
    if (!role?.fontSize) throw new Error(`typography.${slug}.fontSize missing`);
    return {
      slug,
      name: prettyName(slug),
      size: String(role.fontSize),
    };
  });
}

function buildSpacing(design) {
  return Object.keys(design.spacing)
    .sort((a, b) => Number(a) - Number(b))
    .map((key) => ({
      slug: `space-${key}`,
      name: `Space ${key}`,
      size: String(design.spacing[key]),
    }));
}

function buildRadii(design) {
  return Object.entries(design.rounded).map(([slug, size]) => ({
    slug,
    name: RADIUS_NAMES[slug] || prettyName(slug),
    size: String(size),
  }));
}

function buildShadows(design, tokens) {
  return [
    {
      slug: "sm",
      name: "Small",
      shadow: yamlOrCss(
        design,
        tokens,
        "elevation",
        "sm",
        "shadow",
        "0 2px 14px rgba(15, 23, 42, 0.06)",
      ),
    },
    {
      slug: "md",
      name: "Medium",
      shadow: yamlOrCss(
        design,
        tokens,
        "elevation",
        "md",
        "shadow-md",
        "0 10px 32px rgba(15, 23, 42, 0.1)",
      ),
    },
  ];
}

function buildCustom(design, tokens) {
  const button = design.components["button-primary"] || {};
  const padding = splitPadding(button.padding || "0.7rem 1.15rem");
  const buttonRadius = resolveTokenRef(
    button.rounded || "{rounded.pill}",
    design,
    tokens,
  );
  const surface = design.components.surface || {};
  const input = design.components.input || {};

  return {
    on: {
      primary: color(design, tokens, "on-primary"),
      accent: color(design, tokens, "on-accent"),
      dark: color(design, tokens, "on-dark"),
      "dark-muted": color(design, tokens, "on-dark-muted"),
    },
    rule: color(design, tokens, "rule"),
    "ink-soft": color(design, tokens, "ink-soft"),
    "panel-deep": color(design, tokens, "panel-deep"),
    info: color(design, tokens, "info"),
    "info-soft": color(design, tokens, "info-soft"),
    "line-height": {
      display: String(design.typography["display-xl"].lineHeight),
      snug: String(design.typography["display-sm"].lineHeight),
      body: String(design.typography["body-md"].lineHeight),
      callout: css(design, tokens, "leading-callout", "1.5"),
      ui: String(design.typography["body-sm"].lineHeight),
    },
    "letter-spacing": {
      display: String(design.typography["display-xl"].letterSpacing ?? "0"),
      meta: String(design.typography.meta.letterSpacing ?? "0.06em"),
    },
    "font-weight": {
      regular: String(design.typography["body-md"].fontWeight),
      emphasis: String(design.typography.label.fontWeight),
      bold: String(design.typography["display-xl"].fontWeight),
    },
    layout: {
      measure: yamlOrCss(design, tokens, "layout", "measure", "measure", "62ch"),
      "content-size": yamlOrCss(
        design,
        tokens,
        "layout",
        "content-size",
        "content-size",
        CONTENT_SIZE,
      ),
      "wide-size": yamlOrCss(design, tokens, "layout", "wide-size", "max", "60rem"),
    },
    button: {
      radius: String(buttonRadius),
      "padding-block": padding.block,
      "padding-inline": padding.inline,
    },
    input: {
      radius: String(
        resolveTokenRef(input.rounded || "{rounded.sm}", design, tokens),
      ),
    },
    surface: {
      radius: String(
        resolveTokenRef(surface.rounded || "{rounded.md}", design, tokens),
      ),
      padding: String(surface.padding || "1.5rem"),
    },
    focus: {
      ring: yamlOrCss(
        design,
        tokens,
        "focus",
        "ring",
        "focus",
        "0 0 0 3px color-mix(in srgb, var(--cds-primary) 38%, transparent)",
      ),
    },
  };
}

function buildRegistry(customValues) {
  const tokens = [
    ["cds/on-primary", "On primary", "color", customValues.on.primary],
    ["cds/on-accent", "On accent", "color", customValues.on.accent],
    ["cds/on-dark", "On dark", "color", customValues.on.dark],
    [
      "cds/on-dark-muted",
      "On dark muted",
      "color",
      customValues.on["dark-muted"],
    ],
    ["cds/rule", "Rule", "color", customValues.rule],
    [
      "cds/button-radius",
      "Button radius",
      "border-radius",
      customValues.button.radius,
    ],
    [
      "cds/button-padding-block",
      "Button padding block",
      "spacing",
      customValues.button["padding-block"],
    ],
    [
      "cds/button-padding-inline",
      "Button padding inline",
      "spacing",
      customValues.button["padding-inline"],
    ],
    [
      "cds/input-radius",
      "Input radius",
      "border-radius",
      customValues.input.radius,
    ],
    [
      "cds/surface-radius",
      "Surface radius",
      "border-radius",
      customValues.surface.radius,
    ],
    [
      "cds/surface-padding",
      "Surface padding",
      "spacing",
      customValues.surface.padding,
    ],
    [
      "cds/layout-content-size",
      "Content size",
      "spacing",
      customValues.layout["content-size"],
    ],
    [
      "cds/layout-wide-size",
      "Wide size",
      "spacing",
      customValues.layout["wide-size"],
    ],
    ["cds/focus-ring", "Focus ring", "text", customValues.focus.ring],
  ];

  return tokens.map(([id, label, type, value]) => ({
    id,
    label,
    type,
    default: String(value),
    scope: "global",
    custom_key: idToCustomKey(id),
  }));
}

function buildStyles() {
  return {
    color: {
      background: preset("color", "paper"),
      text: preset("color", "ink"),
    },
    typography: {
      fontFamily: preset("font-family", "body"),
      fontSize: preset("font-size", "body-md"),
      lineHeight: custom("line-height|body"),
    },
    spacing: {
      blockGap: preset("spacing", "space-5"),
      padding: {
        top: "0",
        bottom: "0",
        left: preset("spacing", "space-5"),
        right: preset("spacing", "space-5"),
      },
    },
    elements: {
      link: {
        color: { text: preset("color", "primary") },
        typography: { fontWeight: custom("font-weight|emphasis") },
        ":hover": {
          typography: { textDecoration: "underline" },
        },
      },
      button: {
        color: {
          background: preset("color", "primary"),
          text: custom("on|primary"),
        },
        typography: {
          fontFamily: preset("font-family", "body"),
          fontSize: preset("font-size", "label"),
          fontWeight: custom("font-weight|emphasis"),
        },
        border: { radius: custom("button|radius") },
        spacing: {
          padding: {
            top: custom("button|padding-block"),
            bottom: custom("button|padding-block"),
            left: custom("button|padding-inline"),
            right: custom("button|padding-inline"),
          },
        },
        ":hover": {
          color: { background: preset("color", "primary-deep") },
        },
      },
      caption: {
        color: { text: preset("color", "ink-muted") },
        typography: { fontSize: preset("font-size", "body-sm") },
      },
      cite: {
        color: { text: preset("color", "ink-muted") },
        typography: { fontSize: preset("font-size", "body-sm") },
      },
      h1: {
        color: { text: preset("color", "ink-deep") },
        typography: {
          fontFamily: preset("font-family", "display"),
          fontSize: preset("font-size", "display-xl"),
          lineHeight: custom("line-height|display"),
          letterSpacing: custom("letter-spacing|display"),
        },
      },
      h2: {
        color: { text: preset("color", "ink-deep") },
        typography: {
          fontFamily: preset("font-family", "display"),
          fontSize: preset("font-size", "display-lg"),
          lineHeight: custom("line-height|display"),
        },
      },
      h3: {
        color: { text: preset("color", "ink-deep") },
        typography: {
          fontFamily: preset("font-family", "display"),
          fontSize: preset("font-size", "display-md"),
          lineHeight: custom("line-height|display"),
        },
      },
      h4: {
        color: { text: preset("color", "ink-deep") },
        typography: {
          fontFamily: preset("font-family", "display"),
          fontSize: preset("font-size", "display-sm"),
          lineHeight: custom("line-height|snug"),
        },
      },
      h5: {
        typography: {
          fontSize: preset("font-size", "body-lg"),
          fontWeight: custom("font-weight|emphasis"),
        },
      },
      h6: {
        typography: {
          fontSize: preset("font-size", "label"),
          fontWeight: custom("font-weight|emphasis"),
        },
      },
      heading: {
        color: { text: preset("color", "ink-deep") },
        typography: { fontFamily: preset("font-family", "display") },
      },
      code: {
        color: { background: preset("color", "panel-soft") },
        typography: { fontFamily: preset("font-family", "mono") },
        border: { radius: preset("border-radius", "sm") },
      },
    },
    blocks: {
      "core/quote": {
        border: {
          color: preset("color", "primary"),
          width: "0 0 0 4px",
          style: "solid",
        },
        spacing: {
          padding: {
            left: preset("spacing", "space-5"),
            right: preset("spacing", "space-5"),
          },
        },
      },
      "core/code": {
        color: {
          background: preset("color", "panel-soft"),
          text: preset("color", "ink"),
        },
        typography: { fontFamily: preset("font-family", "mono") },
        border: { radius: preset("border-radius", "md") },
        spacing: {
          padding: preset("spacing", "space-4"),
        },
      },
      "core/preformatted": {
        color: {
          background: preset("color", "panel-soft"),
          text: preset("color", "ink"),
        },
        typography: { fontFamily: preset("font-family", "mono") },
        border: { radius: preset("border-radius", "md") },
        spacing: {
          padding: preset("spacing", "space-4"),
        },
      },
      "core/separator": {
        color: { background: custom("rule") },
      },
      "core/buttons": {
        spacing: { blockGap: preset("spacing", "space-3") },
      },
      "core/post-content": {
        spacing: { blockGap: preset("spacing", "space-6") },
      },
      "core/group": {
        spacing: { blockGap: preset("spacing", "space-5") },
      },
      "core/columns": {
        spacing: { blockGap: preset("spacing", "space-5") },
      },
      "core/table": {
        typography: { fontSize: preset("font-size", "body-sm") },
        border: { radius: preset("border-radius", "md") },
      },
      "core/details": {
        typography: {
          fontSize: preset("font-size", "body-sm"),
          fontWeight: custom("font-weight|emphasis"),
        },
      },
      "core/site-logo": {
        spacing: { padding: { right: "0", left: "0" } },
      },
      "core/site-title": {
        typography: {
          fontFamily: preset("font-family", "display"),
          fontSize: preset("font-size", "body-lg"),
          fontWeight: custom("font-weight|emphasis"),
        },
        elements: {
          link: {
            color: { text: preset("color", "ink-deep") },
            typography: { textDecoration: "none" },
            ":hover": {
              color: { text: preset("color", "primary") },
              typography: { textDecoration: "none" },
            },
          },
        },
      },
      "core/site-tagline": {
        color: { text: preset("color", "ink-muted") },
        typography: { fontSize: preset("font-size", "body-sm") },
      },
      "core/navigation": {
        color: { text: preset("color", "ink") },
        typography: { fontWeight: custom("font-weight|emphasis") },
        elements: {
          link: {
            color: { text: preset("color", "ink") },
            ":hover": {
              color: { text: preset("color", "primary") },
              typography: { textDecoration: "underline" },
            },
          },
        },
      },
      "core/post-date": {
        color: { text: preset("color", "ink-muted") },
        typography: { fontSize: preset("font-size", "meta") },
      },
      "core/post-terms": {
        color: { text: preset("color", "ink-muted") },
        typography: { fontSize: preset("font-size", "meta") },
      },
    },
  };
}

function buildThemeJson({ design, tokens, customValues }) {
  const wideSize = customValues.layout["wide-size"];
  return {
    $schema: "https://schemas.wp.org/trunk/theme.json",
    version: 3,
    settings: {
      appearanceTools: false,
      useRootPaddingAwareAlignments: true,
      color: {
        custom: false,
        customDuotone: false,
        customGradient: false,
        defaultDuotone: false,
        defaultGradients: false,
        defaultPalette: false,
        palette: buildPalette(design, tokens),
      },
      typography: {
        customFontSize: false,
        defaultFontSizes: false,
        fluid: false,
        fontFamilies: buildFontFamilies(design),
        fontSizes: buildFontSizes(design),
      },
      spacing: {
        defaultSpacingSizes: false,
        spacingSizes: buildSpacing(design),
        units: ["px", "rem", "em", "%", "ch"],
      },
      border: {
        radiusSizes: buildRadii(design),
      },
      shadow: {
        defaultPresets: false,
        presets: buildShadows(design, tokens),
      },
      layout: {
        contentSize: customValues.layout["content-size"],
        wideSize,
      },
      custom: customValues,
    },
    styles: buildStyles(),
    templateParts: [
      { name: "header", title: "Header", area: "header" },
      { name: "footer", title: "Footer", area: "footer" },
    ],
  };
}

function validate(theme, registry) {
  const errors = [];
  const slugs = theme.settings.color.palette.map((item) => item.slug);
  for (const slug of slugs) {
    if (HUE_SLUG.test(slug)) {
      errors.push(`palette slug "${slug}" is a hue or reserved alias`);
    }
  }
  for (const need of ["paper", "ink", "ink-deep", "primary", "accent"]) {
    if (!slugs.includes(need)) errors.push(`palette missing "${need}"`);
  }
  if (slugs.includes("info")) {
    errors.push("info must stay off the marketing palette");
  }
  if (slugs.includes("green") || slugs.includes("cream") || slugs.includes("orange")) {
    errors.push("hue names leaked into the palette");
  }
  if (registry.length > 48) {
    errors.push(`registry has ${registry.length} tokens; Gutenberg max is 48`);
  }
  const types = new Set(["color", "border-radius", "spacing", "text"]);
  for (const token of registry) {
    if (!types.has(token.type)) {
      errors.push(`${token.id} has invalid type "${token.type}"`);
    }
  }
  if (!theme.settings.color.palette.every((item) => item.color)) {
    errors.push("palette entry missing color value");
  }
  if (theme.settings.typography.fluid !== false) {
    errors.push("typography.fluid must be false");
  }
  if (errors.length) {
    throw new Error(`compile-wordpress checks failed:\n- ${errors.join("\n- ")}`);
  }
}

function validateChromeParts() {
  const errors = [];
  const header = read("wordpress/cds/parts/header.html");
  const footer = read("wordpress/cds/parts/footer.html");
  for (const needle of [
    "wp:site-logo",
    "wp:site-title",
    "wp:site-tagline",
    "wp:navigation",
    "cds-identity",
  ]) {
    if (!header.includes(needle)) {
      errors.push(`parts/header.html missing ${needle}`);
    }
  }
  for (const needle of ["wp:site-logo", "wp:site-title", "wp:site-tagline", "cds-identity"]) {
    if (!footer.includes(needle)) {
      errors.push(`parts/footer.html missing ${needle}`);
    }
  }
  if (errors.length) {
    throw new Error(`compile-wordpress chrome checks failed:\n- ${errors.join("\n- ")}`);
  }
}

function main() {
  const { design, tokens } = loadSources();
  const customValues = buildCustom(design, tokens);
  const theme = buildThemeJson({ design, tokens, customValues });
  const registry = buildRegistry(customValues);
  validate(theme, registry);

  mkdirSync(outDir, { recursive: true });
  mkdirSync(join(root, "wordpress/cds/assets/css"), { recursive: true });

  const registryFile = {
    $comment:
      "Generated Layer B registry. Feed to register_design_token(). Do not edit.",
    source: {
      design: "DESIGN.md",
      tokens: "css/tokens.css",
      brand: design.name,
    },
    tokens: registry,
  };

  writeJson("wordpress/theme.json", theme);
  writeJson("wordpress/design-tokens.json", registryFile);
  writeJson("wordpress/cds/theme.json", theme);
  writeJson("wordpress/cds/design-tokens.json", registryFile);

  const defaults = loadBrandDefaults(design);
  writeJson("wordpress/cds/brand-defaults.json", {
    $comment:
      "Generated from brand.json. Theme seeds Site Title / Tagline on first run, and when those options still match the last seed. Do not edit.",
    name: defaults.name,
    tagline: defaults.tagline,
    mark: defaults.mark,
  });

  for (const file of ["fonts.css", "tokens.css", "layouts.css", "components.css"]) {
    copyFileSync(join(root, "css", file), join(root, "wordpress/cds/assets/css", file));
    console.log(`  copied css/${file} → wordpress/cds/assets/css/${file}`);
  }

  const markSrc = join(root, "assets", "mark.svg");
  if (!existsSync(markSrc)) {
    throw new Error("Missing assets/mark.svg (Site Logo fallback).");
  }
  copyFileSync(markSrc, join(root, "wordpress/cds/assets/mark.svg"));
  console.log("  copied assets/mark.svg → wordpress/cds/assets/mark.svg");

  validateChromeParts();

  console.log(
    `Compiled ${design.name}: ${theme.settings.color.palette.length} colors, ${registry.length} custom tokens.`,
  );
}

main();
