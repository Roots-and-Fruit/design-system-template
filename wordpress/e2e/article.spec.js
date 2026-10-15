import { expect, test } from "@playwright/test";
import { countThirdPartyBlocks } from "./helpers.js";

const SAMPLE = "/sample-essay/";
const EXCERPT =
  "The template owns the title. The rail holds takeaways. Body stays on the measure.";

test.describe("CDS article frame", () => {
  test.use({ viewport: { width: 1280, height: 900 } });

  test("template owns the hero; rail sits to the right and sticks", async ({
    page,
  }) => {
    const response = await page.goto(SAMPLE);
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET ${SAMPLE} → ${response.status()}`).toBeTruthy();
    expect(await page.evaluate(countThirdPartyBlocks), "Core-only").toBe(0);

    const h1 = page.locator("h1");
    await expect(h1).toHaveCount(1);
    await expect(h1).toHaveClass(/wp-block-post-title/);
    await expect(page.locator(".wp-block-post-content h1")).toHaveCount(0);

    const excerpt = page.locator(".wp-block-post-excerpt");
    await expect(excerpt).toContainText(EXCERPT);
    const firstBody = page.locator(".wp-block-post-content > p").first();
    await expect(firstBody).toBeVisible();
    await expect(firstBody).not.toContainText(EXCERPT);

    await expect(page.locator(".wp-block-post-author-name")).toBeVisible();
    await expect(page.locator(".wp-block-post-date")).toBeVisible();

    const avatar = page.locator(".cds-article-hero .wp-block-avatar img");
    await expect(avatar).toBeVisible();
    await expect
      .poll(async () =>
        avatar.evaluate((el) => {
          const src = el.currentSrc || el.src || "";
          return el.complete && el.naturalWidth > 0 ? src : "";
        }),
      )
      .toMatch(/mark\.svg|uploads/);
    await expect(avatar).toHaveAttribute("src", /mark\.svg|uploads/);
    expect(await avatar.evaluate((el) => el.outerHTML)).not.toMatch(/gravatar/i);

    const aside = page.locator("aside");
    await expect(aside).toBeVisible();
    await expect(
      aside.getByRole("heading", { name: "Key takeaways" }),
    ).toBeVisible();
    await expect(aside.locator("li")).toHaveCount(3);
    await expect(aside.locator(".is-style-cds-panel")).toBeVisible();

    const geometry = await page.evaluate(() => {
      const title = document.querySelector("h1.wp-block-post-title");
      const excerpt = document.querySelector(".wp-block-post-excerpt");
      const hero = document.querySelector(".cds-article-hero");
      const header = document.querySelector("header");
      const frame = document.querySelector(".cds-article-frame");
        const p = document.querySelector(".wp-block-post-content > p");
        const h2 = document.querySelector(".wp-block-post-content > h2");
        const railPanel = document.querySelector("aside .is-style-cds-panel");
        const railTitle = document.querySelector("aside h2");
        const content = document.querySelector(".cds-article-frame > :first-child");
      const rail = document.querySelector("aside");
      const cta = document.querySelector(
        ".wp-block-post-content > .is-style-cds-panel:last-child",
      );
      const main = document.querySelector("main");
      const footer = document.querySelector("footer");
      const mainStyles = main ? getComputedStyle(main) : null;
      return {
        thumbs: document.querySelectorAll("main img.wp-post-image").length,
        pWidth: p ? p.getBoundingClientRect().width : 0,
        pLeft: p ? p.getBoundingClientRect().left : 0,
        h2Left: h2 ? h2.getBoundingClientRect().left : 0,
        railTitleInset:
          railTitle && railPanel
            ? railTitle.getBoundingClientRect().top - railPanel.getBoundingClientRect().top
            : 0,
        railPadTop: railPanel ? parseFloat(getComputedStyle(railPanel).paddingTop) : 0,
        titleLeft: title ? title.getBoundingClientRect().left : 0,
        titleBottom: title ? title.getBoundingClientRect().bottom : 0,
        excerptBottom: excerpt ? excerpt.getBoundingClientRect().bottom : 0,
        heroTop: hero ? hero.getBoundingClientRect().top : 0,
        heroBottom: hero ? hero.getBoundingClientRect().bottom : 0,
        heroLeft: hero ? hero.getBoundingClientRect().left : 0,
        heroWidth: hero ? hero.getBoundingClientRect().width : 0,
        heroPadTop: hero ? parseFloat(getComputedStyle(hero).paddingTop) : 0,
        heroPadBottom: hero ? parseFloat(getComputedStyle(hero).paddingBottom) : 0,
        heroBorderBottom: hero ? parseFloat(getComputedStyle(hero).borderBottomWidth) : 0,
        heroBg: hero ? getComputedStyle(hero).backgroundImage : "",
        heroBgColor: hero ? getComputedStyle(hero).backgroundColor : "",
        headerBottom: header ? header.getBoundingClientRect().bottom : 0,
        headerLeft: header ? header.getBoundingClientRect().left : 0,
        headerWidth: header ? header.getBoundingClientRect().width : 0,
        frameTop: frame ? frame.getBoundingClientRect().top : 0,
        contentRight: content ? content.getBoundingClientRect().right : 0,
        railLeft: rail ? rail.getBoundingClientRect().left : 0,
        railPos: rail ? getComputedStyle(rail).position : "",
        railTop: rail ? rail.getBoundingClientRect().top : 0,
        hasCta: Boolean(cta),
        ctaWidth: cta ? cta.getBoundingClientRect().width : 0,
        contentWidth: content ? content.getBoundingClientRect().width : 0,
        mainMarginEnd: mainStyles ? parseFloat(mainStyles.marginBlockEnd) : 0,
        footerGap: footer && main ? footer.getBoundingClientRect().top - main.getBoundingClientRect().bottom : 0,
      };
    });

    expect(geometry.thumbs, "no featured image in the reading layout").toBe(0);
    expect(geometry.pWidth, "paragraph narrower than a 60rem shell").toBeLessThan(900);
    expect(geometry.pWidth, "paragraph still has a reading measure").toBeGreaterThan(400);
    expect(
      Math.abs(geometry.pLeft - geometry.titleLeft),
      "measure starts with the title",
    ).toBeLessThan(2);
    expect(
      Math.abs(geometry.h2Left - geometry.pLeft),
      "heading starts with the measure",
    ).toBeLessThan(2);
    expect(
      Math.abs(geometry.railTitleInset - geometry.railPadTop),
      "rail title sits on the panel padding",
    ).toBeLessThan(2);
    expect(geometry.heroBg, "default hero is not a photo").not.toMatch(/hero\.jpg|wp-content\/uploads/);
    expect(geometry.heroBgColor, "default hero is paper-deep").toMatch(/226,\s*232,\s*240/);
    expect(
      Math.abs(geometry.heroTop - geometry.headerBottom),
      "hero flush under the header",
    ).toBeLessThanOrEqual(2);
    expect(geometry.heroLeft, "hero matches the header band").toBeLessThanOrEqual(
      geometry.headerLeft + 2,
    );
    expect(
      Math.abs(geometry.heroWidth - geometry.headerWidth),
      "hero is as wide as the header",
    ).toBeLessThanOrEqual(2);
    expect(geometry.heroPadTop, "hero padding-top (space-7)").toBeGreaterThanOrEqual(48);
    expect(geometry.heroPadBottom, "hero padding-bottom (space-7)").toBeGreaterThanOrEqual(48);
    expect(geometry.heroBorderBottom, "hero bottom border").toBeGreaterThanOrEqual(1);
    expect(geometry.heroBottom, "title and excerpt sit above the frame").toBeLessThanOrEqual(
      geometry.frameTop + 2,
    );
    expect(geometry.titleBottom, "title is above the rail").toBeLessThanOrEqual(
      geometry.railTop + 2,
    );
    expect(geometry.excerptBottom, "excerpt is above the rail").toBeLessThanOrEqual(
      geometry.railTop + 2,
    );
    expect(geometry.railLeft, "rail to the right of content").toBeGreaterThanOrEqual(
      geometry.contentRight - 2,
    );
    expect(geometry.railPos, "aside is sticky").toBe("sticky");
    expect(geometry.hasCta, "last content block is the CTA panel").toBe(true);
    expect(
      Math.abs(geometry.ctaWidth - geometry.contentWidth),
      "CTA fills the column",
    ).toBeLessThan(2);
    await expect(
      page.locator(".wp-block-post-content > .is-style-cds-panel p"),
    ).toHaveText("Continue opens the next page in the walk.");
    expect(geometry.mainMarginEnd, "section gap on main").toBeGreaterThan(8);
    expect(geometry.footerGap, "CTA does not flush to the footer").toBeGreaterThan(8);

    await page.evaluate(() => window.scrollBy(0, 600));
    const after = await page.evaluate(() => {
      const rail = document.querySelector("aside");
      const box = rail.getBoundingClientRect();
      const styles = getComputedStyle(rail);
      return {
        pos: styles.position,
        top: box.top,
        stickyTop: parseFloat(styles.top),
        bottom: box.bottom,
      };
    });
    expect(after.pos).toBe("sticky");
    expect(
      Math.abs(after.top - after.stickyTop),
      "rail sits on its sticky inset",
    ).toBeLessThan(4);
  });

  test("rail stacks under content on a narrow viewport", async ({ page }) => {
    await page.setViewportSize({ width: 600, height: 900 });
    const response = await page.goto(SAMPLE);
    expect(response.ok(), `GET ${SAMPLE} → ${response.status()}`).toBeTruthy();
    expect(await page.evaluate(countThirdPartyBlocks)).toBe(0);

    const stacked = await page.evaluate(() => {
      const content = document.querySelector(".cds-article-frame > :first-child");
      const rail = document.querySelector("aside");
      return {
        contentBottom: content.getBoundingClientRect().bottom,
        railTop: rail.getBoundingClientRect().top,
      };
    });
    expect(stacked.railTop, "content first, rail below").toBeGreaterThanOrEqual(
      stacked.contentBottom - 2,
    );
  });
});
