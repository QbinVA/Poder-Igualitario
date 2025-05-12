<?php 
  // registro.php
  $lang = $_GET['lang'] ?? 'es';
?><!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Registro</title>
  <link rel="stylesheet" href="../views/css/registro.css">
  <link rel="stylesheet" href="../views/css/font/font.css">
  <link rel="stylesheet" href="../views/css/auth-transitions.css">
  <script defer src="../views/js/auth-carousel.js"></script>
  <script defer src="../views/js/auth-transition.js"></script>
</head>
<body>
  <div class="auth-container">
    <!-- IZQ: Formulario -->
    <div class="pane form-pane">
      <h2>Registro</h2>
      <form>
        <input type="email" placeholder="Correo" required>
        <input type="text" placeholder="Usuario" required>
        <input type="password" placeholder="Contraseña" required>
        <input type="password" placeholder="Confirmar contraseña" required>
        <div class="tos">
          <input type="checkbox" id="tos-signup">
          <label for="tos-signup">Acepto términos y condiciones</label>
        </div>
        <button type="submit" class="btn-signup">Registrarme</button>
      </form>
      <div class="links">
        <a href="login.php?lang=<?= $lang ?>" class="switch">¿Ya tienes cuenta? ¡Inicia sesión!</a>
      </div>
    </div>
    <!-- DER: Carrusel -->
    <div class="pane carousel-pane">
      <?php foreach (range(1,5) as $n): ?>
        <div class="slide <?= $n===1 ? 'is-active' : '' ?>">
          <img src="../carousel-fotos/<?= $n ?>.jpg" alt="Slide <?= $n ?>">
        </div>
      <?php endforeach ?>
    </div>
  </div>

</body>
</html>