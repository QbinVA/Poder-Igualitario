<?php
// index.php

require 'db.php';                  // tu conexión a MySQL
require 'azure-translator.php';    // el helper que ya probamos

// 1) ¿Idioma solicitado? 'es' por defecto
$lang = $_GET['lang'] ?? 'es';

// 2) Traer publicaciones (siempre en ES)
try {
    $sql  = "SELECT id_noticia, fecha, titular, descripcion_corta, imagen_principal
             FROM publicaciones
             ORDER BY fecha DESC";
    $stmt = $pdo->query($sql);
    $pubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener publicaciones: " . $e->getMessage());
}

// 3) Iniciar buffer de salida
ob_start();
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poder Igualitario</title>
  <link rel="stylesheet" href="styles/indexStyles.css">
  <style>
    header { position: relative; }
    #lang-switcher { position: absolute; top:15px; right:15px; }
  </style>
</head>
<body>
  <header>
    <div class="blog-intro">
      <h1>Poder Igualitario</h1>
      <h4>Blog Web dedicado a noticias sobre la batalla a favor de la igualdad de género.</h4>
    </div>

    <div id="lang-switcher">
      <?php if ($lang === 'es'): ?>
        <a href="?lang=en"
           style="background:black;color:white;padding:8px 12px;border-radius:5px;text-decoration:none;">
          🌐 English
        </a>
      <?php else: ?>
        <a href="?lang=es"
           style="background:black;color:white;padding:8px 12px;border-radius:5px;text-decoration:none;">
          🌐 Español
        </a>
      <?php endif; ?>
    </div>
  </header>

  <main>
    <section class="main-news clickable">
      <?php if (!empty($pubs)):
        $p = $pubs[0];
      ?>
        <a href="ver_publicacion.php?id=<?= $p['id_noticia'] ?>&lang=<?= $lang ?>">
          <img src="uploads/<?= htmlspecialchars($p['imagen_principal']) ?>" alt="">
        </a>
        <h4><?= htmlspecialchars($p['titular']) ?></h4>
        <p><?= htmlspecialchars($p['descripcion_corta']) ?></p>
        <p class="publication-date">
          <?php
            echo ($lang === 'es')
              ? date("d/m/Y", strtotime($p['fecha']))
              : date("m/d/Y", strtotime($p['fecha']));
          ?>
        </p>
      <?php endif; ?>
    </section>

    <section class="secondary-news">
      <?php foreach ($pubs as $i => $pub):
              if ($i > 0): ?>
        <div class="news-item clickable">
          <a href="ver_publicacion.php?id=<?= $pub['id_noticia'] ?>&lang=<?= $lang ?>">
            <img src="uploads/<?= htmlspecialchars($pub['imagen_principal']) ?>" alt="">
          </a>
          <div>
            <h5><?= htmlspecialchars($pub['titular']) ?></h5>
            <p><?= htmlspecialchars($pub['descripcion_corta']) ?></p>
            <p class="publication-date">
              <?= ($lang === 'es')
                    ? date("d/m/Y", strtotime($pub['fecha']))
                    : date("m/d/Y", strtotime($pub['fecha'])); ?>
            </p>
          </div>
        </div>
      <?php 
              endif;
            endforeach; ?>
    </section>
  </main>

  <footer>
    <p>Las noticias encontradas en este blog no fueron redactadas por nuestro equipo; solo nos encargamos de difundir información.</p>
  </footer>
</body>
</html>
<?php
// 4) Capturar HTML completo
$html = ob_get_clean();

// 5) Si pidieron inglés, traducir TODO el HTML preservando tags
if ($lang === 'en') {
    echo azureTranslate($html, 'en', 'es', true);
} else {
    echo $html;
}
