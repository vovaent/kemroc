/**
 * External
 */
import Swiper, { Navigation } from 'swiper';
import 'swiper/css';

const modelList = () => {
    const swiper = new Swiper('.swiper', {
        modules: [Navigation],

        slidesPerView: 2,

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        breakpoints: {
            768: {
                slidesPerView: 5,
            },
        },
    });
}

export { modelList };