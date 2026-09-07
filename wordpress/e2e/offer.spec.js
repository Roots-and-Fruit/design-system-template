import { expect, test } from "@playwright/test";
import { countThirdPartyBlocks } from "./helpers.js";

test.describe("CDS offer canvas", () => {
  test.use({ viewport: { width: 1280, height: 900 } });

  test("title-hidden landing has one hero h1 and no post-title", async ({
    page,
  }) => {
    const response = await page.goto("/offer/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET /offer/ → ${response.status()}`).toBeTruthy();
    expect(await page.evaluate(countThirdPartyBlocks), "Core-only").toBe(0);

    const h1 = page.locator("h1");
    await expect(h1).toHaveCount(1);
    await expect(h1).toHaveClass(/has-display-xl-font-size/);
    await expect(page.locator(".wp-block-post-title")).toHaveCount(0);

    const hero = page.locator(".cds-hero").first();
    await expect(hero).toBeVisible();
    await expect(hero.locator(".is-style-cds-switcher > .wp-block-group")).toHaveCount(2);
    await expect(page.locator(".wp-block-columns")).toHaveCount(0);

    const tracks = await hero.locator(".is-style-cds-switcher > .wp-block-group").evaluateAll((els) => {
      if (els.length < 2) return { count: els.length, sideBySide: false };
      const a = els[0].getBoundingClientRect();
      const b = els[1].getBoundingClientRect();
      return {
        count: els.length,
        sideBySide: Math.abs(a.top - b.top) < 40 && a.right <= b.left + 2,
      };
    });
    expect(tracks.count).toBe(2);
    expect(tracks.sideBySide, "hero is two tracks at 1280").toBe(true);
  });
});
