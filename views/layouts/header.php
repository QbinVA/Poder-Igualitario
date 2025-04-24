<?php
// views/layouts/header.php

// Recupera el idioma actual (viene de ?lang=es|en)
$lang = $_GET['lang'] ?? 'es';
$self = basename($_SERVER['PHP_SELF']);
?>
<header class="site-header">
  <div class="site-header__inner">
    <!-- Buscador -->
    <form action="index.php" method="get" class="search-form">
      <input type="hidden" name="lang" value="<?= htmlspecialchars($lang) ?>">
      <input
        type="text"
        name="q"
        class="search-input"
        placeholder="<?= $lang === 'es' ? 'Buscar...' : 'Search...' ?>"
      >
      <button type="submit" class="search-button">🔍</button>
    </form>

    <!-- Logo -->
    <a href="index.php?lang=<?= htmlspecialchars($lang) ?>" class="logo">
      <img src="Iguales.png" alt="" class="logo-img">
      <span class="logo-text" translate="no">Voces Igualitarias</span>
    </a>

    <!-- Language switch + Login -->
    <nav class="main-nav">
      <a
        href="<?= $self ?>?lang=<?= $lang === 'es' ? 'en' : 'es' ?>"
        class="lang-switch"
      >
        🌐 <?= $lang === 'es' ? 'English' : 'Español' ?>
      </a>
      <a
        href="login.php?lang=<?= htmlspecialchars($lang) ?>"
        class="login-link"
      >
        <?= $lang === 'es' ? 'Log in' : 'Log in' ?>
      </a>
    </nav>
  </div>
</header>
