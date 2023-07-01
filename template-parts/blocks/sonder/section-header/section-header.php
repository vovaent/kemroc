<?php
/**
 * Section Header Block Template.
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
	$kemroc_sh_id = 'section-header-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_sh_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_sh_class_name = 'section-header bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_sh_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_sh_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_sh_title = get_field( 'title' );
	$kemroc_sh_info  = get_field( 'info' );
	$kemroc_sh_link  = get_field( 'link' );
	?>

	<section id="<?php echo esc_attr( $kemroc_sh_id ); ?>" class="<?php echo esc_attr( $kemroc_sh_class_name ); ?>">
		<div class="container section-header__content">
			<div class="section-header__title">
				<?php if ( $kemroc_sh_title ) : ?>
					<h2 class="title">
						<?php echo esc_html( $kemroc_sh_title ); ?>
					</h2>
				<?php endif; ?>
				<?php if ( $kemroc_sh_link ) : ?>
					<div class="readmore desktop">
						<a href="<?php echo esc_url( $kemroc_sh_link['url'] ); ?>" class="btn btn-arrow-rounded readmore__link">
							<?php echo esc_html( $kemroc_sh_link['title'] ); ?>
							<span>
								<?php
								get_template_part(
									'template-parts/icons/arrow-right',
									null,
									array( 'fill' => '#FF6000' )
								);
								?>
							</span>
						</a>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( $kemroc_sh_info ) : ?>
				<div class="section-header__info subheadline">
					<?php echo esc_html( $kemroc_sh_info ); ?>
				</div>
			<?php endif; ?>
			<?php if ( $kemroc_sh_link ) : ?>
				<div class="readmore mobile">
					<a href="<?php echo esc_url( $kemroc_sh_link['url'] ); ?>" class="btn btn-arrow-rounded">
						<?php echo esc_html( $kemroc_sh_link['title'] ); ?>
						<span>
							<?php
							get_template_part(
								'template-parts/icons/arrow',
								'right',
								array( 'fill' => '#ff6000' )
							);
							?>
						</span>
					</a>
				</div>
			<?php endif; ?>
		</div>
		<!-- /.container section-header__content -->
	</section>
	<!-- /.section-header -->

	<?php
endif;
