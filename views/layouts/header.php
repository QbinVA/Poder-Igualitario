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
            <a href="/Poder-Igualitario/auth/logout.php?lang=<?= htmlspecialchars($lang) ?>" class="logout">
              <?= $lang==='es'?'Cerrar sesión':'Log out' ?>
            </a>
          </div>
        </div>
        
        <!-- Explicit Logout Button -->
        <a href="/Poder-Igualitario/auth/logout.php?lang=<?= htmlspecialchars($lang) ?>" class="logout-link">
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

<!-- 2) Script que maneja el click y guarda en localStorage -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Language switcher
    document.getElementById('lang-switcher').addEventListener('click', () => {
      // Determina el 'nuevo' idioma
      const current = new URLSearchParams(window.location.search).get('lang') || 'es';
      const next = current === 'es' ? 'en' : 'es';

      // Guárdalo para próximas visitas
      localStorage.setItem('lang', next);

      // Recarga la página con ?lang=next
      const params = new URLSearchParams(window.location.search);
      params.set('lang', next);
      window.location.search = params.toString();
    });

    // User menu hover toggle
    const userMenu = document.querySelector('.user-menu-wrapper');
    if (userMenu) {
      const popup = userMenu.querySelector('.user-popup');
      
      userMenu.addEventListener('mouseenter', () => {
        popup.classList.add('show');
      });
      
      userMenu.addEventListener('mouseleave', () => {
        popup.classList.remove('show');
      });
    }
  });
</script>