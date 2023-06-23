<?php
/**
 * Model Info Block Template.
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
	$kemroc_mi_id = 'model-info-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_mi_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_mi_class_name = 'model-info bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_mi_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_mi_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_mi_params     = get_field( 'params' );
	$kemroc_mi_drawing_id = get_field( 'drawing' );
	$kemroc_mi_descr      = get_field( 'descr' );
	$kemroc_mi_drawing_id = get_field( 'drawing' );
	$kemroc_mi_video      = get_field( 'video' );
	$kemroc_mi_photos     = get_field( 'photos' );

	$kemroc_mi_drawing = wp_get_attachment_image(
		$kemroc_mi_drawing_id,
		'medium_large',
		false,
		array( 'alt' => wp_get_attachment_caption( $kemroc_mi_drawing_id ) )
	);

	if ( ! empty( $kemroc_mi_video['poster'] ) ) {
		$kemroc_mi_video_poster = wp_get_attachment_image( 
			$kemroc_mi_video['poster'], 
			'full', 
			false, 
			array(
				'class' => 'lazy-video__poster',
				'alt'   => wp_get_attachment_caption( $kemroc_mi_video['poster'] ),
			) 
		); 
	}
	
	$kemroc_mi_parent_id = wp_get_post_parent_id();
	?>

	<section id="<?php echo esc_attr( $kemroc_mi_id ); ?>" class="<?php echo esc_attr( $kemroc_mi_class_name ); ?>">
		<div class="container model-info__content">
			<header class="model-info__head">
				<a href="<?php the_permalink( $kemroc_mi_parent_id ); ?>" class="above-title model-info__parent-page-name">
					<?php echo wp_kses_post( get_the_title( $kemroc_mi_parent_id ) ); ?>
				</a>
				<!-- /.model-info__parent-page-name -->
				<h1 class="model-info__title">
					<?php the_title( esc_html_e( 'Modell', 'kemroc' ) . ' ' ); ?>
				</h1>
				<!-- /.model-info__title -->
			</header>
			<!-- /.model-info__head -->
			<section class="model-info__tabs model-tabs">
				<div class="model-tabs__head">
					<div class="model-tabs__tab model-tabs__tab--active">
						<?php esc_html_e( 'TECHNISCHE DATEN', 'kemroc' ); ?>
					</div>
					<!-- /.model-tabs__tab -->

					<?php 
					if ( ( 'youtube' === $kemroc_mi_video['yt_or_file_load'] && $kemroc_mi_video['id'] )
						|| ( 'videofile' === $kemroc_mi_video['yt_or_file_load'] && $kemroc_mi_video['videofile'] )
					) : 
						?>
						<div class="model-tabs__tab">
							<?php esc_html_e( 'VIDEO', 'kemroc' ); ?>
						</div>
						<!-- /.model-tabs__tab -->
					<?php endif; ?>

					<div class="model-tabs__tab">
						<?php esc_html_e( 'FOTOS', 'kemroc' ); ?>
					</div>
					<!-- /.model-tabs__tab -->
				</div>
				<!-- /.model-tabs__head -->
				<div class="model-tabs__body">
					<div class="model-tabs__inset model-tabs__inset--visible">
						<div class="model-tabs__tech-info">

							<?php if ( $kemroc_mi_params ) : ?>
								<ul class="model-tabs__params">

									<?php foreach ( $kemroc_mi_params as $kemroc_mi_param ) : ?>
										<li class="arrow-list-item-full model-tabs__param arrow-list-item-full">
											<div class="arrow-list-item-full__property">
												<div class="arrow-list-item-full__arrow">
													<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'fill' => '#FF6000' ) ); ?>
												</div>
												<!-- /.arrow-list-item-full__arrow -->
												<?php echo esc_html( $kemroc_mi_param['title']->post_title ); ?>
											</div>
											<!-- /.arrow-list-item-full__property -->
											<div class="arrow-list-item-full__value">
												<?php echo esc_html( $kemroc_mi_param['value'] ); ?>
											</div>
											<!-- /.arrow-list-item-full__value -->
										</li>
										<!-- /.model-tabs__param model-tabs-param -->
									<?php endforeach; ?>

								</ul>
								<!-- /.model-tabs__params -->
							<?php endif; ?>

							<div class="model-tabs__drawing">
								<?php echo wp_kses_post( $kemroc_mi_drawing ); ?>
							</div>
							<!-- /.model-tabs__drawing -->
						</div>
						<!-- /.model-tabs__tech-info -->
						<div class="fifty-fifty-description model-tabs__inset-description">
							<div class="fifty-fifty-description__accent-text">
								<?php echo wp_kses_post( $kemroc_mi_descr['accent_text'] ); ?>
							</div>
							<!-- /.fifty-fifty-description__accent-text -->
							<div class="fifty-fifty-description__text">
								<?php echo wp_kses_post( $kemroc_mi_descr['simple_text'] ); ?>
							</div>
							<!-- /.fifty-fifty-description__text -->
						</div>
						<!-- /.model-tabs__inset-description -->
					</div>
					<!-- /.model-tabs__inset -->

					<?php if ( 'youtube' === $kemroc_mi_video['yt_or_file_load'] && $kemroc_mi_video['id'] ) : ?>
						<div class="model-tabs__inset">
							<div class="model-tabs__lazy-video lazy-video">
								<figure class="lazy-video__figure">
									<div 
										class="lazy-video__placeholder lazy-video__placeholder--model-page" 
										data-yt-video-id="<?php echo esc_attr( $kemroc_mi_video['id'] ); ?>" 
										data-yt-iframe-class="lazy-video__source lazy-video__source--model-page"
									>
										
										<?php 
										if ( $kemroc_mi_video_poster ) : 
											echo $kemroc_mi_video_poster; //phpcs:ignore
										else : 
											$kemroc_mi_yt_poster_url = 'https://img.youtube.com/vi/' . $kemroc_mi_video['id'] . '/maxresdefault.jpg';
											?>
											<img 
												class="lazy-video__poster"
												src="<?php echo esc_url( $kemroc_mi_yt_poster_url ); ?>" 
												alt="<?php echo esc_attr( $kemroc_mi_video['title'] ); ?>"
											>
										<?php endif; ?>

										<div class="icon-play lazy-video__icon-play">
											<?php get_template_part( 'template-parts/icons/icon-play' ); ?>
										</div>
										<!-- /.icon-play lazy-video__icon-play -->
										<div class="lazy-video__preloader"></div>
										<!-- /.lazy-video__preloader -->
									</div>
									<!-- /.lazy-video__placeholder -->
								</figure>
								<!-- /.lazy-video__figure -->
							</div>
							<!-- /.model-tabs__lazy-video lazy-video -->
						</div>
						<!-- /.model-tabs__inset -->
						<?php 
					elseif ( 'videofile' === $kemroc_mi_video['yt_or_file_load'] && $kemroc_mi_video['videofile'] ) :
						$kemroc_mi_video_poster_img = '';
						if ( $kemroc_mi_video['poster'] ) : 
							$kemroc_mi_video_poster_img = wp_get_attachment_url( $kemroc_mi_video['poster'] ); 
						endif;
						?>
						<div class="model-tabs__inset">
							<div class="model-tabs__lazy-video lazy-video">
								<figure class="lazy-video__figure lazy-video__figure--file">
									<video 
										class="lazy-video__source lazy-video__source--model-page"
										src="<?php echo esc_url( $kemroc_mi_video['videofile']['url'] ); ?>" 
										width="100%" 
										height="100%" 
										muted
										poster="<?php echo esc_url( $kemroc_mi_video_poster_img ); ?>"
									>
										<?php esc_html_e( 'Leider unterstützt Ihr Browser keine eingebetteten Videos.', 'kemroc' ); ?>
									</video>
									<!-- /.lazy-video__source -->
									<span class="icon-play lazy-video__icon-play">
										<?php get_template_part( 'template-parts/icons/icon-play' ); ?>
									</span>
									<!-- /.icon-play lazy-video__icon-play -->
								</figure>
								<!-- /.lazy-video__figure lazy-video__figure--file -->
							</div>
							<!-- /.model-tabs__lazy-video lazy-video -->
						</div>
						<!-- /.model-tabs__inset -->
					<?php endif; ?>

					<?php if ( $kemroc_mi_photos ) : ?>
						<div class="model-tabs__inset">
							<div class="swiper model-tabs__slider swiper-single-slide swiper-single-slide--big-slider">
								<ul class="swiper-wrapper swiper-single-slide__container">

									<?php foreach ( $kemroc_mi_photos as $kemroc_mi_photo ) : ?>
										<li class="swiper-slide swiper-single-slide__slide swiper-single-slide__slide--big-slider-slide">
											<?php
											echo wp_get_attachment_image(
												$kemroc_mi_photo['photo'],
												'full',
												false,
												array( 'alt' => wp_get_attachment_caption( $kemroc_mi_photo['photo'] ) )
											);
											?>
										</li>
										<!-- /.swiper-slide swiper-single-slide__slide swiper-single -->
									<?php endforeach; ?>

								</ul>
								<!-- /.swiper-wrapper swiper-single-slide__container -->
								<div class="swiper-button-prev swiper-single-slide__arrow swiper-single-slide__arrow--prev swiper-single-slide__arrow--big-slider-prev">
									<?php get_template_part( 'template-parts/icons/arrow-left', null, array( 'fill' => '#444444' ) ); ?>
								</div>
								<!-- /.swiper-single-slide__arrow -->
								<div class="swiper-button-next swiper-single-slide__arrow swiper-single-slide__arrow--next swiper-single-slide__arrow--big-slider-next">
									<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'fill' => '#444444' ) ); ?>
								</div>
								<!-- /.swiper-single-slide__arrow -->
							</div>
							<!-- /.swiper model-tabs__slider swiper-single-slide -->
							<div class="swiper-pagination swiper-single-slide__pagination"></div>
							<!-- /.swiper-pagination swiper-single-slide__pagination -->
						</div>
						<!-- /.model-tabs__inset -->
					<?php endif; ?>

				</div>
				<!-- /.model-tabs__body -->
			</section>
			<!-- /.model-info__tabs model-tabs -->
		</div>
		<!-- /.container model-info__content -->
	</section>
	<!-- /.model-info -->

	<?php
endif;
