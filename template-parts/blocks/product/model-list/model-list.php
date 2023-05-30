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
	$kemroc_pml_id = 'product-model-list-' . $block['id'];
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
	$kemroc_pml_params     = get_field( 'parameters' );
	$kemroc_pml_models_tag = get_field( 'models_tag' );

	// Get models.
	$kemroc_pml_tax_query    = array(
		array(
			'taxonomy' => $kemroc_pml_models_tag->taxonomy,
			'terms'    => $kemroc_pml_models_tag->term_id,
		),
	);
	$kemroc_pml_args         = array(
		'post_type'      => 'produkt',
		'post_status'    => 'published',
		'posts_per_page' => 100,
		'orderby'        => 'title',
		'order'          => 'ASC',
		'tax_query'      => $kemroc_pml_tax_query, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	);
	$kemroc_pml_models_query = new WP_Query( $kemroc_pml_args );
	?>

	<section class="model-list">
		<div class="container model-list__content">
			<div class="model-list__card model-card">
				<div class="model-card__title">
					<?php echo wp_kses_post( get_field( 'title' ) ); ?>
				</div>
				<!-- /.model-card__title -->

				<?php if ( $kemroc_pml_params ) : ?>
					<ul class="model-card__params">

						<?php foreach ( $kemroc_pml_params as $kemroc_pml_param ) : ?>
							<li class="model-card__param">
								<?php echo wp_kses_post( $kemroc_pml_param['parameter_name'] ); ?>
							</li>
							<!-- /.model-card__param -->
						<?php endforeach; ?>

					</ul>
					<!-- /.model-card__params -->
				<?php endif; ?>

			</div>
			<!-- /.model-list__card model-card -->

			<?php if ( $kemroc_pml_models_query->have_posts() ) : ?>
				<div class="swiper model-list__slider">
					<ul class="swiper-wrapper model-list__models">

						<?php 
						while ( $kemroc_pml_models_query->have_posts() ) :
							$kemroc_pml_models_query->the_post();
							?>
							<li class="swiper-slide model-list__item model">
								<div class="model__title">
									<?php the_title(); ?>
								</div>
								<!-- /.model__title -->
								<ul class="model__params">
									<li class="model__param">
									7 – 13 t
									</li>
									<!-- /.model__param -->
									<li class="model__param">
									800 mm
									</li>
									<!-- /.model__param -->
									<li class="model__param">
									200 mm
									</li>
									<!-- /.model__param -->
								</ul>
								<!-- /.model__params -->
								<a href="<?php the_permalink(); ?>" class="model__link">
									<?php esc_html_e( 'Details', 'kemroc' ); ?> 
									<span class="model__arrow">
										<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'fill' => '#FF6000' ) ); ?>
									</span>
								</a>
								<!-- /.model__link -->
							</li>
							<!-- /.model-list__item model -->
							<?php 
						endwhile;
						wp_reset_postdata();
						?>

					</ul>
					<!-- /.model-list__models -->
					<div class="swiper-button-prev model-list__control model-list__control--prev">
						<?php get_template_part( 'template-parts/icons/arrow-left' ); ?>
					</div>
					<!-- /.model-list__control -->
					<div class="swiper-button-next model-list__control model-list__control--next">
						<?php get_template_part( 'template-parts/icons/arrow-right' ); ?>
					</div>
					<!-- /.model-list__control -->
				</div>
				<!-- /.swiper model-list__slider -->
			<?php endif; ?>

		</div>
		<!-- /.container model-list__content -->
	</section>
	<!-- /.model-list -->

	<?php
endif;
