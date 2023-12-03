<?php
/**
 * Template part for lazy-youtube-video
 *
 * @package kemroc
 */

$kemroc_lyt_id     = isset( $args['id'] ) ? $args['id'] : 0;
$kemroc_lyt_title  = isset( $args['title'] ) ? $args['title'] : '';
$kemroc_lyt_poster = isset( $args['poster'] ) ? $args['poster'] : '';
?>
<div class="lazy-video">
<figure class="lazy-video__figure">
	<div 
		class="lazy-video__placeholder lazy-video__placeholder--model-page" 
		data-yt-video-id="<?php echo esc_attr( $kemroc_lyt_id ); ?>" 
		data-yt-iframe-class="lazy-video__source lazy-video__source--model-page"
	>

		<?php 
		if ( $kemroc_lyt_poster ) : 
            echo $kemroc_lyt_poster; //phpcs:ignore
		else : 
			$kemroc_mi_yt_poster_url = 'https://img.youtube.com/vi/' . $kemroc_lyt_id . '/maxresdefault.jpg';
			?>
			<img 
				class="lazy-video__poster"
				src="<?php echo esc_url( $kemroc_mi_yt_poster_url ); ?>" 
				alt="<?php echo esc_attr( $kemroc_lyt_title ); ?>"
			>
		<?php endif; ?>

		<div class="icon-play lazy-video__icon-play">
			<?php get_template_part( 'template-parts/icons/icon-play' ); ?>
		</div>
		<!-- /.icon-play lazy-video__icon-play -->
		<div class="kemroc-preloader lazy-video__preloader"></div>
		<!-- /.kemroc-preloader lazy-video__preloader -->
	</div>
	<!-- /.lazy-video__placeholder -->
</figure>
<!-- /.lazy-video__figure -->
</div>
<!-- /.lazy-video -->
