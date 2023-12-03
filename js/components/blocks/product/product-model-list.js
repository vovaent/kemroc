/**
 * External
 */
import Swiper, { Navigation } from 'swiper';
import 'swiper/css';

const productModelList = ( $ ) => {
	const pmlSliderHandler = () => {
		const pmlSlider = new Swiper( '.swiper.product-model-list__slider', {
			modules: [ Navigation ],

			slidesPerView: 2,

			navigation: {
				nextEl: '.swiper-button-next.product-model-list__control',
				prevEl: '.swiper-button-prev.product-model-list__control',
			},

			breakpoints: {
				768: {
					slidesPerView: 5,
				},
			},
		} );

		const isNullPrevEl = null === pmlSlider.navigation.prevEl;
		const isNullNextEl = null === pmlSlider.navigation.nextEl;

		if ( ! isNullPrevEl && ! isNullNextEl ) {
			if ( '5' >= pmlSlider.slides.length ) {
				$( pmlSlider.navigation.nextEl[ 0 ] ).hide();
				$( pmlSlider.navigation.prevEl[ 0 ] ).hide();
			}
		}
	};

	const fixModelParamsHeight = () => {
		const $modelCardParam = $( '.pml-model-card__param' );
		const $modelParams = $( '.pml-model__params' );

		if ( $modelCardParam.length === 0 || $modelParams.length === 0 ) {
			return;
		}

		$modelCardParam.each( function ( index ) {
			const thisHeight = $( this ).css( 'height' );

			$modelParams.each( function () {
				const $thisModelParam = $( this )
					.find( '.pml-model__param' )
					.eq( index );

				if ( thisHeight !== $thisModelParam.css( 'height' ) ) {
					$thisModelParam.css( 'height', thisHeight );
				}
			} );
		} );
	};

	const $modelTitles = $( '.pml-model__title' );
	const fixModelNameHeight = () => {
		const $modelCardTitle = $( '.pml-model-card__title' );

		if ( $modelCardTitle.length === 0 || $modelTitles.length === 0 ) {
			return;
		}

		const modelCardTitleHeight = $modelCardTitle.outerHeight();
		const allModelTitleHeightsArray = [];

		$modelTitles.each( function () {
			const $thisModelTitle = $( this );

			allModelTitleHeightsArray.push( $thisModelTitle.outerHeight() );
		} );

		const modelTitleMaxHeight = Math.max( ...allModelTitleHeightsArray );

		$modelTitles.each( function () {
			const $thisModelTitle = $( this );

			if ( modelCardTitleHeight !== $thisModelTitle.outerHeight() ) {
				$thisModelTitle.css( 'height', `${ modelTitleMaxHeight }px` );
			}
		} );

		if ( modelCardTitleHeight > modelTitleMaxHeight ) {
			$modelTitles.css( 'height', `${ modelCardTitleHeight }px` );
		} else {
			$modelCardTitle.css( 'height', `${ modelTitleMaxHeight }px` );
		}
	};

	const fixSliderArrowsPosition = () => {
		const $sliderArrows = $( '.product-model-list__control' );
		const sliderArrowsPositionTop = $modelTitles.outerHeight() / 2;

		$sliderArrows.css( {
			top: `${ sliderArrowsPositionTop }px`,
			transform: 'translateY(-6%)',
		} );
	};

	pmlSliderHandler();
	fixModelParamsHeight();
	fixModelNameHeight();
	fixSliderArrowsPosition();
};

export { productModelList };
