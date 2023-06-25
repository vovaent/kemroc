<?php
/**
 * Current articles Block Template.
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
	$kemroc_ca_id = 'current-articles-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_ca_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_ca_class_name = 'current-articles bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_ca_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_ca_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_ca_articles_categories = get_categories();
	
	$kemroc_ca_posts_per_page = get_option( 'posts_per_page' );
	$kemroc_ca_page_number    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$kemroc_ca_articles_args  = array(
		'post_type'      => 'post',
		'post_status'    => 'published',
		'posts_per_page' => $kemroc_ca_posts_per_page,
		'paged'          => $kemroc_ca_page_number,
	);
	$kemroc_ca_articles_query = new WP_Query( $kemroc_ca_articles_args );
	$kemroc_ca_max_page       = $kemroc_ca_articles_query->max_num_pages;
	$kemroc_ca_prev_arrow     = kemroc_get_template_part_content(
		'template-parts/icons/arrow-left',
		null,
		array( 'fill' => '#ff6000' ) 
	);
	$kemroc_ca_next_arrow     = kemroc_get_template_part_content(
		'template-parts/icons/arrow-right',
		null,
		array( 'fill' => '#ff6000' ) 
	);

    $kemroc_ca_navigation = kemroc_get_the_posts_pagination( //phpcs:ignore
		array(
			'class'     => 'kemroc-navigation',
			'prev_text' => $kemroc_ca_prev_arrow, 
			'next_text' => $kemroc_ca_next_arrow,
		),
		$kemroc_ca_articles_query 
	);
	
	global $post;
	$kemroc_ca_page_slug = $post->post_name;
	?>

	<script>
		var page_number = "<?php echo esc_html( $kemroc_ca_page_number ); ?>";
		var max_page = "<?php echo esc_html( $kemroc_ca_max_page ); ?>";
		var posts_per_page = "<?php echo esc_html( $kemroc_ca_posts_per_page ); ?>";
		var page_slug = "<?php echo esc_html( $kemroc_ca_page_slug ); ?>";
	</script>

	<section id="<?php echo esc_attr( $kemroc_ca_id ); ?>" class="<?php echo esc_attr( $kemroc_ca_class_name ); ?>">
		<div class="container current-articles__content">

			<?php if ( $kemroc_ca_articles_categories ) : ?>
				<ul class="current-articles__categories-list">

					<?php foreach ( $kemroc_ca_articles_categories as $kemroc_ca_articles_category_key => $kemroc_ca_articles_category_value ) : ?>
						<?php
						$kemroc_ca_categories_item_class = 'current-articles__categories-item';
						if ( 0 === $kemroc_ca_articles_category_key ) {
							$kemroc_ca_categories_item_class .= ' current-articles__categories-item--active';
						}
						?>
						<li class="<?php echo esc_attr( $kemroc_ca_categories_item_class ); ?>">
							<?php echo esc_html( $kemroc_ca_articles_category_value->name ); ?>
						</li>
						<!-- /.current-articles__categories-item -->
					<?php endforeach; ?>

				</ul>
				<!-- /.current-articles__categories-list -->               
			<?php endif; ?>

			<div class="current-articles__list">
				
				<?php 
				if ( $kemroc_ca_articles_query->have_posts() ) :
					while ( $kemroc_ca_articles_query->have_posts() ) :
						$kemroc_ca_articles_query->the_post(); 
					
						echo kemroc_get_template_part_content( //phpcs:ignore
							'template-parts/cards/article', 
							null, 
							array( 'class' => 'current-articles__item' ) 
						);
					endwhile; 
					wp_reset_postdata(); 
				endif; 
				?>

				</div>
				<!-- /.current-articles__list -->                

			<div class="current-articles__navigation">

				<?php if ( $kemroc_ca_navigation ) : ?>
					<?php echo $kemroc_ca_navigation; //phpcs:ignore ?>
				<?php endif; ?>
				
			</div>
			<!-- /.current-articles__navigation -->

		</div>
		<!-- /.container current-articles__content -->
	</section>
	<!-- /.current-articles -->

	<?php 
endif;
