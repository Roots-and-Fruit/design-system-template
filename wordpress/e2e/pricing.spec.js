import { expect, test } from "@playwright/test";
import { countThirdPartyBlocks } from "./helpers.js";

test.describe("CDS pricing canvas", () => {
  test.use({ viewport: { width: 1280, height: 900 } });

  test("three plans, Best Offer in the middle, proof and FAQ", async ({
    page,
  }) => {
    const response = await page.goto("/pricing/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET /pricing/ → ${response.status()}`).toBeTruthy();
    expect(await page.evaluate(countThirdPartyBlocks), "Core-only").toBe(0);

    const h1 = page.locator("h1");
    await expect(h1).toHaveCount(1);
    await expect(h1).toHaveClass(/has-display-xl-font-size/);
    await expect(page.locator(".wp-block-post-title")).toHaveCount(0);
    await expect(page.locator(".wp-block-columns")).toHaveCount(0);

    const plans = page.locator(".cds-pricing > .wp-block-group");
    await expect(plans).toHaveCount(3);
    await expect(plans.nth(1)).toHaveClass(/is-style-cds-dark/);
    await expect(plans.nth(1).locator(".is-style-cds-pill")).toHaveText(/Best Offer/i);
    await expect(plans.nth(0).locator("li")).toHaveCount(3);
    await expect(plans.nth(1).locator("li")).toHaveCount(5);
    await expect(plans.nth(2).locator("li")).toHaveCount(6);

    const primary = page.locator(
      ".cds-pricing .wp-block-button:not([class*='is-style-cds'])",
    );
    await expect(primary).toHaveCount(1);
    await expect(plans.nth(1).locator(".wp-block-button:not([class*='is-style-cds'])")).toHaveCount(1);

    const tracks = await plans.evaluateAll((els) => {
      if (els.length < 3) return { count: els.length, threeUp: false };
      const boxes = els.map((el) => el.getBoundingClientRect());
      const sameRow =
        Math.abs(boxes[0].top - boxes[1].top) < 40 &&
        Math.abs(boxes[1].top - boxes[2].top) < 40;
      const ordered =
        boxes[0].right <= boxes[1].left + 2 && boxes[1].right <= boxes[2].left + 2;
      return { count: els.length, threeUp: sameRow && ordered };
    });
    expect(tracks.count).toBe(3);
    expect(tracks.threeUp, "plans are three columns at 1280").toBe(true);

    const align = await plans.evaluateAll((els) => {
      const titles = els.map((el) => el.querySelector("h2")?.getBoundingClientRect());
      const buttons = els.map((el) =>
        el.querySelector(".wp-block-buttons")?.getBoundingClientRect(),
      );
      const tops = titles.map((t) => t?.top ?? 0);
      const bottoms = buttons.map((b) => b?.bottom ?? 0);
      return {
        titleDelta: Math.max(...tops) - Math.min(...tops),
        buttonDelta: Math.max(...bottoms) - Math.min(...bottoms),
      };
    });
    expect(align.titleDelta, "plan titles share one baseline").toBeLessThan(2);
    expect(align.buttonDelta, "plan buttons share one baseline").toBeLessThan(2);

    for (let i = 0; i < 3; i += 1) {
      const card = plans.nth(i);
      const rest = await card.evaluate((el) => getComputedStyle(el).backgroundColor);
      await card.hover();
      const hover = await card.evaluate((el) => getComputedStyle(el).backgroundColor);
      expect(hover, `plan ${i + 1} hover shifts the fill`).not.toBe(rest);
    }

    const teamBtn = page.locator(
      ".cds-pricing .wp-block-button:not([class*='is-style-cds']) .wp-block-button__link",
    );
    const teamRest = await teamBtn.evaluate((el) => getComputedStyle(el).backgroundColor);
    await teamBtn.hover();
    const teamHover = await teamBtn.evaluate((el) => getComputedStyle(el).backgroundColor);
    expect(teamHover, "Choose Team hover shifts the fill").not.toBe(teamRest);

    await expect(page.getByText(/14-day guarantee\. Cancel/i)).toBeVisible();
    await expect(page.locator(".cds-grid--five")).toHaveCount(1);
    await expect(page.getByRole("heading", { name: /what you are actually buying/i })).toBeVisible();
    await expect(page.locator(".wp-block-details")).toHaveCount(6);

    const faqWidth = await page.evaluate(() => {
      const details = document.querySelector(".wp-block-details");
      if (!details) return null;
      details.open = false;
      const closed = details.getBoundingClientRect().width;
      details.open = true;
      const open = details.getBoundingClientRect().width;
      details.open = false;
      return { closed, open };
    });
    expect(faqWidth).toBeTruthy();
    expect(faqWidth.closed, "FAQ fills the column, not the summary").toBeGreaterThan(640);
    expect(
      Math.abs(faqWidth.open - faqWidth.closed),
      "FAQ stays the column width when opened",
    ).toBeLessThan(1);

    const faqGap = await page.evaluate(() => {
      const items = [...document.querySelectorAll(".wp-block-details")];
      if (items.length < 2) return null;
      const a = items[0].getBoundingClientRect();
      const b = items[1].getBoundingClientRect();
      return b.top - a.bottom;
    });
    expect(faqGap, "FAQ details have a gap").toBeGreaterThanOrEqual(22);
    expect(faqGap, "FAQ details use stack gap, not section").toBeLessThan(32);
  });
});
