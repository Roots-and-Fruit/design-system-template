/**
 * Curated Fontshare pairs. The first twelve match the opening grid on
 * https://www.fontshare.com/pairs (left to right, top to bottom).
 *
 * A pair fills the display and body roles. Mono stays the brand mono.
 * Faces load from the Fontshare CSS API. Do not commit the font files.
 * Reading and display weights stay at 400 or heavier. A lighter face plus
 * small muted type fails contrast on the page.
 */

export const FONT_PAIRS = [
  pair("amulya-synonym", "Amulya", "amulya", 700, "sans", "Synonym", "synonym", 400, 600, "sans"),
  pair("chubbo-supreme", "Chubbo", "chubbo", 700, "sans", "Supreme", "supreme", 400, 700, "sans"),
  pair("bebas-nunito", "Bebas Neue", "bebas-neue", 400, "sans", "Nunito", "nunito", 400, 600, "sans"),
  pair("excon-ranade", "Excon", "excon", 500, "sans", "Ranade", "ranade", 400, 700, "sans"),
  pair("tanker-bespoke-serif", "Tanker", "tanker", 400, "sans", "Bespoke Serif", "bespoke-serif", 400, 700, "serif"),
  pair("bespoke-stencil-supreme", "Bespoke Stencil", "bespoke-stencil", 700, "sans", "Supreme", "supreme", 400, 700, "sans"),
  pair("trench-slab-general-sans", "Trench Slab", "trench-slab", 500, "serif", "General Sans", "general-sans", 400, 600, "sans"),
  pair("general-sans-gambetta", "General Sans", "general-sans", 600, "sans", "Gambetta", "gambetta", 400, 600, "serif"),
  pair("array-khand", "Array", "array", 400, "sans", "Khand", "khand", 400, 600, "sans"),
  pair("pilcrow-hind", "Pilcrow Rounded", "pilcrow-rounded", 600, "sans", "Hind", "hind", 400, 600, "sans"),
  pair("khand-hind", "Khand", "khand", 700, "sans", "Hind", "hind", 400, 600, "sans"),
  pair("general-sans", "General Sans", "general-sans", 600, "sans", "General Sans", "general-sans", 400, 700, "sans"),
];

function pair(id, displayFamily, displaySlug, displayWeight, displayFallback, bodyFamily, bodySlug, bodyWeight, bodyEmphasis, bodyFallback) {
  return {
    id,
    title: `${displayFamily} + ${bodyFamily}`,
    display: face(displayFamily, displaySlug, displayWeight, displayFallback),
    body: face(bodyFamily, bodySlug, bodyWeight, bodyFallback, bodyEmphasis),
  };
}

function face(family, slug, weight, fallback, emphasis = weight) {
  const reading = Math.max(400, Number(weight));
  const strong = Math.max(reading, Number(emphasis));
  return { family, slug, weight: reading, emphasis: strong, fallback };
}

export function stackCss(face) {
  const quoted = `"${face.family}"`;
  if (face.fallback === "serif") {
    return `${quoted}, Georgia, "Times New Roman", serif`;
  }
  return `${quoted}, system-ui, sans-serif`;
}

export function fontshareCssUrl(entry) {
  const groups = new Map();
  const add = (slug, weight) => {
    if (!groups.has(slug)) groups.set(slug, new Set());
    groups.get(slug).add(weight);
  };
  add(entry.display.slug, entry.display.weight);
  add(entry.body.slug, entry.body.weight);
  if (entry.body.emphasis !== entry.body.weight) {
    add(entry.body.slug, entry.body.emphasis);
  }
  const query = [...groups.entries()]
    .map(([slug, weights]) => {
      const list = [...weights].sort((a, b) => a - b).join(",");
      return `f[]=${slug}@${list}`;
    })
    .join("&");
  return `https://api.fontshare.com/v2/css?${query}&display=swap`;
}

export function findPair(id) {
  if (!id) return null;
  return FONT_PAIRS.find((entry) => entry.id === id) || null;
}

export function fontPairsForBrand(fonts = {}) {
  const ids = Array.isArray(fonts.pairs) && fonts.pairs.length ? fonts.pairs : FONT_PAIRS.map((entry) => entry.id);
  return ids.map((id) => {
    const entry = findPair(id);
    if (!entry) throw new Error(`brand.json fonts.pairs has unknown pair "${id}"`);
    return entry;
  });
}

export function pairCatalogRecord(entry, displayStack, bodyStack) {
  return {
    id: entry.id,
    title: entry.title,
    cssUrl: fontshareCssUrl(entry),
    display: displayStack,
    body: bodyStack,
    displayWeight: String(entry.display.weight),
    bodyWeight: String(entry.body.weight),
    emphasisWeight: String(entry.body.emphasis),
  };
}

export function pairStyleVariation(entry, displayStack, bodyStack, monoFamily) {
  const headingWeight = String(entry.display.weight);
  const heading = { typography: { fontWeight: headingWeight } };
  return {
    file: `pair-${entry.id}.json`,
    data: {
      $schema: "https://schemas.wp.org/trunk/theme.json",
      version: 3,
      title: entry.title,
      settings: {
        typography: {
          fontFamilies: [
            { slug: "display", name: "Display", fontFamily: displayStack },
            { slug: "body", name: "Body", fontFamily: bodyStack },
            { slug: "mono", name: "Mono", fontFamily: monoFamily },
          ],
        },
        custom: {
          "font-weight": {
            regular: String(entry.body.weight),
            emphasis: String(entry.body.emphasis),
            bold: headingWeight,
          },
        },
      },
      styles: {
        typography: { fontWeight: String(entry.body.weight) },
        elements: {
          heading,
          h1: heading,
          h2: heading,
          h3: heading,
          h4: heading,
        },
      },
    },
  };
}
