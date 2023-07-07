<?php
/**
 * Stellenangebot Info Block Template.
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
	$kemroc_si_id = 'stellenangebot-info-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_si_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_si_class_name = 'stellenangebot-info';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_si_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_si_class_name .= ' align' . $block['align'];
	}
	$kemroc_si_above_title = get_field( 'above_title' );
	$kemroc_si_form        = get_field( 'form' );

	$kemroc_si_form_messages = array(
		'empty_field'         => ! empty( $kemroc_si_form_data['error_text_empty_field'] ) ? $kemroc_si_form_data['error_text_empty_file'] : esc_html__( 'Dieses Feld darf nicht leer sein', 'kemroc' ),
		'invalid_email'       => ! empty( $kemroc_si_form_data['error_text_invalid_email'] ) ? $kemroc_si_form_data['error_text_invalid_email'] : esc_html__( 'E-Mail-Feld wird nicht korrekt ausgefüllt', 'kemroc' ),
		'empty_checkbox'      => ! empty( $kemroc_si_form_data['error_text_empty_checkbox'] ) ? $kemroc_si_form_data['error_text_empty_checkbox'] : esc_html__( 'Erfolgreich! Ihre Nachricht wurde erfolgreich gesendet!', 'kemroc' ),
		'agree_text'          => ! empty( $kemroc_si_form_data['agree_text'] ) ? $kemroc_si_form_data['agree_text'] : esc_html__( 'Durch das Absenden dieses Kontaktformulars erklären Sie sich damit einverstanden, dass Ihre Angaben und Daten zur Beantwortung Ihrer Anfrage elektronisch erhoben und gespeichert werden. Sie können Ihre Einwilligung jederzeit für die Zukunft per E-Mail an info@kemroc.de widerrufen. Weitere Informationen zur Speicherung und Verarbeitung Ihrer Daten finden Sie in unserer Datenschutzerklärung.', 'kemroc' ),
		'success_submit_text' => ! empty( $kemroc_si_form_data['success_submit_text'] ) ? $kemroc_si_form_data['success_submit_text'] : esc_html__( 'Erfolgreich! Ihre Nachricht wurde erfolgreich gesendet!', 'kemroc' ),
	);

	?>

	<article id="<?php echo esc_attr( $kemroc_si_id ); ?>" class="<?php echo esc_attr( $kemroc_si_class_name ); ?>">
		<?php
		$post_dringlichkeit = get_field( 'dringlichkeit' );
		$post_beschreibung  = get_field( 'beschreibung' );
		?>
		<div class="container post_wrap">
			<div class="post_wrap_column-1">
				<section class="posts__title">
					<div class="item-subtitle">
						<?php echo esc_html( $kemroc_si_above_title ); ?>
					</div>
					<h5 class="item-title">
						<?php echo get_the_title(); ?>
					</h5>
					<div class="item-bottom">
						<?php if ( $post_dringlichkeit ) : ?>
							<div class="job-category">
								<?php echo $post_dringlichkeit; ?>
							</div>
						<?php endif; ?>
					</div>
				</section>
				<section class="posts__beschreibung">
					<?php if ( $post_beschreibung ) : ?>
						<div class="item-beschreibung">
							<?php echo $post_beschreibung; ?>
						</div>
					<?php endif; ?>
				</section>
				<section class="posts__ihr_profil">
					<?php if ( get_field( 'ihr_profil' ) ) : ?>
						<h4>Ihr Profil</h4>
						<div class="ihr_profil_wrap">
							<?php
							$rows = get_field( 'ihr_profil' );
							if ( $rows ) {
								foreach ( $rows as $row ) {
									?>
									<div class="ihr_profil_item">
										<div class="job-link"><svg width="6" height="10" viewBox="0 0 6 10" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd"
													d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z"
													fill="#FF6000" />
											</svg>
										</div>
										<div class="ihr_profil_text">
											<?php echo $row['beschreibung']; ?>
										</div>
									</div>
								<?php } ?>
						<?php } ?>
						</div>
					<?php endif; ?>
				</section>
				<section class="posts__unsere_benefits">
					<?php if ( get_field( 'unsere_benefits' ) ) : ?>
						<h4><?php esc_html_e( 'Unsere Benefits', 'kemroc' ); ?></h4>
						<div class="unsere_benefits_wrap">
							<?php
							$rows = get_field( 'unsere_benefits' );
							if ( $rows ) {
								foreach ( $rows as $row ) {
									?>
									<div class="unsere_benefits_item">
										<div class="job-link"><svg width="6" height="10" viewBox="0 0 6 10" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd"
													d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z"
													fill="#FF6000" />
											</svg>
										</div>
										<div class="unsere_benefits_text">
											<?php echo $row['beschreibung']; ?>
										</div>
									</div>
								<?php } ?>
						<?php } ?>
						</div>
					<?php endif; ?>
				</section>
			</div>
			<div class="contacts-form">
				<div class="contacts-form__content">
					<?php if ( ! empty( $kemroc_si_form['title'] ) ) : ?>
						<h2 class="contacts-form__title">
							<?php echo esc_html( $kemroc_si_form['title'] ); ?>
						</h2>
					<?php endif; ?>
					<?php if ( ! empty( $kemroc_si_form['subtitle'] ) ) : ?>
						<p class="contacts-form__subtitle">
							<?php echo esc_html( $kemroc_si_form['subtitle'] ); ?>
						</p>
					<?php endif; ?>
					<!-- /.contacts-form__title -->
					<form id="cf-form-stellenangebot" class="contacts-form__form cf-form" enctype="multipart/form-data">
						<div class="cf-form__top">
							<div class="cf-form__left">
								<label class="cf-form__label">
									<?php esc_html_e( 'Name', 'kemroc' ); ?> *
									<input type="text" name="name" class="cf-form__field cf-form__field--required"
										placeholder="<?php esc_html_e( 'Name', 'kemroc' ); ?>" required>
									<span class="cf-form__error-notice">
										<?php echo esc_html( $kemroc_si_form_messages['empty_field'] ); ?>
									</span>
								</label>
								<!-- /.cf-form__label -->
								<label class="cf-form__label cf-form__label--phone">
									<?php esc_html_e( 'Telefon', 'kemroc' ); ?> *
									<input type="tel" name="phone" class="cf-form__field cf-form__field--required"
										placeholder="<?php esc_html_e( 'Telefon', 'kemroc' ); ?>" required>
									<span class="cf-form__error-notice">
										<?php echo esc_html( $kemroc_si_form_messages['empty_field'] ); ?>
									</span>
								</label>
								<!-- /.cf-form__label -->
								<label class="cf-form__label cf-form__label--email">
									<?php esc_html_e( 'E-Mail', 'kemroc' ); ?> *
									<input type="email" name="email" class="cf-form__field cf-form__field--required"
										placeholder="<?php esc_html_e( 'E-Mail', 'kemroc' ); ?>" required>
									<span class="cf-form__error-notice">
										<?php echo esc_html( $kemroc_si_form_messages['empty_field'] ); ?>
									</span>
									<span class="cf-form__error-notice cf-form__error-notice--email">
										<?php echo esc_html( $kemroc_si_form_messages['invalid_email'] ); ?>
									</span>
								</label>
								<!-- /.cf-form__label -->

								<label for="resumeFile" id="resumeFileLabel" class="cf-form__label cf-form__label--file">
										<?php esc_html_e( 'Laden Sie Ihren Lebenslauf hoch', 'kemroc' ); ?>
								</label>
								<input type="file" name="resume" size="40" class="cf-form__field cf-form__field--file"
									id="resumeFile" accept=".pdf,.txt,.doc,.docx,.jpg,.png">
								<div id="resumeFileArea" class="cf-form__label cf-form__label--resume">
									<p id="resumeFileAreaLinkText">
										<?php
										echo wp_kses(
											__( '<a>Klicken Sie auf eine Datei und wählen Sie sie aus</a>, oder ziehen Sie eine <b>DOC-</b>, <b>DOCX-</b> oder <b>PDF-Datei</b> per Drag & Drop. Die maximale Dateigröße beträgt <b>1 Mb</b>.', 'kemroc' ),
											array(
												'a' => array(),
												'b' => array(),
											)
										);
										?>
									</p>
								</div>
								<!-- /.cf-form__label -->
								<button class="btn btn-accent btn-rounded arrow-right cf-form__button">
									<?php esc_html_e( 'Formular senden', 'kemroc' ); ?>
								</button>
								<!-- /.cf-form__button -->
								<div class="cf-form__success-message">
									<?php echo esc_html( $kemroc_si_form_messages['success_submit_text'] ); ?>
								</div>
								<!-- /.cf-form__success-message -->
								<div class="cf-form__error-message"></div>
								<!-- /.cf-form__error-message -->

								<div class="cf-form__agree">
									<input id="agree-checkbox" type="checkbox" name="agree"
										class="cf-form__agree-checkbox cf-form__agree-checkbox--required" required>
									<label for="agree-checkbox" class="cf-form__agree-label"></label>
									<div class="cf-form__agree-text">
										<?php echo esc_html( $kemroc_si_form_messages['agree_text'] ); ?> *
									</div>
									<!-- /.cf-form__agree-text -->
									<div class="cf-form__error-notice cf-form__error-notice--checkbox">
										<?php echo esc_html( $kemroc_si_form_messages['empty_checkbox'] ); ?>
									</div>
								</div>
								<!-- /.cf-form__agree -->
								<div class="cf-form_beschreibung">
									<?php if ( ! empty( $kemroc_si_form['cta'] ) ) : ?>
										<div class="cf-form_beschreibung-title">
											<?php echo esc_html( $kemroc_si_form['cta'] ); ?>
										</div>
									<?php endif; ?>
									<?php if ( $kemroc_si_form['contact_information_text'] ) : ?>
										<div class="cf-form_beschreibung-text">
											<?php echo wp_kses_post( $kemroc_si_form['contact_information_text'] ); ?>
										</div>
									<?php endif; ?>
								</div>
								<!-- /.cf-form__bottom -->
								<input type="checkbox" name="anticheck" style="display: none !important;" value="true" checked="checked" />
								<input type="text" name="submitted" value="" style="display: none !important;" />
								<input type="hidden" name="MAX_FILE_SIZE" value="3145728" />
							</div>
					</form>
					<!-- /.contacts-form__form cf-form -->

				</div>
			</div>
	</article><!--  -->

	<?php if ( ! empty( $kemroc_cf_form_data['email_to'] ) ) : ?>
		<script>
			var customEmailTo = '<?php echo esc_html( $kemroc_cf_form_data['email_to'] ); ?>';
		</script>
	<?php endif; ?>

	<?php
endif;
