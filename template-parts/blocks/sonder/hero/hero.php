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
	$kemroc_hero_link          = get_field( 'link' );
	$kemroc_hero_bg_image      = get_field( 'bg_image' );    

	if ( $kemroc_hero_is_front_page ) {
		$kemroc_hero_class_name .= ' hero--front-page';
	}
	?>
	<section id="<?php echo esc_attr( $kemroc_hero_id ); ?>" class="<?php echo esc_attr( $kemroc_hero_class_name ); ?>">
		<picture class="hero__bg-picture">

			<?php if ( $kemroc_hero_bg_image['mobile'] ) : ?>
				<source 
					srcset="<?php echo esc_attr( $kemroc_hero_bg_image['mobile']['url'] ); ?>" 
					media="(max-width: 739px)"
				>
			<?php endif; ?>
			
			<?php if ( $kemroc_hero_bg_image['tablet'] ) : ?>
				<source 
					srcset="<?php echo esc_attr( $kemroc_hero_bg_image['tablet']['url'] ); ?>" 
					media="(max-width: 1179px)"
			>
			<?php endif; ?>

			<img 
				class="hero__bg-image" 
				src="<?php echo esc_attr( $kemroc_hero_bg_image['pc']['url'] ); ?>" 
				alt="<?php echo esc_attr( $kemroc_hero_bg_image['pc']['alt'] ); ?>"
			>
		</picture>
		<!-- /.hero__bg-image -->
		<div class="container hero__container">
			<div class="hero__inner">
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

				<?php if ( $kemroc_hero_link ) : ?>
					<a href="<?php echo esc_url( $kemroc_hero_link['url'] ); ?>" class="btn btn-accent btn-rounded arrow-right hero__readmore">
						<?php echo esc_html( $kemroc_hero_link['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>
			<!-- /.container hero__inner -->
		</div>
		<!-- /.container hero__container -->
	</section>
	<!-- /.hero -->
<?php } ?>
