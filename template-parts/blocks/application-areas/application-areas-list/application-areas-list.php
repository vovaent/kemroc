<?php
/**
 * Application Areas List Block Template.
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
	$kemroc_aal_id = 'application-areas-list-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_aal_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_aal_class_name = 'application-areas-list bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_aal_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_aal_class_name .= ' align' . $block['align'];
	}

	$kemroc_aal_parent_page_id = get_field( 'parent_page_id' );

	// Load values and assing defaults.
	if ( $kemroc_aal_parent_page_id ) {
		$kemroc_aal_args  = array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => -1, // phpcs:ignore
			'post_parent'    => $kemroc_aal_parent_page_id,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		);
		$kemroc_aal_areas = new WP_Query( $kemroc_aal_args );
	}
	?>

	<?php if ( $kemroc_aal_parent_page_id ) : ?>
		<section id="<?php echo esc_attr( $kemroc_aal_id ); ?>" class="<?php echo esc_attr( $kemroc_aal_class_name ); ?>">
			<div class="container application-areas-list__content">

				<?php if ( $kemroc_aal_areas ) : ?>
					<ul class="application-areas-list__list">

						<?php
						while ( $kemroc_aal_areas->have_posts() ) : 
							$kemroc_aal_areas->the_post();
							
							$kemroc_aal_post_id = get_the_ID();
							?>
							<li class="application-areas-list__item application-areas-item">
								<a href="<?php the_permalink( $kemroc_aal_post_id ); ?>" class="application-areas-item__link">
									<figure class="application-areas-item__figure">
										<?php echo get_the_post_thumbnail( $kemroc_aal_post_id, array( '270', '340' ), array( 'class' => 'application-areas-item__image' ) ); ?>
										<figcaption class="application-areas-item__caption">
											<p class="application-areas-item__title">
												<?php the_title(); ?>
											</p>
											<!-- /.application-areas-item__title -->										
										</figcaption>
										<!-- /.application-areas-item__caption -->
										<p class="pseudo-link application-areas-item__pseudo-link">
											<?php esc_html_e( 'Mehr', 'kemroc' ); ?>
											<?php get_template_part( 'template-parts/icons/arrow', 'right', array( 'fill' => '#ff6000' ) ); ?>
										</p>
										<!-- /.application-areas-item__pseudo-link -->
									</figure>
									<!-- /.application-areas-item__figure -->
								</a>
								<!-- /.application-areas-item__link -->
							</li>
							<!-- /.application-areas-list__item -->
							<?php 
						endwhile;
						wp_reset_postdata() 
						?>

					</ul>
					<!-- /.application-areas-list__list -->
				<?php endif; ?>				

			</div>
			<!-- /.container application-areas-list__content -->
		</section>
		<!-- /.application-areas-list -->
	<?php endif; ?>
	<?php
endif;
