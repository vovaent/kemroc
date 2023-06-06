<?php
/**
 * Serial Product General Info Block Template.
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
	$kemroc_spgi_id = 'serial-product-general-info-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_spgi_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_spgi_class_name = 'serial-product-general-info';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_spgi_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_spgi_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_spgi_title       = get_field( 'title' );
	$kemroc_spgi_subtitle    = get_field( 'subtitle' );
	$kemroc_spgi_description = get_field( 'description' );
	$kemroc_spgi_photos      = get_field( 'photos' );
	?>

	<section id="<?php echo esc_attr( $kemroc_spgi_id ); ?>" class="<?php echo esc_attr( $kemroc_spgi_class_name ); ?>">
		<div class="container serial-product-general-info__content">
			<div class="serial-product-general-info__text">
				<h1 class="serial-product-general-info__title">
					<?php echo esc_html( $kemroc_spgi_title ); ?>
				</h1>
				<!-- /.serial-product-general-info__title -->
				<p class="serial-product-general-info__subtitle">
					<?php echo esc_html( $kemroc_spgi_subtitle ); ?>
				</p>
				<!-- /.serial-product-general-info__subtitle -->
				<div class="serial-product-general-info__description">
					<?php echo wp_kses_post( $kemroc_spgi_description ); ?>
				</div>
				<!-- /.serial-product-general-info__description -->
			</div>
			<!-- /.serial-product-general-info__text -->

			<?php if ( $kemroc_spgi_photos ) : ?>
				<div class="swiper serial-product-general-info__slider spgi-slider">
					<ul class="swiper-wrapper spgi-slider__container">

					<?php foreach ( $kemroc_spgi_photos as $kemroc_spgi_photo ) : ?>
						<li class="swiper-slide spgi-slider__slide">
							<?php echo wp_get_attachment_image( $kemroc_spgi_photo['photo'], 'medium_large' ); ?>
						</li>
						<!-- /.swiper-slide spgi-slider__slide -->
					<?php endforeach; ?>

					</ul>
					<!-- /.swiper-wrapper spgi-slider__container -->
					<div class="swiper-pagination spgi-slider__pagination"></div>
				</div>
				<!-- /.swiper serial-product-general-info__slider -->
			<?php endif; ?>

		</div>
		<!-- /.container serial-product-general-info__content -->
	</section>
	<!-- /.serial-product-general-info -->

	<?php
endif;
