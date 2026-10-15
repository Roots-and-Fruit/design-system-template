<?php
/**
 * Title: Gallery
 * Slug: cds/gallery
 * Categories: cds
 * Inserter: true
 * Description: A piece inside a section. Not a page job.
 */
?>
<!-- wp:html -->
<div class="cds-gallery">
	<figure class="cds-gallery__stage">
		<div class="cds-gallery__head">
			<p class="cds-gallery__name">Places</p>
		</div>
		<div class="cds-gallery__view">
			<button type="button" class="cds-gallery__float" data-cds-gallery="prev" aria-label="Previous">
				<span class="cds-icon cds-icon--arrow" aria-hidden="true"></span>
			</button>
			<button type="button" class="cds-gallery__open" data-cds-gallery="open" aria-label="Open the picture">
				<img class="cds-gallery__img" alt="" src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) ); ?>" width="800" height="600" />
			</button>
			<button type="button" class="cds-gallery__float cds-gallery__float--next" data-cds-gallery="next" aria-label="Next">
				<span class="cds-icon cds-icon--arrow" aria-hidden="true"></span>
			</button>
		</div>
		<figcaption class="cds-gallery__bar">
			<span class="cds-gallery__count"></span>
			<span class="cds-gallery__caption"></span>
			<button type="button" class="cds-btn cds-btn--outline cds-btn--sm" data-cds-gallery="open">Open</button>
		</figcaption>
	</figure>
	<div class="cds-gallery__strip">
		<button type="button" class="cds-gallery__thumb" aria-current="true"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-1.jpg' ) ); ?>" alt="A path through trees" width="800" height="600" /></button>
		<button type="button" class="cds-gallery__thumb"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-2.jpg' ) ); ?>" alt="A valley in the afternoon" width="800" height="600" /></button>
		<button type="button" class="cds-gallery__thumb"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/media/card-3.jpg' ) ); ?>" alt="A city after rain" width="800" height="600" /></button>
	</div>
	<dialog class="cds-gallery__dialog">
		<img alt="" />
		<p class="cds-gallery__dialog-caption"></p>
		<form method="dialog"><button class="cds-btn cds-btn--ghost cds-btn--sm">Close</button></form>
	</dialog>
</div>
<!-- /wp:html -->
