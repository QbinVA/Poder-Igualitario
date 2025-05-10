<?php

// ver_publicacion.php

require dirname(__DIR__, 2) . '/config/db.php';
require dirname(__DIR__, 2) . '/azure/config.php';
require dirname(__DIR__, 2) . '/azure/azure-translator.php';

$lang = $_GET['lang'] ?? 'es';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de noticia no válido.");
}
$id_noticia = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM publicaciones WHERE id_noticia = :id");
$stmt->execute([':id' => $id_noticia]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$noticia) {
    die("Noticia no encontrada.");
}
?><!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($noticia['titular']) ?></title>
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/noticia.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../css/font/font.css">
  <style>
    .descripcion-centrada,
    .fecha-centrada {
      text-align: center;
      font-style: italic;
      margin: 1em 0;
    }
    .imagen-principal {
      display: block;
      max-width: 100%;
      margin: 1em auto;
    }
  </style>
</head>
<body>
  <?php include __DIR__ . '/header.php'; ?>

<?php ob_start(); ?>

<main class="noticia-page">
  <section class="encabezado">
    <h1><?= htmlspecialchars($noticia['titular']) ?></h1>
  </section>

  <section class="descripcion-centrada">
    <p><?= nl2br(htmlspecialchars($noticia['descripcion_corta'])) ?></p>
  </section>

  <?php if (!empty($noticia['imagen_principal'])): ?>
    <section class="noticia-figure">
      <img class="imagen-principal" src="../../uploads/<?= htmlspecialchars($noticia['imagen_principal']) ?>" alt="Imagen principal">
    </section>
  <?php endif; ?>

  <section class="contenido">
    <?= nl2br(htmlspecialchars($noticia['contenido'])) ?>
  </section>

  <section class="fecha-centrada">
    <p><strong></strong> <?= date("d/m/Y", strtotime($noticia['fecha'])) ?></p>
  </section>

  <?php if (!empty($noticia['referencia'])): ?>
    <section class="referencia">
      <h3>Referencia</h3>
      <a href="<?= htmlspecialchars($noticia['referencia']) ?>" target="_blank">
        <?= htmlspecialchars($noticia['referencia']) ?>
      </a>
    </section>
  <?php endif; ?>

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

  <?php include __DIR__ . '/footer.php'; ?>
</main>

</body>
</html>

<?php
$content = ob_get_clean();
echo ($lang === 'en') ? azureTranslate($content, 'en', 'es', true) : $content;
?>