/**
 * External
 */
import Swiper, { Pagination, Navigation } from 'swiper';
import 'swiper/css';

const serialProductGeneralInfo = ( $ ) => {
	const swiperOptions = {
		slidesPerView: 1,
		spaceBetween: 5,
		loop: true,
	};

	const $swiperSlide = $(
		'.serial-product-general-info__slider .swiper-single-slide__slide'
	);
	const $swiperArrows = $(
		'.serial-product-general-info__slider .swiper-single-slide__arrow'
	);

	if ( $swiperSlide.length > 1 ) {
		swiperOptions.modules = [ Pagination, Navigation ];

		swiperOptions.pagination = {
			el:
				'.serial-product-general-info__slider + .swiper-single-slide__pagination',
			clickable: true,
		};

		swiperOptions.navigation = {
			nextEl:
				'.serial-product-general-info__slider .swiper-single-slide__arrow--next',
			prevEl:
				'.serial-product-general-info__slider .swiper-single-slide__arrow--prev',
		};
	} else {
		$swiperArrows.hide();
	}

	new Swiper(
		'.serial-product-general-info__slider.swiper-single-slide',
		swiperOptions
	);
};

export { serialProductGeneralInfo };
