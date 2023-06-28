<?php
/**
 * Template part for displaying product card
 *
 * @package kemroc
 */

?>
<article class="product-card">
	<figure class="product-card__figure">
		<?php 
		echo wp_get_attachment_image( 
			get_post_thumbnail_id(), 
			'thumbnail', 
			false, 
			array( 'class' => 'product-card__image' ) 
		); 
		?>
	</figure>
	<!-- /.product-card__figure -->
	<div class="product-card__text">
		<h6 class="product-card__title">
			<?php the_title(); ?>
		</h6>
		<!-- /.product-card__title -->
		<p class="pseudo-link product-card__pseudo-link">
			<?php esc_html_e( 'Mehr', 'kemroc' ); ?>
			<?php get_template_part( 'template-parts/icons/arrow', 'right', array( 'fill' => '#ff6000' ) ); ?>
		</p>
		<!-- /.product-card__pseudo-link -->
	</div>
	<!-- /.product-card__text -->
</article>
<!-- /.product-card -->
