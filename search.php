<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package kemroc
 */

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
$kemroc_s_navigation = kemroc_get_the_posts_pagination( //phpcs:ignore
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

<main id="primary" class="site-main search-results">
	<div class="container search-results__content">
		
		<?php if ( have_posts() ) : ?>
			<header class="search-results__header">
				<h1 class="search-results__title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'kemroc' ), '<span>' . get_search_query() . '</span>' );
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
			
			<?php
		else :

			get_template_part( 'template-parts/cards/search/search', 'none' );

		endif;
		?>

	</div>
	<!-- /.container -->
</main><!-- #main .search-results-->

<?php
get_footer();
