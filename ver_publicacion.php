<?php
// Conexión a la base de datos
require 'db.php';

// Verificar si se pasa un ID en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_noticia = $_GET['id'];

    // Consulta para obtener la noticia específica
    $sql = "SELECT * FROM publicaciones WHERE id_noticia = :id_noticia";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_noticia', $id_noticia, PDO::PARAM_INT);
    $stmt->execute();

    // Obtener los resultados
    $noticia = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si no se encuentra la noticia
    if (!$noticia) {
        echo "Noticia no encontrada.";
        exit;
    }
} else {
    echo "ID de noticia no válido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($noticia['titular']); ?></title>
    <link rel="stylesheet" href="styles/noticiaIndStyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <nav style="display: flex; justify-content: center; align-items: center; width: 100%;">
            <a href="index.php" style="text-decoration: none; color: inherit; text-align: center; font-size: 24px;">
                <p>Poder igualitario.</p>
            </a>            
        </nav>
    </header>

    <!-- Encabezado -->
    <section class="encabezado">
        <h1><?php echo htmlspecialchars($noticia['titular']); ?></h1>
        <p><strong>Fecha:</strong> <?php echo date("d/m/y", strtotime($noticia['fecha'])); ?></p>
    </section>

    <!-- Imagen principal -->
    <section class="uploads/img_67d139acdc8b75.13064540.png">
        <a href="<?php echo htmlspecialchars($noticia['url_imagen']); ?>" target="_blank">
            <img src="<?php echo htmlspecialchars($noticia['url_imagen']); ?>" alt="Imagen de la noticia" width="99%">
        </a>
    </section>      

    <!-- Contenido -->
    <section class="contenido">
        <p><?php echo nl2br(htmlspecialchars($noticia['contenido'])); ?></p>
    </section>

    <!-- Imágenes adicionales -->
    <?php if (!empty($noticia['imagenes'])): ?>
        <section class="imagenes">
            <h2>Galería de imágenes</h2>
            <div class="galeria">
                <?php 
                    $imagenes = explode(',', $noticia['imagenes']);
                    foreach ($imagenes as $imagen): 
                ?>
                    <img src="<?php echo htmlspecialchars($imagen); ?>" alt="Imagen" width="30%">
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- Referencias -->
    <section class="referencia">
        <h3>Referencias</h3>
        <?php if (!empty($noticia['referencia'])): ?>
            <ul>
                <li><a href="<?php echo htmlspecialchars($noticia['referencia']); ?>" target="_blank">Fuente original</a></li>
            </ul>
        <?php else: ?>
            <p>No se ha proporcionado una fuente original.</p>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer>
        <p>Las noticias encontradas en este blog no fueron redactadas por nuestro equipo, solo nos encargamos de difundir información.</p>
    </footer>
</body>
</html>
