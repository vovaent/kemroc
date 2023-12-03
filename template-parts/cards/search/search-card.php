<?php
/**
 * Template part for displaying search card
 *
 * @package kemroc
 */

?>
<article class="search-card">
	<?php 
	kemroc_the_post_thumbnail(
		'post-thumbnail',
		'search-card__thumbnail',
		array( 'class' => 'search-card__image' ),
		true
	); 
	?>
	<a href="<?php the_permalink(); ?>" class="search-card__text">
		<div class="search-card__text-wrapper">
			<h6 class="search-card__title">
				<?php the_title(); ?>
			</h6>
			<!-- /.search-card__title -->
			<div class="search-card__excerpt">
				<?php kemroc_the_excerpt( 7 ); ?>
			</div>
			<!-- /.search-card__excerpt -->
		</div>
		<!-- /.search-card__text-wrapper -->		
		<p class="btn btn-arrow-rounded search-card__pseudo-link">
			<?php esc_html_e( 'Mehr lesen', 'kemroc' ); ?> 
			<span>
				<?php get_template_part( 'template-parts/icons/arrow', 'right', array( 'fill' => '#ff6000' ) ); ?>
			</span>
		</p>
		<!-- /.btn btn-arrow-rounded search-card__pseudo-link -->
	</a>
	<!-- /.search-card__text -->
</article>
<!-- /.search-card -->
