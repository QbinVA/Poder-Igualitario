<?php
// ver_publicacion.php

require __DIR__.'/config/db.php';                  // Conexión MySQL
require __DIR__.'/azure/config.php';               // Constantes Azure
require __DIR__.'/azure/azure-translator.php';     // Función azureTranslate()

// 1) Idioma y validación de ID
$lang = $_GET['lang'] ?? 'es';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de noticia no válido.");
}
$id_noticia = (int)$_GET['id'];

// 2) Obtener la noticia
$stmt = $pdo->prepare("SELECT * FROM publicaciones WHERE id_noticia = :id");
$stmt->execute([':id' => $id_noticia]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$noticia) {
    die("Noticia no encontrada.");
}

// 3) Imprime HEAD y HEADER sin buffer (no traducidos)
?><!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($noticia['titular']) ?></title>
  <link rel="stylesheet" href="views/css/header.css">
  <link rel="stylesheet" href="views/css/noticia.css">
  <link rel="stylesheet" href="views/css/footer.css">
</head>
<body>
  <?php include __DIR__ . '/views/layouts/header.php'; ?>

<?php
// 4) Inicia buffer para todo lo traducible: <main> + footer
ob_start();
?>

  <main class="noticia-page">
    <section class="encabezado">
      <h1><?= htmlspecialchars($noticia['titular']) ?></h1>
      <p><strong>Fecha:</strong> <?= date("d/m/Y", strtotime($noticia['fecha'])) ?></p>
    </section>

    <?php if (!empty($noticia['url_imagen'])): ?>
      <section class="noticia-figure">
        <img src="<?= htmlspecialchars($noticia['url_imagen']) ?>"
             alt="Imagen de <?= htmlspecialchars($noticia['titular']) ?>">
      </section>
    <?php endif; ?>

    <section class="contenido">
      <?= nl2br(htmlspecialchars($noticia['contenido'])) ?>
    </section>

    <?php if (!empty($noticia['imagenes'])): ?>
      <section class="imagenes">
        <h2>Galería de imágenes</h2>
        <div class="galeria">
          <?php foreach (explode(',', $noticia['imagenes']) as $img): ?>
            <img src="<?= htmlspecialchars(trim($img)) ?>" alt="">
          <?php endforeach; ?>
        </div>
      </section>
    <?php endif; ?>

    <section class="referencia">
      <h3>Referencias</h3>
      <?php if ($noticia['referencia']): ?>
        <a href="<?= htmlspecialchars($noticia['referencia']) ?>" target="_blank">
          Fuente original
        </a>
      <?php else: ?>
        <p>No hay fuente original.</p>
      <?php endif; ?>
    </section>

    <!-- 5) Footer partial dentro del buffer -->
    <?php include __DIR__ . '/views/layouts/footer.php'; ?>

  </main>

</body>
</html>
<?php
// 6) Captura y traduce sólo el buffer
$content = ob_get_clean();
if ($lang === 'en') {
    echo azureTranslate($content, 'en', 'es', true);
} else {
    echo $content;
}
