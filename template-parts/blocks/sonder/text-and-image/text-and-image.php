<?php
/**
 * Text And Image Block Template.
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
	$kemroc_tai_id = 'text-and-image-block-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_tai_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_tai_class_name = 'text-and-image-block bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_tai_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_tai_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_tai_text       = get_field( 'text' );
	$kemroc_tai_image_data = get_field( 'image_data' );
	?>

	<section id="<?php echo esc_attr( $kemroc_tai_id ); ?>" class="<?php echo esc_attr( $kemroc_tai_class_name ); ?>">
		<div class="container text-and-image-block__content text-and-image-block__content--<?php echo esc_html( $kemroc_tai_image_data['location_of_image'] ); ?>">

			<?php if ( $kemroc_tai_text ) : ?>
				<div class="text-and-image-block__text text-and-image-block__text--<?php echo esc_html( $kemroc_tai_image_data['location_of_image'] ); ?>">				
					<?php echo wp_kses_post( $kemroc_tai_text ); ?>
				</div>
				<!-- /.text-and-image-block__text -->
			<?php endif; ?>

			<?php if ( $kemroc_tai_image_data && ! empty( $kemroc_tai_image_data['image'] ) ) : ?>
				<div class="text-and-image-block__image text-and-image-block__image--<?php echo esc_html( $kemroc_tai_image_data['location_of_image'] ); ?>">
					<?php echo wp_get_attachment_image( $kemroc_tai_image_data['image'], 'full' ); ?>
				</div>
				<!-- /.text-and-image-block__drawing tech-drawing -->
			<?php endif; ?>

		</div>
		<!-- /.container text-and-image-block__content -->
	</section>
	<!-- /.text-and-image-block -->

	<?php
endif;
