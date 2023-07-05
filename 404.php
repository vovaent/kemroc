<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package kemroc
 */

get_header();
?>

	<section class="error-404 not-found">
		<div class="page-content page-404">
			<div class="container">
				<div class="page-404__img">
					<img src="<?php echo get_template_directory_uri() . '/images/icon-404.svg'; ?>" alt="icon-404">
				</div>
				<h4 class="page-404__text"><?php _e( 'Seite nicht gefunden', 'kemroc' ); ?></h4>
				<a href="<?php echo home_url(); ?>" class="page-404__homelink btn btn-accent btn-rounded arrow-right">
					<?php _e( 'Zur Startseite', 'kemroc' ); ?>
				</a>
			</div>
		</div><!-- .page-content -->
	</section><!-- .error-404 -->

<?php
get_footer();
