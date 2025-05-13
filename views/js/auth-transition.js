// views/js/auth-transition.js
document.addEventListener('DOMContentLoaded', () => {
  // 1) Fade-in al cargar
  setTimeout(() => {
    document.body.classList.add('fade-in');
    const formPane     = document.querySelector('.form-pane');
    const carouselPane = document.querySelector('.carousel-pane');

    if (formPane)     setTimeout(() => formPane.classList.add('animate'), 300);
    if (carouselPane) setTimeout(() => carouselPane.classList.add('animate'), 500);
  }, 100);

  // 2) Captura TODOS los enlaces “switch”
  document.querySelectorAll('.links .switch').forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      const targetURL = link.href;  // apunta a registro.php o login.php
      // anima fade-out
      document.body.classList.remove('fade-in');
      document.body.classList.add('fade-out');
      // redirige tras la animación (700ms)
      setTimeout(() => {
        window.location.href = targetURL;
      }, 700);
    });
  });

  // 3) Manejo de navegación “atrás” con popstate
  window.addEventListener('popstate', () => {
    document.body.classList.remove('fade-in');
    document.body.classList.add('fade-out');
    setTimeout(() => window.location.reload(), 500);
  });
});
