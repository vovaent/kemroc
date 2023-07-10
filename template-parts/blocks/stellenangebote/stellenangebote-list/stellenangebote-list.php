<?php

/**
 * Stellenangebote list Block Template.
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
	$kemroc_sl_id = 'stellenangebote-list-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_sl_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_sl_class_name = 'stellenangebote-list';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_sl_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_sl_class_name .= ' align' . $block['align'];
	}

	$kemroc_sl_parent_page = get_field( 'parent_page' );

	$kemroc_sl_current    = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	$kemroc_sl_the_query  = new WP_Query(
		array(
			'post_type'      => 'page',
			'posts_per_page' => 6,
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_parent'    => $kemroc_sl_parent_page,
			'paged'          => $kemroc_sl_current,
		)
	);
    $kemroc_sl_navigation = kemroc_get_the_posts_pagination( //phpcs:ignore
		array(
			'class'     => 'kemroc-navigation',
			'prev_text' => '', 
			'next_text' => '',
		),
		$kemroc_sl_the_query,
		$kemroc_sl_current
	);
	?>

	<section id="<?php echo esc_attr( $kemroc_sl_id ); ?>" class="jobs">
		<div class="container">
			<div class="jobs-list">
				<?php if ( $kemroc_sl_the_query->have_posts() ) : ?>
					<?php 
					while ( $kemroc_sl_the_query->have_posts() ) :
						$kemroc_sl_the_query->the_post(); 
						?>
						<?php
						$post_dringlichkeit = get_field( 'dringlichkeit', get_the_ID() );
						?>
						<a href="<?php the_permalink(); ?>" class="jobs-list__item">
							<div class="item-subtitle"><?php esc_html_e( 'Bereichern Sie unser Team als', 'kemroc' ); ?></div>
							<h5 class="item-title"><?php echo get_the_title(); ?></h5>
							<div class="item-bottom">
								<?php if ( $post_dringlichkeit ) : ?>
									<div class="job-category"><?php echo $post_dringlichkeit; ?></div>
								<?php endif; ?>
								<div class="job-link"><svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z" fill="#FF6000" />
									</svg>
								</div>
							</div>
						</a>
						<?php 
					endwhile;
					wp_reset_postdata(); 
				endif;
				?>
			</div>
			<div class="jobs-navigation">
				<?php echo wp_kses_post( $kemroc_sl_navigation ); ?>
			</div>
		</div>
	</section>
	<?php
endif;
