<?php
// registro.php
$lang = $_GET['lang'] ?? 'es';
?><!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Registro</title>
  <link rel="stylesheet" href="views/css/signup.css">
  <script defer src="views/js/auth-carousel.js"></script>
</head>
<body class="fade-in">
  <div class="auth-container reverse">
    <!-- izquierda: formulario -->
    <div class="pane form-pane">
      <h2>Registro</h2>
      <form method="post" action="registro.php">
        <input type="email"    placeholder="Correo"         required>
        <input type="text"     placeholder="Usuario"       required>
        <input type="password" placeholder="Contraseña"    required>
        <input type="password" placeholder="Confirmar contraseña" required>
        <div class="tos">
          <input type="checkbox" id="tos-signup"><label for="tos-signup">Acepto términos y condiciones</label>
        </div>
        <button type="submit" class="btn">Registrarme</button>
      </form>
      <div class="links">
        <a href="login.php?lang=<?= $lang ?>" class="switch">¿Ya tienes cuenta? Inicia sesión</a>
        <a href="index.php?lang=<?= $lang ?>" class="back">Regresar a la página principal</a>
      </div>
    </div>
    <!-- derecha: carrusel -->
    <div class="pane carousel-pane">
      <div class="slide is-active"><img src="carousel-fotos/1.jpg" alt=""></div>
      <div class="slide"><img src="carousel-fotos/2.jpg" alt=""></div>
      <div class="slide"><img src="carousel-fotos/3.jpg" alt=""></div>
      <div class="slide"><img src="carousel-fotos/4.jpg" alt=""></div>
    </div>
  </div>
</body>
</html>
