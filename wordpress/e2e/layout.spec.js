import { expect, test } from "@playwright/test";

test.describe("CDS layout walk", () => {
  test("Switcher, Sidebar, Frame, Box, and Copy are on the layout page", async ({
    page,
  }) => {
    const response = await page.goto("/layout/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET /layout/ → ${response.status()}`).toBeTruthy();

    await expect(page.locator(".is-style-cds-copy").first()).toBeVisible();
    await expect(page.locator(".is-style-cds-switcher").first()).toBeVisible();
    await expect(page.locator(".is-style-cds-sidebar").first()).toBeVisible();
    await expect(page.locator(".is-style-cds-box").first()).toBeVisible();
    await expect(page.locator(".wp-block-columns")).toHaveCount(0);

    const facts = await page.evaluate(() => {
      const img = document.querySelector(".is-style-cds-frame img");
      const box = document.querySelector(".is-style-cds-box");
      const copy = document.querySelector(".is-style-cds-copy");
      const heading = copy?.querySelector("h3, h2, h1");
      const lede = copy?.querySelector("p.has-body-lg-font-size, p:not(.is-style-cds-pill)");
      const buttons = copy?.querySelector(".wp-block-buttons");
      const imgBox = img ? img.getBoundingClientRect() : null;
      const boxStyles = box ? getComputedStyle(box) : null;
      const headingBox = heading?.getBoundingClientRect();
      const ledeBox = lede?.getBoundingClientRect();
      const btnBox = buttons?.getBoundingClientRect();
      return {
        ratio: imgBox && imgBox.height ? imgBox.width / imgBox.height : 0,
        padTop: boxStyles ? parseFloat(boxStyles.paddingTop) : 0,
        padInline: boxStyles ? parseFloat(boxStyles.paddingLeft) : 0,
        titleToLede:
          headingBox && ledeBox ? ledeBox.top - headingBox.bottom : 0,
        ledeToAsk: ledeBox && btnBox ? btnBox.top - ledeBox.bottom : 0,
      };
    });

    expect(facts.ratio, "Frame holds ~4/3").toBeGreaterThan(1.2);
    expect(facts.ratio, "Frame holds ~4/3").toBeLessThan(1.5);
    expect(facts.padTop, "Box even inset").toBeGreaterThanOrEqual(30);
    expect(Math.abs(facts.padTop - facts.padInline), "Box not mixed 6/5").toBeLessThan(2);
    expect(facts.titleToLede, "Copy title hugs lede").toBeLessThan(facts.ledeToAsk);
    expect(facts.ledeToAsk, "Copy ask gets more air").toBeGreaterThan(20);
  });
});
