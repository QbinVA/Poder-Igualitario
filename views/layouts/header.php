<?php
// views/layouts/header.php

// Recupera el idioma actual (viene de ?lang=es o ?lang=en)
$lang = $_GET['lang'] ?? 'es';
?>
<header class="site-header">
  <div class="site-header__inner">
    <!-- Buscador -->
    <div class="search-wrapper">
      <form action="index.php" method="get">
        <input type="hidden" name="lang" value="<?= htmlspecialchars($lang) ?>">
        <input
          type="text"
          name="q"
          class="search-input"
          placeholder="<?= $lang === 'es' ? 'Buscar...' : 'Search...' ?>"
        >
        <button type="submit" class="search-button">🔍</button>
      </form>
    </div>

    <!-- Logo centrado -->
    <div class="logo-wrapper">
      <a href="index.php?lang=<?= htmlspecialchars($lang) ?>" class="logo-link">
        <img src="assets/logo.png" alt="Voces Igualitarias" class="logo-img">
        <span class="logo-text">Voces Igualitarias</span>
      </a>
    </div>

    <!-- Navegación -->
    <nav class="main-nav">
      <a
        href="index.php?lang=<?= htmlspecialchars($lang) ?>"
        class="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>"
      >
        <?= $lang === 'es' ? 'Noticias' : 'News' ?>
      </a>
      <a
        href="login.php?lang=<?= htmlspecialchars($lang) ?>"
        class="<?= basename($_SERVER['PHP_SELF']) === 'login.php' ? 'active' : '' ?>"
      >
        <?= $lang === 'es' ? 'Log in' : 'Log in' ?>
      </a>
    </nav>

    <!-- Language switcher -->
    <div class="lang-switcher">
  <?php if ($lang === 'es'): ?>
    <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?lang=en" class="lang-btn">
      🌐 English
    </a>
  <?php else: ?>
    <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?lang=es" class="lang-btn">
      🌐 Español
    </a>
  <?php endif; ?>
</div>
</header>
