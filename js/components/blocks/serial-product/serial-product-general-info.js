/**
 * External
 */
import Swiper, { Pagination, Navigation } from 'swiper';
import 'swiper/css';

const serialProductGeneralInfo = () => {
	new Swiper('.serial-product-general-info__slider.swiper-single-slide', {
		modules: [Pagination, Navigation],

		slidesPerView: 1,
		spaceBetween: 5,
		lopp: true,

		pagination: {
			el: '.serial-product-general-info__slider + .swiper-single-slide__pagination',
			clickable: true,
		},

		navigation: {
			nextEl: '.serial-product-general-info__slider .swiper-single-slide__arrow--next',
			prevEl: '.serial-product-general-info__slider .swiper-single-slide__arrow--prev',
		},
	});
};

export { serialProductGeneralInfo };
