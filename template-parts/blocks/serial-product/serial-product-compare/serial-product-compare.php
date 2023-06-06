<?php
/**
 * Serial Product Compare Block Template.
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
	$kemroc_spd_id = 'serial-product-compare-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_spd_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_spd_class_name = 'serial-product-compare';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_spd_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_spd_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_spd_title           = get_field( 'title' );
	$kemroc_spd_serial_products = get_field( 'serial_products' );
	?>

	<section id="<?php echo esc_attr( $kemroc_spd_id ); ?>" class="<?php echo esc_attr( $kemroc_spd_class_name ); ?>">
		<div class="container serial-product-compare__content">
			<h3 class="serial-product-compare__title">
				<?php echo esc_html( $kemroc_spd_title ); ?>
			</h3>
			<!-- /.serial-product-compare__title -->

			<?php if ( $kemroc_spd_serial_products ) : ?>
				<ul class="serial-product-compare__list">
					
					<?php foreach ( $kemroc_spd_serial_products as $kemroc_spd_serial_product ) : ?>
						<li class="serial-product-compare__item sp-item">
							<h6 class="sp-item__title">
								<?php echo esc_html( $kemroc_spd_serial_product['title'] ); ?>
							</h6>
							<!-- /.sp-item__title -->
							<div class="sp-item__subtitle">
								<?php echo esc_html( $kemroc_spd_serial_product['subtitle'] ); ?>
							</div>
							<!-- /.sp-item__subtitle -->

							<?php if ( $kemroc_spd_serial_product['params'] ) : ?>
								<ul class="sp-item__params">
									<li class="sp-item__param">
										
									</li>
									<!-- /.sp-item__param -->
								</ul>
								<!-- /.sp-item__params -->
							<?php endif; ?>

							<div class="sp-item__areas-use spi-areas-use">
								<div class="spi-areas-use__title">

								</div>
								<!-- /.spi-areas-use__title -->
								<ul class="spi-areas-use__list">
									<li class="spi-areas-use__item">
										
									</li>
									<!-- /.spi-areas-use__item -->
								</ul>
								<!-- /.spi-areas-use__list -->
							</div>
							<!-- /.sp-item__areas-use spi-areas-use -->
						</li>
						<!-- /.serial-product-compare__item sp-item -->
					<?php endforeach; ?>

				</ul>
				<!-- /.serial-product-compare__list -->
			<?php endif; ?>
			
		</div>
		<!-- /.container serial-product-compare__content -->
	</section>
	<!-- /.serial-product-compare -->

	<?php
endif;
