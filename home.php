<?php
/**
 * The template for displaying blog home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kemroc
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<div class="post">
				<?php
				the_ID();
				kemroc_post_thumbnail();
				echo '<br>';
				the_title( 'Title: ', '<br>' );
				echo wp_kses_post( excerpt( 50 ) );
				?>
			</div>
			<!-- /.post -->

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_footer();
