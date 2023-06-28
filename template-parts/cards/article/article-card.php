<?php
/**
 * Template part for displaying article card
 *
 * @package kemroc
 */

?>
<article class="article-card">
	<div class="article-card__image">
		<?php kemroc_post_thumbnail(); ?>
	</div>
	<!-- /.article-card__image -->

	<a href="<?php the_permalink(); ?>" class="article-card__link">

		<?php 
		kemroc_posted_on(
			true,
			array( 'main' => 'article-card' ) 
		); 
		?>

		<h6 class="article-card__title">
			<?php the_title(); ?>
		</h6>
		<!-- /.article-card__title -->		
		<p class="pseudo-link article-card__pseudo-link">
			<?php esc_html_e( 'Mehr', 'kemroc' ); ?>
			<?php 
			get_template_part( 
				'template-parts/icons/arrow', 
				'right', 
				array( 'fill' => '#ff6000' ) 
			); 
			?>
		</p>
		<!-- /.pseudo-link article-card__pseudo-link -->
	</a>
	<!-- /.article-card__link -->
</article>
<!-- /.article-card -->
