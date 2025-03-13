<?php
require 'db.php'; // Conexión a la base de datos

// Obtener todas las publicaciones
try {
    // Cambié 'id' por 'id_noticia'
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
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="styles/adminStyles.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
        <h2><a href="index.php" class="home-link">Poder Igualitario</a></h2>
        <div class="user-info">
                <p class="user-name">Kevin Valdovinos</p>
                <p class="user-email">kvaldovinos2@puol.com</p>
            </div>
            <a href="#" class="back-link">⬅ Regresar al Blog</a>
        </aside>

        <main class="main-content">
            <h1>¡Bienvenido, Kevin!</h1>
            <h2>Noticias</h2>
            <div class="button-container">
                <form action="crearPublicacionForms.html" method="get">
                    <button type="submit" class="new-button">Crear</button>
                </form>
            </div>
            <table class="news-table">
                <thead>
                    <tr>
                        <th>Encabezado</th>
                        <th>Fecha</th>
                        <th>Previsualizar</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($publicaciones as $publicacion): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($publicacion['titular']); ?></td>
                            <td><?php echo date("d/m/Y", strtotime($publicacion['fecha'])); ?></td>
                            <td><a href="ver_publicacion.php?id=<?php echo $publicacion['id_noticia']; ?>">🔍</a></td>
                            <td><a href="editar_publicacion.php?id=<?php echo $publicacion['id_noticia']; ?>">✏️</a></td>
                            <td><a href="eliminar_publicacion.php?id=<?php echo $publicacion['id_noticia']; ?>" onclick="return confirm('¿Seguro que quieres eliminar esta publicación?');">❌</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
