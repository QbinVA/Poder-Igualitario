<?php
// views/layouts/header.php

// Recupera el idioma 'oficial' de la URL o por defecto 'es'
$lang = $_GET['lang'] ?? 'es';
$self = basename($_SERVER['PHP_SELF']);
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

    <!-- Cambio de idioma + login -->
    <nav class="main-nav">
      <button id="lang-switcher" class="lang-switch">
        🌐 <?= $lang==='es'?'English':'Español' ?>
      </button>
      <a
        href="/Poder-Igualitario/auth/login.php?lang=<?= htmlspecialchars($lang) ?>"
        class="login-link"
      >
        <?= $lang==='es'?'Log in':'Log in' ?>
      </a>
    </nav>
  </div>
</header>

<!-- 2) Script que maneja el click y guarda en localStorage -->
<script>
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
</script>
