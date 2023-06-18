<?php
/**
 * Contacts Form Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 * 
 * @package kemroc
 */

if ( isset( $block['data']['gutenberg_preview_image'] ) && $is_preview ) {
	echo '<img src="' . esc_url( $block['data']['gutenberg_preview_image'] ) . '" style="max-width:100%; height:auto;">';
}

if ( ! $is_preview ) :
	// Create id attribute allowing for custom "anchor" value.
	$kemroc_cf_id = 'contacts-form-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_cf_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_cf_class_name = 'contacts-form bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_cf_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_cf_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.

	?>

	<section id="<?php echo esc_attr( $kemroc_cf_id ); ?>" class="<?php echo esc_attr( $kemroc_cf_class_name ); ?>">
		<div class="container contacts-form__content">
			<h2 class="contacts-form__title">
				Sende uns eine E-Mail
			</h2>
			<!-- /.contacts-form__title -->
			<form class="contacts-form__form cf-form">
				<div class="cf-form__top">
					<div class="cf-form__left">
						<label class="cf-form__label">
							<?php esc_html_e( 'Name', 'kemroc' ); ?> *
							<input type="text" class="cf-form__field cf-form__field--required" placeholder="<?php esc_html_e( 'Name', 'kemroc' ); ?>">
						</label>
						<!-- /.cf-form__label -->
						<label class="cf-form__label cf-form__label--street">
							<?php esc_html_e( 'Straße', 'kemroc' ); ?> *
							<input type="text" class="cf-form__field cf-form__field--required" placeholder="<?php esc_html_e( 'Straße', 'kemroc' ); ?>">
						</label>
						<!-- /.cf-form__label -->
						<label class="cf-form__label cf-form__label--house">
							<?php esc_html_e( 'Hausnummer', 'kemroc' ); ?> *
							<input type="text" class="cf-form__field" placeholder="<?php esc_html_e( 'Hausnummer', 'kemroc' ); ?>">
						</label>
						<!-- /.cf-form__label -->
						<label class="cf-form__label cf-form__label--zipcode">
							<?php esc_html_e( 'PLZ', 'kemroc' ); ?> *
							<input type="text" class="cf-form__field" placeholder="<?php esc_html_e( 'PLZ', 'kemroc' ); ?>">
						</label>
						<!-- /.cf-form__label -->
						<label class="cf-form__label cf-form__label--location">
							<?php esc_html_e( 'Ort', 'kemroc' ); ?> *
							<input type="text" class="cf-form__field" placeholder="<?php esc_html_e( 'Ort', 'kemroc' ); ?>">
						</label>
						<!-- /.cf-form__label -->
					</div>
					<!-- /.cf-form__left -->
					<div class="cf-form__right">
						<label class="cf-form__label">
							<?php esc_html_e( 'Unternehmen', 'kemroc' ); ?> *
							<input type="text" class="cf-form__field" placeholder="<?php esc_html_e( 'Unternehmen', 'kemroc' ); ?>">
						</label>
						<!-- /.cf-form__label -->
						<label class="cf-form__label cf-form__label--phone">
							<?php esc_html_e( 'Telefon', 'kemroc' ); ?> *
							<input type="text" class="cf-form__field cf-form__field--required" placeholder="<?php esc_html_e( 'Telefon', 'kemroc' ); ?>">
						</label>
						<!-- /.cf-form__label -->
						<label class="cf-form__label cf-form__label--add-phone">
							<?php esc_html_e( 'Telefon alternativ', 'kemroc' ); ?> *
							<input type="text" class="cf-form__field" placeholder="<?php esc_html_e( 'Telefon alternativ', 'kemroc' ); ?>">
						</label>
						<!-- /.cf-form__label -->
						<label class="cf-form__label cf-form__label--email">
							<?php esc_html_e( 'E-Mail', 'kemroc' ); ?> *
							<input type="text" class="cf-form__field cf-form__field--required" placeholder="<?php esc_html_e( 'E-Mail', 'kemroc' ); ?>">
						</label>
						<!-- /.cf-form__label -->
						<label class="cf-form__label cf-form__label--fax">
							<?php esc_html_e( 'Fax', 'kemroc' ); ?> *
							<input type="text" class="cf-form__field" placeholder="<?php esc_html_e( 'Fax', 'kemroc' ); ?>">
						</label>
						<!-- /.cf-form__label -->
					</div>
					<!-- /.cf-form__right -->
				</div>
				<!-- /.cf-form__top -->
				<div class="cf-form__middle">
					<label class="cf-form__label cf-form__label--subject">
						<?php esc_html_e( 'Betreff', 'kemroc' ); ?> *
						<input type="text" class="cf-form__field cf-form__field--required" placeholder="<?php esc_html_e( 'Betreff', 'kemroc' ); ?>">
					</label>
					<!-- /.cf-form__label -->
					<label class="cf-form__label cf-form__label--textarea">
						<?php esc_html_e( 'Nachricht', 'kemroc' ); ?> *
						<textarea class="cf-form__field cf-form__field--required" name="message" placeholder="<?php esc_html_e( 'Nachricht', 'kemroc' ); ?>"></textarea>
					</label>
					<!-- /.cf-form__label -->
				</div>
				<!-- /.cf-form__middle -->
				<div class="cf-form__bottom">
					<div class="cf-form__agree">
						<input id="agree-checkbox" type="checkbox" class="cf-form__agree-checkbox">
						<label for="agree-checkbox" class="cf-form__agree-label"></label>
						<div class="cf-form__agree-text">
							Durch das Absenden dieses Kontaktformulars erklären Sie sich damit einverstanden, dass Ihre Angaben und Daten zur Beantwortung Ihrer Anfrage elektronisch erhoben und gespeichert werden. Sie können Ihre Einwilligung jederzeit für die Zukunft per E-Mail an info@kemroc.de widerrufen. Weitere Informationen zur Speicherung und Verarbeitung Ihrer Daten finden Sie in unserer Datenschutzerklärung. *
						</div>
						<!-- /.cf-form__agree-text -->
					</div>
					<!-- /.cf-form__agree -->
					<button class="btn btn-accent btn-rounded arrow-right cf-form__button">
						<?php esc_html_e( 'Formular senden', 'kemroc' ); ?>
					</button>
					<!-- /.cf-form__button -->
				</div>
				<!-- /.cf-form__bottom -->
			</form>
			<!-- /.contacts-form__form cf-form -->
		</div>
		<!-- /.container contacts-form__content -->
	</section>
	<!-- /.contacts-form -->

	<?php
endif;
