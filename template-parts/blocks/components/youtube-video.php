<?php
/**
 * Youtube video
 * 
 * @package kemroc
 */

$kemroc_video_id     = isset( $args['video']['id'] ) ? $args['video']['id'] : '';
$kemroc_video_poster = isset( $args['video']['poster'] ) ? $args['video']['poster'] : '';
$kemroc_video_title  = isset( $args['video']['title'] ) ? $args['video']['title'] : '';

?>
<style>
	* {
		padding: 0;
		margin: 0;
		overflow: hidden
	}

	html,
	body {
		height: 100%
	}

	img,
	span {
		position: absolute;
		width: 100%;
		top: 0;
		bottom: 0;
		margin: auto
	}

	.icon-play {
		position: absolute;
		left: 50%;
		transform: translateX(-50%);
		display: flex;
		align-items: center;
		justify-content: center;
		width: 58px;
		height: 48px;
		background: #ff6000;
		border-radius: 16px;
		cursor: pointer;
	}
</style>
<a href="https://www.youtube.com/embed/<?php echo esc_attr( $kemroc_video_id ); ?>?autoplay=1">

	<?php if ( $kemroc_video_poster ) : ?>
		<?php
		echo wp_get_attachment_image( 
			$kemroc_video_poster, 
			'full', 
			false, 
			array( 'alt' => wp_get_attachment_caption( $kemroc_video_poster ) ) 
		); 
		?>
	<?php else : ?>
			<img 
				src="https://img.youtube.com/vi/<?php echo esc_attr( $kemroc_video_id ); ?>/hqdefault.jpg" 
				alt="<?php echo esc_attr( $kemroc_video_title ); ?>"
			>
	<?php endif; ?>

	<span class="icon-play">
		<?php get_template_part( 'template-parts/icons/icon-play' ); ?>
	</span>
</a>
