<?php
/**
 * The template for displaying all single glossary items
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package kemroc
 */

get_header();
?>

	<section class="content-glossary">
		<div class="container">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Vorherige:', 'kemroc' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Weiter:', 'kemroc' ) . '</span> <span class="nav-title">%title</span>',
					)
				);
			endwhile; // End of the loop.
			?>
		</div>
		<!-- /.container -->
	</section>
	<!-- /.content-glossary -->

<?php
get_footer();
