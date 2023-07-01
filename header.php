<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kemroc
 */

$kemroc_no_current_lang_flag = '';
$kemroc_no_current_lang_url  = '';
$kemroc_no_current_lang_name = '';

if ( function_exists( 'pll_languages_list' ) ) {
	$kemroc_langs = pll_the_languages( array( 'raw' => 1 ) );

	foreach ( $kemroc_langs as $kemroc_lang ) {
		if ( ! $kemroc_lang['current_lang'] ) {
			$kemroc_no_current_lang_flag = $kemroc_lang['flag'];
			$kemroc_no_current_lang_url  = $kemroc_lang['url'];
			$kemroc_no_current_lang_name = $kemroc_lang['name'];
		}
	}
}

$logo         = get_field( 'header_logo', 'option' );
$header_phone = get_field( 'header_phone', 'option' );
$cta_link     = get_field( 'cta_link', 'option' );
$rental_link  = get_field( 'rental_link', 'option' );
$store_link   = get_field( 'store_link', 'option' );

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="page-wrapper">
		<header class="header">
			<div class="header__desktop">
				<div class="container">
					<div class="header__top header-top">
						<div class="header-top__left">
							<a href="<?php echo kemroc_home_url(); ?>" class="site-logo">
								<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
							</a>
							<a href="<?php echo esc_url( $kemroc_no_current_lang_url ); ?>" class="lang-switcher">
								<img src="<?php echo esc_attr( $kemroc_no_current_lang_flag ); ?>"
									class="lang-switcher__icon"
									alt="<?php echo esc_attr( $kemroc_no_current_lang_name ); ?>">
							</a>
						</div>

						<div class="header__top-btns">
							<a class="site-search"></a> <!-- pc search -->
							<?php if ( $header_phone ) : ?>
								<a class="header__phone" href="<?php echo $header_phone['url']; ?>"><?php echo $header_phone['title']; ?></a>
							<?php endif; ?>
							<?php if ( $cta_link ) : ?>
								<a class="btn btn-accent btn-rounded header__cta"
									href="<?php echo $cta_link['url']; ?>"><?php echo $cta_link['title']; ?></a>
							<?php endif; ?>
						</div>
					</div>
					<div class="header__bottom">
						<nav class="main-navigation site-nav">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'main_menu',
									'menu_id'        => 'main_menu',
								)
							);
							?>
							<?php if ( $rental_link || $store_link ) : ?>
								<ul class="links">
									<?php if ( $rental_link ) : ?>
										<li class="item-rental">
											<a href="<?php echo $rental_link['url']; ?>"><img
													src="<?php echo get_template_directory_uri(); ?>/images/icon-rental.svg"
													alt=""><?php echo $rental_link['title']; ?></a>
										</li>
									<?php endif; ?>
									<?php if ( $store_link ) : ?>
										<li class="item-store">
											<a href="<?php echo $store_link['url']; ?>"><img
													src="<?php echo get_template_directory_uri(); ?>/images/icon-store.svg"
													alt=""><?php echo $store_link['title']; ?></a>
										</li>
									<?php endif; ?>
								</ul>
							<?php endif; ?>
						</nav>
					</div>
				</div>
			</div>
			<div class="header__mobile">
				<div class="container">
					<div class="header__top header-top">
						<div class="header-top__left">
							<button class="toggle-nav header-top__toggle-nav">
								<?php get_template_part( 'template-parts/icons/toggle-nav-burger' ); ?>
							</button>
							<a href="<?php echo kemroc_home_url(); ?>" class="site-logo header-top__logo">
								<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
							</a>
							<a href="<?php echo esc_url( $kemroc_no_current_lang_url ); ?>"
								class="lang-switcher header-top__lang-switcher">
								<img src="<?php echo esc_attr( $kemroc_no_current_lang_flag ); ?>"
									class="lang-switcher__icon"
									alt="<?php echo esc_attr( $kemroc_no_current_lang_name ); ?>">
							</a>
							<a class="site-search header-top__site-search"></a> <!-- mob search -->
						</div>
						<div class="header-top__right top-right">
							<a class="site-search top-right__site-search"></a><!-- tab search -->
							<?php if ( $cta_link ) : ?>
								<a class="btn btn-accent btn-rounded top-right__cta"
									href="<?php echo $cta_link['url']; ?>"><?php echo $cta_link['title']; ?></a>
							<?php endif; ?>
						</div>
					</div>
					<div class="header__bottom">
						<div class="mobile-nav-panel">
							<button class="lang-switcher">
								<?php get_template_part( 'template-parts/icons/english-flag' ); ?>
							</button>
							<button class="toggle-nav">
								<?php get_template_part( 'template-parts/icons/toggle-nav-cross' ); ?>
							</button>
						</div>
						<nav class="main-navigation site-nav">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'main_menu',
									'menu_id'        => 'main_menu',
								)
							);
							?>
							<?php if ( $rental_link || $store_link ) : ?>
								<ul class="links">
									<?php if ( $rental_link ) : ?>
										<li class="item-rental">
											<a href="<?php echo $rental_link['url']; ?>"><img
													src="<?php echo get_template_directory_uri(); ?>/images/icon-rental.svg"
													alt=""><?php echo $rental_link['title']; ?></a>
										</li>
									<?php endif; ?>
									<?php if ( $store_link ) : ?>
										<li class="item-store">
											<a href="<?php echo $store_link['url']; ?>"><img
													src="<?php echo get_template_directory_uri(); ?>/images/icon-store.svg"
													alt=""><?php echo $store_link['title']; ?></a>
										</li>
									<?php endif; ?>
								</ul>
							<?php endif; ?>
						</nav>
						<div class="header__top-btns">
							<?php if ( $header_phone ) : ?>
								<a class="header__phone" href="<?php echo $header_phone['url']; ?>"><?php echo $header_phone['title']; ?></a>
							<?php endif; ?>
							<?php if ( $cta_link ) : ?>
								<a class="btn btn-accent btn-rounded header__cta" href="<?php echo $cta_link['url']; ?>">
									<?php echo $cta_link['title']; ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<aside class="search-area">
				<div class="container search-area__content">
					<button class="search-area__close"></button>
					<!-- /.search-area__close -->
					<div class="search-area__form">
						<?php get_search_form(); ?>
					</div>
					<!-- /.search-area__form -->

					<div class="search-area__result-list">
						<?php // get_template_part( 'template-parts/cards/search' ); ?>
						<?php
						/*
						 <article class="search-card">
							<div class="search-card__thumbnail">
							<img src="<?php echo get_template_directory_uri() . '/images/no-image.jpg'; ?>" alt="" class="search-card__image">
						</div>
						<!-- /.search-card__thumbnail -->
						<a href="<?php the_permalink(); ?>" class="search-card__text">
							<h6 class="search-card__title">
								KRD-Querschneidkopffräse am 30-t-Bagger
							</h6>
							<!-- /.search-card__title -->
							<div class="search-card__excerpt">
								KEMROC-Kettenfräse EK 110 bei Rohde
							</div>
							<!-- /.search-card__excerpt -->
							<p class="btn btn-arrow-rounded search-card__pseudo-link">
								<?php esc_html_e( 'Alle produkte', 'kemroc' ); ?>
								<span>
									<?php get_template_part( 'template-parts/icons/arrow', 'right', array( 'fill' => '#ff6000' ) ); ?>
								</span>
							</p>
							<!-- /.btn btn-arrow-rounded search-card__pseudo-link -->
						</a>
						<!-- /.search-card__text -->
						</article>
						<!-- /.search-card -->
						<article class="search-card">
						<div class="search-card__thumbnail">
							<img src="<?php echo get_template_directory_uri() . '/images/no-image.jpg'; ?>" alt="" class="search-card__image">
						</div>
						<!-- /.search-card__thumbnail -->
						<a href="<?php the_permalink(); ?>" class="search-card__text">
							<h6 class="search-card__title">
								KRD-Querschneidkopffräse am 30-t-Bagger
							</h6>
							<!-- /.search-card__title -->
							<div class="search-card__excerpt">
								KEMROC-Kettenfräse EK 110 bei Rohde
							</div>
							<!-- /.search-card__excerpt -->
							<p class="btn btn-arrow-rounded search-card__pseudo-link">
								<?php esc_html_e( 'Alle produkte', 'kemroc' ); ?>
								<span>
									<?php get_template_part( 'template-parts/icons/arrow', 'right', array( 'fill' => '#ff6000' ) ); ?>
								</span>
							</p>
							<!-- /.btn btn-arrow-rounded search-card__pseudo-link -->
						</a>
						<!-- /.search-card__text -->
						</article>
						<!-- /.search-card -->
						*/
						?>
						
						<!-- /.search-area__result-item -->
					</div>
					<!-- /.search-area__live-result -->
				</div>
				<!-- /.container search-area__content -->
			</aside>
			<!-- /.search-area -->

			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) :
				if ( is_front_page() ) {
					return;
				}
				?>
				<section id="breadcrumbs" class="breadcrumbs">
					<div class="container breadcrumbs__crumbs">
						<?php yoast_breadcrumb(); ?>
					</div>
					<!-- /.container breadcrumbs__crumbs -->
				</section>
				<!-- /.breadcrumbs -->
			<?php endif; ?>
		</header>
