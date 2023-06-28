<?php
/**
 * Product Technical Info Block Template.
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
	$kemroc_p_id = 'products-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_p_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_p_class_name = 'products bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_p_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_p_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	global $post;
	$kemroc_ca_page_slug  = $post->post_name;
	$kemroc_p_page_number = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	
	$kemroc_p_all_products_output_is_enabled = get_field( 'all_products_output_is_enabled' );
	$kemroc_p_products_per_page              = get_field( 'products_per_page' );
	$kemroc_p_parent_page_id                 = get_field( 'parent_page_id' );

	$kemroc_p_products_data = array(
		'postsPerPage'               => $kemroc_p_products_per_page,
		'parentPageId'               => $kemroc_p_parent_page_id,
		'pageNumber'                 => $kemroc_p_page_number,
		'pageSlug'                   => $kemroc_ca_page_slug,
		'allProductsOutputIsEnabled' => $kemroc_p_all_products_output_is_enabled 
											? $kemroc_p_all_products_output_is_enabled 
											: 0,
	);
	
	$kemroc_p_products_data_json = wp_json_encode( $kemroc_p_products_data );
	?>

	<script>
		var productsData = <?php echo $kemroc_p_products_data_json; // phpcs:ignore ?>
	</script>

	<section id="<?php echo esc_attr( $kemroc_p_id ); ?>" class="<?php echo esc_attr( $kemroc_p_class_name ); ?>">
		<div class="container products__content">
			<div class="products__list products__list--skeletons">

				<?php
				$kemroc_p_i = 1;

				while ( $kemroc_p_i++ <= $kemroc_p_products_per_page ) :
					?>
					<div class="products__item">

						<?php
						get_template_part(
							'template-parts/cards/product/product',
							'skeleton'
						);
						?>

					</div>
					<!-- /.products__item -->
					<?php
				endwhile;
				wp_reset_postdata();
				?>

			</div>
			<!-- /.products__list--skeletons -->
			<div class="products__list products__list--original"></div>
			<!-- /.products__list -->
			<div class="kemroc-navigation products__navigation"></div>
			<!-- /.kemroc-navigation products__navigation -->
		</div>
		<!-- /.container products__content -->
	</section>
	<!-- /.products -->

	<?php
endif;
