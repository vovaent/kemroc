<?php
/**
 * Template part for displaying product card
 *
 * @package kemroc
 */

?>
<article class="product-card">
	<?php 
	kemroc_the_post_thumbnail(
		array( '122', '110' ),
		'product-card__thumbnail',
		array( 'class' => 'product-card__image' )
	);
	?>
	<a href="<?php the_permalink(); ?>" class="product-card__text">
		<h6 class="product-card__title">
			<?php the_title(); ?>
		</h6>
		<!-- /.product-card__title -->
		<p class="pseudo-link product-card__pseudo-link">
			<?php esc_html_e( 'Mehr', 'kemroc' ); ?>
			<?php get_template_part( 'template-parts/icons/arrow', 'right', array( 'fill' => '#ff6000' ) ); ?>
		</p>
		<!-- /.product-card__pseudo-link -->
	</a>
	<!-- /.product-card__text -->
</article>
<!-- /.product-card -->
