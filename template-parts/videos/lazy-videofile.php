<?php
/**
 * Template part for lazy-videofile
 *
 * @package kemroc
 */

$kemroc_lyt_videofile_url = isset( $args['videofile_url'] ) ? $args['videofile_url'] : '';
$kemroc_lyt_poster_image  = isset( $args['poster_image'] ) ? $args['poster_image'] : '';
?>
<div class="lazy-video">
	<figure class="lazy-video__figure lazy-video__figure--file">
		<video 
			class="lazy-video__source lazy-video__source--model-page"
			src="<?php echo esc_url( $kemroc_lyt_videofile_url ); ?>" 
			width="100%" 
			height="100%" 
			muted
			poster="<?php echo esc_url( $kemroc_lyt_poster_image ); ?>"
		>
			<?php esc_html_e( 'Leider unterstützt Ihr Browser keine eingebetteten Videos.', 'kemroc' ); ?>
		</video>
		<!-- /.lazy-video__source -->
		<span class="icon-play lazy-video__icon-play">
			<?php get_template_part( 'template-parts/icons/icon-play' ); ?>
		</span>
		<!-- /.icon-play lazy-video__icon-play -->
	</figure>
	<!-- /.lazy-video__figure lazy-video__figure--file -->
</div>
<!-- /.lazy-video -->
