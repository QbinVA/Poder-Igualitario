<?php
// index.php

require __DIR__ . '/config/db.php';                  // Conexión a MySQL
require __DIR__ . '/azure/config.php';               // Constantes Azure
require __DIR__ . '/azure/azure-translator.php';     // Función de traducción

// Idioma solicitado
$lang = $_GET['lang'] ?? 'es';

// Traer publicaciones (siempre en ES)
try {
    $sql  = "SELECT id_noticia, fecha, titular, descripcion_corta, imagen_principal
             FROM publicaciones
             ORDER BY fecha DESC";
    $stmt = $pdo->query($sql);
    $pubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener publicaciones: " . $e->getMessage());
}

//
// 1) Salida fija de <head> y header (no se traduce)
//
?><!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poder Igualitario</title>
  <link rel="stylesheet" href="views/css/index.css">
  <link rel="stylesheet" href="views/css/header.css">
  <link rel="stylesheet" href="views/css/footer.css">
</head>
<body>
  <?php include __DIR__ . '/views/layouts/header.php'; ?>

<?php
//
// 2) Abrimos buffer para TODO lo que sí queremos traducir,
//    incluyendo <main> y el footer.
// 
ob_start();
?>

  <main>
    <section class="main-news">
      <?php if (!empty($pubs)):
        $p = $pubs[0]; ?>
        <a href="ver_publicacion.php?id=<?= $p['id_noticia'] ?>&lang=<?= $lang ?>" class="main-news-link">
          <div class="main-news-card clickable">
            <img src="uploads/<?= htmlspecialchars($p['imagen_principal']) ?>" alt="">
            <h4><?= htmlspecialchars($p['titular']) ?></h4>
            <p><?= htmlspecialchars($p['descripcion_corta']) ?></p>
            <p class="publication-date">
              <?= ($lang === 'es')
                    ? date("d/m/Y", strtotime($p['fecha']))
                    : date("m/d/Y", strtotime($p['fecha'])); ?>
            </p>
          </div>
        </a>
      <?php endif; ?>
    </section>

    <section class="secondary-news">
      <?php foreach ($pubs as $i => $pub):
              if ($i > 0): ?>
        <a href="ver_publicacion.php?id=<?= $pub['id_noticia'] ?>&lang=<?= $lang ?>" class="news-item-link">
          <div class="news-item-card clickable">
            <div class="news-item">
              <img src="uploads/<?= htmlspecialchars($pub['imagen_principal']) ?>" alt="">
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
          </div>
        </a>
      <?php 
              endif;
            endforeach; ?>
    </section>
  </main>

  <?php include __DIR__ . '/views/layouts/footer.php'; ?>

</body>
</html>

<?php
// 3) Capturamos todo el contenido traducible
$content = ob_get_clean();

// 4) Imprime el contenido, traducido solo si el lang es 'en'
if ($lang === 'en') {
    echo azureTranslate($content, 'en', 'es', true);
} else {
    echo $content;
}
