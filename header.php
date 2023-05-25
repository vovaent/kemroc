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
	<?php
	$logo         = get_field( 'header_logo', 'option' );
	$header_phone = get_field( 'header_phone', 'option' );
	$cta_link     = get_field( 'cta_link', 'option' );
	$rental_link  = get_field( 'rental_link', 'option' );
	$store_link   = get_field( 'store_link', 'option' );
	?>
	<header class="header desktop">
		<div class="container">
			<div class="header__top header-top">
				<div class="header-top__left">
					<a href="<?php echo site_url(); ?>" class="site-logo">
						<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
					</a>
					<button class="lang-switcher">
						<?php get_template_part( 'template-parts/icons/lang-switcher' ); ?>
					</button>
				</div>
				
				<div class="header__top-btns">
					<a class="site-search"></a>
					<?php if ( $header_phone ) : ?>
						<a class="header__phone" href="<?php echo $header_phone['url']; ?>"><?php echo $header_phone['title']; ?></a>
					<?php endif; ?>
					<?php if ( $cta_link ) : ?>
						<a class="btn btn-accent btn-rounded header__cta" href="<?php echo $cta_link['url']; ?>"><?php echo $cta_link['title']; ?></a>
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
									<a href="<?php echo $rental_link['url']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-rental.svg" alt=""><?php echo $rental_link['title']; ?></a>
								</li>
							<?php endif; ?>
							<?php if ( $store_link ) : ?>
								<li class="item-store">
									<a href="<?php echo $store_link['url']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-store.svg" alt=""><?php echo $store_link['title']; ?></a>
								</li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
				</nav>
			</div>
		</div>
	</header>
	<header class="header mobile">
		<div class="container">
			<div class="header__top header-top">
				<div class="header-top__left">
					<button class="toggle-nav header-top__toggle-nav">
						<?php get_template_part( 'template-parts/icons/toggle-nav-burger' ); ?>
					</button>
					<a href="<?php echo site_url(); ?>" class="site-logo header-top__logo">
						<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
					</a>
					<button class="lang-switcher header-top__lang-switcher">
						<?php get_template_part( 'template-parts/icons/lang-switcher' ); ?>
					</button>
					<a class="site-search header-top__site-search"></a>
				</div>
				<div class="header-top__right top-right">
					<a class="site-search top-right__site-search"></a>
					<?php if ( $cta_link ) : ?>
						<a class="btn btn-accent btn-rounded top-right__cta" href="<?php echo $cta_link['url']; ?>"><?php echo $cta_link['title']; ?></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="header__bottom">
				<div class="mobile-nav-panel">
					<button class="lang-switcher">
						<?php get_template_part( 'template-parts/icons/lang-switcher' ); ?>
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
									<a href="<?php echo $rental_link['url']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-rental.svg" alt=""><?php echo $rental_link['title']; ?></a>
								</li>
							<?php endif; ?>
							<?php if ( $store_link ) : ?>
								<li class="item-store">
									<a href="<?php echo $store_link['url']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-store.svg" alt=""><?php echo $store_link['title']; ?></a>
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
						<a class="btn btn-accent btn-rounded header__cta" href="<?php echo $cta_link['url']; ?>"><?php echo $cta_link['title']; ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</header>
