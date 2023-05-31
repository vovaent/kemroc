<?php
/**
 * Youtube video
 * 
 * @package kemroc
 */

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
<a href=https://www.youtube.com/embed/QWcJR1hdNoU?autoplay=1>
	<img src=https://img.youtube.com/vi/QWcJR1hdNoU/hqdefault.jpg alt='Video The Dark Knight Rises: What Went Wrong? – Wisecrack Edition'>
	<span class=icon-play>
		<?php get_template_part( 'template-parts/icons/icon-play' ); ?>
	</span>
</a>
