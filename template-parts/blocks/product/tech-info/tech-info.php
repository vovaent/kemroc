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
	$kemroc_pti_id = 'product-tech-info-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_pti_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_pti_class_name = 'product-tech-info bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_pti_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_pti_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_pti_figure = get_field( 'figure' );
	?>

	<section class="product-tech-info">
		<div class="container product-tech-info__content">
			<div class="product-tech-info__text">
				<h3 class="product-tech-info__title">
					<?php echo wp_kses_post( get_field( 'title' ) ); ?>
				</h3>
				<!-- /.product-tech-info__title -->
				<div class="product-tech-info__description">
					<?php echo wp_kses_post( get_field( 'description' ) ); ?>
				</div>
				<!-- /.product-tech-info__description -->
			</div>
			<!-- /.product-tech-info__text -->
			<div class="product-tech-info__drawing tech-drawing">
				<div class="tech-drawing__info">
					<div class="tech-drawing__icon">
						<?php get_template_part( 'template-parts/icons/fi-br-comment-info' ); ?>
					</div>
					<!-- /.tech-drawing__icon -->
					<div class="tech-drawing__text">
						<?php echo wp_kses_post( $kemroc_pti_figure['drawing_text'] ); ?>
					</div>
					<!-- /.tech-drawing__text -->
				</div>
				<!-- /.tech-drawing__info -->
				<?php echo wp_get_attachment_image( $kemroc_pti_figure['drawing'], 'medium_large' ); ?>
			</div>
			<!-- /.product-tech-info__drawing tech-drawing -->
		</div>
		<!-- /.container product-tech-info__content -->
	</section>
	<!-- /.product-tech-info -->

	<?php
endif;
