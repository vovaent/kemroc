<?php
/**
 * The template for displaying glossary page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kemroc
 */

get_header();
?>

	<section class="page-glossary">
		<?php
		while ( have_posts() ) :
			the_post();

			the_title( '<h1 class="page-glossary__title">', '</h1>' );
			the_content();

		endwhile; // End of the loop.
		?>
	</section>
	<!-- /.page-glossary -->		

<?php

get_footer();
