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
	$kemroc_pml_models = kemroc_get_models( 'page' );
	?>

	<section id="<?php echo esc_attr( $kemroc_pml_id ); ?>" class="<?php echo esc_attr( $kemroc_pml_class_name ); ?>">
		<div class="container product-model-list__content">
			
			<?php if ( $kemroc_pml_models ) : ?>
				<div class="product-model-list__card model-card">
					<div class="model-card__title">
						<?php echo wp_kses_post( __( '<span>MODELLE</span> VERGLEICHEN', 'kemroc' ) ); ?>
					</div>
					<!-- /.model-card__title -->

						<ul class="model-card__params">

							<?php 
							foreach ( $kemroc_pml_models as $kemroc_pml_model ) :
								foreach ( $kemroc_pml_model['params'] as $kemroc_pml_param_title => $kemroc_pml_param_value ) : 
									?>
									<li class="model-card__param">
										<?php echo esc_html( $kemroc_pml_param_title ); ?>
									</li>
									<!-- /.model-card__param -->
									<?php 
								endforeach;
								break;
							endforeach;
							?>

						</ul>
						<!-- /.model-card__params -->

				</div>
				<!-- /.product-model-list__card model-card -->

				<div class="swiper product-model-list__slider">
					<ul class="swiper-wrapper product-model-list__models">

					<?php foreach ( $kemroc_pml_models as $kemroc_pml_model_name => $kemroc_pml_model_data ) : ?>

							<li class="swiper-slide product-model-list__item model">
								<div class="model__title">
									<?php echo esc_html( $kemroc_pml_model_name ); ?>
								</div>
								<!-- /.model__title -->

								<?php if ( $kemroc_pml_model_data['params'] ) : ?>
									<ul class="model__params">

										<?php foreach ( $kemroc_pml_model_data['params'] as $kemroc_pml_param_value ) : ?>
											<li class="model__param">
												<?php echo esc_html( $kemroc_pml_param_value ); ?>
											</li>
											<!-- /.model__param -->
										<?php endforeach; ?>	

									</ul>
									<!-- /.model__params -->
								<?php endif; ?>

								<a href="<?php the_permalink( $kemroc_pml_model_data['id'] ); ?>" class="model__link">
									<?php esc_html_e( 'Details', 'kemroc' ); ?> 
									<span class="model__arrow">
										<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'fill' => '#FF6000' ) ); ?>
									</span>
								</a>
								<!-- /.model__link -->
							</li>
							<!-- /.product-model-list__item model -->
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
