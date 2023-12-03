<?php
/**
 * FAQ Block Template.
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
	$kemroc_faq_id = 'faq-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_faq_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_faq_class_name = 'faq bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_faq_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_faq_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_title_data = get_field( 'title_data' );
	$kemroc_faq_list   = get_field( 'faq_list' );
	?>

	<section id="<?php echo esc_attr( $kemroc_faq_id ); ?>" class="<?php echo esc_attr( $kemroc_faq_class_name ); ?>">
		<div class="container faq__content">

			<?php if ( ! empty( $kemroc_title_data['faq_title'] ) ) : ?>
				<h2 class="faq__title faq__title--<?php echo esc_attr( $kemroc_title_data['title_horizontal_align'] ); ?>">
					<?php echo esc_html( $kemroc_title_data['faq_title'] ); ?>
				</h2>
				<!-- /.faq__title -->
			<?php endif; ?>

			<?php if ( $kemroc_faq_list ) : ?>
				<ul class="faq__list">
					
					<?php foreach ( $kemroc_faq_list as $kemroc_faq_item ) : ?>
						<li class="faq__item">
							<h5 class="faq__item-question">
								<?php echo esc_html( $kemroc_faq_item['question'] ); ?>
								<button class="faq__item-switcher"></button>
								<!-- /.faq__item-switcher -->		
							</h5>
							<!-- /.faq__item-question -->					
							<div class="faq__item-answer">
								<p class="faq__item-answer-inner">
									<?php echo esc_html( $kemroc_faq_item['answer'] ); ?>
								</p>
								<!-- /.faq__item-answer-inner -->
							</div>
							<!-- /.faq__item-answer -->
						</li>
					<!-- /.faq__item -->
					<?php endforeach; ?>

				</ul>
				<!-- /.faq__list -->
			<?php endif; ?>

		</div>
		<!-- /.container faq__content -->
	</section>
	<!-- /.faq -->

	<?php
endif;
