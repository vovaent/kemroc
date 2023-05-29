<?php
/**
 * Template Name: Product Page Template
 * Template Post Type: products
 * 
 * @package kemroc
 */

get_header();
?>

<section class="product-general-info">
	<div class="container product-general-info__content">
		<figure class="product-general-info__picture">
			<div class="product-general-info__tag">
				Bohren
			</div>
			<img src="<?php echo get_template_directory_uri() . '/images/product-general-info-pic.png'; ?>" alt="">
			<figcaption></figcaption>
		</figure>
		<!-- /.product-general-info__picture -->
		<div class="product-general-info__text">
			<h1 class="product-general-info__title">
			EBA-BOHRANTRIEBE
			</h1>
			<!-- /.product-general-info__title -->
			<h3 class="product-general-info__subtitle">
			ANBAU-DREHBOHRANTRIEBE FÜR BAGGER, BAGGERLADER UND KOMPAKTLADER
			</h3>
			<!-- /.product-general-info__subtitle -->
			<ul class="product-general-info__benefits">
				<li class="product-general-info__benefit">
					<span class="product-general-info__arrow-right">
						<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
					</span>
					<!-- /.product-general-info__arrow-right -->
					drehmomentstarker Hydraulikmotor
				</li>
				<!-- /.product-general-info__benefit -->
				<li class="product-general-info__benefit">
					<span class="product-general-info__arrow-right">
						<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
					</span>
					<!-- /.product-general-info__arrow-right -->
					robuste und verwindungssteife Aufhängung
				</li>
				<!-- /.product-general-info__benefit -->
				<li class="product-general-info__benefit">
				<span    span class="product-general-info__arrow-right">
						<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
					</span>
					<!-- /.product-general-info__arrow-right -->
					robuste Lagerung
				</li>
				<!-- /.product-general-info__benefit -->
				<li class="product-general-info__benefit">
					<span class="product-general-info__arrow-right">
						<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
					</span>
					<!-- /.product-general-info__arrow-right -->
					verschleißfeste Bohrschnecken
				</li>
				<!-- /.product-general-info__benefit -->
				<li class="product-general-info__benefit">
					<span class="product-general-info__arrow-right">
						<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
					</span>
					<!-- /.product-general-info__arrow-right -->
					Drehbohrköpfe für unterschiedliche Einsätze
				</li>
				<!-- /.product-general-info__benefit -->
				<li class="product-general-info__benefit">
					<span class="product-general-info__arrow-right">
						<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
					</span>
					<!-- /.product-general-info__arrow-right -->
					Zentriermonitor für garantiert senkrechtes Bohren
				</li>
				<!-- /.product-general-info__benefit -->
				<li class="product-general-info__benefit">
					<span class="product-general-info__arrow-right">
						<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
					</span>
					<!-- /.product-general-info__arrow-right -->
					verschleißfeste Bohrschnecken
				</li>
				<!-- /.product-general-info__benefit -->
				<li class="product-general-info__benefit">
					<span class="product-general-info__arrow-right">
						<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
					</span>
					<!-- /.product-general-info__arrow-right -->
					Drehbohrköpfe für unterschiedliche Einsätze
				</li>
				<!-- /.product-general-info__benefit -->
				<li class="product-general-info__benefit">
					<span class="product-general-info__arrow-right">
						<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
					</span>
					<!-- /.product-general-info__arrow-right -->
					Zentriermonitor für garantiert senkrechtes Bohren
				</li>
				<!-- /.product-general-info__benefit -->
			</ul>
			<!-- /.product-general-info__benefits -->
		</div>
		<!-- /.product-general-info__text -->
	</div>
	<!-- /.container product-general-info__content -->
</section>
<!-- /.product-general-info -->

