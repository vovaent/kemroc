<?php
/**
 * Series Tech Info Block Template.
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
	$kemroc_sti_id = 'series-tech-info-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_sti_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_sti_class_name = 'series-tech-info';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_sti_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_sti_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_sti_figure   = get_field( 'figure' );
	$kemroc_sti_features = get_field( 'features' );
	$kemroc_sti_areas    = get_field( 'areas' );
	$kemroc_sti_subtitle = get_field( 'subtitle' );
	$kemroc_sti_image    = get_field( 'image' );
	?>

	<section id="<?php echo esc_attr( $kemroc_sti_id ); ?>" class="<?php echo esc_attr( $kemroc_sti_class_name ); ?>">
		<div class="container series-tech-info__content">
			<section class="series-tech-info__features sti-features">
				<div class="sti-features__left">
					<h4 class="sti-title sti-features__title">
						<?php esc_html_e( 'Merkmale', 'kemroc' ); ?>
					</h4>
					<!-- /.sti-features__title -->
					<div class="sti-features__drawing tech-drawing">
						<div class="tech-drawing__info">
							<div class="tech-drawing__icon">
								<?php get_template_part( 'template-parts/icons/fi-br-comment-info' ); ?>
							</div>
							<!-- /.tech-drawing__icon -->
							<div class="tech-drawing__text">
								<?php echo esc_html( $kemroc_sti_figure['drawing_text'] ); ?>
							</div>
							<!-- /.tech-drawing__text -->
						</div>
						<!-- /.tech-drawing__info -->
						<?php echo wp_get_attachment_image( $kemroc_sti_figure['drawing'], 'medium_large' ); ?>
					</div>
					<!-- /.sti-features__drawing -->
				</div>
				<!-- /.sti-features__left -->
				<div class="sti-features__right">

					<?php if ( $kemroc_sti_features ) : ?>
						<ul class="sti-features__list">

							<?php foreach ( $kemroc_sti_features as $kemroc_sti_feature ) : ?>
								<li class="arrow-list-item sti-features__item">
									<span class="arrow-list-item__arrow">
										<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'fill' => '#FF6000' ) ); ?>
									</span>
									<!-- /.arrow-list-item__arrow -->
									<?php echo esc_html( $kemroc_sti_feature['feature'] ); ?>
								</li>
								<!-- /.arrow-list-item sti-features__item -->
							<?php endforeach; ?>

						</ul>
						<!-- /.sti-features__list -->      
					<?php endif; ?>
					
				</div>
				<!-- /.sti-features__right -->
			</section>
			<!-- /.series-tech-info__features -->
			<section class="series-tech-info__application-areas sti-application-areas">
				<h4 class="sti-title sti-application-areas__title">
					<?php esc_html_e( 'Einsatzgebiete', 'kemroc' ); ?>
				</h4>
				<!-- /.sti-application-areas__title -->

				<?php if ( $kemroc_sti_areas ) : ?>
					<ul class="sti-application-areas__list">

						<?php foreach ( $kemroc_sti_areas as $kemroc_sti_area ) : ?>
							<li class="arrow-list-item sti-application-areas__item">
								<span class="arrow-list-item__arrow">
									<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'fill' => '#FF6000' ) ); ?>
								</span>
								<!-- /.arrow-list-item__arrow -->
								<?php echo esc_html( $kemroc_sti_area['area'] ); ?>
							</li>
							<!-- /.arrow-list-item sti-application-areas__item -->
						<?php endforeach; ?>

					</ul>
					<!-- /.sti-application-areas__list -->
				<?php endif; ?>				
				
			</section>
			<!-- /.sti-application-areas -->
			<section class="series-tech-info__novelty sti-novelty">
				<div class="sti-novelty__left">
					<h4 class="sti-title sti-novelty__title">
						<?php esc_html_e( 'Weltneuheit', 'kemroc' ); ?>
					</h4>
					<!-- /.sti-novelty__title -->
					<div class="sti-novelty__subtitle">
						<?php echo esc_html( $kemroc_sti_subtitle ); ?>
					</div>
					<!-- /.sti-novelty__subtitle -->
				</div>
				<!-- /.sti-novelty__left -->
				<div class="sti-novelty__right">
					<div class="sti-novelty__scheme">
						<?php echo wp_get_attachment_image( $kemroc_sti_image, 'medium_large' ); ?>
					</div>
					<!-- /.sti-novelty__scheme -->
				</div>
				<!-- /.sti-novelty__right -->
			</section>
			<!-- /.series-tech-info__novelty sti-novelty -->
		</div>
		<!-- /.container series-tech-info__content -->
	</section>
	<!-- /.series-tech-info -->

	<?php
endif;
