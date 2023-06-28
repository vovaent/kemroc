<?php
/**
 * Template part for displaying article card
 *
 * @package kemroc
 */

?>
<article class="new-card">
	<div class="new-card__image">
		<?php kemroc_post_thumbnail(); ?>
	</div>
	<!-- /.new-card__image -->

	<a href="<?php the_permalink(); ?>" class="new-card__link">

		<?php 
		kemroc_posted_on(
			true,
			array( 'main' => 'new-card' ) 
		); 
		?>

		<h6 class="new-card__title">
			<?php the_title(); ?>
		</h6>
		<!-- /.new-card__title -->		
		<p class="pseudo-link new-card__pseudo-link">
			<?php esc_html_e( 'Mehr', 'kemroc' ); ?>
			<?php 
			get_template_part( 
				'template-parts/icons/arrow', 
				'right', 
				array( 'fill' => '#ff6000' ) 
			); 
			?>
		</p>
		<!-- /.pseudo-link new-card__pseudo-link -->
	</a>
	<!-- /.new-card__link -->
</article>
<!-- /.new-card -->
