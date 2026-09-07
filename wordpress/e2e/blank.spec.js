import { expect, test } from "@playwright/test";

test.describe("CDS blank page", () => {
  test("heading, paragraph, and default button look like the kit", async ({
    page,
  }) => {
    const response = await page.goto("/cds-blank/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET /cds-blank/ → ${response.status()}`).toBeTruthy();

    const styles = await page.evaluate(() => {
      const pick = (el) => {
        if (!el) return null;
        const s = getComputedStyle(el);
        return {
          fontFamily: s.fontFamily,
          fontSize: s.fontSize,
          color: s.color,
          backgroundColor: s.backgroundColor,
          borderRadius: s.borderRadius,
          padding: s.padding,
        };
      };
      return {
        h2: pick(document.querySelector(".wp-block-post-content h2")),
        p: pick(document.querySelector(".wp-block-post-content p")),
        btn: pick(document.querySelector(".wp-block-button__link")),
      };
    });

    expect(styles.h2, "heading block").toBeTruthy();
    expect(styles.h2.fontFamily.toLowerCase()).toMatch(/pt serif|serif/);
    expect(styles.p, "paragraph block").toBeTruthy();
    expect(styles.p.fontFamily.toLowerCase()).toMatch(/lato|sans-serif/);
    expect(styles.btn, "default button").toBeTruthy();
    expect(parseFloat(styles.btn.borderRadius), "pill radius").toBeGreaterThanOrEqual(999);
    expect(styles.btn.backgroundColor).toBe("rgb(14, 116, 144)");
    expect(styles.btn.color).toBe("rgb(255, 255, 255)");
  });

  test("a long paragraph is capped at the measure, not the landing shell", async ({
    page,
  }) => {
    const response = await page.goto("/cds-blank/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok()).toBeTruthy();

    const measure = await page.evaluate(() => {
      const p = document.querySelector(".wp-block-post-content p");
      const heading = document.querySelector(
        ".wp-block-post-title, .wp-block-post-content h2, .wp-block-post-content h1",
      );
      if (!p) return null;
      const styles = getComputedStyle(p);
      const pBox = p.getBoundingClientRect();
      const hBox = heading ? heading.getBoundingClientRect() : null;
      return {
        width: pBox.width,
        maxInline: styles.maxInlineSize,
        pLeft: pBox.left,
        headingLeft: hBox ? hBox.left : null,
      };
    });

    expect(measure, "paragraph block").toBeTruthy();
    expect(measure.width, "paragraph narrower than a 60rem shell").toBeLessThan(900);
    expect(measure.width, "paragraph still has a reading measure").toBeGreaterThan(400);
    expect(measure.headingLeft, "page title").not.toBeNull();
    expect(
      Math.abs(measure.pLeft - measure.headingLeft),
      "measure starts on the title's left edge",
    ).toBeLessThan(2);
  });

  test("Start opening copy shares the title's left edge", async ({ page }) => {
    const response = await page.goto("/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok()).toBeTruthy();

    const edges = await page.evaluate(() => {
      const title = document.querySelector(".wp-block-post-title");
      const p = document.querySelector(".wp-block-post-content p:not(.is-style-cds-pill)");
      if (!title || !p) return null;
      return {
        title: title.getBoundingClientRect().left,
        p: p.getBoundingClientRect().left,
        pWidth: p.getBoundingClientRect().width,
      };
    });

    expect(edges, "Start title and intro").toBeTruthy();
    expect(Math.abs(edges.p - edges.title), "intro not centred in the shell").toBeLessThan(2);
    expect(edges.pWidth, "intro still on the measure").toBeLessThan(900);
  });
});
