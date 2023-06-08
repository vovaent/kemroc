<?php
/**
 * Series General Info Block Template.
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
	$kemroc_sti_id = 'series-tech-info-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_sti_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_sti_class_name = 'series-tech-info';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_sti_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_sti_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.

	?>

	<section id="<?php echo esc_attr( $kemroc_sti_id ); ?>" class="<?php echo esc_attr( $kemroc_sti_class_name ); ?>">
		<div class="container series-tech-info__content">

		</div>
		<!-- /.container series-tech-info__content -->
	</section>
	<!-- /.series-tech-info -->

	<?php
endif;
