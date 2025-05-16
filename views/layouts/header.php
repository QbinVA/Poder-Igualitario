<?php
// views/layouts/header.php

// Recupera el idioma 'oficial' de la URL o por defecto 'es'
$lang = $_GET['lang'] ?? 'es';
$self = basename($_SERVER['PHP_SELF']);

// Verificar si hay sesión activa
$isLoggedIn = isset($_SESSION['usuario_id']) || isset($_COOKIE['usuario_id']);
$nombreUsuario = $_SESSION['usuario_nombre'] ?? $_COOKIE['usuario_nombre'] ?? '';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Tus CSS -->
  <link rel="stylesheet" href="views/css/header.css">
  <!-- ...otros CSS si los necesitas-->

  <!-- 1) Script para sincronizar URL ⇆ localStorage -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const params = new URLSearchParams(window.location.search);
      const urlLang = params.get('lang');
      const savedLang = localStorage.getItem('lang');

      // Si ya guardé un idioma antes y la URL NO lo tiene, lo establezco
      if (savedLang && !urlLang) {
        params.set('lang', savedLang);
        window.location.search = params.toString();
      }
    });
  </script>
</head>
<body>
<header class="site-header">
  <div class="site-header__inner">
    <!-- Logo -->
    <a href="/Poder-Igualitario/index.php?lang=<?= htmlspecialchars($lang) ?>" class="logo">
      <img src="/Poder-Igualitario/views/assets/Iguales.png" alt="" class="logo-img">
      <span class="logo-text" translate="no">Voces Igualitarias</span>
    </a>

    <!-- Cambio de idioma + login/user menu -->
    <nav class="main-nav">
      <button id="lang-switcher" class="lang-switch">
        🌐 <?= $lang==='es'?'English':'Español' ?>
      </button>
      
      <?php if ($isLoggedIn): ?>
        <!-- Logged-in state -->
        <div class="user-menu-wrapper">
          <div class="user-info">
            <button class="btn-user">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" fill="white"/>
                <path d="M12 14C7.58172 14 4 17.5817 4 22H20C20 17.5817 16.4183 14 12 14Z" fill="white"/>
              </svg>
            </button>
            <span class="username"><?= htmlspecialchars($nombreUsuario) ?></span>
          </div>
          <div class="user-popup">
            <a href="#" class="logout" id="logout-link">
              <?= $lang==='es'?'Cerrar sesión':'Log out' ?>
            </a>
          </div>
        </div>
        
        <!-- Explicit Logout Button -->
        <a href="#" class="logout-link" id="logout-link-explicit">
          <?= $lang==='es'?'Cerrar sesión':'Log out' ?>
        </a>
      <?php else: ?>
        <!-- Logged-out state -->
        <a href="/Poder-Igualitario/auth/login.php?lang=<?= htmlspecialchars($lang) ?>" class="login-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" fill="white"/>
            <path d="M12 14C7.58172 14 4 17.5817 4 22H20C20 17.5817 16.4183 14 12 14Z" fill="white"/>
          </svg>
          <?= $lang==='es'?'Iniciar sesión':'Log in' ?>
        </a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<!-- Incluir el sistema de notificaciones -->
<?php include 'notificaciones.php'; ?>

<!-- Script para manejar el cierre de sesión con confirmación -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const logoutLinks = document.querySelectorAll('#logout-link, #logout-link-explicit');

    logoutLinks.forEach(link => {
      link.addEventListener('click', (event) => {
        event.preventDefault(); // Evita la redirección inmediata

        // Muestra el cuadro de confirmación
        mostrarConfirmacion(
          '<?= $lang === "es" ? "¿Estás seguro de que deseas cerrar sesión?" : "Are you sure you want to log out?" ?>',
          () => {
            // Redirige al cerrar sesión si el usuario confirma
            window.location.href = '/Poder-Igualitario/auth/logout.php?lang=<?= htmlspecialchars($lang) ?>';
          }
        );
      });
    });
  });
</script>
</body>
</html>