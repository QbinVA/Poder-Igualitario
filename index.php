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
           WHERE archivada = 0
           ORDER BY fecha DESC"; // Solo mostrar noticias no archivadas
  $stmt = $pdo->query($sql);
  $pubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Error al obtener publicaciones: " . $e->getMessage());
}

// 1) Salida fija de <head> y header (no se traduce)
?><!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poder Igualitario</title>

  <!-- Tus estilos habituales -->
  <link rel="stylesheet" href="views/css/index.css">
  <link rel="stylesheet" href="views/css/header.css">
  <link rel="stylesheet" href="views/css/footer.css">
</head>
<body>
  <!-- Header fijo -->
  <?php include __DIR__ . '/views/layouts/header.php'; ?>

    <!-- Slider pequeñito -->
  <section id="slider-panel">
    <?php
      $imgs = glob(__DIR__ . '/carousel-fotos/*.jpg');
      shuffle($imgs);
      $imgs = array_slice($imgs, 0, 4); // tomo 4 imágenes al azar
      foreach ($imgs as $i => $file):
        $url = basename($file);
    ?>
      <img src="carousel-fotos/<?= $url ?>" class="<?= $i === 0 ? 'active' : '' ?>">
    <?php endforeach; ?>
  </section>

<?php
// 2) Abrimos buffer para TODO lo que SÍ queremos traducir:
//    <main> y el footer partial
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

  <!-- Footer (dentro del buffer para traducción) -->
  <?php include __DIR__ . '/views/layouts/footer.php'; ?>

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('#slider-panel img');
    let idx = 0;
    setInterval(() => {
      slides[idx].classList.remove('active');
      idx = (idx + 1) % slides.length;
      slides[idx].classList.add('active');
    }, 3000);
  });
</script>
</body>
</html>
<?php
// 3) Capturamos todo el contenido traducible
$content = ob_get_clean();
// 4) Imprimir traducido si lang='en'
if ($lang === 'en') {
    echo azureTranslate($content, 'en', 'es', true);
} else {
    echo $content;
}
?>
