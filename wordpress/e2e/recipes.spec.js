import { expect, test } from "@playwright/test";

test.describe("CDS recipes", () => {
  test("bands have inner padding and space between them", async ({ page }) => {
    const response = await page.goto("/cds-catalog/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET /cds-catalog/ → ${response.status()}`).toBeTruthy();

    const paper = page.locator(".has-paper-deep-background-color").first();
    const dark = page.locator(".wp-block-group.alignfull.is-style-cds-dark").first();
    const cta = page.locator(".is-style-cds-panel").first();

    await expect(paper).toBeVisible();
    await expect(dark).toBeVisible();
    await expect(cta).toBeVisible();

    const paperBox = await paper.evaluate((el) => {
      const styles = getComputedStyle(el);
      const heading = el.querySelector("h2, h3");
      const elBox = el.getBoundingClientRect();
      const headBox = heading.getBoundingClientRect();
      return {
        paddingTop: parseFloat(styles.paddingTop),
        inset: headBox.top - elBox.top,
      };
    });

    expect(paperBox.paddingTop, "paper-deep band padding-top").toBeGreaterThanOrEqual(24);
    expect(paperBox.inset, "heading inset from band top").toBeGreaterThanOrEqual(24);

    const gap = await page.evaluate(() => {
      const paperEl = document.querySelector(".has-paper-deep-background-color");
      const darkEl = document.querySelector(".wp-block-group.alignfull.is-style-cds-dark");
      const ctaEl = document.querySelector(".is-style-cds-panel");
      const a = paperEl.getBoundingClientRect();
      const b = darkEl.getBoundingClientRect();
      const c = ctaEl.getBoundingClientRect();
      return {
        paperToDark: b.top - a.bottom,
        darkToCta: c.top - b.bottom,
      };
    });

    expect(gap.paperToDark, "gap paper-deep → dark band").toBeGreaterThanOrEqual(24);
    expect(gap.darkToCta, "gap dark band → CTA").toBeGreaterThanOrEqual(24);
  });

  test("dark band uses on-dark type and one accent button", async ({ page }) => {
    const response = await page.goto("/cds-catalog/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok()).toBeTruthy();

    const dark = page.locator(".wp-block-group.alignfull.is-style-cds-dark").first();
    await expect(dark).toBeVisible();

    const paint = await dark.evaluate((el) => {
      const heading = el.querySelector("h2, h1, h3");
      const btn = el.querySelector(".is-style-cds-accent .wp-block-button__link, .wp-block-button__link");
      const hs = heading ? getComputedStyle(heading) : null;
      const bs = btn ? getComputedStyle(btn) : null;
      return {
        bandBg: getComputedStyle(el).backgroundColor,
        headingColor: hs?.color || "",
        btnBg: bs?.backgroundColor || "",
        btnRadius: bs ? parseFloat(bs.borderRadius) : 0,
      };
    });

    expect(paint.bandBg).toBe("rgb(15, 23, 42)");
    expect(paint.headingColor).toBe("rgb(241, 245, 249)");
    expect(paint.btnBg).toBe("rgb(225, 29, 72)");
    expect(paint.btnRadius).toBeGreaterThanOrEqual(999);
  });

  test("last dark wash on The site meets the footer", async ({ page }) => {
    const response = await page.goto("/the-site/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET /the-site/ → ${response.status()}`).toBeTruthy();

    const gap = await page.evaluate(() => {
      const washes = document.querySelectorAll(
        ".wp-block-post-content > .alignfull.is-style-cds-dark"
      );
      const last = washes[washes.length - 1];
      const footer = document.querySelector("footer");
      if (!last || !footer) return { missing: true, stripe: 0 };
      return {
        missing: false,
        stripe: footer.getBoundingClientRect().top - last.getBoundingClientRect().bottom,
      };
    });

    expect(gap.missing, "dark band and footer present").toBe(false);
    expect(Math.abs(gap.stripe), "no paper stripe between last wash and footer").toBeLessThanOrEqual(2);
  });
});
