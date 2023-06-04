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
	// Get models.
	$kemroc_pml_models_args  = array(
		'post_type'      => 'page',
		'post_status'    => 'published',
		'posts_per_page' => -1, // phpcs:ignore
		'post_parent'    => get_the_ID(),
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	);
	$kemroc_pml_models_query = new WP_Query( $kemroc_pml_models_args );

	if ( $kemroc_pml_models_query->have_posts() ) {
		$kemroc_pml_models = array();

		while ( $kemroc_pml_models_query->have_posts() ) {
			$kemroc_pml_models_query->the_post();
			
			$kemroc_pml_blocks = parse_blocks( get_the_content() );
			$kemroc_pml_params = array();

			foreach ( $kemroc_pml_blocks as $kemroc_pml_block ) {
				if ( 'acf/model-info' !== $kemroc_pml_block['blockName'] ) {
					continue;
				}
				if ( empty( $kemroc_pml_block['attrs']['data']['params'] ) ) {
					break;
				}

				$kemroc_pml_block_params = $kemroc_pml_block['attrs']['data']['params'];
				$kemroc_pml_block_data   = $kemroc_pml_block['attrs']['data'];
				
				
				for ( $kemroc_pml_i = 0; $kemroc_pml_i < $kemroc_pml_block_params; $kemroc_pml_i++ ) { 
					$kemroc_pml_params_key_title_post_id = 'params_' . $kemroc_pml_i . '_title';
					$kemroc_pml_params_key_title_post    = get_post( $kemroc_pml_block_data[ $kemroc_pml_params_key_title_post_id ] );
					$kemroc_pml_params_title             = $kemroc_pml_params_key_title_post->post_title;
					
					$kemroc_pml_params_value = 'params_' . $kemroc_pml_i . '_value';
					
					$kemroc_pml_params[ $kemroc_pml_params_title ] = $kemroc_pml_block_data[ $kemroc_pml_params_value ];
				}
				break;
			}

			ksort( $kemroc_pml_params );
			$kemroc_pml_models[ get_the_title() ] = $kemroc_pml_params;
		}   
	}
	?>

	<section id="<?php echo esc_attr( $kemroc_pml_id ); ?>" class="<?php echo esc_attr( $kemroc_pml_class_name ); ?>">
		<div class="container product-model-list__content">
			<div class="product-model-list__card model-card">
				<div class="model-card__title">
					<?php echo wp_kses_post( __( '<span>MODELLE</span> VERGLEICHEN', 'kemroc' ) ); ?>
				</div>
				<!-- /.model-card__title -->

				<?php if ( $kemroc_pml_models ) : ?>
					<ul class="model-card__params">

						<?php 
						foreach ( $kemroc_pml_models as $kemroc_pml_model ) :
							foreach ( $kemroc_pml_model as $kemroc_pml_param_title => $kemroc_pml_param_value ) : 
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
				<?php endif; ?>

			</div>
			<!-- /.product-model-list__card model-card -->

			<?php if ( $kemroc_pml_models ) : ?>
				<div class="swiper product-model-list__slider">
					<ul class="swiper-wrapper product-model-list__models">

					<?php foreach ( $kemroc_pml_models as $kemroc_pml_model_name => $kemroc_pml_model_params ) : ?>

							<li class="swiper-slide product-model-list__item model">
								<div class="model__title">
									<?php echo esc_html( $kemroc_pml_model_name ); ?>
								</div>
								<!-- /.model__title -->

								<?php if ( $kemroc_pml_model_params ) : ?>
									<ul class="model__params">

										<?php foreach ( $kemroc_pml_model_params as $kemroc_pml_param_value ) : ?>
											<li class="model__param">
												<?php echo esc_html( $kemroc_pml_param_value ); ?>
											</li>
											<!-- /.model__param -->
										<?php endforeach; ?>	

									</ul>
									<!-- /.model__params -->
								<?php endif; ?>

								<a href="<?php the_permalink(); ?>" class="model__link">
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
