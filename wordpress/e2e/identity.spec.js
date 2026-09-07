import { expect, test } from "@playwright/test";

test.describe("CDS identity chrome", () => {
  test("header and footer use Site Identity with a sized mark", async ({
    page,
  }) => {
    const response = await page.goto("/cds-blank/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET /cds-blank/ → ${response.status()}`).toBeTruthy();

    const measure = (rootSelector) => {
      const root = document.querySelector(rootSelector);
      const cluster = root?.querySelector(".cds-identity");
      if (!cluster) return null;
      const logo = cluster.querySelector(".wp-block-site-logo");
      const img = cluster.querySelector(".wp-block-site-logo img");
      const type = cluster.querySelector(".cds-identity > .wp-block-group");
      const title = cluster.querySelector(".wp-block-site-title");
      const tag = cluster.querySelector(".wp-block-site-tagline");
      const box = (el) => (el ? el.getBoundingClientRect() : null);
      const logoR = box(logo);
      const typeR = box(type);
      return {
        title: title?.innerText.trim() || "",
        tagline: tag?.innerText.trim() || "",
        hasImg: Boolean(img),
        imgSrc: img?.getAttribute("src") || "",
        gap: getComputedStyle(cluster).columnGap,
        logoH: logoR ? logoR.height : 0,
        logoW: logoR ? logoR.width : 0,
        typeH: typeR ? typeR.height : 0,
      };
    };

    const header = await page.evaluate(measure, "header");
    const footer = await page.evaluate(measure, "footer");

    expect(header, "header .cds-identity").toBeTruthy();
    expect(footer, "footer .cds-identity").toBeTruthy();

    expect(header.title, "header site title").not.toBe("");
    expect(header.title).not.toMatch(/RF Static Probe/i);
    expect(header.tagline, "header tagline").not.toBe("");
    expect(header.hasImg, "header logo img").toBeTruthy();

    expect(footer.title, "footer site title").toBe(header.title);
    expect(footer.hasImg, "footer logo img").toBeTruthy();

    const gapPx = parseFloat(header.gap);
    expect(gapPx, "identity column-gap (0.5rem)").toBeGreaterThanOrEqual(6);
    expect(gapPx, "identity column-gap (0.5rem)").toBeLessThanOrEqual(10);

    expect(
      Math.abs(header.logoH - header.typeH),
      "header mark vs type height",
    ).toBeLessThanOrEqual(1.5);
    expect(
      Math.abs(header.logoW - header.logoH),
      "header mark is square",
    ).toBeLessThanOrEqual(1.5);

    expect(
      Math.abs(footer.logoH - footer.typeH),
      "footer mark vs type height",
    ).toBeLessThanOrEqual(1.5);
  });

  test.describe("footer grid", () => {
    test.use({ viewport: { width: 1280, height: 900 } });

    test("has three labeled columns, legal pages, and social under the brand", async ({
      page,
    }) => {
    const response = await page.goto("/cds-blank/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET /cds-blank/ → ${response.status()}`).toBeTruthy();

    const layout = await page.evaluate(() => {
      const footer = document.querySelector("footer");
      const brand = footer?.querySelector(".cds-footer-brand");
      const identity = brand?.querySelector(".cds-identity");
      const social = brand?.querySelector(".wp-block-social-links");
      const icon = social?.querySelector(".wp-social-link svg");
      const cols = [...(footer?.querySelectorAll(".cds-footer-col") || [])];
      const box = (el) => (el ? el.getBoundingClientRect() : null);
      const identityR = box(identity);
      const socialR = box(social);
      const iconR = box(icon);
      const labels = cols.map(
        (col) => col.querySelector(".cds-meta")?.innerText.trim() || "",
      );
      return {
        colCount: cols.length,
        labels,
        hasPrivacy: Boolean(footer?.querySelector('a[href*="/privacy/"]')),
        hasTerms: Boolean(footer?.querySelector('a[href*="/terms/"]')),
        socialCount: social
          ? social.querySelectorAll(".wp-social-link").length
          : 0,
        socialBelowBrand:
          identityR && socialR ? socialR.top >= identityR.bottom - 2 : false,
        iconSize: iconR ? Math.max(iconR.width, iconR.height) : 0,
        colTops: cols.map((col) => box(col)?.top ?? 0),
      };
    });

    expect(layout.colCount, "three footer link columns").toBe(3);
    expect(layout.labels).toEqual(["PRODUCT", "EXPLORE", "LEGAL"]);
    expect(layout.hasPrivacy, "privacy policy link").toBe(true);
    expect(layout.hasTerms, "terms link").toBe(true);
    expect(layout.socialCount, "social links under the brand").toBeGreaterThanOrEqual(
      3,
    );
    expect(layout.socialBelowBrand, "social sits below identity").toBe(true);
    expect(layout.iconSize, "social icons at 32px (2× small)").toBeGreaterThanOrEqual(30);
    expect(layout.iconSize, "social icons at 32px (2× small)").toBeLessThanOrEqual(34);

    const socialIcon = page.locator("footer .wp-social-link a").first();
    await socialIcon.hover();
    await expect(socialIcon).toHaveCSS("color", "rgb(100, 116, 139)");

    const [firstTop, ...restTops] = layout.colTops;
    for (const top of restTops) {
      expect(Math.abs(top - firstTop), "link columns share a row").toBeLessThanOrEqual(
        2,
      );
    }

      const privacy = await page.goto("/privacy/");
      expect(privacy?.ok(), "GET /privacy/").toBeTruthy();
      const terms = await page.goto("/terms/");
      expect(terms?.ok(), "GET /terms/").toBeTruthy();
    });
  });
});
