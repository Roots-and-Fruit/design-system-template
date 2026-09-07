import { expect, test } from "@playwright/test";
import { countThirdPartyBlocks } from "./helpers.js";

test.describe("CDS articles index", () => {
  test.use({ viewport: { width: 1280, height: 900 } });

  test("posts page is a one-column list that opens the sample essay", async ({
    page,
  }) => {
    const response = await page.goto("/articles/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET /articles/ → ${response.status()}`).toBeTruthy();
    expect(await page.evaluate(countThirdPartyBlocks), "Core-only").toBe(0);

    const h1 = page.locator("h1");
    await expect(h1).toHaveCount(1);
    await expect(h1).toHaveText(/Articles/i);

    const items = page.locator(".wp-block-post");
    await expect(items.first()).toBeVisible();

    const list = await page.evaluate(() => {
      const rows = [...document.querySelectorAll(".wp-block-post")];
      const firstLeft = rows[0] ? rows[0].getBoundingClientRect().left : 0;
      const last = rows[rows.length - 1];
      const main = document.querySelector("main");
      const footer = document.querySelector("footer");
      return {
        count: rows.length,
        lefts: rows.map((el) => el.getBoundingClientRect().left),
        firstLeft,
        thumbs: document.querySelectorAll(".wp-block-post img.wp-post-image").length,
        lastAlignFull: last ? last.classList.contains("alignfull") : false,
        footerGap:
          footer && main
            ? footer.getBoundingClientRect().top - main.getBoundingClientRect().bottom
            : 0,
      };
    });

    expect(list.count, "at least the sample post").toBeGreaterThanOrEqual(1);
    for (const left of list.lefts) {
      expect(Math.abs(left - list.firstLeft), "one column").toBeLessThanOrEqual(2);
    }
    expect(list.thumbs, "no thumbnails in the list").toBe(0);
    expect(list.lastAlignFull, "list is not a wash").toBe(false);
    expect(list.footerGap, "section gap to footer").toBeGreaterThan(8);

    const sample = page.locator(".wp-block-post").filter({
      has: page.getByRole("link", { name: "A measured essay" }),
    });
    await expect(sample.locator(".wp-block-post-terms, .wp-block-post-terms a, a[rel='tag']").first()).toBeVisible();
    await expect(sample.locator(".wp-block-post-date")).toBeVisible();
    await expect(sample.locator(".wp-block-post-excerpt")).toBeVisible();
    await expect(sample.getByRole("link", { name: /read more/i })).toBeVisible();

    await sample.getByRole("link", { name: "A measured essay" }).click();
    await expect(page).toHaveURL(/sample-essay/);
    await expect(page.locator("h1")).toHaveText("A measured essay");
    await expect(page.locator("aside")).toBeVisible();
  });
});
