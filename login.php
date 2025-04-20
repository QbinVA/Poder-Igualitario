<?php
session_start();
require 'config/db.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    // Buscar en la tabla admin
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE nombre = :usuario");
    $stmt->execute(['usuario' => $usuario]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Validar contraseña (nota: sin hash)
    if ($admin && $password === $admin['contrasena']) {
        $_SESSION['usuario'] = $admin['nombre'];
        $_SESSION['is_admin'] = true;

        header('Location: admin.php'); // o el archivo correcto del panel
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
        echo "<p style='color:red;'>$error</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/loginStyles.css">
    <style>
  /* Ocultar barra de Google Translate */
  .goog-te-banner-frame.skiptranslate,
  .goog-logo-link,
  .goog-te-gadget {
    display: none !important;
  }

  body {
    top: 0px !important;
  }
</style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <form method="POST">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Ingresar</button>
        </form>
    </div>
    <!-- 🌐 Botón de idioma personalizado -->
<div id="language-switcher" style="text-align: right; padding: 10px;">
  <button id="lang-btn" onclick="changeLanguage('en')" style="
      background-color: black;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 14px;
  ">🌐 Inglés</button>
</div>

<!-- Contenedor oculto de Google Translate -->
<div id="google_translate_element" style="display: none;"></div>

<!-- Script para manejar cambio de idioma -->
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'es',
      includedLanguages: 'es,en',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }

  function changeLanguage(lang) {
    const select = document.querySelector('.goog-te-combo');
    if (select) {
      select.value = lang;
      select.dispatchEvent(new Event('change'));

      // Guardar preferencia en navegador
      localStorage.setItem('idiomaPreferido', lang);

      // Cambiar texto del botón
      const btn = document.getElementById('lang-btn');
      const nextLang = lang === 'en' ? 'es' : 'en';
      btn.textContent = nextLang === 'en' ? '🌐 Inglés' : '🌐 Español';
      btn.setAttribute('onclick', `changeLanguage('${nextLang}')`);
    }
  }

  // Aplicar idioma guardado
  window.addEventListener('load', () => {
    const lang = localStorage.getItem('idiomaPreferido');
    if (lang) {
      const interval = setInterval(() => {
        const select = document.querySelector('.goog-te-combo');
        if (select) {
          changeLanguage(lang);
          clearInterval(interval);
        }
      }, 300);
    }
  });
</script>

<!-- Script de Google Translate -->
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>