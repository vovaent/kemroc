<?php
/**
 * Template part for displaying article card
 *
 * @package kemroc
 */

$kemroc_article_class = isset( $args['class'] ) ? $args['class'] : 'article-card';

?>
<article class="<?php echo esc_attr( $kemroc_article_class ); ?>">
	<a href="" class="<?php echo esc_attr( $kemroc_article_class ); ?>__link">
		<div class="<?php echo esc_attr( $kemroc_article_class ); ?>__image">
			<?php kemroc_post_thumbnail(); ?>
		</div>
		<!-- /.<?php echo esc_attr( $kemroc_article_class ); ?>__image -->

		<?php kemroc_posted_on(); ?>
		
		<h6 class="<?php echo esc_attr( $kemroc_article_class ); ?>__title">
			<?php the_title(); ?>
		</h6>
		<!-- /.<?php echo esc_attr( $kemroc_article_class ); ?>__title -->
		<p class="pseudo-link <?php echo esc_attr( $kemroc_article_class ); ?>__pseudo-link">
			<?php esc_html_e( 'Mehr', 'kemroc' ); ?>
			<?php get_template_part( 'template-parts/icons/arrow', 'right', array( 'fill' => '#ff6000' ) ); ?>
		</p>
		<!-- /.<?php echo esc_attr( $kemroc_article_class ); ?>__pseudo-link -->
	</a>
	<!-- /.<?php echo esc_attr( $kemroc_article_class ); ?>__link -->
</article>
<!-- /.<?php echo esc_attr( $kemroc_article_class ); ?> -->
