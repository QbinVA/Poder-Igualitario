// carousel/carousel.js
document.addEventListener('DOMContentLoaded', () => {
  new Swiper('.mySwiper', {
    effect: 'fade',               // efecto fade
    fadeEffect: { crossFade: true },
    loop: true,                   // loop infinito
    autoplay: {
      delay: 2500,                // 2.5 s
      disableOnInteraction: false
    },
    slidesPerView: 1
  });
});
