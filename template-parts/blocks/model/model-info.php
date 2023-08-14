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
	$kemroc_mi_overhead_titel    = get_field( 'overhead_titel' );
	$kemroc_mi_custom_title      = get_field( 'custom_title' );
	$kemroc_mi_params            = get_field( 'params' );
	$kemroc_mi_drawing_id        = get_field( 'drawing' );
	$kemroc_mi_descr             = get_field( 'descr' );
	$kemroc_mi_animation         = get_field( 'animation' );
	$kemroc_mi_video             = get_field( 'video' );
	$kemroc_mi_add_another_video = get_field( 'add_another_video' );
	$kemroc_mi_video_2           = get_field( 'video_2' );
	$kemroc_mi_video_3           = get_field( 'video_3' );
	$kemroc_mi_video_4           = get_field( 'video_4' );
	$kemroc_mi_video_5           = get_field( 'video_5' );
	$kemroc_mi_photos            = get_field( 'photos' );

	$kemroc_mi_model_overhead_title = '';
	$kemroc_mi_parent_id            = wp_get_post_parent_id();    
	
	if ( ! $kemroc_mi_overhead_titel['hide'] ) {
		if ( ! empty( $kemroc_mi_overhead_titel['text'] ) ) {
			$kemroc_mi_model_overhead_title = $kemroc_mi_overhead_titel['text'];
		} else {
			$kemroc_mi_model_overhead_title = get_the_title( $kemroc_mi_parent_id );
		}
	}
	
	$kemroc_mi_model_title = '';
	if ( ! $kemroc_mi_custom_title['hide'] ) {
		if ( ! empty( $kemroc_mi_custom_title['text'] ) ) {
			$kemroc_mi_model_title = $kemroc_mi_custom_title['text'];
		} else {
			$kemroc_mi_model_title = __( 'Modell', 'kemroc' ) . '&nbsp;' . get_the_title();
		}
	}

	$kemroc_mi_current_lang = '';
	if ( function_exists( 'pll_current_language' ) ) {
		$kemroc_mi_current_lang = pll_current_language();
	}
	
	$kemroc_mi_enable_measure_units_switcher = 'en' === $kemroc_mi_current_lang;

	$kemroc_mi_drawing = wp_get_attachment_image(
		$kemroc_mi_drawing_id,
		'medium_large',
		false,
		array( 'alt' => wp_get_attachment_caption( $kemroc_mi_drawing_id ) )
	);

	$kemroc_mi_video_1_yt_available      = 'youtube' === $kemroc_mi_video['yt_or_file_load'] && ! empty( $kemroc_mi_video['id'] );
	$kemroc_mi_video_1_is_file_available = 'videofile' === $kemroc_mi_video['yt_or_file_load'] && ! empty( $kemroc_mi_video['videofile'] );
	$kemroc_mi_video_1_is_available      = $kemroc_mi_video_1_yt_available || $kemroc_mi_video_1_is_file_available;

	$kemroc_mi_video_2_yt_available      = $kemroc_mi_add_another_video && ( 'youtube' === $kemroc_mi_video_2['yt_or_file_load'] && ! empty( $kemroc_mi_video_2['id'] ) );
	$kemroc_mi_video_2_is_file_available = $kemroc_mi_add_another_video && ( 'videofile' === $kemroc_mi_video_2['yt_or_file_load'] && ! empty( $kemroc_mi_video_2['videofile'] ) );
	$kemroc_mi_video_2_is_available      = $kemroc_mi_video_2_yt_available || $kemroc_mi_video_2_is_file_available;

	$kemroc_mi_video_3_yt_available      = $kemroc_mi_add_another_video && ( 'youtube' === $kemroc_mi_video_3['yt_or_file_load'] && ! empty( $kemroc_mi_video_3['id'] ) );
	$kemroc_mi_video_3_is_file_available = $kemroc_mi_add_another_video && ( 'videofile' === $kemroc_mi_video_3['yt_or_file_load'] && ! empty( $kemroc_mi_video_3['videofile'] ) );
	$kemroc_mi_video_3_is_available      = $kemroc_mi_video_3_yt_available || $kemroc_mi_video_3_is_file_available;

	$kemroc_mi_video_4_yt_available      = $kemroc_mi_add_another_video && ( 'youtube' === $kemroc_mi_video_4['yt_or_file_load'] && ! empty( $kemroc_mi_video_4['id'] ) );
	$kemroc_mi_video_4_is_file_available = $kemroc_mi_add_another_video && ( 'videofile' === $kemroc_mi_video_4['yt_or_file_load'] && ! empty( $kemroc_mi_video_4['videofile'] ) );
	$kemroc_mi_video_4_is_available      = $kemroc_mi_video_4_yt_available || $kemroc_mi_video_4_is_file_available;

	$kemroc_mi_video_5_yt_available      = $kemroc_mi_add_another_video && ( 'youtube' === $kemroc_mi_video_5['yt_or_file_load'] && ! empty( $kemroc_mi_video_5['id'] ) );
	$kemroc_mi_video_5_is_file_available = $kemroc_mi_add_another_video && ( 'videofile' === $kemroc_mi_video_5['yt_or_file_load'] && ! empty( $kemroc_mi_video_5['videofile'] ) );
	$kemroc_mi_video_5_is_available      = $kemroc_mi_video_5_yt_available || $kemroc_mi_video_5_is_file_available;

	$kemroc_mi_video_poster = '';
	
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

	$kemroc_mi_video_2_poster = '';

	if ( $kemroc_mi_add_another_video ) {
		if ( ! empty( $kemroc_mi_video_2['poster'] ) ) {
			$kemroc_mi_video_2_poster = wp_get_attachment_image( 
				$kemroc_mi_video_2['poster'], 
				'full', 
				false, 
				array(
					'class' => 'lazy-video__poster',
					'alt'   => wp_get_attachment_caption( $kemroc_mi_video_2['poster'] ),
				) 
			); 
		}
	}   

	$kemroc_mi_video_3_poster = '';

	if ( $kemroc_mi_add_another_video ) {
		if ( ! empty( $kemroc_mi_video_3['poster'] ) ) {
			$kemroc_mi_video_3_poster = wp_get_attachment_image( 
				$kemroc_mi_video_3['poster'], 
				'full', 
				false, 
				array(
					'class' => 'lazy-video__poster',
					'alt'   => wp_get_attachment_caption( $kemroc_mi_video_3['poster'] ),
				) 
			); 
		}
	}   

	$kemroc_mi_video_4_poster = '';

	if ( $kemroc_mi_add_another_video ) {
		if ( ! empty( $kemroc_mi_video_4['poster'] ) ) {
			$kemroc_mi_video_4_poster = wp_get_attachment_image( 
				$kemroc_mi_video_4['poster'], 
				'full', 
				false, 
				array(
					'class' => 'lazy-video__poster',
					'alt'   => wp_get_attachment_caption( $kemroc_mi_video_4['poster'] ),
				) 
			); 
		}
	}
	
	$kemroc_mi_video_5_poster = '';

	if ( $kemroc_mi_add_another_video ) {
		if ( ! empty( $kemroc_mi_video_5['poster'] ) ) {
			$kemroc_mi_video_5_poster = wp_get_attachment_image( 
				$kemroc_mi_video_5['poster'], 
				'full', 
				false, 
				array(
					'class' => 'lazy-video__poster',
					'alt'   => wp_get_attachment_caption( $kemroc_mi_video_5['poster'] ),
				) 
			); 
		}
	}
	?>

	<section id="<?php echo esc_attr( $kemroc_mi_id ); ?>" class="<?php echo esc_attr( $kemroc_mi_class_name ); ?>">
		<div class="container model-info__content">
			<header class="model-info__head">
				<a href="<?php the_permalink( $kemroc_mi_parent_id ); ?>" class="above-title model-info__parent-page-name">
					<?php echo esc_html( $kemroc_mi_model_overhead_title ); ?>
				</a>
				<!-- /.model-info__parent-page-name -->
				<h1 class="model-info__title">
					<?php echo esc_html( $kemroc_mi_model_title ); ?>
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

					<?php if ( ! empty( $kemroc_mi_animation['file'] ) ) : ?>
						<div class="model-tabs__tab">
							<?php esc_html_e( '3D MODELL', 'kemroc' ); ?>
						</div>
						<!-- /.model-tabs__tab -->
					<?php endif; ?>

					<?php if ( $kemroc_mi_video_1_is_available ) : ?>
						<div class="model-tabs__tab">
							<?php esc_html_e( 'VIDEO', 'kemroc' ); ?>
						</div>
						<!-- /.model-tabs__tab -->
					<?php endif; ?>

					<?php if ( $kemroc_mi_photos && 0 < count( $kemroc_mi_photos ) ) : ?>
						<div class="model-tabs__tab">
							<?php esc_html_e( 'FOTOS', 'kemroc' ); ?>
						</div>
						<!-- /.model-tabs__tab -->
					<?php endif; ?>

				</div>
				<!-- /.model-tabs__head -->
				<div class="model-tabs__body">
					<div class="model-tabs__inset model-tabs__inset--visible">
						<div class="model-tabs__tech-info">

							<?php if ( $kemroc_mi_params ) : ?>  
								<div class="model-tabs__params-wrapper">
									<?php if ( $kemroc_mi_enable_measure_units_switcher ) : ?>
										<span id='mu-switcher' class="pml-model-card__title-swither">
											<?php esc_html_e( 'Maßeinheit:', 'kemroc' ); ?>
											<span class="mu-flag" data-lang-code="default"></span>
											<!-- /.mu-flag -->
											<span class="mu-flag" data-lang-code="us"></span>
											<!-- /.mu-flag -->
										</span>
										<!-- /.pml-model-card__title-swither -->
									<?php endif; ?>
							
									<ul class="model-tabs__params">

										<?php 
										foreach ( $kemroc_mi_params as $kemroc_mi_param ) : 
											if ( $kemroc_mi_param['title'] && $kemroc_mi_param['value'] ) :
												?>
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
														<span class="mu-value" data-lang-code="default">
															<?php 
															echo esc_html( $kemroc_mi_param['value'] ) . '&nbsp;';
															the_field( 'measure_units', $kemroc_mi_param['title']->ID )
															?>
														</span>
														<!-- /.mu-value -->		
														
														<?php if ( ! empty( $kemroc_mi_param['us_value'] ) ) : ?>
															<span class="mu-value" data-lang-code="us">
																<?php 
																echo esc_html( $kemroc_mi_param['us_value'] ) . '&nbsp;';
																the_field( 'us_measure_units', $kemroc_mi_param['title']->ID )
																?>
															</span>                                                            
															<!-- /.mu-value -->											
														<?php endif; ?>

													</div>
													<!-- /.arrow-list-item-full__value -->
												</li>
												<!-- /.model-tabs__param model-tabs-param -->
												<?php 
											endif;
										endforeach; 
										?>

									</ul>
									<!-- /.model-tabs__params -->

								</div>
								<!-- /.model-tabs__params-wrapper -->
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

					<?php if ( ! empty( $kemroc_mi_animation['file'] ) ) : ?>
						<?php
						$kemroc_mi_animation_poster_img = '';
						if ( $kemroc_mi_animation['poster'] ) : 
							$kemroc_mi_animation_poster_img = wp_get_attachment_url( $kemroc_mi_animation['poster'] ); 
						endif;
						?>
						<div class="model-tabs__inset">
							<div class="model-tabs__lazy-video model-tabs__lazy-video--animation lazy-video">
								<figure class="lazy-video__figure lazy-video__figure--file">
									<video 
										class="lazy-video__source lazy-video__source--model-page"
										src="<?php echo esc_url( $kemroc_mi_animation['file']['url'] ); ?>" 
										width="100%" 
										height="100%" 
										muted
										poster="<?php echo esc_url( $kemroc_mi_animation_poster_img ); ?>"
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

					<?php if ( $kemroc_mi_video_1_is_available ) : ?>
						<div class="model-tabs__inset">
							<div class="swiper model-tabs__slider swiper-single-slide swiper-single-slide--videos">
								<div class="swiper-wrapper swiper-single-slide__container">
									<?php if ( $kemroc_mi_video_1_is_available ) : ?>
										<?php if ( $kemroc_mi_video_1_yt_available ) : ?>
											<div class="swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video">
												<?php 
												get_template_part(
													'template-parts/videos/lazy-yt',
													null,
													array(
														'id' => $kemroc_mi_video['id'],
														'title' => $kemroc_mi_video['title'],
														'poster' => $kemroc_mi_video_poster,
													) 
												); 
												?>
											</div>
											<!-- /.swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video -->                                
										<?php elseif ( $kemroc_mi_video_1_is_file_available ) : ?>
											<?php 
											$kemroc_mi_video_poster_img = '';
											if ( $kemroc_mi_video['poster'] ) {
												$kemroc_mi_video_poster_img = wp_get_attachment_url( $kemroc_mi_video['poster'] ); 
											};
											?>
											<div class="swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video">
												<?php 
													get_template_part(
														'template-parts/videos/lazy-videofile',
														null,
														array(
															'videofile_url' => $kemroc_mi_video['videofile']['url'],
															'poster_image' => $kemroc_mi_video_poster_img,
														) 
													); 
												?>
											</div>
											<!-- /.swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video -->
										<?php endif; ?>
									<?php endif; ?>

									<?php if ( $kemroc_mi_video_2_is_available ) : ?>                           
										<?php if ( $kemroc_mi_video_2_yt_available ) : ?>
											<div class="swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video">
												<?php 
												get_template_part(
													'template-parts/videos/lazy-yt',
													null,
													array(
														'id' => $kemroc_mi_video_2['id'],
														'title' => $kemroc_mi_video_2['title'],
														'poster' => $kemroc_mi_video_2_poster,
													) 
												); 
												?>
											</div>
											<!-- /.swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video -->											
										<?php elseif ( $kemroc_mi_video_2_is_file_available ) : ?>
											<?php 
											$kemroc_mi_video_2_poster_img = '';
											if ( $kemroc_mi_video_2['poster'] ) {
												$kemroc_mi_video_2_poster_img = wp_get_attachment_url( $kemroc_mi_video_2['poster'] ); 
											};
											?>
											<div class="swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video">
												<?php 
													get_template_part(
														'template-parts/videos/lazy-videofile',
														null,
														array(
															'videofile_url' => $kemroc_mi_video_2['videofile']['url'],
															'poster_image' => $kemroc_mi_video_2_poster_img,
														) 
													); 
												?>
											</div>
											<!-- /.swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video -->
										<?php endif; ?>
									<?php endif; ?>

									<?php if ( $kemroc_mi_video_3_is_available ) : ?>                           
										<?php if ( $kemroc_mi_video_3_yt_available ) : ?>
											<div class="swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video">
												<?php 
												get_template_part(
													'template-parts/videos/lazy-yt',
													null,
													array(
														'id' => $kemroc_mi_video_3['id'],
														'title' => $kemroc_mi_video_3['title'],
														'poster' => $kemroc_mi_video_3_poster,
													) 
												); 
												?>
											</div>
											<!-- /.swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video -->	
										<?php elseif ( $kemroc_mi_video_3_is_file_available ) : ?>
											<?php 
											$kemroc_mi_video_3_poster_img = '';
											if ( $kemroc_mi_video_3['poster'] ) {
												$kemroc_mi_video_3_poster_img = wp_get_attachment_url( $kemroc_mi_video_3['poster'] ); 
											};
											?>
											<div class="swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video">
												<?php 
													get_template_part(
														'template-parts/videos/lazy-videofile',
														null,
														array(
															'videofile_url' => $kemroc_mi_video_3['videofile']['url'],
															'poster_image' => $kemroc_mi_video_3_poster_img,
														) 
													); 
												?>
											</div>
											<!-- /.swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video -->
										<?php endif; ?>
									<?php endif; ?>

									<?php if ( $kemroc_mi_video_4_is_available ) : ?>                           
										<?php if ( $kemroc_mi_video_4_yt_available ) : ?>
											<div class="swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video">
												<?php 
												get_template_part(
													'template-parts/videos/lazy-yt',
													null,
													array(
														'id' => $kemroc_mi_video_4['id'],
														'title' => $kemroc_mi_video_4['title'],
														'poster' => $kemroc_mi_video_4_poster,
													) 
												); 
												?>
											</div>
											<!-- /.swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video -->	
										<?php elseif ( $kemroc_mi_video_4_is_file_available ) : ?>
											<?php 
											$kemroc_mi_video_4_poster_img = '';
											if ( $kemroc_mi_video_4['poster'] ) {
												$kemroc_mi_video_4_poster_img = wp_get_attachment_url( $kemroc_mi_video_4['poster'] ); 
											};
											?>
											<div class="swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video">
												<?php 
													get_template_part(
														'template-parts/videos/lazy-videofile',
														null,
														array(
															'videofile_url' => $kemroc_mi_video_4['videofile']['url'],
															'poster_image' => $kemroc_mi_video_4_poster_img,
														) 
													); 
												?>
											</div>
											<!-- /.swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video -->
										<?php endif; ?>
									<?php endif; ?>

									<?php if ( $kemroc_mi_video_5_is_available ) : ?>                           
										<?php if ( $kemroc_mi_video_5_yt_available ) : ?>
											<div class="swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video">
												<?php 
												get_template_part(
													'template-parts/videos/lazy-yt',
													null,
													array(
														'id' => $kemroc_mi_video_5['id'],
														'title' => $kemroc_mi_video_5['title'],
														'poster' => $kemroc_mi_video_5_poster,
													) 
												); 
												?>
											</div>
											<!-- /.swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video -->	
										<?php elseif ( $kemroc_mi_video_5_is_file_available ) : ?>
											<?php 
											$kemroc_mi_video_5_poster_img = '';
											if ( $kemroc_mi_video_5['poster'] ) {
												$kemroc_mi_video_5_poster_img = wp_get_attachment_url( $kemroc_mi_video_5['poster'] ); 
											};
											?>
											<div class="swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video">
												<?php 
												get_template_part(
													'template-parts/videos/lazy-videofile',
													null,
													array(
														'videofile_url' => $kemroc_mi_video_5['videofile']['url'],
														'poster_image' => $kemroc_mi_video_5_poster_img,
													) 
												); 
												?>
											</div>
											<!-- /.swiper-slide swiper-single-slide__slide swiper-single-slide__slide--video -->
										<?php endif; ?>
									<?php endif; ?>

								</div>
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

					<?php if ( $kemroc_mi_photos && 0 < count( $kemroc_mi_photos ) ) : ?>
						<div class="model-tabs__inset">
							<div class="swiper model-tabs__slider swiper-single-slide swiper-single-slide--big-slider">
								<ul class="swiper-wrapper swiper-single-slide__container">

									<?php foreach ( $kemroc_mi_photos as $kemroc_mi_photo ) : ?>
										<?php 
										if ( ! $kemroc_mi_photo['photo'] ) {
											continue;
										} 
										?>
									
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
