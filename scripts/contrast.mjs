/**
 * Promised body-text contrast pairs.
 * The Color page grid (js/kit-a11y.js) is the picture. This list is the gate.
 */

export const BODY_MIN = 4.5;

export const PROMISED_PAIRS = [
  { fg: "on-primary", bg: "primary", min: BODY_MIN },
  { fg: "on-primary", bg: "primary-deep", min: BODY_MIN },
  { fg: "on-accent", bg: "accent", min: BODY_MIN },
  { fg: "on-dark", bg: "surface-dark", min: BODY_MIN },
  { fg: "ink", bg: "paper", min: BODY_MIN },
  { fg: "ink", bg: "surface", min: BODY_MIN },
  { fg: "ink", bg: "primary-soft", min: BODY_MIN },
  { fg: "primary-deep", bg: "primary-soft", min: BODY_MIN },
  { fg: "ink-muted", bg: "paper", min: BODY_MIN },
  { fg: "ink-muted", bg: "paper-deep", min: BODY_MIN },
  { fg: "ink-muted", bg: "surface", min: BODY_MIN },
  { fg: "ink-muted", bg: "panel", min: BODY_MIN },
];

function channel(value) {
  const c = value / 255;
  return c <= 0.04045 ? c / 12.92 : ((c + 0.055) / 1.055) ** 2.4;
}

function parseHex(input) {
  const match = String(input).trim().match(/^#([0-9a-f]{3}|[0-9a-f]{6})$/i);
  if (!match) return null;
  let hex = match[1];
  if (hex.length === 3) {
    hex = hex
      .split("")
      .map((part) => part + part)
      .join("");
  }
  return {
    r: Number.parseInt(hex.slice(0, 2), 16),
    g: Number.parseInt(hex.slice(2, 4), 16),
    b: Number.parseInt(hex.slice(4, 6), 16),
  };
}

function luminance(rgb) {
  return 0.2126 * channel(rgb.r) + 0.7152 * channel(rgb.g) + 0.0722 * channel(rgb.b);
}

/**
 * WCAG 2 contrast ratio for two hex colors.
 * @param {string} hexA
 * @param {string} hexB
 * @returns {number}
 */
export function contrastRatio(hexA, hexB) {
  const a = parseHex(hexA);
  const b = parseHex(hexB);
  if (!a || !b) {
    throw new Error(`contrastRatio needs hex colors, got ${hexA} and ${hexB}`);
  }
  const lighter = Math.max(luminance(a), luminance(b));
  const darker = Math.min(luminance(a), luminance(b));
  return (lighter + 0.05) / (darker + 0.05);
}

/**
 * @param {Record<string, string>} palette Slug to color.
 * @param {{ fg: string, bg: string, min: number }[]} pairs
 * @returns {string[]}
 */
export function checkPairs(palette, pairs) {
  const errors = [];
  for (const pair of pairs) {
    const fg = palette[pair.fg];
    const bg = palette[pair.bg];
    if (!fg || !bg) {
      errors.push(`contrast pair ${pair.fg} on ${pair.bg} is missing a color`);
      continue;
    }
    let ratio;
    try {
      ratio = contrastRatio(fg, bg);
    } catch (error) {
      errors.push(`contrast pair ${pair.fg} on ${pair.bg}: ${error.message}`);
      continue;
    }
    if (ratio < pair.min) {
      errors.push(
        `${pair.fg} (${fg}) on ${pair.bg} (${bg}) is ${ratio.toFixed(2)}:1, needs ${pair.min}:1`,
      );
    }
  }
  return errors;
}
