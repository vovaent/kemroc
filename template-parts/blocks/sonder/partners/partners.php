<?php
/**
 * Partners Block Template.
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
	$kemroc_ps_id = 'our-partners-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_ps_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_ps_class_name = 'our-partners bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_ps_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_ps_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_ps_logo = get_field( 'logo' );
	$kemroc_ps_text = get_field( 'text' );
	$kemroc_ps_list = get_field( 'list' );
	?>

	<section id="<?php echo esc_attr( $kemroc_ps_id ); ?>" class="<?php echo esc_attr( $kemroc_ps_class_name ); ?>">
		<div class="container our-partners__content">
			<div class="our-partners__inner">
				<div class="our-partners__text-wrapper">
					<div class="our-partners__kemroc-logo">
						<?php echo wp_get_attachment_image( $kemroc_ps_logo ); ?>
					</div>
					<!-- /.our-partners__kemroc-logo -->
					<div class="our-partners__text">
						<?php echo esc_html( $kemroc_ps_text ); ?>
					</div>
					<!-- /.our-partners__text -->
				</div>
				<!-- /.our-partners__inner -->

				<?php if ( $kemroc_ps_list ) : ?>
					<ul class="our-partners__list">

						<?php foreach ( $kemroc_ps_list as $kemroc_ps_item ) : ?>
							<li class="our-partners__item">
								<?php echo wp_get_attachment_image( $kemroc_ps_item['partner_logo'] ); ?>
							</li>
							<!-- /.our-partners__item -->
						<?php endforeach; ?>
					
				   </ul>
					<!-- /.our-partners__list -->
				<?php endif; ?>
				
			</div>
			<!-- /.our-partners__inner -->
		</div>
		<!-- /.container our-partners__content -->
	</section>
	<!-- /.our-partners -->

	<?php
	endif;
