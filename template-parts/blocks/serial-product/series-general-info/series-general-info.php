<?php
/**
 * Series General Info Block Template.
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
	$kemroc_sgi_id = 'series-general-info-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_sgi_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_sgi_class_name = 'series-general-info';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_sgi_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_sgi_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_sgi_title_choice  = get_field( 'title_choice' );
	$kemroc_sgi_title         = 'custom_title' === $kemroc_sgi_title_choice ? get_field( 'custom_title' ) : get_the_title();
	$kemroc_sgi_subtitle      = get_field( 'subtitle' );
	$kemroc_sgi_description   = get_field( 'description' );
	$kemroc_sgi_photos        = get_field( 'photos' );
	$kemroc_sgi_models_amount = kemroc_get_models_amount( 
		get_post_type(), 
		get_the_ID()
	);
	?>

	<section id="<?php echo esc_attr( $kemroc_sgi_id ); ?>" class="<?php echo esc_attr( $kemroc_sgi_class_name ); ?>">
		<div class="container series-general-info__content">
			<div class="series-general-info__text">
				<div class="series-general-info__header">
					<h1 class="series-general-info__title">
						<?php echo esc_html( $kemroc_sgi_title ); ?>
					</h1>
					<!-- /.series-general-info__title -->
					<div class="amount-series-models series-general-info__amount series-general-info__amount--md">
						<span class="amount-series-models__number">
							<?php echo esc_html( $kemroc_sgi_models_amount ); ?>
						</span>
						<?php esc_html_e( 'modelle', 'kemroc' ); ?> 
					</div>
					<!-- /.amount-series-models series-general-info__amount  -->
				</div>
				<!-- /.series-general-info__header -->
				<div class="series-general-info__body">
					<p class="series-general-info__subtitle">
						<?php echo esc_html( $kemroc_sgi_subtitle ); ?>
					</p>
					<!-- /.series-general-info__subtitle -->
					<div class="series-general-info__description">
						<?php echo wp_kses_post( $kemroc_sgi_description ); ?>
					</div>
					<!-- /.series-general-info__description -->
					<div class="amount-series-models series-general-info__amount series-general-info__amount--lg">
						<span class="amount-series-models__number">
							<?php echo esc_html( $kemroc_sgi_models_amount ); ?>
						</span>
						<?php esc_html_e( 'modelle', 'kemroc' ); ?> 
					</div>
					<!-- /.amount-series-models series-general-info__amount -->
				</div>
				<!-- /.series-general-info__body -->
			</div>
			<!-- /.series-general-info__text -->

			<?php if ( $kemroc_sgi_photos ) : ?>
				<div class="series-general-info__slider-wrapper">
					<div class="swiper series-general-info__slider swiper-single-slide">
						<div class="area-use-in-image area-use-in-image--absolute series-general-info__area">
							Bohren
						</div>
						<ul class="swiper-wrapper swiper-single-slide__container">

							<?php foreach ( $kemroc_sgi_photos as $kemroc_sgi_photo ) : ?>
								<li class="swiper-slide swiper-single-slide__slide">
									<?php echo wp_get_attachment_image( $kemroc_sgi_photo['photo'], 'medium_large' ); ?>
								</li>
								<!-- /.swiper-slide swiper-single-slide__slide -->
							<?php endforeach; ?>

						</ul>
						<!-- /.swiper-wrapper swiper-single-slide__container -->
						<div class="swiper-button-prev swiper-single-slide__arrow swiper-single-slide__arrow--prev">
							<?php get_template_part( 'template-parts/icons/arrow-left', null, array( 'fill' => '#444444' ) ); ?>
						</div>
						<!-- /.swiper-button-prev swiper-single-slide__arrow -->
						<div class="swiper-button-next swiper-single-slide__arrow swiper-single-slide__arrow--next">
							<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'fill' => '#444444' ) ); ?>
						</div>
						<!-- /.swiper-button-next swiper-single-slide__arrow -->
					</div>
					<!-- /.swiper series-general-info__slider -->
					<div class="swiper-pagination swiper-single-slide__pagination"></div>
				</div>
				<!-- /.series-general-info__slider-wrapper -->
			<?php endif; ?>

		</div>
		<!-- /.container series-general-info__content -->
	</section>
	<!-- /.series-general-info -->

	<?php
endif;
