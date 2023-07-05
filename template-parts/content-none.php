<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kemroc
 */

?>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<section class="no-results not-found">
		<header class="page-header">
			<h1 class="page-title">
				<?php esc_html_e( 'Nothing Found', 'kemroc' ); ?>
			</h1>
		</header><!-- .page-header -->
		<div class="page-content">

			<?php
			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'kemroc' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);
			?>

		</div><!-- .page-content -->
	</section><!-- .no-results -->

<?php elseif ( is_search() ) : ?>

	<section class="no-results not-found search-no-results">
		<div class="container search-no-results__content">
			<h1 class="search-no-results__title search-no-results__title--tab-mob">
					<?php
					printf( 
						/* translators: %s: search query. */
						esc_html__( 'Suchergebnisse für: %s', 'kemroc' ), 
						'<span>' . get_search_query() . '</span>' 
					);
					?>
			</h1>
			<!-- /.search-no-results__title -->
			<div class="search-no-results__wrapper">
			<div class="search-no-results__text">
				<h1 class="search-no-results__title search-no-results__title--pc">
					<?php
					printf( 
						/* translators: %s: search query. */
						esc_html__( 'Suchergebnisse für: %s', 'kemroc' ), 
						'<span>' . get_search_query() . '</span>' 
					);
					?>
				</h1>
				<!-- /.search-no-results__title -->
				<div class="search-no-results__recomendation">
					<p class="search-no-results__recomendation-header">
						<?php esc_html_e( 'Es konnte leider nichts gefunden werden', 'kemroc' ); ?>
					</p>
					<!-- /.search-no-results__recomendation-header -->
					<p class="search-no-results__recomendation-description">
						<?php esc_html_e( 'Entschuldigung, aber kein Eintrag erfüllt Deine Suchkriterien. Bitte starte eine neue Suche. Um bessere Suchergebnisse zu erzielen, beachte bitte folgende Hinweise:', 'kemroc' ); ?>
					</p>
					<!-- /.search-no-results__recomendation-description -->
					<ul class="search-no-results__recomendation-list">
						<li class="search-no-results__recomendation-item">
							<?php esc_html_e( 'Überprüfe die Rechtschreibung.', 'kemroc' ); ?>
						</li>
						<!-- /.search-no-results__recomendation-item -->
						<li class="search-no-results__recomendation-item">
							<?php esc_html_e( 'Suche nach ähnlichen Suchbegriffen, z.B. Notebook statt Laptop, etc.', 'kemroc' ); ?>
						</li>
						<!-- /.search-no-results__recomendation-item -->
						<li class="search-no-results__recomendation-item">
							<?php esc_html_e( 'Versuche mehr als einen Suchbegriff zu verwenden.', 'kemroc' ); ?>
						</li>
						<!-- /.search-no-results__recomendation-item -->
					</ul>
					<!-- /.search-no-results__recomendation-list -->
				</div>
				<!-- /.search-no-results__recomendation -->
				<div class="search-no-results__form">
					<?php get_template_part( 'searchform', null, array( 'add_class' => 'search-form--on-page search-form--on-page-no-results' ) ); ?>
				</div>
				<!-- /.search-no-results__form -->				
			</div>
			<!-- /.search-no-results__text -->
			<div class="search-no-results__image">
				<img src="<?php echo get_template_directory_uri() . '/images/search-no-results.png'; //phpcs:ignore ?>" alt="search-no-results">
			</div>
			<!-- /.search-no-results__image -->
		</div>
		<!-- /.search-no-results__wrapper -->
		</div>
		<!-- /.container search-no-results__content -->
	</section>
	<!-- /.no-results not-found search-no-results -->

<?php else : ?>

	<section class="no-results not-found">
		<header class="page-header">
			<h1 class="page-title">
				<?php esc_html_e( 'Nothing Found', 'kemroc' ); ?>
			</h1>
		</header><!-- .page-header -->
		<div class="page-content">
			<p>
				<?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'kemroc' ); ?>
			</p>
			<?php
			get_template_part( 'searchform', null, array( 'add_class' => 'search-form--on-page' ) );
			?>
		</div><!-- .page-content -->
	</section><!-- .no-results -->

<?php endif; ?>
