/**
 * External
 */
import Swiper, { Pagination, Navigation } from 'swiper';
import 'swiper/css';

const seriesGeneralInfo = () => {
	new Swiper('.series-general-info__slider.swiper-single-slide', {
		modules: [Pagination, Navigation],

		slidesPerView: 1,
		spaceBetween: 5,

		pagination: {
			el: '.series-general-info__slider + .swiper-single-slide__pagination',
			clickable: true,
		},

		navigation: {
			nextEl: '.series-general-info__slider .swiper-single-slide__arrow--next',
			prevEl: '.series-general-info__slider .swiper-single-slide__arrow--prev',
		},
	});
};

export { seriesGeneralInfo };
