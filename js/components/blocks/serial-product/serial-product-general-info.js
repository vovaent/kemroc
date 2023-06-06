/**
 * External
 */
import Swiper, { Pagination } from 'swiper';
import 'swiper/css';

const serialProductGeneralInfo = ( ) => {
	new Swiper( '.swiper.spgi-slider', {
		modules: [ Pagination ],

		slidesPerView: 1,
		spaceBetween: 5,

		pagination: {
			el: '.swiper-pagination.spgi-slider__pagination',
			clickable: true,
		},
	} );
};

export { serialProductGeneralInfo };
