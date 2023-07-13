<?php
/**
 * Product Model List Block Template.
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
	$kemroc_pml_id = 'product-product-model-list-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_pml_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_pml_class_name = 'product-model-list bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_pml_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_pml_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_pml_enable_measure_units_switcher = get_field( 'enable_measure_units_switcher' );

	$kemroc_pml_models       = kemroc_get_models_compare( get_post_type() );
	$kemroc_pml_model_params = array();

	foreach ( $kemroc_pml_models as $kemroc_pml_model ) :
		$kemroc_pml_model_params = array_merge( $kemroc_pml_model_params, $kemroc_pml_model['params'] );
	endforeach;

	$kemroc_pml_slides_per_view = 5;
	$kemroc_pml_count_models    = count( $kemroc_pml_models );
	$kemroc_pml_remainder       = $kemroc_pml_count_models % $kemroc_pml_slides_per_view;

	if ( $kemroc_pml_slides_per_view < $kemroc_pml_count_models ) {
		if ( $kemroc_pml_remainder ) {
			$kemroc_pml_missing       = $kemroc_pml_slides_per_view - $kemroc_pml_remainder; 
			$kemroc_pml_mising_models = array_slice( $kemroc_pml_models, 0, $kemroc_pml_missing );    
			$kemroc_pml_models        = array_merge( $kemroc_pml_models, $kemroc_pml_mising_models );
		}
	}
	?>
	<section id="<?php echo esc_attr( $kemroc_pml_id ); ?>" class="<?php echo esc_attr( $kemroc_pml_class_name ); ?>">
		<div class="container product-model-list__content">
			
			<?php if ( $kemroc_pml_models ) : ?>
				<div class="product-model-list__card pml-model-card">
					<div class="pml-model-card__title">

						<?php if ( $kemroc_pml_enable_measure_units_switcher ) : ?>
							<span id='mu-switcher' class="pml-model-card__title-swither">
								<?php esc_html_e( 'Maßeinheit:', 'kemroc' ); ?>
								<span class="mu-flag" data-lang-code="default"></span>
								<!-- /.mu-flag -->
								<span class="mu-flag" data-lang-code="us"></span>
								<!-- /.mu-flag -->
							</span>
							<!-- /.pml-model-card__title-swither -->
						<?php endif; ?>
						
						<?php echo wp_kses_post( __( '<strong>MODELLE</strong> VERGLEICHEN', 'kemroc' ) ); ?>
					</div>
					<!-- /.pml-model-card__title -->
					<ul class="pml-model-card__params">

						<?php 
						foreach ( $kemroc_pml_model_params as $kemroc_pml_param_title => $kemroc_pml_param_value ) : 
							?>
							<li class="pml-model-card__param">
								<?php echo esc_html( $kemroc_pml_param_title ); ?>
							</li>
							<!-- /.pml-model-card__param -->
							<?php 
						endforeach;
						?>

					</ul>
					<!-- /.pml-model-card__params -->

				</div>
				<!-- /.product-model-list__card pml-model-card -->

				<div class="swiper product-model-list__slider">
					<ul class="swiper-wrapper product-model-list__models">

						<?php foreach ( $kemroc_pml_models as $kemroc_pml_model ) : ?>
							<li class="swiper-slide product-model-list__item pml-model">
								<a href="<?php the_permalink( $kemroc_pml_model['id'] ); ?>" class="pml-model__link">
									<div class="pml-model__title">
										<?php echo esc_html( $kemroc_pml_model['title'] ); ?>
									</div>
									<!-- /.pml-model__title -->

									<?php if ( $kemroc_pml_model['params'] ) : ?>
										<ul class="pml-model__params">

											<?php foreach ( $kemroc_pml_model['params'] as $kemroc_pml_param_value ) : ?>
												<li class="pml-model__param">
													<span class="mu-value pml-model__param-value" data-lang-code="default">
														<?php echo esc_html( $kemroc_pml_param_value['default'] ); ?>
													</span>
													<span class="mu-value pml-model__param-value" data-lang-code="us">
														<?php echo esc_html( $kemroc_pml_param_value['us'] ); ?>
													</span>
												</li>
												<!-- /.pml-model__param -->
											<?php endforeach; ?>	

										</ul>
										<!-- /.pml-model__params -->
									<?php endif; ?>

									<div class="pml-model__pseudo-link">
										<?php esc_html_e( 'Details', 'kemroc' ); ?> 
										<span class="pml-model__arrow">
											<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'fill' => '#FF6000' ) ); ?>
										</span>
									</div>
									<!-- /.pml-model__pseudo-link -->
								</a>
								<!-- /.pml-model__link -->
							</li><!-- /.product-model-list__item pml-model -->
						<?php endforeach; ?>

					</ul>
					<!-- /.product-model-list__models -->
					<div class="swiper-button-prev product-model-list__control product-model-list__control--prev">
						<?php get_template_part( 'template-parts/icons/arrow-left' ); ?>
					</div>
					<!-- /.product-model-list__control -->
					<div class="swiper-button-next product-model-list__control product-model-list__control--next">
						<?php get_template_part( 'template-parts/icons/arrow-right' ); ?>
					</div>
					<!-- /.product-model-list__control -->
				</div>
				<!-- /.swiper product-model-list__slider -->
			<?php endif; ?>

		</div>
		<!-- /.container product-model-list__content -->
	</section>
	<!-- /.product-model-list -->

	<?php
endif;
