<?php
/**
 * Our Team Block Template.
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
	$kemroc_ot_id = 'our-team-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_ot_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_ot_class_name = 'our-team bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_ot_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_ot_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_ot_section_title = get_field( 'section_title' );
	$kemroc_ot_cta           = get_field( 'cta' );

	$kemroc_ot_args  = array(
		'post_type'      => 'member',
		'post_status'    => 'publish',
		'posts_per_page' => -1, // phpcs:ignore
		'order'          => 'ASC',
	);
	$kemroc_ot_query = new WP_Query( $kemroc_ot_args );
	?>

	<section id="<?php echo esc_attr( $kemroc_ot_id ); ?>" class="<?php echo esc_attr( $kemroc_ot_class_name ); ?>">
		<div class="container our-team__content">
			<?php if ( 'h2' === $kemroc_ot_section_title['title_size'] ) : ?>
				<h2 class="our-team__title our-team__title--h2">
					<?php echo esc_html( $kemroc_ot_section_title['title'] ); ?>
				</h2>
			<?php elseif ( 'h4' === $kemroc_ot_section_title['title_size'] ) : ?>
				<h4 class="our-team__title our-team__title--h4">
					<?php echo esc_html( $kemroc_ot_section_title['title'] ); ?>
				</h4>
			<?php endif; ?>
			<!-- /.our-team__title -->
			
			<?php if ( $kemroc_ot_query->have_posts() ) : ?>
				<ul class="our-team__list">
					<?php
					while ( $kemroc_ot_query->have_posts() ) : 
						$kemroc_ot_query->the_post();
						
						$kemroc_ot_this_id       = get_the_ID();
						$kemroc_ot_langs         = get_field( 'languages', $kemroc_ot_this_id );
						$kemroc_ot_position      = get_field( 'position', $kemroc_ot_this_id );
						$kemroc_ot_phone_number  = get_field( 'phone_number', $kemroc_ot_this_id );
						$kemroc_ot_mobile_number = get_field( 'mobile_number', $kemroc_ot_this_id );
						$kemroc_ot_email         = get_field( 'email', $kemroc_ot_this_id );
						?>
						<li class="our-team__item member-card">
							<div class="member-card__personal-info">
								<div class="member-card__langs member-card__langs--pc">
									<span class="member-card__langs-text">
										<?php esc_html_e( 'Sprachen', 'kemroc' ); ?> 
									</span>
									<!-- /.member-card__langs-text -->

									<?php if ( $kemroc_ot_langs ) : ?>
										<ul class="member-card__langs-list">

											<?php foreach ( $kemroc_ot_langs as $kemroc_ot_lang ) : ?>
												<li class="member-card__langs-item">
													<?php echo get_the_post_thumbnail( $kemroc_ot_lang ); ?>
												</li>
												<!-- /.member-card__langs-item -->									   
											<?php endforeach; ?>
											
										</ul>
										<!-- /.member-card__langs-list -->								
									<?php endif; ?>

								</div>
								<!-- /.member-card__langs -->
								<div class="member-card__avatar">
									<?php echo get_the_post_thumbnail(); ?>
								</div>
								<!-- /.member-card__avatar -->
								<div class="member-card__inner">
									<div class="member-card__langs member-card__langs--tab">
										<span class="member-card__langs-text">
											<?php esc_html_e( 'Sprachen', 'kemroc' ); ?> 
										</span>
										<!-- /.member-card__langs-text -->
										
										<?php if ( $kemroc_ot_langs ) : ?>
											<ul class="member-card__langs-list">

												<?php foreach ( $kemroc_ot_langs as $kemroc_ot_lang ) : ?>
													<li class="member-card__langs-item">
														<?php echo get_the_post_thumbnail( $kemroc_ot_lang ); ?>
													</li>
													<!-- /.member-card__langs-item -->									   
												<?php endforeach; ?>
												
											</ul>
											<!-- /.member-card__langs-list -->								
										<?php endif; ?>
							
									</div>
									<!-- /.member-card__langs -->
									<div class="member-card__name">
										<?php the_title(); ?>
									</div>
									<!-- /.member-card__name -->
									<div class="member-card__position">
										<?php echo esc_html( $kemroc_ot_position ); ?>
									</div>
									<!-- /.member-card__position -->
								</div>
								<!-- /.member-card__inner -->
							</div>
							<!-- /.member-card__personal-info -->
							<div class="member-card__contacts">
								<div class="member-card__numbers">
									<?php if ( $kemroc_ot_phone_number ) : ?>
										<div class="member-card__phone-number">
											<?php get_template_part( 'template-parts/icons/phone' ); ?>
											<a href="tel:<?php echo esc_html( $kemroc_ot_phone_number ); ?>">
												<?php echo esc_html( $kemroc_ot_phone_number ); ?>
											</a>
										</div>
										<!-- /.member-card__phone-number -->
									<?php endif; ?>

									<?php if ( $kemroc_ot_mobile_number ) : ?>
										<div class="member-card__mobile-number">
											<?php esc_html_e( 'mob.:', 'kemroc' ); ?>
											<a href="tel:<?php echo esc_html( $kemroc_ot_mobile_number ); ?>">
												<?php echo esc_html( $kemroc_ot_mobile_number ); ?>
											</a>
										</div>
										<!-- /.member-card__mobile-number -->
									<?php endif; ?>

								</div>
								<!-- /.member-card__numbers -->

								<?php if ( $kemroc_ot_email ) : ?>
									<div class="member-card__email">
										<?php get_template_part( 'template-parts/icons/email' ); ?>
										<a href="mailto:<?php echo esc_html( $kemroc_ot_email ); ?>">
											<?php echo esc_html( $kemroc_ot_email ); ?>
										</a>										
									</div>
									<!-- /.member-card__email -->
								<?php endif; ?>

							</div>
							<!-- /.member-card__contacts -->
						</li>
						<!-- /.our-team__item member-card --> 
						<?php 
						endwhile;
						wp_reset_postdata();
					?>
				</ul>
				<!-- /.our-team__list -->
			<?php endif; ?>

			<?php if ( $kemroc_ot_cta['show_cta'] ) : ?>
				<div class="our-team__cta">
					<div class="our-team__cta-content">
						<div class="our-team__cta-logo">
							<?php get_template_part( 'template-parts/icons/logo', 'mini' ); ?>
						</div>
						<!-- /.our-team__cta-logo -->
						<div class="our-team__cta-text">
							<?php echo esc_html( $kemroc_ot_cta['text'] ); ?>
						</div>
						<!-- /.our-team__cta-text -->
					</div>
					<!-- /.our-team__cta-text -->
					<a href="<?php echo esc_url( $kemroc_ot_cta['link']['url'] ); ?>" class="btn btn-accent btn-rounded arrow-right our-team__cta-btn">
						<?php echo esc_html( $kemroc_ot_cta['link']['title'] ); ?>
					</a>
					<!-- /.our-team__cta-btn -->
				</div>
				<!-- /.our-team__cta -->
			<?php endif; ?>
			
		</div>
		<!-- /.container our-team__content -->
	</section>
	<!-- /.our-team -->

	<?php
	endif;
