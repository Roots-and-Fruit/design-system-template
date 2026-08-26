import { defineConfig } from "@playwright/test";

export default defineConfig({
  testDir: "./wordpress/e2e",
  fullyParallel: true,
  retries: 0,
  reporter: "list",
  use: {
    baseURL: process.env.CDS_WP_BASE_URL || "http://localhost:8893",
    screenshot: "only-on-failure",
  },
});
