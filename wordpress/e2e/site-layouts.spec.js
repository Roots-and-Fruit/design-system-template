import { expect, test } from "@playwright/test";

test.describe("CDS site layouts", () => {
  test.use({ viewport: { width: 1280, height: 900 } });

  test("studio stacks alternating rows, a FAQ, and a form", async ({ page }) => {
    const response = await page.goto("/studio/");
    expect(response.ok(), `GET /studio/ → ${response.status()}`).toBeTruthy();
    await expect(page.locator("h1")).toHaveCount(1);
    await expect(page.locator(".wp-block-post-title")).toHaveCount(0);
    await expect(page.locator(".is-style-cds-switcher")).toHaveCount(4);
    await expect(page.locator(".wp-block-columns")).toHaveCount(1);
    await expect(page.locator("form.cds-form")).toHaveCount(1);
    await expect(page.locator(".cds-logo-row img")).toHaveCount(5);

    const title = page.locator("h1");
    const bandTitle = page.locator(".has-paper-deep-background-color h2").first();
    const edges = await Promise.all([title.boundingBox(), bandTitle.boundingBox()]);
    expect(Math.abs(edges[0].x - edges[1].x)).toBeLessThan(8);

    const offer = page.locator(".is-style-cds-switcher").filter({ hasText: "A named offer" });
    await expect(offer.locator(".is-style-cds-pill")).toHaveCount(1);
    await expect(offer.locator(".cds-icon--check")).toHaveCount(2);

    const metric = page.locator(".is-style-cds-switcher").filter({
      has: page.getByRole("heading", { level: 2, name: "A number you can check" }),
    });
    await expect(metric.locator(".cds-display--lg")).toHaveText("12");
    await expect(metric.locator(".cds-meta")).toHaveText("Weeks, on the page");
    await expect(metric.locator(".cds-icon--chart")).toHaveCount(1);
  });

  test("shop is a cover, categories, and products", async ({ page }) => {
    const response = await page.goto("/shop/");
    expect(response.ok(), `GET /shop/ → ${response.status()}`).toBeTruthy();
    await expect(page.locator("h1")).toHaveCount(1);
    await expect(page.locator(".cds-cover").first()).toBeVisible();
    await expect(page.locator(".cds-chip")).toHaveCount(1);
    await expect(page.locator(".cds-category")).toHaveCount(3);
    await expect(page.locator(".cds-product")).toHaveCount(4);
    await expect(page.locator(".cds-badge")).toHaveCount(2);
  });

  test("stories is a cover, a video, and a reel", async ({ page }) => {
    const response = await page.goto("/stories/");
    expect(response.ok(), `GET /stories/ → ${response.status()}`).toBeTruthy();
    await expect(page.locator("h1")).toHaveCount(1);
    await expect(page.locator(".cds-card")).toHaveCount(3);
    await expect(page.locator(".cds-play")).toHaveCount(1);
    await expect(page.locator(".cds-reel .cds-review")).toHaveCount(3);

    const overflows = await page.locator(".cds-reel").evaluate((el) => el.scrollWidth > el.clientWidth + 8);
    expect(overflows).toBeTruthy();

    await page.locator(".cds-play").click();
    await expect(page.locator("#cds-stories-dialog")).toHaveAttribute("open", "");
  });

  test("case study is a gallery, facts, steps, and a result", async ({ page }) => {
    const response = await page.goto("/case-study/");
    expect(response.ok(), `GET /case-study/ → ${response.status()}`).toBeTruthy();
    await expect(page.locator("h1")).toHaveCount(1);
    await expect(page.locator(".cds-facts")).toHaveCount(1);
    await expect(page.locator(".cds-gallery__float .cds-icon--arrow")).toHaveCount(2);
    await expect(page.locator(".cds-step")).toHaveCount(3);
    await expect(page.locator(".cds-stat")).toHaveCount(4);
    await expect(page.locator(".cds-person")).toHaveCount(3);

    const widths = await page.locator(".cds-stat").evaluateAll((nodes) =>
      nodes.map((node) => node.getBoundingClientRect().width),
    );
    expect(Math.max(...widths) - Math.min(...widths)).toBeLessThan(4);
  });

  test("show stacks episodes and a subscribe form", async ({ page }) => {
    const response = await page.goto("/show/");
    expect(response.ok(), `GET /show/ → ${response.status()}`).toBeTruthy();
    await expect(page.locator("h1")).toHaveCount(1);
    await expect(page.locator(".cds-episode")).toHaveCount(3);
    await expect(page.locator(".cds-episode__play .cds-icon--play")).toHaveCount(3);
    await expect(page.locator("form.cds-form--inline")).toHaveCount(1);

    const thumb = page.locator(".cds-episode img").first();
    const box = await thumb.boundingBox();
    expect(Math.abs(box.width - box.height)).toBeLessThan(4);
  });

  test("download is the Peachy plugin page", async ({ page }) => {
    const response = await page.goto("/download/");
    expect(response.ok(), `GET /download/ → ${response.status()}`).toBeTruthy();
    await expect(page.locator("h1")).toHaveCount(1);
    await expect(page.locator("h1")).toHaveText("Peachy Plugin");
    await expect(page.locator(".cds-facts__title")).toHaveText("Plugin details");
    await expect(page.locator(".cds-facts dd")).toHaveCount(5);
    await expect(page.locator(".cds-bento .cds-card")).toHaveCount(5);
    await expect(page.locator(".cds-step")).toHaveCount(3);
    await expect(page.getByRole("heading", { level: 2, name: "Changelog" })).toHaveCount(1);
    await expect(page.locator(".cds-details")).toHaveCount(4);
  });
});
