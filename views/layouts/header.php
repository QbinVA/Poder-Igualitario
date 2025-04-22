<?php
// views/layout/header.php

// Obtiene el idioma actual (por querystring ?lang=es|en)
$lang = $_GET['lang'] ?? 'es';

// Base URL (ajusta si tus archivos están en subdirectorios)
$baseUrl = __DIR__ . '/../../'; 
?>
<link rel="stylesheet" href="<?= $baseUrl ?>views/css/header.css">

<header class="site-header">
  <div class="site-header__inner">
    <!-- Buscador -->
    <div class="search-wrapper">
      <form action="<?= $baseUrl ?>index.php" method="get">
        <input type="hidden" name="lang" value="<?= htmlspecialchars($lang) ?>">
        <input 
          type="text" 
          name="q" 
          class="search-input" 
          placeholder="<?= $lang==='es' ? 'Buscar...' : 'Search...' ?>"
        >
        <button type="submit" class="search-button">🔍</button>
      </form>
    </div>

    <!-- Logo centrado -->
    <div class="logo-wrapper">
      <a href="<?= $baseUrl ?>index.php?lang=<?= htmlspecialchars($lang) ?>" class="logo-link">
        <img src="<?= $baseUrl ?>assets/logo.png" alt="Voces Igualitarias" class="logo-img">
        <span class="logo-text">Voces Igualitarias</span>
      </a>
    </div>

    <!-- Navegación -->
    <nav class="main-nav">
      <a 
        href="<?= $baseUrl ?>index.php?lang=<?= htmlspecialchars($lang) ?>"
        class="<?= basename($_SERVER['PHP_SELF'])==='index.php' ? 'active' : '' ?>"
      >
        <?= $lang==='es' ? 'Noticias' : 'News' ?>
      </a>
      <a 
        href="<?= $baseUrl ?>login.php?lang=<?= htmlspecialchars($lang) ?>"
        class="<?= basename($_SERVER['PHP_SELF'])==='login.php' ? 'active' : '' ?>"
      >
        <?= $lang==='es' ? 'Log in' : 'Log in' ?>
      </a>
    </nav>
  </div>
</header>
