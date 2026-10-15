<?php
/**
 * Title: Contact form
 * Slug: cds/contact-form
 * Categories: cds
 * Inserter: true
 * Description: A piece inside a section. Not a page job.
 */
?>
<!-- wp:html -->
<form class="cds-form" action="#" method="post">
	<div class="cds-field">
		<label for="cds-contact-name">Name</label>
		<input class="cds-input" id="cds-contact-name" name="name" type="text" autocomplete="name" required>
	</div>
	<div class="cds-field">
		<label for="cds-contact-email">Email</label>
		<input class="cds-input" id="cds-contact-email" name="email" type="email" autocomplete="email" required>
	</div>
	<div class="cds-field">
		<label for="cds-contact-note">Message</label>
		<textarea class="cds-textarea" id="cds-contact-note" name="note" rows="4"></textarea>
	</div>
	<button class="cds-btn cds-btn--primary" type="submit">Send</button>
	<p class="cds-hint">This sample does not send. Point it at your form.</p>
</form>
<!-- /wp:html -->
