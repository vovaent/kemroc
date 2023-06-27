<?php
/**
 * Template part for displaying current article card
 *
 * @package kemroc
 */

$kemroc_article_class = isset( $args['class'] ) ? $args['class'] : 'article-card';

$kemroc_article_link        = $kemroc_article_class . '__link';
$kemroc_article_image       = $kemroc_article_class . '__image';
$kemroc_article_title       = $kemroc_article_class . '__title';
$kemroc_article_pseudo_link = 'pseudo-link ' . $kemroc_article_class . '__pseudo-link';
?>
<article class="<?php echo esc_attr( $kemroc_article_class ); ?>">
	<div class="<?php echo esc_attr( $kemroc_article_image ); ?>">
		<?php kemroc_post_thumbnail(); ?>
	</div>
	<!-- /.<?php echo esc_attr( $kemroc_article_image ); ?> -->

	<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $kemroc_article_link ); ?>">
		
		<?php 
		kemroc_posted_on(
			true,
			array( 'main' => $kemroc_article_class ) 
		); 
		?>
		
		<h6 class="<?php echo esc_attr( $kemroc_article_title ); ?>">
			<?php the_title(); ?>
		</h6>
		<!-- /.<?php echo esc_attr( $kemroc_article_title ); ?> -->
		
		<p class="<?php echo esc_attr( $kemroc_article_pseudo_link ); ?>">
			<?php esc_html_e( 'Mehr', 'kemroc' ); ?>
			<?php get_template_part( 'template-parts/icons/arrow', 'right', array( 'fill' => '#ff6000' ) ); ?>
		</p>
		<!-- /.<?php echo esc_attr( $kemroc_article_pseudo_link ); ?> -->
	</a>
	<!-- /.<?php echo esc_attr( $kemroc_article_link ); ?> -->
</article>
<!-- /.<?php echo esc_attr( $kemroc_article_class ); ?> -->