<section class="product-tech-info">
	<div class="container product-tech-info__content">
		<div class="product-tech-info__text">
			<h3 class="product-tech-info__title">
			MIT DEN BOHRANRIEBEN DER SERIE EBA KÖNNEN SIE IM HANDUMDREHEN IHREN BAGGER, BAGGERLADER ODER KOMPAKTLADER DURCH DEN EINFACHEN AUSTAUSCH DES ANBAUWERKZEUGES ZU EINER BOHRMASCHINE UMRÜSTEN.
			</h3>
			<!-- /.product-tech-info__title -->
			<div class="product-tech-info__description">
				Diese Bohrantriebe eignen sich für das Bohren von kurzen Löchern in weichen bindigen Böden, Geröllen und mittelharten kompakten Gesteinen bis zu einer einaxialen Druckfestigkeit von 50 MPa. Für das Bohren in mittelharten Gesteinen wurden von KEMROC spezielle Bohr­werkzeuge entwickelt, die eine hohe Bohrgeschwindigkeit garantieren.
			</div>
			<!-- /.product-tech-info__description -->
		</div>
		<!-- /.product-tech-info__text -->
		<div class="product-tech-info__drawing tech-drawing">
			<div class="tech-drawing__info">
				<div class="tech-drawing__icon">
					<?php get_template_part( 'template-parts/icons/fi-br-comment-info' ); ?>
				</div>
				<!-- /.tech-drawing__icon -->
				<div class="tech-drawing__text">
					Hinweise für das Bohren mit KEMROC Bohrantrieben
				</div>
				<!-- /.tech-drawing__text -->
			</div>
			<!-- /.tech-drawing__info -->
			<img src="<?php echo get_template_directory_uri() . '/images/bohren.png'; ?>" alt="">
		</div>
		<!-- /.product-tech-info__drawing tech-drawing -->
	</div>
	<!-- /.container product-tech-info__content -->
</section>
<!-- /.product-tech-info -->

