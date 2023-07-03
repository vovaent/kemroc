<?php
/**
 * Application Areas Filter Block Template.
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
	$kemroc_aaf_id = 'application-areas-filter-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_aaf_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_aaf_class_name = 'application-areas-filter bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_aaf_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_aaf_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_aaf_title            = get_field( 'title' );
	$kemroc_aaf_application_area = get_field( 'application_area' );
	
	$kemroc_aaf_term_children = get_term_children( $kemroc_aaf_application_area->term_id, $kemroc_aaf_application_area->taxonomy );

	$kemroc_aaf_models_args  = array(
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'posts_per_page' => -1, //phpcs:ignore
		'tax_query'      => array( //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			array(
				'taxonomy' => $kemroc_aaf_application_area->taxonomy,
				'terms'    => $kemroc_aaf_term_children,
			),
		),
	);
	$kemroc_aaf_models_query = new WP_Query( $kemroc_aaf_models_args );
	?>

	<section id="<?php echo esc_attr( $kemroc_aaf_id ); ?>" class="<?php echo esc_attr( $kemroc_aaf_class_name ); ?>">
		<div class="application-areas-filter__content">
			<div class="container application-areas-filter__title-container">
				<h2 class="application-areas-filter__title">
					<?php echo esc_html( $kemroc_aaf_title ); ?>
				</h2>
				<!-- /.application-areas-filter__title -->
			</div>
			<!-- /.container application-areas-filter__title-container -->

			<?php if ( $kemroc_aaf_term_children ) : ?>
				<div class="scroll-list-wrapper application-areas-filter__areas-list-wrapper">
					<div class="container application-areas-filter__areas-list-container">
						<ul class="filter-btns application-areas-filter__areas-list">
							<li 
								class="application-areas-filter__areas-item"
								data-term-id="all"
							>
								<button class="filter-btn filter-btn--active">
									<?php esc_html_e( 'Alle', 'kemroc' ); ?>
								</button>
							</li>
							<!-- /.application-areas-filter__areas-item -->
							
							<?php 
							foreach ( $kemroc_aaf_term_children as $kemroc_aaf_term_child ) : 
								$kemroc_aaf_term_obj = get_term( $kemroc_aaf_term_child, $kemroc_aaf_application_area->taxonomy );
								?>
								<li 
									class="application-areas-filter__areas-item" 
									data-term-id="<?php echo esc_attr( $kemroc_aaf_term_child ); ?>"
								>
									<button class="filter-btn">
										<?php echo esc_html( $kemroc_aaf_term_obj->name ); ?>
									</button>
								</li>
								<!-- /.application-areas-filter__areas-item -->
								<?php 
							endforeach; 
							?>
														
						</ul>
						<!-- /.application-areas-filter__areas-list -->
					</div>
					<!-- /.container application-areas-filter__areas-list-container -->        
				</div>
				<!-- /.application-areas-filter__areas-list-wrapper -->   
			<?php endif; ?>

			<?php if ( $kemroc_aaf_models_query->have_posts() ) : ?>
				<div class="container application-areas-filter__list-container">
					<ul class="application-areas-filter__models-list">

						<?php 
						while ( $kemroc_aaf_models_query->have_posts() ) :
							$kemroc_aaf_models_query->the_post();
							
							$kemroc_aaf_model_id      = get_the_ID();
							$kemroc_aaf_model_weight  = get_field( 'weight', $kemroc_aaf_model_id );
							$kemroc_aaf_model_terms   = get_the_terms( $kemroc_aaf_model_id, $kemroc_aaf_application_area->taxonomy );
							$kemroc_aaf_model_term_id = isset( $kemroc_aaf_model_terms[0] ) ? $kemroc_aaf_model_terms[0]->term_id : null;
							?>
							<li 
								class="application-areas-filter__model-item application-areas-item application-areas-item--model"
								data-term-id="<?php echo esc_attr( $kemroc_aaf_model_term_id ); ?>"
							>
								<a href="<?php the_permalink(); ?>" class="application-areas-item__link">
									<figure class="application-areas-item__figure application-areas-item__figure--model">
										<?php echo get_the_post_thumbnail( $kemroc_aaf_model_id, 'post-thumbnail', array( 'class' => 'application-areas-item__image' ) ); ?>
										<figcaption class="application-areas-item__caption">
											<h6 class="application-areas-item__title application-areas-item__title--model">
												<?php the_title(); ?>
											</h6>
											<!-- /.application-areas-item__title -->
											<p class="application-areas-item__weight">
												<span class="application-areas-item__weight-icon">
													<?php get_template_part( 'template-parts/icons/weights' ); ?>
												</span>
												<!-- /.application-areas-item__weight-icon -->
												<span class="application-areas-item__weight-text">
													<?php echo esc_html( $kemroc_aaf_model_weight ); ?>
												</span>
												<!-- /.application-areas-item__weight-text -->
											</p>
											<!-- /.application-areas-item__weight -->
										</figcaption>
										<!-- /.application-areas-item__caption -->
										<p class="pseudo-link application-areas-item__pseudo-link application-areas-item__pseudo-link--model">
											<?php esc_html_e( 'Mehr', 'kemroc' ); ?>
											<?php get_template_part( 'template-parts/icons/arrow', 'right', array( 'fill' => '#ff6000' ) ); ?>
										</p>
										<!-- /.application-areas-item__pseudo-link -->
									</figure>
									<!-- /.application-areas-item__figure -->
								</a>
								<!-- /.application-areas-item__link -->
							</li>
							<!-- /.application-areas-filter__model-item -->
							<?php 
						endwhile; 
						wp_reset_postdata();
						?>
						
					</ul>
					<!-- /.application-areas-filter__models-list -->
				</div>
				<!-- /.container application-areas-filter__list-container -->
			<?php endif; ?>

		</div>
		<!-- /.container application-areas-filter__content -->
	</section>
	<!-- /.application-areas-filter -->

	<?php
endif;
