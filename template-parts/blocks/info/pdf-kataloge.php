<?php

/**
 * PDF-Kataloge Block Template.
 */
if ( isset( $block['data']['gutenberg_preview_image'] ) && $is_preview ) {
	echo '<img src="' . esc_url( $block['data']['gutenberg_preview_image'] ) . '" style="max-width:100%; height:auto;">';
}

if ( ! $is_preview ) :
	$kemroc_pdf_kataloge_id = 'pdf_kataloge-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_pdf_kataloge_id = $block['anchor'];
	}

	$kemroc_pdf_kataloge_class_name = 'pdf_kataloge';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_pdf_kataloge_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_pdf_kataloge_class_name .= ' align' . $block['align'];
	}

	$rows = get_field( 'pdf-kataloge_item' );
	?>

	<section id="<?php echo esc_attr( $kemroc_pdf_kataloge_id ); ?>"
		class="<?php echo esc_attr( $kemroc_pdf_kataloge_class_name ); ?>">
		<div class="container">
			<?php
			if ( $rows ) {
				?>
				<div class="list-pdf__wrap">
					<?php foreach ( $rows as $row ) { ?>
						<?php if ( isset( $row['file']['url'] ) ) : ?>

							<div class="list-pdf__item">
								<a class="item-info" href="<?php echo $row['file']['url']; ?>" target="_blank">
									<?php if ( $row['bild'] ) : ?>
										<img src="<?php echo $row['bild']; ?>">
									<?php endif; ?>
									<?php if ( isset( $row['file']['url'] ) ) : ?>
										<?php if ( $row['title'] ) : ?>
											<p>
												<?php echo $row['title']; ?> <span>.pdf</span>
											</p>
										<?php endif; ?>
									<?php endif; ?>
								</a>
								<!-- <div class="item-icon"> -->
								<?php if ( isset( $row['file']['url'] ) ) : ?>
									<a class="item-icon" href="<?php echo $row['file']['url']; ?>" download>
										<img src="<?php echo get_template_directory_uri(); ?>/images/download-01.svg" alt="download">
									</a>
								<?php endif; ?>
								<!-- </div> -->
							</div>
						<?php endif; ?>

					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</section>
	<?php
endif;