<section class="model-list">
	<div class="container model-list__content">
		<div class="model-list__card model-card">
			<div class="model-card__title">
				<strong>MODELLE</strong> VERGLEICHEN
			</div>
			<!-- /.model-card__title -->
			<div class="model-card__params">
				<div class="model-card__param">
				Empfohlenes Baggergewicht
				</div>
				<!-- /.model-card__param -->
				<div class="model-card__param">
				Max. Bohrdurchmesser
				</div>
				<!-- /.model-card__param -->
				<div class="model-card__param">
				Min. Bohrdurchmesser
				</div>
				<!-- /.model-card__param -->
			</div>
			<!-- /.model-card__params -->
		</div>
		<!-- /.model-list__card model-card -->
		<div class="swiper model-list__slider">
			<ul class="swiper-wrapper model-list__models">
				<li class="swiper-slide model-list__item model">
					<div class="model__title">
					EBA 3300
					</div>
					<!-- /.model__title -->
					<ul class="model__params">
						<li class="model__param">
						7 – 13 t
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						800 mm
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						200 mm
						</li>
						<!-- /.model__param -->
					</ul>
					<!-- /.model__params -->
					<a href="" class="model__link">
						Details 
						<span class="model__arrow">
							<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
						</span>
					</a>
					<!-- /.model__link -->
				</li>
				<!-- /.model-list__item model -->
				<li class="swiper-slide model-list__item model">
					<div class="model__title">
					EBA 600
					</div>
					<!-- /.model__title -->
					<ul class="model__params">
						<li class="model__param">
						7 – 13 t
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						800 mm
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						200 mm
						</li>
						<!-- /.model__param -->
					</ul>
					<!-- /.model__params -->
					<a href="" class="model__link">
					Details
					</a>
					<!-- /.model__link -->
				</li>
				<!-- /.model-list__item model -->
				<li class="swiper-slide model-list__item model">
					<div class="model__title">
					EBA 700
					</div>
					<!-- /.model__title -->
					<ul class="model__params">
						<li class="model__param">
						7 – 13 t
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						800 mm
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						200 mm
						</li>
						<!-- /.model__param -->
					</ul>
					<!-- /.model__params -->
					<a href="" class="model__link">
					Details
					</a>
					<!-- /.model__link -->
				</li>
				<!-- /.model-list__item model -->
				<li class="swiper-slide model-list__item model">
					<div class="model__title">
					EBA 800
					</div>
					<!-- /.model__title -->
					<ul class="model__params">
						<li class="model__param">
						7 – 13 t
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						800 mm
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						200 mm
						</li>
						<!-- /.model__param -->
					</ul>
					<!-- /.model__params -->
					<a href="" class="model__link">
					Details
					</a>
					<!-- /.model__link -->
				</li>
				<!-- /.model-list__item model -->
				<li class="swiper-slide model-list__item model">
					<div class="model__title">
					EBA 900
					</div>
					<!-- /.model__title -->
					<ul class="model__params">
						<li class="model__param">
						7 – 13 t
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						800 mm
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						200 mm
						</li>
						<!-- /.model__param -->
					</ul>
					<!-- /.model__params -->
					<a href="" class="model__link">
					Details
					</a>
					<!-- /.model__link -->
				</li>
				<!-- /.model-list__item model -->
				<li class="swiper-slide model-list__item model">
					<div class="model__title">
					EBA 1000
					</div>
					<!-- /.model__title -->
					<ul class="model__params">
						<li class="model__param">
						7 – 13 t
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						800 mm
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						200 mm
						</li>
						<!-- /.model__param -->
					</ul>
					<!-- /.model__params -->
					<a href="" class="model__link">
						Details
						<span class="model__arrow">
							<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
						</span>
					</a>
					<!-- /.model__link -->
				</li>
				<!-- /.model-list__item model -->
				<li class="swiper-slide model-list__item model">
					<div class="model__title">
					EBA 1000
					</div>
					<!-- /.model__title -->
					<ul class="model__params">
						<li class="model__param">
						7 – 13 t
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						800 mm
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						200 mm
						</li>
						<!-- /.model__param -->
					</ul>
					<!-- /.model__params -->
					<a href="" class="model__link">
						Details
						<span class="model__arrow">
							<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
						</span>
					</a>
					<!-- /.model__link -->
				</li>
				<!-- /.model-list__item model -->
				<li class="swiper-slide model-list__item model">
					<div class="model__title">
					EBA 1000
					</div>
					<!-- /.model__title -->
					<ul class="model__params">
						<li class="model__param">
						7 – 13 t
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						800 mm
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						200 mm
						</li>
						<!-- /.model__param -->
					</ul>
					<!-- /.model__params -->
					<a href="" class="model__link">
						Details
						<span class="model__arrow">
							<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
						</span>
					</a>
					<!-- /.model__link -->
				</li>
				<!-- /.model-list__item model -->
				<li class="swiper-slide model-list__item model">
					<div class="model__title">
					EBA 1000
					</div>
					<!-- /.model__title -->
					<ul class="model__params">
						<li class="model__param">
						7 – 13 t
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						800 mm
						</li>
						<!-- /.model__param -->
						<li class="model__param">
						200 mm
						</li>
						<!-- /.model__param -->
					</ul>
					<!-- /.model__params -->
					<a href="" class="model__link">
						Details
						<span class="model__arrow">
							<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#FF6000' ) ); ?>
						</span>
					</a>
					<!-- /.model__link -->
				</li>
				<!-- /.model-list__item model -->
			</ul>
			<!-- /.model-list__models -->
			<div class="swiper-button-prev model-list__control model-list__control--prev">
				<?php get_template_part( 'template-parts/icons/arrow-left', null, array( 'color' => '#444444' ) ); ?>
			</div>
			<!-- /.model-list__control -->
			<div class="swiper-button-next model-list__control model-list__control--next">
				<?php get_template_part( 'template-parts/icons/arrow-right', null, array( 'color' => '#444444' ) ); ?>
			</div>
			<!-- /.model-list__control -->
		</div>
		<!-- /.swiper model-list__slider -->
	</div>
	<!-- /.container model-list__content -->
</section>
<!-- /.model-list -->

<?php
get_footer();
