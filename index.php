<?php
// index.php

require __DIR__ . '/config/db.php';                  // Conexión a MySQL
require __DIR__ . '/azure/config.php';               // Constantes Azure
require __DIR__ . '/azure/azure-translator.php';     // Función de traducción

//  Idioma solicitado
$lang = $_GET['lang'] ?? 'es';

// Obtén las publicaciones desde la base (siempre en ES)
try {
    $sql  = "SELECT id_noticia, fecha, titular, descripcion_corta, imagen_principal
             FROM publicaciones
             ORDER BY fecha DESC";
    $stmt = $pdo->query($sql);
    $pubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener publicaciones: " . $e->getMessage());
}

// Inicia el buffer
ob_start();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poder Igualitario</title>
  <link rel="stylesheet" href="views/css/index.css">
</head>
<body>
  <main>
    <section class="main-news clickable">
      <?php if (!empty($pubs)): 
        $p = $pubs[0]; ?>
        <a href="ver_publicacion.php?id=<?= $p['id_noticia'] ?>&lang=<?= $lang ?>">
          <img src="uploads/<?= htmlspecialchars($p['imagen_principal']) ?>" alt="">
        </a>
        <h4><?= htmlspecialchars($p['titular']) ?></h4>
        <p><?= htmlspecialchars($p['descripcion_corta']) ?></p>
        <p class="publication-date">
          <?= ($lang === 'es')
                ? date("d/m/Y", strtotime($p['fecha']))
                : date("m/d/Y", strtotime($p['fecha'])); ?>
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
// Captura el HTML
$html = ob_get_clean();

// Si pidieron English, traduce todo conservando etiquetas
if ($lang === 'en') {
    echo azureTranslate($html, 'en', 'es', true);
} else {
    echo $html;
}
