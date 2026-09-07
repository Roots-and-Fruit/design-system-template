import { expect, test } from "@playwright/test";

test.describe("CDS section catalog", () => {
  test("probe stacks the kit section jobs", async ({ page }) => {
    const response = await page.goto("/sections/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET /sections/ → ${response.status()}`).toBeTruthy();

    const hero = page.locator("h1.has-display-xl-font-size").first();
    const heroFrame = page.locator(".cds-hero").first();
    const pill = page.locator("p.is-style-cds-pill").first();
    const proof = page.locator(".has-paper-deep-background-color").first();
    const split = page.locator(".is-style-cds-switcher").first();
    const quote = page.locator("blockquote.wp-block-quote").first();
    const cardGrid = page.getByRole("heading", { name: "What you get" }).locator("xpath=..");
    const tiles = cardGrid.locator(":scope > .wp-block-group > .wp-block-group");

    await expect(hero).toBeVisible();
    await expect(heroFrame).toBeVisible();
    await expect(pill).toBeVisible();
    await expect(proof).toBeVisible();
    await expect(split).toBeVisible();
    await expect(quote).toBeVisible();
    await expect(tiles).toHaveCount(3);
    await expect(proof.locator("h3")).toHaveCount(5);
    await expect(heroFrame.locator("img")).toHaveCount(1);
    await expect(heroFrame.locator(":scope .is-style-cds-switcher > .wp-block-group")).toHaveCount(2);
    await expect(heroFrame.locator(".wp-block-columns")).toHaveCount(0);

    const widths = await page.evaluate(() => {
      const band = document.querySelector(".has-paper-deep-background-color");
      const hero = document.querySelector(".cds-hero");
      return {
        band: band.getBoundingClientRect().width,
        hero: hero.getBoundingClientRect().width,
        viewport: window.innerWidth,
      };
    });
    expect(widths.hero, "hero uses the wide marketing column").toBeGreaterThan(800);
    expect(widths.hero, "hero stays on wideSize").toBeLessThan(1100);
    expect(widths.band, "proof wash wider than the hero").toBeGreaterThan(
      widths.hero + 32,
    );
    expect(widths.band, "proof wash reaches the viewport").toBeGreaterThanOrEqual(
      widths.viewport * 0.9,
    );

    const grid = await proof.locator(":scope > .wp-block-group").first().evaluate((el) =>
      Math.round(el.getBoundingClientRect().width),
    );
    expect(Math.abs(grid - widths.hero), "proof stats share the hero column").toBeLessThanOrEqual(80);

    const layout = await proof.evaluate((band) => {
      const grid = band.querySelector(":scope > .wp-block-group");
      const cells = grid ? [...grid.querySelectorAll(":scope > .wp-block-group")] : [];
      const cols = grid
        ? getComputedStyle(grid).gridTemplateColumns.split(" ").filter(Boolean).length
        : 0;
      const stats = [...band.querySelectorAll("h3")].map((h) => getComputedStyle(h).textAlign);
      return {
        justify: grid ? getComputedStyle(grid).justifyItems : "",
        cols,
        cells: cells.length,
        aligns: stats,
      };
    });
    expect(layout.cells, "proof has five stats").toBe(5);
    expect(layout.cols, "proof tracks equal stats").toBe(layout.cells);
    expect(layout.justify, "proof tiles centered in the track").toMatch(/center/);
    for (const align of layout.aligns) {
      expect(align, "proof number is centered").toMatch(/center/);
    }

    const proofSize = await proof.locator("h3").first().evaluate((el) =>
      parseFloat(getComputedStyle(el).fontSize),
    );
    expect(proofSize, "proof numbers match kit h3 / display-sm").toBeGreaterThanOrEqual(27);

    const tileGap = await cardGrid
      .locator(":scope > .wp-block-group")
      .first()
      .evaluate((el) => parseFloat(getComputedStyle(el).columnGap || getComputedStyle(el).gap) || 0);
    expect(tileGap, "card grid uses --cds-grid, not Core's 9px").toBeGreaterThanOrEqual(22);

    const splitGap = await split.evaluate((el) => {
      const styles = getComputedStyle(el);
      return parseFloat(styles.columnGap || styles.gap) || 0;
    });
    expect(splitGap, "switcher gap").toBeGreaterThanOrEqual(16);

    const cardPaint = await tiles.evaluateAll((els) => {
      const relLum = (rgb) => {
        const [r, g, b] = rgb.map((c) => {
          const x = c / 255;
          return x <= 0.03928 ? x / 12.92 : ((x + 0.055) / 1.055) ** 2.4;
        });
        return 0.2126 * r + 0.7152 * g + 0.0722 * b;
      };
      const parseRgb = (value, fallback) => {
        const m = String(value).match(/rgba?\(([^)]+)\)/);
        if (!m) return fallback;
        const p = m[1].split(",").map((n) => parseFloat(n.trim()));
        if (p.length >= 4 && p[3] < 1 && fallback) {
          return p.slice(0, 3).map((c, i) => c * p[3] + fallback[i] * (1 - p[3]));
        }
        return p.slice(0, 3);
      };
      const ratio = (fg, bg) => {
        const L1 = relLum(fg);
        const L2 = relLum(bg);
        const hi = Math.max(L1, L2);
        const lo = Math.min(L1, L2);
        return (hi + 0.05) / (lo + 0.05);
      };

      return els.map((el) => {
        const bg = parseRgb(getComputedStyle(el).backgroundColor, [255, 255, 255]);
        const heading = el.querySelector("h3");
        const body = el.querySelector("p");
        const btn = el.querySelector(".wp-block-button__link");
        const headingSize = heading ? parseFloat(getComputedStyle(heading).fontSize) : 0;
        const headingWeight = heading ? parseInt(getComputedStyle(heading).fontWeight, 10) : 400;
        const headingLarge = headingSize >= 24 || (headingSize >= 18.66 && headingWeight >= 700);
        return {
          bg: getComputedStyle(el).backgroundColor,
          heading: heading ? ratio(parseRgb(getComputedStyle(heading).color, bg), bg) : 0,
          headingLarge,
          body: body ? ratio(parseRgb(getComputedStyle(body).color, bg), bg) : 0,
          button: btn ? ratio(parseRgb(getComputedStyle(btn).color, bg), bg) : 0,
        };
      });
    });

    const fills = cardPaint.map((tile) => tile.bg);
    expect(new Set(fills).size, "card grid uses three different fills").toBe(3);
    for (const [i, tile] of cardPaint.entries()) {
      const headingFloor = tile.headingLarge ? 3 : 4.5;
      expect(tile.heading, `card ${i + 1} heading contrast`).toBeGreaterThanOrEqual(headingFloor);
      expect(tile.body, `card ${i + 1} body contrast`).toBeGreaterThanOrEqual(4.5);
      expect(tile.button, `card ${i + 1} outline contrast`).toBeGreaterThanOrEqual(4.5);
    }

    const hoverTiles = [
      page.locator(".is-style-cds-tint .wp-block-button__link").first(),
      page.locator(".is-style-cds-dark .wp-block-button__link").first(),
    ];
    for (const [i, btn] of hoverTiles.entries()) {
      await btn.hover();
      const hoverPaint = await btn.evaluate((el) => {
        const group = el.closest(".is-style-cds-tint, .is-style-cds-dark");
        const relLum = (rgb) => {
          const [r, g, b] = rgb.map((c) => {
            const x = c / 255;
            return x <= 0.03928 ? x / 12.92 : ((x + 0.055) / 1.055) ** 2.4;
          });
          return 0.2126 * r + 0.7152 * g + 0.0722 * b;
        };
        const parseRgb = (value, fallback) => {
          const m = String(value).match(/rgba?\(([^)]+)\)/);
          if (!m) return fallback;
          const p = m[1].split(",").map((n) => parseFloat(n.trim()));
          if (p.length >= 4 && p[3] < 1 && fallback) {
            return p.slice(0, 3).map((c, i) => c * p[3] + fallback[i] * (1 - p[3]));
          }
          return p.slice(0, 3);
        };
        const ratio = (fg, bg) => {
          const L1 = relLum(fg);
          const L2 = relLum(bg);
          return (Math.max(L1, L2) + 0.05) / (Math.min(L1, L2) + 0.05);
        };
        const cardBg = parseRgb(getComputedStyle(group).backgroundColor, [255, 255, 255]);
        const btnBg = parseRgb(getComputedStyle(el).backgroundColor, cardBg);
        const btnFg = parseRgb(getComputedStyle(el).color, btnBg);
        return {
          vsCard: ratio(btnBg, cardBg),
          label: ratio(btnFg, btnBg),
        };
      });
      expect(hoverPaint.vsCard, `card hover ${i + 2} fill vs tile`).toBeGreaterThanOrEqual(2.5);
      expect(hoverPaint.label, `card hover ${i + 2} label contrast`).toBeGreaterThanOrEqual(4.5);
    }
  });
});
