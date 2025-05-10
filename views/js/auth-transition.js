// views/js/auth-transition.js
document.addEventListener('DOMContentLoaded', () => {
  // 1) Fade-in al cargar
  document.body.classList.add('fade-in');

  // 2) Capturamos el enlace de "switch" (login↔signup)
  const switchLink = document.querySelector('.links .switch');
  if (!switchLink) return;

  switchLink.addEventListener('click', e => {
    e.preventDefault();
    // arrancamos el fade-out
    document.body.classList.remove('fade-in');
    document.body.classList.add('fade-out');

    // tras 500ms (misma duración que el transition), navegamos
    setTimeout(() => {
      window.location.href = switchLink.href;
    }, 500);
  });
});
