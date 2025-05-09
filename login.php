<?php
// login.php
$lang = $_GET['lang'] ?? 'es';
?><!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Inicio de Sesión</title>
  <link rel="stylesheet" href="views/css/login.css">
  <script defer src="views/js/auth-carousel.js"></script>
</head>
<body class="fade-in">
  <div class="auth-container">
    <!-- izquierda: carrusel -->
    <div class="pane carousel-pane">
      <div class="slide is-active"><img src="carousel-fotos/1.jpg" alt=""></div>
      <div class="slide"><img src="carousel-fotos/2.jpg" alt=""></div>
      <div class="slide"><img src="carousel-fotos/3.jpg" alt=""></div>
      <div class="slide"><img src="carousel-fotos/4.jpg" alt=""></div>
    </div>
    <!-- derecha: formulario -->
    <div class="pane form-pane">
      <h2>Inicio de Sesión</h2>
      <form method="post" action="login.php">
        <input type="email"    placeholder="Correo"     required>
        <input type="password" placeholder="Contraseña" required>
        <a href="#" class="forgot">¿Olvidé mi contraseña?</a>
        <div class="tos">
          <input type="checkbox" id="tos-login"><label for="tos-login">Acepto términos y condiciones</label>
        </div>
        <button type="submit" class="btn">Iniciar sesión</button>
      </form>
      <div class="links">
        <a href="registro.php?lang=<?= $lang ?>" class="switch">¿No tienes una cuenta? ¡Crea una hoy!</a>
        <a href="index.php?lang=<?= $lang ?>" class="back">Regresar a la página principal</a>
      </div>
    </div>
  </div>
</body>
</html>
