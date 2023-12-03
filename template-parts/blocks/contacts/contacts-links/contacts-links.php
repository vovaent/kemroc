<?php
/**
 * Contacts Links Block Template.
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
	$kemroc_cl_id = 'contacts-links-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_cl_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_cl_class_name = 'contacts-links bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_cl_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_cl_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_cl_links = get_field( 'links' );
	?>

	<section id="<?php echo esc_attr( $kemroc_cl_id ); ?>" class="<?php echo esc_attr( $kemroc_cl_class_name ); ?>">
		<div class="container contacts-links__content">

			<?php if ( $kemroc_cl_links ) : ?>
				<?php foreach ( $kemroc_cl_links as $kemroc_cl_link ) : ?>
					<a href="<?php echo esc_url( $kemroc_cl_link['link'] ); ?>" class="contacts-links__link-card" target="_blank">
						<div class="contacts-links__link-title">
							<?php echo esc_html( $kemroc_cl_link['title'] ); ?>
						</div>
						<!-- /.contacts-links__link-title -->
						<div class="contacts-links__link-description">
							<?php echo esc_html( $kemroc_cl_link['description'] ); ?>
						</div>
						<!-- /.contacts-links__link-description -->
						<div class="btn btn-rounded btn-border-accent arrow-right contacts-links__link-button"></div>
						<!-- /.contacts-links__link-button -->
						<div class="contacts-links__arrows"></div>
						<!-- /.contacts-links__arrows -->
					</a>
					<!-- /.contacts-links__link-card -->
				<?php endforeach; ?>
			<?php endif; ?>
			
		</div>
		<!-- /.container contacts-links__content -->
	</section>
	<!-- /.contacts-links -->

	<?php
endif;
