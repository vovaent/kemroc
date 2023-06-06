/**
 * External
 */
import Swiper, { Pagination } from 'swiper';
import 'swiper/css';

const serialProductGeneralInfo = ( ) => {
	new Swiper( '.swiper.spgi-slider', {
		modules: [ Pagination ],

		slidesPerView: 2,

		pagination: {
			el: '.swiper-pagination.spgi-slider-pagination',
			clickable: true,
		},

		breakpoints: {
			768: {
				slidesPerView: 5,
			},
		},
	} );
};

export { serialProductGeneralInfo };
