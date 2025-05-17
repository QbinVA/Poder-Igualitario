<?php
// ver_publicacion.php

session_start();
require dirname(__DIR__, 2) . '/config/db.php';
require dirname(__DIR__, 2) . '/azure/config.php';
require dirname(__DIR__, 2) . '/azure/azure-translator.php';

$lang = $_GET['lang'] ?? 'es';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de noticia no válido.");
}
$id_noticia = (int)$_GET['id'];

// Recuperar la noticia
$stmt = $pdo->prepare("SELECT * FROM publicaciones WHERE id_noticia = :id");
$stmt->execute([':id' => $id_noticia]);
$noticia = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$noticia) {
    die("Noticia no encontrada.");
}

// Procesar el comentario si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'])) {
    if (!isset($_SESSION['usuario_id'])) {
        die("Debes iniciar sesión para comentar.");
    }

    $comentario = trim($_POST['comentario']);
    if (!empty($comentario)) {
        $stmt = $pdo->prepare("INSERT INTO comentarios (id_noticia, id_usuario, comentario, fecha_comentario) VALUES (:id_noticia, :id_usuario, :comentario, NOW())");
        $stmt->execute([
            ':id_noticia' => $id_noticia,
            ':id_usuario' => $_SESSION['usuario_id'],
            ':comentario' => $comentario
        ]);
        header("Location: ver_publicacion.php?id=$id_noticia&lang=$lang");
        exit;
    }
}

// Recuperar comentarios existentes
$stmt = $pdo->prepare("SELECT c.comentario, c.fecha_comentario, u.nombre 
                       FROM comentarios c 
                       JOIN usuarios u ON c.id_usuario = u.id_usuario 
                       WHERE c.id_noticia = :id_noticia 
                       ORDER BY c.fecha_comentario DESC");
$stmt->execute([':id_noticia' => $id_noticia]);
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
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
    /* Estilos para la sección de comentarios */
    .comentarios-seccion {
      max-width: 700px;
      margin: 40px auto 70px;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    }
    
    .comentarios-titulo {
      font-size: 1.5rem;
      margin-bottom: 20px;
      color: #333;
      position: relative;
      padding-bottom: 10px;
      border-bottom: 1px solid #e0e0e0;
    }
    
    .comentarios-vacio {
      text-align: center;
      padding: 30px 0;
      color: #666;
      font-style: italic;
    }
    
    .comentar-form {
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid #e0e0e0;
    }
    
    .comentar-form textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 4px;
      resize: vertical;
      min-height: 100px;
      margin-bottom: 15px;
      font-family: inherit;
    }
    
    .comentar-form button {
      background: linear-gradient(to right, #00bcd4, #009688);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .comentar-form button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <?php include __DIR__ . '/header.php'; ?>

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

  <!-- Sección de comentarios -->
  <section class="comentarios-seccion">
    <h2 class="comentarios-titulo">Comentarios</h2>

    <?php if (!empty($comentarios)): ?>
      <div class="comentarios-lista">
        <?php foreach ($comentarios as $comentario): ?>
          <div class="comentario">
            <p><strong><?= htmlspecialchars($comentario['nombre']) ?></strong> - <?= date("d/m/Y H:i", strtotime($comentario['fecha_comentario'])) ?></p>
            <p><?= nl2br(htmlspecialchars($comentario['comentario'])) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="comentarios-vacio">
        Todavía no hay comentarios existentes. ¡Sé el primero en comentar!
      </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['usuario_id'])): ?>
      <form class="comentar-form" method="POST">
        <textarea name="comentario" placeholder="Escribe tu comentario aquí..." required></textarea>
        <button type="submit">Publicar comentario</button>
      </form>
    <?php else: ?>
      <div class="comentarios-vacio">
        Debes <a href="/Poder-Igualitario/auth/login.php?lang=<?= htmlspecialchars($lang) ?>">iniciar sesión</a> para comentar.
      </div>
    <?php endif; ?>
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

  <?php include __DIR__ . '/footer.php'; ?>
</main>

</body>
</html>

<?php
$content = ob_get_clean();
echo ($lang === 'en') ? azureTranslate($content, 'en', 'es', true) : $content;
?>