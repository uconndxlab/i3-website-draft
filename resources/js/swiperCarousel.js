import Swiper from 'swiper';
import { EffectCoverflow, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/effect-coverflow';
import 'swiper/css/pagination';

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Swiper with Coverflow Effect
    const featuredSwiper = document.querySelector('.featuredSwiper');
    
    if (featuredSwiper) {
        const swiper = new Swiper('.featuredSwiper', {
            modules: [EffectCoverflow, Pagination, Autoplay],
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            loop: true,
            initialSlide: 1,
            autoplay: {
                delay: 7500,
                disableOnInteraction: false,
            },
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 200,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                // When window width is >= 320px
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 0,
                        depth: 100,
                        modifier: 1,
                        slideShadows: false,
                    }
                },
                // When window width is >= 768px
                768: {
                    slidesPerView: 'auto',
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 0,
                        depth: 200,
                        modifier: 1,
                        slideShadows: true,
                    }
                }
            },
            on: {
                click: function(swiper, event) {
                    const clickedSlide = event.target.closest('.swiper-slide');
                    if (clickedSlide) {
                        const modalTarget = clickedSlide.dataset.modalTarget;
                        if (modalTarget) {
                            const modal = new bootstrap.Modal(document.querySelector(modalTarget));
                            modal.show();
                        }
                    }
                }
            }
        });
    }
});
