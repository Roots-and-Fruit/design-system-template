import { expect, test } from "@playwright/test";

test.describe("CDS showcase nav", () => {
  test.use({ viewport: { width: 1280, height: 900 } });

  test("walk stays top-level; The site nests Offer, Pricing, Articles, and the essay", async ({
    page,
  }) => {
    const response = await page.goto("/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET / → ${response.status()}`).toBeTruthy();

    const headerNav = page.locator("header .wp-block-navigation");
    const topList = headerNav.locator(".wp-block-navigation__container").first();
    const top = topList.locator(":scope > .wp-block-navigation-item > a");
    await expect(top).toHaveText([
      "Start",
      "Color",
      "Type",
      "Layout",
      "Pieces",
      "Sections",
      "The site",
    ]);

    const siteItem = topList.locator(":scope > .wp-block-navigation-submenu");
    await expect(siteItem).toHaveCount(1);
    await expect(siteItem.locator(":scope > a")).toHaveAttribute(
      "href",
      /\/the-site\/?$/,
    );

    const offerLink = siteItem.locator('a[href*="/offer/"]');
    const pricingLink = siteItem.locator('a[href*="/pricing/"]');
    const articlesLink = siteItem.locator(
      ':scope > .wp-block-navigation__submenu-container > .wp-block-navigation-item > a[href*="/articles/"]',
    );
    const essayLink = siteItem.locator('a[href*="/sample-essay/"]');
    await expect(offerLink).toHaveCount(1);
    await expect(pricingLink).toHaveCount(1);
    await expect(articlesLink).toHaveCount(1);
    await expect(essayLink).toHaveCount(1);

    const articlesItem = siteItem.locator(
      ":scope > .wp-block-navigation__submenu-container > .wp-block-navigation-submenu",
    );
    await expect(articlesItem.locator(":scope > a")).toHaveAttribute(
      "href",
      /\/articles\/?$/,
    );
    await expect(articlesItem.locator('a[href*="/sample-essay/"]')).toHaveCount(1);

    await siteItem.hover();
    await offerLink.click();
    await expect(page).toHaveURL(/\/offer\/?$/);

    await page.goto("/");
    const siteAgain = page
      .locator("header .wp-block-navigation .wp-block-navigation__container")
      .first()
      .locator(":scope > .wp-block-navigation-submenu");
    const articlesAgain = siteAgain.locator(
      ":scope > .wp-block-navigation__submenu-container > .wp-block-navigation-submenu",
    );
    await siteAgain.hover();
    await articlesAgain.hover();
    await articlesAgain.locator('a[href*="/sample-essay/"]').click();
    await expect(page).toHaveURL(/\/sample-essay\/?$/);
  });
});
