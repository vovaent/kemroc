/**
 * External
 */
import Swiper, { Pagination, Navigation } from 'swiper';
import 'swiper/css';

const seriesGeneralInfo = ( $ ) => {
	const sliderHandler = () => {
		new Swiper( '.series-general-info__slider.swiper-single-slide', {
			modules: [ Pagination, Navigation ],

			slidesPerView: 1,
			spaceBetween: 5,
			loop: true,

			pagination: {
				el:
					'.series-general-info__slider + .swiper-single-slide__pagination',
				clickable: true,
			},

			navigation: {
				nextEl:
					'.series-general-info__slider .swiper-single-slide__arrow--next',
				prevEl:
					'.series-general-info__slider .swiper-single-slide__arrow--prev',
			},
		} );
	};

	const $productModelList = $( '.product-model-list' );

	const amountModelsClickHandler = () => {
		if ( $productModelList.length === 0 ) {
			return;
		}

		const srollToPos = $productModelList.offset().top - 20;

		$( 'html, body' ).animate( { scrollTop: srollToPos }, 500 );
	};

	const amountModelsHandler = () => {
		const $amount = $( '.series-general-info__amount' );

		if ( $amount.length === 0 ) {
			return;
		}

		$amount.on( 'click', amountModelsClickHandler );
	};

	sliderHandler();
	amountModelsHandler();
};

export { seriesGeneralInfo };
