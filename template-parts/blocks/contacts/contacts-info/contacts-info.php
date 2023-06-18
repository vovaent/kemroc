<?php
/**
 * Contacts Info Block Template.
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
	$kemroc_ci_id = 'contacts-info-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_ci_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_ci_class_name = 'contacts-info bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_ci_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_ci_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_ci_personal_logo_use = get_field( 'personal_logo_use' );
	$kemroc_ci_personal_logo     = get_field( 'personal_logo' );
	$kemroc_ci_logo              = get_field( 'header_logo', 'option' );
	$kemroc_ci_personal_logo     = $kemroc_ci_personal_logo_use ? $kemroc_ci_personal_logo : $kemroc_ci_logo;
	$kemroc_ci_address           = get_field( 'address' );
	$kemroc_ci_contacts          = get_field( 'contacts' );
	?>

	<section id="<?php echo esc_attr( $kemroc_ci_id ); ?>" class="<?php echo esc_attr( $kemroc_ci_class_name ); ?>">
		<div class="container contacts-info__content">
			<div class="contacts-info__text">
				<div class="contacts-info__logo">
					<img src="<?php echo esc_url( $kemroc_ci_logo['url'] ); ?>" alt="<?php echo esc_attr( $kemroc_ci_logo['title'] ); ?>" class="contacts-info__logo-image">
				</div>
				<!-- /.contacts-info__logo -->
				<address class="contacts-info__address">
					<?php echo wp_kses_post( $kemroc_ci_address ); ?>
				</address>
				<!-- /.contacts-info__address -->

				<?php if ( $kemroc_ci_contacts ) : ?>
					<ul class="contacts-info__contacts-list">
						
						<?php foreach ( $kemroc_ci_contacts as $kemroc_ci_contact ) : ?>
							<li class="contacts-info__contacts-item">
								<span class="contacts-info__contacts-title">
									<?php echo esc_html( $kemroc_ci_contact['title'] ); ?>
								</span>
								<!-- /.contacts-info__contacts-title -->
								<span class="contacts-info__contacts-contact">
									<?php echo esc_html( $kemroc_ci_contact['contact'] ); ?>
								</span>
								<!-- /.contacts-info__contacts-contact -->
							</li>
							<!-- /.contacts-info__contacts-item -->
						<?php endforeach; ?>
						
					</ul>
					<!-- /.contacts-info__contacts-list -->
				<?php endif; ?>                

			</div>
			<!-- /.contacts-info__text -->
			<div class="contacts-info__map">
				<img src="<?php echo get_template_directory_uri() . '/images/map.png'; ?>" alt="" class="contacts-info__map-image">
				<img src="<?php echo get_template_directory_uri() . '/images/marker.svg'; ?>" alt="" class="contacts-info__map-marker">
			</div>
			<!-- /.contacts-info__map -->
		</div>
		<!-- /.container contacts-info__content -->
	</section>
	<!-- /.contacts-info -->

	<?php
endif;
