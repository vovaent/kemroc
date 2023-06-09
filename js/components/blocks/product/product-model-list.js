/**
 * External
 */
import Swiper, { Navigation } from 'swiper';
import 'swiper/css';

const pmlSliderHandler = ($) => {
	const pmlSlider = new Swiper('.swiper.product-model-list__slider', {
		modules: [Navigation],

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
	});

	if ('5' >= pmlSlider.slides.length) {
		$('.swiper-button-prev').hide();
		$('.swiper-button-next').hide();
	}
};

const fixModelParamsHeight = ($) => {
	const $modelCardParam = $('.pml-model-card__param');
	const $modelParams = $('.pml-model__params');

	$modelCardParam.each(function (index) {
		const thisHeight = $(this).css('height');

		$modelParams.each(function () {
			const $thisModelParam = $(this).find('.pml-model__param').eq(index);

			if (thisHeight !== $thisModelParam.css('height')) {
				$thisModelParam.css('height', thisHeight);
			}
		});
	});
};

const productModelList = ($) => {
	pmlSliderHandler($);
	fixModelParamsHeight($);
};

export { productModelList };
