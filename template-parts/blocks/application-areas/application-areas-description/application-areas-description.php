<?php
/**
 * Application Areas Description Block Template.
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
	$kemroc_aad_id = 'application-areas-description-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_aad_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_aad_class_name = 'application-areas-description bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_aad_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_aad_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_aad_accent_text = get_field( 'accent_text' );
	$kemroc_aad_simple_text = get_field( 'simple_text' );
	?>

	<section id="<?php echo esc_attr( $kemroc_aad_id ); ?>" class="<?php echo esc_attr( $kemroc_aad_class_name ); ?>">
		<div class="container fifty-fifty-description application-areas-description__content">
			<div class="fifty-fifty-description__accent-text">
				<?php echo wp_kses_post( $kemroc_aad_accent_text ); ?>
			</div>
			<!-- /.fifty-fifty-description__accent-text -->
			<div class="fifty-fifty-description__text">
				<?php echo wp_kses_post( $kemroc_aad_simple_text ); ?>
			</div>
			<!-- /.fifty-fifty-description__text -->
		</div>
		<!-- /.container application-areas-description__content -->
	</section>
	<!-- /.application-areas-description -->

	<?php
endif;
