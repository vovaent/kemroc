<?php
/**
 * Termine Block Template.
 * 
 * @package kemroc
 */

if ( isset( $block['data']['gutenberg_preview_image'] ) && $is_preview ) {
	echo '<img src="' . esc_url( $block['data']['gutenberg_preview_image'] ) . '" style="max-width:100%; height:auto;">';
}

if ( ! $is_preview ) :
	// Create id attribute allowing for custom "anchor" value.
	$kemroc_tr_id = 'termine-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_faq_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_tr_class_name = 'termine';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_tr_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_tr_class_name .= ' align' . $block['align'];
	}


	?>
	<?php
	$kemroc_tr_current = absint(
		max(
			1,
			get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' )
		)
	);
	?>

	<?php
	$kemroc_tr_the_query = new WP_Query(
		array(
			'post_type'      => 'termin',
			'posts_per_page' => 6,
			'post_status'    => 'publish',
			'paged'          => $kemroc_tr_current,
			'meta_key'       => 'start_date',//phpcs:ignore
			'orderby'        => 'meta_value_num',
			'order'          => 'ASC',
		)
	);
    $navigation = kemroc_get_the_posts_pagination( //phpcs:ignore
		array(
			'class'     => 'kemroc-navigation',
			'prev_text' => '', 
			'next_text' => '',
		),
		$kemroc_tr_the_query,
		$kemroc_tr_current
	);
	?>

	<section id="<?php echo esc_attr( $kemroc_tr_id ); ?>"
		class="<?php echo esc_attr( $kemroc_tr_class_name ); ?>">
		<div class="container">
			<?php if ( $kemroc_tr_the_query->have_posts() ) { ?>
				<div class="events-list">
					<?php while ( $kemroc_tr_the_query->have_posts() ) : ?>
						<?php
						$kemroc_tr_the_query->the_post();

						$start_date = get_field( 'start_date', get_the_ID() );
						$end_date   = get_field( 'end_date', get_the_ID() );

						$start_date_day = substr( $start_date, -2 );
						$datum          = $start_date_day . '. - ' . $end_date;
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
				?>
				<div class="jobs-navigation">
					<?php echo $navigation; ?>
				</div>
			<?php } ?>
		</div>
	</section>
	<?php
endif;
