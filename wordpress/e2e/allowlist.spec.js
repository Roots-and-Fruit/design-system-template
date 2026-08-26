import { expect, test } from "@playwright/test";

test.describe("CDS allowlist", () => {
  test("details and table use kit frames, not Core defaults", async ({
    page,
  }) => {
    const response = await page.goto("/cds-allowlist/");
    expect(response, "Studio probe must be running").toBeTruthy();
    expect(response.ok(), `GET /cds-allowlist/ → ${response.status()}`).toBeTruthy();

    const paint = await page.evaluate(() => {
      const details = document.querySelector(".wp-block-details");
      const summary = details?.querySelector("summary");
      const table = document.querySelector(".wp-block-table");
      const th = table?.querySelector("th");
      const td = table?.querySelector("td");
      const box = (el) => (el ? getComputedStyle(el) : null);
      const ds = box(details);
      const ss = box(summary);
      const ts = box(table);
      const ths = box(th);
      const tds = box(td);
      return {
        detailsBg: ds?.backgroundColor,
        detailsRadius: ds?.borderRadius,
        detailsBorder: ds?.borderTopWidth,
        summaryWeight: ss?.fontWeight,
        summaryMarker: ss ? getComputedStyle(summary, "::marker").content : "",
        tableBg: ts?.backgroundColor,
        tableRadius: ts?.borderRadius,
        thBg: ths?.backgroundColor,
        tdBorderLeft: tds?.borderLeftWidth,
        tdColor: tds?.color,
      };
    });

    expect(paint.detailsBg).toBe("rgb(255, 255, 255)");
    expect(parseFloat(paint.detailsRadius)).toBeGreaterThanOrEqual(8);
    expect(parseFloat(paint.detailsBorder)).toBeGreaterThanOrEqual(1);
    expect(Number(paint.summaryWeight)).toBeGreaterThanOrEqual(600);
    expect(paint.tableBg).toBe("rgb(255, 255, 255)");
    expect(parseFloat(paint.tableRadius)).toBeGreaterThanOrEqual(8);
    expect(paint.thBg).toBe("rgb(248, 250, 252)");
    expect(paint.tdBorderLeft).toBe("0px");
    expect(paint.tdColor).toBe("rgb(100, 116, 139)");
  });
});
