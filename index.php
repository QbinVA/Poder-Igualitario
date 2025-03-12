<?php
require 'db.php'; // Conexión a la base de datos

// Obtener las últimas publicaciones
try {
    // Seleccionamos las columnas que queremos mostrar
    $sql = "SELECT id_noticia, fecha, titular, descripcion_corta, imagen_principal FROM publicaciones ORDER BY fecha DESC LIMIT 3";
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
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
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
                    <!-- Comprobamos si la imagen existe -->
                    <img src="uploads/<?php echo $publicaciones[0]['imagen_principal']; ?>" alt="Imagen sobre la noticia principal">
                </a>
                <h4><?php echo htmlspecialchars($publicaciones[0]['titular']); ?></h4>
                <p><?php echo htmlspecialchars($publicaciones[0]['descripcion_corta']); ?></p>
                <p class="publication-date"><?php echo date("d/m/Y", strtotime($publicaciones[0]['fecha'])); ?></p> <!-- Fecha de publicación -->
            <?php endif; ?>
        </section>

        <!-- Mostrar las noticias secundarias -->
        <section class="secondary-news">
            <?php foreach ($publicaciones as $key => $publicacion): ?>
                <?php if ($key > 0): // Para las noticias secundarias (excluyendo la primera) ?>
                    <div class="news-item clickable">
                        <a href="ver_publicacion.php?id=<?php echo $publicacion['id_noticia']; ?>" title="Este apartado te lleva a una de las noticias secundarias del blog">
                            <!-- Comprobamos si la imagen existe -->
                            <img src="uploads/<?php echo $publicacion['imagen_principal']; ?>" alt="Imagen de la noticia secundaria">
                        </a>
                        <div>
                            <h5><?php echo htmlspecialchars($publicacion['titular']); ?></h5>
                            <p><?php echo htmlspecialchars($publicacion['descripcion_corta']); ?></p>
                            <p class="publication-date"><?php echo date("d/m/Y", strtotime($publicacion['fecha'])); ?></p> <!-- Fecha de publicación -->
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </section>
    </main>

    <footer>
        <p>Las noticias encontradas en este blog no fueron redactadas por nuestro equipo, solo nos encargamos de difundir información.</p>
        <div class="hidden-square" onclick="location.href='Login.html'"></div>
    </footer>
</body>
</html>