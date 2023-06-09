<?php
/**
 * Product General Info Block Template.
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
	$kemroc_pgi_id = 'product-general-info-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_pgi_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_pgi_class_name = 'product-general-info bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_pgi_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_pgi_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_pgi_figure        = get_field( 'figure' );
	$kemroc_pgi_list_benefits = get_field( 'list_benefits' );

	$kemroc_pgi_app_areas = wp_get_post_terms( get_the_ID(), 'einsatzbereich' );
	?>

	<section id="<?php echo esc_attr( $kemroc_pgi_id ); ?>" class="<?php echo esc_attr( $kemroc_pgi_class_name ); ?>">
		<div class="container product-general-info__content">
			
			<?php if ( $kemroc_pgi_figure['image'] ) : ?>
				<figure class="product-general-info__picture">

					<?php if ( $kemroc_pgi_app_areas[0] ) : ?>
						<div class="tag-in-image product-general-info__tag">
							<?php echo esc_html( $kemroc_pgi_app_areas[0]->name ); ?>
						</div>
					<?php endif; ?>
				
					<?php echo wp_get_attachment_image( $kemroc_pgi_figure['image'], 'medium_large' ); ?>
					<figcaption>
						<?php echo wp_kses_post( wp_get_attachment_caption( $kemroc_pgi_figure['image'] ) ); ?>
					</figcaption>
				</figure>
				<!-- /.product-general-info__picture -->
			<?php endif; ?>	

			<div class="product-general-info__text">
				<h1 class="product-general-info__title">
					<?php echo esc_html( get_field( 'title' ) ); ?>
				</h1>
				<!-- /.product-general-info__title -->
				<h3 class="product-general-info__subtitle">
					<?php echo wp_kses_post( get_field( 'subtitle' ) ); ?>
				</h3>
				<!-- /.product-general-info__subtitle -->

				<?php if ( $kemroc_pgi_list_benefits ) : ?>
					<ul class="product-general-info__benefits">

						<?php foreach ( $kemroc_pgi_list_benefits as $kemroc_pgi_benefit ) : ?>
							<li class="arrow-list-item product-general-info__benefit">
								<span class="arrow-list-item__arrow">
									<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'fill' => '#FF6000' ) ); ?>
								</span>
								<!-- /.arrow-list-item__arrow -->
								<?php echo wp_kses_post( $kemroc_pgi_benefit['benefit'] ); ?>
							</li>
							<!-- /.arrow-list-item product-general-info__benefit -->
						<?php endforeach; ?>

					</ul>
					<!-- /.product-general-info__benefits -->
				<?php endif; ?>

			</div>
			<!-- /.product-general-info__text -->
		</div>
		<!-- /.container product-general-info__content -->
	</section>
	<!-- /.product-general-info -->

	<?php
endif;
