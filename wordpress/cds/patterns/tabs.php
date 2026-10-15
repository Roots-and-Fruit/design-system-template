<?php
/**
 * Title: Folder tabs
 * Slug: cds/tabs
 * Categories: cds
 * Inserter: true
 * Description: A piece inside a section. Not a page job.
 */
?>
<!-- wp:html -->
<div class="cds-tabs">
	<div class="cds-tabs__list" role="tablist" aria-label="Settings sections">
		<button type="button" class="cds-tabs__tab is-current" role="tab" data-cds-tab="agents" aria-selected="true">
			<span class="cds-tabs__dot" aria-hidden="true"></span>Agents
		</button>
		<button type="button" class="cds-tabs__tab" role="tab" data-cds-tab="settings" aria-selected="false" tabindex="-1">
			<span class="cds-tabs__dot" aria-hidden="true"></span>Settings
		</button>
		<button type="button" class="cds-tabs__tab" role="tab" data-cds-tab="activity" aria-selected="false" tabindex="-1">
			<span class="cds-tabs__dot" aria-hidden="true"></span>Activity
		</button>
	</div>
	<div class="cds-tabs__panel" role="tabpanel" data-cds-panel="agents"><p>The list of connected accounts.</p></div>
	<div class="cds-tabs__panel" role="tabpanel" data-cds-panel="settings" hidden><p>Limits for the whole workspace.</p></div>
	<div class="cds-tabs__panel" role="tabpanel" data-cds-panel="activity" hidden><p>A log of recent changes.</p></div>
</div>
<!-- /wp:html -->
