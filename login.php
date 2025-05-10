<?php 
  // login.php
  $lang = $_GET['lang'] ?? 'es';
?><!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Log in</title>
  <link rel="stylesheet" href="views/css/login.css">
  <script defer src="views/js/auth-carousel.js"></script>
</head>
<body>
  <div class="auth-container">
    <!-- IZQ: Carrusel -->
    <div class="pane carousel-pane">
      <?php foreach (range(1,5) as $n): ?>
        <div class="slide <?= $n===1?'is-active':'' ?>">
          <img src="carousel-fotos/<?= $n ?>.jpg" alt="Slide <?= $n ?>">
        </div>
      <?php endforeach ?>
    </div>
    <!-- DER: Formulario -->
    <div class="pane form-pane">
      <h2>Inicio de sesión</h2>
      <form>
        <input type="email" placeholder="Correo" required>
        <input type="password" placeholder="Contraseña" required>
        <a class="forgot" href="#">¿Olvidé mi contraseña?</a>
        <button type="submit" class="btn-login">Iniciar sesión</button>
      </form>
      <div class="links">
        <a href="registro.php?lang=<?= $lang ?>" class="switch">¿No tienes cuenta? ¡Regístrate!</a>
        <a href="index.php?lang=<?= $lang ?>" class="back">Volver a la página principal</a>
      </div>
    </div>
  </div>

</body>
</html>
