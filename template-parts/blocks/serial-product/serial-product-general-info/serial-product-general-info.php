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
	$kemroc_spgi_class_name = 'serial-product-general-info bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_spgi_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_spgi_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	// $kemroc_spgi_figure        = get_field( 'figure' );
	// $kemroc_spgi_list_benefits = get_field( 'list_benefits' );
	?>

	<section id="<?php echo esc_attr( $kemroc_spgi_id ); ?>" class="<?php echo esc_attr( $kemroc_spgi_class_name ); ?>">
		<div class="container serial-product-general-info__content">
			<div class="serial-product-general-info__text">
				<h1 class="serial-product-general-info__title">
					<?php the_title(); ?>
				</h1>
				<!-- /.serial-product-general-info__title -->
				<p class="serial-product-general-info__subtitle">
					KEMROC Querschneidkopffräsen – bewährte Konzepte konsequent weitergedacht
				</p>
				<!-- /.serial-product-general-info__subtitle -->
				<div class="serial-product-general-info__description">
					Neben Unseren Einzigartigen Kettenfräsen Mit Ihrer Mittig Umlaufenden Fräskette Haben Wir Jetzt Auch Anbaufräsen Mit Querschneidkopf Ohne Eine Solche Fräskette In Unsere Produktpalette Aufgenommen Und Gegenüber Marktgängigen Produkten Aufgewertet.
				</div>
				<!-- /.serial-product-general-info__description -->
			</div>
			<!-- /.serial-product-general-info__text -->
			<div class="swiper serial-product-general-info__slider spgi-slider">
				<ul class="swiper-wrapper spgi-slider__container">
					<li class="swiper-slide spgi-slider__slide">
						<img src="<?php echo get_template_directory_uri() . '/images/serial-product-slide.png'; ?>" alt="">
					</li>
					<!-- /.swiper-slide spgi-slider__slide -->
					<li class="swiper-slide spgi-slider__slide">
						<img src="<?php echo get_template_directory_uri() . '/images/serial-product-slide.png'; ?>" alt="">
					</li>
					<!-- /.swiper-slide spgi-slider__slide -->
					<li class="swiper-slide spgi-slider__slide">
						<img src="<?php echo get_template_directory_uri() . '/images/serial-product-slide.png'; ?>" alt="">
					</li>
					<!-- /.swiper-slide spgi-slider__slide -->
					<li class="swiper-slide spgi-slider__slide">
						<img src="<?php echo get_template_directory_uri() . '/images/serial-product-slide.png'; ?>" alt="">
					</li>
					<!-- /.swiper-slide spgi-slider__slide -->
				</ul>
				<!-- /.swiper-wrapper spgi-slider__container -->
				<div class="swiper-pagination spgi-slider__pagination"></div>
			</div>
			<!-- /.swiper serial-product-general-info__slider -->
		</div>
		<!-- /.container serial-product-general-info__content -->
	</section>
	<!-- /.serial-product-general-info -->

	<?php
endif;
