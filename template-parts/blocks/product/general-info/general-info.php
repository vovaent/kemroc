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
	$kemroc_id = 'masthead-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_class_name = 'masthead bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_figure        = get_field( 'figure' );
	$kemroc_list_benefits = get_field( 'list_benefits' );

	?>
	<section class="product-general-info">
		<div class="container product-general-info__content">
			<figure class="product-general-info__picture">
				<div class="product-general-info__tag">
					<?php echo esc_html( $kemroc_figure['tag']->name ); ?>
				</div>
				<?php echo wp_get_attachment_image( $kemroc_figure['image'], 'medium_large' ); ?>
				<figcaption>
					<?php echo esc_html( wp_get_attachment_caption( $kemroc_figure['image'] ) ); ?>
				</figcaption>
			</figure>
			<!-- /.product-general-info__picture -->
			<div class="product-general-info__text">
				<h1 class="product-general-info__title">
					<?php the_title(); ?>
				</h1>
				<!-- /.product-general-info__title -->
				<h3 class="product-general-info__subtitle">
					<?php the_field( 'subtitle' ); ?>
				</h3>
				<!-- /.product-general-info__subtitle -->

				<?php if ( $kemroc_list_benefits ) : ?>
					<ul class="product-general-info__benefits">

						<?php foreach ( $kemroc_list_benefits as $kemroc_benefit ) : ?>
							<li class="product-general-info__benefit">
								<span class="product-general-info__arrow-right">
									<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
								</span>
								<!-- /.product-general-info__arrow-right -->
								<?php echo esc_html( $kemroc_benefit['benefit'] ); ?>
							</li>
							<!-- /.product-general-info__benefit -->
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
