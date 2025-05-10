// views/js/auth-carousel.js
(() => {
  const slides = document.querySelectorAll('.carousel-pane .slide');
  let idx = 0;
  setInterval(() => {
    slides[idx].classList.remove('is-active');
    idx = (idx + 1) % slides.length;
    slides[idx].classList.add('is-active');
  }, 3000);
})();
