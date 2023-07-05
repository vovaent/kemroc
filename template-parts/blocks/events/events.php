<?php
/**
 * Termine Block Template.
 */

global $wp_query;
if ( isset( $block['data']['gutenberg_preview_image'] ) && $is_preview ) {
	echo '<img src="' . esc_url( $block['data']['gutenberg_preview_image'] ) . '" style="max-width:100%; height:auto;">';
}

if ( ! $is_preview ) :
	// Create id attribute allowing for custom "anchor" value.
	$kemroc_termine_id = 'termine-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_faq_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_termine_class_name = 'termine';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_termine_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_termine_class_name .= ' align' . $block['align'];
	}


	?>
	<?php
	$current = absint(
		max(
			1,
			get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' )
		)
	);
	?>

	<?php
	$the_query = new WP_Query(
		array(
			'post_type'      => 'termin',
			'posts_per_page' => 6,
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'ASC',
			'paged'          => $current,
		)
	);
	?>

	<section id="<?php echo esc_attr( $kemroc_termine_id ); ?>"
		class="<?php echo esc_attr( $kemroc_termine_class_name ); ?>">
		<div class="container">
			<?php if ( $the_query->have_posts() ) { ?>
				<div class="events-list">
					<?php
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						$datum = get_field( 'datum', get_the_ID() );
						?>
						<div href="<?php the_permalink(); ?>" class="events-list__item">
							<div class="item-date">
								<img src="<?php echo get_template_directory_uri() . '/images/icon-calendar.svg'; ?>"
									alt="icon-calendar">
								<span>
									<?php echo $datum; ?>
								</span>
							</div>
							<h6 class="item-title">
								<?php the_title(); ?>
							</h6>
						</div>
					<?php endwhile; ?>
				</div>
				<?php
				wp_reset_postdata();
				$restore_wp_query = $wp_query;
				$wp_query         = $the_query;
				?>
				<?php
				$args = array(
					'show_all'           => false,
					'end_size'           => 1,
					'mid_size'           => 1,
					'prev_next'          => true,
					'prev_text'          => __( '' ),
					'next_text'          => __( '' ),
					'add_args'           => false,
					'add_fragment'       => '',
					'screen_reader_text' => __( 'Posts navigation' ),
					'class'              => 'pagination',
				);
				the_posts_pagination( $args );
				?>
			<?php } ?>
		</div>
	</section>
	<?php
endif;
