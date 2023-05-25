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
	$image        = get_field( 'image' );
	$image_mobile = get_field( 'image_mobile' );


	?>
	<?php if ( $image_mobile ) : ?>
<style>
	@media (max-width: 767px) {
		.hero {
			background-image: url(<?php echo $image_mobile['url']; ?>) !important;
		}
	}
</style>
<?php endif; ?>
	<section  id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>" style="background-image: url(<?php echo $image['url']; ?>);">
		<div class="container">
			<div class="hero__inner">
				<?php if ( $subtitle ) : ?>
				<h6 class="hero__subtitle"><?php echo $subtitle; ?></h6>
				<?php endif; ?>
				<?php if ( $title ) : ?>
				<h1 class="hero__title"><?php echo $title; ?></h1>
				<?php endif; ?>
				<?php if ( $link ) : ?>
				<div class="hero__readmore">
					<a href="<?php echo $link['url']; ?>" class="btn btn-accent btn-rounded arrow-right"><?php echo $link['title']; ?></a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

<?php } ?>
