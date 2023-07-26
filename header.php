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
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-XT8SK051GD');
	</script>
</head>

<body <?php body_class(); ?>>
	<div class="page-wrapper">
		<div class="header-substitute"></div>
		<!-- /.header-substitute -->
		<header class="header">
			<div class="header__desktop">
				<div class="container">
					<div class="header__top header-top">
						<div class="header-top__left">
							<?php if ( has_custom_logo() ) : ?>
								<div class="site-logo">
									<?php the_custom_logo(); ?>
								</div>
								<!-- <a href="<?php echo kemroc_home_url(); ?>" class="site-logo"> -->
								<!-- <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"> -->
								<!-- </a> -->
							<?php endif; ?>							
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

							<?php if ( has_custom_logo() ) : ?>
								<div class="site-logo header-top__logo">
									<?php the_custom_logo(); ?>
								</div>
								<!-- /.site-logo header-top__logo -->
								<!-- <a href="<?php echo kemroc_home_url(); ?>" class="site-logo header-top__logo"> -->
									<!-- <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"> -->
								<!-- </a> -->
							<?php endif; ?>
							
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
							<a href="<?php echo esc_url( $kemroc_no_current_lang_url ); ?>" class="lang-switcher">
								<img src="<?php echo esc_attr( $kemroc_no_current_lang_flag ); ?>"
									class="lang-switcher__icon"
									alt="<?php echo esc_attr( $kemroc_no_current_lang_name ); ?>">
							</a>
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

			<aside class="search-area search-area--pos-abslt">
				<div class="container search-area__content">
					<button class="search-area__close"></button>
					<!-- /.search-area__close -->
					<div class="search-area__form">
						<?php get_template_part( 'searchform', null, array( 'add_class' => 'search-form--on-header' ) ); ?>
					</div>
					<!-- /.search-area__form -->
					<div class="search-results-wrapper search-area__result-wrapper"></div>
					<!-- /.search-results-wrapper search-area__result-wrapper -->
				</div>
				<!-- /.container search-area__content -->
			</aside>
			<!-- /.search-area -->
		</header>
		
		<main id="primary" class="site-main">
			<?php if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
				<?php
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
