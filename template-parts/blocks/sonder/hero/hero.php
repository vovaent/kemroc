<?php
/**
 * Hero Block Template.
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

/**
 *  Block Template.
 */
if ( ! $is_preview ) {
	$kemroc_hero_id = 'hero-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_hero_id = $block['anchor'];
	}

	$kemroc_hero_class_name = '';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_hero_class_name .= $block['className'];
	}
	$kemroc_hero_class_name .= ' hero';

	if ( ! empty( $block['align'] ) ) {
		$kemroc_hero_class_name .= ' align' . $block['align'];
	}

	$kemroc_hero_is_front_page = get_field( 'is_front_page' );
	$kemroc_hero_above_title   = get_field( 'above_title' );
	$kemroc_hero_title_choice  = get_field( 'title_choice' );
	$kemroc_hero_title         = 'custom_title' === $kemroc_hero_title_choice ? get_field( 'custom_title' ) : get_the_title();
	$kemroc_hero_description   = get_field( 'description' );
	$kemroc_hero_show_button   = get_field( 'show_button' );
	$kemroc_hero_link          = get_field( 'link' );
	$kemroc_hero_bg_image      = get_field( 'bg_image' );

	if ( $kemroc_hero_is_front_page ) {
		$kemroc_hero_class_name .= ' hero--front-page';
	}
	
	$kemroc_hero_bg_image_height = '';

	if ( ! empty( $kemroc_hero_bg_image['is_narrow'] ) ) {
		$kemroc_hero_bg_image_width = 'narrow';
	} else {
		$kemroc_hero_bg_image_width = 'wide';

		if ( ! empty( $kemroc_hero_bg_image['is_all_height'] ) ) {
			$kemroc_hero_bg_image_height = 'all-height';
		}
	}

	$kemroc_hero_bg_picture_wrapper_classes  = 'hero__bg-picture-wrapper--' . $kemroc_hero_bg_image_width;
	$kemroc_hero_bg_picture_wrapper_classes .= ! empty( $kemroc_hero_bg_image_height ) ? ' hero__bg-picture-wrapper--' . $kemroc_hero_bg_image_height : '';
	$kemroc_hero_bg_picture_wrapper_classes .= ! empty( $kemroc_hero_bg_image['tablet']['url'] ) ? ' hero__bg-picture-wrapper--tab' : '';
	$kemroc_hero_bg_picture_wrapper_classes .= ! empty( $kemroc_hero_bg_image['mobile']['url'] ) ? ' hero__bg-picture-wrapper--mob' : '';
	?>
	<section id="<?php echo esc_attr( $kemroc_hero_id ); ?>" class="<?php echo esc_attr( $kemroc_hero_class_name ); ?>">
		<figure 
			class="hero__bg-picture-wrapper <?php echo esc_attr( $kemroc_hero_bg_picture_wrapper_classes ); ?>">
			<picture class="hero__bg-picture">

				<?php if ( ! empty( $kemroc_hero_bg_image['mobile'] ) ) : ?>
					<source srcset="<?php echo esc_attr( $kemroc_hero_bg_image['mobile']['url'] ); ?>"
						media="(max-width: 739px)">
				<?php endif; ?>

				<?php if ( ! empty( $kemroc_hero_bg_image['tablet'] ) ) : ?>
					<source srcset="<?php echo esc_attr( $kemroc_hero_bg_image['tablet']['url'] ); ?>"
						media="(max-width: 1179px)">
				<?php endif; ?>

				<?php if ( ! empty( $kemroc_hero_bg_image['pc'] ) ) : ?>
					<img 
						class="hero__bg-image"
						src="<?php echo esc_attr( $kemroc_hero_bg_image['pc']['url'] ); ?>"
						alt="<?php echo esc_attr( $kemroc_hero_bg_image['pc']['alt'] ); ?>"
					>
				<?php endif; ?>

			</picture>
			<!-- /.hero__bg-picture -->

			<?php if ( $kemroc_hero_is_front_page ) : ?>
				<picture class="hero__bg-arrow">
					<source srcset="<?php echo esc_attr( get_template_directory_uri() . '/images/bg-arrow-mobile.png' ); ?>"
						media="(max-width: 739px)">
					<source srcset="<?php echo esc_attr( get_template_directory_uri() . '/images/bg-arrow-tablet.png' ); ?>"
						media="(max-width: 1179px)">
					<img src="<?php echo esc_attr( get_template_directory_uri() . '/images/bg-arrow-pc.png' ); ?>" alt="" 
						class="hero__bg-arrow-image">
				</picture>
				<!-- /.hero__bg-arrow -->
			<?php endif; ?>

			<div class="hero__bg-picture-overlay"></div>
			<!-- /.hero__bg-picture-overlay -->
			<div class="container hero__content">

				<?php if ( $kemroc_hero_above_title ) : ?>
					<h6 class="above-title hero__above-title">
						<?php echo esc_html( $kemroc_hero_above_title ); ?>
					</h6>
				<?php endif; ?>

				<h1 class="hero__title">
					<?php echo esc_html( $kemroc_hero_title ); ?>
				</h1>

				<?php if ( $kemroc_hero_description ) : ?>
					<div class="hero__description">
						<?php echo wp_kses_post( $kemroc_hero_description ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $kemroc_hero_is_front_page || $kemroc_hero_show_button ) : ?>
					<?php if ( $kemroc_hero_link ) : ?>
						<a 
							href="<?php echo esc_url( $kemroc_hero_link['url'] ); ?>"
							class="btn btn-accent btn-rounded arrow-right hero__readmore"
							target="<?php echo esc_html( $kemroc_hero_link['target'] ); ?>"
						>
							<?php echo esc_html( $kemroc_hero_link['title'] ); ?>
						</a>
					<?php endif; ?>
				<?php endif; ?>

		</div>
		<!-- /.container hero__content -->
		</figure>
		<!-- /.hero__bg-picture-wrapper -->		
	</section>
	<!-- /.hero -->
<?php } ?>
