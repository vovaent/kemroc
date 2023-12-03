<?php
/**
 * Front Page News Block Template.
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
	$kemroc_on_id = 'front-page-news-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_on_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_on_class_name = 'front-page-news bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_on_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_on_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_on_posts_per_page = get_field( 'posts_per_page' );

	$kemroc_on_args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 3,
	);

	if ( $kemroc_on_posts_per_page ) {
		$kemroc_on_args['posts_per_page'] = $kemroc_on_posts_per_page;
	}

	$kemroc_on_news = new WP_Query( $kemroc_on_args );
	?>

	<section id="<?php echo esc_attr( $kemroc_on_id ); ?>" class="<?php echo esc_attr( $kemroc_on_class_name ); ?>">
		<div class="container front-page-news__content">
			<div class="front-page-news__list">

				<?php
				if ( $kemroc_on_news->have_posts() ) :
					while ( $kemroc_on_news->have_posts() ) :
						$kemroc_on_news->the_post();

						get_template_part( 'template-parts/cards/news/new', 'card' );
					endwhile;
					wp_reset_postdata();
				endif;
				?>

			</div>
			<!-- /.front-page-news__list -->
		</div>
		<!-- /.container front-page-news__content -->
	</section>
	<!-- /.front-page-news -->
	<?php
endif;
