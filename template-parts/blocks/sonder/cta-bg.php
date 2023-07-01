<?php
if ( isset( $block['data']['gutenberg_preview_image'] ) && $is_preview ) {
	echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
}

/**
 *  Block Template.
 */
if ( ! $is_preview ) {
	$id = 'cta-bg-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$id = $block['anchor'];
	}

	$className = 'cta-bg';
	if ( ! empty( $block['className'] ) ) {
		$className .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$className .= ' align' . $block['align'];
	}

	
	$title = get_field( 'title' );
	$link  = get_field( 'link' );
	$info  = get_field( 'info' );
	?>


<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<div class="container">
		<div class="cta-bg__inner">
			<div class="cta-content">
				<?php if ( $title ) : ?>
				<h2 class="cta-title"><?php echo $title; ?></h2>
				<?php endif; ?>
				<?php if ( $info ) : ?>
				<div class="subheadline"><?php echo $info; ?></div>
				<?php endif; ?>
				<?php if ( $link ) : ?>
				<div class="cta-more">
					<a href="<?php echo $link['url']; ?>" class="btn btn-accent btn-rounded btn-border-accent arrow-right"><?php echo $link['title']; ?></a>
				</div>
				<?php endif; ?>
			</div>
			<picture class="cta-bg__picture">
				<source srcset="<?php echo esc_url( get_template_directory_uri() . '/images/Mietpark-pc.png' ); ?>" media="(min-width: 1024px)">
				<source srcset="<?php echo esc_url( get_template_directory_uri() . '/images/Mietpark-tablet.png' ); ?>" media="(min-width: 743px)">
				<img class="cta-bg__image" src="<?php echo esc_url( get_template_directory_uri() . '/images/Mietpark-mobile.png' ); ?>" alt="Mietpark">
			</picture>
			<!-- /.cta-bg__picture -->

		</div>
	</div>
</section>

<?php } ?>
