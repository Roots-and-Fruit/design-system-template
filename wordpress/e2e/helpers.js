/** Shared Playwright checks for the CDS probe. */

export function countThirdPartyBlocks() {
  return document.querySelectorAll(
    '[class*="wp-block-kadence"], [class*="kb-row"], [class*="kb-"], [class*="generateblocks"], [class*="uagb"], [class*="wp-block-stackable"]',
  ).length;
}
