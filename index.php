<?php
require 'db.php'; // Conexión a la base de datos

// Obtener todas las publicaciones
try {
    $sql = "SELECT id_noticia, fecha, titular, descripcion_corta, imagen_principal FROM publicaciones ORDER BY fecha DESC";
    $stmt = $pdo->query($sql);
    $publicaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener publicaciones: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poder Igualitario</title>
    <link rel="stylesheet" href="styles/indexStyles.css">
</style>
</head>
<body>
    <header>
        <div class="blog-intro">
            <h1>Poder Igualitario</h1>
            <h4>Blog Web dedicado a noticias sobre la batalla a favor de la igualdad de género.</h4>
        </div>
    </header>

    <main>
        <!-- Mostrar la noticia principal -->
        <section class="main-news clickable">
            <?php if (!empty($publicaciones)): ?>
                <a href="ver_publicacion.php?id=<?php echo $publicaciones[0]['id_noticia']; ?>" title="Este apartado te lleva a la noticia principal del blog">
                    <img src="uploads/<?php echo $publicaciones[0]['imagen_principal']; ?>" alt="Imagen sobre la noticia principal">
                </a>
                <h4><?php echo htmlspecialchars($publicaciones[0]['titular']); ?></h4>
                <p><?php echo htmlspecialchars($publicaciones[0]['descripcion_corta']); ?></p>
                <p class="publication-date"><?php echo date("d/m/Y", strtotime($publicaciones[0]['fecha'])); ?></p>
            <?php endif; ?>
        </section>

        <!-- Mostrar las noticias secundarias -->
        <section class="secondary-news">
            <?php foreach ($publicaciones as $key => $publicacion): ?>
                <?php if ($key > 0): ?>
                    <div class="news-item clickable">
                        <a href="ver_publicacion.php?id=<?php echo $publicacion['id_noticia']; ?>" title="Este apartado te lleva a una de las noticias secundarias del blog">
                            <img src="uploads/<?php echo $publicacion['imagen_principal']; ?>" alt="Imagen de la noticia secundaria">
                        </a>
                        <div>
                            <h5><?php echo htmlspecialchars($publicacion['titular']); ?></h5>
                            <p><?php echo htmlspecialchars($publicacion['descripcion_corta']); ?></p>
                            <p class="publication-date"><?php echo date("d/m/Y", strtotime($publicacion['fecha'])); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </section>
    </main>

    <footer>
        <p>Las noticias encontradas en este blog no fueron redactadas por nuestro equipo, solo nos encargamos de difundir información.</p>
        <div class="hidden-square" onclick="location.href='Login.html'">
            <button onclick="location.href='Login.html'"></button>
        </div>
    </footer>
</body>
</html>
