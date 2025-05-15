<?php
require_once '../config/db.php';
session_start();

$lang = $_GET['lang'] ?? 'es';
$errores = [];

// Verificar si ya hay sesión o cookie activa
if (isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php?lang=$lang");
    exit;
} elseif (isset($_COOKIE['usuario_id'])) {
    $_SESSION['usuario_id'] = $_COOKIE['usuario_id'];
    $_SESSION['usuario_nombre'] = $_COOKIE['usuario_nombre'];
    header("Location: index.php?lang=$lang");
    exit;
}

// Mostrar mensaje si viene de registro
$registroExitoso = isset($_GET['registro']) && $_GET['registro'] === 'exito';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';
    $recordarme = isset($_POST['recordarme']);

    if (!$usuario || !$contrasena) {
        $errores[] = "Usuario y contraseña son obligatorios.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :usuario OR correo = :usuario LIMIT 1");
        $stmt->execute(['usuario' => $usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($contrasena, $user['contrasena'])) {
            // Iniciar sesión
            $_SESSION['usuario_id'] = $user['id_usuario'];
            $_SESSION['usuario_nombre'] = $user['nombre'];

            // Si eligió recordar sesión, guardar cookie por 30 días
            if ($recordarme) {
                setcookie("usuario_id", $user['id_usuario'], time() + (30 * 24 * 60 * 60), "/");
                setcookie("usuario_nombre", $user['nombre'], time() + (30 * 24 * 60 * 60), "/");
            }

            header("Location: ../index.php?lang=$lang");
            exit;
        } else {
            $errores[] = "Usuario o contraseña incorrectos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="../views/css/login.css">
  <link rel="stylesheet" href="../views/css/font/font.css">
  <link rel="stylesheet" href="../views/css/auth-transitions.css">
  <script defer src="../views/js/auth-carousel.js"></script>
  <script defer src="../views/js/auth-transition.js"></script>
  <style>
    .toggle-password {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
    }
    .password-wrapper {
      position: relative;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="auth-container">
    <!-- IZQUIERDA: Carrusel -->
    <div class="pane carousel-pane">
      <?php foreach (range(1,5) as $n): ?>
        <div class="slide <?= $n===1 ? 'is-active' : '' ?>">
          <img src="../carousel-fotos/<?= $n ?>.jpg" alt="Slide <?= $n ?>">
        </div>
      <?php endforeach ?>
    </div>

    <!-- DERECHA: Formulario -->
    <div class="pane form-pane">
      <h2>Inicio de sesión</h2>

      <?php if ($registroExitoso): ?>
        <div class="exito">¡Registro exitoso! Ahora puedes iniciar sesión.</div>
      <?php endif; ?>

      <?php if (!empty($errores)): ?>
        <div class="errores">
          <ul>
            <?php foreach ($errores as $error): ?>
              <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif; ?>

      <form method="POST" action="login.php?lang=<?= $lang ?>">
        <input type="text" name="usuario" placeholder="Correo o usuario" required value="<?= htmlspecialchars($_POST['usuario'] ?? '') ?>">

        <div class="password-wrapper">
          <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
          <span class="toggle-password" onclick="togglePassword()">👁️</span>
        </div>

        <label style="display: block; margin: 8px 0;">
          <input type="checkbox" name="recordarme" <?= isset($_POST['recordarme']) ? 'checked' : '' ?>> Recordarme
        </label>

        <a class="forgot" href="#">¿Olvidé mi contraseña?</a>
        <button type="submit" class="btn-login">Iniciar sesión</button>
      </form>

      <div class="links">
        <a href="registro.php?lang=<?= $lang ?>" class="switch">¿No tienes cuenta? ¡Regístrate!</a>
        <a href="../index.php?lang=<?= $lang ?>" class="back">Volver a la página principal</a>
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const pass = document.getElementById("contrasena");
      pass.type = (pass.type === "password") ? "text" : "password";
    }
  </script>
</body>
</html>