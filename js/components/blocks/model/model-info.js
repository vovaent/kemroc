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
		const swiperOptions = {
			slidesPerView: 1,
			spaceBetween: 10,
			loop: true,
		};

		const $swiperSlide = $(
			'.model-tabs__slider .swiper-single-slide__slide'
		);
		const $swiperArrows = $(
			'.model-tabs__slider .swiper-single-slide__arrow'
		);

		if ( $swiperSlide.length > 1 ) {
			swiperOptions.modules = [ Pagination, Navigation ];

			swiperOptions.pagination = {
				el: '.model-tabs__slider + .swiper-single-slide__pagination',
				clickable: true,
			};

			swiperOptions.navigation = {
				nextEl: '.model-tabs__slider .swiper-single-slide__arrow--next',
				prevEl: '.model-tabs__slider .swiper-single-slide__arrow--prev',
			};
		} else {
			$swiperArrows.hide();
		}

		new Swiper( '.model-tabs__slider.swiper-single-slide', swiperOptions );
	};

	sliderHandler();
};

export { modelInfo };
