/**
 * External
 */
import Swiper, { Navigation, Pagination } from 'swiper';
import 'swiper/css';

const modelInfo = ( $ ) => {
	const $modelInfoTab = $( '.model-tabs__tab' );
	const $modelInfoInset = $( '.model-tabs__inset' );

	const modelInfoToggleTab = function () {
		const $this = $( this );

		$modelInfoTab.removeClass( 'model-tabs__tab--active' );
		$this.addClass( 'model-tabs__tab--active' );
		$modelInfoInset.removeClass( 'model-tabs__inset--visible' );
		$modelInfoInset
			.eq( $this.index() )
			.addClass( 'model-tabs__inset--visible' );
	};

	$modelInfoTab.on( 'click', modelInfoToggleTab );

	const sliderHandler = () => {
		const photoSwiperOptions = {
			slidesPerView: 1,
			spaceBetween: 10,
			loop: true,
		};

		const $photoSwiperSlide = $(
			'.model-tabs__slider.swiper-single-slide--big-slider .swiper-single-slide__slide'
		);
		const $photoSwiperArrows = $(
			'.model-tabs__slider.swiper-single-slide--big-slider .swiper-single-slide__arrow'
		);

		if ( $photoSwiperSlide.length > 1 ) {
			photoSwiperOptions.modules = [ Pagination, Navigation ];

			photoSwiperOptions.pagination = {
				el:
					'.model-tabs__slider.swiper-single-slide--big-slider + .swiper-single-slide__pagination',
				clickable: true,
			};

			photoSwiperOptions.navigation = {
				nextEl:
					'.model-tabs__slider.swiper-single-slide--big-slider .swiper-single-slide__arrow--next',
				prevEl:
					'.model-tabs__slider.swiper-single-slide--big-slider .swiper-single-slide__arrow--prev',
			};
		} else {
			$photoSwiperArrows.hide();
		}

		new Swiper(
			'.model-tabs__slider.swiper-single-slide--big-slider',
			photoSwiperOptions
		);

		const videosSwiperOptions = {
			slidesPerView: 1,
			spaceBetween: 10,
			loop: true,
		};
		const $videoSwiperSlide = $(
			'.model-tabs__slider.swiper-single-slide--videos .swiper-single-slide__slide'
		);
		const $videoSwiperArrows = $(
			'.model-tabs__slider.swiper-single-slide--videos .swiper-single-slide__arrow'
		);

		if ( $videoSwiperSlide.length > 1 ) {
			videosSwiperOptions.modules = [ Pagination, Navigation ];

			videosSwiperOptions.pagination = {
				el:
					'.model-tabs__slider.swiper-single-slide--videos + .swiper-single-slide__pagination',
				clickable: true,
			};

			videosSwiperOptions.navigation = {
				nextEl:
					'.model-tabs__slider.swiper-single-slide--videos .swiper-single-slide__arrow--next',
				prevEl:
					'.model-tabs__slider.swiper-single-slide--videos .swiper-single-slide__arrow--prev',
			};
		} else {
			$videoSwiperArrows.hide();
		}
		new Swiper(
			'.model-tabs__slider.swiper-single-slide--videos',
			videosSwiperOptions
		);
	};

	sliderHandler();
};

export { modelInfo };
