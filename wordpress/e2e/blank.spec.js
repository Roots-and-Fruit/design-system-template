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
    expect(styles.btn.backgroundColor).toBe("rgb(8, 145, 178)");
    expect(styles.btn.color).toBe("rgb(255, 255, 255)");
  });
});
