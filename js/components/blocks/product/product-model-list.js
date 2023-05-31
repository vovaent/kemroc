/**
 * External
 */
import Swiper, { Navigation } from 'swiper';
import 'swiper/css';

const productModelList = ($) => {
    const swiper = new Swiper('.swiper.model-list__slider', {
        modules: [Navigation],

        slidesPerView: 2,

        navigation: {
            nextEl: '.swiper-button-next.model-list__control',
            prevEl: '.swiper-button-prev.model-list__control',
        },

        breakpoints: {
            768: {
                slidesPerView: 5,
            },
        },
    });
}

export { productModelList };