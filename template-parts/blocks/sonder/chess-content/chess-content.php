<?php
/**
 * Chess Content Block Template.
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
	$kemroc_cc_id = 'chess-content-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_cc_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_cc_class_name = 'chess-content bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_cc_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_cc_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_cc_left       = get_field( 'left' );
	$kemroc_cc_right      = get_field( 'right' );
	$kemroc_cc_image_type = $kemroc_cc_right['image_type'];
	$kemroc_cc_figcaption = ! empty( $kemroc_cc_right['caption'] ) 
								? $kemroc_cc_right['caption'] 
								: wp_get_attachment_caption( $kemroc_cc_right['image'] );
	?>

	<section id="<?php echo esc_attr( $kemroc_cc_id ); ?>" class="<?php echo esc_attr( $kemroc_cc_class_name ); ?>">
		<div class="container chess-content__content">
			<div class="chess-content__left cc-left">
				<div class="cc-left__text">
					<h2 class="cc-left__title">
						<?php echo wp_kses_post( $kemroc_cc_left['title'] ); ?>
					</h2>
					<!-- /.cc-left__title -->
					<div class="cc-left__description">
						<?php echo esc_html( $kemroc_cc_left['description'] ); ?>
					</div>
					<!-- /.cc-left__description -->
				</div>
				<!-- /.cc-left__text -->				
				<div class="cc-left__image">
					<?php echo wp_get_attachment_image( $kemroc_cc_left['image'], 'medium_large' ); ?>
				</div>
				<!-- /.cc-left__image -->
			</div>
			<!-- /.chess-content__left -->
			<div class="chess-content__right cc-right">
				
				<?php if ( 'simple' === $kemroc_cc_image_type ) : ?>
					<div class="cc-right__image">
						<?php echo wp_get_attachment_image( $kemroc_cc_right['image'], 'medium_large' ); ?>
					</div>
					<!-- /.cc-right__image -->
				<?php elseif ( 'drawing' === $kemroc_cc_image_type ) : ?>
					<figure class="cc-right__figure">
						<div class="cc-right__image">
							<?php echo wp_get_attachment_image( $kemroc_cc_right['image'], 'medium_large' ); ?>
						</div>
						<!-- /.cc-right__image -->
						<figcaption class="cc-right__image-caption">
							<?php echo esc_html( $kemroc_cc_figcaption ); ?>
						</figcaption>
					</figure>
					<!-- /.cc-right__figure -->
				<?php endif; ?>

				<div class="cc-right__description">
					<?php echo wp_kses_post( $kemroc_cc_right['description'] ); ?>
				</div>
				<!-- /.cc-right__description -->
			</div>
			<!-- /.chess-content__right -->
		</div>
		<!-- /.container chess-content__content -->
	</section>
	<!-- /.chess-content -->

	<?php
endif;
