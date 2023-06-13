<?php
/**
 * Full-width Image Rounded Block Template.
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
	$kemroc_fwir_id = 'fw-image-rounded-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_fwir_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_fwir_class_name = 'fw-image-rounded bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_fwir_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_fwir_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_fwir_image = get_field( 'image' );
	?>

	<section id="<?php echo esc_attr( $kemroc_fwir_id ); ?>" class="<?php echo esc_attr( $kemroc_fwir_class_name ); ?>">
		<div class="container fw-image-rounded__content">
			<?php echo wp_get_attachment_image( $kemroc_fwir_image, 'full' ); ?>
		</div>
		<!-- /.container fw-image-rounded__content -->
	</section>
	<!-- /.fw-image-rounded -->

	<?php
endif;
