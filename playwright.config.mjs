import { defineConfig } from "@playwright/test";

export default defineConfig({
  testDir: "./wordpress/e2e",
  fullyParallel: true,
  /* Studio serves one PHP process. Parallel workers drop the browser session and look like a bad theme. */
  workers: 1,
  retries: 0,
  reporter: "list",
  use: {
    baseURL: process.env.CDS_WP_BASE_URL || "http://localhost:8893",
    screenshot: "only-on-failure",
  },
});
