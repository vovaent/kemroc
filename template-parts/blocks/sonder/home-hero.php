<?php
if ( isset( $block['data']['gutenberg_preview_image'] ) && $is_preview ) {
	echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
}

/**
 *  Block Template.
 */
if ( ! $is_preview ) {
	$id = 'hero-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$id = $block['anchor'];
	}

	$className = 'hero';
	if ( ! empty( $block['className'] ) ) {
		$className .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$className .= ' align' . $block['align'];
	}

	$subtitle     = get_field( 'subtitle' );
	$title        = get_field( 'title' );
	$link         = get_field( 'link' );
	$image_pc     = get_field( 'image_pc' );
	$image_tablet = get_field( 'image_tablet' );
	$image_mobile = get_field( 'image_mobile' );
	?>
	<section  id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<picture class="hero__bg-picture">
		<source srcset="<?php echo esc_url( $image_pc['url'] ); ?>" media="(min-width: 1024px)">
		<source srcset="<?php echo esc_url( $image_tablet['url'] ); ?>" media="(min-width: 743px)">
		<img class="hero__bg-image" src="<?php echo esc_url( $image_mobile['url'] ); ?>" alt="<?php echo esc_url( $image_mobile['alt'] ); ?>">
	</picture>
	<!-- /.hero__bg-image -->
		<div class="container hero__container">
			<div class="hero__inner">
				<?php if ( $subtitle ) : ?>
					<h6 class="hero__subtitle"><?php echo $subtitle; ?></h6>
				<?php endif; ?>

				<?php if ( $title ) : ?>
					<h1 class="hero__title"><?php echo $title; ?></h1>
				<?php endif; ?>

				<?php if ( $link ) : ?>
					<div class="hero__readmore">
						<a href="<?php echo $link['url']; ?>" class="btn btn-accent btn-rounded arrow-right">
							<?php echo $link['title']; ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php } ?>
