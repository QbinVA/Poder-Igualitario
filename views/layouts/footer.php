<style>
  /* ===== Footer ===== */
  .site-footer {
    background-color: #0a1f38;
    color: #ffffff;
    padding: 20px 0;
  }

  .site-footer__inner {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 20px;
    /* Aquí el padding controla el margen interno general */
  }

  /* Frase centrada */
  .site-footer__inner > p {
    color: #ffffff;
    font-size: 1.25rem;
    line-height: 1.5;
    text-align: center;
    margin-bottom: 20px;
    /* Si quieres mover la frase más a la izquierda, puedes cambiar "text-align" a "left" aquí */
  }

  /* Enlaces a la izquierda extrema */
  .footer-links-left {
    display: flex;
    flex-direction: column;
    gap: -1.0rem;
    /* Este elimina el margen interno del contenedor padre */
    margin-left: -800px; /* Puedes aumentar el valor negativo para moverlo más a la izquierda */
    /* EJEMPLO: prueba con -40px si lo quieres más a la izquierda */
  }

  .footer-links-left a {
    color:rgb(255, 255, 255);
    text-decoration: none;
  }

  .footer-links-left a:hover {
    text-decoration: underline;
  }
</style>

<footer class="site-footer">
  <div class="site-footer__inner">
    <p>“Voces que inspiran, acciones que transforman.”</p>

    <div class="footer-links-left">
      <p>
        <a href="/Poder-Igualitario/aviso-privacidad.php?lang=<?= htmlspecialchars($lang) ?>">
          <?= $lang === 'es' ? 'Aviso de Privacidad' : 'Privacy Notice' ?>
        
      </p>
      <p>
      <a href="/Poder-Igualitario/terminos-condiciones.php?lang=<?= htmlspecialchars($lang) ?>">
          <?= $lang === 'es' ? 'Términos y Condiciones' : 'Terms and Conditions' ?>
        </a>
      </p>
    </div>
  </div>
</footer>
