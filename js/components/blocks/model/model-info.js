/**
 * External
 */
import Swiper, { Navigation, Pagination } from 'swiper';
import 'swiper/css';

const modelInfo = ( $ ) => {
	const $modelInfoTab = $( '.model-tabs__tab' );
	const $modelInfoInset = $( '.model-tabs__inset' );

	const modelInfoToggleTab = function() {
		const $this = $( this );

		$modelInfoTab.removeClass( 'model-tabs__tab--active' );
		$this.addClass( 'model-tabs__tab--active' );
		$modelInfoInset.removeClass( 'model-tabs__inset--visible' );
		$modelInfoInset.eq( $this.index() ).addClass( 'model-tabs__inset--visible' );
	};

	$modelInfoTab.on( 'click', modelInfoToggleTab );

	new Swiper( '.swiper.model-tabs__slider', {
		modules: [ Navigation, Pagination ],

		slidesPerView: 1,
		spaceBetween: 10,

		navigation: {
			nextEl: '.swiper-button-next.model-tabs__control',
			prevEl: '.swiper-button-prev.model-tabs__control',
		},

		pagination: {
			el: '.swiper-pagination.model-tabs__slider-pagination',
			clickable: true,
		},
	} );

	$( 'video' ).on( 'click', function() {
		$( this ).attr( 'controls', '' );
	} );
};

export { modelInfo };
