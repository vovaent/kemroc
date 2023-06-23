<?php
/**
 * Lazy Video Block Template.
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
	$kemroc_lv_id = 'lazy-video-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_lv_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_lv_class_name = 'acf-custom-block lazy-video bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_lv_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_lv_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_lv_video        = get_field( 'video' );
	$kemroc_lv_video_poster = '';

	if ( ! empty( $kemroc_lv_video['poster'] ) ) {
		$kemroc_lv_video_poster = wp_get_attachment_image(
			$kemroc_lv_video['poster'],
			'full',
			false,
			array( 
				'class' => 'lazy-video__poster',
				'alt'   => wp_get_attachment_caption( $kemroc_lv_video['poster'] ),
			)
		);
	}
	?>

	<section id="<?php echo esc_attr( $kemroc_lv_id ); ?>" class="<?php echo esc_attr( $kemroc_lv_class_name ); ?>">
		<div class="container lazy-video__content">

			<?php if ( 'youtube' === $kemroc_lv_video['yt_or_file_load'] && $kemroc_lv_video['id'] ) : ?>
				<figure class="lazy-video__figure lazy-video__figure--yt">
					<div 
						class="lazy-video__placeholder" 
						data-yt-video-id="<?php echo esc_attr( $kemroc_lv_video['id'] ); ?>" 
						data-yt-iframe-class="lazy-video__source"
					>

						<?php
						if ( ! empty( $kemroc_lv_video_poster ) ) :
							echo $kemroc_lv_video_poster; //phpcs:ignore
						else :
							$kemroc_lv_yt_poster_url = 'https://img.youtube.com/vi/' . $kemroc_lv_video['id'] . '/maxresdefault.jpg';
							?>
							<img 
								class="lazy-video__poster"
								src="<?php echo esc_url( $kemroc_lv_yt_poster_url ); ?>" 
								alt="<?php echo esc_attr( $kemroc_lv_video['title'] ); ?>"
							>
						<?php endif; ?>

						<figcaption class="lazy-video__caption"></figcaption>
						<div class="icon-play lazy-video__icon-play">
							<?php get_template_part( 'template-parts/icons/icon-play' ); ?>
						</div>
						<!-- /.icon-play lazy-video__icon-play -->
						<div class="lazy-video__preloader"></div>
						<!-- /.lazy-video__preloader -->
					</div>
					<!-- /.lazy-video__placeholder -->
				</figure>
				<!-- /.lazy-video__figure lazy-video__figure--yt -->
				<?php
			elseif ( 'videofile' === $kemroc_lv_video['yt_or_file_load'] && $kemroc_lv_video['videofile'] ) :
				$kemroc_lv_video_poster_img = '';
				if ( $kemroc_lv_video['poster'] ) :
					$kemroc_lv_video_poster_img = wp_get_attachment_url( $kemroc_lv_video['poster'] );
				endif;
				?>
				
				<figure class="lazy-video__figure lazy-video__figure--file">
					<video 
						class="lazy-video__source"
						src="<?php echo esc_url( $kemroc_lv_video['videofile']['url'] ); ?>" 
						width="100%" 
						height="100%" 
						muted 
						poster="<?php echo esc_url( $kemroc_lv_video_poster_img ); ?>"
					>
						<?php esc_html_e( 'Leider unterstützt Ihr Browser keine eingebetteten Videos.', 'kemroc' ); ?>
					</video>
					<figcaption class="lazy-video__caption"></figcaption>
					<!-- /.lazy-video__caption -->
					<div class="icon-play lazy-video__icon-play">
						<?php get_template_part( 'template-parts/icons/icon-play' ); ?>
					</div>
					<!-- /.icon-play lazy-video__icon-play -->
				</figure>
				<!-- /.lazy-video__figure lazy-video__figure--file -->
			<?php endif; ?>

		</div>
		<!-- /.container lazy-video__content -->
	</section>
	<!-- /.lazy-video -->

	<?php
endif;
