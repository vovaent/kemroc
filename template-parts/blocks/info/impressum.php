<?php

/**
 * Impressum Block Template.
 */
if ( isset( $block['data']['gutenberg_preview_image'] ) && $is_preview ) {
	echo '<img src="' . esc_url( $block['data']['gutenberg_preview_image'] ) . '" style="max-width:100%; height:auto;">';
}

if ( ! $is_preview ) :
	$kemroc_impressum_id = 'impressum-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_faq_id = $block['anchor'];
	}

	$kemroc_impressum_class_name = 'impressum';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_impressum_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_impressum_class_name .= ' align' . $block['align'];
	}

	$herausgeber                = get_field( 'herausgeber' );
	$anschrift                  = get_field( 'anschrift' );
	$ust_id                     = get_field( 'ust-id' );
	$telefon                    = get_field( 'telefon' );
	$fax                        = get_field( 'fax' );
	$e_mail                     = get_field( 'e-mail' );
	$eintrag_im_handelsregister = get_field( 'eintrag_im_handelsregister' );
	$geschaftsfuhrer            = get_field( 'geschaftsfuhrer' );
	?>

	<section id="<?php echo esc_attr( $kemroc_impressum_id ); ?>"
		class="<?php echo esc_attr( $kemroc_impressum_class_name ); ?>">
		<div class="container">
			<h2>
				<?php echo get_the_title(); ?>
			</h2>
			<section class="grayplate-text">
				<div class="grayplate-text__wrap two-columns">
					<div class="grayplate-text__column">
						<div class="subtitle"><?php esc_html_e( 'Herausgeber', 'kemroc' ); ?></div>
						<h6>
							<?php echo $herausgeber; ?>
						</h6>
						<div class="subtitle"><?php esc_html_e( 'Anschrift', 'kemroc' ); ?></div>
						<h6>
							<?php echo $anschrift; ?>
						</h6>
						<div class="subtitle"><?php esc_html_e( 'USt-ID', 'kemroc' ); ?></div>
						<h6>
							<?php echo $ust_id; ?>
						</h6>
					</div>
					<div class="grayplate-text__column">
						<div class="subtitle"><?php esc_html_e( 'Kontakt', 'kemroc' ); ?></div>
						<a href="tel: . <?php echo $telefon; ?>"><?php esc_html_e( 'Tel.', 'kemroc' ); ?> <?php echo $telefon; ?></a>
						<a href="tel: . <?php echo $fax; ?>"><?php esc_html_e( 'Fax', 'kemroc' ); ?><?php echo $fax; ?></a>
						<a href="mailto: . <?php echo $e_mail; ?>"><?php esc_html_e( 'E-mail:', 'kemroc' ); ?> <?php echo $e_mail; ?></a>
						<div class="subtitle"><?php esc_html_e( 'Eintrag im Handelsregister', 'kemroc' ); ?></div>
						<h6>
							<?php echo $eintrag_im_handelsregister; ?>
						</h6>
						<div class="subtitle"><?php esc_html_e( 'Geschäftsführer', 'kemroc' ); ?></div>
						<h6 style="margin-bottom: 0;">
							<?php echo $geschaftsfuhrer; ?>
						</h6>
					</div>
				</div>
			</section>
		</div>
	</section>
	<?php
endif;
