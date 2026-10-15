import AxeBuilder from "@axe-core/playwright";
import { expect, test } from "@playwright/test";

const TAGS = ["wcag2a", "wcag2aa", "wcag21aa"];
const ROUTES = ["/", "/number-check/", "/articles/", "/download/"];

function axe(page) {
  return new AxeBuilder({ page }).withTags(TAGS).analyze();
}

for (const route of ROUTES) {
  test(`${route} has no WCAG A or AA violations`, async ({ page }) => {
    const response = await page.goto(route);
    expect(response, "Studio must be running").toBeTruthy();
    expect(response.ok(), `GET ${route} → ${response.status()}`).toBeTruthy();
    const results = await axe(page);
    expect(results.violations).toEqual([]);
  });
}
