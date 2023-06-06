<?php
/**
 * Serial Product Descriptions Block Template.
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
	$kemroc_spd_id = 'serial-product-descriptions-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_spd_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_spd_class_name = 'serial-product-descriptions';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_spd_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_spd_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_spd_serial_products = get_field( 'serial_products' );
	?>

	<section id="<?php echo esc_attr( $kemroc_spd_id ); ?>" class="<?php echo esc_attr( $kemroc_spd_class_name ); ?>">
		<div class="container serial-product-descriptions__content">
			
		<?php foreach ( $kemroc_spd_serial_products as $kemroc_spd_serial_product ) : ?>
			<div class="serial-product-descriptions__item">
				<h4 class="serial-product-descriptions__title">
					<?php echo esc_html( $kemroc_spd_serial_product['title'] ); ?>
				</h4>
				<!-- /.serial-product-descriptions__title -->
				<div class="serial-product-descriptions__description">
					<?php echo wp_kses_post( $kemroc_spd_serial_product['description'] ); ?>
				</div>
				<!-- /.serial-product-descriptions__description -->
			</div>
			<!-- /.serial-product-descriptions__item -->
		<?php endforeach; ?>

		</div>
		<!-- /.container serial-product-descriptions__content -->
	</section>
	<!-- /.serial-product-descriptions -->

	<?php
endif;
