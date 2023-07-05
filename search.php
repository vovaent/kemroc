<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package kemroc
 */

global $wp_query;
$kemroc_s_post_count  = $wp_query->found_posts;
$kemroc_s_page_number = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$kemroc_s_prev_arrow  = kemroc_get_template_part_content(
	'template-parts/icons/arrow-left',
	null,
	array( 'fill' => '#ff6000' )
);
$kemroc_s_next_arrow  = kemroc_get_template_part_content(
	'template-parts/icons/arrow-right',
	null,
	array( 'fill' => '#ff6000' )
);
$kemroc_s_navigation  = kemroc_get_the_posts_pagination(
	array(
		'class'     => 'kemroc-navigation',
		'prev_text' => $kemroc_s_prev_arrow,
		'next_text' => $kemroc_s_next_arrow,
	),
	null,
	$kemroc_s_page_number
);

get_header();
?>

	<?php if ( have_posts() ) : ?>
		<section class="search-results">
			<div class="container search-results__content">
				<header class="search-results__header">
					<h1 class="search-results__title">
						<?php
						echo wp_kses( 
							sprintf( 
								/* translators: %1$d: post count; %2$s: search query. */
								__( '%1$d Suchergebnisse für: %2$s', 'kemroc' ), 
								$kemroc_s_post_count, 
								'<span>' . get_search_query() . '</span>' 
							), 
							'span' 
						);
						?>
					</h1>
					<p class="search-results__note">
						<?php esc_html_e( 'Suchergebnis nicht zufriedenstellend? Versuche es mal mit einem Wort oder einer anderen Schreibweise', 'kemroc' ); ?>
					</p>
					<!-- /.search-results__note -->
					<div class="search-results__form">
						<?php get_template_part( 'searchform', null, array( 'add_class' => 'search-form--on-page' ) ); ?>
					</div>
					<!-- /.search-results__form -->
					<div class="search-results-wrapper search-results__result-wrapper"></div>
					<!-- /.search-results-wrapper search-results__result-wrapper -->
				</header><!-- .search-results__header -->

				<section class="search-results__list">

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/cards/search/search', 'card' );

					endwhile;
					?>

				</section>
				<!-- /.search-results__list -->

				<div class="search-results__navigation">
                    <?php echo $kemroc_s_navigation; //phpcs:ignore ?>
				</div>
				<!-- /.kemroc-navigation search-results__navigation -->
			</div>
			<!-- /.container -->
		</section>
		<!-- /.search-results -->

		<?php
	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

</main><!-- #primary .site-main -->

<?php
get_footer();
