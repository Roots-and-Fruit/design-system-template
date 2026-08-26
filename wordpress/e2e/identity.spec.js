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
});
