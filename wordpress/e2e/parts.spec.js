import { expect, test } from "@playwright/test";

test.describe("CDS kit parts", () => {
  test("unlisted specimen renders the new pieces", async ({ page }) => {
    const response = await page.goto("/kit-parts/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET /kit-parts/ → ${response.status()}`).toBeTruthy();

    const tile = page.locator(".cds-icon-tile").first();
    await expect(tile).toBeVisible();
    const tileBox = await tile.boundingBox();
    expect(tileBox.width).toBeGreaterThan(28);
    expect(tileBox.width).toBeLessThan(48);

    const cover = page.locator(".cds-cover").first();
    const coverBox = await cover.boundingBox();
    const coverImg = await cover.locator("img").first().boundingBox();
    expect(Math.abs(coverImg.width - coverBox.width)).toBeLessThan(4);
    expect(Math.abs(coverImg.height - coverBox.height)).toBeLessThan(4);

    const chip = cover.locator(".cds-chip");
    await expect(chip).toBeVisible();
    const chipBox = await chip.boundingBox();
    expect(chipBox.y).toBeGreaterThan(coverBox.y);
    expect(chipBox.y + chipBox.height).toBeLessThan(coverBox.y + coverBox.height + 2);

    const video = page.locator(".cds-video");
    const videoBox = await video.boundingBox();
    const play = video.locator(".cds-play");
    const playBox = await play.boundingBox();
    const playCenter = playBox.x + playBox.width / 2;
    const videoCenter = videoBox.x + videoBox.width / 2;
    expect(Math.abs(playCenter - videoCenter)).toBeLessThan(12);

    const media = page.locator(".cds-media").first();
    const mediaBox = await media.boundingBox();
    const badge = media.locator(".cds-badge");
    const badgeBox = await badge.boundingBox();
    expect(badgeBox.height).toBeLessThan(36);
    expect(badgeBox.y).toBeGreaterThan(mediaBox.y + 4);
    expect(badgeBox.y).toBeLessThan(mediaBox.y + 28);
    expect(badgeBox.x).toBeGreaterThan(mediaBox.x + 4);
    expect(badgeBox.x).toBeLessThan(mediaBox.x + 28);

    const logo = page.locator(".cds-logo-row img").first();
    const logoBox = await logo.boundingBox();
    expect(logoBox.height).toBeGreaterThan(24);
    expect(logoBox.height).toBeLessThan(48);

    await expect(page.locator(".cds-product")).toHaveCount(4);
    await expect(page.locator(".cds-category")).toHaveCount(3);
    await expect(page.locator("form.cds-form input")).toHaveCount(3);
    await expect(page.locator("form.cds-form textarea")).toHaveCount(1);
    await expect(page.locator("form.cds-form--inline")).toHaveCount(1);
    await expect(page.locator(".cds-avatars .cds-avatar")).toHaveCount(3);
    await expect(page.locator(".cds-icon-link")).toHaveCount(3);
    await expect(page.locator(".cds-reel .cds-review")).toHaveCount(3);
    await expect(page.locator(".cds-footer-cta")).toHaveCount(1);
    await expect(page.locator(".cds-tabs")).toHaveCount(1);
    await expect(page.locator(".cds-gallery__float .cds-icon--arrow")).toHaveCount(2);
    await expect(page.locator(".cds-post")).toHaveCount(2);
    await expect(page.locator(".cds-facts")).toHaveCount(2);
    await expect(page.locator(".cds-stat")).toHaveCount(4);
    await expect(page.locator(".cds-episode__play .cds-icon--play")).toHaveCount(2);
    await expect(page.locator(".cds-step")).toHaveCount(5);
    await expect(page.locator(".cds-person")).toHaveCount(3);
    await expect(page.locator(".cds-shots")).toHaveCount(1);
    await expect(page.locator(".cds-bento .cds-card")).toHaveCount(5);
    await expect(page.locator("form.cds-search")).toHaveCount(1);

    const statWidths = await page.locator(".cds-stat").evaluateAll((nodes) =>
      nodes.map((node) => node.getBoundingClientRect().width),
    );
    expect(Math.max(...statWidths) - Math.min(...statWidths)).toBeLessThan(4);

    const overflows = await page.locator(".cds-reel").evaluate((el) => el.scrollWidth > el.clientWidth + 8);
    expect(overflows).toBeTruthy();

    await play.click();
    await expect(page.locator("#cds-video-dialog")).toHaveAttribute("open", "");
  });
});
