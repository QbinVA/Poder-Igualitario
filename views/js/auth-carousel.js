// auth-carousel.js
(function(){
  const slides = document.querySelectorAll('.slide');
  let idx = 0;
  setInterval(()=>{
    slides[idx].classList.remove('is-active');
    idx = (idx + 1) % slides.length;
    slides[idx].classList.add('is-active');
  }, 3000);
})();
