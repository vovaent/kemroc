/**
 * External
 */
import Swiper, { Pagination, Navigation } from 'swiper';
import 'swiper/css';

const seriesGeneralInfo = ( $ ) => {
	const sliderHandler = () => {
		const swiperOptions = {
			slidesPerView: 1,
			spaceBetween: 5,
			loop: true,
		};

		const $swiperSlide = $(
			'.series-general-info__slider .swiper-single-slide__slide'
		);
		const $swiperArrows = $(
			'.series-general-info__slider .swiper-single-slide__arrow'
		);

		if ( $swiperSlide.length > 1 ) {
			swiperOptions.modules = [ Pagination, Navigation ];

			swiperOptions.pagination = {
				el:
					'.series-general-info__slider + .swiper-single-slide__pagination',
				clickable: true,
			};

			swiperOptions.navigation = {
				nextEl:
					'.series-general-info__slider .swiper-single-slide__arrow--next',
				prevEl:
					'.series-general-info__slider .swiper-single-slide__arrow--prev',
			};
		} else {
			$swiperArrows.hide();
		}

		new Swiper(
			'.series-general-info__slider.swiper-single-slide',
			swiperOptions
		);
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
